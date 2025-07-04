<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja_model extends CI_Model {

    public function get_all()
    {
        return $this->db->get('meja')->result();
    }

    public function get_by_id($id_meja)
    {
        $this->db->where('id_meja', $id_meja);
        return $this->db->get('meja')->row();
    }
}