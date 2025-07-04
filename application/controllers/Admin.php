<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // Cek jika user tidak login atau bukan admin
        if (!$this->session->userdata('username') || $this->session->userdata('role') != 'Admin') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu!</div>');
            redirect('auth');
        }

        // Memuat komponen yang dibutuhkan
        $this->load->model('Menu_model');
        $this->load->model('Meja_model');
        $this->load->library('upload'); // Memuat library untuk upload file
        $this->load->helper('form');   // Memuat helper untuk form
        $this->load->model('Laporan_model');
    }
    
    public function index()
    {
        $data['judul'] = 'Dashboard Admin';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('templates/footer');
    }

    public function menu()
    {
        $data['judul'] = 'Manajemen Menu';
        $data['menu_list'] = $this->Menu_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_menu()
    {
        // Konfigurasi untuk upload gambar
        $config['upload_path']   = './assets/img/menu/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'menu-' . time();

        $this->upload->initialize($config);

        $gambar = 'default.jpg'; // Gambar default jika tidak ada file yang di-upload

        // Cek apakah ada file yang di-upload
        if (!empty($_FILES['gambar']['name'])) {
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data('file_name');
            } else {
                // Jika upload gagal, tampilkan error (opsional)
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/menu');
            }
        }
        
        $data = [
            'nama_menu' => $this->input->post('nama_menu'),
            'kategori'  => $this->input->post('kategori'),
            'harga'     => $this->input->post('harga'),
            'status'    => $this->input->post('status'),
            'gambar'    => $gambar
        ];
        
        $this->Menu_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan!</div>');
        redirect('admin/menu');
    }

    public function edit_menu($id_menu)
    {
        $menu_lama = $this->Menu_model->get_by_id($id_menu);
        $gambar = $menu_lama->gambar; // Tetap pakai gambar lama sebagai default

        // Cek jika ada file gambar yang di-upload
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './assets/img/menu/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['file_name']     = 'menu-' . time();

            $this->upload->initialize($config);

            if ($this->upload->do_upload('gambar')) {
                // Hapus gambar lama jika bukan default.jpg
                if ($menu_lama->gambar != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/menu/' . $menu_lama->gambar);
                }
                $gambar = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/menu');
            }
        }
        
        $data = [
            'nama_menu' => $this->input->post('nama_menu'),
            'kategori'  => $this->input->post('kategori'),
            'harga'     => $this->input->post('harga'),
            'status'    => $this->input->post('status'),
            'gambar'    => $gambar
        ];

        $this->Menu_model->update($id_menu, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data menu berhasil diubah!</div>');
        redirect('admin/menu');
    }
    
    public function hapus_menu($id_menu)
    {
        $menu = $this->Menu_model->get_by_id($id_menu);
        if ($menu->gambar != 'default.jpg') {
            unlink(FCPATH . 'assets/img/menu/' . $menu->gambar);
        }

        $this->Menu_model->delete($id_menu);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data menu berhasil dihapus!</div>');
        redirect('admin/menu');
    }

    public function meja()
    {
        $data['judul'] = 'Manajemen Meja & Link Pesan';
        $data['meja_list'] = $this->Meja_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/meja/index', $data);
        $this->load->view('templates/footer');
    }

    // --- FUNGSI BARU UNTUK LAPORAN PENJUALAN ---
    public function laporan()
    {
        $data['judul'] = 'Laporan Penjualan';

        // Cek apakah ada tanggal yang dikirim dari form
        $tanggal = $this->input->post('tanggal');

        // Jika tidak ada tanggal dari form, gunakan tanggal hari ini
        if (!$tanggal) {
            $tanggal = date('Y-m-d');
        }

        $data['laporan'] = $this->Laporan_model->get_laporan_harian($tanggal);
        $data['tanggal_laporan'] = $tanggal;

        $this->load->view('templates/header', $data);
        $this->load->view('admin/laporan/index', $data); // Buat file view ini
        $this->load->view('templates/footer');
    }

    // --- FUNGSI BARU UNTUK MENAMPILKAN HALAMAN STATUS MENU ---
    public function status_menu()
    {
        $data['judul'] = 'Ubah Cepat Status Menu';
        $data['menu_list'] = $this->Menu_model->get_all(); // Mengambil semua menu

        $this->load->view('templates/header', $data);
        $this->load->view('admin/status_menu', $data); // Kita akan buat file view ini
        $this->load->view('templates/footer');
    }

    // --- FUNGSI BARU UNTUK MEMPROSES PERUBAHAN STATUS ---
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
        
        // Kembali ke halaman status menu milik Admin
        redirect('admin/status_menu');
    }
}
