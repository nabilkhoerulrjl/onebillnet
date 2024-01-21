<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactGroup_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk menyimpan data grup kontak ke dalam database
    public function insert_contactgroup($data) {
        $this->db->insert('ContactGroup', $data);
        return $this->db->insert_id();
    }

    // Fungsi untuk mendapatkan data grup kontak berdasarkan ID
    public function get_contactgroup_by_id($id) { 
        $this->db->where('Id', $id);
        $query = $this->db->get('ContactGroup');
        return $query->row();
    }

    // Fungsi untuk mendapatkan semua data grup kontak
    public function getAllContactGroup($select,$where) {
        $this->db->select($select);
        $this->db->from('ContactGroup');

        // Iterasi melalui array $where dan menambahkan kondisi WHERE
        foreach ($where as $column => $values) {
            $this->db->where($column, $values);
        }
    
        $query = $this->db->get();
        $sql = $this->db->last_query();
        // var_dump($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
        // var_dump($result);

            return $result;
        } else {
            return null;
        }
    }

    // Fungsi untuk mengupdate data grup kontak berdasarkan ID
    public function update_contactgroup($id, $data) {
        $this->db->where('Id', $id);
        $this->db->update('ContactGroup', $data);
    }

    // Fungsi untuk menghapus data grup kontak berdasarkan ID
    public function delete_contactgroup($id) {
        $this->db->where('Id', $id);
        $this->db->delete('ContactGroup');
    }
}
