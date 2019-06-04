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
   

    public function clientesNuevos(){
        if($this->session->userdata('login_ok')){
			
            $clientes = $this->Extrajudicial_Model->getClientesNuevos();
            $total = $this->Extrajudicial_Model->gettotalClientesNuevos();
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
       
			$datosDelarray = array();
			$i = 0;
			foreach($clientes as $key){
				$fachas = explode(" ", $key->fecha);
				$fachas = explode("-",$fachas[0]);

                
				$datosDelarray[$i]['deudor'] = utf8_encode($key->deudor) ;
				$datosDelarray[$i]['identificacion'] = $key->identificacion ;
				$datosDelarray[$i]['intemediario'] = utf8_encode($key->intemediario) ;
				$datosDelarray[$i]['valor'] = "$".number_format($key->valor, 0, ",", ".");
				$datosDelarray[$i]['fecha'] = $fachas[2]."/".$fachas[1]."/".$fachas[0];
				$datosDelarray[$i]['G737_C17183'] = $key->G737_C17183 ;
                $datosDelarray[$i]['contrato'] = $key->contrato;
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

    public function clientesDatoNuevo(){
        
        if($this->session->userdata('login_ok')){

            $clientes = $this->Extrajudicial_Model->getClientesDatoNuevo();
            $total = $this->Extrajudicial_Model->getTotalClientesDatoNuevo();



            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $data[$i]['identificacion'] =$key->identificacion ;
                $data[$i]['direccion'] =  utf8_encode($key->direccion) ;
                $data[$i]['telefono'] = $key->telefono;
                $data[$i]['ciudad'] = $key->ciudad ;
                $data[$i]['Nombre'] =  utf8_encode($key->Nombre) ;
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

            /*$this->db->select(" CAST(G758_C17367 AS float) * 12 AS JOSE");
            $this->db->from('G758');
            $clientes = $this->db->get();*/

            $clientes = $this->Extrajudicial_Model->getvistav3();
            //var_dump($clientes);
           // echo $clientes->row()->JOSE;
            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $data[$i]['nombre'] =utf8_encode($key->nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$ ".number_format($key->valor_pagado, 0, ',','.');

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

            $clientes = $this->Extrajudicial_Model->getvistav24();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $data[$i]['nombre'] =utf8_encode($key->nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$ ".number_format($key->valor_pagado, 0, ',','.');

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

            $clientes = $this->Extrajudicial_Model->getvistav26();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $data[$i]['nombre'] =utf8_encode($key->nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$ ".number_format($key->valor_pagado, 0, ',','.');

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

            $clientes = $this->Extrajudicial_Model->getvistav27();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $data[$i]['nombre'] =utf8_encode($key->nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$ ".number_format($key->valor_pagado, 0, ',','.');

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

            $clientes = $this->Extrajudicial_Model->getvistav28();


            $data = array();
            $i = 0;
            foreach($clientes as $key){

                $data[$i]['nombre'] =utf8_encode($key->nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['valor'] = "$ ".number_format($key->valor_pagado, 0, ',','.');

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

            $clientes = $this->Extrajudicial_Model->getClientesacuerdoPago();
            $total = $this->Extrajudicial_Model->getTotalClientesacuerdoPago();

            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = explode(" ", $key->fecha_legal)[0];
                $fecha = explode("-", $fecha);
                $data[$i]['Nombre'] =utf8_encode($key->Nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->contrato;
                $data[$i]['fecha_legal'] = $fecha[2]."/".$fecha[1]."/".$fecha[0] ;

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

            $clientes = $this->Extrajudicial_Model->getClientesSingestionquincedias();
            $total = $this->Extrajudicial_Model->getTotalClientesSingestionquincedias();
            $datos = array('clientes' => $clientes, 'procesos' => $total );
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
         
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

            $clientes = $this->Extrajudicial_Model->getMisclietesVigentes();
           // $total = $this->Extrajudicial_Model->getTotalMisClientesVigentes();

            $data = array();
            $i = 0;
            

            foreach($clientes as $key){
                $data[$i]['deudor'] = '<b>'.utf8_encode($key->deudor).'</b>' ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->contrato;
                $data[$i]['valor'] = '$ '.number_format($key->valor, 0, ',','.');

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

            $clientes = $this->Extrajudicial_Model->getExfuncionarios();
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = explode(" ", $key->fecha_legal)[0];
                $fecha = explode("-", $fecha);
                $data[$i]['nombre'] =utf8_encode($key->nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->contrato;
                $data[$i]['valor_pagado'] = '$ '.number_format($key->valor_pagado,0,'.',',') ;
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

            $clientes = $this->Extrajudicial_Model->getObligaciones_Vendidas();
            $total = $this->Extrajudicial_Model->getTotalObligaciones_Vendidas();
            $datos = array('clientes' => $clientes, 'procesos' => $total );
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

            $clientes = $this->Extrajudicial_Model->getObligacionesPazSalvo();
            $total = $this->Extrajudicial_Model->gettotalObligacionesPazSalvo();

            $data = array();
            $i = 0;
            foreach($clientes as $key){ 
                $fecha = explode(" ",$key->fecha)[0];
                $fecha = explode("-",$fecha);
                $data[$i]['nombre'] =utf8_encode($key->nombre) ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['contrato'] = $key->contrato;
                $data[$i]['valor_pagado'] = "$ ".number_format($key->valor_pagado, 0, ',','.');
                $data[$i]['financiera'] = utf8_encode($key->financiera);
                $data[$i]['fecha'] = $fecha[2]."/".$fecha[1]."/".$fecha[0];
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
                
            $clientes = $this->CarteraFng_Model->getDatosbusquedaAvanzada();
            $filtro = $this->CarteraFng_Model->getFiltrosbusqueda();
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
			
			$datosRary = array();
			$i = 0;
			foreach($clientes as $key){
				$datosRary[$i]['DEUDOR'] = utf8_encode($key->DEUDOR) ;
				$datosRary[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
				$datosRary[$i]['INTERMEDIARIO'] =  utf8_encode($key->INTERMEDIARIO) ;
				$datosRary[$i]['OBLIGACION'] = $key->OBLIGACION ;
				$datosRary[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
				$datosRary[$i]['VALOR_PAGADO'] = "$ ".number_format($key->VALOR_PAGADO,  0, ","  ,".") ;
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
            $contratos = $this->Obligaciones_Model->getContratos($idUduario);
            $minimo = $this->Wizard_Model->getSalariomin();
            
			$datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIExtrajudicial');
	        $ciudades = $this->Configuraciones_Model->getCiudades();
            $calificacion = $this->CarteraFng_Model->getListasLisop(198);
            $abogados = $this->Wizard_Model->getDatosAdicionales($idUduario);
            $abogados = $this->Wizard_Model->getDatosAdicionales($idUduario);
            $datosw = array();
            $i = 0;
            foreach ($abogados as $key) {

                $fecha = explode(" ", $key->Fecha)[0];
                $fecha = explode("-", $fecha);


                $datosw[$i]['id'] = $key->id;
                $datosw[$i]['CORREO_ELECTRONICO'] = $key->Correo_electronico;
                $datosw[$i]['TELEFONO'] = $key->Telefono;
                $datosw[$i]['DIRECCION'] = utf8_encode($key->Direccion);
                $datosw[$i]['CIUDAD'] = utf8_encode($key->Ciudad);
                $datosw[$i]['Calificacion_correo'] = $key->Calificacion_correo;
                $datosw[$i]['Calificacion_telefono'] = $key->Calificacion_telefono;
                $datosw[$i]['Calificacion_direccion'] = $key->Calificacion_direccion;
                $datosw[$i]['Calificacion_ciudad'] = $key->Calificacion_ciudad;
                $datosw[$i]['Calificacion_descripcion'] = $key->Calificacion_descripcion;
                
                $datosw[$i]['DESCRIPCION'] = utf8_encode($key->Descripcion);
                $datosw[$i]['fecha'] = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                $i++;
            }

            $datos = array();
            if($vista != null){
                $datos = array('vista' => $vista, 'ciudades' => $ciudades, 'calificacion' => $calificacion,  'datosadicionales' => json_encode($datosw), 'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, 'idUsuario' => $idUduario, 'contratos' => $contratos);
            }else{
                $datos = array('datosadicionales' => json_encode($datosw), 'ciudades' => $ciudades, 'calificacion' => $calificacion,  'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, 'idUsuario' => $idUduario, 'contratos' => $contratos);
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
}

?>
