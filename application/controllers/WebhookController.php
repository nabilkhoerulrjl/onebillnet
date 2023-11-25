<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebhookController extends CI_Controller {

    public function receive() {
        // Handle webhook logic here
        header('Content-Type: application/json; charset=utf-8');

        $conn = mysqli_connect("localhost","root","","onebillnet_db");
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }
        
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $device = $data['device'];
        $id = $data['id'];
        $stateid = $data['stateid'];
        $status= $data['status']; 
        $state = $data['state'];
        var_dump($data);

    }
}