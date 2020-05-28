<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Extrajudicial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("CarteraFng_Model");
        $this->load->model("Obligaciones_Model");
        $this->load->model("Wizard_Model");
        $this->load->model("Extrajudicial_Model");
        $this->load->model("Configuraciones_Model");
        
    }

    public function index() {
        if($this->session->userdata('login_ok')){
			
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
			
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/index');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }   
    }
    public function valoradeudado(){
        if($this->session->userdata('login_ok')){
            
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/valoradeudado');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }   
    }
   

    public function clientesNuevos(){
        if($this->session->userdata('login_ok')){
			ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesNuevos();
            $total = $this->Extrajudicial_Model->gettotalClientesNuevos();
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
       
			$datosDelarray = array();
			$i = 0;
			foreach($clientes as $key){
				$fachas = explode(" ", $key->fecha);
				$fachas = explode("-",$fachas[0]);
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);

				$datosDelarray[$i]['deudor'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
				$datosDelarray[$i]['identificacion'] = $key->identificacion ;
				$datosDelarray[$i]['intemediario'] = utf8_encode($key->intemediario) ;
				$datosDelarray[$i]['valor'] =  "$".number_format($key->valor, 0, '.',',');
				$datosDelarray[$i]['fecha'] = "<span style='display: none;'>".$fachas[0]."/".$fachas[1]."/".$fachas[2]."</span>".$fachas[2]."/".$fachas[1]."/".$fachas[0];
				$datosDelarray[$i]['Rol'] = $key->Rol ;

                $datosDelarray[$i]['contrato'] = $key->liquidacion;
                
                
				$i++;
			}
			
			$datos = array('clientes' => json_encode($datosDelarray),'procesos' => $total );
            
			$this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesNuevos', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function getDatosNuevosJson(){
        if($this->session->userdata('login_ok')){
            $varaiable = $_POST['tipo'];
            $data = array();
            $i = 0;

            if($varaiable == 0) {
                $clientes = $this->Extrajudicial_Model->getClientesDatoNuevo();
                $otrosCLientes = $this->Extrajudicial_Model->getCLentes_titular_datoNuevo();
                
                foreach($clientes as $key){
             

                    $this->db->select('NroIdentificacion');
                    $this->db->from('ClienteObligacion');
                    $this->db->join('InformacionCliente', 'Id = InformacionClientesId');
                    $this->db->where('Rol = 1786');
                    $this->db->where('NumeroContratoId', $key->G743_C17267);
                    $cedula = $this->db->get();
                    /*echo 'Esta '.$key->G743_C17267."</br>";
                    if($cedula->num_rows() > 0)
                        echo "Tiene registro ".$key->G743_C17267."</br>" ;*/

                    $deudor = trim(utf8_encode($key->Nombre));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['Nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $data[$i]['identificacion'] = $cedula->row()->NroIdentificacion;
                    $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                    $data[$i]['telefono'] = $key->telefono;
                    $data[$i]['ciudad'] = $key->ciudad ;
                    $data[$i]['liquidacion'] = $key->liquidacion;
                    $i++;
                }

                foreach($otrosCLientes as $key){

                    $deudor = trim(utf8_encode($key->Nombre));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['Nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $data[$i]['identificacion'] =$key->identificacion ;
                    $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                    $data[$i]['telefono'] = $key->telefono;
                    $data[$i]['ciudad'] = $key->ciudad ;
                    $data[$i]['liquidacion'] = $key->liquidacion;
                    $i++;
                }

            }else if($varaiable == 1){
                $otrosCLientes = $this->Extrajudicial_Model->getCLentes_titular_datoNuevo();
                foreach($otrosCLientes as $key){

                    $deudor = trim(utf8_encode($key->Nombre));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['Nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $data[$i]['identificacion'] =$key->identificacion ;
                    $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                    $data[$i]['telefono'] = $key->telefono;
                    $data[$i]['ciudad'] = $key->ciudad ;
                    $data[$i]['liquidacion'] = $key->liquidacion;
                    $i++;
                }

            }else if($varaiable == 2){

                $clientes = $this->Extrajudicial_Model->getClientesDatoNuevo();
                foreach($clientes as $key){
                    $this->db->select('NroIdentificacion');
                    $this->db->from('ClienteObligacion');
                    $this->db->join('InformacionCliente', 'Id = InformacionClientesId');
                    $this->db->where('Rol = 1786');
                    $this->db->where('NumeroContratoId', $key->G743_C17267);
                    $cedula = $this->db->get();
                    /*echo 'Esta '.$key->G743_C17267."</br>";
                    if($cedula->num_rows() > 0)
                        echo "Tiene registro ".$key->G743_C17267."</br>" ;*/

                    $deudor = trim(utf8_encode($key->Nombre));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['Nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $data[$i]['identificacion'] = $cedula->row()->NroIdentificacion;
                    $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                    $data[$i]['telefono'] = $key->telefono;
                    $data[$i]['ciudad'] = $key->ciudad ;
                    $data[$i]['liquidacion'] = $key->liquidacion;
                    $i++;
                }
            }
                
            echo json_encode($data);
        }else{
            echo "No tienes permisos para ver este contenido";
        }

    }

    public function clientesDatoNuevo(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesDatoNuevo();
            $otrosCLientes = $this->Extrajudicial_Model->getCLentes_titular_datoNuevo();
            $total = $this->Extrajudicial_Model->getTotalClientesDatoNuevo();



            $data = array();
            $i = 0;
            foreach($clientes as $key){
         

                $this->db->select('NroIdentificacion');
                $this->db->from('ClienteObligacion');
                $this->db->join('InformacionCliente', 'Id = InformacionClientesId');
                $this->db->where('Rol = 1786');
                $this->db->where('NumeroContratoId', $key->G743_C17267);
                $cedula = $this->db->get();
                /*echo 'Esta '.$key->G743_C17267."</br>";
                if($cedula->num_rows() > 0)
                    echo "Tiene registro ".$key->G743_C17267."</br>" ;*/

                $deudor = trim(utf8_encode($key->Nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['Nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] = $cedula->row()->NroIdentificacion;
                $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                $data[$i]['telefono'] = $key->telefono;
                $data[$i]['ciudad'] = $key->ciudad ;
                $data[$i]['liquidacion'] = $key->liquidacion;
                $i++;
            }

            foreach($otrosCLientes as $key){

                $deudor = trim(utf8_encode($key->Nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['Nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =$key->identificacion ;
                $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                $data[$i]['telefono'] = $key->telefono;
                $data[$i]['ciudad'] = $key->ciudad ;
                $data[$i]['liquidacion'] = $key->liquidacion;
                $i++;
            }
                           
            $datos = array('clientes' => json_encode($data), 'procesos' => $total );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesDatoNuevos', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }

    }

    function clientesmenosdedoce(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav3();


            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/menosdedoce', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmasdedocemenosveinticinco(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav24();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/masdedocemenosveinticinco', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmasdeveinticincomenoscincuenta(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav26();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/masdeveinticincomenoscincuenta', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmasdecincuentamenoscien(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav27();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesmasdecincuentamenoscien', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function clientesmascien(){
         if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getvistav28();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$".number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesmascien', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    function clientesConacuerdodepago(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesacuerdoPago();
            $total = $this->Extrajudicial_Model->getTotalClientesacuerdoPago();

            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = explode(" ", $key->fecha_legal)[0];
                $fecha = explode("-", $fecha);

                $deudor = trim(utf8_encode($key->Nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['Nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                //$data[$i]['contrato'] = $key->contrato;
                $data[$i]['fecha_legal'] = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0] ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data), 'procesos' => $total );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/clientesAcuerdoPago', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    function clientesSingestionquinceDias(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getClientesSingestionquincedias();
           // $total = $this->Extrajudicial_Model->getTotalClientesSingestionquincedias();
           
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
            

            $data = array();
            $i = 0;
            foreach($clientes as $key){
               
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['deudor'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['financiera'] = utf8_encode($key->financiera);
                $data[$i]['contrato'] = $key->liquidacion;
                $data[$i]['valor_pagado'] = '$'.number_format($key->valor_pagado, 0, '.',',') ;

                $i++;
            }

            $datos = array('clientes' => json_encode($data) );

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/quincedias', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function misclientesVigentes(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getMisclietesVigentes();
           // $total = $this->Extrajudicial_Model->getTotalMisClientesVigentes();

            $data = array();
            $i = 0;
            

            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['deudor'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                $fecha = NULL;
                if(!is_null($key->garantia)){
                    $fecha = explode(" ", $key->garantia)[0];
                    $fecha = explode("-", $fecha);
                    $fecha = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                }
                 

                $data[$i]['garantia'] = $fecha ;
                $data[$i]['valor'] = '$'.number_format($key->valor, 0, '.',',') ;

                $i++;
            }


            $datos = array('clientes' => json_encode($data) );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/misclientesVigentes', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function Exfuncionarios(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getExfuncionarios();
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->contrato;
                $data[$i]['valor_pagado'] = '$'.number_format($key->valor_pagado,0,'.',',')  ;
                $data[$i]['rol'] = utf8_encode($key->rol) ;
                $i++;
            }
            


            $datos = array('clientes' => json_encode($data) );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExfuncionarios');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/Exfuncionarios', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function ObligacinesVendidas(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getObligaciones_Vendidas();
            
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = null;
                if(!is_null($key->fecha_venta))
                $fecha = explode(" ",$key->fecha_venta)[0];
                $fecha = explode("-",$fecha);
                $fecha = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                $data[$i]['valor_pagado'] = '$'.number_format($key->valor_pagado,0,'.',',') ;
                $data[$i]['fecha_venta'] =  $fecha;
    
                $i++;
            }

            $datos = array('clientes' => json_encode($data) );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/ObligacinesVendidas', $datos);
           $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    function PazySalvo(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->Extrajudicial_Model->getObligacionesPazSalvo();
            $total = $this->Extrajudicial_Model->gettotalObligacionesPazSalvo();

            $data = array();
            $i = 0;
            foreach($clientes as $key){ 
                $fecha = explode(" ",$key->fecha)[0];
                $fecha = explode("-",$fecha);
                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->liquidacion;
                $data[$i]['valor_pagado'] = "$".number_format($key->valor_pagado, 0, '.',',') ;
                $data[$i]['financiera'] = utf8_encode($key->financiera);
                $data[$i]['fecha'] = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                $i++;
            }
            

            $datos = array('clientes' => json_encode($data), 'procesos' => $total );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/PazySalvo', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function busquedaAvanzada(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M'); 
            $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
            $filtro = $this->CarteraFng_Model->getFiltrosbusqueda();
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
			
			$datosRary = array();
			$i = 0;
			foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->DEUDOR));
                $nombre = substr($deudor, 0, 3);
                $datosRary[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    
				$datosRary[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
				$datosRary[$i]['INTERMEDIARIO'] =  utf8_encode($key->INTERMEDIARIO) ;
                $datosRary[$i]['OBLIGACION'] = $key->LIQUIDACION ;
				$datosRary[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
				$datosRary[$i]['VALOR_PAGADO'] = "$".number_format($key->VALOR_PAGADO,  0, '.',',') ;
				$datosRary[$i]['ROL'] =  utf8_encode($key->ROL) ;
				$datosRary[$i]['CIUDAD_DOMICILIO'] =  utf8_encode($key->CIUDAD_DOMICILIO) ;
				$i++;
			}

            $datos = array('clientes' => json_encode($datosRary), 'filtros' => $filtro);

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/busquedaAvanzada', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function gestionar($identificacion, $vista=null){
        if($this->session->userdata('login_ok')){

            $clientes = $this->Obligaciones_Model->getDatosersonales($identificacion);
            $idUduario = $this->Obligaciones_Model->getIdUsuario($identificacion);
            $contratos = 0;

            $liquidaciones = $this->Obligaciones_Model->getLiquidacionesNumero_S($idUduario);
            $valores= array();
            $i=0;
            $numeroLiquidaciones = $this->Obligaciones_Model->getLiquidacionesNumero($idUduario);
            $numeroLiquidaciones2 = $this->Obligaciones_Model->getLiquidacionesNumero($idUduario);


            if($numeroLiquidaciones2 < 1){
                $contratos = $this->Obligaciones_Model->getContratos($idUduario);
                if($contratos != 0){
                    foreach ($contratos as $key2) {
                        $valores[$i]['contrato'] = $key2->OBLIGACION;
                        $valores[$i]['if'] = $key2->financiero;
                        $valores[$i]['No_CONTRATO'] = $key2->No_CONTRATO;
                        $i++;
                    }
                }
            }else{
                $contratos = $this->Obligaciones_Model->getLiquidaciones($idUduario);
                if($contratos != 0){
                    foreach ($contratos as $key2) {
                       $valores[$i]['contrato'] = $key2->liquidacion;
                       $valores[$i]['if'] = 'Jose';
                       $valores[$i]['No_CONTRATO'] = 2;
                       $i++;
                    }
                }
            }
                
            
            //$contratos = $this->Obligaciones_Model->getLiquidaciones($idUduario);

            //if($contratos == 0){
            //    $contratos = $this->Obligaciones_Model->getContratos($idUduario);
            //}
            $obligacioes = $this->Obligaciones_Model->getContratos($idUduario);
            $minimo = $this->Wizard_Model->getSalariomin();
            
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
	        $ciudades = $this->Configuraciones_Model->getCiudades();
            $calificacion = $this->CarteraFng_Model->getListasLisop(198);
            $abogados = $this->Wizard_Model->getDatosAdicionales($idUduario);
            $datosw = array();
            $i = 0;
            foreach ($abogados as $key) {

                $fecha = explode(" ", $key->Fecha)[0];
                $fecha = explode("-", $fecha);

                                        
                $datosw[$i]['id'] = $key->id;
                $datosw[$i]['obligaciones'] = utf8_encode($key->obligacion);
                $datosw[$i]['deudor'] = utf8_encode($key->deudor);
                $datosw[$i]['rol'] = utf8_encode($key->rol);

                $datosw[$i]['CORREO_ELECTRONICO'] = utf8_encode($key->Correo_electronico);
                $datosw[$i]['TELEFONO'] = utf8_encode($key->Telefono);
                $datosw[$i]['DIRECCION'] = utf8_encode($key->Direccion);
                $datosw[$i]['CIUDAD'] = utf8_encode($key->Ciudad);
                $datosw[$i]['DESCRIPCION'] = utf8_encode($key->Descripcion);
                $datosw[$i]['Calificacion_correo'] = utf8_encode($key->Calificacion_correo);
                $datosw[$i]['Calificacion_telefono'] = utf8_encode($key->Calificacion_telefono);
                $datosw[$i]['Calificacion_direccion'] = utf8_encode($key->Calificacion_direccion);
                $datosw[$i]['Calificacion_ciudad'] = utf8_encode($key->Calificacion_ciudad);
                $datosw[$i]['DESCRIPCION'] = utf8_encode($key->Descripcion);
                $datosw[$i]['fecha'] = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                $i++;
            }

            $datosIniciales =array();
            $j = 0;
            $iniciales = $this->Configuraciones_Model->getDatosinicialesCalificados($idUduario);
            foreach ($iniciales as $key) {
                $fecha2 = null;
                if(!is_null($key->fecha_modificacion)){
                    $fecha = explode(" ", $key->fecha_modificacion)[0];
                    $fecha = explode("-", $fecha);
                    $fecha2 = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                }

                $datosIniciales[$j]['ciudadDomicilio'] = $key->ciudadDomicilio ;
                $datosIniciales[$j]['ciudadOficina'] = $key->ciudadOficina ;
                $datosIniciales[$j]['tefonoOficina'] = $key->tefonoOficina ;
                $datosIniciales[$j]['telefonoDomicilio'] = $key->telefonoDomicilio ; 
                $datosIniciales[$j]['celular'] = $key->celular ;
                $datosIniciales[$j]['celularAdicional'] = $key->celularAdicional ;
                $datosIniciales[$j]['mail'] = $key->mail ;
                $datosIniciales[$j]['direccionDomicilio'] = $key->direccionDomicilio ;
                $datosIniciales[$j]['direccionOficina'] = $key->direccionOficina ;
                $datosIniciales[$j]['dir_Adicional'] = $key->dir_Adicional ;
                $datosIniciales[$j]['tele_adicional'] = $key->tele_adicional ;
                $datosIniciales[$j]['ciudad_adicional'] = $key->ciudad_adicional ;
                $datosIniciales[$j]['cal_ciudadDomicilio'] = $key->cal_ciudadDomicilio ;
                $datosIniciales[$j]['cal_ciudadOficina'] = $key->cal_ciudadOficina ;
                $datosIniciales[$j]['cal_tefonoOficina'] = $key->cal_tefonoOficina ;
                $datosIniciales[$j]['cal_telefonoDomicilio'] = $key->cal_telefonoDomicilio ;
                $datosIniciales[$j]['cal_celular'] = $key->cal_celular ;
                $datosIniciales[$j]['cal_celularAdicional'] = $key->cal_celularAdicional ;
                $datosIniciales[$j]['cal_mail'] = $key->cal_mail ;
                $datosIniciales[$j]['cal_direccionDomicilio'] = $key->cal_direccionDomicilio ;
                $datosIniciales[$j]['cal_direccionOficina'] = $key->cal_direccionOficina ;
                $datosIniciales[$j]['cal_dir_Adicional'] = $key->cal_dir_Adicional ;
                $datosIniciales[$j]['cal_tele_adicional'] = $key->cal_tele_adicional ;
                $datosIniciales[$j]['cal_ciudad_adicional'] = $key->cal_ciudad_adicional ;
                $datosIniciales[$j]['fecha_modificacion'] = $fecha2 ;
                $datosIniciales[$j]['id_log_datos'] = $key->id_log_datos;
                $j++;
            }
           



            $datos = array();
            if($vista != null){
                $datos = array('iniciales'=> json_encode($datosIniciales), 'vista' => $vista, 'ciudades' => $ciudades, 'calificacion' => $calificacion,  'datosadicionales' => json_encode($datosw), 'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, 'idUsuario' => $idUduario, 'contratos' => $valores, 'numeroLiquidaciones' => $numeroLiquidaciones, 'obligaciones' =>  $obligacioes);
            }else{
                $datos = array('iniciales'=> json_encode($datosIniciales), 'datosadicionales' => json_encode($datosw), 'ciudades' => $ciudades, 'calificacion' => $calificacion,  'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, 'idUsuario' => $idUduario, 'contratos' => $valores, 'numeroLiquidaciones' => $numeroLiquidaciones, 'obligaciones' =>  $obligacioes);
            }
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Extrajudicial/gestiones', $datos);
			$this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }




    public function buscar(){
        if($this->session->userdata('login_ok')){
             ini_set('memory_limit', '1024M');  
            if(isset($_POST['filtros'])){
                $filtros = $_POST['filtros'];
                $jose = array();    
               
                foreach ($filtros as $key) {
                    if(count($key) > 0){
                        if($key != 'NOHAYUNCULO'){
                            
                            $pos = strpos($key, '$');
                            if($pos === false){

                                $Jose = strpos($key, '-');
                                if($Jose === false){
                                    
                                }else{
                                    $array = explode('-', $key);
                                    if(!empty($array)){
                                        $jose[$array[0]] = $array[1];
                                    }

                                     
                                }


                                $Jos = strpos($key, '=>');
                                if($Jos === false){
                                
                                }else{
                                    $array = explode("=>", $key);
                                    if(count($array) > 1){
                                        if(!is_null($array[2]) && $array[2] != ''){

                                            $Jos = strpos($key, '/');
                                            if($Jos === false){
                                                $this->db->where($array[0]." BETWEEN '".$array[1]."' AND '".$array[2]."'"); 
                                            }else{
                                                $fecha1 = explode('/', $array[1]);
                                            
                                                //$jose[$array[0].' > '] = $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                                                $fecha3 =  $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                                                $fecha2 = explode('/', $array[2]);
                                                //$jose[$array[0].' < '] = $fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
                                                $fecha4 = $fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
                                                
                                                
                                                $this->db->where($array[0]." BETWEEN '".$fecha3."' AND '".$fecha4."'"); 
                                            }
                                            
                                        }else{
                                            $fecha1 = explode('/', $array[1]);
                                            $jose[$array[0]] = $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                                        }
                                    }
                                    
                                }
                            }else{
                                $array = explode('$', $key);
                                $this->db->like($array[0], trim($array[1]));
                            }

                        }
                    }
                    
                       
                }
                $value = count($jose);
                
                $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada($jose);
                $data = array();
                $i = 0;
                foreach($clientes as $key){
                    $deudor = trim(utf8_encode($key->DEUDOR));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                

                    $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
                    $data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                    $data[$i]['OBLIGACION'] = $key->LIQUIDACION ;
                    /*if($key->LIQUIDACION != '' && !is_null($key->LIQUIDACION)){
                       
                    }else{
                        $data[$i]['OBLIGACION'] = $key->OBLIGACION ;
                    }*/

                    $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
                    $data[$i]['VALOR_PAGADO'] = "$".number_format($key->VALOR_PAGADO,  0, '.',',');
                    $data[$i]['ROL'] = utf8_encode($key->ROL) ;
                    $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
                    $i++;
                }
                echo json_encode($data);
            }else{
                $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
                $data = array();
                $i = 0;
                foreach($clientes as $key){
                    
                    $deudor = trim(utf8_encode($key->DEUDOR));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                
                    $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
                    $data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                    $data[$i]['OBLIGACION'] = $key->LIQUIDACION ;
                    /*if($key->LIQUIDACION != '' && !is_null($key->LIQUIDACION)){
                       
                    }else{
                        $data[$i]['OBLIGACION'] = $key->OBLIGACION ;
                    }*/
                    $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
                    $data[$i]['VALOR_PAGADO'] ="$".number_format($key->VALOR_PAGADO,  0, '.',',');
                    $data[$i]['ROL'] = utf8_encode($key->ROL) ;
                    $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
                    $i++;
                }
                echo json_encode($data);
            }
            
        }else{
            echo "no tienes permisos para ver esto";
        }
    }

    function buscar2(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
           
            $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
			$data = array();
			$i = 0;
            foreach($clientes as $key){
				$deudor = trim(utf8_encode($key->DEUDOR));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                
				$data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
				$data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                
				$data[$i]['OBLIGACION'] = $key->LIQUIDACION ;
                /*if($key->LIQUIDACION != '' && !is_null($key->LIQUIDACION)){ 
                }else{
                    $data[$i]['OBLIGACION'] = $key->OBLIGACION ;
                }*/
				$data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
				$data[$i]['VALOR_PAGADO'] ="$".number_format($key->VALOR_PAGADO,  0, '.',',')  ;
				$data[$i]['ROL'] = utf8_encode($key->ROL) ;
				$data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
				$i++;
			}
            echo json_encode($data);
        }else{
            echo "no tienes permisos para ver esto";
        }
    }


    function buscarPor15(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $this->load->model('Extrajudicial_Model');

            $clientes = $this->Extrajudicial_Model->getClientesSingestionquincedias();
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->deudor));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                
                $data[$i]['IDENTIFICACION'] = $key->identificacion ;
                $data[$i]['INTERMEDIARIO'] = utf8_encode($key->financiera) ;
                $data[$i]['OBLIGACION'] = $key->liquidacion ;
                $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
                $data[$i]['VALOR_PAGADO'] ="$".number_format($key->valor_pagado,  0, '.',',')  ;
                $data[$i]['ROL'] = utf8_encode($key->ROL) ;
                $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
                $i++;
            }
            echo json_encode($data);

        }else{
            echo "No tiene permisos para ver esta información!";
        }
    }

    

}

?>
