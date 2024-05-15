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
        $success = $this->db->update('Bill', $data, array('Id' => $billId));
        // $this->db->update_batch('Bill', $data, 'Id');

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

    public function deleteBill($refId) {
        $variableType = gettype($refId);
    
        if ($variableType == 'string') {
            $this->db->where('ReferenceId', $refId);
        }
        if ($variableType == 'array') {
            $this->db->where_in('ReferenceId', $refId);
        }
    
        // Compile delete query
        $compiledQuery = $this->db->get_compiled_delete('Bill', false);
    
        // Hapus data berdasarkan ReferenceId
        $deleteResult = $this->db->delete('Bill');
    
        // Output query mentah
        // echo $compiledQuery;
        
        // Periksa apakah penghapusan berhasil
        if ($deleteResult) {
            return true; // Penghapusan berhasil
        } else {
            return false; // Penghapusan gagal
        }
    }

    public function checkExistingBill($customerId, $periodeBill) {
        $this->db->select('Id');
        $this->db->from('Bill');
        $this->db->where('Periode', $periodeBill);
        $this->db->where_in('CustomerId', $customerId);

        // $rawQuery = $this->db->last_query();
        // var_dump($rawQuery);
        $query = $this->db->get();
        // log_message('debug', 'SQL Query: ' . $rawQuery);
        return $query->num_rows() > 0;
    }

    public function getTotalPageBill($siteid) {
        // Query untuk mendapatkan pengaturan berdasarkan siteid dan code
        $this->db->select('CEIL(COUNT(*) OVER () / 20) AS TotalPage');
        $this->db->from('Bill');
        $this->db->where('SiteId', $siteid);
        $this->db->where('InvoiceId IS NOT NULL');
        $this->db->limit(1);
        $query = $this->db->get();
        // Kembalikan hasil query
        return $query->result(); // Mengembalikan satu baris hasil query dalam bentuk array asosiatif
    }

    public function getInvoice($select, $join, $where) {
        // var_dump($join['join1'][0]);
        // var_dump($join['join2'][0]);
        $this->db->select($select);
        $this->db->from('Bill as b');
        $this->db->join($join['join1'][0], $join['join1'][1], $join['join1'][2]);
        $this->db->join($join['join2'][0], $join['join2'][1], $join['join2'][2]);
        $this->db->where('c.SiteId',$where['SiteId']);
        $this->db->where('b.ReferenceId',$where['ReferenceId']);
        $query = $this->db->get();
        $rawQuery = $this->db->last_query();
        // var_dump($rawQuery);
        return $query->result();
    }
}
