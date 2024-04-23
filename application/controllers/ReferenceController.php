<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReferenceController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Reference_Model');
    }

    public function getStatusCustomer() {
        $siteId = $this->getSiteId();
		$select = 'Reference.Code,Reference.Description,Reference.GroupId';
		$where = array(
			'Enabled' => '1',
			'GroupId' => 'CustomerStatus'
		);
		$this->load->model('Reference_Model');
		$data = $this->Reference_Model->getAllStatusCustomer($select, $where);
        // var_dump($data);
        echo json_encode($data);

        return ;
    }

    public function getSiteId()
    {
		$siteId  ="0";
		// Load the session library
		$this->load->library('session');
        if ($this->session->has_userdata('siteid')) {
            // Retrieve its value
            $siteId = $this->session->userdata("siteid");
        }
        return $siteId;
	}
}