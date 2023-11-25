<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk menyimpan data template ke dalam database
    public function insert_template($data) {
        $this->db->insert('Template', $data);
        return $this->db->insert_id();
    }

    // Fungsi untuk mendapatkan data template berdasarkan ID
    public function get_template_by_id($id) {
        $this->db->where('Id', $id);
        $query = $this->db->get('Template');
        return $query->row();
    }

    // Fungsi untuk mendapatkan semua data template
    public function getAllTemplates($select, $where) {
        $this->db->select($select);
        $this->db->from('Template');
        $this->db->where_in($where);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        } else {
            return null;
        }
    }

    // Fungsi untuk mengupdate data template berdasarkan ID
    public function update_template($id, $data) {
        $this->db->where('Id', $id);
        $this->db->update('Template', $data);
    }

    // Fungsi untuk menghapus data template berdasarkan ID
    public function delete_template($id) {
        $this->db->where('Id', $id);
        $this->db->delete('Template');
    }
}