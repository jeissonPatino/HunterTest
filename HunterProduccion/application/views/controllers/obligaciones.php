<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Obligaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
        $this->load->model("CarteraFng_Model");
        $this->load->model("Obligaciones_Model");
    }

    function index(){
    	if($this->session->userdata('login_ok')){
           	
           	$extrajudicial = $this->Obligaciones_Model->getObligaciones();
			$datosFooter = array('ul'=> 'NO' , 'li' => 'LIobligaciones');
           	$abogados =array();
           	$i = 0;
           	foreach ($extrajudicial as $key) {
           	
                $abogados[$i]['No_CONTRATO'] = $key->No_CONTRATO ;
                $i++;
           	}
           	 $minimo = $this->Wizard_Model->getSalariomin();
           	$data = array('obligaciones' => json_encode($abogados), "Sminimo" => $minimo);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Obligaciones/obligaciones', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    	
    }
}
?>