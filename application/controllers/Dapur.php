<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dapur extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek jika user tidak login atau bukan staf dapur
        if (!$this->session->userdata('username') || $this->session->userdata('role') != 'Dapur') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu!</div>');
            redirect('auth');
        }
        $this->load->model('Pesanan_model');
        $this->load->model('Menu_model');
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Dapur';
        
        // Mengambil semua data pesanan yang statusnya 'Diproses'
        $pesanan_dapur = $this->Pesanan_model->get_pesanan_untuk_dapur();
        
        // Mengambil detail item untuk setiap pesanan
        foreach($pesanan_dapur as $pesanan){
            $pesanan->detail = $this->Pesanan_model->get_pesanan_by_id($pesanan->id_pesanan)['detail'];
        }

        $data['daftar_pesanan'] = $pesanan_dapur;

        $this->load->view('templates/header', $data);
        $this->load->view('dapur/dashboard', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi untuk mengubah status pesanan menjadi 'Siap Disajikan'
    public function tandai_siap($id_pesanan)
    {
        $data = [
            'status_pesanan' => 'Siap Disajikan'
        ];

        $this->Pesanan_model->update_status($id_pesanan, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan #' . $id_pesanan . ' telah ditandai SIAP!</div>');
        redirect('dapur');
    }

public function status_menu()
{
    $data['judul'] = 'Ubah Status Ketersediaan Menu';
    $data['menu_list'] = $this->Menu_model->get_all(); // Mengambil semua menu

    $this->load->view('templates/header', $data);
    $this->load->view('dapur/status_menu', $data); // Kita akan buat file view ini
    $this->load->view('templates/footer');
}

public function ubah_status_menu($id_menu, $status_sekarang)
{
    // Logika untuk membalik status
    if ($status_sekarang == 'Tersedia') {
        $status_baru = 'Habis';
    } else {
        $status_baru = 'Tersedia';
    }

    $data = ['status' => $status_baru];

    // Panggil model untuk update ke database
    $this->Menu_model->update_status($id_menu, $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status menu berhasil diubah!</div>');

    // Kembali ke halaman status menu
    redirect('dapur/status_menu');
}
}