<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BroadcastController extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Login_Controller/index"));
		}
	}

	public function index()
	{
		$random_id = $this->ramdomId();
		$dataConn 			= $this->getMediaConnection();
		$dataTemplate 		= $this->getTemplateMessage();
		// var_dump($dataTemplate);
		$dataContact 		= $this->getContact();
		$dataContactGroup 	= $this->getContactGroup();
		$data = array(
			'idTabMenu' => 'broadcastMessage'.$random_id,
			'dataConn' => $dataConn,
			'dataTemplate' => $dataTemplate,
			'dataContact' => $dataContact,
			'dataContactGroup' => $dataContactGroup
		);

		$this->load->view('communicator/index',$data);
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
		$select = 'Connection.Id, Connection.MediaId, Connection.UserName';
		$where = array(
			'SiteId' => $siteId,
			'StatusId' => 'CNS1',
			'ProviderId' => 'PVD01'

		);
		$this->load->model('ConnectionModel');
		$data['dataConn'] = $this->ConnectionModel->getMediaActiveConn($select, $where);
		return $data['dataConn'];
	}

	public function getTemplateMessage()
	{
		$siteId = $this->getSiteId();
        $select = 'Template.Id,Template.TypeId,Template.MediaId,Template.Title,Template.Content,Template.Meta,Template.FixParam';
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
		$select = 'cg.Id, cg.GroupName, cg.Description';
		$join   = ['Contact AS ct', 'ct.GroupId = cg.Id', 'left'];
        $join2   = ['CustomerGroup AS csg', 'csg.GroupContactId = cg.Id', 'left'];
        $where = array(
            'SiteId' => $siteId,
            'StatusId' => 'CTS1',
        );
        $groupby = '`cg`.`Id`';
        $this->load->model('ContactGroup_Model');
        $data = $this->ContactGroup_Model->getAllContactGroup($select, $join, $join2, $where, $groupby);
        return $data;
	}

	public function ramdomId()
    {
        // Mendefinisikan panjang maksimal ID
        $max_length = 5;

        // Generate random ID
        $random_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $max_length);

        // Print the random ID
        return $random_id;
    }
}
