<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {

    // Fungsi untuk menyimpan pesanan
    public function simpan_pesanan($data_pesanan, $detail_pesanan)
    {
        // Memulai transaction agar aman
        $this->db->trans_start();
        $this->db->insert('pesanan', $data_pesanan);
        $id_pesanan = $this->db->insert_id();
        foreach ($detail_pesanan as &$detail) {
            $detail['id_pesanan'] = $id_pesanan;
        }
        $this->db->insert_batch('detail_pesanan', $detail_pesanan);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return $id_pesanan;
        }
    }

    // Fungsi untuk mengambil detail pesanan yang sudah berhasil disimpan
    public function get_pesanan_by_id($id_pesanan)
    {
        $this->db->select('pesanan.*, meja.nomor_meja');
        $this->db->from('pesanan');
        $this->db->join('meja', 'pesanan.id_meja = meja.id_meja');
        $this->db->where('pesanan.id_pesanan', $id_pesanan);
        $pesanan = $this->db->get()->row();

        $this->db->select('detail_pesanan.*, menu.nama_menu, menu.harga');
        $this->db->from('detail_pesanan');
        $this->db->join('menu', 'detail_pesanan.id_menu = menu.id_menu');
        $this->db->where('detail_pesanan.id_pesanan', $id_pesanan);
        $detail = $this->db->get()->result();

        return ['pesanan' => $pesanan, 'detail' => $detail];
    }
    
    // --- FUNGSI BARU ---
    // Mengambil semua pesanan yang statusnya BUKAN 'Selesai'.
    public function get_pesanan_untuk_kasir()
{
    $this->db->select('pesanan.*, meja.nomor_meja');
    $this->db->from('pesanan');
    $this->db->join('meja', 'pesanan.id_meja = meja.id_meja');
    $this->db->where('pesanan.status_pesanan !=', 'Selesai');
    
    $this->db->group_start();
    $this->db->where('pesanan.metode_pembayaran', 'Tunai');
    $this->db->or_where('pesanan.status_pesanan', 'Siap Disajikan');
    $this->db->group_end();
    
    $this->db->order_by("FIELD(status_pesanan, 'Menunggu Pembayaran', 'Diproses', 'Siap Disajikan')");
    $this->db->order_by('waktu_pesanan', 'ASC');
    return $this->db->get()->result();
}

    public function get_pesanan_untuk_dapur()
    {
        $this->db->select('pesanan.*, meja.nomor_meja');
        $this->db->from('pesanan');
        $this->db->join('meja', 'pesanan.id_meja = meja.id_meja');
        $this->db->where('pesanan.status_pesanan', 'Diproses');
        $this->db->order_by('waktu_pesanan', 'ASC');
        return $this->db->get()->result();
    }

    // Memperbarui status berdasarkan order_id dari Midtrans
    public function update_status_by_order_id($order_id, $data)
    {
        $this->db->where('order_id', $order_id);
        $this->db->update('pesanan', $data);
    }
    
    public function get_pesanan_by_order_id($order_id)
    {
        $this->db->where('order_id', $order_id);
        $pesanan = $this->db->get('pesanan')->row();
        // Fungsi ini bisa dikembangkan untuk mengambil detail juga jika perlu
        return ['pesanan' => $pesanan, 'detail' => []]; 
    }

    // --- FUNGSI BARU ---
    // Fungsi umum untuk memperbarui data pesanan berdasarkan ID.
    public function update_status($id_pesanan, $data)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('pesanan', $data);
    }
}