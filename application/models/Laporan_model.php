<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    /**
     * Mengambil semua detail item dari pesanan yang sudah LUNAS pada tanggal tertentu.
     * @param string $tanggal Format 'YYYY-MM-DD'
     * @return array
     */
    public function get_laporan_harian($tanggal)
    {
        $this->db->select('menu.nama_menu, detail_pesanan.jumlah, detail_pesanan.subtotal');
        $this->db->from('detail_pesanan');
        $this->db->join('menu', 'detail_pesanan.id_menu = menu.id_menu');
        $this->db->join('pesanan', 'detail_pesanan.id_pesanan = pesanan.id_pesanan');
        
        // Filter hanya untuk pesanan yang sudah lunas
        $this->db->where('pesanan.status_pembayaran', 'Lunas');
        // Filter berdasarkan tanggal
        $this->db->where("DATE(pesanan.waktu_pesanan)", $tanggal);

        return $this->db->get()->result();
    }
}