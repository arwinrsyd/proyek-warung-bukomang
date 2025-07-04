<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek jika user tidak login atau bukan kasir
        if (!$this->session->userdata('username') || $this->session->userdata('role') != 'Kasir') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu!</div>');
            redirect('auth');
        }
        $this->load->model('Pesanan_model');
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Kasir';
        
        // Mengambil semua data pesanan yang relevan
        $semua_pesanan = $this->Pesanan_model->get_pesanan_untuk_kasir();
        
        // Mengambil detail item untuk setiap pesanan
        foreach($semua_pesanan as $pesanan){
            $pesanan->detail = $this->Pesanan_model->get_pesanan_by_id($pesanan->id_pesanan)['detail'];
        }

        $data['daftar_pesanan'] = $semua_pesanan;

        $this->load->view('templates/header', $data);
        $this->load->view('kasir/dashboard', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi untuk mengonfirmasi pembayaran
    public function konfirmasi_pembayaran($id_pesanan)
    {
        $data = [
            'status_pembayaran' => 'Lunas',
            'status_pesanan'    => 'Diproses' // Status diubah agar masuk ke antrian dapur
        ];

        $this->Pesanan_model->update_status($id_pesanan, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pembayaran untuk Pesanan #' . $id_pesanan . ' berhasil dikonfirmasi!</div>');
        redirect('kasir');
    }
}