<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebhookController extends CI_Controller {

    public function receiveMessageStatus() {
        // Handle webhook logic here
        header('Content-Type: application/json; charset=utf-8');
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $device = $data['device'];
        $id = $data['id'];
        $stateid = $data['stateid'];
        $status= $data['status']; 
        $state = $data['state'];
        // $dateWebhook = $data;
        // $dateWebhook = array(
        //   "Device" => $data['device'],
        //   "Id" => $data['id'],
        //   "StateId" => $data['stateid'],
        //   "Status"=> $data['status'], 
        //   "State" => $data['state'],
        // );
        if($data["state"] == 'sent'){
          $statusId = 'MES1';
        }elseif($data["state"] == 'delivered'){
          $statusId = 'MES2';
        }elseif ($data["state"] == 'read') {
          $statusId = 'MES3';
        }elseif ($data["state"] == '' && $data["status"] == 'waiting') {
          $statusId = 'MES6';
        }
        $this->load->model('Customer_Model');
        if(isset($id) && isset($stateid)){
          $dataUpdate = array(
            'StatusId' => $statusId,
            'Status' => $data["status"],
            'State' => $data['state'],
            'StateId' => $data["stateid"],
            'ModifyDate' => date('Y-m-d H:i:s'),
          );
          $where = array(
            'RemoteId' => $data['id'],
          );
          $this->Message_Model->updateMessageStatus($dataUpdate, $where);

        }else if(isset($id) && !isset($stateid)){
          $dataUpdate = array(
            'Status' => $data["status"],
            'ModifyDate' => date('Y-m-d H:i:s'),
          );
          $where = array(
            'RemoteId' => $data['id'],
          );
          $this->Message_Model->updateMessageStatus($dataUpdate, $where);
        }else{
          $dataUpdate = array(
            'StatusId' => $statusId,
            'State' => $data['state'],
            'ModifyDate' => date('Y-m-d H:i:s'),
          );
          $where = array(
            'StateId' => $data['stateid'],
          );
        $this->Message_Model->updateMessageStatus($dataUpdate, $where);

        }

        // $respone = $this->updateMessage($dateWebhook);
        
        // var_dump($respone);

    }

    public function updateMessage($dataRespone) {
        
        return $data;
    }
}