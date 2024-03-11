<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeliveryHistory_Controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        if($this->session->userdata('status') != "login"){
            redirect(base_url("Login_Controller/index"));
        }
    }

    public function index(){
        $data['idTabMenu'] = 'deliveryHistory256';
        $data['dataHistory']  = $this->getListData();
        $this->load->view('broadcast/deliveryHistory',$data);
    }

    public function getListData() {
        $siteId     = $this->getSiteId();
        $endDate    = date('Y-m-d H:i:s');
        $startDate  = date('Y-m-d H:i:s', strtotime('-3 months', strtotime($endDate)));
        $select = 'Id, MediaId, Subject, `From`, `To`, StatusId, SendDate, ResendDate, Remarks';
        $arrWhere = array(
            'SiteId' => $siteId,
            'StartDate' => $startDate,
            'EndDate' => $endDate,
        );
        $data = $this->Message_Model->getMessageHistory($select, $arrWhere);
        return $data;
    }

    public function getRefreshData() {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $siteId     = $this->getSiteId();
        $select = 'Id, MediaId, Subject, `From`, `To`, StatusId, SendDate, ResendDate, Remarks';
        $arrWhere = array(
            'SiteId' => $siteId,
            'StartDate' => $startDate,
            'EndDate' => $endDate,
        );
        $data = $this->Message_Model->getMessageHistory($select, $arrWhere);
        echo json_encode($data);
    }

    private function getUserId()
    {
        // Check if the variable is defined
        $userId  ="0";
        $this->load->library('session');
        if ($this->session->has_userdata("id")) {
            // Retrieve its value
            $userId = $this->session->userdata("id");
        }
        
        return $userId;
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

?>