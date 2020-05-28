<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Tareas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Tareas_Model");
        $this->load->model('Wizard_Model');
       
    }

    public function getTareas(){
    	if($this->session->userdata('login_ok')){
           	$tareas = $this->Tareas_Model->getTareas($this->session->userdata('identificacion'));
           	$tareasCount = $this->Tareas_Model->getNumeroTareas($this->session->userdata('identificacion'));

           	$datos = array('tareas' => $tareas, 'count' => $tareasCount);
            
            $this->load->view('Tareas/tareas', 	$datos );
           
          
        }else{
            $this->load->view('Login/login');
        }
    }

    function detalleTarea($idTarea){
        if($this->session->userdata('login_ok')){
            $tareas = $this->Tareas_Model->getTareabyId($idTarea);

            $datos = array('tareas' => $tareas);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Tareas/gestionExtrajudicial',  $datos );
             $this->load->view('Includes/footer');
          
        }else{
            $this->load->view('Login/login');
        }
    }


    function guardarTareas(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array( 'G738_C17186' => $_POST['contrato'],
                            'G738_C17187' => $user,
                            'G738_Usuario' => $this->session->userdata('identificacion'),
                            'G738_C17188' => $_POST['txtdescripcion'],
                            'G738_C17189' => 1,
                            'G738_C17190' => $_POST['id_cliente'],
                            'G738_C17191' => $_POST['mediocomunicacion'],
                            'G738_C17192' => $_POST['resultadocomunicacion'],
                            'G738_C17195' => $_POST['fechaProgramada'].' '.$_POST['HoraProgramada'],
                            'G738_C17196' => $_POST['fechaProgramada'].' '.$_POST['HoraProgramada'],
                            'G738_C17197' => $_POST['nombrecliente'],
                            'Dedonde' => $_POST['tipificacion']
                            );

            if($this->Wizard_Model->guardardatos('G738', $datos)){
                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function EditarTareas(){
        if($this->session->userdata('login_ok')){
           

            $datos = array( 
                            'G738_C17189' => 2
                            );

            if($this->Wizard_Model->editarDatos('G738', $datos, $_POST['id'], 'G738_ConsInte__b')){
                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            $this->load->view('Login/login');
        }
    }

}
?>