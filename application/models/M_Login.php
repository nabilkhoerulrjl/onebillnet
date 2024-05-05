<?php
    class M_Login extends CI_Model {
        function loginData($table, $where) {
            $this->db->select('Users.Id AS Id, Users.Email AS Email, Users.Password AS Password, Users.Name AS UserName, Roles.Name AS RoleName, Users.ImageId AS ImageId, Users.SiteId');
            $this->db->from('Users');
            $this->db->join('Roles', 'Users.RoleId = Roles.Id', 'inner');
            $this->db->where($where);
        
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                $result = $query->row();
        
                // // Convert blob to image resource
                // $imageResource = imagecreatefromstring($result->Picture);
        
                // // Create a JPEG file and output it to a variable
                // ob_start();
                // imagejpeg($imageResource);
                // $jpegData = ob_get_clean();
        
                // // Store the JPEG data in the result object
                // $result->JpegPicture = $jpegData;
        
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