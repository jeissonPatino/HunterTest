<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Reportes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
        $this->load->model("Reportes_Model");
        $this->load->model("Obligaciones_Model");
    }

    function index(){
    	  if($this->session->userdata('login_ok')){
           	$datosFooter = array('ul'=> 'NO' , 'li' => 'LIreportes');
            $reportes = $this->Reportes_Model->getReportes();
           	
           	$data = array('reportesCombo' => $reportes);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/index', $data );
            $this->load->view('Includes/footer', $datosFooter );
        }else{
            $this->load->view('Login/login');
        }
    	
    }

    function mostrarReporte($idConsinte){
        
        if($this->session->userdata('login_ok')){
            
            $tipo= $this->Reportes_Model->getTipoReporte($idConsinte);
            $armadoReporte = $this->Reportes_Model->getArmadoRporte($idConsinte);


            $operacionDivisor   = null;
            $nombreGrafica  = null;
            $tipoGrafica    = null;
            $operacionDividendo = null;
            $analisis       = null;
            $aplicacion     = null;
            $buscarPor      = null;
            $condicion      = null;
            $valorCondicion = null;
            $agrupadoPor1   = null;
            $agrupadoPor2   = null;
            $fechaInicial   = null;
            $fechaFinal     = null;
            $diasMaximos    = null;
            $operacion      = null;
            $dividendo      = null;
            $divisor        = null;
            $getG759ConsInteb = null;

            foreach ($armadoReporte as $key) {

                $operacionDivisor     = $key->operacionDivisor;
                $nombreGrafica        = $key->nombreGrafica;
                $tipoGrafica          = $key->tipoGrafica;
                $operacionDividendo   = $key->operacionDividendo;
                $analisis             = $key->analisis;
                $aplicacion           = $key->aplicacion;
                $buscarPor            = $key->buscarPor;
                $condicion            = $key->condicion;
                $valorCondicion       = $key->valorCondicion;
                $agrupadoPor1         = $key->agrupadoPor1;
                $agrupadoPor2         = $key->agrupadoPor2;
                $fechaInicial         = $key->fechaInicial;
                $fechaFinal           = $key->fechaFinal;
                $diasMaximos          = $key->diasMaximos;
                $operacion            = $key->operacion;
                $dividendo            = $key->dividendo;
                $divisor              = $key->divisor;
                $getG759ConsInteb     = $key->m;
            }
            switch ($tipo) {

                case '1817'://Cumplimiento condición específica
                    
                    $labelSeries1 = ($getG759ConsInteb == 1) ? "Ilocalizado" : "SI";
                    $labelSeries2 = ($getG759ConsInteb == 1) ? "Localizado"  : "NO";
                    $resultObject2 = $this->Reportes_Model->findTipoCampoGuionAsociado($agrupadoPor2);
                    $tipo2 = ($resultObject2 != null) ? $resultObject2 : "";

                    $querySb = $this->armarConsulta1817($aplicacion, $agrupadoPor2, $analisis, $condicion, $valorCondicion, $buscarPor, $labelSeries1, $labelSeries2);
                    $hallarValoreX = $this->hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo2);
                    //hallarValoreX(aplicacion, analisis, agrupadoPor2, tipo2);
            
                    
                    $datos = array( 'consulta' => $querySb, 
                                    'nombreGrafica'=> $nombreGrafica, 
                                    'labelSeries1' => $labelSeries1, 
                                    'labelSeries2' => $labelSeries2, 
                                    'agrupadoPor2' => $agrupadoPor2,
                                    'aplicacion' => $aplicacion,
                                    'analisis' => $analisis,
                                    'tipo2' => $tipo2

                                    );
                    $this->load->view('Reportes/1817', $datos);
                   // dibujarReporteBarras(datosFuenteReporte, nombreGrafica, labelSeries1, labelSeries2, agrupadoPor2);
                  break;

                case '1818'://Cumplimiento de tiempos
                    $labelSeries1 = "FueraTiempo";
                    $labelSeries2 = "EnTiempo";

                    $consulta = '';
                    $from = '';
                    $join = '';
                    $cosojoin = '';
                    $where = '';
                    $group = '';


                    $consulta .= "G".$aplicacion."_C".$agrupadoPor2." as MAs,";
                    if ($fechaFinal != null) {
                        $consulta .= "sum(iif(DATEDIFF(day,G".$aplicacion."_C".$fechaFinal.",G".$aplicacion."_C".$fechaInicial.") > ".$diasMaximos.",1,0)) as ".$labelSeries1.",";
                        $consulta .="sum(iif(DATEDIFF(day,G".$aplicacion."_C".$fechaFinal.",G".$aplicacion."_C".$fechaInicial.") <= ".$diasMaximos.",1,0)) as ".$labelSeries2;
                    } else {
                        $consulta .="sum(iif(DATEDIFF(day, GETDATE(), G".$aplicacion."_C".$fechaInicial.") > ".$diasMaximos.",1,0)) as ".$labelSeries1.",";
                        $consulta .="sum(iif(DATEDIFF(day, GETDATE(), G".$aplicacion."_C".$fechaInicial.") <= ".$diasMaximos.",1,0)) as ".$labelSeries2;
                    }
                    $from .= "G".$aplicacion;
                    if ($condicion != null) {
                        $where .= "G".$aplicacion."_C".$condicion." ";
                        if ($valorCondicion == null) {
                             $where .=  "is null ";
                        } else {
                             $where .=  "= ".$valorCondicion;
                        }
                    }
                    $group .= "G".$aplicacion."_C".$agrupadoPor2;
                    $datosFuenteReporte =  $this->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);
                    $resultObject2 = $this->Reportes_Model->findTipoCampoGuionAsociado($agrupadoPor2);
                    $tipo2 = ($resultObject2 != null) ? $resultObject2 : "";
                    $datos = array( 'consulta' => $datosFuenteReporte, 
                                      'nombreGrafica'=> $nombreGrafica, 
                                    'labelSeries1' => $labelSeries1, 
                                    'labelSeries2' => $labelSeries2, 
                                    'agrupadoPor2' => $agrupadoPor2,
                                    'aplicacion' => $aplicacion,
                                    'analisis' => $analisis,
                                    'tipo2' => $tipo2

                                    );
                    $this->load->view('Reportes/1818', $datos);
                    
                  break;

                case '1819'://Tiempo Transcurrido
                    $labelSeries1 = "TiempoTranscurrido";
                    $labelSeries2 = null;

                    $consulta = '';
                    $from = '';
                    $join = '';
                    $cosojoin = '';
                    $where = '';
                    $group = '';


                    $consulta .= "G".$aplicacion."_C".$agrupadoPor2." as MAs,";
                    if ($fechaFinal != null) {
                        $consulta .= "sum(DATEDIFF(day,G".$aplicacion."_C".$fechaFinal.",G".$aplicacion."_C".$fechaInicial.")) as TiempoTranscurrido";
                    } else {
                        $consulta .= "sum(DATEDIFF(day, GETDATE(),G".$aplicacion."_C".$fechaInicial.")) as TiempoTranscurrido";
                    }
                    $from .= "G".$aplicacion;
                    if ($condicion != null) {
                        $where .= "G".$aplicacion."_C".$condicion;
                        if ($valorCondicion == null) {
                            $where .= "is null ";
                        } else {
                             $where .= "= ".$valorCondicion;
                        }
                    }
                    $group .= "G".$aplicacion."_C".$agrupadoPor2;
                    $datosFuenteReporte = $this->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);
                    $resultObject2 = $this->Reportes_Model->findTipoCampoGuionAsociado($agrupadoPor2);
                    $tipo2 = ($resultObject2 != null) ? $resultObject2 : "";
                    $datos = array( 'consulta' => $datosFuenteReporte, 
                                    'nombreGrafica'=> $nombreGrafica, 
                                    'labelSeries1' => $labelSeries1, 
                                    'labelSeries2' => $labelSeries2, 
                                    'agrupadoPor2' => $agrupadoPor2,
                                    'aplicacion' => $aplicacion,
                                    'analisis' => $analisis,
                                    'tipo2' => $tipo2

                                    );
                    $this->load->view('Reportes/1819', $datos);
                  break;

                case '1820'://Pie-Torta
                    $querySb = $this->armarConsulta1820($aplicacion, $agrupadoPor2, $analisis);
                    $resultObject2 = $this->Reportes_Model->findTipoCampoGuionAsociado($agrupadoPor2);
                    $tipo2 = ($resultObject2 != null) ? $resultObject2 : "";
                    $datos = array( 'consulta' => $querySb, 
                                    'nombreGrafica'=> $nombreGrafica, 
                                    'agrupadoPor2' => $agrupadoPor2,
                                    'aplicacion' => $aplicacion,
                                    'analisis' => $analisis,
                                    'tipo2' => $tipo2
                                    );
                    $this->load->view('Reportes/1820', $datos);
                  break;

                case '1821'://Porcentajes
                    $labelSeries1 = "Porcentaje";
                    $labelSeries2 = null;

                    $consulta = '';
                    $from = '';
                    $join = '';
                    $cosojoin = '';
                    $where = '';
                    $group = '';


                    $consulta .= "G".$aplicacion."_C".$agrupadoPor2." as Mas,";
                    $consulta .= "100*Count(G".$aplicacion."_C".$dividendo.")/nullif(Count(G".$aplicacion."_C".$divisor."), 0) AS Porcentaje";
                    $from .= "G".$aplicacion;
                    if ($condicion != null) {
                        $where .= "G".$aplicacion."_C".$condicion;
                        if ($valorCondicion == null) {
                            $where .=  "is null ";
                        } else {
                           $where .= "= ".$valorCondicion;
                        }
                    }
                    $group = "G".$aplicacion."_C".$agrupadoPor2;
                    $datosFuenteReporte = $this->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);
                    $resultObject2 = $this->Reportes_Model->findTipoCampoGuionAsociado($agrupadoPor2);
                    $tipo2 = ($resultObject2 != null) ? $resultObject2 : "";
                    $datos = array( 'consulta' => $datosFuenteReporte, 
                                    'nombreGrafica'=> $nombreGrafica, 
                                    'agrupadoPor2' => $agrupadoPor2,
                                    'aplicacion' => $aplicacion,
                                    'analisis' => $analisis,
                                    'tipo2' => $tipo2,
                                    'labelSeries1' => $labelSeries1, 
                                    'labelSeries2' => $labelSeries2
                                    );
                    $this->load->view('Reportes/1821', $datos);
                  break;
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function verReporte(){
        $this->load->view('Reportes/reporteBarra');
    }

    function armarConsulta1817($aplicacion, $agrupadoPor2, $analisis, $condicion, $valorCondicion, $buscarPor, $labelSeries1, $labelSeries2) {
        $resultObject = $this->Reportes_Model->findTipoCampoGuionAsociado($analisis);
        $resultObject23 = $this->Reportes_Model->findTipoCampoGuionAsociado2($analisis);
        $tipo = ($resultObject != null) ? $resultObject : "";
        $tipo = ($tipo == "6" || $tipo == "11" ? $tipo : "otro");
        $consulta = '';
        $from = '';
        $join = '';
        $cosojoin = '';
        $where = '';
        $group = '';
        $consulta .= " MAX(G".$aplicacion."_C".$agrupadoPor2.") as MAs, ";
        $resultObject2 = $this->Reportes_Model->findCampoAsociado($agrupadoPor2);
        $tipo2 = ($resultObject2 != null) ? $resultObject2 : "";

        switch ($tipo) {
            case "6":
                $consulta .= "sum(iif(Nombre_b = '".$buscarPor."',1,0)) as ".$labelSeries1.", ";
                $consulta .= "sum(iif(Nombre_b <> '".$buscarPor."',1,0)) as ".$labelSeries2;
                $from = "G".$aplicacion;
                $join = " ParametroGeneral"; 
                $cosojoin = " G".$aplicacion."_C".$analisis." = Id ";
                break;
            case "11":
                $resultObjectCampo = $this->Reportes_Model->findCampoAsociado($analisis);
                $campoAsociado = ($resultObjectCampo != null) ? $resultObjectCampo : null;
                $guionAsociado = ($resultObject23 != null) ? $resultObject23 : null;
                $consulta .=  "sum(iif(G".$guionAsociado."_C".$campoAsociado." LIKE '".$buscarPor."',1,0)) as ".$labelSeries1.", ";
                $consulta .=  "sum(iif(G".$guionAsociado."_C".$campoAsociado." <> '".$buscarPor."',1,0)) as ".$labelSeries2."";
                $from =  "G".$aplicacion;
                $join = " G".$guionAsociado;
                $cosojoin = " G".$aplicacion."_C".$analisis." = G".$guionAsociado."_ConsInte__b ";
                break;

            case "otro":
                $consulta =  "sum(iif(G".$aplicacion."_C".$analisis." = ".$buscarPor.",1,0)) as ".$labelSeries1.", ";
                $consulta .=  "sum(iif(G".$aplicacion."_C".$analisis." <> ".$buscarPor.",1,0)) as ".$labelSeries2;
                $from =  "G".$aplicacion;
                if ($condicion != null) {
                     $where .= "G".$aplicacion."_C".$condicion;
                    if ($valorCondicion == null) {
                       $where .= " is null ";
                    } else {
                        $where .= " = ".$valorCondicion;
                    }
                }
                break;
        }
        $group .= "G".$aplicacion."_C".$agrupadoPor2;
      
        return $this->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);
    }


    function hallarValoreX($aplicacion, $analisis, $agrupadoPor2, $tipo){
        $consulta = '';
        $from = '';
        $join = '';
        $cosojoin = '';
        $where = '';
        $group = '';


        switch ($tipo) {
            case "6":
                $consulta =  "DISTINCT Id as valor1, Nombre_b as valor2";
                $from  = "G".$aplicacion;
                $join  = "ParametroGeneral";
                $cosojoin = "G".$aplicacion."_C".$analisis." = Id";
                break;

            case "11":
                $resultObjectCampo =$this->Reportes_Model->findCampoAsociado($agrupadoPor2);
                $resultObject = $this->Reportes_Model->findTipoCampoGuionAsociado2($agrupadoPor2);
                $campoAsociado = ($resultObjectCampo != null) ? $resultObjectCampo : null;
                $guionAsociado = ($resultObject != null) ? $resultObject : null;
                $consulta =  "DISTINCT G".$aplicacion."_C".$agrupadoPor2." as valor1, G".$guionAsociado."_C".$campoAsociado." as valor2";
                $from = "G".$aplicacion;
                $join  = "G".$guionAsociado;
                $cosojoin = " G".$aplicacion."_C".$agrupadoPor2." = G".$guionAsociado."_ConsInte__b";
           
                break;
            case "otro":
                //PEndiente terminar armar consultas
                break;
        }
        //echo "SELECT $consulta FROM $from JOIN $join ON  $cosojoin  $where $group";
        return $this->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);
    }

    function armarConsulta1820($aplicacion, $agrupadoPor2, $analisis){

        $consulta = '';
        $from = '';
        $join = '';
        $cosojoin = '';
        $where = '';
        $group = '';


        $consulta .="G".$aplicacion."_C".$agrupadoPor2." as Mas, count(G".$aplicacion."_ConsInte__b) as Resultado";
        $from .= "G".$aplicacion;
                //               .append("Where FRG = Bogotá\n")
        $group .= "G".$aplicacion."_C".$agrupadoPor2;
        return $this->Reportes_Model->ejecutarConsulta($consulta, $from, $join, $cosojoin, $where, $group);
    }


    //A partir de aqui inician los reportes de fng Nuevos
    public function asignacion_de_abogados(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Asignación de abogados');
            $datosFooter = array('ul'=> 'LIreportes' , 'li' => 'asignacion_abogados'); 

           
            $Frgs = $this->Configuraciones_Model->getFrgs();
            $datos = array( 
                            'frgs' =>  $Frgs
                            );

            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/asignacion_abogados', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    //obtener los abogados del frg
    function getAbogados($frg){
        $abogados = $this->Configuraciones_Model->getAbogadoByfrg($frg);
        echo "<option value='0'>Seleccione</option>";
        foreach ($abogados as $key) {
            echo "<option value='".$key->id."'>".utf8_encode($key->Nombre)."</option>";
        }
    }

    function getReportesAsignacion_abogados(){
        
        if($this->session->userdata('login_ok')){

            $frg = $_POST['frg'];
            $abogados = $_POST['abogados'];
            $fechaInicial = $_POST['fechainicial'];
            $fechaFinal = $_POST['fechafinal'];

            if( $frg != NULL && $frg != '' && $frg != 0){
                $resultado = $this->Reportes_Model->getReportesAsignacion_abogados( $frg , $abogados, $fechaInicial, $fechaFinal);
                $resultados = $this->Reportes_Model->getReportesAsignacion_abogados_deglosado( $frg , $abogados, $fechaInicial, $fechaFinal);
                
                $this->db->select('par_meta, par_tiempo_asignacion');
                $this->db->from('Parametros_reportes');
                $this->db->join('Reportes', 'par_rep_id = rep_id');
                $this->db->where('rep_orden', 'reporte1');
                $reporteDatos = $this->db->get();
    
                $frgss = $this->db->get_where('FRG',array('Id' => $frg));
                
                $json = array();
                $i= 0;
                $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
                
                foreach ($resultados as $key) {
                    $aTiempo = 'Sin asignar';
                    $tiempoPasado  = 0;
                    if($key->G719_C17051 != NULL){
                        //$asignadas++;
                        //valido que no se halla devuelto el memorial de subrogacion
                        if($key->G719_C17050 != NULL){
                            $datetime1 = new DateTime($key->G719_C17050);
                            $datetime2 = new DateTime($key->G719_C17051);

                            $interval = $datetime1->diff($datetime2);
                            $tiempoPasado  = $interval->format('%R%a');
                            if($tiempo > $interval->format('%R%a')){
                                $aTiempo = 'A tiempo';
                            }else{
                                $aTiempo = 'A destiempo';
                            }
                            
                        }else{
                            $datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
                            $datetime2 = new DateTime($key->G719_C17051);
                            $interval = $datetime1->diff($datetime2);
                            $tiempoPasado  = $interval->format('%R%a');
                            if($tiempo > $interval->format('%R%a')){
                                $aTiempo = 'A tiempo';
                            }else{
                                $aTiempo = 'A destiempo';
                            }
                           
                        }
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);

                    $fecha1 = null;
                    $fecha3 = null;
                    $fecha2 = null;
                    
                    if(!is_null($key->G719_C17051)){
                        $fecha1 = explode(" ", $key->G719_C17051)[0];
                        $fecha1 = explode("-", $fecha1);
                        $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                    }
                    
                    if(!is_null($key->FechaEnvioMemorialSubrogacionFRG)){
                        $fecha2 = explode(" ", $key->FechaEnvioMemorialSubrogacionFRG)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    
                    if(!is_null($key->G719_C17050)){
                        $fecha3 = explode(" ", $key->G719_C17050)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }
                    


                   $json[$i]['contrato'] = $key->contrato ;
                   $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                   $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                   $json[$i]['identificacion'] = $key->identificacion;
                   $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                   $json[$i]['Fasignacion'] = $fecha1;
                   $json[$i]['Fenvio'] = $fecha2;
                   $json[$i]['Fcorreccion'] = $fecha3;
                   $json[$i]['Tiempos'] = $aTiempo;
                   $json[$i]['tiempoTrans'] = $tiempoPasado;
                   $i++;
                }

                
                $datos = array('reporte'=> $resultado, 
                                'Contratos' => json_encode($json),
                                'meta' => $reporteDatos->row()->par_meta ,
                                'tiempo' => $reporteDatos->row()->par_tiempo_asignacion,
                                'frg' => $frgss->row()->FRG);
                $this->load->view('Reportes/asignacion_abogados_datos', $datos);
            }else{
                //aqui es cuando no mandan el FRg si no que quieren ver todo el reporte
                //obtenemos los Frgs
                $frgs = $this->Configuraciones_Model->getFrgs();
                $labels = array();
                $frg = array();
                $valor = 0;
                $this->db->select('par_meta, par_tiempo_asignacion');
                $this->db->from('Parametros_reportes');
                $this->db->join('Reportes', 'par_rep_id = rep_id');
                $this->db->where('rep_orden', 'reporte1');
                $reporteDatos = $this->db->get();
                
                $resultados = $this->Reportes_Model->getReportesAsignacion_abogados_deglosado( $frg , $abogados, $fechaInicial, $fechaFinal);
                $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
                
                foreach ($frgs as $key2) {
                    //luego prgintamos por las obligaciones de esos Frgs
                    $resultado = $this->Reportes_Model->getReportesAsignacion_abogados( $key2->Id , NULL, $fechaInicial, $fechaFinal);
                    $labels[$valor] = $key2->Frg;

                    $i = 0;
                    $asignadas = 0;
                    $Nasignadas = 0;
                    $aTiempo = 0;
                    $aDesiempo = 0;
                    $noasignadasEntiempo = 0;
                    $noasignadasNotiempo = 0; 
                    
                    $total = 0;
                    $cumple = 0;
                    $nocumple = 0;
                    //validar que traiga datos la consulta a ver que  pasa , no creo que eso sea!

                    //los empleo para lo que viy a hacer ocn ellos
                    foreach ($resultado as $key) {
                        $total++;
                        //pregunto que hallla sido asignado el abogado
                        if($key->G719_C17051 != NULL){
                            $asignadas++;
                            //valido que no se halla devuelto el memorial de subrogacion
                            if($key->G719_C17050 != NULL){
                                $datetime1 = new DateTime($key->G719_C17050);
                                $datetime2 = new DateTime($key->G719_C17051);
                                $interval = $datetime1->diff($datetime2);
                                if($tiempo > $interval->format('%R%a')){
                                    $aTiempo++;
                                }else{
                                    $aDesiempo++;
                                }
                                
                            }else{
                                $datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
                                $datetime2 = new DateTime($key->G719_C17051);
                                $interval = $datetime1->diff($datetime2);
                                if($tiempo > $interval->format('%R%a')){
                                    $aTiempo++;
                                }else{
                                    $aDesiempo++;
                                }
                                
                            }
                        }else{
                            $Nasignadas++;
                            date_default_timezone_set('America/Bogota');
                            $fechaIngreso =  date("Y-m-d H:i:s");

                            $datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
                            $datetime2 = new DateTime($fechaIngreso);
                            $interval = $datetime1->diff($datetime2);
                            if($tiempo > $interval->format('%R%a')){
                                $noasignadasEntiempo++;
                            }else{
                                $noasignadasNotiempo++;
                            }
                            
                        }
                        
                        
                    }

                    $frg[$valor]['Total'] = $total;
                    $frg[$valor]['aTiempo'] = $aTiempo;
                    $frg[$valor]['aDesiempo'] = $aDesiempo;
                    $frg[$valor]['noasignadasEntiempo'] = $noasignadasEntiempo;
                    $frg[$valor]['noasignadasdetiempo'] = $noasignadasNotiempo;
                    $frg[$valor]['Frg'] = $key2->Frg;
                    $valor++;
                }

                $json = array();
                $i= 0;

                foreach ($resultados as $key) {
                     $aTiempo = 'Sin asignar';
                     $tiempoPasado  = 0;
                    if($key->G719_C17051 != NULL){
                        //$asignadas++;
                        //valido que no se halla devuelto el memorial de subrogacion
                        if($key->G719_C17050 != NULL){
                            $datetime1 = new DateTime($key->G719_C17050);
                            $datetime2 = new DateTime($key->G719_C17051);

                            $interval = $datetime1->diff($datetime2);
                            $tiempoPasado  = $interval->format('%R%a');
                            if($tiempo > $interval->format('%R%a')){
                                $aTiempo = 'A tiempo';
                            }else{
                                $aTiempo = 'A destiempo';
                            }
                            
                        }else{
                            $datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
                            $datetime2 = new DateTime($key->G719_C17051);
                            $interval = $datetime1->diff($datetime2);
                            $tiempoPasado  = $interval->format('%R%a');
                            if($tiempo > $interval->format('%R%a')){
                                $aTiempo = 'A tiempo';
                            }else{
                                $aTiempo = 'A destiempo';
                            }
                           
                        }
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);

                    $fecha1 = null;
                    $fecha3 = null;
                    $fecha2 = null;
                    
                    if(!is_null($key->G719_C17051)){
                        $fecha1 = explode(" ", $key->G719_C17051)[0];
                        $fecha1 = explode("-", $fecha1);
                        $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                    }
                    
                    if(!is_null($key->FechaEnvioMemorialSubrogacionFRG)){
                        $fecha2 = explode(" ", $key->FechaEnvioMemorialSubrogacionFRG)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    
                    if(!is_null($key->G719_C17050)){
                        $fecha3 = explode(" ", $key->G719_C17050)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }
                    


                   $json[$i]['contrato'] = $key->contrato ;
                   $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                   $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                   $json[$i]['identificacion'] = $key->identificacion;
                   $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                   $json[$i]['Fasignacion'] = $fecha1;
                   $json[$i]['Fenvio'] = $fecha2;
                   $json[$i]['Fcorreccion'] = $fecha3;
                   $json[$i]['Tiempos'] = $aTiempo;
                   $json[$i]['tiempoTrans'] = $tiempoPasado;
                   $i++;
                }

                $arrayDatos = array('labels' => $labels,
                                    'datos' => $frg,
                                    'others' => $frg,
                                    'other' => $frg,
                                    'Contratos' => json_encode($json),
                                    'meta' => $reporteDatos->row()->par_meta ,
                                    'tiempo' => $reporteDatos->row()->par_tiempo_asignacion,);
                $this->load->view('Reportes/asignacion_abogados_datos_total', $arrayDatos);
            }
            
        }else{
            $this->load->view('Login/login');
        }
    }

    function exportarAsignacionAbogados( $frg = NULL, $abogados = NULL,   $fechaInicial, $fechaFinal ){
        
        if($this->session->userdata('login_ok')){
            if( $frg != NULL){
                $resultado = $this->Reportes_Model->getReportesAsignacion_abogados( $frg , $abogados, $fechaInicial, $fechaFinal);
                $resultados = $this->Reportes_Model->getReportesAsignacion_abogados_deglosado( $frg , $abogados, $fechaInicial, $fechaFinal);
                $frgNombre = '';
                
                if($frg != 0){
                    $this->db->select(' FRG as Frg');
                    $this->db->where('Id', $frg);
                    $frgNOmbresaqui = $this->db->get('FRG');
                    $frgNombre = $frgNOmbresaqui->row()->Frg;
                }
                
                                


                $this->db->select('par_meta, par_tiempo_asignacion');
                $this->db->from('Parametros_reportes');
                $this->db->join('Reportes', 'par_rep_id = rep_id');
                $this->db->where('rep_orden', 'reporte1');
                $reporteDatos = $this->db->get();
        
                $datos = array('reporte'=> $resultado, 
                                'Contratos' => $resultados,
                                'meta' => $reporteDatos->row()->par_meta ,
                                'tiempo' => $reporteDatos->row()->par_tiempo_asignacion,
                                'frg' => $frgNombre);
                                
                                
                if($frg == 0){

                    $frgs = $this->Configuraciones_Model->getFrgs();
                    $labels = array();
                    $frg = array();
                    $valor = 0;
                    $this->db->select('par_meta, par_tiempo_asignacion');
                    $this->db->from('Parametros_reportes');
                    $this->db->join('Reportes', 'par_rep_id = rep_id');
                    $this->db->where('rep_orden', 'reporte1');
                    $reporteDatos = $this->db->get();
                    
                    $resultados = $this->Reportes_Model->getReportesAsignacion_abogados_deglosado( $frg , $abogados, $fechaInicial, $fechaFinal);
                    $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
                    
                    foreach ($frgs as $key2) {
                        //luego prgintamos por las obligaciones de esos Frgs
                        $resultado = $this->Reportes_Model->getReportesAsignacion_abogados( $key2->Id , NULL, $fechaInicial, $fechaFinal);
                        $labels[$valor] = $key2->Frg;

                        $i = 0;
                        $asignadas = 0;
                        $Nasignadas = 0;
                        $aTiempo = 0;
                        $aDesiempo = 0;
                        $noasignadasEntiempo = 0;
                        $noasignadasNotiempo = 0; 
                        
                        $total = 0;
                        $cumple = 0;
                        $nocumple = 0;
                        //validar que traiga datos la consulta a ver que  pasa , no creo que eso sea!

                        //los empleo para lo que viy a hacer ocn ellos
                        foreach ($resultado as $key) {
                            $total++;
                            //pregunto que hallla sido asignado el abogado
                            if($key->G719_C17051 != NULL){
                                $asignadas++;
                                //valido que no se halla devuelto el memorial de subrogacion
                                if($key->G719_C17050 != NULL){
                                    $datetime1 = new DateTime($key->G719_C17050);
                                    $datetime2 = new DateTime($key->G719_C17051);
                                    $interval = $datetime1->diff($datetime2);
                                    if($tiempo > $interval->format('%R%a')){
                                        $aTiempo++;
                                    }else{
                                        $aDesiempo++;
                                    }
                                    
                                }else{
                                    $datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
                                    $datetime2 = new DateTime($key->G719_C17051);
                                    $interval = $datetime1->diff($datetime2);
                                    if($tiempo > $interval->format('%R%a')){
                                        $aTiempo++;
                                    }else{
                                        $aDesiempo++;
                                    }
                                    
                                }
                            }else{
                                $Nasignadas++;
                                date_default_timezone_set('America/Bogota');
                                $fechaIngreso =  date("Y-m-d H:i:s");

                                $datetime1 = new DateTime($key->FechaEnvioMemorialSubrogacionFRG);
                                $datetime2 = new DateTime($fechaIngreso);
                                $interval = $datetime1->diff($datetime2);
                                if($tiempo > $interval->format('%R%a')){
                                    $noasignadasEntiempo++;
                                }else{
                                    $noasignadasNotiempo++;
                                }
                                
                            }
                            
                            
                        }

                        $frg[$valor]['Total'] = $total;
                        $frg[$valor]['aTiempo'] = $aTiempo;
                        $frg[$valor]['aDesiempo'] = $aDesiempo;
                        $frg[$valor]['noasignadasEntiempo'] = $noasignadasEntiempo;
                        $frg[$valor]['noasignadasdetiempo'] = $noasignadasNotiempo;
                        $frg[$valor]['Frg'] = $key2->Frg;
                        $valor++;
                    } 
                    
                    $arrayDatos = array('labels' => $labels,
                                    'datos' => $frg,
                                    'others' => $frg,
                                    'other' => $frg,
                                    'Contratos' => $resultados,
                                    'meta' => $reporteDatos->row()->par_meta ,
                                    'tiempo' => $reporteDatos->row()->par_tiempo_asignacion,);
                    $this->load->view('Reportes/Exportar_abogados_datos_total', $arrayDatos);
                }else{
                    $this->load->view('Reportes/exportarAsignacion_Abogados', $datos);     
                }     
                
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    //Informe evaluación FRG - Gestión Extrajudicial Mensual

    function gestion_extrajudicial_mensual(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Gestión Extrajudicial Mensual');
            $datosFooter = array('ul'=> 'LIreportes' , 'li' => 'gestion_extrajudicial_mensual'); 

           
            $Frgs = $this->Configuraciones_Model->getFrgs();
            $datos = array( 'frgs' =>  $Frgs
                            );

            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/gestion_extrajudicial_mensual', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function buscar_gestion_extrajudicial_mensual(){
        $frg = $_POST['frg'];
        $fechaInicial = $_POST['fechainicial'];
        $fechaBusqueda = '01-'.$fechaInicial;
        // echo 'Fecha elegida => '.$fechaBusqueda.'</br>';

        //le resto el mes inmediatamente anterior
        $fechamesAnterior = strtotime ( '-1 month' , strtotime ( $fechaBusqueda ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $fechamesAnterior );
        //echo 'Fecha Para pago abono => '.$nuevafecha.'</br>';

        $fechadiaFinmesAnterior = strtotime ( '-1 day' , strtotime ( $fechaBusqueda ) ) ;
        $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
         //echo 'Fecha Para pago abono Final => '.$nuevafechaDiaFin.'</br>';


        //Le resto para buscar el pago de la garantia
        $fechamesGarantia = strtotime ( '-2 month' , strtotime ( $fechaBusqueda ) ) ;
        $fechaGrantia = date ( 'Y-m-d' , $fechamesGarantia );
        // echo 'Fecha Para Garantia => '.$fechaGrantia.'</br>';

        $fechamesGarantiaFinal = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
        $fechaGrantiaFinal = date ( 'Y-m-d' , $fechamesGarantiaFinal );
         //echo 'Fecha Para Garantia FInal busqueda => '.$fechaGrantiaFinal.'</br>';
        
        if( $frg != NULL && $frg != '' && $frg != 0){
           
            if($frg[0] == 0){
                $frgs = $this->Configuraciones_Model->getFrgs();
                $labels = array();
                $frg = array();
                $valor = 0;
                $json = array();
                $i= 0;
                foreach ($frgs as $key2) {
                    
                    $frgNull = $key2->Id;
                    $gestion = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0($frgNull, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                    $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0_Total($frgNull, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1_Total($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                    $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_0($frgNull,  $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin);     
                    $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_1($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                    $cumplimiento = 0;
                    $Nocumplen = 0;
                    $totalBaseMedicion = 0;

                    foreach ($gestion as $key ) {
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        
                        if($gestions >= 1){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }
                    }

                    foreach ($gestion_deglosado as $key) {

                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $json[$i]['gestionado'] = 'TIENE GESTION';
                        }else{
                            $json[$i]['gestionado'] = 'NO TIENE GESTION';
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        $nombre = substr($deudor, 0, 3);
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }

                    foreach ($gestion_0 as $key ) {

                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }

                        //
                    }

                    
                    foreach ($gestion_deglosado_1 as $key) {
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $json[$i]['gestionado'] = 'TIENE GESTION';
                        }else{
                            $json[$i]['gestionado'] = 'NO TIENE GESTION';
                        }
                        $deudor = trim(utf8_encode($key->nombre));
                        $nombre = substr($deudor, 0, 3);
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }

                    $frg[$valor]['Total'] = $totalBaseMedicion;
                    $frg[$valor]['cumplen'] = $cumplimiento;
                    $frg[$valor]['nocumplen'] = $Nocumplen;
                    $frg[$valor]['Frg'] = $key2->Frg;
                    $valor++;

                    
                    
                }

                

                $datos = array( 'datos' => $frg ,
                                'datos2' => $frg,
                                'gestiones_deglosado' => json_encode($json));
                $this->load->view('Reportes/gestion_extrajudicial_mensual_datos_total', $datos);
            }else{
                $gestion1 = array();
                $gestion2 = array();
                $nombreFrgs = array();
                $data1 = array();
                $data2 = array();
                $data3 = array();

                $json = array();
                $i= 0;
                /*var_dump($frg);
                echo 'Este el total' . count($frg);*/
                for ($j=0; $j < count($frg) ; $j++) { 
                    $cumplimiento = 0;
                    $incumpliemiento = 0;
                    $totalBaseMedicion = 0;

                    $gestion = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0($frg[$j], $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1($frg[$j], $fechaGrantia, $fechaGrantiaFinal);
                    $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0_Total($frg[$j], $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1_Total($frg[$j], $fechaGrantia, $fechaGrantiaFinal);
                    $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_0($frg[$j], $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin);
                    $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_1($frg[$j], $fechaGrantia, $fechaGrantiaFinal);
                    $frgss = $this->db->get_where('FRG',array('Id' => $frg[$j]));

                    

                    foreach ($gestion_deglosado as $key) {
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $json[$i]['gestionado'] = 'TIENE GESTION';
                            $cumplimiento++;
                        }else{
                            $json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $incumpliemiento++;
                        }

                        //echo 'Aja';
                        $deudor = trim(utf8_encode($key->nombre));
                        $nombre = substr($deudor, 0, 3);
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }

                    foreach ($gestion_deglosado_1 as $key) {
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $json[$i]['gestionado'] = 'TIENE GESTION';
                            $cumplimiento++;
                        }else{
                            $json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $incumpliemiento++;
                        }
                        $deudor = trim(utf8_encode($key->nombre));
                        $nombre = substr($deudor, 0, 3);
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }

                    $gestion1[$j] = $gestion;
                    $gestion2[$j] = $gestion_0;
                    $nombreFrgs[$j] = $frgss->row()->FRG;
                    $data1[$j] = $cumplimiento;
                    $data2[$j] = $incumpliemiento;
                    $data3[$j] = $totalBaseMedicion;
                    //echo 'Este es el valor' . $j;
                }
                    /*echo 'nombres';
                    var_dump($nombreFrgs);
                    echo 'cumplimiento';
                    var_dump($data1);
                    echo 'Incumplimiento';
                    var_dump($data2);
                    echo 'totales';
                    var_dump($data3);*/

                $datos = array( 'gestiones' => $gestion1 ,
                                'gestiones_1' => $gestion2 ,
                                'gestiones_deglosado' => json_encode($json),
                                'total' => $totalGestiones ,
                                'fechaInicial' => $nuevafecha,
                                'fecchFinal' =>  $nuevafechaDiaFin,
                                'frg' => $nombreFrgs,
                                'cumplimiento' => $data1,
                                'incumpliemiento' => $data2,
                                'totalObligaciones' => $data3);

                $this->load->view('Reportes/gestion_extrajudicial_mensual_datos', $datos);
            }
            

        }else{
            //esto es por si mandan un FRG vacio
            $frgs = $this->Configuraciones_Model->getFrgs();
            $labels = array();
            $frg = array();
            $valor = 0;
            $json = array();
            $i= 0;
            foreach ($frgs as $key2) {
                
                $frgNull = $key2->Id;
                $gestion = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0($frgNull, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0_Total($frgNull, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1_Total($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_0($frgNull,  $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin);     
                $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_1($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                $cumplimiento = 0;
                $Nocumplen = 0;
                $totalBaseMedicion = 0;

                foreach ($gestion as $key ) {
                    $totalBaseMedicion++;
                    $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                    
                    if($gestions >= 1){
                        $cumplimiento++;
                    }else{
                        $Nocumplen++;
                    }
                }

                foreach ($gestion_deglosado as $key) {

                    $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                    if($gestions >= 1){
                        $json[$i]['gestionado'] = 'TIENE GESTION';
                    }else{
                        $json[$i]['gestionado'] = 'NO TIENE GESTION';
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $i++;
                }

                foreach ($gestion_0 as $key ) {

                    $totalBaseMedicion++;
                    $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                    if($gestions >= 1){
                        $cumplimiento++;
                    }else{
                        $Nocumplen++;
                    }

                    //
                }

                
                foreach ($gestion_deglosado_1 as $key) {
                    $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                    if($gestions >= 1){
                        $json[$i]['gestionado'] = 'TIENE GESTION';
                    }else{
                        $json[$i]['gestionado'] = 'NO TIENE GESTION';
                    }
                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $i++;
                }

                $frg[$valor]['Total'] = $totalBaseMedicion;
                $frg[$valor]['cumplen'] = $cumplimiento;
                $frg[$valor]['nocumplen'] = $Nocumplen;
                $frg[$valor]['Frg'] = $key2->Frg;
                $valor++;

                
                
            }

            

            $datos = array( 'datos' => $frg ,
                            'datos2' => $frg,
                            'gestiones_deglosado' => json_encode($json));
            $this->load->view('Reportes/gestion_extrajudicial_mensual_datos_total', $datos);
        }
        
    }

    function exportar_gestion_extrajudicial_mensual( $frg=NULL,  $fechaInicial){
        if($this->session->userdata('login_ok')){
           
            // echo 'Fecha elegida => '.$fechaBusqueda.'</br>';
            $fechaBusqueda = '01-'.$fechaInicial;
            //le resto el mes inmediatamente anterior
            $fechamesAnterior = strtotime ( '-1 month' , strtotime ( $fechaBusqueda ) ) ;
            $nuevafecha = date ( 'Y-m-d' , $fechamesAnterior );
            //echo 'Fecha Para pago abono => '.$nuevafecha.'</br>';

            $fechadiaFinmesAnterior = strtotime ( '-1 day' , strtotime ( $fechaBusqueda ) ) ;
            $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
             //echo 'Fecha Para pago abono Final => '.$nuevafechaDiaFin.'</br>';


            //Le resto para buscar el pago de la garantia
            $fechamesGarantia = strtotime ( '-2 month' , strtotime ( $fechaBusqueda ) ) ;
            $fechaGrantia = date ( 'Y-m-d' , $fechamesGarantia );
            // echo 'Fecha Para Garantia => '.$fechaGrantia.'</br>';

            $fechamesGarantiaFinal = strtotime ( '-1 day' , strtotime ( $nuevafecha ) ) ;
            $fechaGrantiaFinal = date ( 'Y-m-d' , $fechamesGarantiaFinal );

            if( $frg != NULL && $frg != '' && $frg != 0){

                $gestion = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0($frg, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1($frg, $fechaGrantia, $fechaGrantiaFinal);
                $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0_Total($frg, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1_Total($frg, $fechaGrantia, $fechaGrantiaFinal);
                $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_0($frg, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin);
                $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_1($frg, $fechaGrantia, $fechaGrantiaFinal);
                $frgss = $this->db->get_where('FRG',array('Id' => $frg));

                $json = array();
                $i= 0;

                foreach ($gestion_deglosado as $key) {

                    $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                    if($gestions >= 1){
                        $json[$i]['gestionado'] = 'TIENE GESTION';
                    }else{
                        $json[$i]['gestionado'] = 'NO TIENE GESTION';
                    }

                    //echo 'Aja';
                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $i++;
                }

                foreach ($gestion_deglosado_1 as $key) {
                    //echo 'eje';
                    $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                    if($gestions >= 1){
                        $json[$i]['gestionado'] = 'TIENE GESTION';
                    }else{
                        $json[$i]['gestionado'] = 'NO TIENE GESTION';
                    }
                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = $deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $i++;
                }

                $datos = array( 'gestiones' => $gestion ,
                            'gestiones_1' => $gestion_0 ,
                            'gestiones_deglosado' => $json,
                            'total' => $totalGestiones ,
                            'fechaInicial' => $nuevafecha,
                            'fecchFinal' =>  $nuevafechaDiaFin,
                            'frg' => $frgss->row()->FRG);
                $this->load->view('Reportes/Exportar_gestion_extrajudicial_mensual_datos', $datos);
            }else{
                    //esto es por si mandan un FRG vacio
                $frgs = $this->Configuraciones_Model->getFrgs();
                $labels = array();
                $frg = array();
                $valor = 0;
                $json = array();
                $i= 0;
                foreach ($frgs as $key2) {
                    
                    $frgNull = $key2->Id;
                    $gestion = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0($frgNull, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                    $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_0_Total($frgNull, $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mansual_Saldo_1_Total($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                    $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_0($frgNull,  $fechaGrantia, $fechaGrantiaFinal, $nuevafecha, $nuevafechaDiaFin);     
                    $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mansual_deglosado_1($frgNull, $fechaGrantia, $fechaGrantiaFinal);
                    $cumplimiento = 0;
                    $Nocumplen = 0;
                    $totalBaseMedicion = 0;

                    foreach ($gestion as $key ) {
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        
                        if($gestions >= 1){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }
                    }

                    foreach ($gestion_deglosado as $key) {

                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $json[$i]['gestionado'] = 'TIENE GESTION';
                        }else{
                            $json[$i]['gestionado'] = 'NO TIENE GESTION';
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        $nombre = substr($deudor, 0, 3);
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }

                    foreach ($gestion_0 as $key ) {

                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }

                        //
                    }

                    
                    foreach ($gestion_deglosado_1 as $key) {
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->Id, $nuevafecha, $nuevafechaDiaFin);
                        if($gestions >= 1){
                            $json[$i]['gestionado'] = 'TIENE GESTION';
                        }else{
                            $json[$i]['gestionado'] = 'NO TIENE GESTION';
                        }
                        $deudor = trim(utf8_encode($key->nombre));
                        $nombre = substr($deudor, 0, 3);
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }

                    $frg[$valor]['Total'] = $totalBaseMedicion;
                    $frg[$valor]['cumplen'] = $cumplimiento;
                    $frg[$valor]['nocumplen'] = $Nocumplen;
                    $frg[$valor]['Frg'] = $key2->Frg;
                    $valor++;

                    
                    
                }

                

                $datos = array( 'datos' => $frg ,
                                'datos2' => $frg,
                                'gestiones_deglosado' => $json);
                $this->load->view('Reportes/Exportar_gestion_extrajudicial_mensual_datos_total', $datos);
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    //sfunciones de subrogaciones efectivas
    function subrogaciones_efectivas(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Subrogaciones Efectivas');
            $datosFooter = array('ul'=> 'LIreportes' , 'li' => 'LIsubrogaciones_'); 

           
            $Frgs = $this->Configuraciones_Model->getFrgs();
            $datos = array( 'frgs' =>  $Frgs
                            );

            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/subrogaciones_efectivas', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getSubrogaciones_efectivas(){
        
        $frg = $_POST['frg'];
        $fechaInicial = $_POST['fechainicial'];
        $fechaFinal = $_POST['fechafinal'];

        if( $frg != NULL && $frg != '' && $frg != 0){
            $this->db->select('COUNT(*) as cantidad');
            $this->db->from('Tabla_base_medicion_subrogaciones');
            $this->db->where('Sub_Frg', $frg);
            $totalBaseMedicion = $this->db->get();
            
            $gestion = $this->Reportes_Model->getSUbrogaciones_Efectivas($frg, $fechaInicial, $fechaFinal);
            $gestion_deglosado = $this->Reportes_Model->getReportessubrogacionesEfectivas_deglosado($frg, $fechaInicial, $fechaFinal);

            $frgss = $this->db->get_where('FRG',array('Id' => $frg));
            
            $this->db->select('par_meta, par_tiempo_asignacion, cant_obligaciones');
            $this->db->from('Parametros_reportes');
            $this->db->join('Reportes', 'par_rep_id = rep_id');
            $this->db->where('rep_orden', 'reporte3');
            $reporteDatos = $this->db->get();


            $json = array();
            $i= 0;

            foreach ($gestion_deglosado as $key) {

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $json[$i]['contrato'] = $key->contrato ;
                $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $json[$i]['identificacion'] = $key->identificacion;
                $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                
                $fecha2 = NULL;
                $fecha3 = NULL;
                if(!is_null($key->Sub_fecha_factura)){
                    $fecha2 = explode(" ", $key->Sub_fecha_factura)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }
                
                if(!is_null($key->Sub_fecha_auto)){
                    $fecha3 = explode(" ", $key->Sub_fecha_auto)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }
                    


                $json[$i]['Sub_factura_subrogacion'] = $key->Sub_factura_subrogacion ;
                $json[$i]['Sub_fecha_factura'] =  $fecha2;
                $json[$i]['Sub_fecha_auto'] = $fecha3;
                $i++;
            }

            $datos = array( 'gestiones' => $gestion ,
                            'gestiones_deglosado' => json_encode($json),
                            'meta' => $reporteDatos->row()->cant_obligaciones ,
                            'frg' => $frgss->row()->FRG,
                            'totalBase' =>  $totalBaseMedicion->row()->cantidad);
            $this->load->view('Reportes/subrogaciones_efectivas_datos', $datos);
        }else{

            $frgs = $this->Configuraciones_Model->getFrgs();
            $datoss = array();
            $valor = 0;
            $json = array();
            $i= 0;
            foreach ($frgs as $key2) {
                $this->db->select('COUNT(*) as cantidad');
                $this->db->from('Tabla_base_medicion_subrogaciones');
                $this->db->where('Sub_Frg', $key2->Id);
                $totalBaseMedicion = $this->db->get();

                $gestion = $this->Reportes_Model->getSUbrogaciones_Efectivas($key2->Id, $fechaInicial, $fechaFinal);
                $total = 0;
                foreach ($gestion as $key) {
                    $total++;
                }
                $datoss[$valor]['total'] = $total;
                $datoss[$valor]['Frg'] = $key2->Frg;
                $datoss[$valor]['totalBase'] =  $totalBaseMedicion->row()->cantidad;
                $valor++;

                $gestion_deglosado = $this->Reportes_Model->getReportessubrogacionesEfectivas_deglosado($key2->Id, $fechaInicial, $fechaFinal);
                foreach ($gestion_deglosado as $key) {

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');

                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    if(!is_null($key->Sub_fecha_factura)){
                        $fecha2 = explode(" ", $key->Sub_fecha_factura)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    
                    if(!is_null($key->Sub_fecha_auto)){
                        $fecha3 = explode(" ", $key->Sub_fecha_auto)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }

                    $json[$i]['Sub_factura_subrogacion'] = $key->Sub_factura_subrogacion ;
                    $json[$i]['Sub_fecha_factura'] = $fecha2 ;
                    $json[$i]['Sub_fecha_auto'] =  $fecha3;
                    $i++;
                }

            }


            
            $frgss = $this->db->get_where('FRG',array('Id' => $frg));
            $this->db->select('par_meta, par_tiempo_asignacion, cant_obligaciones');
            $this->db->from('Parametros_reportes');
            $this->db->join('Reportes', 'par_rep_id = rep_id');
            $this->db->where('rep_orden', 'reporte3');
            $reporteDatos = $this->db->get();

            
            
            

            $datos = array( 'datos' => $datoss ,
                            'gestiones_deglosado' => json_encode($json),
                            'meta' => $reporteDatos->row()->cant_obligaciones);
            $this->load->view('Reportes/subrogaciones_efectivas_datos_total', $datos);
        }
    }

    function getSubrogaciones_efectivas_exportar($frg = NULL, $fechaInicial, $fechaFinal){
        

        if( $frg != NULL && $frg != '' && $frg != 0){
           
            $gestion = $this->Reportes_Model->getSUbrogaciones_Efectivas($frg, $fechaInicial, $fechaFinal);
            $gestion_deglosado = $this->Reportes_Model->getReportessubrogacionesEfectivas_deglosado($frg, $fechaInicial, $fechaFinal);
            $frgss = $this->db->get_where('FRG',array('Id' => $frg));
            $this->db->select('par_meta, par_tiempo_asignacion, cant_obligaciones');
            $this->db->from('Parametros_reportes');
            $this->db->join('Reportes', 'par_rep_id = rep_id');
            $this->db->where('rep_orden', 'reporte3');
            $reporteDatos = $this->db->get();

            $datos = array( 'gestiones' => $gestion ,
                            'gestiones_deglosado' => $gestion_deglosado,
                            'meta' => $reporteDatos->row()->cant_obligaciones ,
                            'frg' => $frgss->row()->FRG);
            $this->load->view('Reportes/subrogaciones_efectivas_datos_exportar', $datos);
        }else{
            $frgs = $this->Configuraciones_Model->getFrgs();
            $datoss = array();
            $valor = 0;
            $json = array();
            $i= 0;
            foreach ($frgs as $key2) {
                $labels[$valor] = $key2->Frg;
                $gestion = $this->Reportes_Model->getSUbrogaciones_Efectivas($key2->Id, $fechaInicial, $fechaFinal);
                $total = 0;
                foreach ($gestion as $key) {
                    $total++;
                }
                $datoss[$valor]['total'] = $total;
                $datoss[$valor]['Frg'] = $key2->Frg;
                $valor++;

                $gestion_deglosado = $this->Reportes_Model->getReportessubrogacionesEfectivas_deglosado($key2->Id, $fechaInicial, $fechaFinal);
                foreach ($gestion_deglosado as $key) {

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');

                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    if(!is_null($key->Sub_fecha_factura)){
                        $fecha2 = explode(" ", $key->Sub_fecha_factura)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    
                    if(!is_null($key->Sub_fecha_auto)){
                        $fecha3 = explode(" ", $key->Sub_fecha_auto)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }

                    $json[$i]['Sub_factura_subrogacion'] = $key->Sub_factura_subrogacion ;
                    $json[$i]['Sub_fecha_factura'] = $fecha2;
                    $json[$i]['Sub_fecha_auto'] = $fecha3;
                    $i++;
                }

            }


            
            $frgss = $this->db->get_where('FRG',array('Id' => $frg));
            $this->db->select('par_meta, par_tiempo_asignacion, cant_obligaciones');
            $this->db->from('Parametros_reportes');
            $this->db->join('Reportes', 'par_rep_id = rep_id');
            $this->db->where('rep_orden', 'reporte3');
            $reporteDatos = $this->db->get();

            $datos = array('labels' => $labels,
                                    'datos' => $datoss,
                                    'others' => $datoss,
                                    'other' => $datoss,
                                    'Contratos' => $json,
                                    'meta' => $reporteDatos->row()->par_meta ,
                                    'fechas' =>  $fechaInicial.'_'.$fechaFinal,);
            $this->load->view('Reportes/subrogaciones_efectivas_datos_exportar_total', $datos);
            
            
        }
    }


   


    /*¡¡function Judiciales ete es otro resporte!!*/
    function Judiciales(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Gestiones Judiciales');
            $datosFooter = array('ul'=> 'LIreportes2' , 'li' => 'LIJudicialesEsta'); 

           
            $Frgs = $this->Configuraciones_Model->getFrgs();
            $datos = array( 'frgs' =>  $Frgs
                            );

            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/radicacion_memoriales', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getBaseMedicionJudicial(){
        if($this->session->userdata('login_ok')){
            $frg = $_POST['frg'];
            $fechaInicial = $_POST['txtFechaInicial'];
            $fechaFinal = $_POST['txtFechaFinal'];
            if( $frg != NULL && $frg != '' && $frg != 0){
                $frgss = $this->db->get_where('FRG',array('Id' => $frg));
                $gestion = $this->Reportes_Model->getBaseGEstionesJudiciales($frg);
                $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($frg);
                $json = array();
                $i = 0;
                foreach ($gestion_deglosado as $key) {

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $json[$i]['SAP'] = $key->SAP ;

                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    if(!is_null($key->fecha_abogado)){
                        $fecha2 = explode(" ", $key->fecha_abogado)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                   


                    $json[$i]['fecha_abogado'] = $fecha2 ;
                    /*$json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['contrato'] = $key->contrato ;*/
                    $i++;
                }

                $datos = array( 'getionBase' => $gestion , 
                                'todaBase' => json_encode($json) , 
                                'fechaInicial' => $fechaInicial , 
                                'fechaFinal' => $fechaFinal,
                                'frg' => $frgss->row()->FRG  );
                $this->load->view('Reportes/gestiones_judiciales_datos', $datos);
            }else{
                $frgs = $this->Configuraciones_Model->getFrgs();
                $datoss = array();
                $valor = 0;
                $totalBaseMedicion = 1;
                 $frg = array();
                foreach ($frgs as $key2) {
                    $cumplimiento = 0;
                    $Nocumplen = 0;
                    $gestion = $this->Reportes_Model->getBaseGEstionesJudiciales($key2->Id);
                    foreach ($gestion as $key) {
                        $totalBaseMedicion +=1;
                        $gestione = $this->Reportes_Model->tieneGestionJudicial($key->Id, $fechaInicial, $fechaFinal);
                        if($gestione >= 1){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }
                    }

                    $frg[$valor]['Total'] = $totalBaseMedicion;
                    $frg[$valor]['cumplen'] = $cumplimiento;
                    $frg[$valor]['nocumplen'] = $Nocumplen;
                    $frg[$valor]['Frg'] = $key2->Frg;
                    $valor++;
                }

                $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($key2->Id);
                $json = array();
                $i = 0;
                foreach ($gestion_deglosado as $key) {

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $json[$i]['SAP'] = $key->SAP ;
                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    if(!is_null($key->fecha_abogado)){
                        $fecha2 = explode(" ", $key->fecha_abogado)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                   


                    $json[$i]['fecha_abogado'] = $fecha2 ;
                    /*$json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['contrato'] = $key->contrato ;*/
                    $i++;
                }

                 $datos = array( 'datos' => $frg ,
                            'datos2' => $frg,
                            'gestiones_deglosado' => json_encode($json));
                $this->load->view('Reportes/gestion_judicial_datos_total', $datos);
            }
        }else{
            echo "No tienes permisos para esta operaci&oacute;n";
        }
        
    }


    function getBaseMedicionJudicial_exportar($frg = NULL,$fechaInicial = NULL, $fechaFinal = NULL ){
        if($this->session->userdata('login_ok')){
            
            if( $frg != NULL && $frg != '' && $frg != 0){
                $frgss = $this->db->get_where('FRG',array('Id' => $frg));
                $gestion = $this->Reportes_Model->getBaseGEstionesJudiciales($frg);
                $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($frg);
                $json = array();
                $i = 0;
                foreach ($gestion_deglosado as $key) {

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $json[$i]['SAP'] = $key->SAP ;

                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    if(!is_null($key->fecha_abogado)){
                        $fecha2 = explode(" ", $key->fecha_abogado)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                   


                    $json[$i]['fecha_abogado'] = $fecha2 ;
                    /*$json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['contrato'] = $key->contrato ;*/
                    $i++;
                }

                $datos = array( 'getionBase' => $gestion , 
                                'todaBase' => $json, 
                                'fechaInicial' => $fechaInicial , 
                                'fechaFinal' => $fechaFinal,
                                'frg' => $frgss->row()->FRG  );
                $this->load->view('Reportes/gestiones_judiciales_datos_excel', $datos);
            }else{
                $frgs = $this->Configuraciones_Model->getFrgs();
                $datoss = array();
                $valor = 0;
                $totalBaseMedicion = 1;
                 $frg = array();
                foreach ($frgs as $key2) {
                    $cumplimiento = 0;
                    $Nocumplen = 0;
                    $gestion = $this->Reportes_Model->getBaseGEstionesJudiciales($key2->Id);
                    foreach ($gestion as $key) {
                        $totalBaseMedicion +=1;
                        $gestione = $this->Reportes_Model->tieneGestionJudicial($key->Id, $fechaInicial, $fechaFinal);
                        if($gestione >= 1){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }
                    }

                    $frg[$valor]['Total'] = $totalBaseMedicion;
                    $frg[$valor]['cumplen'] = $cumplimiento;
                    $frg[$valor]['nocumplen'] = $Nocumplen;
                    $frg[$valor]['Frg'] = $key2->Frg;
                    $valor++;
                }

                $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($key2->Id);
                $json = array();
                $i = 0;
                foreach ($gestion_deglosado as $key) {

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $json[$i]['SAP'] = $key->SAP ;
                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    if(!is_null($key->fecha_abogado)){
                        $fecha2 = explode(" ", $key->fecha_abogado)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                   


                    $json[$i]['fecha_abogado'] = $fecha2 ;
                    /*$json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['contrato'] = $key->contrato ;*/
                    $i++;
                }

                 $datos = array( 'datos' => $frg ,
                            'datos2' => $frg,
                            'gestiones_deglosado' => $json);
                $this->load->view('Reportes/gestion_judicial_datos_total_excel', $datos);
            }
        }else{
            echo "No tienes permisos para esta operaci&oacute;n";
        }
        
    }

   

     /*¡¡function soprte CISA!!*/
    function soporte_cisa(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Informe evaluación FRG  - Soporte CISA ');
            $datosFooter = array('ul'=> 'LIreportes' , 'li' => 'LiSoptreCisa'); 

           
            $Frgs = $this->Configuraciones_Model->getFrgs();
            $this->db->select('Ven_nombre,Ven_fecha_venta,Ven_fecha_notificacion,Ven_fecha_Maxima, ven_id');
            $this->db->from('Parametros_cisa');
            $this->db->where('Ven_estado' , 'ACTIVO');
            $query = $this->db->get();
            $dat = $query->result();

            
            $datos = array( 'frgs' =>  $Frgs, 'fechas' => $dat
                            );

            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/soporte_cisa', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getdatosReporteCisa(){
        if($this->session->userdata('login_ok')){
            $frg = $_POST['frg'];
            $this->db->select('Ven_fecha_venta,Ven_fecha_notificacion,Ven_fecha_Maxima, Ven_nombre');
            $this->db->from('Parametros_cisa');
            $this->db->where('ven_id' , $_POST['venta']);
            //$query = $this->db->get();
            $dat = $this->db->get();


            if( $frg != NULL && $frg != '' && $frg != 0){
                
                $fechaVEnta = $dat->row()->Ven_fecha_venta;
                $fechaNotificacion = $dat->row()->Ven_fecha_notificacion;
                $fechaFinal = $dat->row()->Ven_fecha_Maxima;
                $frgss = $this->db->get_where('FRG',array('Id' => $frg));

                $base = $this->Reportes_Model->getReporteCisa($frg, $fechaVEnta);
                
                $baseDeglosada2 = $this->Reportes_Model->getReporteCisa_deglosadoS($frg, $fechaVEnta);

                $json = array();
                $i = 0;
               
                foreach($baseDeglosada2 as $key){

                    $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->Id, $fechaNotificacion, $fechaFinal);
                    
                    if($soporte >= 1){
                       $json[$i]['cumple'] = 'SI';
                    }else{
                       $json[$i]['cumple'] = 'NO';
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $json[$i]['SAP'] = $key->SAP ;

                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    if(!is_null($key->Fecha_recepcion_soporte)){
                        $fecha2 = explode(" ", $key->Fecha_recepcion_soporte)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }

                    if(!is_null($key->Fecha_aprovacion_soporte)){
                        $fecha3 = explode(" ", $key->Fecha_aprovacion_soporte)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }
            
                    $json[$i]['fecha_soprte'] = $fecha2 ;
                    $json[$i]['fecha_soprte_ap'] = $fecha3 ;
                    /*$json[$i]['contrato'] = $key->contrato ;*/
                    $i++;
                }


                $datos = array( 'getionBase' => $base , 
                                'fechaVEnta' => $fechaVEnta,
                                'contratos' => json_encode($json),
                                'Ven_nombre' => $dat->row()->Ven_nombre,
                                'fechaInicial' => $fechaNotificacion , 
                                'fechaFinal' => $fechaFinal,
                                'frg' => $frgss->row()->FRG);
                $this->load->view('Reportes/Reporte_Cisa_datos', $datos);

            }else{
                $frgs = $this->Configuraciones_Model->getFrgs();
                $datoss = array();
                $valor = 0;
                $totalBaseMedicion = 0;
                $frg = array();
                $json = array();
                $i = 0;
                foreach ($frgs as $key2) {
                    $cumplimiento = 0;
                    $Nocumplen = 0;
                    $totalBaseMedicion = 0;
                    $fechaVEnta = $dat->row()->Ven_fecha_venta;
                    $fechaNotificacion = $dat->row()->Ven_fecha_notificacion;
                    $fechaFinal = $dat->row()->Ven_fecha_Maxima;
                    

                    $base = $this->Reportes_Model->getReporteCisa($key2->Id, $fechaVEnta);
                   // var_dump($base);
                    if(count( $base) > 0){
                        foreach ($base as $key) {
                            $totalBaseMedicion++;
                            $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->Id, $fechaNotificacion, $fechaFinal);
                            if($soporte >= 1){
                                $cumplimiento++;
                            }else{
                                $Nocumplen++;
                            }
                        }
                    }
                     

                    $frg[$valor]['Total'] = $totalBaseMedicion;
                    $frg[$valor]['cumplen'] = $cumplimiento;
                    $frg[$valor]['nocumplen'] = $Nocumplen;
                    $frg[$valor]['Frg'] = $key2->Frg;
                    $valor++;

                    $baseDeglosada2 = $this->Reportes_Model->getReporteCisa_deglosadoS($key2->Id, $fechaVEnta);

                    
                
                    foreach($baseDeglosada2 as $key){
                       $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->Id, $fechaNotificacion, $fechaFinal);
                    
                        if($soporte >= 1){
                        $json[$i]['cumple'] = 'SI';
                        }else{
                        $json[$i]['cumple'] = 'NO';
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        $nombre = substr($deudor, 0, 3);
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $json[$i]['SAP'] = $key->SAP ;

                        $fecha2 = NULL;
                        $fecha3 = NULL;
                        if(!is_null($key->Fecha_recepcion_soporte)){
                            $fecha2 = explode(" ", $key->Fecha_recepcion_soporte)[0];
                            $fecha2 = explode("-", $fecha2);
                            $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                        }

                        if(!is_null($key->Fecha_aprovacion_soporte)){
                            $fecha3 = explode(" ", $key->Fecha_aprovacion_soporte)[0];
                            $fecha3 = explode("-", $fecha3);
                            $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                        }


                        $json[$i]['fecha_soprte'] = $fecha2 ;
                        $json[$i]['fecha_soprte_ap'] = $fecha3 ;
                  
                        $i++;
                    }

                    
                }

               

                 $datos = array( 'datos' => $frg ,
                            'datos2' => $frg,
                            'gestiones_deglosado' => json_encode($json));
                $this->load->view('Reportes/Reporte_CISA_total', $datos);
            }
        }else{
            echo "No hay permisos para mostrar esto";
        }
    }

    function exportarCisa($frg = NULL, $fventa){
        $this->db->select('Ven_fecha_venta,Ven_fecha_notificacion,Ven_fecha_Maxima, Ven_nombre');
            $this->db->from('Parametros_cisa');
            $this->db->where('ven_id' , $fventa);
            //$query = $this->db->get();
            $dat = $this->db->get();


            if( $frg != NULL && $frg != '' && $frg != 0){
                
                $fechaVEnta = $dat->row()->Ven_fecha_venta;
                $fechaNotificacion = $dat->row()->Ven_fecha_notificacion;
                $fechaFinal = $dat->row()->Ven_fecha_Maxima;
                $frgss = $this->db->get_where('FRG',array('Id' => $frg));

                $base = $this->Reportes_Model->getReporteCisa($frg, $fechaVEnta);
                
                $baseDeglosada2 = $this->Reportes_Model->getReporteCisa_deglosadoS($frg, $fechaVEnta);

               
               
               /* foreach($baseDeglosada2 as $key){

                    $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->Id, $fechaNotificacion, $fechaFinal);
                    
                    if($soporte >= 1){
                       $json[$i]['cumple'] = 'SI';
                    }else{
                       $json[$i]['cumple'] = 'NO';
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                    $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                    $json[$i]['SAP'] = $key->SAP ;
                    $json[$i]['fecha_soprte'] = $key->Fecha_recepcion_soporte ;
                    $json[$i]['fecha_soprte_ap'] = $key->Fecha_aprovacion_soporte ;
                    /*$json[$i]['contrato'] = $key->contrato ;
                    $i++;
                }*/


                $datos = array( 'getionBase' => $base , 
                                'fechaVEnta' => $fechaVEnta,
                                'contratos' => $baseDeglosada2,
                                'Ven_nombre' => $dat->row()->Ven_nombre,
                                'fechaInicial' => $fechaNotificacion , 
                                'fechaFinal' => $fechaFinal,
                                'frg' => $frgss->row()->FRG);
                $this->load->view('Reportes/Reporte_Cisa_datos_Exporte', $datos);

            }
    }


    //Radicaicon memorales de subrogacion
    function radicacion_memoriales_subrogaciones(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Asignación de abogados');
            $datosFooter = array('ul'=> 'LIreportes2' , 'li' => 'LIradicacionMemoriales'); 

           
            $Frgs = $this->Configuraciones_Model->getFrgs();
            $datos = array( 
                            'frgs' =>  $Frgs
                            );

            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/radicacion_memoriales_subrogaciones', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getmemorialesSubrogaciones($frg = NULL, $abogado = NULL, $fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select('par_meta, par_tiempo_asignacion');
        $this->db->from('Parametros_reportes');
        $this->db->join('Reportes', 'par_rep_id = rep_id');
        $this->db->where('rep_orden', 'reporte5');
        $reporteDatos = $this->db->get();


        if($frg != NULL && $frg != 0){
            //primero buscar la base de medicion
            $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($frg, $abogado , $fechaInicial, $fechaFinal);
            $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($frg, $abogado , $fechaInicial, $fechaFinal);
            $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($frg, $abogado , $fechaInicial, $fechaFinal);
            $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($frg, $abogado , $fechaInicial, $fechaFinal);

            $json = array();
            $i = 0;
            $dias = $reporteDatos->row()->par_tiempo_asignacion;
            foreach ($baseSubrogacionDeglosada_ as $key) {

                $fechadiaFinmesAnterior = strtotime ( '+'.$dias.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

               
                
                if($radicado == 1){
                   $json[$i]['cumple'] = 'SI';
                }else{
                    date_default_timezone_set('America/Bogota');
                    $fechaIngreso =  date("Y-m-d H:i:s");

                    $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                    $datetime2 = new DateTime($fechaIngreso);
                    $interval = $datetime1->diff($datetime2);

                    if($dias > $interval->format('%R%a') ){
                        $json[$i]['cumple'] = 'NO ASIGNADA EN TIEMPO';
                    }else{
                        $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                        if($radicadoSt == 1){
                            $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                        }else{
                            $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                        }
                       
                    }

                }

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $json[$i]['contrato'] = $key->contrato ;
                $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $json[$i]['identificacion'] = $key->identificacion;
               
                $json[$i]['SAP'] = $key->SAP ;

                $fecha2 = NULL;
                $fecha3 = NULL;
                $fecha4 = NULL;
                if(!is_null($key->Fecha_envio_Memorial)){
                    $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                    $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }


                if(!is_null($key->radicacion)){
                    $fecha4 = explode(" ", $key->radicacion)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }




                $json[$i]['envioMemorial'] = $fecha2  ;
                $json[$i]['envioMemorialC'] = $fecha3 ;
                $json[$i]['radicacion'] = $fecha4 ;
                $i++;
            }

            foreach ($baseSubrogacionDeglosada as $key) {
                $fechadiaFinmesAnterior = strtotime ( '+'.$dias.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

               
                
                if($radicado == 1){
                   $json[$i]['cumple'] = 'SI';
                }else{
                    $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                    if($radicadoSt == 1){
                        $json[$i]['cumple'] = 'FUERA DE TIEMPO';
                    }else{
                        $radicadoStN = $this->Reportes_Model->NotieneRadicadoFueraTiempo_2($key->id, $nuevafechaDiaFin); 
                        if($radicadoStN == 0){
                            $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                        }else{
                            $json[$i]['cumple'] = 'NO ASIGNADO EN TIEMPO';
                        }
                    }
                }

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $json[$i]['contrato'] = $key->contrato ;
                $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $json[$i]['identificacion'] = $key->identificacion;
               
                $json[$i]['SAP'] = $key->SAP ;
               $fecha2 = NULL;
                $fecha3 = NULL;
                $fecha4 = NULL;
                if(!is_null($key->Fecha_envio_Memorial)){
                    $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                    $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }


                if(!is_null($key->radicacion)){
                    $fecha4 = explode(" ", $key->radicacion)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }




                $json[$i]['envioMemorial'] = $fecha2  ;
                $json[$i]['envioMemorialC'] = $fecha3 ;
                $json[$i]['radicacion'] = $fecha4 ;
                /*$json[$i]['contrato'] = $key->contrato ;*/
                $i++;
            }

            $frgss = $this->db->get_where('FRG',array('Id' => $frg));

            $datos  = array(    'Subrogaciones_envio' => $baseSubrogacion , 
                                'Subrogaciones_envio_corregidos' => $baseSubrogacionCorr,
                                'frg' => $frgss->row()->FRG,
                                'contratos' => json_encode($json),
                                'meta' =>  $reporteDatos->row()->par_meta,
                                'tiempo' =>  $reporteDatos->row()->par_tiempo_asignacion);
            $this->load->view('Reportes/radicacion_memoriales_subrogaciones_datos', $datos);
        }else{
             //primero buscar la base de medicion
            $frgs = $this->Configuraciones_Model->getFrgs();
            $datoss = array();
            $valor = 0;
            $totalBaseMedicion = 0;
            $frg = array();
            $json = array();
            $i = 0;
            $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
            foreach ($frgs as $key2) {
                $cumplimiento = 0;
                $Fallos = 0;
                $totalObligaciones = 0;
                $radicadosFueradetiempo = 0;
                $sinradicarFueradeTiempo = 0;

                $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($key2->Id, $abogado , $fechaInicial, $fechaFinal);
                $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($key2->Id, $abogado , $fechaInicial, $fechaFinal);

                $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($key2->Id, $abogado , $fechaInicial, $fechaFinal);
                $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($key2->Id, $abogado , $fechaInicial, $fechaFinal);

                foreach ($baseSubrogacion as $key) {
                    
                    $totalObligaciones++;
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

                    if($radicado == 1){
                        $cumplimiento++;
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($tiempo > $interval->format('%R%a') ){
                            $Fallos++;
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $radicadosFueradetiempo++;
                            }else{
                                $sinradicarFueradeTiempo++;
                            }
                            
                        }

                    }
                }


                foreach ($baseSubrogacionCorr as $key) {
                    
                    $totalObligaciones++;
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin);

                    if($radicado == 1){
                        $cumplimiento++;
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($tiempo > $interval->format('%R%a') ){
                            $Fallos++;
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $radicadosFueradetiempo++;
                            }else{
                                $sinradicarFueradeTiempo++;
                            }
                            
                        }
                    }
                }

                $frg[$valor]['Total'] = $totalObligaciones;
                $frg[$valor]['cumplen'] = $cumplimiento;
                $frg[$valor]['nocumplen'] = $Fallos;
                $frg[$valor]['sinasignarsintiempo'] = $sinradicarFueradeTiempo;
                $frg[$valor]['radicadosfueradetiempo'] = $radicadosFueradetiempo;
                $frg[$valor]['Frg'] = $key2->Frg;
                $valor++;

                foreach ($baseSubrogacionDeglosada_ as $key) {

                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

                   
                    
                    if($radicado == 1){
                       $json[$i]['cumple'] = 'SI';
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($tiempo > $interval->format('%R%a') ){
                            $json[$i]['cumple'] = 'NO ASIGNADA EN TIEMPO';
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }
                           
                        }
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   
                    $json[$i]['SAP'] = $key->SAP ;
                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    $fecha4 = NULL;
                    if(!is_null($key->Fecha_envio_Memorial)){
                        $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }

                    if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                        $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }


                    if(!is_null($key->radicacion)){
                        $fecha4 = explode(" ", $key->radicacion)[0];
                        $fecha4 = explode("-", $fecha4);
                        $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                    }




                    $json[$i]['envioMemorial'] = $fecha2  ;
                    $json[$i]['envioMemorialC'] = $fecha3 ;
                    $json[$i]['radicacion'] = $fecha4 ;
                    $i++;
                }

                foreach ($baseSubrogacionDeglosada as $key) {
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

                   
                    
                    if($radicado == 1){
                       $json[$i]['cumple'] = 'SI';
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($tiempo > $interval->format('%R%a') ){
                            $json[$i]['cumple'] = 'NO ASIGNADA EN TIEMPO';
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }
                           
                        }
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   
                    $json[$i]['SAP'] = $key->SAP ;
                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    $fecha4 = NULL;
                    if(!is_null($key->Fecha_envio_Memorial)){
                        $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }

                    if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                        $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }


                    if(!is_null($key->radicacion)){
                        $fecha4 = explode(" ", $key->radicacion)[0];
                        $fecha4 = explode("-", $fecha4);
                        $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                    }




                    $json[$i]['envioMemorial'] = $fecha2  ;
                    $json[$i]['envioMemorialC'] = $fecha3 ;
                    $json[$i]['radicacion'] = $fecha4 ;
                    /*$json[$i]['contrato'] = $key->contrato ;*/
                    $i++;
                }



            }
           

            $datos  = array(    'datos' => $frg, 
                                'otrosDatos' => $frg,
                                'datos2' => $frg,
                                'contratos' => json_encode($json),
                                'meta' =>  $reporteDatos->row()->par_meta,
                                'tiempo' =>  $reporteDatos->row()->par_tiempo_asignacion
                              );
            $this->load->view('Reportes/radicacion_memoriales_subrogaciones_datos_total', $datos);
        }
    }

    function getmemorialesSubrogaciones_Excell($frg = NULL, $abogado = NULL, $fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select('par_meta, par_tiempo_asignacion');
        $this->db->from('Parametros_reportes');
        $this->db->join('Reportes', 'par_rep_id = rep_id');
        $this->db->where('rep_orden', 'reporte5');
        $reporteDatos = $this->db->get();

        

        if($frg != NULL && $frg != 0){
            //primero buscar la base de medicion
            $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($frg, $abogado , $fechaInicial, $fechaFinal);
            $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($frg, $abogado , $fechaInicial, $fechaFinal);
            $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($frg, $abogado , $fechaInicial, $fechaFinal);
            $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($frg, $abogado , $fechaInicial, $fechaFinal);

            $json = array();
            $i = 0;
            $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
            foreach ($baseSubrogacionDeglosada_ as $key) {

                $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

               
                
                if($radicado == 1){
                   $json[$i]['cumple'] = 'SI';
                }else{
                    date_default_timezone_set('America/Bogota');
                    $fechaIngreso =  date("Y-m-d H:i:s");

                    $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                    $datetime2 = new DateTime($fechaIngreso);
                    $interval = $datetime1->diff($datetime2);

                    if($tiempo > $interval->format('%R%a') ){
                        $json[$i]['cumple'] = 'NO ASIGNADA EN TIEMPO';
                    }else{
                        $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                        if($radicadoSt == 1){
                            $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                        }else{
                            $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                        }
                       
                    }
                }

                

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $json[$i]['contrato'] = $key->contrato ;
                $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $json[$i]['identificacion'] = $key->identificacion;
               
                $json[$i]['SAP'] = $key->SAP ;
                $fecha2 = NULL;
                $fecha3 = NULL;
                $fecha4 = NULL;
                if(!is_null($key->Fecha_envio_Memorial)){
                    $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                    $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }


                if(!is_null($key->radicacion)){
                    $fecha4 = explode(" ", $key->radicacion)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }




                $json[$i]['envioMemorial'] = $fecha2  ;
                $json[$i]['envioMemorialC'] = $fecha3 ;
                $json[$i]['radicacion'] = $fecha4 ;
                $i++;
            }

            foreach ($baseSubrogacionDeglosada as $key) {
                $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

               
                
                if($radicado == 1){
                   $json[$i]['cumple'] = 'SI';
                }else{
                    date_default_timezone_set('America/Bogota');
                    $fechaIngreso =  date("Y-m-d H:i:s");

                    $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                    $datetime2 = new DateTime($fechaIngreso);
                    $interval = $datetime1->diff($datetime2);

                    if($tiempo > $interval->format('%R%a') ){
                        $json[$i]['cumple'] = 'NO ASIGNADA EN TIEMPO';
                    }else{
                        $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                        if($radicadoSt == 1){
                            $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                        }else{
                            $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                        }
                       
                    }
                }

                $deudor = trim(utf8_encode($key->nombre));
                $nombre = substr($deudor, 0, 3);
                $json[$i]['contrato'] = $key->contrato ;
                $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $json[$i]['identificacion'] = $key->identificacion;
               
                $json[$i]['SAP'] = $key->SAP ;
                $fecha2 = NULL;
                $fecha3 = NULL;
                $fecha4 = NULL;
                if(!is_null($key->Fecha_envio_Memorial)){
                    $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                }

                if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                    $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                }


                if(!is_null($key->radicacion)){
                    $fecha4 = explode(" ", $key->radicacion)[0];
                    $fecha4 = explode("-", $fecha4);
                    $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                }




                $json[$i]['envioMemorial'] = $fecha2  ;
                $json[$i]['envioMemorialC'] = $fecha3 ;
                $json[$i]['radicacion'] = $fecha4 ;
                /*$json[$i]['contrato'] = $key->contrato ;*/
                $i++;
            }

            $frgss = $this->db->get_where('FRG',array('Id' => $frg));

            $datos  = array(    'Subrogaciones_envio' => $baseSubrogacion , 
                                'Subrogaciones_envio_corregidos' => $baseSubrogacionCorr,
                                'frg' => $frgss->row()->FRG,
                                'contratos' => $json,
                                'meta' =>  $reporteDatos->row()->par_meta,
                                'tiempo' =>  $reporteDatos->row()->par_tiempo_asignacion);
            $this->load->view('Reportes/radicacion_memoriales_subrogaciones_datos_excell', $datos);
        }else{
             //primero buscar la base de medicion
            $frgs = $this->Configuraciones_Model->getFrgs();
            $datoss = array();
            $valor = 0;
            $totalBaseMedicion = 0;
            $frg = array();
            $json = array();
            $i = 0;
            $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
            foreach ($frgs as $key2) {
                $cumplimiento = 0;
                $Fallos = 0;
                $totalObligaciones = 0;
                $radicadosFueradetiempo = 0;
                $sinradicarFueradeTiempo = 0;

                $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($key2->Id, $abogado , $fechaInicial, $fechaFinal);
                $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($key2->Id, $abogado , $fechaInicial, $fechaFinal);

                $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($key2->Id, $abogado , $fechaInicial, $fechaFinal);
                $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($key2->Id, $abogado , $fechaInicial, $fechaFinal);

                foreach ($baseSubrogacion as $key) {
                    
                    $totalObligaciones++;
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

                    if($radicado == 1){
                        $cumplimiento++;
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($tiempo > $interval->format('%R%a') ){
                            $Fallos++;
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $radicadosFueradetiempo++;
                            }else{
                                $sinradicarFueradeTiempo++;
                            }
                            
                        }
                    }

                }


                foreach ($baseSubrogacionCorr as $key) {
                    
                    $totalObligaciones++;
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin);

                    if($radicado == 1){
                        $cumplimiento++;
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($tiempo > $interval->format('%R%a') ){
                            $Fallos++;
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $radicadosFueradetiempo++;
                            }else{
                                $sinradicarFueradeTiempo++;
                            }
                            
                        }
                    }
                }

                $frg[$valor]['Total'] = $totalObligaciones;
                $frg[$valor]['cumplen'] = $cumplimiento;
                $frg[$valor]['nocumplen'] = $Fallos;
                $frg[$valor]['sinasignarsintiempo'] = $sinradicarFueradeTiempo;
                $frg[$valor]['radicadosfueradetiempo'] = $radicadosFueradetiempo;
                $frg[$valor]['Frg'] = $key2->Frg;
                $valor++;

                foreach ($baseSubrogacionDeglosada_ as $key) {

                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

                   
                    
                    if($radicado == 1){
                        $json[$i]['cumple'] = 'SI';
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($tiempo > $interval->format('%R%a') ){
                            $json[$i]['cumple'] = 'NO ASIGNADA EN TIEMPO';
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }
                           
                        }

                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   
                    $json[$i]['SAP'] = $key->SAP ;
                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    $fecha4 = NULL;
                    if(!is_null($key->Fecha_envio_Memorial)){
                        $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }

                    if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                        $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }


                    if(!is_null($key->radicacion)){
                        $fecha4 = explode(" ", $key->radicacion)[0];
                        $fecha4 = explode("-", $fecha4);
                        $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                    }




                    $json[$i]['envioMemorial'] = $fecha2  ;
                    $json[$i]['envioMemorialC'] = $fecha3 ;
                    $json[$i]['radicacion'] = $fecha4 ;
                    $i++;
                }

                foreach ($baseSubrogacionDeglosada as $key) {
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin);

                   
                    
                    if($radicado == 1){
                       $json[$i]['cumple'] = 'SI';
                    }else{
                        date_default_timezone_set('America/Bogota');
                        $fechaIngreso =  date("Y-m-d H:i:s");

                        $datetime1 = new DateTime($key->Fecha_envio_Memorial);
                        $datetime2 = new DateTime($fechaIngreso);
                        $interval = $datetime1->diff($datetime2);

                        if($dias > $interval->format('%R%a') ){
                            $json[$i]['cumple'] = 'NO ASIGNADA EN TIEMPO';
                        }else{
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin);
                            if($radicadoSt == 1){
                                $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }
                           
                        }
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    $nombre = substr($deudor, 0, 3);
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   
                    $json[$i]['SAP'] = $key->SAP ;
                    $fecha2 = NULL;
                    $fecha3 = NULL;
                    $fecha4 = NULL;
                    if(!is_null($key->Fecha_envio_Memorial)){
                        $fecha2 = explode(" ", $key->Fecha_envio_Memorial)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }

                    if(!is_null($key->Fecha_envio_Memorial_Corregido)){
                        $fecha3 = explode(" ", $key->Fecha_envio_Memorial_Corregido)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }


                    if(!is_null($key->radicacion)){
                        $fecha4 = explode(" ", $key->radicacion)[0];
                        $fecha4 = explode("-", $fecha4);
                        $fecha4 = $fecha4[2]."/".$fecha4[1]."/".$fecha4[0];
                    }




                    $json[$i]['envioMemorial'] = $fecha2  ;
                    $json[$i]['envioMemorialC'] = $fecha3 ;
                    $json[$i]['radicacion'] = $fecha4 ;
                    /*$json[$i]['contrato'] = $key->contrato ;*/
                    $i++;
                }



            }
           

            $datos  = array(    'datos' => $frg, 
                                'otrosDatos' => $frg,
                                'datos2' => $frg,
                                'contratos' => $json,
                                'meta' =>  $reporteDatos->row()->par_meta,
                                'tiempo' =>  $reporteDatos->row()->par_tiempo_asignacion
                              );
            $this->load->view('Reportes/radicacion_memoriales_subrogaciones_datos_total_excell', $datos);
        }
    }

}
?>