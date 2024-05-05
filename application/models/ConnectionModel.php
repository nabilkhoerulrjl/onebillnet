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
        // $rawQuery = $this->db->last_query();

        $query = $this->db->get();
        return $query->result();
    }
}
