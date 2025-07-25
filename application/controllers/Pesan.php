<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('Meja_model');
        $this->load->model('Pesanan_model');
        $this->load->helper('form');
        
        // Memuat file konfigurasi Midtrans
        $this->load->config('midtrans');
        // $this->load->library('midtrans_lib'); <-- DIHAPUS karena tidak digunakan lagi
    }

    public function meja($id_meja)
    {
        if (!$this->session->userdata('id_meja')) {
            $this->session->set_userdata('id_meja', $id_meja);
        }
        $data['menu_list'] = $this->Menu_model->get_all();
        $meja = $this->Meja_model->get_by_id($id_meja);
        $data['judul'] = 'Pesan dari Meja ' . $meja->nomor_meja;
        $data['meja'] = $meja;
        $this->load->view('templates/header', $data);
        $this->load->view('pesan/index', $data);
        $this->load->view('templates/footer_pesan', $data);
    }

    public function tambah_ke_keranjang()
    {
        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => 1,
            'price'   => $this->input->post('price'),
            'name'    => $this->input->post('name'),
            'options' => array('gambar' => $this->input->post('gambar'))
        );
        $this->cart->insert($data);
        redirect('pesan/meja/' . $this->session->userdata('id_meja'));
    }

    public function hapus_dari_keranjang($rowid)
    {
        $this->cart->remove($rowid);
        redirect('pesan/meja/' . $this->session->userdata('id_meja'));
    }

    public function proses_pesanan()
    {
        $metode_pembayaran = $this->input->post('metode_pembayaran');

        if ($metode_pembayaran == 'Tunai') {
            $this->_proses_pesanan_tunai();
        } 
        // Cek jika metode pembayaran adalah salah satu dari VA
        else if (in_array($metode_pembayaran, ['bca_va', 'bri_va', 'bni_va'])) {
            $this->_proses_pembayaran_va($metode_pembayaran);
        }
    }

    private function _proses_pesanan_tunai()
    {
        $data_pesanan = [
            'id_meja'           => $this->session->userdata('id_meja'),
            'order_id'          => 'TUNAI-' . time(),
            'total_harga'       => $this->cart->total(),
            'metode_pembayaran' => 'Tunai',
            'status_pembayaran' => 'Belum Bayar',
            'status_pesanan'    => 'Menunggu Pembayaran'
        ];
        $detail_pesanan = [];
        foreach ($this->cart->contents() as $item) {
            $detail_pesanan[] = [
                'id_menu'  => $item['id'],
                'jumlah'   => $item['qty'],
                'subtotal' => $item['subtotal']
            ];
        }
        $id_pesanan = $this->Pesanan_model->simpan_pesanan($data_pesanan, $detail_pesanan);
        if ($id_pesanan) {
            $this->cart->destroy();
            redirect('pesan/sukses/' . $id_pesanan);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memproses pesanan, silakan coba lagi!</div>');
            redirect('pesan/meja/' . $this->session->userdata('id_meja'));
        }
    }

    private function _proses_pembayaran_va($metode)
    {
        // Mendapatkan kode bank ('bca', 'bri', 'mandiri') dari nilai yang dikirim
        $bank_code = explode('_', $metode)[0]; 
        // Mendapatkan nama bank yang lebih deskriptif untuk disimpan
        $bank_name = strtoupper($bank_code) . ' VA';

        // 1. Simpan pesanan ke database
        $order_id = 'WBK-VA-' . time();
        $data_pesanan = [
            'id_meja'           => $this->session->userdata('id_meja'),
            'order_id'          => $order_id,
            'total_harga'       => $this->cart->total(),
            'metode_pembayaran' => $bank_name,
            'status_pembayaran' => 'Pending',
            'status_pesanan'    => 'Menunggu Pembayaran'
        ];
        $detail_pesanan = [];
        foreach ($this->cart->contents() as $item) {
            $detail_pesanan[] = ['id_menu' => $item['id'], 'jumlah' => $item['qty'], 'subtotal' => $item['subtotal']];
        }
        $id_pesanan_db = $this->Pesanan_model->simpan_pesanan($data_pesanan, $detail_pesanan);

        // 2. Konfigurasi Midtrans
        require_once APPPATH . 'third_party/Midtrans/Midtrans.php';
        \Midtrans\Config::$serverKey = $this->config->item('server_key');
        \Midtrans\Config::$isProduction = $this->config->item('is_production');

        // 3. Siapkan parameter untuk meminta nomor VA
        $transaction_params = array(
            'payment_type' => 'bank_transfer',
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => (int) $this->cart->total(),
            ),
            'bank_transfer' => array(
                'bank' => $bank_code // Menggunakan kode bank yang dinamis
            )
        );
        

        try {
            // 4. Minta nomor VA ke Midtrans
            $response = \Midtrans\CoreApi::charge($transaction_params);

            // 5. Jika berhasil, simpan nomor VA dan arahkan ke halaman sukses
            if ($response->status_code == 201) {
                $va_number = $response->va_numbers[0]->va_number;
                $this->Pesanan_model->update_status_by_order_id($order_id, ['nomor_va' => $va_number]);
                $this->cart->destroy();
                redirect('pesan/sukses_va/' . $id_pesanan_db);
            }

        } catch (Exception $e) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mendapatkan nomor Virtual Account. Error: ' . $e->getMessage() . '</div>');
            redirect('pesan/meja/' . $this->session->userdata('id_meja'));
        }
    }

    public function sukses_va($id_pesanan)
    {
        $data['data_pesanan'] = $this->Pesanan_model->get_pesanan_by_id($id_pesanan);
        $data['judul'] = 'Selesaikan Pembayaran';

        // Baris ini akan mengambil pesan status yang dikirim oleh fungsi cek_status()
        $data['status_message'] = $this->session->flashdata('status_message');

        $this->load->view('templates/header', $data);
        $this->load->view('pesan/sukses_va', $data);
        $this->load->view('templates/footer_pesan');
    }

    public function notifikasi()
    {
        require_once APPPATH . 'third_party/Midtrans/Midtrans.php';
        \Midtrans\Config::$isProduction = $this->config->item('is_production');
        \Midtrans\Config::$serverKey = $this->config->item('server_key');
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;

        if ($transaction == 'capture' || $transaction == 'settlement'){
            $data_update = [
                'status_pembayaran' => 'Lunas',
                'status_pesanan' => 'Diproses'
            ];
            $this->Pesanan_model->update_status_by_order_id($order_id, $data_update);
        }
    }

    public function sukses($id_pesanan)
    {
        $data['data_pesanan'] = $this->Pesanan_model->get_pesanan_by_id($id_pesanan);
        $data['judul'] = 'Pesanan Berhasil';
        
        $this->load->view('templates/header', $data);
        $this->load->view('pesan/sukses', $data);
        $this->load->view('templates/footer_pesan');
    }

    public function cek_status($order_id)
    {
        require_once APPPATH . 'third_party/Midtrans/Midtrans.php';
        \Midtrans\Config::$serverKey = $this->config->item('server_key');
        \Midtrans\Config::$isProduction = $this->config->item('is_production');

        try {
            // Minta status transaksi dari Midtrans
            $status = \Midtrans\Transaction::status($order_id);

            // Ambil id_pesanan dari database untuk keperluan redirect
            $id_pesanan = $this->Pesanan_model->get_pesanan_by_order_id($order_id)['pesanan']->id_pesanan;

            if ($status->transaction_status == 'settlement' || $status->transaction_status == 'capture') {
                // Jika pembayaran LUNAS
                $data_update = [
                    'status_pembayaran' => 'Lunas',
                    'status_pesanan' => 'Diproses'
                ];
                $this->Pesanan_model->update_status_by_order_id($order_id, $data_update);

                // Arahkan ke halaman struk akhir
                redirect('pesan/sukses/' . $id_pesanan);

            } else {
                // Jika pembayaran BELUM LUNAS, buat pesan peringatan
                $pesan = "Status pembayaran masih <strong>" . ucfirst($status->transaction_status) . "</strong>. Silakan selesaikan pembayaran terlebih dahulu.";
                $this->session->set_flashdata('status_message', '<div class="alert alert-warning">' . $pesan . '</div>');
                
                // Arahkan kembali ke halaman VA
                redirect('pesan/sukses_va/' . $id_pesanan);
            }

        } catch (Exception $e) {
            // Jika terjadi error (misal: order_id tidak ditemukan)
            $id_pesanan = $this->Pesanan_model->get_pesanan_by_order_id($order_id)['pesanan']->id_pesanan;
            $this->session->set_flashdata('status_message', '<div class="alert alert-danger">Gagal memeriksa status. Error: ' . $e->getMessage() . '</div>');
            redirect('pesan/sukses_va/' . $id_pesanan);
        }
    }
}
