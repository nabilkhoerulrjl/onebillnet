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
    public function getAllContactGroup($select, $join, $join2, $where, $groupby) {
        $this->db->select($select);
        $this->db->from('ContactGroup AS cg');
        $this->db->join($join[0], $join[1], $join[2]);
        $this->db->join($join2[0], $join2[1], $join2[2]);
        $this->db->where('ct.SiteId', $where['SiteId']);
        $this->db->where('ct.StatusId', $where['StatusId']);
        $this->db->group_by($groupby);
    
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
