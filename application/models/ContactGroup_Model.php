<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactGroup_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk menyimpan data grup kontak ke dalam database
    public function insert_contactgroup($data) {
        $this->db->insert('contactgroup', $data);
        return $this->db->insert_id();
    }

    // Fungsi untuk mendapatkan data grup kontak berdasarkan ID
    public function get_contactgroup_by_id($id) {
        $this->db->where('Id', $id);
        $query = $this->db->get('contactgroup');
        return $query->row();
    }

    // Fungsi untuk mendapatkan semua data grup kontak
    public function getAllContactGroups() {
        $query = $this->db->get('contactgroup');
        return $query->result();
    }

    // Fungsi untuk mengupdate data grup kontak berdasarkan ID
    public function update_contactgroup($id, $data) {
        $this->db->where('Id', $id);
        $this->db->update('contactgroup', $data);
    }

    // Fungsi untuk menghapus data grup kontak berdasarkan ID
    public function delete_contactgroup($id) {
        $this->db->where('Id', $id);
        $this->db->delete('contactgroup');
    }
}
