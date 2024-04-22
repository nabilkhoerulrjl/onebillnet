<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class ContactGroupController extends CI_Controller {
        function __construct(){
            parent::__construct();
            if($this->session->userdata('status') != "login"){
                redirect(base_url("Login_Controller/index"));
            }
        }

        public function index()
        {
            // $random_id = uniqid();
            $random_id = $this->ramdomId();
            $data['idTabMenu'] = 'contactGroup'.$random_id;
            $data['dataContact']  = $this->getListDataContact();
            $this->load->view('customer/contactGroup/index',$data);
        }

        public function getListDataContact() {
            $siteId     = $this->getSiteId();
            $select = 'ct.Id, ct.Name, ct.Email, ct.Phone, ct.Whatsapp, cg.GroupName, ct.StatusId, ct.CustomerId';
            $join   = ['ContactGroup AS cg', 'ct.GroupId = cg.Id', 'left'];
            $arrWhere = array(
                'SiteId' => $siteId,
                'StatusId' => 'CTS1',
            );
            $data = $this->Contact_Model->getAllData($select, $join, $arrWhere);
            return $data;
        }

        public function getDataGroup() {
            echo json_encode($this->getListDataContactGroup());
        }

        public function getListDataContactGroup() {
            $siteId = $this->getSiteId();
            $select = '`cg`.`Id`, `cg`.`GroupName`, `cg`.`Description`, COUNT(DISTINCT `ct`.`Id`) AS Member';
            $join   = ['Contact AS ct', 'ct.GroupId = cg.Id', 'left'];
            $join2   = ['CustomerGroup AS csg', 'csg.GroupContactId = cg.Id', 'left'];
            $where = array(
                'SiteId' => $siteId,
                'StatusId' => 'CTS1',
            );
            $groupby = '`cg`.`Id`';
            $this->load->model('ContactGroup_Model');
            $data = $this->ContactGroup_Model->getAllContactGroup($select, $join, $join2, $where, $groupby);
            // var_dump($data);
            // echo json_encode($data);
            return $data;
        }

        public function getContactbyId()
        {
            $contactId = $this->input->post('Id');
            $siteId = $this->getSiteId();
            $select = 'ct.Id, ct.FirstName, ct.LastName, ct.Email, ct.Phone, ct.Whatsapp, ct.mobile, ct.CustomerId';
            $arrWhere = array(
                'SiteId' => $siteId,
                'StatusId' => 'CTS1',
                'Id' => $contactId,
            );
            $data = $this->Contact_Model->getContactById($select, $arrWhere);
            // var_dump($data);
            echo json_encode($data);

        }

                    
        public function editContact()
        {
            $id = $this->input->post('id');
            $firstName = $this->input->post('firstName');
            $lastName = $this->input->post('lastName');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $whatsapp = $this->input->post('whatsapp');
            $customerId = $this->input->post('customerId');

            $modifier = $this->getUserId();
            $siteId = $this->getSiteId();
            // Mapping Data
            $data = array(
                'Name' => $firstName.' '.$lastName,
                'FirstName' => $firstName,
                'LastName' => $lastName,
                'Email' => $email,
                'Phone' => $phone,
                'Whatsapp' => $whatsapp,
                'Modifier' => $modifier,
                'ModifyDate' => date("Y-m-d H:i:s"),
            );

            $dataCustomer = array(
                'FirstName' => $firstName,
                'LastName' => $lastName,
                'Phone' => $phone,
                'Whatsapp' => $whatsapp,
                'Email' => $email,
                'Modifier' => $modifier,
                'ModifyDate' => date("Y-m-d H:i:s"),
            );

            // Panggil model untuk melakukan update data
            $this->load->model('Contact_Model');
            $result = $this->Contact_Model->updateContact($id, $data);

            // Tanggapi hasil dari pembaruan data
            if ($result) {
                $this->load->model('Customer_Model');
                $resultCustomer = $this->Customer_Model->updateCustomer($customerId, $dataCustomer);
                if ($resultCustomer) {
                    // Jika berhasil, kirim respons JSON ke klien
                    $response['success'] = true;
                    $response['message'] = 'Data contact berhasil diperbarui.';
                    echo json_encode($response);
                } else {
                    // Jika gagal, kirim respons JSON ke klien
                    $response['success'] = false;
                    $response['message'] = 'Gagal memperbarui data contact.';
                    echo json_encode($response);
                }
            } else {
                // Jika gagal, kirim respons JSON ke klien
                $response['success'] = false;
                $response['message'] = 'Gagal memperbarui data contact.';
                echo json_encode($response);
            }
        }

        public function refreshContactData() {
            $siteId     = $this->getSiteId();
            $select = 'ct.Id, ct.Name, ct.Email, ct.Phone, ct.Whatsapp, cg.GroupName, ct.StatusId';
            $join   = ['ContactGroup AS cg', 'ct.GroupId = cg.Id', 'left'];
            $arrWhere = array(
                'SiteId' => $siteId,
                'StatusId' => 'CTS1',
            );
            $data = $this->Contact_Model->getAllData($select, $join, $arrWhere);
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

?>