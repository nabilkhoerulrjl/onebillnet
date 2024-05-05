<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileModel extends CI_Model {

    public function insertFile($data) {
        // Lakukan proses insert ke database
        $this->db->insert('File', $data);

        // Periksa apakah data berhasil di-insert
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getFileById($fileId) {
        $this->db->where('Id', $fileId);
        $query = $this->db->get('File');
        return $query->row_array();
    }
}
?>