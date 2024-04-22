<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_Model');
    }

    public function getListDataProduct() {
        $siteId = $this->getSiteId();
		$select = 'Product.Id,Product.Name';
		$where = array(
			'SiteId' => $siteId,
			'StatusId' => 'PTS1'
		);
		$this->load->model('Product_Model');
		$data = $this->Product_Model->getAllProduct($select, $where);
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