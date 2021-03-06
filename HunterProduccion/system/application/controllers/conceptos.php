
<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Conceptos extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
		$this->load->model('Conceptos_Model');
    }

    function getDatosByID($id){
        if($this->session->userdata('login_ok')){
            $datos = $this->Conceptos_Model->Conceptos__aPagar_by($id);
            $sjon = array();
            foreach ($datos as $key) {
                $sjon['vcp_anho'] = $key->vcp_anho ;
                $sjon['vcp_codigo'] = $key->vcp_codigo ;
                $sjon['vcp_total_pago'] = $key->vcp_total_pago ;
                $sjon['vcp_fecha_ingreso'] = $key->vcp_fecha_ingreso ;
                $sjon['vcp_estado'] = $key->vcp_estado ;
                $sjon['vcp_id'] = $key->vcp_id ;
                $sjon['concepto'] = utf8_encode($key->concepto);
            }

            echo json_encode($sjon);
        }else{
            echo 'No tiene permisos para ver este contenido!';
        }
    }
    public function guardarConceptosExcel(){
    	if($this->session->userdata('login_ok')){
            $this->load->library('excel');
         

            $filtro = $_POST['cmbFiltrosMax'];

            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit', '1024M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" && $value['B'] && $value['C']  ){
                       
                        $datos = array(
                            'vcp_anho' => $value['A'] ,
                            'vcp_codigo' => $filtro ,
                            'vcp_total_pago' => $value['B'],
                            'vcp_estado' => $value['C']
                          );
                        $resultado = false;
                        $resultado = $this->Wizard_Model->guardardatos('valores_conceptos_pagos', $datos);

                        if($resultado){
                            $acertados += 1;
                        }else{
                            $fallos +=1;
                        }
                    }else{
                    	$validador++;
                    }
                    $i++;
                }
            }
            
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['registros'] = $i;
            $result['message'] = 'Datos Cargados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  

        }else{
            $this->load->view('Login/login');
        }
    }

    function guardarConceptos(){
    	if($this->session->userdata('login_ok')){
    		$datos = array(
                'vcp_anho' => $_POST['anho'] ,
                'vcp_codigo' => $_POST['concepto'] ,
                'vcp_total_pago' => $_POST['valor'],
                'vcp_estado' => $_POST['estado']
              );
            $resultado = false;
            if($_POST['id_subrogacione'] == 0){
                $resultado = $this->Wizard_Model->guardardatos('valores_conceptos_pagos', $datos);
            }else{
                $this->db->where('vcp_id', $_POST['id_subrogacione']);
                $resultado = $this->db->update('valores_conceptos_pagos', $datos);
            }
            

            if($resultado){
                echo "1";
            }else{
                echo "2";
            }
		}else{
            $this->load->view('Login/login');
        }
    }

    //Desde aqui inicia la carga  y descarga de subrogacion
    function subrogacion(){
    	if($this->session->userdata('login_ok')){
    	
            $datosFooter = array('ul'=> 'ULAUXILIARES' , 'li' => 'LIAux-subrogacion');
       
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Conceptos/subrogaciones');
            $this->load->view('Includes/footer', $datosFooter);
		}else{
            $this->load->view('Login/login');
        }
    }

    function buscarValoresSubrogacion(){
    	if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltrosMax'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit', '1024M');
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" && $value['B'] != "" && $value['C'] != "" && $value['D'] != "" && $value['E'] != "" ){
                       // $resultados = $this->Conceptos_Model->getValoresSubrogacion($value['A']);
                       //1 No contrato 2. No de factura 3. Fecha de factura 4. Fecha trámite subrogación y 5. Valor a pagar
                        	$fecha2 = NULL;
                            $fecha3 = NULL;
                        	$fecha = NULL;
                            $fechas = NULL;
                        	//$anho = 2015;
                        	//$actual = date('y');
                        	//$anho = $actual - 1;

                    		$fecha 	= explode('/', $value['C']);
                            //$anho = $fecha[2];
                    		$fecha2 = $fecha[2]."-".$fecha[1]."-".$fecha[0];

                            $fechas  = explode('/', $value['D']);
                            $fecha3 = $fechas[2]."-".$fechas[1]."-".$fechas[0];
	                        
                           
                        	//$valores = $this->Conceptos_Model->getValoresConcepto($anho, 'AUX001');
                            $contrato = 0;
                           // $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);
                            if($filtro == 'G719_C17423'){
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17423', $value['A']);
                                $contrato = $this->db->get();
                            }else{
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $contrato = $this->db->get();
                            }
                            
                  
                            if($contrato->row()->G719_ConsInte__b != 0){
                                //voy a buscar si acepto la subrogacion
                                

                               
                                $aja = $this->db->get_where('G744', array('G744_C17280' => $contrato->row()->G719_ConsInte__b));
                                $this->db->select('G744_ConsInte__b');
                                $this->db->from('G744');
                                $this->db->where('G744_C17280', $contrato->row()->G719_ConsInte__b);
                                $aja = $this->db->get();
                                $res = $aja->result();

                                $resultado = false;
                                if($aja->num_rows() > 0){
                                     $datosActualizados = array( 'G744_FechaInsercion' => $fechaIngreso,
                                                                    'G744_Usuario' => $this->session->userdata('identificacion'),
                                                                    'G744_C17262' => $fecha2, 
                                                                    'G744_C17263' => $value['B'],
                                                                    'G744_C17264' => $fecha3,
                                                                    'G744_C17276' => $value['E']);
                                    $resultado = $this->Wizard_Model->editarDatos('G744', $datosActualizados, $contrato->row()->G719_ConsInte__b, 'G744_C17280');
                                }else{
                                    $datosActualizados = array( 'G744_FechaInsercion' => $fechaIngreso,
                                                            'G744_Usuario' => $this->session->userdata('identificacion'),
                                                            'G744_C17262' => $fecha2, 
                                                            'G744_C17263' => $value['B'],
                                                            'G744_C17264' => $fecha3,
                                                            'G744_C17276' => $value['E'],
                                                            'G744_C17280' => $contrato->row()->G719_ConsInte__b);
                                    $resultado = $this->Wizard_Model->guardardatos('G744', $datosActualizados);
                                }
                                
                                if($resultado){
                                    $acertados++;
                                }
                            }else{
                                $fallosExistenciales++;
                            }
                            
                    }else{
                    	$validador++;
                    }
                    $i++;
                }
            }
            $resultados = array();
            $resultados['total'] = $i;
            $resultados['acertados'] = $acertados;
            $resultados['noExisten'] = $fallosExistenciales;

            echo json_encode($resultados);
        }else{
            $this->load->view('Login/login');
        }
    }


    function descargarValoresSubrogacion(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            

            $filtro = $_POST['cmbFiltrosMaxDescargue'];
            $name   = $_FILES['FilExcellDescargue']['name'];
            $tname  = $_FILES['FilExcellDescargue']['tmp_name'];
            ini_set('memory_limit', '1024M');
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" ){
                       
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            $fecha = NULL;
                            $fechas = NULL;
                            //$anho = 2015;
                            //$actual = date('y');
                            //$anho = $actual - 1;
                
                            $contrato = 0;
                           // $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);
                            if($filtro == 'G719_C17423'){
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17423', $value['A']);
                                $contrato = $this->db->get();
                            }else{
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $contrato = $this->db->get();
                            }
                            
                        if($contrato->num_rows() > 0)
                            if($contrato->row()->G719_ConsInte__b != 0){
                                $this->db->select('G719_C17213 as fecha_decicion, G719_C17214 as decicion, Fecha_decision_final, G719_C17216');
                                $this->db->from('G719');
                                $this->db->where('G719_ConsInte__b', $contrato->row()->G719_ConsInte__b );
                                $aja = $this->db->get();
                                
                                
                                
                                $resultado = false;
                                //echo $contrato->row()->G719_ConsInte__b;
                                if($aja->num_rows() > 0){
                                     
                                    $fecha3 = NULL;
                                    $fecha4 = NULL;
                                    $anho = '';
                                    
                                    $estos = $aja->result();

                                    foreach ( $estos as $key) {
                                        if(!is_null($key->decicion)){
                                           // echo $key->decicion;
                                            if($key->decicion == 27){
                                                $fecha3 = explode(' ', $key->fecha_decicion)[0];
                                                $fecha3 = explode('-', $fecha3);
                                                $anho = $fecha3[0];
                                                $fecha4 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                            }else{
                                                if(!is_null($key->G719_C17216)){
                                                    if($key->G719_C17216 == 27){
                                                        if(!is_null($key->Fecha_decision_final)){
                                                            $fecha3 = explode(' ', $key->Fecha_decision_final)[0];
                                                            $fecha3 = explode('-', $fecha3);
                                                            $anho = $fecha3[0];
                                                            $fecha4 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                        }
                                                        
                                                    }
                                                
                                                } 
                                            }
                                           
                                        }else{
                                            if(!is_null($key->G719_C17216)){
                                                if($key->G719_C17216 == 27){
                                                   if(!is_null($key->Fecha_decision_final)){
                                                        $fecha3 = explode(' ', $key->Fecha_decision_final)[0];
                                                        $fecha3 = explode('-', $fecha3);
                                                        $anho = $fecha3[0];
                                                        $fecha4 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                    }
                                                }
                                            
                                            } 
                                        }
                                        $valores = '';
                                        if($anho != ''){
                                            $valores = $this->Conceptos_Model->getValoresConcepto($anho, 'AUX001');
                                            $valores = "$ ".number_format($valores, 0, ',', '.');
                                        }
                                        
                                        $this->db->select('G744_C17276');
                                        $this->db->from('G744');
                                        $this->db->where('G744_C17280', $contrato->row()->G719_ConsInte__b );
                                        $valorPagado = $this->db->get();
                                        $valu = 0;

                                        if($valorPagado->num_rows() > 0){
                                            $valu = "$ ".number_format($valorPagado->row()->G744_C17276, 0, ',', '.');
                                        }


                                        $datos[$j]['Ncontrato'] = $value['A'];
                                        $datos[$j]['fecha'] = $fecha4;
                                        $datos[$j]['valor'] = $valores;
                                        $datos[$j]['valor_pagado'] = $valu;
                                        $j++;
                                    }
                                }

                            }
                            
                    }else{
                        $validador++;
                    }
                    $i++;
                    
                }
            }
            

            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }


    //Desde aqui inicia la carga  y descarga de Sentencia Irrecuperable
    function sentencia_irrecuperable(){
    	if($this->session->userdata('login_ok')){
    	
            $datosFooter = array('ul'=> 'ULAUXILIARES' , 'li' => 'LIAux-sentencias');
       
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Conceptos/sentenciaIrrecuperable');
            $this->load->view('Includes/footer', $datosFooter);
		}else{
            $this->load->view('Login/login');
        }
    }

    function cargar_sentencia_irrecuperable(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltrosMax'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit', '1024M');
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" && $value['B'] != "" && $value['C'] != "" && $value['D'] != "" && $value['E'] != "" && $value['F'] != "" && $value['G'] != ""){
       
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            $fecha4 = NULL;
                            $fecha5 = NULL;
                            $fecha  = NULL;
                            $fechas = NULL;


                            $fecha  = explode('/', $value['C']);
                            //$anho = $fecha[2];
                            $fecha2 = $fecha[2]."-".$fecha[1]."-".$fecha[0];

                            $fechas  = explode('/', $value['D']);
                            $fecha3 = $fechas[2]."-".$fechas[1]."-".$fechas[0];

                            $fechas2  = explode('/', $value['E']);
                            $fecha4 = $fechas2[2]."-".$fechas2[1]."-".$fechas2[0];

                            $fechas3  = explode('/', $value['F']);
                            $fecha5 = $fechas3[2]."-".$fechas3[1]."-".$fechas3[0];

                            $contrato = 0;

                            if($filtro == 'G719_C17423'){
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17423', $value['A']);
                                $contrato = $this->db->get();
                            }else{
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $contrato = $this->db->get();
                            }
                            
                            if($contrato->num_rows() > 0){
                                $this->db->select('G744_ConsInte__b');
                                $this->db->from('G744');
                                $this->db->where('G744_C17280', $contrato->row()->G719_ConsInte__b);
                                $aja = $this->db->get();
       
                                
                                $resultado = false;
                                if($aja->num_rows() > 0){
                                     $datosActualizados = array(    'G744_FechaInsercion' => $fechaIngreso,
                                                                    'G744_Usuario' => $this->session->userdata('identificacion'),
                                                                    'G744_C17267' => $fecha2, 
                                                                    'G744_C17265' => $value['B'], 
                                                                    'G744_C17286' => $fecha3, 
                                                                    'G744_C17266' => $fecha4, 
                                                                    'G744_C17285' => $fecha5,
                                                                    'G744_C17277' => $value['G']);
                                    $resultado = $this->Wizard_Model->editarDatos('G744', $datosActualizados, $contrato->row()->G719_ConsInte__b, 'G744_C17280');
                                }else{
                                    $datosActualizados = array(     'G744_FechaInsercion' => $fechaIngreso,
                                                                    'G744_Usuario' => $this->session->userdata('identificacion'),
                                                                    'G744_C17267' => $fecha2, 
                                                                    'G744_C17265' => $value['B'], 
                                                                    'G744_C17286' => $fecha3, 
                                                                    'G744_C17266' => $fecha4, 
                                                                    'G744_C17285' => $fecha5,
                                                                    'G744_C17277' => $value['G'],
                                                                    'G744_C17280' => $contrato->row()->G719_ConsInte__b);
                                    $resultado = $this->Wizard_Model->guardardatos('G744', $datosActualizados);
                                }
                                
                                if($resultado){
                                    $acertados++;
                                }
                            }else{
                                $fallosExistenciales++;
                            }
                            
                    }else{
                        $validador++;
                    }
                    $i++;
                }
            }
            $resultados = array();
            $resultados['total'] = $i;
            $resultados['acertados'] = $acertados;
            $resultados['noExisten'] = $fallosExistenciales;

            echo json_encode($resultados);
        }else{
            $this->load->view('Login/login');
        }
    }

    function descargar_sentencia_irrecuperable(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltrosMaxDescargue'];
            $name   = $_FILES['FilExcellDescargue']['name'];
            $tname  = $_FILES['FilExcellDescargue']['tmp_name'];
            ini_set('memory_limit', '1024M');
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array();
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" ){
                        $contrato = 0;
                       //obtenemos el ID si es por Liquidacion o por contrato
                        if($filtro == 'G719_C17423'){
                            $this->db->select('G719_ConsInte__b');
                            $this->db->from('G719');
                            $this->db->where('G719_C17423', $value['A']);
                            $contrato = $this->db->get();
                        }else{
                            $this->db->select('G719_ConsInte__b');
                            $this->db->from('G719');
                            $this->db->where('G719_C17026', $value['A']);
                            $contrato = $this->db->get();
                        }
                        
                        //si ese numero de contrato es valido hacemos es el proceso
                        if($contrato->num_rows() > 0){    
                            //$contrato->row()->G719_ConsInte__b != 0
                            //G719_C17216 -- esta es la decision final --actuacion 27
                            //G719_C17213 -- fecha tramite
                            $this->db->select('G719_C17213 as fecha_decicion, G719_C17214 as decicion, Fecha_decision_final, G719_C17216 ');
                            $this->db->from('G719');
                            $this->db->where('G719_ConsInte__b', $contrato->row()->G719_ConsInte__b );
                            $aja = $this->db->get();
                            
                            
                            /*$this->db->select('G744_C17264, G744_C17276');
                            $this->db->from('G744');
                            $this->db->where('G744_C17280', $contrato->row()->G719_ConsInte__b);
                            $aja = $this->db->get();*/
                            $resultado = false;
                            //echo $contrato->row()->G719_ConsInte__b;
                            if($aja->num_rows() > 0){
                                $fechaDecicion = '';
                                $fechaSentcnia = '';
                                    
                                $fecha3 = NULL;
                                $fecha4 = NULL;
                                $anho = '';
                                
                                $estos = $aja->result();

                                foreach ( $estos as $key) {
                                    //primero obtenemos la fecha de la decicion final
                                    if(!is_null($key->decicion)){
                                        if($key->decicion == 27){
                                            if(!is_null($key->fecha_decicion)){
                                                $fecha3 = explode(' ', $key->fecha_decicion)[0];
                                                $fecha3 = explode('-', $fecha3);
                                                
                                                $fecha4 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                $fechaDecicion = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];    
                                            }
                                            
                                        }else{
                                            if(!is_null($key->G719_C17216)){
                                                if($key->G719_C17216 == 27){
                                                   if(!is_null($key->Fecha_decision_final)){
                                                        $fecha3 = explode(' ', $key->Fecha_decision_final)[0];
                                                        $fecha3 = explode('-', $fecha3);
                                                        $fecha4 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                        $fechaDecicion = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];    
                                                    }
                                                    
                                                }
                                            
                                            } 
                                        }
                                    }else{
                                        if(!is_null($key->G719_C17216)){
                                            if($key->G719_C17216 == 27){
                                                if(!is_null($key->Fecha_decision_final)){
                                                    $fecha3 = explode(' ', $key->Fecha_decision_final)[0];
                                                    $fecha3 = explode('-', $fecha3);
                                                    
                                                    $fecha4 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                    $fechaDecicion = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];    
                                                }

                                                
                                            }
                                        }
                                    }

                                    $fecha_sentencia_favorable = NULL;
                                    //ahora buscamos la sentencia faborable
                                   

                                    $this->db->select('G735_C17139');
                                    $this->db->from('G735');
                                    $this->db->where('G735_C17138', $contrato->row()->G719_ConsInte__b);
                                    $this->db->where('G735_C17137', 62);
                                    $sentencia1 = $this->db->get();

                                    if($sentencia1->num_rows() > 0){
                                        $dat =  $sentencia1->result();
                                        foreach ($dat as $key ) {
                                            if(!is_null($key->G735_C17139)){
                                                $fecha3 = explode(' ', $key->G735_C17139)[0];
                                                $fecha3 = explode('-', $fecha3);
                                                $anho = $fecha3[0];
                                                $fecha_sentencia_favorable = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                $fechaSentcnia = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];
                                            }
                                            
                                            
                                        }
                                        
                                    }

                                    $fecha_liquidacion = NULL;
                                    $this->db->select('G735_C17139');
                                    $this->db->from('G735');
                                    $this->db->where('G735_C17138', $contrato->row()->G719_ConsInte__b);
                                    $this->db->where('G735_C17137 = 79');
                                    $sentencia2 = $this->db->get();

                                    if($sentencia2->num_rows() > 0){
                                        $dat2 =  $sentencia2->result();
                                        foreach ($dat2 as $key ) {
                                            if(!is_null($key->G735_C17139)){
                                                $fecha3 = explode(' ', $key->G735_C17139)[0];
                                                $fecha3 = explode('-', $fecha3);
                                                $fecha_liquidacion = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                            }
                                            
                                        }
                                        
                                    }else{
                                        $this->db->select('G735_C17139');
                                        $this->db->from('G735');
                                        $this->db->where('G735_C17138', $contrato->row()->G719_ConsInte__b);
                                        $this->db->where('G735_C17137 = 80');
                                        $sentencia2 = $this->db->get();

                                        if($sentencia2->num_rows() > 0){
                                            $dat2 =  $sentencia2->result();
                                            foreach ($dat2 as $key ) {
                                                if(!is_null($key->G735_C17139)){
                                                    $fecha3 = explode(' ', $key->G735_C17139)[0];
                                                    $fecha3 = explode('-', $fecha3);
                                                    $fecha_liquidacion = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                }
                                            }
                                            
                                        }else{
                                            
                                            $this->db->select('G735_C17139');
                                            $this->db->from('G735');
                                            $this->db->where('G735_C17138', $contrato->row()->G719_ConsInte__b);
                                            $this->db->where('G735_C17137 = 81');
                                            $sentencia2 = $this->db->get();

                                            if($sentencia2->num_rows() > 0){
                                                $dat2 =  $sentencia2->result();
                                                foreach ($dat2 as $key ) {
                                                    if(!is_null($key->G735_C17139)){
                                                        $fecha3 = explode(' ', $key->G735_C17139)[0];
                                                        $fecha3 = explode('-', $fecha3);
                                                        $fecha_liquidacion = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                                                    }
                                                }
                                                
                                            }
                                        }
                                        
                                    }
                                    $valores = 0;
                                    if($anho != ''){
                                        $valores = $this->Conceptos_Model->getValoresConcepto($anho, 'AUX002');
                                        //echo 'Aqui es que esta => '.$fecha_sentencia_favorable;
                                        $fechaDecicion = new DateTime($fechaDecicion);
                                        $fechaSentcnia = new DateTime($fechaSentcnia);

                                        if($fechaDecicion < $fechaSentcnia){

                                        }else{
                                            $valores = $valores * 0.5;
                                        }

                                        $valores = "$ ".number_format($valores, 0, ',', '.');
                                        
                                    }
                                    

                                    $datos[$j]['Ncontrato'] = $value['A'];
                                    $datos[$j]['fecha'] = $fecha4;
                                    $datos[$j]['fecha_liquidacion'] = $fecha_liquidacion;
                                    $datos[$j]['fecha_sentencia'] = $fecha_sentencia_favorable;
                                    $datos[$j]['valor'] = $valores;
                                    //$datos[$j]['valor_pagado'] = "$ ".number_format($key->G744_C17276, 0, ',', '.');
                                    $j++;
                                }
                            }


                        }


                    }else{
                        $validador++;
                    }
                }
            }
           


            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }


    //Desde aqui inicia la carga  y descarga de CISA
    function cisa(){
        if($this->session->userdata('login_ok')){
        
            $datosFooter = array('ul'=> 'ULAUXILIARES' , 'li' => 'LIAux-CISA');
       
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Conceptos/cisa');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

     function cargar_CISA(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltrosMax'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit', '1024M');
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" && $value['B'] != "" && $value['C'] != "" && $value['D'] != "" ){ 
                       
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            $fecha4 = NULL;
                            $fecha5 = NULL;
                            $fecha = NULL;
                            $fechas = NULL;
                            
                            $fecha  = explode('/', $value['C']);
                           
                            $fecha2 = $fecha[2]."-".$fecha[1]."-".$fecha[0];

                            
                            
                           
                            //$valores = $this->Conceptos_Model->getValoresConcepto($anho, 'AUX001');
                            $contrato = 0;
                           // $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);
                            if($filtro == 'G719_C17423'){
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17423', $value['A']);
                                $contrato = $this->db->get();
                            }else{
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $contrato = $this->db->get();
                            }
                            
                            if($contrato->num_rows() > 0){

                               // $aja = $this->db->get_where('G744', array('G744_C17280' => $contrato->row()->G719_ConsInte__b));
                                $this->db->select('G744_ConsInte__b');
                                $this->db->from('G744');
                                $this->db->where('G744_C17280', $contrato->row()->G719_ConsInte__b);
                                $aja = $this->db->get();
                               //$res = $aja->result();
                               //Honorarios venta G744_C17269
                               //fecha de factura G744_C17424
                                //factura G744_C17423 
                                $resultado = false;
                                if($aja->num_rows() > 0){
                                     $datosActualizados = array(    'G744_FechaInsercion' => $fechaIngreso, 
                                                                    'G744_Usuario' => $this->session->userdata('identificacion'),
                                                                    'G744_C17424' => $fecha2,
                                                                    'G744_C17423' => $value['B'],
                                                                    'G744_C17269' => $value['D'],
                                                                    'G744_C17275' => 1405,
                                                                    'G744_C17279' => 1803); 
                                    $resultado = $this->Wizard_Model->editarDatos('G744', $datosActualizados, $contrato->row()->G719_ConsInte__b, 'G744_C17280');
                                }else{
                                    $datosActualizados = array(     'G744_FechaInsercion' => $fechaIngreso,
                                                                    'G744_Usuario' => $this->session->userdata('identificacion'),
                                                                    'G744_C17424' => $fecha2, 
                                                                    'G744_C17423' => $value['B'], 
                                                                    'G744_C17269' => $value['D'],
                                                                    'G744_C17275' => 1405,
                                                                    'G744_C17279' => 1803,
                                                                    'G744_C17280' => $contrato->row()->G719_ConsInte__b);
                                    $resultado = $this->Wizard_Model->guardardatos('G744', $datosActualizados);
                                }
                                
                                if($resultado){
                                    $acertados++;
                                }
                            }else{
                                $fallosExistenciales++;
                            }
                    }else{
                        $validador++;
                    }
                    $i++;
                }
            }
            $resultados = array();
            $resultados['total'] = $i;
            $resultados['acertados'] = $acertados;
            $resultados['noExisten'] = $fallosExistenciales;

            echo json_encode($resultados);
        }else{
            $this->load->view('Login/login');
        }
    }


    function cargar_CISA_soporte(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltrosMax2'];
            $name   = $_FILES['FilExcell2']['name'];
            $tname  = $_FILES['FilExcell2']['tmp_name'];
            ini_set('memory_limit', '1024M');
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" && $value['B'] != "" && $value['C'] != "" ){ 
                       // $resultados = $this->Conceptos_Model->getValoresSubrogacion($value['A']);
                       // 1 No contrato 2. No de factura 3. Fecha de factura 4. Fecha trámite subrogación, 5. fecha de trámite sentencia 6. Fecha liquidaciòn de crédito 7. valor a pagar
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            $fecha4 = NULL;
                            $fecha5 = NULL;
                            $fecha = NULL;
                            $fechas = NULL;
                            //$anho = 2015;
                            //$actual = date('y');
                            //$anho = $actual - 1;

                            $fecha  = explode('/', $value['B']);
                            //$anho = $fecha[2];
                            $fecha2 = $fecha[2]."-".$fecha[1]."-".$fecha[0];

                            $fecha3  = explode('/', $value['C']);
                            //$anho = $fecha[2];
                            $fecha4 = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];
                            //$valores = $this->Conceptos_Model->getValoresConcepto($anho, 'AUX001');
                            $contrato = 0;
                           // $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);
                            if($filtro == 'G719_C17423'){
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17423', $value['A']);
                                $contrato = $this->db->get();
                            }else{
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $contrato = $this->db->get();
                            }
                            
                  
                            if($contrato->row()->G719_ConsInte__b != 0){
                                
                               // $aja = $this->db->get_where('G744', array('G744_C17280' => $contrato->row()->G719_ConsInte__b));
                                $this->db->select('G744_ConsInte__b');
                                $this->db->from('G744');
                                $this->db->where('G744_C17280', $contrato->row()->G719_ConsInte__b);
                                $aja = $this->db->get();
                               //$res = $aja->result();

                                $resultado = false;
                                if($aja->num_rows() > 0){
                                     $datosActualizados = array(    'G744_FechaInsercion' => $fechaIngreso,
                                                                    'G744_Usuario' => $this->session->userdata('identificacion'),
                                                                    'Fecha_recepcion_soporte' => $fecha2, 
                                                                    'Fecha_aprovacion_soporte' => $fecha4 
                                                                   ); 
                                    $resultado = $this->Wizard_Model->editarDatos('G744', $datosActualizados, $contrato->row()->G719_ConsInte__b, 'G744_C17280');
                                }else{
                                    $datosActualizados = array(     'G744_FechaInsercion' => $fechaIngreso, 
                                                                    'G744_Usuario' => $this->session->userdata('identificacion'),
                                                                    'Fecha_recepcion_soporte' => $fecha2, 
                                                                    'Fecha_aprovacion_soporte' => $fecha4,
                                                                    'G744_C17280' => $contrato->row()->G719_ConsInte__b);
                                    $resultado = $this->Wizard_Model->guardardatos('G744', $datosActualizados);
                                }
                                
                                if($resultado){
                                    $acertados++;
                                }
                            }else{
                                $fallosExistenciales++;
                            }
                    }else{
                        $validador++;
                    }
                    $i++;
                }
            }
            $resultados = array();
            $resultados['total'] = $i;
            $resultados['acertados'] = $acertados;
            $resultados['noExisten'] = $fallosExistenciales;

            echo json_encode($resultados);
        }else{
            $this->load->view('Login/login');
        }
    }



    //Inicia el cargue de datos de Gastos Judiciales
    function gastosJudiciales(){
        if($this->session->userdata('login_ok')){
        
            $datosFooter = array('ul'=> 'ULAUXILIARES' , 'li' => 'LIAux-gatsos');
       
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Conceptos/gastosJudiciales');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    

   function cargar_GastosJudiciales(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['cmbFiltrosMax'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit', '1024M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" && $value['B'] != "" && $value['C'] != "" && $value['D'] != "" && $value['E'] != ""){ 
                       // $resultados = $this->Conceptos_Model->getValoresSubrogacion($value['A']);
                       //  No de contrato, (Campo  ), código del concepto a cargar (pendiente Dyalogo entregar códigos", No de Factura, Fecha de Factura, Valor Pagado.
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            $fecha4 = NULL;
                            $fecha5 = NULL;
                            $fecha  = NULL;
                            $fechas = NULL;
                            //$anho = 2015;
                            //$actual = date('y');
                            //$anho = $actual - 1;

                            $fecha  = explode('/', $value['D']);
                            //$anho = $fecha[2];
                            $fecha2 = $fecha[2]."-".$fecha[1]."-".$fecha[0];

                            
    
                            //$valores = $this->Conceptos_Model->getValoresConcepto($anho, 'AUX001');
                            $contrato = 0;
                           // $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);
                            if($filtro == 'G719_C17423'){
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17423', $value['A']);
                                $contrato = $this->db->get();
                            }else{
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $contrato = $this->db->get();
                            }
                            
                    
                            if($contrato->num_rows() > 0){
                                
                               // $aja = $this->db->get_where('G744', array('G744_C17280' => $contrato->row()->G719_ConsInte__b));
                                $this->db->select('G745_ConsInte__b');
                                $this->db->from('G745');
                                $this->db->where('G745_C17292', $contrato->row()->G719_ConsInte__b);
                                $aja = $this->db->get();
                               //$res = $aja->result();

                                $resultado = false;
                                if($aja->num_rows() > 0){
                                     $datos = array(
                                        'G745_C17287' => $value['C'],
                                        'G745_C17288' => $value['B'],
                                        'G745_C17289' => $fecha2,
                                        'G745_C17290' => $value['E']
                                    );
                                    $resultado = $this->Wizard_Model->editarDatos('G745', $datos, $contrato->row()->G719_ConsInte__b, 'G745_C17292');
                                }else{
                                    $datos = array(
                                        'G745_C17287' => $value['C'],
                                        'G745_C17288' => $value['B'],
                                        'G745_C17289' => $fecha2,
                                        'G745_C17290' => $value['E'],
                                        'G745_C17292' => $contrato->row()->G719_ConsInte__b
                                    );
                     
                                    $resultado = $this->Wizard_Model->guardardatos('G745', $datos);
                                }
                                
                                if($resultado){
                                    $acertados++;
                                }
                            }else{
                                $fallosExistenciales++;
                            }
                            
                            /*$datos[$j]['Ncontrato'] = $key->contrato;
                            $datos[$j]['fecha'] = $fecha2;
                            $datos[$j]['valor'] = "$ ".number_format($valores, 0, ',', '.');
                            $datos[$j]['valor_pagado'] = "$ ".number_format($key->valor_pagado, 0, ',', '.');*/
                        
                        
                    }else{
                        $validador++;
                    }
                    $i++;
                }
            }
            $resultados = array();
            $resultados['total'] = $i;
            $resultados['acertados'] = $acertados;
            $resultados['noExisten'] = $fallosExistenciales;

            echo json_encode($resultados);
        }else{
            $this->load->view('Login/login');
        }
    }


    function cargar_subrogaciones(){
        if($this->session->userdata('login_ok')){
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIGarantias');
       
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Conceptos/cargarSubrogaciones');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
        
    }

    function guardarUnoaUno(){
        $contrato = 0;
       // $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);
        if($_POST['filtro'] == 'G719_C17423'){
            $this->db->select('G719_ConsInte__b');
            $this->db->from('G719');
            $this->db->where('G719_C17423', $_POST['contrato']);
            $contrato = $this->db->get();
        }else{
            $this->db->select('G719_ConsInte__b');
            $this->db->from('G719');
            $this->db->where('G719_C17026', $_POST['contrato']);
            $contrato = $this->db->get();
        }
        

        if($contrato->row()->G719_ConsInte__b != 0){
            $datos = array(
                'G719_C17049' => $_POST['fechadevolucion'],
                'G719_C17050' => $_POST['fechaenvio']
            );
            $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $contrato->row()->G719_ConsInte__b, 'G719_ConsInte__b');
          
            if($resultado){
               echo "Registro guardado!";
            }
        }else{
           echo "El No. contrato / liquidación no existe";
        }
    }


    function cargar_subrogacionesMaxiba(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $filtro = $_POST['filtro'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit', '1024M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != "" && $value['B'] != "" && $value['C'] != "" ){ 
                       
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            $fecha4 = NULL;
                            $fecha5 = NULL;
                            $fecha  = NULL;
                            $fechas = NULL;
                            //$anho = 2015;231wº 
                            //$actual = date('y');
                            //$anho = $actual - 1;
                            if(!is_null($value['B'])){
                                //echo $value['B'];
                                $fecha  = explode('/', $value['B']);
                                //$anho = $fecha[2];
                                $fecha2 = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                            }
                               

                            if(!is_null($value['C'])){
                               // echo $value['C'];
                                $fecha3  = explode('/', $value['C']);
                                //$anho = $fecha[2];
                                $fecha4 = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];
                            }
                                

                            
    
                            //$valores = $this->Conceptos_Model->getValoresConcepto($anho, 'AUX001');
                            $contrato = 0;
                           // $contrato = $this->Obligaciones_Model->getIdObligacion($value['A']);
                            if($filtro == 'G719_C17423'){
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17423', $value['A']);
                                $contrato = $this->db->get();
                            }else{
                                $this->db->select('G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $contrato = $this->db->get();
                            }
                            
                  
                            if($contrato->row()->G719_ConsInte__b != 0){
                                $datos = array(
                                    'G719_C17049' => $fecha2,
                                    'G719_C17050' => $fecha4
                                );
                                $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $contrato->row()->G719_ConsInte__b, 'G719_ConsInte__b');
                              
                                if($resultado){
                                    $acertados++;
                                }
                            }else{
                                $fallosExistenciales++;
                            }
                            
                            /*$datos[$j]['Ncontrato'] = $key->contrato;
                            $datos[$j]['fecha'] = $fecha2;
                            $datos[$j]['valor'] = "$ ".number_format($valores, 0, ',', '.');
                            $datos[$j]['valor_pagado'] = "$ ".number_format($key->valor_pagado, 0, ',', '.');*/
                        
                        
                    }else{
                        $validador++;
                    }
                    $i++;
                }
            }
            $resultados = array();
            $resultados['total'] = $i;
            $resultados['acertados'] = $acertados;
            $resultados['noExisten'] = $fallosExistenciales;

            echo json_encode($resultados);
        }else{
            $this->load->view('Login/login');
        }
    }

}
?>