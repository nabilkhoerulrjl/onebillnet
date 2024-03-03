<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllBills() {
        $query = $this->db->get('Bill');
        return $query->result();
    }

    public function getBillByAny($select, $where) {
        $this->db->select($select);
        $this->db->from('Bill');
    
        // Iterasi melalui array $where dan menambahkan kondisi WHERE
        foreach ($where as $column => $values) {
            // Pastikan $values adalah array
            if (is_array($values)) {
                $this->db->where_in($column, $values);
            } else {
                // Jika hanya satu nilai, gunakan where biasa
                $this->db->where($column, $values);
            }
        }
    
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        } else {
            return null;
        }
    }

    public function getBillById($billId) {
        $query = $this->db->get_where('Bill', array('Id' => $billId));
        return $query->row();
    }

    public function createBill($data) {
        $this->db->insert('Bill', $data);
        return $this->db->insert_id();
    }

    public function updateBill($billId, $data) {
        // var_dump($data);
        // $this->db->where_in('Id', $billId);
        $success = $this->db->update_batch('Bill', $data, 'Id');

        if ($success) {
            $response = array(
                'status' => 'success',
                'message' => 'Data updated successfully.'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Failed to update data.'
            );
        }
    
        return $response;
    }

    public function deleteBill($billId) {
        $this->db->where_in('Id', $billId);
        $this->db->delete('Bill');
    }
}
