<?php
    class M_Connection extends CI_Model {
        function listConnection($table, $where) {
            $this->db->select('Connection.Id, Connection.MediaId, Connection.UserName');
            $this->db->from('Connection');
            $this->db->where($where);
        
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $result = $query->result();
                // var_dump($result);
        
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
?>