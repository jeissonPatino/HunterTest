<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		if($this->session->userdata('login_ok')){
            $data = array('title' => 'Menu');
			$this->load->view('Includes/head', $data);
			$this->load->view('Includes/header');
			$this->load->view('Includes/sidebar');
			$this->load->view('Home/index');
			$this->load->view('Includes/footer');
        }else{
            $this->load->view('Login/login');
        }
        
    }

    

}

?>