<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillReminder_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Login_Controller/index"));
		}
	}

	public function index()
	{
		$dataConn 			= $this->getMediaConnection();
		$dataTemplate 		= $this->getTemplateMessage();
		$dataContact 		= $this->getContact();
		$dataContactGroup 	= $this->getContactGroup();
		$data = array(
			'dataConn' => $dataConn,
			'dataTemplate' => $dataTemplate,
			'dataContact' => $dataContact,
			'dataContactGroup' => $dataContactGroup
		);

		$this->load->view('broadcast/billReminder',$data);
	}

	public function deliveryHistory()
	{
		$this->load->view('broadcast/deliveryHistory');
	}

	public function getDataDeliveryHistory()
	{
		$siteId 	= $this->getSiteId();
		$dataConn	= $this->getMediaConnection();

	}
/*
	public function mainDashboard()
	{
		$this->load->view('menu/mainDashboard');
	}
*/
	public function getCompanyName() {
		$siteId = $this->getSiteId();
		$where = array(
			'Id' => $siteId,
		);
        $company = $this->M_Company->companyName("company",$where);
        //$query = $this->db->get('site');
		//$arrays = $site->result();
        $companyName = null;
        if(isset($company)){
            $companyName = $company;
			//echo $companyName;
        }else{
            echo "Setting Not Found !";
        }

		//echo $companyName;
		return $companyName;
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

	public function getMediaConnection()
	{
		$siteId = $this->getSiteId();
		$where = array(
			'SiteId' => $siteId,
			'StatusId' => 'CNS1'
		);
		$this->load->model('M_Connection');
		$data['dataConn'] = $this->M_Connection->listConnection('Connection', $where);

		return $data['dataConn'];
	}

	public function getTemplateMessage()
	{
		$siteId = $this->getSiteId();
        $select = 'Template.Id,Template.MediaId,Template.Title,Template.Content,Template.Meta';
		$where = array(
			'SiteId' => $siteId,
			'Enabled' => '1'
		);
		$this->load->model('Template_Model');
		$data['dataTemplate'] = $this->Template_Model->getAllTemplates($select, $where);

		return $data['dataTemplate'];
	}

	public function getContact()
	{
		$siteId = $this->getSiteId();
		$select = 'Contact.Id,Contact.Name,Contact.Email,Contact.Whatsapp';
		$where = array(
			'SiteId' => $siteId,
			'StatusId' => 'CTS1'
		);
		$this->load->model('Contact_Model');
		$data['dataContact'] = $this->Contact_Model->getContactByAny($select, $where);
        return $data['dataContact'];
	}

	public function getContactGroup()
	{
		$siteId = $this->getSiteId();
		$select = 'ContactGroup.Id,ContactGroup.GroupName';
		$where = array(
			'SiteId' => $siteId,
		);
		$this->load->model('ContactGroup_Model');
		$data['dataContactGroup'] = $this->ContactGroup_Model->getAllContactGroup($select, $where);
        return $data['dataContactGroup'];
	}


}
