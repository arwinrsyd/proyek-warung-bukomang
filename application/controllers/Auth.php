<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        // Jika sudah login, tendang ke dashboard sesuai rolenya
        if ($this->session->userdata('role')) {
            switch ($this->session->userdata('role')) {
                case 'Admin':
                    redirect('admin');
                    break;
                case 'Kasir':
                    redirect('kasir');
                    break;
                case 'Dapur':
                    redirect('dapur');
                    break;
            }
        }

        // Aturan validasi form
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        // Mengatur pesan error validasi
        $this->form_validation->set_message('required', '%s masih kosong, silakan diisi');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali halaman login
            $data['judul'] = 'Halaman Login';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil, proses login
            $this->_proses_login();
        }
    }

    private function _proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->cek_login($username);
        

        if ($user) {
            // Jika user ada, cek passwordnya
            if (password_verify($password, $user->password)) {
                // Jika password benar, buat session
                $data = [
                    'id_user'   => $user->id_user,
                    'username'  => $user->username,
                    'nama_user' => $user->nama_user,
                    'role'      => $user->role,
                ];
                $this->session->set_userdata($data);

                // Arahkan berdasarkan role
                switch ($user->role) {
                    case 'Admin':
                        redirect('admin');
                        break;
                    case 'Kasir':
                        redirect('kasir');
                        break;
                    case 'Dapur':
                        redirect('dapur');
                        break;
                    default:
                        // Default jika role tidak terdaftar
                        redirect('auth');
                        break;
                }

            } else {
                // Jika password salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('auth');
            }
        } else {
            // Jika user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        // Hapus semua data session
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
        redirect('auth');
    }
}