<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConnectionModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getConnActive($select, $where) {
        $this->db->select($select);
        $this->db->from('Connection as conn');
        $this->db->where('conn.SiteId', $where['SiteId']);
        $this->db->where('conn.StatusId', $where['StatusId']);
        $this->db->where('conn.MediaId', $where['MediaId']);
        if(isset($where['UserName'])){
        $this->db->where('conn.UserName', $where['UserName']);
        }
        // $rawQuery = $this->db->last_query();

        $query = $this->db->get();
        return $query->result();
    }

    function getMediaActiveConn($select, $where) {
        $this->db->select($select);
        $this->db->from('Connection');
        $this->db->where($where);
        $query = $this->db->get();
        // $rawQuery = $this->db->last_query();

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        } else {
            return null;
        }
    }	

    function getUserData($table, $where) {
        $this->db->select('Users.Email AS Email, Users.Password AS Password');
        $this->db->from('Users');
        $this->db->where($where);
    
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result;
        } else {
            return null;
        }
    }

    public function resetPassword($email, $newpassword) {
        $tableName = "Users";

        $passwordColumn = "Password";

        // // Hash password sebelum menyimpannya ke basis data
        // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Query untuk mengupdate password
        $this->db->where('Email', $email);
        $this->db->update($tableName, array($passwordColumn => $newpassword));

        // Periksa apakah query berhasil dijalankan
        return $this->db->affected_rows() > 0;
    }
}
