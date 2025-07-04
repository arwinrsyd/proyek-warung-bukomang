<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function cek_login($username)
    {
        // Mengambil data user berdasarkan username
        $this->db->where('username', $username);
        return $this->db->get('users')->row(); // Mengembalikan satu baris data user
    }
}