<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    // Fungsi untuk mengambil semua data menu
    public function get_all()
    {
        return $this->db->get('menu')->result();
    }

    // Fungsi untuk mengambil satu data menu berdasarkan ID
    public function get_by_id($id_menu)
    {
        $this->db->where('id_menu', $id_menu);
        return $this->db->get('menu')->row();
    }

    // Fungsi untuk menambah data menu baru
    public function insert($data)
    {
        $this->db->insert('menu', $data);
    }

    // Fungsi untuk mengubah data menu
    public function update($id_menu, $data)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->update('menu', $data);
    }

    // Fungsi untuk menghapus data menu
    public function delete($id_menu)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->delete('menu');
    }


    // --- FUNGSI BARU UNTUK MENGUBAH STATUS ---
    // Fungsi ini dibuat khusus hanya untuk mengubah kolom 'status'
    public function update_status($id_menu, $data)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->update('menu', $data);
    }
}