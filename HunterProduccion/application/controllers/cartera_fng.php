<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Cartera_fng extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("CarteraFng_Model");
        $this->load->model("Obligaciones_Model");
        $this->load->model("Wizard_Model");
        $this->load->model("Configuraciones_Model");
        $this->load->model("Reportes_Model");
        
        
    }

    public function index() {
        if($this->session->userdata('login_ok')){
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIjudicial');
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/gestionJudicial');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
        
    }


    public function gestionJudicial() {
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->CarteraFng_Model->getProcesosVigentes();
            $total = $this->CarteraFng_Model->gettotalProcesosVigentes();
            
            $datosDelarray = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->cliente));
                $nombre = substr($deudor, 0, 3);
                $datosDelarray[$i]['cliente'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                

                $datosDelarray[$i]['SAP'] = $key->SAP ;
                //$datosDelarray[$i]['cliente'] = utf8_encode($key->cliente) ;
                $datosDelarray[$i]['identificacion'] = $key->identificacion ;
                $datosDelarray[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                $datosDelarray[$i]['banco'] = utf8_encode($key->banco) ;
                $datosDelarray[$i]['jusgado'] = utf8_encode($key->jusgado) ;
                $datosDelarray[$i]['radicado'] = $key->radicado ;
                $datosDelarray[$i]['ciudad'] = utf8_encode($key->ciudad) ;
                $datosDelarray[$i]['abogado'] = utf8_encode($key->abogado) ;
                
                
                $i++;
            }
            
            $datos = array('clientes' => json_encode($datosDelarray), 'procesos' => $total );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIjudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/Judicial', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }



    public function procesosIrrecuperables(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->CarteraFng_Model->getProcesosIrrecuperables();
            $total = $this->CarteraFng_Model->gettotalProcesosIrrecuperables();

            $datosDelarray = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = NULL;
                if(!is_null($key->Fecha_Factura)){
                    $fecha = explode(" ",$key->Fecha_Factura)[0];
                    $fecha = explode("-", $fecha);
                    $fecha = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                }
                

                $deudor = trim(utf8_encode($key->cliente));
                $nombre = substr($deudor, 0, 3);
                $datosDelarray[$i]['cliente'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                

                
                $datosDelarray[$i]['identificacion'] = $key->identificacion ;
                 $datosDelarray[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                $datosDelarray[$i]['SAP'] = $key->SAP ;
                $datosDelarray[$i]['Fecha_Factura'] =   $fecha;
                $datosDelarray[$i]['No_Factura'] =$key->No_Factura ;
                $datosDelarray[$i]['No_contrato'] = $key->liquidacion ;
                $i++;
            }
            
         
            $datos = array('clientes' => json_encode($datosDelarray), 'procesos' => $total );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIjudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/Irrecuperables', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function procesosVendidos(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->CarteraFng_Model->getProcesosVendidos();
            $total = $this->CarteraFng_Model->gettotalProcesosVendidos();
            $datosDelarray = array();
            $i = 0;
            foreach($clientes as $key){
                $fecha = explode(" ",$key->Fecha_de_Venta )[0];
                $fecha = explode("-", $fecha);
                $deudor = trim(utf8_encode($key->cliente));
                $nombre = substr($deudor, 0, 3);
                $datosDelarray[$i]['cliente'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                
                $datosDelarray[$i]['identificacion'] = $key->identificacion ;
                $datosDelarray[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                $datosDelarray[$i]['SAP'] = $key->SAP ;
                if(!is_null($key->liquidacion)){
                    $datosDelarray[$i]['No_contrato'] = $key->liquidacion  ;
                }else{
                    $datosDelarray[$i]['No_contrato'] = $key->No_contrato  ; 
                }
                
                $datosDelarray[$i]['Fecha_de_Venta'] = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0] ;
                $i++;
            }
            

            $datos = array('clientes' =>  json_encode($datosDelarray), 'procesos' => $total );
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIjudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/Vendidos', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login'); 
        }
    }


    public function busquedaAvanzada(){
        if($this->session->userdata('login_ok')){
            //ini_set('memory_limit', '1024M'); 
//            $clientes = $this->Extrajudicial_Model->getDatosbusquedaAvanzada();
            $filtro = $this->CarteraFng_Model->getFiltrosbusqueda();
            $years = $this->CarteraFng_Model->getfechasyear();  
            $filtroBusquedaAvanzada = array();
            
            foreach ($filtro as $ke) {
              $filtroSelect = new stdClass();
              $filtroSelect->nombreFiltro = explode('-',utf8_encode($ke->Filtro))[1];
              $filtroSelect->valor ='G'.$ke->tabla.'.G'.$ke->tabla.'_C'.$ke->pregunta;
              $filtroSelect->esLisop = $ke->Lisop;
              $filtroSelect->eslista=$ke->tipoDato;
              $filtroSelect->campoLista=$ke->campoGuion;
              $filtroSelect->tabla=$ke->tablaGuion;
              array_push($filtroBusquedaAvanzada, $filtroSelect);
            }
            $filtroSelect = new stdClass();
            $filtroSelect->nombreFiltro = ' CLIENTES SIN GESTIÓN';
            $filtroSelect->valor = 'Busqueda15';
            $filtroSelect->esLisop = '';
              $filtroSelect->eslista='';
              $filtroSelect->campoLista='';
              $filtroSelect->tabla='G719';
            array_push($filtroBusquedaAvanzada, $filtroSelect);

            $filtroSelect = new stdClass();
            $filtroSelect->nombreFiltro = ' FECHA DE VENTA CISA';
            $filtroSelect->valor = 'Fechaventa';
            $filtroSelect->esLisop = '';
              $filtroSelect->eslista='';
              $filtroSelect->campoLista='';
              $filtroSelect->tabla='G719';
            array_push($filtroBusquedaAvanzada, $filtroSelect);

            
            

            sort($filtroBusquedaAvanzada);
            //var_dump($filtroBusquedaAvanzada);
                $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIjudicial');
                  $datos = array('filtros' => $filtroBusquedaAvanzada, 'fecha' => $years);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/busquedaAvanzada', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function Datosbusquedavanzadad(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');    
            
            $clientes = $this->CarteraFng_Model->getDatosbusquedaAvanzada();
            $data = array();
            $i= 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->DEUDOR));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                
                
                $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
                $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                $data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                $data[$i]['OBLIGACION'] = $key->LIQUIDACION ;
                $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
                $data[$i]['VALOR_PAGADO'] = "$".number_format($key->VALOR_PAGADO, 0, '.',',') ;
                $data[$i]['ROL'] = utf8_encode($key->ROL) ;
                $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
                
                $i++;
            }
             echo json_encode($data);
            
        }else{
            $this->load->view('Login/login');
        }
    }

     function completarZerosLiquidacion($liquidacion){
        $totalCaracteres =strlen($liquidacion);
        $zerosConcat = 0;
        
        if ($totalCaracteres >= 8) return $liquidacion;
        else{
            $zerosConcat =  10 - $totalCaracteres;
            for ($i = 0; $i < $zerosConcat; $i++) $liquidacion = '0'.$liquidacion;
        }
        return $liquidacion;

    }


     public function buscar(){
        if($this->session->userdata('login_ok')){
             ini_set('memory_limit', '1024M');  
            if(isset($_POST['filtros'])){
                $filtros = $_POST['filtros'];
                $jose = array();    
               
                foreach ($filtros as $key) {
                   
                    if(count($key) > 0){

                        if($key != 'No hay Resultados'){
                            
                            $pos = strpos($key, '$');
                            if($pos === false){

                                $Jose = strpos($key, '-');
                                if($Jose === false){
                                    
                                }else{
                                    $array = explode('-', $key);
                                    if(!empty($array)){
                                        if ($array[0] == 'G719.G719_C17423') $array[1] = $this->completarZerosLiquidacion($array[1]);
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
                
                $clientes = $this->CarteraFng_Model->getDatosbusquedaAvanzada($jose);

                $data = array();
                $i = 0;
                foreach($clientes as $key){
                    $deudor = trim(utf8_encode($key->DEUDOR));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                

                    $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
                    $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
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
                $clientes = $this->CarteraFng_Model->getDatosbusquedaAvanzada();
                $data = array();
                $i = 0;
                foreach($clientes as $key){
                    
                    $deudor = trim(utf8_encode($key->DEUDOR));
                    $nombre = substr($deudor, 0, 3);
                    $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                
                    $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
                    $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
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
            
            $clientes = $this->CarteraFng_Model->getDatosbusquedaAvanzada();
            $data = array();
            $i = 0;
            foreach($clientes as $key){
                $deudor = trim(utf8_encode($key->DEUDOR));
                $nombre = substr($deudor, 0, 3);
                $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                
                $data[$i]['IDENTIFICACION'] = $key->IDENTIFICACION ;
                $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                $data[$i]['INTERMEDIARIO'] = utf8_encode($key->INTERMEDIARIO) ;
                $data[$i]['OBLIGACION'] = $key->LIQUIDACION;
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

    

    function getdatosAdicionales($idUduario){
       if($this->session->userdata('login_ok')){
            $abogados = $this->Wizard_Model->getDatosAdicionales($idUduario);
            $datosw = array();
            $i = 0;
            foreach ($abogados as $key) {

                $fecha = explode(" ", $key->Fecha)[0];
                $fecha = explode("-", $fecha);


                $datosw[$i]['id'] = $key->id;
                $datosw[$i]['obligaciones'] = $key->obligacion;
                $datosw[$i]['deudor'] = utf8_encode($key->deudor);
                $datosw[$i]['rol'] = $key->rol;
                
                $datosw[$i]['CORREO_ELECTRONICO'] = $key->Correo_electronico;
                $datosw[$i]['TELEFONO'] = $key->Telefono;
                $datosw[$i]['DIRECCION'] = utf8_encode($key->Direccion);
                $datosw[$i]['CIUDAD'] = utf8_encode($key->Ciudad);
            
                $datosw[$i]['DESCRIPCION'] = utf8_encode($key->Descripcion);
                $datosw[$i]['Calificacion_correo'] = $key->Calificacion_correo;
                $datosw[$i]['Calificacion_telefono'] = $key->Calificacion_telefono;
                $datosw[$i]['Calificacion_direccion'] = $key->Calificacion_direccion;
                $datosw[$i]['Calificacion_ciudad'] = $key->Calificacion_ciudad;
                $datosw[$i]['DESCRIPCION'] = utf8_encode($key->Descripcion);
                $datosw[$i]['fecha'] = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                $i++;
            }

            echo json_encode($datosw);
            
       }else{
        echo "No hay permisos par ver esta información";
       } 
    }

    public function datosJudiciales($identificacion, $vista=null){
        if($this->session->userdata('login_ok')){
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIjudicial');
            
            $clientes = $this->Obligaciones_Model->getDatosersonales($identificacion);
            $idUduario = $this->Obligaciones_Model->getIdUsuario($identificacion);
            $contratos = 0;
            $liquidaciones = $this->Obligaciones_Model->getLiquidacionesNumero_S($idUduario);
            $valores= array();
            $i=0;
            $numeroLiquidaciones = $this->Obligaciones_Model->getLiquidacionesNumero($idUduario);
            $numeroLiquidaciones2 = $this->Obligaciones_Model->getLiquidacionesNumero($idUduario);
            $obligacioes = array();

            if($numeroLiquidaciones2 < 1){
                $contratos = $this->Obligaciones_Model->getContratos($idUduario);
                if($contratos != 0){
                    foreach ($contratos as $key2) {
                        $valores[$i]['contrato'] = $key2->OBLIGACION;
                        $valores[$i]['if'] = $key2->financiero;
                        $valores[$i]['No_CONTRATO'] = $key2->No_CONTRATO;
                        
                        $obligacioes[$i]['contrato'] = $key2->No_CONTRATO;
                        $obligacioes[$i]['if'] = 'Jose';
                        $obligacioes[$i]['No_CONTRATO'] = 2;

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

                       $obligacioes[$i]['contrato'] = $key2->liquidacion;
                       $obligacioes[$i]['if'] = 'Jose';
                       $obligacioes[$i]['No_CONTRATO'] = 2;
                       
                       $i++;
                    }
                }
            }



            //$obligacioes = $this->Obligaciones_Model->getContratos($idUduario);



            $minimo = $this->Wizard_Model->getSalariomin();

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
                $datosw[$i]['fecha'] = $fecha[2]."/".$fecha[1]."/".$fecha[0];
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
                    $fecha2 = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                }

                $datosIniciales[$j]['ciudadDomicilio'] = utf8_encode($key->ciudadDomicilio) ;
                $datosIniciales[$j]['ciudadOficina'] = utf8_encode($key->ciudadOficina) ;
                $datosIniciales[$j]['tefonoOficina'] = utf8_encode($key->tefonoOficina) ;
                $datosIniciales[$j]['telefonoDomicilio'] = utf8_encode($key->telefonoDomicilio) ; 
                $datosIniciales[$j]['celular'] = utf8_encode($key->celular) ;
                $datosIniciales[$j]['celularAdicional'] = utf8_encode($key->celularAdicional) ;
                $datosIniciales[$j]['mail'] = utf8_encode($key->mail) ;
                $datosIniciales[$j]['direccionDomicilio'] = utf8_encode($key->direccionDomicilio) ;
                $datosIniciales[$j]['direccionOficina'] = utf8_encode($key->direccionOficina) ;
                $datosIniciales[$j]['dir_Adicional'] = utf8_encode($key->dir_Adicional) ;
                $datosIniciales[$j]['tele_adicional'] = utf8_encode($key->tele_adicional) ;
                $datosIniciales[$j]['ciudad_adicional'] = utf8_encode($key->ciudad_adicional) ;
                $datosIniciales[$j]['cal_ciudadDomicilio'] = utf8_encode($key->cal_ciudadDomicilio) ;
                $datosIniciales[$j]['cal_ciudadOficina'] = utf8_encode($key->cal_ciudadOficina) ;
                $datosIniciales[$j]['cal_tefonoOficina'] = utf8_encode($key->cal_tefonoOficina) ;
                $datosIniciales[$j]['cal_telefonoDomicilio'] = utf8_encode($key->cal_telefonoDomicilio) ;
                $datosIniciales[$j]['cal_celular'] = utf8_encode($key->cal_celular) ;
                $datosIniciales[$j]['cal_celularAdicional'] = utf8_encode($key->cal_celularAdicional) ;
                $datosIniciales[$j]['cal_mail'] = utf8_encode($key->cal_mail) ;
                $datosIniciales[$j]['cal_direccionDomicilio'] = utf8_encode($key->cal_direccionDomicilio) ;
                $datosIniciales[$j]['cal_direccionOficina'] = utf8_encode($key->cal_direccionOficina) ;
                $datosIniciales[$j]['cal_dir_Adicional'] = utf8_encode($key->cal_dir_Adicional) ;
                $datosIniciales[$j]['cal_tele_adicional'] = utf8_encode($key->cal_tele_adicional) ;
                $datosIniciales[$j]['cal_ciudad_adicional'] = utf8_encode($key->cal_ciudad_adicional) ;
                $datosIniciales[$j]['fecha_modificacion'] = $fecha2 ;
                $datosIniciales[$j]['id_log_datos'] = $key->id_log_datos;
                $j++;
            }
           

            $ciudades = $this->Configuraciones_Model->getCiudades();
            $calificacion = $this->CarteraFng_Model->getListasLisop(198);

            $datos = array();
            if($vista != null){
                $datos = array('iniciales'=> json_encode($datosIniciales), 'vista' => $vista, 'ciudades' => $ciudades, 'ciudades2' => $ciudades, 'ciudades3' => $ciudades,  'calificacion' => $calificacion, 'datosadicionales' => json_encode($datosw), 'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, 'idUsuario' => $idUduario, 'contratos' => $valores, 'numeroLiquidaciones' => $numeroLiquidaciones, 'obligaciones' =>  $obligacioes, 'masliquidaciones' => $numeroLiquidaciones2);
            }else{
                $datos = array('iniciales'=> json_encode($datosIniciales), 'ciudades' => $ciudades, 'ciudades2' => $ciudades, 'ciudades3' => $ciudades, 'calificacion' => $calificacion, 'datosadicionales' => json_encode($datosw), 'Sminimo' => $minimo, 'cliente' => $clientes, 'otrosDatos' => $clientes, 'identificacion' => $identificacion, 'idUsuario' => $idUduario, 'contratos' => $valores, 'numeroLiquidaciones' => $numeroLiquidaciones, 'obligaciones' =>  $obligacioes, 'masliquidaciones' => $numeroLiquidaciones2);
            }
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/datosJudiciales', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function getdatosIniciales($idUduario){
        if($this->session->userdata('login_ok')){
            $datosIniciales =array();
            $j = 0;
            $iniciales = $this->Configuraciones_Model->getDatosinicialesCalificados($idUduario);
            foreach ($iniciales as $key) {
                $fecha2 = null;
                if(!is_null($key->fecha_modificacion)){
                    $fecha = explode(" ", $key->fecha_modificacion)[0];
                    $fecha = explode("-", $fecha);
                    $fecha2 = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                }

                $datosIniciales[$j]['ciudadDomicilio'] = utf8_encode($key->ciudadDomicilio) ;
                $datosIniciales[$j]['ciudadOficina'] = utf8_encode($key->ciudadOficina) ;
                $datosIniciales[$j]['tefonoOficina'] = utf8_encode($key->tefonoOficina) ;
                $datosIniciales[$j]['telefonoDomicilio'] = utf8_encode($key->telefonoDomicilio) ; 
                $datosIniciales[$j]['celular'] = utf8_encode($key->celular) ;
                $datosIniciales[$j]['celularAdicional'] = utf8_encode($key->celularAdicional) ;
                $datosIniciales[$j]['mail'] = utf8_encode($key->mail) ;
                $datosIniciales[$j]['direccionDomicilio'] = utf8_encode($key->direccionDomicilio) ;
                $datosIniciales[$j]['direccionOficina'] = utf8_encode($key->direccionOficina) ;
                $datosIniciales[$j]['dir_Adicional'] = utf8_encode($key->dir_Adicional) ;
                $datosIniciales[$j]['tele_adicional'] = utf8_encode($key->tele_adicional) ;
                $datosIniciales[$j]['ciudad_adicional'] = utf8_encode($key->ciudad_adicional) ;
                $datosIniciales[$j]['cal_ciudadDomicilio'] = utf8_encode($key->cal_ciudadDomicilio) ;
                $datosIniciales[$j]['cal_ciudadOficina'] = utf8_encode($key->cal_ciudadOficina) ;
                $datosIniciales[$j]['cal_tefonoOficina'] = utf8_encode($key->cal_tefonoOficina) ;
                $datosIniciales[$j]['cal_telefonoDomicilio'] = utf8_encode($key->cal_telefonoDomicilio) ;
                $datosIniciales[$j]['cal_celular'] = utf8_encode($key->cal_celular) ;
                $datosIniciales[$j]['cal_celularAdicional'] = utf8_encode($key->cal_celularAdicional) ;
                $datosIniciales[$j]['cal_mail'] = utf8_encode($key->cal_mail) ;
                $datosIniciales[$j]['cal_direccionDomicilio'] = utf8_encode($key->cal_direccionDomicilio) ;
                $datosIniciales[$j]['cal_direccionOficina'] = utf8_encode($key->cal_direccionOficina) ;
                $datosIniciales[$j]['cal_dir_Adicional'] = utf8_encode($key->cal_dir_Adicional) ;
                $datosIniciales[$j]['cal_tele_adicional'] = utf8_encode($key->cal_tele_adicional) ;
                $datosIniciales[$j]['cal_ciudad_adicional'] = utf8_encode($key->cal_ciudad_adicional) ;
                $datosIniciales[$j]['fecha_modificacion'] = $fecha2 ;
                $datosIniciales[$j]['id_log_datos'] = $key->id_log_datos;
                $j++;
            }
            echo json_encode($datosIniciales);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function  gestionJudicialmenu($identificacion, $numeroContrato){
        if($this->session->userdata('login_ok')){

            $clientes = $this->Obligaciones_Model->getDatosersonales($identificacion);
            $datos = array('cliente' => $clientes,  'identificacion' => $identificacion, 'numeroContrato' => $numeroContrato);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/menuGestionjudicial', $datos);
            $this->load->view('Includes/footer');
        }else{
            $this->load->view('Login/login');
        }
    }

    public function getDatosProcesosVigentes(){
        if($this->session->userdata('login_ok')){
            $clientes = $this->Obligaciones_Model->getDatosersonales();

            echo json_encode($clientes);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function getdatosObligaciones($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Obligaciones_Model->getDatosObligaciones($Contrato);
            $data = array();
            $i = 0;

            foreach ($datosObligacion as $key) {
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $data[$i]['Contrato'] = $key->liquidacion;
                }else{
                    $data[$i]['Contrato'] = $key->Contrato;
                }

               
                $data[$i]['EstadoAbogado'] = $key->EstadoAbogado ;
                $data[$i]['Vlorpagado'] = $key->Vlorpagado ; 
                $data[$i]['fgarantia'] = $key->fgarantia ;
                $data[$i]['intermediario'] = utf8_encode($key->intermediario) ;
                $data[$i]['financiero'] = utf8_encode($key->financiero);
                $data[$i]['Cobertura'] = utf8_encode($key->Cobertura) ;
                $data[$i]['FRG'] = utf8_encode($key->FRG) ;
                $data[$i]['SAP'] = $key->SAP ;
                $data[$i]['Despacho'] = utf8_encode($key->Despacho) ;
                $data[$i]['ciudaddespacho'] = utf8_encode($key->ciudaddespacho);
                $data[$i]['claseProceso'] = utf8_encode($key->claseProceso) ;
                $data[$i]['estadoP'] = utf8_encode($key->estadoP) ;
                $data[$i]['saldo'] = $key->saldo ;
                $data[$i]['interespormora'] = $key->interespormora ;
                $data[$i]['GastoJudiciales'] = $key->GastoJudiciales ;
                $data[$i]['porcentajeAbogado'] = $key->porcentajeAbogado;
                $data[$i]['ultimoavnoFecha'] = $key->ultimoavnoFecha ;
                $data[$i]['Judiciable'] = utf8_encode($key->Judiciable) ;
                $data[$i]['procesoGu'] = $key->procesoGu;
                $i++;
            }
            echo json_encode($data);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function getdatosDeudores($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getDeudores($Contrato);
            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['deudor'] = utf8_encode($key->deudor);
                $i++;
            }
            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function getdatoscoDeudores($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getco_Deudores($Contrato);
            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['deudor'] = utf8_encode($key->deudor);
                $i++;
            }
            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function getRolusuario(){
        if($this->session->userdata('login_ok')){
            $Contrato = $_POST['contrato'];
            $usuario  = $_POST['usuario'];
            if($usuario != 0){
                $datosObligacion = $this->Wizard_Model->getRolDeudor($Contrato, $usuario);
                echo $datosObligacion;
            }else{
                echo "";
            }
            
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function eventoBotonEtapa(){
        if($this->session->userdata('login_ok')){
            $consInteEtapaSeleccionada = $_POST['consInteEtapaSeleccionada'];
            $datosWizard = $this->Wizard_Model->getdatosWizard($consInteEtapaSeleccionada);
            $estaGaver = '';
            foreach ($datosWizard as $key) {
                $estaGaver .= '<div class="radio">';
                $estaGaver .= '<label>';
                $estaGaver .= '<input type="checkbox" name="optionsRadios" id="optionsRadios1" value="'. $key->G724_ConsInte__b .'">';
                $estaGaver .=  utf8_encode($key->G724_C17105);
                $estaGaver .= '</label>';
                $estaGaver .= '</div>';
            }
            echo $estaGaver;
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function eventoBotonEtapajson(){
        if($this->session->userdata('login_ok')){
            $consInteEtapaSeleccionada = $_POST['consInteEtapaSeleccionada'];
            $datosWizard = $this->Wizard_Model->getdatosWizard($consInteEtapaSeleccionada);
            $estaGaver = '<option value="0">Seleccione</option>';
            foreach ($datosWizard as $key) {
                $estaGaver .= '<option value="'. $key->G724_ConsInte__b .'">';
                $estaGaver .=  utf8_encode($key->G724_C17105);
                $estaGaver .= '</option>';
            }
            echo $estaGaver;
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }


     function eventoBotonIlocalizado(){
        if($this->session->userdata('login_ok')){
            $localizadoSeleccionado = $_POST['localizadoSeleccionado'];
            $datosWizard = $this->Wizard_Model->getGestionIlocalizado(1816);
            $estaGaver = '';
            foreach ($datosWizard as $key) {
                $estaGaver .= '<div class="radio">';
                $estaGaver .= '<label>';
                $estaGaver .= '<input type="checkbox" name="localizadoSeleccionado" id="optionsRadios1" value="'. $key->gestion .'">';
                $estaGaver .=  utf8_encode($key->enunciado);
                $estaGaver .= '</label>';
                $estaGaver .= '</div>';
            }
            echo $estaGaver;
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getSubgestiones(){
        if($this->session->userdata('login_ok')){
            $cafeSeleccionado = $_POST['cafeSeleccionado'];
            $datosWizard = $this->Wizard_Model->getSubgestiones($cafeSeleccionado);
            $estaGaver = '';
            foreach ($datosWizard as $key) {
                $estaGaver .= '<div class="radio">';
                $estaGaver .= '<label>';
                $estaGaver .= '<input type="checkbox" name="cafeSeleccionado" id="optionsRadios1" value="'. $key->id .'">';
                $estaGaver .=  utf8_encode($key->enunciado);
                $estaGaver .= '</label>';
                $estaGaver .= '</div>';
            }
            echo $estaGaver;
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getSubgestiones_(){
        if($this->session->userdata('login_ok')){
            $cafeSeleccionado = $_POST['cafeSeleccionado'];
            $datosWizard = $this->Wizard_Model->getSubgestiones($cafeSeleccionado);
            $estaGaver = '<option value="0">Seleccione</option>';
            foreach ($datosWizard as $key) {
                $estaGaver .= '<option value="'. $key->id .'">'.utf8_encode($key->enunciado).'</option>';
            }
            echo $estaGaver;
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getSubgestionesTotal(){
        if($this->session->userdata('login_ok')){
            $cafeSeleccionado = $_POST['cafeSeleccionado'];
            $datosWizard = $this->Wizard_Model->getSubgestiones($cafeSeleccionado);
            $estaGaver = '';
            foreach ($datosWizard as $key) {
                $estaGaver .= '<div class="radio">';
                $estaGaver .= '<label>';
                $estaGaver .= '<input type="checkbox" name="cafeSeleccionadoTotal" id="optionsRadios1" value="'. $key->id .'">';
                $estaGaver .=  utf8_encode($key->enunciado);
                $estaGaver .= '</label>';
                $estaGaver .= '</div>';
            }
            echo $estaGaver;
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

//Funcion para mostrar el historico Extrajudicial
    function getgestionExtrajudicial($Contrato){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $array  = array();
            $i = 0;


            $this->db->select('G719_C17423 as liquidacion');
            $this->db->from('G719');
            $this->db->where('G719_ConsInte__b', $Contrato);
            $query = $this->db->get();

            if(!is_null($query->row()->liquidacion)){
                $this->db->select('G719_ConsInte__b as id');
                $this->db->from('G719');
                $this->db->where('G719_C17423', $query->row()->liquidacion);
                $query2 = $this->db->get();
                $resultado = $query2->result();
                foreach ($resultado as $key2) {
                    $datosObligacion = $this->Wizard_Model->getgestionExtrajudicial($key2->id);
                    $tablaExtraJudicial  = '';
                   
                    foreach ($datosObligacion as $key) {
                        $fecha = null;
                        $fecha2 = null;
                        $fecha3 =null;
                        if(!is_null($key->fechaIngreso)){
                            $fecha = explode(" ", $key->fechaIngreso)[0];
                            $fecha = explode("-", $fecha);
                           
                            $fecha2 = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                            $fecha3 = $fecha[0].$fecha[1].$fecha[2];
                        }
                        


                        $niidea = '00:00:00';
                        $otroNidea = 0;
                        if(!is_null($key->Niidea)){
                           $niidea = explode( ".", explode(" ", $key->Niidea)[1])[0]; 
                           $otroNidea = str_replace(':', '', $niidea);
                        }

                        $array[$i]['nombres'] = utf8_encode($key->nombres);
                        $array[$i]['mediocomunicacion'] = utf8_encode($key->mediocomunicacion) ;
                        $array[$i]['resultadocomunicacion'] = utf8_encode($key->resultadocomunicacion) ;
                        $array[$i]['gestion'] = utf8_encode($key->gestion);
                        $array[$i]['subgestion'] = utf8_encode($key->subgestion);
                        $array[$i]['observaciones'] = utf8_encode($key->observaciones);
                        $array[$i]['users'] = utf8_encode($key->users).$key->tarea;
                        $array[$i]['fecha'] = "<span style='display: none;'>".$fecha3.$otroNidea."</span>".$fecha2;
                        $array[$i]['Niidea'] = $niidea;
                        $array[$i]['codigo'] = $key->id;
                        $i++;
                    }
                }
            }else{
                $datosObligacion = $this->Wizard_Model->getgestionExtrajudicial($Contrato);
                $tablaExtraJudicial  = '';
               
                foreach ($datosObligacion as $key) {
                    $fecha = null;
                    $fecha2 = null;
                    $fecha3 =null;
                    if(!is_null($key->fechaIngreso)){
                        $fecha = explode(" ", $key->fechaIngreso)[0];
                        $fecha = explode("-", $fecha);
                       
                        $fecha2 = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                        $fecha3 = $fecha[0].$fecha[1].$fecha[2];
                    }
                    


                    $niidea = '00:00:00';
                    $otroNidea = 0;
                    if(!is_null($key->Niidea)){
                       $niidea = explode( ".", explode(" ", $key->Niidea)[1])[0]; 
                       $otroNidea = str_replace(':', '', $niidea);
                    }


                    $array[$i]['nombres'] = utf8_encode($key->nombres);
                    $array[$i]['mediocomunicacion'] = utf8_encode($key->mediocomunicacion) ;
                    $array[$i]['resultadocomunicacion'] = utf8_encode($key->resultadocomunicacion) ;
                    $array[$i]['gestion'] = utf8_encode($key->gestion);
                    $array[$i]['subgestion'] = utf8_encode($key->subgestion);
                    $array[$i]['observaciones'] = utf8_encode($key->observaciones);
                    $array[$i]['users'] = utf8_encode($key->users).$key->tarea;
                    $array[$i]['fecha'] = "<span style='display: none;'>".$fecha3.$otroNidea."</span>".$fecha2;
                    $array[$i]['Niidea'] = $niidea;
                    $array[$i]['codigo'] = $key->id;
                    $i++;
                }
    
            }
            echo json_encode($array);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function exportarExtrajudicial($contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getgestionExtrajudicial($contrato);
            $obligacion = $this->db->get_where('G719',array('G719_ConsInte__b' => $contrato));
            $datos = array("datosObligacion" => $datosObligacion,  "Contrato" => $obligacion->row()->G719_C17026);
            $this->load->view("Exportar/Extrajudicial", $datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }


    function exportarJudicial($contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getgestioJudicial($contrato);
             $obligacion = $this->db->get_where('G719',array('G719_ConsInte__b' => $contrato));
            $datos = array("datosObligacion" => $datosObligacion,  "Contrato" => $obligacion->row()->G719_C17026);
            $this->load->view("Exportar/Judicial", $datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function exportarMedidas($contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getMedidasCautelares($contrato);
            $obligacion = $this->db->get_where('G719',array('G719_ConsInte__b' => $contrato));
            $datos = array("datosObligacion" => $datosObligacion,  "Contrato" => $obligacion->row()->G719_C17026);
            $this->load->view("Exportar/Medidas", $datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getDatosgestionExtrajudicial($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getgestionExtrajudicialtotalById($Contrato);
            foreach ($datosObligacion as $key) {
                $fecha = explode(" ", $key->fechaIngreso)[0];
                $fecha = explode("-", $fecha);
                echo '<div class="row">
                    <div class="col-md-3" ><label>Medio comunicación</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.utf8_encode($key->mediocomunicacion) .' </div>
                    <div class="col-md-3" ><label>Gestión</label> </div>
                    <div class="col-md-3" id="Datosgestion">'.utf8_encode($key->gestion).' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Subgestión</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion"> '.utf8_encode($key->subgestion).'</div>
                    <div class="col-md-3"><label>Resultado comunicación</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.utf8_encode($key->resultadocomunicacion).' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Ejecutor</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">'.utf8_encode($key->users).' </div>
                    <div class="col-md-3"  ><label>Fecha ejecución</label> </div>
                    <div class="col-md-3" id="DatosFecha">'. $fecha[2]."/". $fecha[1]."/". $fecha[0].' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Hora ejecución</label> </div>
                    <div class="col-md-3"  id="DatosHora">'.explode( ".", explode(" ", $key->fechaIngreso)[1])[0].' </div>
                    <div class="col-md-3"><label>cliente gestionado</label></div>
                    <div class="col-md-3" id="DatosCliente">'.utf8_encode($key->nombres).'</div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Obsevaciones</label> </div>
                    <div class="col-md-9" id="DatosObservaciones">'.utf8_encode($key->observaciones).' </div>                   
                </div>';
            }
            

        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

//funcion para obtener la gestion judicial
    function getgestioJudicial($Contrato){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $tablaExtraJudicial  = '';
            $datosarray = array();
            $i = 0;


            $this->db->select('G719_C17423 as liquidacion');
            $this->db->from('G719');
            $this->db->where('G719_ConsInte__b', $Contrato);
            $query = $this->db->get();

            if(!is_null($query->row()->liquidacion)){
                $this->db->select('G719_ConsInte__b as id');
                $this->db->from('G719');
                $this->db->where('G719_C17423', $query->row()->liquidacion);
                $query2 = $this->db->get();
                $resultado = $query2->result();
                foreach ($resultado as $key2) {

                    $datosObligacion = $this->Wizard_Model->getgestioJudicial($key2->id);
                    foreach ($datosObligacion as $key) {
                        $fecha = explode(" ", $key->txtFechaTramite)[0];
                        $fecha = explode("-", $fecha);

                        $fecha1 = explode(" ", $key->txtFechaIngreso)[0];
                        $fecha1 = explode("-", $fecha1);

                        
                        $otroNidea = 0;
                        $niidea = explode(" ", $key->txtFechaTramite)[1];
                        $otroNidea = str_replace(':', '', $niidea);
                    

                        $datosarray[$i]['TipoProceso'] = utf8_encode($key->TipoProceso);
                        $datosarray[$i]['txtFechaIngreso'] = "<span style='display: none;'>".$fecha1[0].$fecha1[1].$fecha1[2].$otroNidea."</span>".$fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                        $datosarray[$i]['Etapa'] = utf8_encode($key->Etapa);
                        $datosarray[$i]['actuacion'] = utf8_encode($key->actuacion) ;
                        $datosarray[$i]['fecha'] = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                        $datosarray[$i]['txtObservaciones'] = utf8_encode($key->txtObservaciones) ;
                        $datosarray[$i]['users'] = utf8_encode($key->users);
                        $datosarray[$i]['codigo'] =$key->id;
                        /*$datosarray[$i]['eliminar'] = '<a class="btn btn-sm btn-danger" role="button" title="Eliminar" onclick="javascript: eliminarGestion('.$key->id.')"><i class="fa fa-trash"></i></a>';*/
                        $i++;
                        
                    }
                }
            }else{
                $datosObligacion = $this->Wizard_Model->getgestioJudicial($Contrato);
                foreach ($datosObligacion as $key) {
                    $fecha = explode(" ", $key->txtFechaTramite)[0];
                    $fecha = explode("-", $fecha);

                    $fecha1 = explode(" ", $key->txtFechaIngreso)[0];
                    $fecha1 = explode("-", $fecha1);

                    $otroNidea = 0;
                    $niidea = explode(" ", $key->txtFechaTramite)[1];
                    $otroNidea = str_replace(':', '', $niidea);


                    $datosarray[$i]['TipoProceso'] = utf8_encode($key->TipoProceso);
                    $datosarray[$i]['txtFechaIngreso'] = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                    $datosarray[$i]['Etapa'] = utf8_encode($key->Etapa);
                    $datosarray[$i]['actuacion'] = utf8_encode($key->actuacion) ;
                    $datosarray[$i]['fecha'] = "<span style='display: none;'>".$fecha[0].$fecha[1].$fecha[2].$otroNidea."</span>".$fecha[2]."/". $fecha[1]."/". $fecha[0];
                    $datosarray[$i]['txtObservaciones'] = utf8_encode($key->txtObservaciones) ;
                    $datosarray[$i]['users'] = utf8_encode($key->users);
                    $datosarray[$i]['codigo'] =$key->id;
                    /*$datosarray[$i]['eliminar'] = '<a class="btn btn-sm btn-danger" role="button" title="Eliminar" onclick="javascript: eliminarGestion('.$key->id.')"><i class="fa fa-trash"></i></a>';*/
                    $i++;
                    
                }
                
            }
            
            echo json_encode($datosarray);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getDatosgestionJudicial($Contrato){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $datosObligacion = $this->Wizard_Model->getgestioJudicialById($Contrato);
            foreach ($datosObligacion as $key) {
                $fecha = explode(" ", $key->txtFechaTramite)[0];
                $fecha = explode("-", $fecha);

                $fecha1 = explode(" ", $key->txtFechaIngreso)[0];
                $fecha1 = explode("-", $fecha1);

                echo '<div class="row">
                    <div class="col-md-3" ><label>Tipo de Proceso</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.utf8_encode($key->TipoProceso) .' </div>
                    <div class="col-md-3" ><label>Fecha de informe</label> </div>
                    <div class="col-md-3" id="Datosgestion">'.$fecha1[2]."/". $fecha1[1]."/". $fecha1[0].' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Etapa</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion"> '.utf8_encode($key->Etapa).'</div>
                    <div class="col-md-3"><label>Actuación</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.utf8_encode($key->actuacion).' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Fecha Tramite</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">'.$fecha[2]."/". $fecha[1]."/". $fecha[0].' </div>
                    <div class="col-md-3"  ><label>Ejecutor</label> </div>
                    <div class="col-md-3" id="DatosFecha">'.utf8_encode($key->users).' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Obsevaciones</label> </div>
                    <div class="col-md-9" id="DatosObservaciones">'.utf8_encode($key->txtObservaciones).' </div>                   
                </div>';
            }
            

        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }


    function getFacturas($Contrato){
         if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getFacturas($Contrato);
            $tablaExtraJudicial  = '';
            $datosarray = array();
            $i = 0;

            foreach ($datosObligacion as $key) {

                $FECHA_AUTO_DE_SUBROGACION = '';
                if(!is_null($key->FECHA_AUTO_DE_SUBROGACION)){
                    $FECHA_AUTO_DE_SUBROGACION = explode(" ", $key->FECHA_AUTO_DE_SUBROGACION)[0];
                    $FECHA_AUTO_DE_SUBROGACION = explode("-", $FECHA_AUTO_DE_SUBROGACION);
                    $FECHA_AUTO_DE_SUBROGACION = $FECHA_AUTO_DE_SUBROGACION[2]."/".$FECHA_AUTO_DE_SUBROGACION[1]."/".$FECHA_AUTO_DE_SUBROGACION[0];
                }


                $FECHA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_SENTENCIA_IRRECUPERABLE)){
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->FECHA_SENTENCIA_IRRECUPERABLE)[0];
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_SENTENCIA_IRRECUPERABLE = $FECHA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_SENTENCIA_IRRECUPERABLE[0];
                }

                $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)){
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)[0];
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[0];
                }

                $FECHA_LIQUIDACION_CREDITO = '';
                if(!is_null($key->FECHA_LIQUIDACION_CREDITO)){
                    $FECHA_LIQUIDACION_CREDITO = explode(" ", $key->FECHA_LIQUIDACION_CREDITO)[0];
                    $FECHA_LIQUIDACION_CREDITO = explode("-", $FECHA_LIQUIDACION_CREDITO);
                    $FECHA_LIQUIDACION_CREDITO = $FECHA_LIQUIDACION_CREDITO[2]."/".$FECHA_LIQUIDACION_CREDITO[1]."/".$FECHA_LIQUIDACION_CREDITO[0];
                }

                $FECHA_AUTO_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_AUTO_IRRECUPERABLE)){
                    $FECHA_AUTO_IRRECUPERABLE = explode(" ", $key->FECHA_AUTO_IRRECUPERABLE)[0];
                    $FECHA_AUTO_IRRECUPERABLE = explode("-", $FECHA_AUTO_IRRECUPERABLE);
                    $FECHA_AUTO_IRRECUPERABLE = $FECHA_AUTO_IRRECUPERABLE[2]."/".$FECHA_AUTO_IRRECUPERABLE[1]."/".$FECHA_AUTO_IRRECUPERABLE[0];
                }

                $FECHA_FACTURA_SOPORTES_CISA = '';
                if(!is_null($key->FECHA_FACTURA_SOPORTES_CISA)){
                    $FECHA_FACTURA_SOPORTES_CISA = explode(" ", $key->FECHA_FACTURA_SOPORTES_CISA)[0];
                    $FECHA_FACTURA_SOPORTES_CISA = explode("-", $FECHA_FACTURA_SOPORTES_CISA);
                    $FECHA_FACTURA_SOPORTES_CISA = $FECHA_FACTURA_SOPORTES_CISA[2]."/".$FECHA_FACTURA_SOPORTES_CISA[1]."/".$FECHA_FACTURA_SOPORTES_CISA[0];
                }

                $Fecha_de_factura_honorarios_venta_CISA = '';
                if(!is_null($key->Fecha_de_factura_honorarios_venta_CISA)){
                    $Fecha_de_factura_honorarios_venta_CISA = explode(" ", $key->Fecha_de_factura_honorarios_venta_CISA)[0];
                    $Fecha_de_factura_honorarios_venta_CISA = explode("-", $Fecha_de_factura_honorarios_venta_CISA);
                    $Fecha_de_factura_honorarios_venta_CISA = $Fecha_de_factura_honorarios_venta_CISA[2]."/".$Fecha_de_factura_honorarios_venta_CISA[1]."/".$Fecha_de_factura_honorarios_venta_CISA[0];
                }            
                $fecha = '';
                if(!is_null($key->FECHA_DE_FACTURA_AUTO_DE_SUBROGACION)){
                    $fecha = explode(" ", $key->FECHA_DE_FACTURA_AUTO_DE_SUBROGACION)[0];
                    $fecha = explode("-", $fecha);
                    $fecha = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                } 
                
                
                

        

                $datosarray[$i]['N_DE_FACTURA_AUTO_DE_SUBROGACION'] = $key->N_DE_FACTURA_AUTO_DE_SUBROGACION;
                $datosarray[$i]['FECHA'] = $fecha;
                $datosarray[$i]['FECHA_AUTO_DE_SUBROGACION'] = $FECHA_AUTO_DE_SUBROGACION;
                $datosarray[$i]['VALOR_FACTURADO_AUTO_DE_SUBROGACION'] = '$'.number_format($key->VALOR_FACTURADO_AUTO_DE_SUBROGACION, 0, '.',',') ;
                $datosarray[$i]['codigo'] =$key->G744_ConsInte__b;

                $i++;
                
            }

            echo json_encode($datosarray);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }

    }


    function getFacturasIrrecuperables($Contrato){
         if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getFacturas($Contrato);
            $tablaExtraJudicial  = '';
            $datosarray = array();
            $i = 0;

            foreach ($datosObligacion as $key) {

               
                $FECHA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_SENTENCIA_IRRECUPERABLE)){
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->FECHA_SENTENCIA_IRRECUPERABLE)[0];
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_SENTENCIA_IRRECUPERABLE = $FECHA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_SENTENCIA_IRRECUPERABLE[0];
                }

                $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)){
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)[0];
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[0];
                }

                
                $datosarray[$i]['N_DE_FACTURA_IRRECUPERABLE'] = $key->N_DE_FACTURA_SENTENCIA_IRRECUPERABLE;
                $datosarray[$i]['FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE'] = $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE;
                $datosarray[$i]['FECHA_SENTENCIA_IRRECUPERABLE'] = $FECHA_SENTENCIA_IRRECUPERABLE;
                $datosarray[$i]['VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE'] = '$'.number_format($key->VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE, 0, '.',',') ;
                $datosarray[$i]['codigo'] =$key->G744_ConsInte__b;

                $i++;
                
            }

            echo json_encode($datosarray);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }

    }

    function getFacturasSOPORTE($Contrato){
         if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getFacturas($Contrato);
            $tablaExtraJudicial  = '';
            $datosarray = array();
            $i = 0;

            foreach ($datosObligacion as $key) {

               
                $FECHA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->Fecha_recepcion_soporte)){
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->Fecha_recepcion_soporte)[0];
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_SENTENCIA_IRRECUPERABLE = $FECHA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_SENTENCIA_IRRECUPERABLE[0];
                }

                $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->Fecha_aprobacion_soporte)){
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->Fecha_aprobacion_soporte)[0];
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[0];
                }

                
                $datosarray[$i]['NumeroFactura'] = $key->N_DE_FACTURAS_SOPORTES_CISA;
                $datosarray[$i]['fechaaprovacion'] = $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE;
                $datosarray[$i]['fecharecepcion'] = $FECHA_SENTENCIA_IRRECUPERABLE;
                $datosarray[$i]['valor'] = '$'.number_format($key->VALOR_FACTURADO_SOPORTES_CISA, 0, '.',',') ;
                $datosarray[$i]['codigo'] =$key->G744_ConsInte__b;

                $i++;
                
            }

            echo json_encode($datosarray);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }

    }

    function getFacturasHonorarios($Contrato){
         if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getFacturas($Contrato);
            $tablaExtraJudicial  = '';
            $datosarray = array();
            $i = 0;

            foreach ($datosObligacion as $key) {

               
                $FECHA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->Fecha_de_factura_honorarios_venta_CISA)){
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->Fecha_de_factura_honorarios_venta_CISA)[0];
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_SENTENCIA_IRRECUPERABLE = $FECHA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_SENTENCIA_IRRECUPERABLE[0];
                }

                
                $datosarray[$i]['NumeroFactura'] = $key->N_Factura_honorarios_venta_CISA;
                $datosarray[$i]['fecha'] = $FECHA_SENTENCIA_IRRECUPERABLE;
                $datosarray[$i]['valor'] = '$'.number_format($key->HONORARIOS_VENTA_CISA, 0, '.',',') ;
                $datosarray[$i]['codigo'] =$key->G744_ConsInte__b;

                $i++;
                
            }

            echo json_encode($datosarray);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }

    }


    function getDatosFacturas($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getFacturasbyid($Contrato);
            $tablaExtraJudicial  = '';
            foreach ($datosObligacion as $key) {
                 $FECHA_AUTO_DE_SUBROGACION = '';
                if(!is_null($key->FECHA_AUTO_DE_SUBROGACION)){
                    $FECHA_AUTO_DE_SUBROGACION = explode(" ", $key->FECHA_AUTO_DE_SUBROGACION)[0];
                    $FECHA_AUTO_DE_SUBROGACION = explode("-", $FECHA_AUTO_DE_SUBROGACION);
                    $FECHA_AUTO_DE_SUBROGACION = $FECHA_AUTO_DE_SUBROGACION[2]."/".$FECHA_AUTO_DE_SUBROGACION[1]."/".$FECHA_AUTO_DE_SUBROGACION[0];
                }


                $FECHA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_SENTENCIA_IRRECUPERABLE)){
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->FECHA_SENTENCIA_IRRECUPERABLE)[0];
                    $FECHA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_SENTENCIA_IRRECUPERABLE = $FECHA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_SENTENCIA_IRRECUPERABLE[0];
                }

                $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)){
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode(" ", $key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)[0];
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = explode("-", $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE);
                    $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE = $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[2]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[1]."/".$FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE[0];
                }

                $FECHA_LIQUIDACION_CREDITO = '';
                if(!is_null($key->FECHA_LIQUIDACION_CREDITO)){
                    $FECHA_LIQUIDACION_CREDITO = explode(" ", $key->FECHA_LIQUIDACION_CREDITO)[0];
                    $FECHA_LIQUIDACION_CREDITO = explode("-", $FECHA_LIQUIDACION_CREDITO);
                    $FECHA_LIQUIDACION_CREDITO = $FECHA_LIQUIDACION_CREDITO[2]."/".$FECHA_LIQUIDACION_CREDITO[1]."/".$FECHA_LIQUIDACION_CREDITO[0];
                }

                $FECHA_AUTO_IRRECUPERABLE = '';
                if(!is_null($key->FECHA_AUTO_IRRECUPERABLE)){
                    $FECHA_AUTO_IRRECUPERABLE = explode(" ", $key->FECHA_AUTO_IRRECUPERABLE)[0];
                    $FECHA_AUTO_IRRECUPERABLE = explode("-", $FECHA_AUTO_IRRECUPERABLE);
                    $FECHA_AUTO_IRRECUPERABLE = $FECHA_AUTO_IRRECUPERABLE[2]."/".$FECHA_AUTO_IRRECUPERABLE[1]."/".$FECHA_AUTO_IRRECUPERABLE[0];
                }

                $FECHA_FACTURA_SOPORTES_CISA = '';
                if(!is_null($key->FECHA_FACTURA_SOPORTES_CISA)){
                    $FECHA_FACTURA_SOPORTES_CISA = explode(" ", $key->FECHA_FACTURA_SOPORTES_CISA)[0];
                    $FECHA_FACTURA_SOPORTES_CISA = explode("-", $FECHA_FACTURA_SOPORTES_CISA);
                    $FECHA_FACTURA_SOPORTES_CISA = $FECHA_FACTURA_SOPORTES_CISA[2]."/".$FECHA_FACTURA_SOPORTES_CISA[1]."/".$FECHA_FACTURA_SOPORTES_CISA[0];
                }

                $Fecha_de_factura_honorarios_venta_CISA = '';
                if(!is_null($key->Fecha_de_factura_honorarios_venta_CISA)){
                    $Fecha_de_factura_honorarios_venta_CISA = explode(" ", $key->Fecha_de_factura_honorarios_venta_CISA)[0];
                    $Fecha_de_factura_honorarios_venta_CISA = explode("-", $Fecha_de_factura_honorarios_venta_CISA);
                    $Fecha_de_factura_honorarios_venta_CISA = $Fecha_de_factura_honorarios_venta_CISA[2]."/".$Fecha_de_factura_honorarios_venta_CISA[1]."/".$Fecha_de_factura_honorarios_venta_CISA[0];
                }    
                        
                $fecha = '';
                if(!is_null($key->FECHA_DE_FACTURA_AUTO_DE_SUBROGACION)){
                    $fecha = explode(" ", $key->FECHA_DE_FACTURA_AUTO_DE_SUBROGACION)[0];
                    $fecha = explode("-", $fecha);
                    $fecha = $fecha[2]."/".$fecha[1]."/".$fecha[0];
                } 

                $Fecha_recepcion_soporte = NULL;
                if(!is_null($key->Fecha_recepcion_soporte)){
                    $Fecha_recepcion_soporte = explode(" ", $key->Fecha_recepcion_soporte)[0];
                    $Fecha_recepcion_soporte = explode("-", $Fecha_recepcion_soporte);
                    $Fecha_recepcion_soporte = $Fecha_recepcion_soporte[2]."/".$Fecha_recepcion_soporte[1]."/".$Fecha_recepcion_soporte[0];
                } 

                $Fecha_aprobacion_soporte = NULL;
                if(!is_null($key->Fecha_aprobacion_soporte)){
                    $Fecha_aprobacion_soporte = explode(" ", $key->Fecha_aprobacion_soporte)[0];
                    $Fecha_aprobacion_soporte = explode("-", $Fecha_aprobacion_soporte);
                    $Fecha_aprobacion_soporte = $Fecha_aprobacion_soporte[2]."/".$Fecha_aprobacion_soporte[1]."/".$Fecha_aprobacion_soporte[0];
                }

                
                
                echo '  <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSven">
                                    SUBROGACIÓN
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSven" class="panel-collapse collapse ">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3"><label>No. Factura auto de subrogación</label> </div>
                                    <div class="col-md-3"> '.$key->N_DE_FACTURA_AUTO_DE_SUBROGACION.'</div>
                                    <div class="col-md-3"><label>Fecha de factura auto de subrogación</label>   </div>
                                    <div class="col-md-3">'.$fecha .' </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Fecha auto de subrogación</label> </div>
                                    <div class="col-md-3">'.$FECHA_AUTO_DE_SUBROGACION.' </div>
                                    <div class="col-md-3"  ><label>Valor facturado auto de subrogación</label> </div>
                                    <div class="col-md-3" >$'.number_format($key->VALOR_FACTURADO_AUTO_DE_SUBROGACION, 0, '.',',') .' </div>
                                </div>
                            </div>
                        </div>';

           

                echo '  <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseIrrecuperable">
                                    IRRECUPERABLE
                                </a>
                            </h4>
                        </div>
                        <div id="collapseIrrecuperable" class="panel-collapse collapse ">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3"><label>No. Factura sentencia irrecuperable</label> </div>
                                    <div class="col-md-3"> '.$key->N_DE_FACTURA_SENTENCIA_IRRECUPERABLE.'</div>
                                    <div class="col-md-3"><label>Fecha sentencia irrecuperable</label>   </div>
                                    <div class="col-md-3">'. $FECHA_SENTENCIA_IRRECUPERABLE.' </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Fecha de factura sentencia irrecuperable</label> </div>
                                    <div class="col-md-3">'. $FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE.' </div>
                                    <div class="col-md-3"  ><label>Fecha liquidación crédito</label> </div>
                                    <div class="col-md-3" >'. $FECHA_LIQUIDACION_CREDITO.' </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Fecha auto de subrogación</label> </div>
                                    <div class="col-md-3">'. $FECHA_AUTO_IRRECUPERABLE.' </div>
                                    <div class="col-md-3"  ><label>Valor facturado sentencia irrecuperable</label> </div>
                                    <div class="col-md-3" >$'.number_format($key->VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE, 0, '.',',') .' </div>
                                </div>
                            </div>
                        </div>';

              
                echo '  <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseCISA">
                                    CISA
                                </a>
                            </h4>
                        </div>
                        <div id="collapseCISA" class="panel-collapse collapse ">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3"><label>No. Facturas soportes CISA</label> </div>
                                    <div class="col-md-3"> '.$key->N_DE_FACTURAS_SOPORTES_CISA.'</div>
                                    <div class="col-md-3"><label>Fecha factura soportes CISA</label>   </div>
                                    <div class="col-md-3">'.$FECHA_FACTURA_SOPORTES_CISA.' </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Soporte</label> </div>
                                    <div class="col-md-3">'.$key->SOPORTE.' </div>
                                    <div class="col-md-3"  ><label>Renuncia y paz y salvo o cesión</label> </div>
                                    <div class="col-md-3" >'.Utf8_encode($key->RENUNCIA_Y_PAZ_Y_SALVO_O_CESION).' </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Valor facturado soportes CISA</label> </div>
                                    <div class="col-md-3">$'.number_format($key->VALOR_FACTURADO_SOPORTES_CISA, 0, '.', ',').' </div>
                                    <div class="col-md-3"  ><label>No. Factura honorarios venta CISA</label> </div>
                                    <div class="col-md-3" >'.$key->N_Factura_honorarios_venta_CISA.' </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><label>Fecha de factura honorarios venta CISA</label> </div>
                                    <div class="col-md-3">'.$Fecha_de_factura_honorarios_venta_CISA.' </div>
                                    <div class="col-md-3"  ><label>Honorarios venta CISA</label> </div>
                                    <div class="col-md-3" >$'.number_format($key->HONORARIOS_VENTA_CISA, 0, '.',',').' </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3"><label>Fecha recepci&oacute;n soporte</label> </div>
                                    <div class="col-md-3">'.$Fecha_recepcion_soporte.' </div>
                                    <div class="col-md-3"  ><label>Fecha aprobaci&oacute;n soporte</label> </div>
                                    <div class="col-md-3" >'.$Fecha_aprobacion_soporte.' </div>
                                </div>
                            </div>
                        </div>';
                    

            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    

    function getinformacionJudicial($Contrato){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $datosObligacion = $this->Wizard_Model->getinformacionJudicial($Contrato);
            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key ) {

                $this->db->select('G735_C17139 as txtFechaTramite');
                $this->db->from('G735');
                $this->db->where('G735_C17138', $Contrato);
                $this->db->where('G735.G735_C17137 = 153');
                $query = $this->db->get();
                $fechT = NULL;
                
                if($query->num_rows() > 0){
                    if(!is_null($query->row()->txtFechaTramite)){
                        $fecha_Tramite1 = explode(" ",$query->row()->txtFechaTramite)[0];
                        $fecha_Tramite = explode("-",$fecha_Tramite1);
                        $fechT = $fecha_Tramite[2]."/".$fecha_Tramite[1]."/".$fecha_Tramite[0];
                    }
                }else{
                    $this->db->select('G735_C17139 as txtFechaTramite');
                    $this->db->from('G735');
                    $this->db->where('G735_C17138', $key->id);
                    $this->db->where('G735.G735_C17137 = 157');
                    $query = $this->db->get();
                    if($query->num_rows() > 0){
                        if(!is_null($query->row()->txtFechaTramite)){
                            $fecha_Tramite1 = explode(" ",$query->row()->txtFechaTramite)[0];
                            $fecha_Tramite = explode("-",$fecha_Tramite1);
                            $fechT = $fecha_Tramite[2]."/".$fecha_Tramite[1]."/".$fecha_Tramite[0];
                        }
                    }
                }

                $fecha1 = '';
                $fecha2 = '';
                $fecha3 = '';
                $fecha4 = '';

                if(!is_null($key->Fech_demanda)){
                    $fecha1 = explode(" ", $key->Fech_demanda)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                }

                if(!is_null($key->Fecha_admision_demanda)){
                    $fecha2 = explode(" ", $key->Fecha_admision_demanda)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->Fecha_mandamiento_de_pago)){
                    $fecha3 = explode(" ", $key->Fecha_mandamiento_de_pago)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }

                if(!is_null($key->fechaenvioterminacion)){
                    $fecha4 = explode(" ", $key->fechaenvioterminacion)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }

                $datos[$i]['Radicado_o_expediente'] = $key->Radicado_o_expediente;
                $datos[$i]['Fech_demanda'] = $fecha1 ;
                $datos[$i]['Fecha_admision_demanda'] = $fecha2 ;
                $datos[$i]['Fecha_mandamiento_de_pago'] = $fecha3 ;
                $datos[$i]['Total_gastos_judiciales'] = $key->Total_gastos_judiciales ;
                $datos[$i]['fechaTErminacion'] = $fechT;
                $datos[$i]['fechaEnvioTErminacion'] = $fecha4;
                $datos[$i]['abogadoIf'] = utf8_encode($key->abogado_if);
                $i++;
            }
            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function getInformacionAbogado($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getInformacionAbogado($Contrato);
            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key ) {
                $datos[$i]['Abogado'] = utf8_encode($key->Abogado);
                $datos[$i]['Fecha_asignacion_abogado'] = $key->Fecha_asignacion_abogado ;
                $datos[$i]['No_Poliza'] = $key->No_Poliza ;
                $datos[$i]['Fecha_de_aprobacion_de_Poliza'] = $key->Fecha_de_aprobacion_de_Poliza ;
                $datos[$i]['Fecha_de_vencimiento'] = $key->Fecha_de_vencimiento ;

                $datos[$i]['celular'] = utf8_encode($key->celular );
                $datos[$i]['correo'] = utf8_encode($key->correo) ;
                $datos[$i]['direccion'] = utf8_encode($key->direccion) ;
                $datos[$i]['telefono'] = utf8_encode($key->telefono) ;

                $datos[$i]['firma'] = utf8_encode($key->firma) ;
                $datos[$i]['frg'] = utf8_encode($key->frg) ;
                $datos[$i]['promotor'] = utf8_encode($key->promotor);

                $i++;
            }
            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }

    }

    function getPazYsalvo($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getPazYsalvo($Contrato);

            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key ) {

               

                $fecha1 = '';
                $fecha2 = '';
                


                if(!is_null($key->Fecha_de_expedicion_del_paz_y_salvo)){
                    $fecha1 = explode(" ", $key->Fecha_de_expedicion_del_paz_y_salvo)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                }

                if(!is_null($key->Fecha_venta)){
                    $fecha2 = explode(" ", $key->Fecha_venta)[0];
                    $fecha2 = explode("-", $fecha2);

                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }


                $datos[$i]['Paz_y_salvo'] = $key->Paz_y_salvo;
                $datos[$i]['Fecha_venta'] = $fecha2 ;
                $datos[$i]['Fecha_de_expedicion_del_paz_y_salvo'] = $fecha1 ;
                
                $i++;
            }
            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getSubrogacion($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getSubrogacion($Contrato);
            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key) {
                
                $fecha1 = '';
                $fecha2 = '';
                $fecha3 = '';
                $fecha4 = '';
                $fecha5 = '';
                $fecha6 = '';
                $fecha7 = '';

                if(!is_null($key->Fecha_envio_memorial_de_subrogacion_al_FRG)){
                    $fecha1 = explode(" ", $key->Fecha_envio_memorial_de_subrogacion_al_FRG)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                }

                if(!is_null($key->Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores)){
                    $fecha2 = explode(" ", $key->Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->Fecha_envio_memorial_de_subrogacion_corregido)){
                    $fecha3 = explode(" ", $key->Fecha_envio_memorial_de_subrogacion_corregido)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }

                if(!is_null($key->Fecha_radicacion_memorial)){
                    $fecha4 = explode(" ", $key->Fecha_radicacion_memorial)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }

                if(!is_null($key->Fecha_impugnacion_decision_final)){
                    $fecha5 = explode(" ", $key->Fecha_impugnacion_decision_final)[0];
                    $fecha5 = explode("-", $fecha5);
                    $fecha5 = $fecha5[2]."/".$fecha5[1]."/".$fecha5[0];
                }

                if(!is_null($key->Fecha_pronunciamiento)){
                    $fecha6 = explode(" ", $key->Fecha_pronunciamiento)[0];
                    $fecha6 = explode("-", $fecha6);
                    $fecha6 = $fecha6[2]."/".$fecha6[1]."/".$fecha6[0];
                }

                if(!is_null($key->Fecha_decision_final)){
                    $fecha7 = explode(" ", $key->Fecha_decision_final)[0];
                    $fecha7 = explode("-", $fecha7);
                    $fecha7 = $fecha7[2]."/".$fecha7[1]."/".$fecha7[0];
                }

                

                $datos[$i]['Fecha_envio_memorial_de_subrogacion_al_FRG'] = $fecha1;
                $datos[$i]['Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores'] = $fecha2 ;
                $datos[$i]['Fecha_envio_memorial_de_subrogacion_corregido'] = $fecha3 ;
                $datos[$i]['Fecha_radicacion_memorial'] = $fecha4 ;
                $datos[$i]['Decision'] = utf8_encode($key->Decision) ;
                $datos[$i]['Fecha_impugnacion_decision_final'] = $fecha5 ;
                $datos[$i]['Nombre_clase_de_impugnacion'] = utf8_encode($key->Nombre_clase_de_impugnacion) ;
                $datos[$i]['Fecha_pronunciamiento'] =  $fecha6  ;
                $datos[$i]['decicion_Final'] =  utf8_encode($key->decicion_Final) ; 
                $datos[$i]['Fecha_decision_final'] =   $fecha7; 
                
                $i++;
            }
            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getTablaMedida($Contrato){
        
        if($this->session->userdata('login_ok')){
            $tablaExtraJudicial  = '';
            $array = array();
            $i = 0;


            $this->db->select('G719_C17423 as liquidacion');
            $this->db->from('G719');
            $this->db->where('G719_ConsInte__b', $Contrato);
            $query = $this->db->get();

            if(!is_null($query->row()->liquidacion)){
                $this->db->select('G719_ConsInte__b as id');
                $this->db->from('G719');
                $this->db->where('G719_C17423', $query->row()->liquidacion);
                $query2 = $this->db->get();
                $resultado = $query2->result();
                foreach ($resultado as $key2) {
                    $datosObligacion = $this->Wizard_Model->getMedidasCautelares($key2->id);
            
                    foreach ($datosObligacion as $key) {
                       
                        $fache = explode(' ', $key->FechaInforme);
                        $fache = explode('-', $fache[0]);
                        $var1 = explode(' ', $key->FechaSolicitud)[0];
                        $var1 = explode('-', $var1);
                        $var2 = explode(' ', $key->FechaDecreto)[0];
                        $var2 = explode('-', $var2);
                        $var3 = explode(' ', $key->FechaPractica)[0];
                        $var3 = explode('-', $var3);

                        $array[$i]['fecha'] = "<span style='display: none;'>".$fache[0].$fache[1].$fache[2]."</span>".$fache[2]."/".$fache[1]."/".$fache[0];
                        $array[$i]['Medida'] = utf8_encode($key->Medida);
                        $array[$i]['var1'] = $var1[2]."/".$var1[1]."/".$var1[0];
                        $array[$i]['var2'] = $var2[2]."/".$var2[1]."/".$var2[0];
                        $array[$i]['var3'] = $var3[2]."/".$var3[1]."/".$var3[0];
                        $array[$i]['Secuestre'] = utf8_encode($key->Secuestre);
                        $array[$i]['G736_ConsInte__b'] = $key->G736_ConsInte__b;
                        if($key->resultadoMedida != ''){
                            $array[$i]['calificar'] = $key->resultadoMedida;
                        }else{
                            $array[$i]['calificar'] = '<a class="btn btn-sm btn-success" role="button" onclick="javascript: calificarMedidas('.$key->G736_ConsInte__b.', 1)">SI</a><a class="btn btn-sm btn-danger" role="button" onclick="javascript: calificarMedidas('.$key->G736_ConsInte__b.', 2)">NO</a>';
         
                        }
                        
                        $i++;
                    }
                }
            }else{
                $datosObligacion = $this->Wizard_Model->getMedidasCautelares($Contrato);
            
                foreach ($datosObligacion as $key) {
                   
                    $fache = explode(' ', $key->FechaInforme);
                    $fache = explode('-', $fache[0]);
                    $var1 = explode(' ', $key->FechaSolicitud)[0];
                    $var1 = explode('-', $var1);
                    $var2 = explode(' ', $key->FechaDecreto)[0];
                    $var2 = explode('-', $var2);
                    $var3 = explode(' ', $key->FechaPractica)[0];
                    $var3 = explode('-', $var3);

                    $array[$i]['fecha'] = "<span style='display: none;'>".$fache[0].$fache[1].$fache[2]."</span>".$fache[2]."/".$fache[1]."/".$fache[0];
                    $array[$i]['Medida'] = utf8_encode($key->Medida);
                    $array[$i]['var1'] = $var1[2]."/".$var1[1]."/".$var1[0];
                    $array[$i]['var2'] = $var2[2]."/".$var2[1]."/".$var2[0];
                    $array[$i]['var3'] = $var3[2]."/".$var3[1]."/".$var3[0];
                    $array[$i]['Secuestre'] = utf8_encode($key->Secuestre);
                    $array[$i]['G736_ConsInte__b'] = $key->G736_ConsInte__b;
                    if($key->resultadoMedida != ''){
                        $array[$i]['calificar'] = $key->resultadoMedida;
                    }else{
                        $array[$i]['calificar'] = '<a class="btn btn-sm btn-success" role="button" onclick="javascript: calificarMedidas('.$key->G736_ConsInte__b.', 1)">SI</a><a class="btn btn-sm btn-danger" role="button" onclick="javascript: calificarMedidas('.$key->G736_ConsInte__b.', 2)">NO</a>';
     
                    }
                    
                    $i++;
                }
            }
            

            echo json_encode($array);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function calificarMedidas(){
        if($this->session->userdata('login_ok')){
            $arrayD = array('resultadoMedida' => $_POST['calificacion']);
            if($this->Wizard_Model->editarDatos('G736', $arrayD, $_POST['idMedidas'], 'G736_ConsInte__b')){
                echo "1";
            }else{
                echo "2";
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

     function getDatosMedidas($id){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getMedidasCautelaresById($id);
            foreach ($datosObligacion as $key) {
                $fache = explode(' ', $key->FechaInforme);
                $fache = explode('-', $fache[0]);
                $var1 = explode(' ', $key->FechaSolicitud)[0];
                $var1 = explode('-', $var1);
                $var2 = explode(' ', $key->FechaDecreto)[0];
                $var2 = explode('-', $var2);
                $var3 = explode(' ', $key->FechaPractica)[0];
                $var3 = explode('-', $var3);

                echo '<div class="row">
                    <div class="col-md-3" ><label>Fecha Informe</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$fache[2]."/".$fache[1]."/".$fache[0].' </div>
                    <div class="col-md-3" ><label>Medida Cautelar</label> </div>
                    <div class="col-md-3" id="Datosgestion">'.utf8_encode($key->Medida).' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Fecha Solicitud</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion"> '.$var1[2]."/".$var1[1]."/".$var1[0].'</div>
                    <div class="col-md-3"><label>Fecha Decreto</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.$var2[2]."/".$var2[1]."/".$var2[0].' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Fecha Práctica</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">'.$var3[2]."/".$var3[1]."/".$var3[0].' </div>
                    <div class="col-md-3"  ><label>Secuestre</label> </div>
                    <div class="col-md-3" id="DatosFecha">'.utf8_encode($key->Secuestre).' </div>
                </div>';
            }
            

        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getCodeudores($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getCodeudores($Contrato);
            $tablaExtraJudicial  = '';
            
            if($datosObligacion != 0){
                foreach ($datosObligacion as $key) {
                    $bumero = $this->Obligaciones_Model->getNumObligacionesUsuario($key->id);
                    $tablaExtraJudicial .= '<tr>';
                    $tablaExtraJudicial .= '<td>'.$bumero.'</td>';
                    $tablaExtraJudicial .= '<td><a href="#" class="obligacionesHref" usuario="'.$key->id.'">Obligaciones asociadas</a></td>';
                    $tablaExtraJudicial .= '<td>'.$key->nombre.'</td>';
                    $tablaExtraJudicial .= '<td>'.$key->Identificacion.'</td>';
                    $tablaExtraJudicial .= '</tr>';
                }
            }else{
                $tablaExtraJudicial .= '<tr>';
                $tablaExtraJudicial .= '<td colspan="4">No hay codeudores</td>';
                $tablaExtraJudicial .= '</tr>';
            }
            

            echo $tablaExtraJudicial;
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function detallesObligaciones($usuario){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Obligaciones_Model->getObligacionesUsuario($usuario);
            $tablaExtraJudicial  = '';
            echo '<table class="table table-hover table-bordered" id="codeudoresTbl">
                    <thead>
                        <tr>
                            <th>Identificación Deudor</th>
                            <th>Nombre Deudor</th>
                            <th>No Contrato</th>
                            <th>Rol Codeudor</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($datosObligacion as $key) {
                echo '<tr>
                            <td>'.$key->identificacion.'</td>
                            <td>'.$key->Deudor.'</td>
                            <td>'.$key->OBLIGACION.'</td>
                            <td>'.$key->LISOPC_Nombre____b.'</td>
                        </tr>';
            }

            echo '</tbody>   </table>';
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getGarantias($Contrato){
        if($this->session->userdata('login_ok')){
            $liquidacion = 0;
            $array = array();
            $i = 0;
            $garantias = 'No aplica';
            $pagares = 'No aplica';
            $total = 0;
            $nuevo = 0;
            $viejo = 0;


            $liquidacion = $this->Wizard_Model->getLiquidacionN($Contrato);
            $datosObligacion = NULL;
            if($liquidacion == 0){
                $datosObligacion = $this->Wizard_Model->getGarantias($Contrato);
                foreach ($datosObligacion as $key) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo){
                        if(!is_null($key->garantia)){
                            $garantias = $key->garantia;
                        }

                        if(!is_null($key->pagare)){
                            $pagares = $key->pagare;
                        }
                        $array[$i]['garantia'] = $garantias;
                        $array[$i]['pagare']   = $pagares;
                        $array[$i]['contrato'] = $key->contrato;
                        $array[$i]['vPagado'] = '$'.number_format($key->vPagado, 0);
                        $array[$i]['codigo']   = $key->id;
                        $total += $key->vPagado;
                        $i++;
                    }
                    $viejo = $nuevo;
                }

            }else{

                $contratos = $this->Wizard_Model->getcontratosXLiquidacion($liquidacion);
                foreach ($contratos as $contrato) {
                    $datosObligacion = $this->Wizard_Model->getGarantias($contrato->G719_ConsInte__b);
                    foreach ($datosObligacion as $key) {
                        $nuevo = $key->contrato;
                        if($nuevo != $viejo){
                            if(!is_null($key->garantia)){
                                $garantias = $key->garantia;
                            }

                            if(!is_null($key->pagare)){
                                $pagares = $key->pagare;
                            }
                            $array[$i]['garantia'] = $garantias;
                            $array[$i]['pagare']   = $pagares;
                            $array[$i]['contrato'] = $key->contrato;
                            $array[$i]['vPagado'] = '$'.number_format($key->vPagado, 0);
                            $array[$i]['codigo']   = $key->id;
                            $total += $key->vPagado;
                            $i++;
                        }
                        $viejo = $nuevo;
                    }
                }
            }
        
            
            

          /*  $array[$i]['garantia'] = NULL;
            $array[$i]['pagare']   = 'TOTAL PAGO';
            $array[$i]['contrato'] = NULL;
            $array[$i]['vPagado'] = '$'.number_format($total, 0);*/

            echo json_encode($array);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getDatosGarantias($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getGarantiasById($Contrato);
            foreach ($datosObligacion as $key) {
                
                echo '<div class="row">
                    <div class="col-md-3" ><label>Numero de Garantia</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->garantia .' </div>
                    <div class="col-md-3" ><label>Numero de Pagaré</label> </div>
                    <div class="col-md-3" id="Datosgestion">'.$key->pagare.' </div>
                </div>';
            }
            

        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function rellenarDatosCombo(){
        if($this->session->userdata('login_ok')){
            $tabla = "G".$_POST['tabla'];
            $nombre = $tabla."_C".$_POST['campo'];
            $consinte = $tabla."_ConsInte__b";

            $datosObligacion = $this->CarteraFng_Model->getFiltrosCombo($tabla, $consinte, $nombre);
            foreach ($datosObligacion as $key) {
                echo '<option value="'.$key->ConsInte__b .'">'. utf8_encode($key->descripcion) .'</option>';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function rellenarDatosComboTipoid(){
        if($this->session->userdata('login_ok')){
            $tabla = "Tipo_identificacion";
            $nombre = "descripcion";
            $consinte = "tipo_id";

            $datosTipoid = $this->CarteraFng_Model->getFiltrosCombo($tabla, $consinte, $nombre);
            foreach ($datosTipoid as $key) {
                echo '<option value="'.$key->ConsInte__b .'">'. utf8_encode($key->descripcion) .'</option>';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function rellenardatosComboLisop(){
        if($this->session->userdata('login_ok')){
            $tabla =$_POST['codigo'];
          
            $datosObligacion = $this->CarteraFng_Model->getListasLisop($tabla);
            foreach ($datosObligacion as $key) {
                echo '<option value="'.$key->LISOPC_ConsInte__b .'">'. utf8_encode($key->LISOPC_Nombre____b) .'</option>';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function rellenardatosComboValores(){
        if($this->session->userdata('login_ok')){
            $tabla =$_POST['codigo'];
            
            $this->db->select('vcp_total_pago, vcp_anho');
            $this->db->from('valores_conceptos_pagos');
            $this->db->where('vcp_codigo', $tabla );
            $this->db->where("vcp_estado = 'ACTIVO'" );
            $query = $this->db->get();
            $datosObligacion = $query->result();
            foreach ($datosObligacion as $key) {
                echo '<option value="'.$key->vcp_total_pago.'" year="'.$key->vcp_anho.'"> $'.number_format($key->vcp_total_pago, 0, '.',',') .'</option>';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }




    function gerAcuerdoPago($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->gerAcuerdoPago($Contrato);
            $tablaExtraJudicial  = '';
            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key) {

                $fecha1 = '';
                $fecha2 = '';
                $fecha3 = '';
                $fecha4 = '';
                $fecha5 = '';

                if(!is_null($key->FECHA_CONSIGNACION_ANTICIPO)){
                    $fecha1 = explode(" ", $key->FECHA_CONSIGNACION_ANTICIPO)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                }

                if(!is_null($key->FECHA_DE_LEGALIZACION)){
                    $fecha2 = explode(" ", $key->FECHA_DE_LEGALIZACION)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA)){
                    $fecha3 = explode(" ", $key->FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }

                if(!is_null($key->FECHA_LIQUIDACION)){
                    $fecha4 = explode(" ", $key->FECHA_LIQUIDACION)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }

                if(!is_null($key->FECHA_ULTIMACUOTA)){
                    $fecha5 = explode(" ", $key->FECHA_ULTIMACUOTA)[0];
                    $fecha5 = explode("-", $fecha5);
                    $fecha5 = $fecha5[2]."/".$fecha5[1]."/".$fecha5[0];
                }

               // var_dump($fecha1);var_dump($fecha2); var_dump($fecha3); var_dump($fecha4); var_dump($fecha5);
                $datos[$i]['FECHA_CONSIGNACION_ANTICIPO'] = $fecha1;
                $datos[$i]['FECHA_DE_LEGALIZACION'] = $fecha2;
                $datos[$i]['VALOR_DEL_ACUERDO'] = "$".number_format($key->VALOR_DEL_ACUERDO, 0, '.',',') ;
                $datos[$i]['PLAZO_ACUERDO_DE_PAGO'] = $key->PLAZO_ACUERDO_DE_PAGO;
                $datos[$i]['FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA'] = $fecha3;
                $datos[$i]['FECHA_LIQUIDACION'] = $fecha4;
                $datos[$i]['FECHA_ULTIMACUOTA'] = $fecha5;
                $datos[$i]['TASAINTERES'] = $key->TASAINTERES." %";
                $datos[$i]['VALOR_CUOTA_DEL_ACUERDO'] = "$".number_format($key->VALOR_CUOTA_DEL_ACUERDO, 0, '.',',') ;
                $datos[$i]['id'] = $key->id ;
                $i++;
                
            }

            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function getDatosAcuerdoDepago($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->gerAcuerdoPagoById($Contrato);
            foreach ($datosObligacion as $key) {
                $fecha1 = '';
                $fecha2 = '';
                $fecha3 = '';
                $fecha4 = '';
                $fecha5 = '';

                if(!is_null($key->FECHA_CONSIGNACION_ANTICIPO)){
                    $fecha1 = explode(" ", $key->FECHA_CONSIGNACION_ANTICIPO)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                }

                if(!is_null($key->FECHA_DE_LEGALIZACION)){
                    $fecha2 = explode(" ", $key->FECHA_DE_LEGALIZACION)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA)){
                    $fecha3 = explode(" ", $key->FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }

                if(!is_null($key->FECHA_LIQUIDACION)){
                    $fecha4 = explode(" ", $key->FECHA_LIQUIDACION)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }

                if(!is_null($key->FECHA_ULTIMACUOTA)){
                    $fecha5 = explode(" ", $key->FECHA_ULTIMACUOTA)[0];
                    $fecha5 = explode("-", $fecha5);
                    $fecha5 = $fecha5[2]."/".$fecha5[1]."/".$fecha5[0];
                }

                echo '<div class="row">
                    <div class="col-md-3" ><label>Numero de contrato</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->CONTRATO .' </div>
                    <div class="col-md-3" ><label>Fecha liquidación</label> </div>
                    <div class="col-md-3" id="Datosgestion">'.$fecha4.' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Fecha consignacion anticipo</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion"> '.$fecha1.'</div>
                    <div class="col-md-3"><label>Fecha de legalización</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.$fecha2.' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Valor del acuerdo</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">$'.number_format($key->VALOR_DEL_ACUERDO, 0, '.',',') .' </div>
                    <div class="col-md-3"  ><label>Plazo acuerdo de pago</label> </div>
                    <div class="col-md-3" id="DatosFecha">'.$key->PLAZO_ACUERDO_DE_PAGO.' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Valor cuota del acuerdo</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion">$'.number_format($key->VALOR_CUOTA_DEL_ACUERDO, 0, '.',',')  .'</div>
                    <div class="col-md-3"><label>Fecha de pago de la primera cuota</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.$fecha3.' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Fecha de pago última cuota</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">'.$fecha5.' </div>
                    <div class="col-md-3"  ><label>Tasa de interés corriente de acuerdo de pago</label> </div>
                    <div class="col-md-3" id="DatosFecha">'.$key->TASAINTERES.' %</div>
                </div>';
            }
            

        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    

    function guardarExtrajudicialTotal(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $identificacion = $_POST['identificacion'];
            $idUduario = $this->Obligaciones_Model->getIdUsuario($identificacion);
       
            $contratos = $this->Obligaciones_Model->getContratos($idUduario);
            $resul = true;
            $nuevo = 0;
            $viejo = 0;

            foreach ($contratos as $contrato) {
                $nuevo = $contrato->liquidacion;
                if($nuevo != $viejo){
                    $datos = array( 'G742_C17242' => $fechaIngreso,
                            'G742_C17243' => $fechaIngreso,
                            'G742_C17244' => $contrato->No_CONTRATO,
                            'G742_C17245' => $user,
                            'G742_C17425' => $idUduario,
                            'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                            'G742_C17249' => $_POST['mediocomunicacion'],
                            'G742_C17250' => $_POST['resultadocomunicacion'],
                            'G742_C17251' => $_POST['gestion'],
                            'G742_C17252' => $_POST['subgestion'],
                            'G742_Usuario' => $this->session->userdata('identificacion'));
                    $resul = $this->Wizard_Model->guardardatos('G742', $datos);
                }
                $viejo = $nuevo;
            }

            

            if($resul){

                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }


    function guardarExtrajudicial2Total(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $identificacion = $_POST['identificacion'];
            $idUduario = $this->Obligaciones_Model->getIdUsuario($identificacion);
            $contratos = $this->Obligaciones_Model->getContratos($idUduario);
            $resul = true;
            $nuevo = 0;
            $viejo = 0;
            foreach ($contratos as $contrato) {
                $nuevo = $contrato->liquidacion;
                if($nuevo != $viejo){
                    $datos = array( 'G742_C17242' => $fechaIngreso,
                                'G742_C17243' => $fechaIngreso,
                                'G742_C17244' => $contrato->No_CONTRATO,
                                'G742_C17425' => $idUduario,
                                'G742_C17245' => $user,
                                'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                                'G742_C17249' => $_POST['mediocomunicacion'],
                                'G742_C17250' => $_POST['resultadocomunicacion'],
                                'G742_C17251' => $_POST['gestion'],
                                'G742_C17252' => $_POST['subgestion'],
                                'G742_Usuario' => $this->session->userdata('identificacion'));

                    $resul = $this->Wizard_Model->guardardatos('G742', $datos);
                }
                $viejo = $nuevo;
            }
            

            if($resul){
                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function guardarExtrajudicial(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array( 'G742_C17242' => $fechaIngreso,
                            'G742_C17243' => $fechaIngreso,
                            'G742_C17244' => $_POST['contrato'],
                            'G742_C17425' => $_POST['cliente'],
                            'G742_C17245' => $user,
                            'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                            'G742_C17249' => $_POST['mediocomunicacion'],
                            'G742_C17250' => $_POST['resultadocomunicacion'],
                            'G742_C17251' => $_POST['gestion'],
                            'G742_C17252' => $_POST['subgestion'],
                            'G742_Usuario' => $this->session->userdata('identificacion'));

            if($this->Wizard_Model->guardardatos('G742', $datos)){
                

               /* $this->db->select('G719_ConsInte__b, G719_C17039, G719_C17423');
                $this->db->from('G719');
                $this->db->where('G719_ConsInte__b', $_POST['contrato']);
                $query = $this->db->get();

                $this->db->select('G719_ConsInte__b');
                $this->db->from('G719');
                $this->db->where('G719_C17039', $query->G719_C17039);
                $this->db->where("G719_C17423 !=  ".$query->G719_C17423);
                $query2 = $this->db->get();

                if($query2->num_rows() > 0){
                    $result = $query2->result();
                    foreach ($result as $key) {
                        $datos = array( 'G742_C17242' => $fechaIngreso,
                            'G742_C17243' => $fechaIngreso,
                            'G742_C17244' => $key->G719_ConsInte__b,
                            'G742_C17425' => $_POST['cliente'],
                            'G742_C17245' => $user,
                            'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                            'G742_C17249' => $_POST['mediocomunicacion'],
                            'G742_C17250' => $_POST['resultadocomunicacion'],
                            'G742_C17251' => $_POST['gestion'],
                            'G742_C17252' => $_POST['subgestion'],
                            'G742_Usuario' => $this->session->userdata('identificacion'));
                        $this->Wizard_Model->guardardatos('G742', $datos);
                    }
                }*/

                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function guardarExtrajudicialTarea(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array( 'G742_C17242' => $fechaIngreso,
                            'G742_C17243' => $fechaIngreso,
                            'G742_C17244' => $_POST['contrato'],
                            'G742_C17425' => $_POST['cliente'],
                            'G742_C17245' => $user,
                            'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                            'G742_C17249' => $_POST['mediocomunicacion'],
                            'G742_C17250' => $_POST['resultadocomunicacion'],
                            'G742_C17251' => $_POST['gestion'],
                            'G742_C17252' => $_POST['subgestion'],
                            'G742_Usuario' => $this->session->userdata('identificacion'),
                            'G742_C17426' => ' - Tarea');

            if($this->Wizard_Model->guardardatos('G742', $datos)){

                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }


    function guardarExtrajudicial2(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array( 'G742_C17242' => $fechaIngreso,
                            'G742_C17243' => $fechaIngreso,
                            'G742_C17244' => $_POST['contrato'],
                            'G742_C17425' => $_POST['cliente'],
                            'G742_C17245' => $user,
                            'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                            'G742_C17249' => $_POST['mediocomunicacion'],
                            'G742_C17250' => $_POST['resultadocomunicacion'],
                            'G742_C17251' => $_POST['gestion'],
                            'G742_C17252' => $_POST['subgestion'],
                            'G742_Usuario' => $this->session->userdata('identificacion'));

            if($this->Wizard_Model->guardardatos('G742', $datos)){
                
                /*$this->db->select('G719_ConsInte__b, G719_C17039, G719_C17423');
                $this->db->from('G719');
                $this->db->where('G719_ConsInte__b', $_POST['contrato']);
                $query = $this->db->get();

                $this->db->select('G719_ConsInte__b');
                $this->db->from('G719');
                $this->db->where('G719_C17039', $query->G719_C17039);
                $this->db->where("G719_C17423 !=  ".$query->G719_C17423);
                $query2 = $this->db->get();

                if($query2->num_rows() > 0){
                    $result = $query2->result();
                    foreach ($result as $key) {
                        $datos = array( 'G742_C17242' => $fechaIngreso,
                            'G742_C17243' => $fechaIngreso,
                            'G742_C17244' => $key->G719_ConsInte__b,
                            'G742_C17425' => $_POST['cliente'],
                            'G742_C17245' => $user,
                            'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                            'G742_C17249' => $_POST['mediocomunicacion'],
                            'G742_C17250' => $_POST['resultadocomunicacion'],
                            'G742_C17251' => $_POST['gestion'],
                            'G742_C17252' => $_POST['subgestion'],
                            'G742_Usuario' => $this->session->userdata('identificacion'));
                        $this->Wizard_Model->guardardatos('G742', $datos);
                    }
                }*/
                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    function guardarExtrajudicial2Tarea(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array( 'G742_C17242' => $fechaIngreso,
                            'G742_C17243' => $fechaIngreso,
                            'G742_C17244' => $_POST['contrato'],
                            'G742_C17425' => $_POST['cliente'],
                            'G742_C17245' => $user,
                            'G742_C17246' => utf8_decode($_POST['txtObservaciones']),
                            'G742_C17249' => $_POST['mediocomunicacion'],
                            'G742_C17250' => $_POST['resultadocomunicacion'],
                            'G742_C17251' => $_POST['gestion'],
                            'G742_C17252' => $_POST['subgestion'],
                            'G742_Usuario' => $this->session->userdata('identificacion'),
                            'G742_C17426' => ' - Tarea');

            if($this->Wizard_Model->guardardatos('G742', $datos)){
                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }


    function guardardatosWizard(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array( 'G735_C17137' => $_POST['actuacion'],
                            'G735_C17138' => $_POST['contrato'],
                            'G735_C17139' => $_POST['txtFechaTramite'],
                            'G735_C17140' => $user,
                            'G735_C17142' => $_POST['etapa'],
                            'G735_C17143' => $_POST['TipoProceso'],
                            'G735_C17219' => utf8_decode($_POST['txtObservaciones']),
                            'G735_C17141' => $fechaIngreso,
                            'G735_Usuario' =>  $this->session->userdata('identificacion'));

            //aqui va peimero la validacion del regisro de subrogacion
            if($_POST['etapa'] == '4'){ //es subrogacion
                //
               
                if( $_POST['actuacion'] == '26'){
                   // echo "aqui";
                    $subrogacion = array('G719_C17212' => $_POST['txtFechaTramite']);
                    $this->Wizard_Model->editarDatos('G719', $subrogacion, $_POST['contrato'], 'G719_ConsInte__b');
                }else{
                    //si ya habia un registro de subrogacion
                    //echo  $_POST['actuacion'];
                    $this->db->select('G719_C17218');
                    $this->db->from('G719');
                    $this->db->where('G719_ConsInte__b', $_POST['contrato']);
                    $query = $this->db->get();
                    //Si existe fecha de impugnacion
                    if($query->row()->G719_C17218 != '' && $query->row()->G719_C17218 != NULL ){ 
                        //Si la actuacion es reconoce al FNG como subrogatario es decicion final
                        if($_POST['actuacion'] == '27'){
                            $subrogacion = array('Fecha_decision_final' => $_POST['txtFechaTramite'], 'G719_C17216' => $_POST['actuacion'] );
                                $this->Wizard_Model->editarDatos('G719', $subrogacion, $_POST['contrato'], 'G719_ConsInte__b');
                        }

                        
                    }else{ //Si no existe fecha de impugnacion

                        if( $_POST['actuacion'] == '27' || $_POST['actuacion'] == '28' || $_POST['actuacion'] == '29' || $_POST['actuacion'] == '30' || $_POST['actuacion'] == '31' || $_POST['actuacion'] == '32' || $_POST['actuacion'] == '33' || $_POST['actuacion'] == '34' || $_POST['actuacion'] == '35' || $_POST['actuacion'] == '36'){
                            
                            if($_POST['actuacion'] == '29'){

                                $subrogacion = array('G719_C17213' => $_POST['txtFechaTramite'], 'G719_C17214' => $_POST['actuacion'] );
                                $this->Wizard_Model->editarDatos('G719', $subrogacion, $_POST['contrato'], 'G719_ConsInte__b');
                            }else{                                //echo 'aqui';
                                $subrogacion = array('G719_C17213' => $_POST['txtFechaTramite'], 'G719_C17214' => $_POST['actuacion'] );
                                $this->Wizard_Model->editarDatos('G719', $subrogacion, $_POST['contrato'], 'G719_ConsInte__b');    
                            }

                        }else{
                            if($_POST['actuacion'] == '198' || $_POST['actuacion'] == '199' ){
                                $subrogacion = array('G719_C17218' => $_POST['txtFechaTramite'], 'G719_C17215' => $_POST['actuacion'] );
                                $this->Wizard_Model->editarDatos('G719', $subrogacion, $_POST['contrato'], 'G719_ConsInte__b');
                            }
                        }
                    }

                    
                }
            }else if($_POST['etapa'] == '22'){
                if($_POST['actuacion'] == '179'){
                    // echo "aqui";
                    $subrogacion = array('G719_C17212' => $_POST['txtFechaTramite']);
                    $this->Wizard_Model->editarDatos('G719', $subrogacion, $_POST['contrato'], 'G719_ConsInte__b');

                }else if($_POST['actuacion'] == '180' || $_POST['actuacion'] == '181' || $_POST['actuacion'] == '182' ){
                    $subrogacion = array('Fecha_decision_final' => $_POST['txtFechaTramite'], 'G719_C17214' => $_POST['actuacion'] );
                    $this->Wizard_Model->editarDatos('G719', $subrogacion, $_POST['contrato'], 'G719_ConsInte__b');
                } 
            }
            

           if($this->Wizard_Model->guardardatos('G735', $datos)){
                $this->db->select('G719_ConsInte__b, G719_C17039, G719_C17423');
                $this->db->from('G719');
                $this->db->where('G719_ConsInte__b', $_POST['contrato']);
                $query = $this->db->get();

                $this->db->select('G719_C17423');
                $this->db->from('G719');
                $this->db->where('G719_C17039', $query->row()->G719_C17039);
                $this->db->where("G719_C17423 !=  ".$query->row()->G719_C17423);
                $this->db->group_by('G719_C17423');
                $query2 = $this->db->get();

                if($query2->num_rows() > 0){
                    $result = $query2->result();
                    foreach ($result as $key) {
                        $id = 0;
                        $this->db->select('TOP 1 G719_ConsInte__b');
                        $this->db->from('G719');
                        $this->db->where("G719_C17423 = ".$key->G719_C17423);
                        $query3 = $this->db->get(); 
                        $id = $query3->row()->G719_ConsInte__b;

                       $datos = array( 'G735_C17137' => $_POST['actuacion'],
                            'G735_C17138' => $id ,
                            'G735_C17139' => $_POST['txtFechaTramite'],
                            'G735_C17140' => $user,
                            'G735_C17142' => $_POST['etapa'],
                            'G735_C17143' => $_POST['TipoProceso'],
                            'G735_C17219' => utf8_decode($_POST['txtObservaciones']),
                            'G735_C17141' => $fechaIngreso,
                            'G735_Usuario' =>  $this->session->userdata('identificacion'));
                        $this->Wizard_Model->guardardatos('G735', $datos);

                        if($_POST['etapa'] == '4'){ //es subrogacion
                            if( $_POST['actuacion'] == '26'){
                               // echo "aqui";
                                $subrogacion = array('G719_C17212' => $_POST['txtFechaTramite']);
                                $this->Wizard_Model->editarDatos('G719', $subrogacion,  $id , 'G719_ConsInte__b');
                            }else{
                                //si ya habia un registro de subrogacion
                                //echo  $_POST['actuacion'];
                                $this->db->select('G719_C17218');
                                $this->db->from('G719');
                                $this->db->where('G719_ConsInte__b',  $id );
                                $query = $this->db->get();
                                //Si existe fecha de impugnacion
                                if($query->row()->G719_C17218 != '' && $query->row()->G719_C17218 != NULL ){ 
                                    //Si la actuacion es reconoce al FNG como subrogatario es decicion final
                                    if($_POST['actuacion'] == '27'){
                                        $subrogacion = array('Fecha_decision_final' => $_POST['txtFechaTramite'], 'G719_C17216' => $_POST['actuacion'] );
                                            $this->Wizard_Model->editarDatos('G719', $subrogacion,  $id , 'G719_ConsInte__b');
                                    }

                                    
                                }else{ //Si no existe fecha de impugnacion

                                    if( $_POST['actuacion'] == '27' || $_POST['actuacion'] == '28' || $_POST['actuacion'] == '29' || $_POST['actuacion'] == '30' || $_POST['actuacion'] == '31' || $_POST['actuacion'] == '32' || $_POST['actuacion'] == '33' || $_POST['actuacion'] == '34' || $_POST['actuacion'] == '35' || $_POST['actuacion'] == '36'){
                                        
                                        if($_POST['actuacion'] == '29'){

                                            $subrogacion = array('G719_C17213' => $_POST['txtFechaTramite'], 'G719_C17214' => $_POST['actuacion'] );
                                            $this->Wizard_Model->editarDatos('G719', $subrogacion, $id , 'G719_ConsInte__b');
                                        }else{                                //echo 'aqui';
                                            $subrogacion = array('G719_C17213' => $_POST['txtFechaTramite'], 'G719_C17214' => $_POST['actuacion'] );
                                            $this->Wizard_Model->editarDatos('G719', $subrogacion,  $id , 'G719_ConsInte__b');    
                                        }

                                    }else{
                                        if($_POST['actuacion'] == '198' || $_POST['actuacion'] == '199' ){
                                            $subrogacion = array('G719_C17218' => $_POST['txtFechaTramite'], 'G719_C17215' => $_POST['actuacion'] );
                                            $this->Wizard_Model->editarDatos('G719', $subrogacion, $id , 'G719_ConsInte__b');
                                        }
                                    }
                                }

                                
                            }
                        }else if($_POST['etapa'] == '22'){
                            if($_POST['actuacion'] == '179'){
                                // echo "aqui";
                                $subrogacion = array('G719_C17212' => $_POST['txtFechaTramite']);
                                $this->Wizard_Model->editarDatos('G719', $subrogacion,  $id , 'G719_ConsInte__b');

                            }else if($_POST['actuacion'] == '180' || $_POST['actuacion'] == '181' || $_POST['actuacion'] == '182' ){
                                $subrogacion = array('Fecha_decision_final' => $_POST['txtFechaTramite'], 'G719_C17214' => $_POST['actuacion'] );
                                $this->Wizard_Model->editarDatos('G719', $subrogacion,  $id , 'G719_ConsInte__b');
                            } 
                        }
            
                    }
                }
                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }


    function guardarMedidas(){
        if($this->session->userdata('login_ok')){
            $user  = $this->session->userdata('nombres');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");
            $calificacion = NULL;
            if(isset($_POST['Calificacionesobligaciones'])){
                $calificacion = $_POST['Calificacionesobligaciones'];
            }
            $datos = array( 'G736_C17283' => $fechaIngreso,
                            'G736_C17144' => $_POST['FechaSolicitud'],
                            'G736_C17145' => $_POST['FechaDecreto'],
                            'G736_C17284' => $user,
                            'G736_C17146' => $_POST['FechaPractica'],
                            'G736_C17147' => utf8_decode($_POST['Secuestre']),
                            'G736_C17148' => utf8_decode($_POST['OtroBien']),
                            'G736_C17149' => utf8_decode($_POST['Observaciones']),
                            'G736_C17150' => $_POST['medidaCautelar'],
                            'G736_C17151' => $_POST['contrato'],
                            'G736_Usuario' => $this->session->userdata('identificacion'),
                            'resultadoMedida' => $calificacion);

            if($this->Wizard_Model->guardardatos('G736', $datos)){
               /* $this->db->select('G719_ConsInte__b, G719_C17039, G719_C17423');
                $this->db->from('G719');
                $this->db->where('G719_ConsInte__b', $_POST['contrato']);
                $query = $this->db->get();

                $this->db->select('G719_ConsInte__b');
                $this->db->from('G719');
                $this->db->where('G719_C17039', $query->G719_C17039);
                $this->db->where("G719_C17423 !=  ".$query->G719_C17423);
                $query2 = $this->db->get();

                if($query2->num_rows() > 0){
                    $result = $query2->result();
                    foreach ($result as $key) {
                        
                        $datos = array( 'G736_C17283' => $fechaIngreso,
                            'G736_C17144' => $_POST['FechaSolicitud'],
                            'G736_C17145' => $_POST['FechaDecreto'],
                            'G736_C17284' => $user,
                            'G736_C17146' => $_POST['FechaPractica'],
                            'G736_C17147' => utf8_decode($_POST['Secuestre']),
                            'G736_C17148' => utf8_decode($_POST['OtroBien']),
                            'G736_C17149' => utf8_decode($_POST['Observaciones']),
                            'G736_C17150' => $_POST['medidaCautelar'],
                            'G736_C17151' => $$key->G719_ConsInte__b,
                            'G736_Usuario' => $this->session->userdata('identificacion'),
                            'resultadoMedida' => $calificacion);

                        $this->Wizard_Model->guardardatos('G736', $datos);
                    }
                }*/
                echo '1';
            }else{
                echo 'Un error a ocurrido';
            }
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    }

    //Aqui se mmuestran los Paz y salvo
     function PazySalvo(){
        
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $clientes = $this->CarteraFng_Model->getObligacionesPazSalvo();
            $data = array();
            $i = 0;
            foreach($clientes as $key){ 
                $fecha = explode(" ",$key->fecha)[0];
                $fecha = explode("-",$fecha);
                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);


                $this->db->select('G735_C17139 as txtFechaTramite');
                $this->db->from('G735');
                $this->db->where('G735_C17138', $key->id);
                $this->db->where('G735.G735_C17137 = 153');
                $query = $this->db->get();
                $fechT = NULL;
                if($query->num_rows() > 0){
                    if(!is_null($query->row()->txtFechaTramite)){
                        $fecha_Tramite1 = explode(" ",$query->row()->txtFechaTramite)[0];
                        $fecha_Tramite = explode("-",$fecha_Tramite1);
                        $fechT = "<span style='display: none;'>".$fecha_Tramite[0]."/".$fecha_Tramite[1]."/".$fecha_Tramite[2]."</span>".$fecha_Tramite[2]."/".$fecha_Tramite[1]."/".$fecha_Tramite[0];
                    }
                }else{
                    $this->db->select('G735_C17139 as txtFechaTramite');
                    $this->db->from('G735');
                    $this->db->where('G735_C17138', $key->id);
                    $this->db->where('G735.G735_C17137 = 157');
                    $query = $this->db->get();
                    if($query->num_rows() > 0){
                        if(!is_null($query->row()->txtFechaTramite)){
                            $fecha_Tramite1 = explode(" ",$query->row()->txtFechaTramite)[0];
                            $fecha_Tramite = explode("-",$fecha_Tramite1);
                            $fechT = $fecha_Tramite[2]."/".$fecha_Tramite[1]."/".$fecha_Tramite[0];
                        }
                    }
                }
                
                $data[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $data[$i]['identificacion'] =  $key->identificacion ;
                $data[$i]['tipo_identificacion'] =  $key->tipo_identificacion ;
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $data[$i]['contrato'] = $key->liquidacion;
                }else{
                    $data[$i]['contrato'] = $key->contrato;
                }
                $data[$i]['sap'] = $key->sap;
                $data[$i]['fecha'] = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                $data[$i]['fechaTramite'] = $fechT;
                $i++;
            }
            

            $datos = array('clientes' => json_encode($data));
            $datosFooter = array('ul'=> 'ULcartera' , 'li' => 'LIjudicial');
         
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/PazySalvo', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getEtapasProceso($proceso){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getEtapasByProceso($proceso);
            $datos = array('Etapas' => $abogados);
            $this->load->view("carteraFng/etapas", $datos);
        }else{
            echo "No tiene permisos para ver esta información!";
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
                $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
                $data[$i]['INTERMEDIARIO'] = utf8_encode($key->financiera) ;
                $data[$i]['OBLIGACION'] = $key->contrato ;
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

// Color liquidaciones Hecho por Jeisson Patiño 5/12/2018 

    function ColoresLiquidacicones($Contrato){

        if($this->session->userdata('login_ok')){
            $ArregloColor = $this->Obligaciones_Model->getColoresLiquidacicones($Contrato);
            $data = array();
            $i = 0;

            foreach ($ArregloColor as $key) {
                if($key->Contrato != '' && ! is_null($key->liquidacion)){
                    $data[$i]['Contrato'] = $key->liquidacion;
                }else{
                    $data[$i]['Contrato'] = $key->Contrato;
                }

                $data[$i]['Intermediario'] = utf8_encode($key->intermediario) ;
                $data[$i]['ColorLiquidaciones.Estado'] = $key->Estado ;
                $data[$i]['intermediario'] = utf8_encode($key->intermediario) ;
                $data[$i]['ColorLiquidaciones.Color'] = utf8_encode($key->Color);

                $i++;
            }
            $datos = array( 'ResultadoColores' => json_encode($json));

            var_dump(json_encode($json)); 
            $this->load->view('carteraFng/datosJudiciales', $datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
        
    }

    function imprimirPlano1 ($texto){
        $file = fopen("archivo.txt", "w");
        fwrite($file, $texto . PHP_EOL);
        fwrite($file, "Otra más" . PHP_EOL);
        fclose($file);
    }


    //eliminar gestion Judicial
    function eliminarGestion(){
        if($this->session->userdata('login_ok')){

            $usuario = $this->session->userdata('nombres');
            $id = $this->session->userdata('identificacion');
            
            $numliquidacion =  $_POST['NumLiquidacion'];
            
            $LiquidacionJucial = $this->Reportes_Model->LlenarTablaLogeliminacionLiquidacionJudicial($usuario,$id,$numLiquidacion);
            $this->db->where('G735_ConsInte__b', $_POST['IdEliminar']);
            if($this->db->delete('G735')){
                echo '1';
            }else{
                echo '0';
            }
        }else{
            echo "No tiene permisos para ver esta información!";
        }
    }

// Datos Filtro por Fecha de Venta CISA Jeisson Patiño 




    /*function rellenarDatosComboFechaventa(){
        $years = $this->CarteraFng_Model->getfechasyear();
        $data = array();
        foreach ($years as $key) {
            $filtroSelect = new stdClass();
            $filtroSelect->campoLista='year';
         array_push($data, $filtroSelect);
        }
        sort($data);

        $datos = array('fecha' => $data);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('carteraFng/busquedaAvanzada', $datos);
            $this->load->view('Includes/footer');
    }*/

    function rellenarDatosComboFechaventaMes($fecha){
        $month = $this->CarteraFng_Model->getfechasMes($fecha);
        echo "<option value='0'>Seleccione</option>";
        foreach ($month as $key) {
            echo "<option value='".$key->month."'>".$key->nombre."</option>";
        }
        
    }


    function imprimirPlano ($texto){
        $file = fopen("archivo.txt", "w");
        fwrite($file, $texto . PHP_EOL);
        fwrite($file, "Otra más" . PHP_EOL);
        fclose($file);
    }

     function FechaVentaCisa(){
        $anio = $_POST['anio'];
        $mes = $_POST['mes'];
        $mesS ="";
        ///$this->imprimirPlano($mes[0]);
        foreach ($mes as $key) {
            $mesS .= $key.',';
        }
        $mesS = substr($mesS, 0, -1);
        
        //$this->imprimirPlano(json_encode($anio.'-'.$mes));
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $this->load->model('carterafng_Model');
           

            $fechaventa = $this->carterafng_Model->getDatosFechaVentaCisa($anio,$mesS);
            $data = array();
            $i = 0;
            foreach($fechaventa as $key){
                $DEUDOR = trim(utf8_encode($key->DEUDOR));
                $nombre = substr($DEUDOR, 0, 3);
                $data[$i]['DEUDOR'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$DEUDOR ;
                
                $data[$i]['Identificacion'] = $key->Identificacion ;
                $data[$i]['TipoIdentificacion'] = $key->TipoIdentificacion ;
                $data[$i]['Ciudad'] = utf8_encode($key->Ciudad) ;
                $data[$i]['IF'] = $key->IF ;
                $data[$i]['Liquidacion'] = $key->Liquidacion ;
                $data[$i]['ProcesoSAP'] = utf8_encode($key->ProcesoSAP) ;
                $data[$i]['ValorPago'] ="$".number_format($key->ValorPago,  0, '.',',')  ;
                
                $data[$i]['ROL'] = utf8_encode($key->ROL);
                $data[$i]['FechaVenta'] = utf8_encode($key->FechaVenta);
                $i++;
            }
          //$this->imprimirPlano(json_encode($data));

            echo json_encode($data);

        }else{
            echo "No tiene permisos para ver esta información!";
        }
    }

}