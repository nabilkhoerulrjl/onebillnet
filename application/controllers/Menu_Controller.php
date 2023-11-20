<?php

use LDAP\Result;

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_Controller extends CI_Controller {

    public function settings() {
        
        $Result = $this->load->view('menu/settings','', TRUE);
        echo $Result;
    }
}
?>