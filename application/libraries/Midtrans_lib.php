<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/Midtrans/Midtrans.php';

class Midtrans_lib {
    
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->config('midtrans');

        // Mengatur konfigurasi Midtrans dari file config
        \Midtrans\Config::$serverKey = $this->CI->config->item('server_key');
        \Midtrans\Config::$isProduction = $this->CI->config->item('is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    /**
     * Fungsi untuk membuat Snap Token
     * @param array $params Parameter transaksi
     * @return string Snap Token
     */
    public function get_snap_token($params)
    {
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return $snapToken;
        } catch (Exception $e) {
            // Jika terjadi error, kita bisa log atau menampilkannya
            // Untuk sekarang, kita hentikan dan tampilkan pesan error
            die('Error saat membuat Snap Token: ' . $e->getMessage());
        }
    }
}