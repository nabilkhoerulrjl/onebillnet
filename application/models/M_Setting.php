<?php
    class M_Setting extends CI_Model {
        function copyrightYear($table,$where){
            $queryGetSetting = $this->db->get_where($table,$where);
            $dataSetting = $queryGetSetting->result();
            $dataValueSetting = null;
            foreach($dataSetting as $data) {
                $dataValueSetting = $data->Value;
            }
            return $dataValueSetting;
        }
    }
?>