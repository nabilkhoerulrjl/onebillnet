<?php
    class Setting_Model extends CI_Model {
        public function getConfigSetting($siteid, $code) {
            // Query untuk mendapatkan pengaturan berdasarkan siteid dan code
            $query = $this->db->get_where('setting', array('SiteId' => $siteid, 'Code' => $code));
            
            // Kembalikan hasil query
            return $query->row_array(); // Mengembalikan satu baris hasil query dalam bentuk array asosiatif
        }
    }
?>