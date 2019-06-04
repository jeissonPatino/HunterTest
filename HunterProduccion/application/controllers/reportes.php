<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Reportes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
        $this->load->model("Reportes_Model");
        $this->load->model("Obligaciones_Model");
        $this->load->model("extrajudicial_model");
        $this->load->model("carterafng_model");
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
                $consulta .= "sum(iif(LISOPC_Nombre____b = '".$buscarPor."',1,0)) as ".$labelSeries1.", ";
                $consulta .= "sum(iif(LISOPC_Nombre____b <> '".$buscarPor."',1,0)) as ".$labelSeries2;
                $from = "G".$aplicacion;
                $join = " LISOPC"; 
                $cosojoin = " G".$aplicacion."_C".$analisis." = LISOPC_ConsInte__b ";
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
                $consulta =  "DISTINCT LISOPC_ConsInte__b as valor1, LISOPC_Nombre____b as valor2";
                $from  = "G".$aplicacion;
                $join  = "LISOPC";
                $cosojoin = "G".$aplicacion."_C".$analisis." = LISOPC_ConsInte__b";
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
                
                /*Cambio Daniel Salgado Requerimiento 4 se paso a el modelo la query quemada*/
                $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte1');
    
                $frgss = $this->Reportes_Model->getFrgById($frg);
            
               
                $json = array();
                $i= 0;
                $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
                $nuevo = 0;
                $viejo = 0;
                $Nasignadas=0;

                $aTiempoCont = 0;
                $aDesiempoCont = 0;
                $noasignadasEntiempoCont = 0;
                $noasignadasNotiempoCont = 0; 

                foreach ($resultados as $key) {
                    $aTiempo = 'No asignada';
                    $tiempoPasado  = 0;
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo){
                        if($key->G719_C17051 != NULL){
                            //$asignadas++;
                            //valido que no se halla devuelto el memorial de subrogacion
                            if($key->G719_C17050 != NULL){
                                $datetime1 = new DateTime($key->G719_C17050);
                                $datetime2 = new DateTime($key->G719_C17051);

                                $interval = $datetime1->diff($datetime2);
                                $tiempoPasado  = $interval->format('%R%a');
                                if($tiempo >= $interval->format('%R%a')){
                                    $aTiempo = 'Asignada a tiempo';
                                    $aTiempoCont++;
                                }else{
                                    $aTiempo = 'Asignada fuera de tiempo';
                                    $aDesiempoCont++;
                                }
                                
                            }else{
                                $datetime1 = new DateTime($key->G719_C17048);
                                $datetime2 = new DateTime($key->G719_C17051);
                                $interval = $datetime1->diff($datetime2);
                                $tiempoPasado  = $interval->format('%R%a');
                                if($tiempo >= $interval->format('%R%a')){
                                    $aTiempo = 'Asignada a tiempo';
                                    $aTiempoCont++;
                                }else{
                                    $aTiempo = 'Asignada fuera de tiempo';
                                    $aDesiempoCont++;
                                }
                               
                            }
                        }else{

                            $Nasignadas++;
                            date_default_timezone_set('America/Bogota');
                            $fechaIngreso =  date("Y-m-d H:i:s");
                            $datetime1 = new DateTime($key->G719_C17048);
                            $datetime2 = new DateTime($fechaIngreso);
                            $interval = $datetime1->diff($datetime2);
                        
                            if($tiempo > $interval->format('%R%a')){
                                $aTiempo = 'No asignada en tiempo';
                                $noasignadasEntiempoCont++;
                                
                            }else{
                                $aTiempo = 'No asignada fuera de tiempo';
                                $noasignadasNotiempoCont++; 
                            }
                            if($tiempo > $interval->format('%R%a')){
                            $aTiempo = 'No asignada en tiempo';
                        }else{
                            $aTiempo = 'No asignada fuera de tiempo';
                        }
                            
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        

                        $fecha1 = null;
                        $fecha3 = null;
                        $fecha2 = null;
                        
                        if(!is_null($key->G719_C17051)){
                            $fecha1 = explode(" ", $key->G719_C17051)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                        }
                        
                        if(!is_null($key->G719_C17048)){
                            $fecha2 = explode(" ", $key->G719_C17048)[0];
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
                       $json[$i]['nombre'] = $deudor ;
                       $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                       $json[$i]['identificacion'] = $key->identificacion;
                        
                       $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                       $json[$i]['Fasignacion'] = $fecha1;
                       $json[$i]['Fenvio'] = $fecha2;
                       $json[$i]['Fcorreccion'] = $fecha3;
                       $json[$i]['Tiempos'] = $aTiempo;
                       $json[$i]['tiempoTrans'] = $tiempoPasado;
                       $i++;
                    }

                    $viejo = $nuevo;
                    
                }

                $datos = array( 'total'=> count($json), 
                                'aTiempo'=> $aTiempoCont, 
                                'aDesiempo'=> $aDesiempoCont, 
                                'noasignadasEntiempo'=> $noasignadasEntiempoCont, 
                                'noasignadasNotiempo'=> $noasignadasNotiempoCont, 
                                'Contratos' => json_encode($json),
                                'meta' => $reporteDatos->row()->par_meta ,
                                'tiempo' => $reporteDatos->row()->par_tiempo_asignacion,
                                'frg' => $frgss);
                $this->load->view('Reportes/asignacion_abogados_datos', $datos);
            }else{
                //aqui es cuando no mandan el FRg si no que quieren ver todo el reporte
                //obtenemos los Frgs
                $frgs = $this->Configuraciones_Model->getFrgs();
                $labels = array();
                $frg = array();
                $valor = 0;
                $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte1');
                
                $resultados = $this->Reportes_Model->getReportesAsignacion_abogados_deglosado( $frg , $abogados, $fechaInicial, $fechaFinal);
                $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
                
                foreach ($frgs as $key2) {
                    //luego prgintamos por las obligaciones de esos Frgs
                    $resultado = $this->Reportes_Model->getReportesAsignacion_abogados( $key2->G729_ConsInte__b , NULL, $fechaInicial, $fechaFinal);
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
                    $nuevo = 0;
                    $viejo = 0;

                    foreach ($resultado as $key) {
                       
                        $nuevo = $key->G719_C17423;

                        if($nuevo != $viejo){
                            $total++;
                            if($key->G719_C17051 != NULL){
                                $asignadas++;
                                //valido que no se halla devuelto el memorial de subrogacion
                                if($key->G719_C17050 != NULL){
                                    $datetime1 = new DateTime($key->G719_C17050);
                                    $datetime2 = new DateTime($key->G719_C17051);
                                    $interval = $datetime1->diff($datetime2);
                                    if($tiempo >= $interval->format('%R%a')){
                                        $aTiempo++;
                                    }else{
                                        $aDesiempo++;
                                    }
                                    
                                }else{
                                    $datetime1 = new DateTime($key->G719_C17048);
                                    $datetime2 = new DateTime($key->G719_C17051);
                                    $interval = $datetime1->diff($datetime2);
                                    if($tiempo >= $interval->format('%R%a')){
                                        $aTiempo++;
                                    }else{
                                        $aDesiempo++;
                                    }
                                    
                                }
                            }else{
                                $Nasignadas++;
                                date_default_timezone_set('America/Bogota');
                                $fechaIngreso =  date("Y-m-d H:i:s");

                                $datetime1 = new DateTime($key->G719_C17048);
                                $datetime2 = new DateTime($fechaIngreso);
                                $interval = $datetime1->diff($datetime2);
                                if($tiempo > $interval->format('%R%a')){
                                    $noasignadasEntiempo++;
                                }else{
                                    $noasignadasNotiempo++;
                                }
                                
                            }
                        }
                        $viejo = $nuevo;
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
                $nuevo = 0;
                $viejo = 0;

                foreach ($resultados as $key) {
                    $aTiempo = 'No asignada';
                    $tiempoPasado  = 0;
                    
                    $nuevo = $key->contrato;

                    if($nuevo != $viejo){
                        if($key->G719_C17051 != NULL){
                            //$asignadas++;
                            //valido que no se halla devuelto el memorial de subrogacion
                            if($key->G719_C17050 != NULL){
                                $datetime1 = new DateTime($key->G719_C17050);
                                $datetime2 = new DateTime($key->G719_C17051);

                                $interval = $datetime1->diff($datetime2);
                                $tiempoPasado  = $interval->format('%R%a');
                                if($tiempo > $interval->format('%R%a')){
                                    $aTiempo = 'Asignada a tiempo';
                                }else{
                                    $aTiempo = 'Asignada fuera de tiempo';
                                }
                                
                            }else{
                                $datetime1 = new DateTime($key->G719_C17048);
                                $datetime2 = new DateTime($key->G719_C17051);
                                $interval = $datetime1->diff($datetime2);
                                $tiempoPasado  = $interval->format('%R%a');
                                if($tiempo > $interval->format('%R%a')){
                                    $aTiempo = 'Asignada a tiempo';
                                }else{
                                    $aTiempo = 'Asignada fuera de tiempo';
                                }
                               
                            }
                        }else{
                            $Nasignadas++; 
                            date_default_timezone_set('America/Bogota');
                            $fechaIngreso =  date("Y-m-d H:i:s");

                            $datetime1 = new DateTime($key->G719_C17048);
                            $datetime2 = new DateTime($fechaIngreso);
                            $interval = $datetime1->diff($datetime2);
                        
                            if($tiempo > $interval->format('%R%a')){
                                $aTiempo = 'No asignada en tiempo';
                            }else{
                                $aTiempo = 'No asignada fuera de tiempo';
                            }
                            
                        }
                            

                        $deudor = trim(utf8_encode($key->nombre));
                        

                        $fecha1 = null;
                        $fecha3 = null;
                        $fecha2 = null;
                        
                        if(!is_null($key->G719_C17051)){
                            $fecha1 = explode(" ", $key->G719_C17051)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                        }
                        
                        if(!is_null($key->G719_C17048)){
                            $fecha2 = explode(" ", $key->G719_C17048)[0];
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
                        $json[$i]['nombre'] = $deudor ;
                         $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['identificacion'] = $key->identificacion;
                         
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $json[$i]['Fasignacion'] = $fecha1;
                        $json[$i]['Fenvio'] = $fecha2;
                        $json[$i]['Fcorreccion'] = $fecha3;
                        $json[$i]['Tiempos'] = $aTiempo;
                        $json[$i]['tiempoTrans'] = $tiempoPasado;
                        $i++;
                    }
                    
                    $viejo = $nuevo;
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
                    /*Cambio Daniel Salgado Requerimiento 4 se paso a el modelo la query quemada*/
                    $frgNombre = $this->Reportes_Model->getFrgById($frg);
                }
               
               /*Cambio Daniel Salgado Requerimiento 4 se paso a el modelo la query quemada*/
                $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte1');
         
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
                    $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte1');
                    
                    $resultados = $this->Reportes_Model->getReportesAsignacion_abogados_deglosado( $frg , $abogados, $fechaInicial, $fechaFinal);
                    $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
                    
                    foreach ($frgs as $key2) {
                        //luego prgintamos por las obligaciones de esos Frgs
                        $resultado = $this->Reportes_Model->getReportesAsignacion_abogados( $key2->G729_ConsInte__b , NULL, $fechaInicial, $fechaFinal);
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
                        $nuevo = 0;
                        $viejo = 0;
                        
                        foreach ($resultado as $key) {
                           $nuevo = $key->G719_C17423;

                            if($nuevo != $viejo){
                                $total++;
                                //pregunto que hallla sido asignado el abogado
                                if($key->G719_C17051 != NULL){
                                    $asignadas++;
                                    //valido que no se halla devuelto el memorial de subrogacion
                                    if($key->G719_C17050 != NULL){
                                        $datetime1 = new DateTime($key->G719_C17050);
                                        $datetime2 = new DateTime($key->G719_C17051);
                                        $interval = $datetime1->diff($datetime2);
                                        if($tiempo >= $interval->format('%R%a')){
                                            $aTiempo++;
                                        }else{
                                            $aDesiempo++;
                                        }
                                        
                                    }else{
                                        $datetime1 = new DateTime($key->G719_C17048);
                                        $datetime2 = new DateTime($key->G719_C17051);
                                        $interval = $datetime1->diff($datetime2);
                                        if($tiempo >= $interval->format('%R%a')){
                                            $aTiempo++;
                                        }else{
                                            $aDesiempo++;
                                        }
                                        
                                    }
                                }else{
                                    $Nasignadas++;
                                    date_default_timezone_set('America/Bogota');
                                    $fechaIngreso =  date("Y-m-d H:i:s");

                                    $datetime1 = new DateTime($key->G719_C17048);
                                    $datetime2 = new DateTime($fechaIngreso);
                                    $interval = $datetime1->diff($datetime2);
                                    if($tiempo > $interval->format('%R%a')){
                                        $noasignadasEntiempo++;
                                    }else{
                                        $noasignadasNotiempo++;
                                    }
                                    
                                }
                            }
                            $viejo = $nuevo;
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
        set_time_limit(1200);
        
        // echo 'Fecha elegida => '.$fechaBusqueda.'</br>';
        $fechaFinMesConsulta = date ( 'Y-m-d H:i:s' ,(strtotime ( '-1 minute' , strtotime ( $fechaBusqueda ) )));
        
        //le resto el mes inmediatamente anterior
        $fechamesAnterior = strtotime ( '-1 month' , strtotime ( $fechaBusqueda ) ) ;
        $nuevafecha = date ( 'Y-m-d H:i:s' , $fechamesAnterior );
        //echo 'Fecha Para pago abono => '.$nuevafecha.'</br>';

        $fechadiaFinmesAnterior = strtotime ( '-1 minute' , strtotime ( $fechaBusqueda ) ) ;
        $nuevafechaDiaFin = date ( 'Y-m-d H:i:s' , $fechadiaFinmesAnterior );
        //echo 'Fecha Para pago abono Final => '.$nuevafechaDiaFin.'</br>';


        //Le resto para buscar el pago de la garantia
        $fechamesGarantia = strtotime ( '-2 month' , strtotime ( $fechaBusqueda ) ) ;
        $fechaGarantia = date ( 'Y-m-d H:i:s' , $fechamesGarantia );
        //echo 'Fecha Para Garantia => '.$fechaGarantia.'</br>';

        $fechamesGarantiaFinal = strtotime ( '-1 minute' , strtotime ( $nuevafecha ) ) ;

        $fechaGarantiaFinal = date ( 'Y-m-d H:i:s' , $fechamesGarantiaFinal );
        // echo 'Fecha Para Garantia FInal busqueda => '.$fechaGarantiaFinal.'</br>';
        //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
        $this->db->select('par_meta');
        $this->db->from('Parametros_reportes');
        $this->db->join('Reportes', 'par_rep_id = rep_id');
        $this->db->where('rep_orden', 'reporte2');
        $ConfiguracionReporteDatosExt = $this->db->get();
        
        $CantidadGestionesExtraMens = 0;
        $CantidadGestionesExtraMens = $ConfiguracionReporteDatosExt->row()->par_meta;
        //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual            
        
        
        if( $frg != NULL && $frg != '' && $frg != 0){
           
            if($frg[0] == 0){

                $frgs = $this->Configuraciones_Model->getFrgs();
               
                $frg = array();
                          $i= 0;
                foreach ($frgs as $key2) {
                     $frg[$i]=$key2->G729_ConsInte__b;
                     $i++;
                }
            }

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
               
                $gestion = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0($frg[$j], $fechaGarantia, $fechaFinMesConsulta, $nuevafecha, $nuevafechaDiaFin );
                $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1($frg[$j], $fechaGarantia, $fechaFinMesConsulta);
                $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0_Total($frg[$j], $fechaGarantia, $fechaFinMesConsulta, $nuevafecha, $nuevafechaDiaFin );
                $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1_Total($frg[$j], $fechaGarantia, $fechaFinMesConsulta);
                $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_0($frg[$j], $fechaGarantia, $fechaFinMesConsulta, $nuevafecha, $nuevafechaDiaFin);
               // 
                $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_1($frg[$j], $fechaGarantia, $fechaFinMesConsulta);
                $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg[$j]));

                $array0= array();
                $nuevo = 0;
                $viejo = 0;
                foreach ($gestion_deglosado as $key) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo){
                        $array0[$i]=$nuevo;
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions >= $CantidadGestionesExtraMens){
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            $cumplimiento++;
                        }else{
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");                                
                            $incumpliemiento++;
                        }

                        //echo 'Aja';
                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                         $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }
                    $viejo = $nuevo;
                }

                $nuevo = 0;
                $viejo = 0;
                foreach ($gestion_deglosado_1 as $key) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo && array_search($key->contrato, $array0) == false){
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions >= $CantidadGestionesExtraMens){
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            $cumplimiento++;
                        }else{
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            $incumpliemiento++;
                        }
                        
                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }
                    $viejo = $nuevo;
                }

                $gestion1[$j] = $gestion;
                $gestion2[$j] = $gestion_0;
                $nombreFrgs[$j] = $frgss->row()->G729_C17121;
                $data1[$j] = $cumplimiento;
                $data2[$j] = $incumpliemiento;
                $data3[$j] = $totalBaseMedicion;
                //echo 'Este es el valor' . $j;
            }
           
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
            
            

        }else{
            //esto es por si mandan un FRG vacio
            $frgs = $this->Configuraciones_Model->getFrgs();
            $labels = array();
            $frg = array();
            $valor = 0;
            $json = array();
            $i= 0;
            foreach ($frgs as $key2) {
                
                $frgNull = $key2->G729_ConsInte__b;
                $gestion = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0($frgNull, $fechaGarantia, $fechaFinMesConsulta, $nuevafecha, $nuevafechaDiaFin );
                $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1($frgNull, $fechaGarantia, $fechaFinMesConsulta);
                $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0_Total($frgNull, $fechaGarantia, $fechaFinMesConsulta, $nuevafecha, $nuevafechaDiaFin );
                $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1_Total($frgNull, $fechaGarantia, $fechaFinMesConsulta);
                $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_0($frgNull,  $fechaGarantia, $fechaFinMesConsulta, $nuevafecha, $nuevafechaDiaFin);     
                $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_1($frgNull, $fechaGarantia, $fechaFinMesConsulta);
                $cumplimiento = 0;
                $Nocumplen = 0;
                $totalBaseMedicion = 0;


                $nuevo = 0;
                $viejo = 0;
                foreach ($gestion as $key ) {
                    $nuevo = $key->G719_C17423;
                    if($nuevo != $viejo){
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions >= $CantidadGestionesExtraMens){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }
                    }
                    $viejo = $nuevo;

                }


                $array0= array();
                $nuevo = 0;
                $viejo = 0;
                foreach ($gestion_deglosado as $key) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo){
                        $array0[$i]=$nuevo;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions >= $CantidadGestionesExtraMens){
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                        }else{
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                         $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }
                    $viejo = $nuevo;
                }


                $nuevo = 0;
                $viejo = 0;
                foreach ($gestion_0 as $key ) {
                    $nuevo = $key->G719_C17423;
                    if($nuevo != $viejo){
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions >= $CantidadGestionesExtraMens ){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }
                    }
                    $viejo = $nuevo;
                }

 
                $nuevo = 0;
                $viejo = 0;               
                foreach ($gestion_deglosado_1 as $key) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo && array_search($key->contrato, $array0) == false){
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions >= $CantidadGestionesExtraMens ){
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                        }else{
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                        }
                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++; 
                    } 
                    $viejo = $nuevo; 
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
               
            
            $fechaInicial = $fechaInicial;
            $fechaBusqueda = '01-'.$fechaInicial;
            set_time_limit(1200);
          

            //le resto el mes inmediatamente anterior
            $fechamesAnterior = strtotime ( '-1 month' , strtotime ( $fechaBusqueda ) ) ;
            $nuevafecha = date ( 'Y-m-d H:i:s' , $fechamesAnterior );
            //echo 'Fecha Para pago abono => '.$nuevafecha.'</br>';

            $fechadiaFinmesAnterior = strtotime ( '-1 minute' , strtotime ( $fechaBusqueda ) ) ;
            $nuevafechaDiaFin = date ( 'Y-m-d H:i:s' , $fechadiaFinmesAnterior );
            //echo 'Fecha Para pago abono Final => '.$nuevafechaDiaFin.'</br>';


            //Le resto para buscar el pago de la garantia
            $fechamesGarantia = strtotime ( '-2 month' , strtotime ( $fechaBusqueda ) ) ;
            $fechaGarantia = date ( 'Y-m-d H:i:s' , $fechamesGarantia );
            //echo 'Fecha Para Garantia => '.$fechaGarantia.'</br>';

            $fechamesGarantiaFinal = strtotime ( '-1 minute' , strtotime ( $nuevafecha ) ) ;
            $fechaGarantiaFinal = date ( 'Y-m-d H:i:s' ,(strtotime ( '-1 minute' , strtotime ( $fechaBusqueda ) )));
        // echo 'Fecha Para Garantia FInal busqueda => '.$fechaGarantiaFinal.'</br>';
        //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual

            //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
            $this->db->select('par_meta');
            $this->db->from('Parametros_reportes');
            $this->db->join('Reportes', 'par_rep_id = rep_id');
            $this->db->where('rep_orden', 'reporte2');
            $ConfiguracionReporteDatosExt = $this->db->get();
            
            $CantidadGestionesExtraMens = 0;
            $CantidadGestionesExtraMens = $ConfiguracionReporteDatosExt->row()->par_meta;
            //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual            
            
            if( $frg != NULL && $frg != '' && $frg != 0){

                $gestion = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0($frg, $fechaGarantia, $fechaGarantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1($frg, $fechaGarantia, $fechaGarantiaFinal);

                $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0_Total($frg, $fechaGarantia, $fechaGarantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1_Total($frg, $fechaGarantia, $fechaGarantiaFinal);

                $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_0($frg, $fechaGarantia, $fechaGarantiaFinal, $nuevafecha, $nuevafechaDiaFin);
                $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_1($frg, $fechaGarantia, $fechaGarantiaFinal);

                $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));
                $json = array();
                $i= 0;

                $nuevo = 0;
                $viejo = 0;
                $cumplimiento = 0;
                $Nocumplen = 0;
                $totalBaseMedicion = 0;
                
                $array0= array();
                $nuevo = 0;
                $viejo = 0;
                foreach ($gestion_deglosado as $key) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo){
                        $array0[$i]=$nuevo;
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions  >= $CantidadGestionesExtraMens ){
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            $cumplimiento++;
                        }else{
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                             $Nocumplen++;
                        }
                        //echo 'Aja';
                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                         $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }
                    $viejo = $nuevo;
                }
                $nuevo = 0;
                $viejo = 0;
                foreach ($gestion_deglosado_1 as $key) {
                    //echo 'eje';
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo and array_search($nuevo, $array0)==false){
                        $totalBaseMedicion++;
                        $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                        //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                        if($gestions >= $CantidadGestionesExtraMens ){
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            $cumplimiento++;
                        }else{
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            $Nocumplen++;
                        }
                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $i++;
                    }
                    $viejo = $nuevo;
                }

                $datos = array( 'gestiones' => $gestion ,
                            'gestiones_1' => $gestion_0 ,
                            'gestiones_deglosado' => $json,
                            'total' => $totalGestiones ,
                            'fechaInicial' => $nuevafecha,
                            'fecchFinal' =>  $nuevafechaDiaFin,
                            'frg' => $frgss->row()->G729_C17121,
                            'totalBase' => $totalBaseMedicion,
                            'totalCumplimiento' =>  $cumplimiento,
                            'totalNocumplen' => $Nocumplen);
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
                    
                    $frgNull = $key2->G729_ConsInte__b;
                    $gestion = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0($frgNull, $fechaGarantia, $fechaGarantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $gestion_0 = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1($frgNull, $fechaGarantia, $fechaGarantiaFinal);
                    $totalGestiones = $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_0_Total($frgNull, $fechaGarantia, $fechaGarantiaFinal, $nuevafecha, $nuevafechaDiaFin );
                    $totalGestiones += $this->Reportes_Model->getGestion_extrajudicial_mensual_Saldo_1_Total($frgNull, $fechaGarantia, $fechaGarantiaFinal);
                    $gestion_deglosado = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_0($frgNull,  $fechaGarantia, $fechaGarantiaFinal, $nuevafecha, $nuevafechaDiaFin);     
                    $gestion_deglosado_1 = $this->Reportes_Model->getGestion_extrajudicial_mensual_deglosado_1($frgNull, $fechaGarantia, $fechaGarantiaFinal);
                    $cumplimiento = 0;
                    $Nocumplen = 0;
                    $totalBaseMedicion = 0;

                   
                    $array0= array();
                    $nuevo = 0;
                    $viejo = 0;
                    foreach ($gestion_deglosado as $key) {
                        $nuevo = $key->contrato;
                        if($nuevo != $viejo){
                        $array0[$i]=$nuevo;
                            $totalBaseMedicion++;
                            $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                            //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                            if($gestions >= $CantidadGestionesExtraMens){
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                                $cumplimiento++;
                            }else{
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                                $Nocumplen++;
                            }

                            $deudor = trim(utf8_encode($key->nombre));
                            
                            $json[$i]['contrato'] = $key->contrato ;
                            $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                            $json[$i]['nombre'] = $deudor ;
                            $json[$i]['identificacion'] = $key->identificacion;
                            $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                            $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                            $i++;
                        }
                        $viejo = $nuevo;
                    }

               
                    $nuevo = 0;
                    $viejo = 0;
                    foreach ($gestion_deglosado_1 as $key) {
                        $nuevo = $key->contrato;
                        if($nuevo != $viejo and array_search($nuevo, $array0)== false){
                            $gestions = $this->Reportes_Model->tieneGestionExtrajudicial($key->G719_ConsInte__b, $nuevafecha, $nuevafechaDiaFin);
                             $totalBaseMedicion++;
                             //Manuel Ochoa - Softtek - 19/11/2015 - $CantidadGestionesExtraMens - Configuracion INFORMES FRG - Gestión Extrajudicial Mensual
                            if($gestions >= $CantidadGestionesExtraMens){
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                                 $cumplimiento++;
                            }else{
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                                  $Nocumplen++;
                            }
                            $deudor = trim(utf8_encode($key->nombre));
                            
                            $json[$i]['contrato'] = $key->contrato ;
                            $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                            $json[$i]['nombre'] =$deudor ;
                            $json[$i]['identificacion'] = $key->identificacion;
                            $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                            $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                            $i++;
                        }
                        $viejo = $nuevo;
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
        $fechaFinal = $_POST['fechafinal'].' 23:59:00';

        if( $frg != NULL && $frg != '' && $frg != 0){
            /*$this->db->select('COUNT(*) as cantidad');
            $this->db->from('Tabla_base_medicion_subrogaciones');
            $this->db->where('Sub_Frg', $frg);*/
            $totalBaseMedicion = $this->Reportes_Model->getBaseSubrogacionesEfectivas($frg);
            
            $gestion = $this->Reportes_Model->getSubrogacionesEfectivas($frg, $fechaInicial, $fechaFinal);
            $gestion_deglosado = $this->Reportes_Model->getReporteSubrogacionesEfectivasDeglosado($frg, $fechaInicial, $fechaFinal);

            $gestionDeglosadoGeneral = $this->Reportes_Model->getReporteSubrogacionesEfectivasGeneral($frg);
            $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));
            $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte3');
            $json = array();
            $i= 0;
            $nuevo = 0;
            $viejo = 0;
            $total = 0;
            foreach ($gestion_deglosado as $key) {
                $nuevo = $key->contrato;
                if($nuevo != $viejo){
                    $total++;
                }
                 $viejo = $nuevo;
            }
            $nuevo = 0;
            $viejo = 0;
            foreach ($gestionDeglosadoGeneral as $key) {

                $nuevo = $key->contrato;
                if($nuevo != $viejo){
                    
                    $deudor = trim(utf8_encode($key->nombre));
                    
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] =$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                     $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                $viejo = $nuevo;
                
            }

            $datos = array( 'gestiones' => $gestion ,
                            'gestiones_deglosado' => json_encode($json),
                            'meta' => $reporteDatos->row()->cant_obligaciones ,
                            'frg' => $frgss->row()->G729_C17121,
                            'total' => $total,
                            'totalBase' =>  $totalBaseMedicion->row()->cantidad);
            $this->load->view('Reportes/subrogaciones_efectivas_datos', $datos);
        }else{

            $frgs = $this->Configuraciones_Model->getFrgs();
            $datoss = array();
            $valor = 0;
            $json = array();
            $i= 0;
            foreach ($frgs as $key2) {
                
                $totalBaseMedicion = $this->Reportes_Model->getBaseSubrogacionesEfectivas($key2->G729_ConsInte__b);

                $gestion = $this->Reportes_Model->getSubrogacionesEfectivas($key2->G729_ConsInte__b, $fechaInicial, $fechaFinal);
                $total = 0;
            
                $gestion_deglosado = $this->Reportes_Model->getReporteSubrogacionesEfectivasDeglosado($key2->G729_ConsInte__b, $fechaInicial, $fechaFinal);
                $gestionDeglosadoGeneral = $this->Reportes_Model->getReporteSubrogacionesEfectivasGeneral($key2->G729_ConsInte__b);

                $viejo = 0;
                $nuevo = 0;
                foreach ($gestion_deglosado as $key ) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo)$total++;
                    $viejo = $nuevo;
                }
                foreach ($gestionDeglosadoGeneral as $key) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo){
                        //$total++;
                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] =$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                    $viejo = $nuevo;
                }
                $datoss[$valor]['total'] = $total;
                $datoss[$valor]['Frg'] = $key2->Frg;
                $datoss[$valor]['totalBase'] =  $totalBaseMedicion->row()->cantidad;
                $valor++;
            }


            
            $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));
            $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte3');
            $datos = array( 'datos' => $datoss ,
                            'totales' => $total,
                            'gestiones_deglosado' => json_encode($json),
                            'meta' => $reporteDatos->row()->cant_obligaciones);
            $this->load->view('Reportes/subrogaciones_efectivas_datos_total', $datos);
        }
    }

    function getSubrogaciones_efectivas_exportar($frg = NULL, $fechaInicial, $fechaFinal){
        

        if( $frg != NULL && $frg != '' && $frg != 0){
           
            $gestion = $this->Reportes_Model->getSubrogacionesEfectivas($frg, $fechaInicial, $fechaFinal.' 23:59:00');
            $gestion_deglosado = $this->Reportes_Model->getReporteSubrogacionesEfectivasDeglosado($frg, $fechaInicial, $fechaFinal.' 23:59:00');
            $gestionDeglosadoGeneral = $this->Reportes_Model->getReporteSubrogacionesEfectivasGeneral($frg);
            $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));
            $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte3');

            $datos = array( 'gestiones' => $gestion ,
                            'gestiones_deglosado' => $gestion_deglosado,
                            'gestiones_deglosado_general' => $gestionDeglosadoGeneral,
                            'meta' => $reporteDatos->row()->cant_obligaciones ,
                            'frg' => $frgss->row()->G729_C17121);
            $this->load->view('Reportes/subrogaciones_efectivas_datos_exportar', $datos);
        }else{
            $frgs = $this->Configuraciones_Model->getFrgs();
            $datoss = array();
            $valor = 0;
            $json = array();
            $i= 0;
            foreach ($frgs as $key2) {
                $labels[$valor] = $key2->Frg;
                $gestion = $this->Reportes_Model->getSubrogacionesEfectivas($key2->G729_ConsInte__b, $fechaInicial, $fechaFinal);
                $total = 0;
                /* foreach ($gestion as $key) {
                    $total++;
                }*/
                $totalBaseMedicion = $this->Reportes_Model->getBaseSubrogacionesEfectivas($key2->G729_ConsInte__b);
                $gestionDeglosadoGeneral = $this->Reportes_Model->getReporteSubrogacionesEfectivasGeneral($key2->G729_ConsInte__b);
                $gestion_deglosado = $this->Reportes_Model->getReporteSubrogacionesEfectivasDeglosado($key2->G729_ConsInte__b, $fechaInicial, $fechaFinal.' 23:59:00');
                $nuevo = 0;
                $viejo = 0;

                foreach ($gestion_deglosado as $key ) {
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo)$total++;
                    $viejo = $nuevo;
                }
                $nuevo = 0;
                $viejo = 0;
                foreach ($gestionDeglosadoGeneral as $key) {
                    $nuevo = $key->contrato ;
                    if($nuevo != $viejo){
                        //$total++;
                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                        $json[$i]['FRG'] = $key2->Frg;
                        
                        $i++;
                    }
                    $viejo = $nuevo;
                    
                }
                $datoss[$valor]['total'] = $total;
                $datoss[$valor]['Frg'] = $key2->Frg;
                $datoss[$valor]['totalBase'] =  $totalBaseMedicion->row()->cantidad;
                $valor++;

            }


            
            $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));
            $reporteDatos = $this->Reportes_Model->getParametrosReportes('reporte3');

            $datos = array('labels' => $labels,
                                    'datos' => $datoss,
                                    'others' => $datoss,
                                    'other' => $datoss,
                                    'Contratos' => $json,
                                    'meta' => $reporteDatos->row()->cant_obligaciones,
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
            set_time_limit(600);
            $frg = $_POST['frg'];
            $fechaInicial = $_POST['txtFechaInicial'];
            $fechaFinal = $_POST['txtFechaFinal'].' 23:59:00';
            //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES ABOGADOS - Gestión judicial
            $this->db->select('par_meta');
            $this->db->from('Parametros_reportes');
            $this->db->join('Reportes', 'par_rep_id = rep_id');
            $this->db->where('rep_orden', 'reporte7');
            $ConfiguracionReporteDatosExt = $this->db->get();
            
            $CantidadGestionesExtraMens = 0;
            $CantidadGestionesExtraMens = $ConfiguracionReporteDatosExt->row()->par_meta;
            //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES ABOGADOS - Gestión judicial                
            
            if( $frg != NULL && $frg != '' && $frg != 0){
                $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));
                $gestion = $this->Reportes_Model->getBaseGEstionesJudiciales($frg);
                $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($frg,$fechaInicial);
                $json = array();
                $i = 0;
                $cumplimiento = 0;
                $totalBaseMedicion = 0;
                $Nocumplen = 0;
                $nuevo = 0;
                $viejo = 0;
				$sapNuevo = 0 ;
                $sapviejo = 0 ;
                $arraySapCumple = array();
                $arraySapNoCumple = array();
                $arrayLiquidaciones = array();
                $j=1;
                foreach ($gestion_deglosado as $key) {
                    
                    if(!array_search($key->contrato, $arrayLiquidaciones)){
                        $totalBaseMedicion +=1;
                        $tienegestion = $this->Reportes_Model->tieneGestionJudicial($key->contrato, $fechaInicial, $fechaFinal);
                        if($tienegestion >= $CantidadGestionesExtraMens){

                            if (array_search($key->SAP,$arraySapCumple)== false){
                                $arraySapCumple[$cumplimiento+1] = $key->SAP;
                                $cumplimiento++;
                            }
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");                           
                        }else{
							if (array_search($key->SAP,$arraySapNoCumple)== false){
                                $arraySapNoCumple[$Nocumplen+1] = $key->SAP;
                                $Nocumplen++;

                            }
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");                            
                        }
                        //Manuel Ochoa - Softtek - 19/11/2015 - REQ02
                        //fecha_memorial_subroga
                        //fecha_informe
                        //fecha_gestion 
                        //frg
                        //nom_ejecutor
                        
                        $datosGestion = $this->Reportes_Model->getGestionJudicialDatos($key->contrato, $fechaInicial, $fechaFinal);
                        if (isset($datosGestion)) {
                            $nom_ejecutor = trim(utf8_encode($datosGestion->Ejecutor));
                            //$fecha_gestion = trim(utf8_encode($datosGestion->FechaTramite));
							$fecha_gestion = explode(" ", $datosGestion->FechaInforme)[0];
                        }else{
                            $nom_ejecutor = '';
                            $fecha_gestion = '';                        
                        }   
                        
                        $fecha_informe = date('m/d/Y');                         
                        
                        $fecha_memorial_subroga = '';
                        if(!is_null($key->G719_C17048)){
                            $fecha_memorial_subroga = explode(" ", $key->G719_C17048)[0];
                        }
                        
                        $json[$i]['fecha_memorial_subroga'] = $fecha_memorial_subroga;
						$json[$i]['fecha_informe'] = $fechaInicial;
                        $json[$i]['fecha_gestion'] = $fecha_gestion;
                        $json[$i]['frg'] = trim(utf8_encode($frgss->row()->G729_C17121));
                        $json[$i]['nom_ejecutor'] = $nom_ejecutor;                      

                        
                        
                        
                        $deudor = trim(utf8_encode($key->nombre));
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                         $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $json[$i]['SAP'] = $key->SAP ;

                        $fecha2 = NULL;
                        $fecha3 = NULL;
                        if(!is_null($key->fecha_abogado)){
                            $fecha2 = explode(" ", $key->fecha_abogado)[0];
                        }
                       


                        $json[$i]['fecha_abogado'] = $fecha2 ;
                        /*$json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['contrato'] = $key->contrato ;*/
                        $i++;
                    }
                     $arrayLiquidaciones[$j] = $key->contrato;
                     $j++;
                }

                $datos = array( 'getionBase' => $gestion , 
                                'basemedicion' => $totalBaseMedicion,
                                'cumplimiento' => $cumplimiento,
                                'incumpliemiento' => $Nocumplen,
                                'todaBase' => json_encode($json) , 
                                'fechaInicial' => $fechaInicial , 
                                'fechaFinal' => $fechaFinal,
                                'frg' => $frgss->row()->G729_C17121  );
                $this->load->view('Reportes/gestiones_judiciales_datos', $datos);
            }else{
                
                $frgs = $this->Configuraciones_Model->getFrgs();
                $datoss = array();
                $valor = 0;
                
				$frg = array();
                $json = array();
                $i = 0;
                foreach ($frgs as $key2) {
                    $cumplimiento = 0;
                    $totalBaseMedicion = 0;
                    $Nocumplen = 0;
                    
                    $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($key2->G729_ConsInte__b,$fechaInicial);
                   
                    $nuevo = 0;
                    $viejo = 0;
                    $arraySapCumple = array();
                    $arraySapNoCumple = array();
                    $arrayLiquidaciones = array();
                    $j=1;

                    foreach ($gestion_deglosado as $key) {
                        
                        if(!array_search($key->contrato, $arrayLiquidaciones)){

                            $totalBaseMedicion +=1;
                            $tienegestion = $this->Reportes_Model->tieneGestionJudicial($key->contrato, $fechaInicial, $fechaFinal);
                            if($tienegestion >= $CantidadGestionesExtraMens){
                                //$cumplimiento++;
                                if (array_search($key->SAP,$arraySapCumple)== false){
                                $arraySapCumple[$cumplimiento+1] = $key->SAP;
                                $cumplimiento++;
                                }
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            }else{
                                
                                if (array_search($key->SAP,$arraySapNoCumple)== false){
                                    $arraySapNoCumple[$Nocumplen+1] = $key->SAP;
                                    $Nocumplen++;

                                }
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");
                            }

                            //Manuel Ochoa - Softtek - 19/11/2015 - REQ02
                            //fecha_memorial_subroga
                            //fecha_informe
                            //fecha_gestion
                            //frg
                            //nom_ejecutor          

                            $datosGestion = $this->Reportes_Model->getGestionJudicialDatos($key->contrato, $fechaInicial, $fechaFinal);
                            if (isset($datosGestion)) {
                                $nom_ejecutor = trim(utf8_encode($datosGestion->Ejecutor));
                                $fecha_gestion = explode(" ", $datosGestion->FechaTramite)[0];
                            }else{
                                $nom_ejecutor = '';
                                $fecha_gestion = '';                        
                            }                   
                            
                            $fecha_informe = $fechaInicial;               
                                
                            $fecha_memorial_subroga = '';
                            if(!is_null($key->G719_C17048)){
                                $fecha_memorial_subroga = explode(" ", $key->G719_C17048)[0];
                            }                           
                            
                            $json[$i]['fecha_memorial_subroga'] = $fecha_memorial_subroga;
                            $json[$i]['fecha_informe'] = $fecha_informe;
                            $json[$i]['fecha_gestion'] = $fecha_gestion;
                            $json[$i]['frg'] = trim(utf8_encode( $key2->Frg ));
                            $json[$i]['nom_ejecutor'] = $nom_ejecutor;  
                        
                        
                        
                            $deudor = trim(utf8_encode($key->nombre));
                            $json[$i]['contrato'] = $key->contrato ;
                            $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                            $json[$i]['nombre'] = $deudor ;
                            $json[$i]['identificacion'] = $key->identificacion;
                            $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                            $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                            $json[$i]['SAP'] = $key->SAP ;
                            $fecha2 = NULL;
                            $fecha3 = NULL;
                            if(!is_null($key->fecha_abogado)){
                                $fecha2 = explode(" ", $key->fecha_abogado)[0];
                            }
                           


                            $json[$i]['fecha_abogado'] = $fecha2 ;
                            /*$json[$i]['contrato'] = $key->contrato ;
                            $json[$i]['contrato'] = $key->contrato ;*/
                            $i++;
                        }
                        $arrayLiquidaciones[$j] = $key->contrato;
                        $j++;
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
                $this->load->view('Reportes/gestion_judicial_datos_total', $datos);
            }
        }else{
            echo "No tienes permisos para esta operaci&oacute;n";
        }
        
    }

function getBaseMedicionJudicial_exportar($frg = NULL,$fechaInicial = NULL, $fechaFinal = NULL ){
        
        if($this->session->userdata('login_ok')){
            set_time_limit(600);
            //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES ABOGADOS - Gestión judicial
            $this->db->select('par_meta');
            $this->db->from('Parametros_reportes');
            $this->db->join('Reportes', 'par_rep_id = rep_id');
            $this->db->where('rep_orden', 'reporte7');
            $ConfiguracionReporteDatosExt = $this->db->get();
            
            $CantidadGestionesExtraMens = 0;
            $CantidadGestionesExtraMens = $ConfiguracionReporteDatosExt->row()->par_meta;
            //Manuel Ochoa - Softtek - 19/11/2015 - INI - Configuracion INFORMES ABOGADOS - Gestión judicial                
            
            if( $frg != NULL && $frg != '' && $frg != 0){
                $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));
                $gestion = $this->Reportes_Model->getBaseGEstionesJudiciales($frg);
                $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($frg,$fechaInicial);
                $json = array();
                $i = 0;
                $nuevo = 0;
                $viejo = 0;
                $arrayLiquidaciones = array();
                $j=1;
                foreach ($gestion_deglosado as $key) {
                    
                    if(!array_search($key->contrato, $arrayLiquidaciones)){
                        $deudor = trim(utf8_encode($key->nombre));
                       
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] =$deudor ;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                        
                        //Manuel Ochoa - Softtek - 19/11/2015 
                        $tienegestion = $this->Reportes_Model->tieneGestionJudicial($key->contrato, $fechaInicial, $fechaFinal);
                        if($tienegestion >= $CantidadGestionesExtraMens){
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");                                   
                        }else{
                            //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                            //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                            $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");                                    
                        }           

                        //Manuel Ochoa - Softtek - 19/11/2015 - REQ02
                        //fecha_memorial_subroga
                        //fecha_informe
                        //fecha_gestion
                        //frg
                        //nom_ejecutor
                        
                        $datosGestion = $this->Reportes_Model->getGestionJudicialDatos($key->contrato, $fechaInicial, $fechaFinal);
                        if (isset($datosGestion)) {
                            $nom_ejecutor = htmlentities(trim(utf8_encode($datosGestion->Ejecutor)), ENT_QUOTES, "UTF-8");
                            //$fecha_gestion = trim(utf8_encode($datosGestion->FechaTramite));
                            $fecha_gestion = explode(" ", $datosGestion->FechaTramite)[0];
                            $fecha_gestion = explode("-", $fecha_gestion);
                            $fecha_gestion = $fecha_gestion[2]."/".$fecha_gestion[1]."/".$fecha_gestion[0];                         
                        }else{
                            $nom_ejecutor = '';
                            $fecha_gestion = '';                        
                        }
                        
                        $fecha_informe = $fechaInicial;                 
                        
                        $fecha_memorial_subroga = '';
                        if(!is_null($key->G719_C17048)){
                            $fecha_memorial_subroga = explode(" ", $key->G719_C17048)[0];
                            $fecha_memorial_subroga = explode("-", $fecha_memorial_subroga);
                            $fecha_memorial_subroga = $fecha_memorial_subroga[2]."/".$fecha_memorial_subroga[1]."/".$fecha_memorial_subroga[0];
                        }                   
                        
                        $json[$i]['fecha_memorial_subroga'] = $fecha_memorial_subroga;
                        $json[$i]['fecha_informe'] = $fecha_informe;
                        $json[$i]['fecha_gestion'] = $fecha_gestion;
                        $json[$i]['frg'] = trim(utf8_encode($frgss->row()->G729_C17121));
                        $json[$i]['nom_ejecutor'] = $nom_ejecutor;                                              
                        $i++;
                    }
                    $arrayLiquidaciones[$j] = $key->contrato;
                    $j++;
                }

                
                $datos = array( 'gestionBase' => $gestion , 
                                'todaBase' => $json, 
                                'fechaInicial' => $fechaInicial , 
                                'fechaFinal' => $fechaFinal.' 23:59:00',
                                'frg' => $frgss->row()->G729_C17121  );
                $this->load->view('Reportes/gestiones_judiciales_datos_excel', $datos);

            }else{
                $frgs = $this->Configuraciones_Model->getFrgs();
                $datoss = array();
                $valor = 0;
                
                $frg = array();
                $json = array();
                $i = 0;
                foreach ($frgs as $key2) {
                    $cumplimiento = 1;
                    $totalBaseMedicion = 0;
                    $Nocumplen = 1;
                    
                    $gestion_deglosado = $this->Reportes_Model->getBaseGEstionesJudiciales_deglosado($key2->G729_ConsInte__b,$fechaInicial);
                   
                    $nuevo = 0;
                    $viejo = 0;
                    $arrayLiquidaciones = array();
                    $j=1;
                    
                    
                    foreach ($gestion_deglosado as $key) {
                        if(!array_search($key->contrato, $arrayLiquidaciones)){

                            $totalBaseMedicion +=1;
                            $tienegestion = $this->Reportes_Model->tieneGestionJudicial($key->contrato, $fechaInicial, $fechaFinal);
                            if($tienegestion >= $CantidadGestionesExtraMens){
                                //$cumplimiento++;
                              
                                $cumplimiento++;
                             
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('TIENE GESTIÓN', ENT_QUOTES, "UTF-8");                           
                            }else{
                                
                                $Nocumplen++;

                              
                                //Manuel Ochoa - Softtek - 19/11/2015 - Se utiliza htmlentities para darle tilde a la Ó
                                //$json[$i]['gestionado'] = 'NO TIENE GESTION';
                                $json[$i]['gestionado'] = htmlentities('NO TIENE GESTIÓN', ENT_QUOTES, "UTF-8");                            
                            }

                            //Manuel Ochoa - Softtek - 19/11/2015 - REQ02
                            //fecha_memorial_subroga
                            //fecha_informe
                            //fecha_gestion
                            //frg
                            //nom_ejecutor          

                            $datosGestion = $this->Reportes_Model->getGestionJudicialDatos($key->contrato, $fechaInicial, $fechaFinal);
                            if (isset($datosGestion)) {
                                $nom_ejecutor = trim(utf8_encode($datosGestion->Ejecutor));
                                $fecha_gestion = explode(" ", $datosGestion->FechaTramite)[0];
                                $fecha_gestion = explode("-", $fecha_gestion);
                                $fecha_gestion = $fecha_gestion[2]."/".$fecha_gestion[1]."/".$fecha_gestion[0];
                                                                 
                            }else{
                                $nom_ejecutor = '';
                                $fecha_gestion = '';                        
                            }                   
                            
                            $fecha_informe = $fechaInicial;               
                                
                            $fecha_memorial_subroga = '';
                            if(!is_null($key->G719_C17048)){
                                $fecha_memorial_subroga = explode(" ", $key->G719_C17048)[0];
                                $fecha_memorial_subroga = explode("-", $fecha_memorial_subroga);
                                $fecha_memorial_subroga = $fecha_memorial_subroga[2]."/".$fecha_memorial_subroga[1]."/".$fecha_memorial_subroga[0];
                            }                           
                            
                            $json[$i]['fecha_memorial_subroga'] = $fecha_memorial_subroga;
                            $json[$i]['fecha_informe'] = $fecha_informe;
                            $json[$i]['fecha_gestion'] = $fecha_gestion;
                            $json[$i]['frg'] = trim(utf8_encode( $key2->Frg ));
                            $json[$i]['nom_ejecutor'] = $nom_ejecutor;  
                        
                        
                        
                            $deudor = trim(utf8_encode($key->nombre));
                            
                            $json[$i]['contrato'] = $key->contrato ;
                            $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                            $json[$i]['nombre'] = $deudor ;
                            $json[$i]['identificacion'] = $key->identificacion;
                            $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                            $i++;
                        }
                        $arrayLiquidaciones[$j] = $key->contrato;
                        $j++;
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
                $this->load->view('Reportes/gestion_judicial_datos_total_excel', $datos);    
            }
                
            
        }else{
            echo "No tienes permisos para esta operaci&oacute;n";
        }
        
    }
//-------------------------------------------------------------------------------------------------
// Funcion Exportar Excel Clientes sin gestion mas de 15 dias.
function exportar_clientessingestion($filtroFecha){

   // $filtroFecha = replace($filtroFecha,"-","/");

    if($this->session->userdata('login_ok')){
        set_time_limit(600);

        $gestion_clientes = $this->extrajudicial_model->getClientesSingestionquincedias($filtroFecha);
        $data = array();
        $i = 0;    
        foreach ($gestion_clientes as $key) {
            $deudor = trim(utf8_encode($key->deudor));
            $data[$i]['deudor'] =$deudor ;
            $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
            $data[$i]['IDENTIFICACION'] = $key->identificacion ;
            $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
            $data[$i]['INTERMEDIARIO'] = utf8_encode($key->financiera) ;
            $data[$i]['OBLIGACION'] = $key->liquidacion ;
            $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
            $data[$i]['VALOR_PAGADO'] ="$".number_format($key->valor_pagado,  0, '.',',')  ;
            $data[$i]['ROL'] = utf8_encode($key->ROL) ;
            $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
            $i++;
        }
            //echo json_encode($data);
        $datos = array('data' => $data);
         $this->load->view('Reportes/Exportar_Clientes_sin_Gestion', $datos);
    }
}
//-------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------
// Funcion Exportar Excel Clientes sin gestion mas de 15 dias Gestion Judicial
function exportar_clientessingestionjudicial($filtroFecha){

   // $filtroFecha = replace($filtroFecha,"-","/");

    if($this->session->userdata('login_ok')){
        set_time_limit(600);

        $gestion_clientes = $this->carterafng_model->getClientesSingestionquincedias($filtroFecha);
        $data = array();
        $i = 0;    
        foreach ($gestion_clientes as $key) {
            $deudor = trim(utf8_encode($key->deudor));
            $data[$i]['deudor'] =$deudor ;
            $data[$i]['tipo_identificacion'] = $key->tipo_identificacion ;
            $data[$i]['IDENTIFICACION'] = $key->identificacion ;
            $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
            $data[$i]['INTERMEDIARIO'] = utf8_encode($key->financiera) ;
            $data[$i]['OBLIGACION'] = $key->liquidacion ;
            $data[$i]['PROCESO_SAP'] = $key->PROCESO_SAP ;
            $data[$i]['VALOR_PAGADO'] ="$".number_format($key->valor_pagado,  0, '.',',')  ;
            $data[$i]['ROL'] = utf8_encode($key->ROL) ;
            $data[$i]['CIUDAD_DOMICILIO'] = utf8_encode($key->CIUDAD_DOMICILIO);
            $i++;
        }
            //echo json_encode($data);
        $datos = array('data' => $data);
         $this->load->view('Reportes/Exportar_Clientes_sin_Gestion_Judicial', $datos);
    }
}
//-------------------------------------------------------------------------------------------
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
            $this->db->where('ven_id' ,$_POST['venta']);
            //$query = $this->db->get();
            $dat = $this->db->get();

            $fechaVEnta = $dat->row()->Ven_fecha_venta;
            $fechaNotificacion = $dat->row()->Ven_fecha_notificacion;
            $fechaFinal = $dat->row()->Ven_fecha_Maxima;
    
            if( $frg != NULL && $frg != '' && $frg != 0){
                
                
                $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));

                $base = $this->Reportes_Model->getReporteCisa($frg, $fechaVEnta);
                
                $cumplimiento = 0;
                $Nocumplen = 0;
                $totalBaseMedicion = 0;
                $nuevo = 0;
                $viejo = 0;
                foreach ($base as $keyBase) {
                    
                    $nuevo = $keyBase->liquidacion;
                    if($nuevo != $viejo){
                        $totalBaseMedicion++;
                        $soporte = $this->Reportes_Model->tieneFechaPagoReporte($keyBase->G719_ConsInte__b, $fechaNotificacion, $fechaFinal);
                        if($soporte >= 1){
                            $cumplimiento++;
                        }else{
                            $Nocumplen++;
                        }
                    }
                     $viejo = $nuevo;
                }

                $baseDeglosada2 = $this->Reportes_Model->getReporteCisa_deglosadoS($frg, $fechaVEnta);

                $json = array();
                $i = 0;
                $nuevo = 0;
                $viejo = 0;
                foreach($baseDeglosada2 as $key){
                
                $nuevo = $key->contrato;
                if($nuevo != $viejo){
                        $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->G719_ConsInte__b, $fechaNotificacion, $fechaFinal);
                        
                        if($soporte >= 1){
                           $json[$i]['cumple'] = 'SI';
                        }else{
                           $json[$i]['cumple'] = 'NO';
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] =$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $json[$i]['SAP'] = $key->SAP ;
                        $json[$i]['fechaVenta'] = $key->fechaVenta ;
                        $json[$i]['fechaNotificacion'] = $fechaNotificacion ;

                        $fecha2 = NULL;
                        $fecha3 = NULL;
                        if(!is_null($key->Fecha_recepcion_soporte)){
                            $fecha2 = explode(" ", $key->Fecha_recepcion_soporte)[0];
                            $fecha2 = explode("-", $fecha2);
                            $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                        }

                        if(!is_null($key->Fecha_aprobacion_soporte)){
                            $fecha3 = explode(" ", $key->Fecha_aprobacion_soporte)[0];
                            $fecha3 = explode("-", $fecha3);
                            $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                        }
                
                        $json[$i]['fecha_soprte'] = $fecha2 ;
                        $json[$i]['fecha_soprte_ap'] = $fecha3 ;

                        
                        $i++;
                    }
                    $viejo = $nuevo;
                }
                        

                $datos = array( 'cumplimiento' => $cumplimiento, 
                                'Nocumplen' => $Nocumplen, 
                                'totalBaseMedicion' => $totalBaseMedicion, 
                                'fechaVEnta' => $fechaVEnta,
                                'contratos' => json_encode($json),
                                'Ven_nombre' => $dat->row()->Ven_nombre,
                                'fechaInicial' => $fechaNotificacion , 
                                'fechaFinal' => $fechaFinal,
                                'frg' => $frgss->row()->G729_C17121);
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
                    

                    $base = $this->Reportes_Model->getReporteCisa($key2->G729_ConsInte__b, $fechaVEnta);
                   // var_dump($base);
                    if(count( $base) > 0){
                    $nuevo = 0;
                    $viejo = 0;
                    
                    foreach ($base as $key) {
                        $nuevo = $key->liquidacion;
                        if($nuevo != $viejo){
                            
                            $totalBaseMedicion++;
                            $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->G719_ConsInte__b, $fechaNotificacion, $fechaFinal.' 23:59:00');
                            if($soporte >= 1){
                                $cumplimiento++;
                            }else{
                                $Nocumplen++;
                            }
                        }
                        $viejo = $nuevo; 
                    }
                     
                }
                     

                    $frg[$valor]['Total'] = $totalBaseMedicion;
                    $frg[$valor]['cumplen'] = $cumplimiento;
                    $frg[$valor]['nocumplen'] = $Nocumplen;
                    $frg[$valor]['Frg'] = $key2->Frg;
                    $valor++;

                    $baseDeglosada2 = $this->Reportes_Model->getReporteCisa_deglosadoS($key2->G729_ConsInte__b, $fechaVEnta);


                    $nuevo = 0;
                    $viejo = 0;
                   
                   foreach($baseDeglosada2 as $key){
                    $nuevo = $key->contrato;
                    if($nuevo != $viejo){
                       
                       $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->G719_ConsInte__b, $fechaNotificacion, $fechaFinal);
                    
                        if($soporte >= 1){
                        $json[$i]['cumple'] = 'SI';
                        }else{
                        $json[$i]['cumple'] = 'NO';
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] =$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $json[$i]['SAP'] = $key->SAP ;
                        $json[$i]['fechaVenta'] = $key->fechaVenta ;
                        $json[$i]['fechaNotificacion'] = $fechaNotificacion ;

                        $fecha2 = NULL;
                        $fecha3 = NULL;
                        if(!is_null($key->Fecha_recepcion_soporte)){
                            $fecha2 = explode(" ", $key->Fecha_recepcion_soporte)[0];
                            $fecha2 = explode("-", $fecha2);
                            $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                        }

                        if(!is_null($key->Fecha_aprobacion_soporte)){
                            $fecha3 = explode(" ", $key->Fecha_aprobacion_soporte)[0];
                            $fecha3 = explode("-", $fecha3);
                            $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                        }


                        $json[$i]['fecha_soprte'] = $fecha2 ;
                        $json[$i]['fecha_soprte_ap'] = $fecha3 ;
                  
                        $i++;
                        }
                        $viejo = $nuevo;
                    }

                    
                }

               

                 $datos = array( 'datos' => $frg ,
                            'datos2' => $frg,
                            'Ven_nombre' => $dat->row()->Ven_nombre,
                            'fechaInicial' => $fechaNotificacion , 
                            'fechaFinal' => $fechaFinal,
                            'fechaVEnta' => $fechaVEnta,
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
                $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));


                
                $arreglo = $contratos = $getionBase = array();
                # -----------------------------------------------------------------
                $base = $this->Reportes_Model->getReporteCisa($frg, $fechaVEnta);
                foreach ($base as $key => $val) {
                    $arreglo[] = $val->liquidacion;
                }
                $resultado = array_unique($arreglo);
                foreach ($base as $key => $val) {
                    if (in_array($val->liquidacion, $resultado)) {
                        $clave = array_search($val->liquidacion, $resultado);
                        unset($resultado[$clave]);
                        $getionBase[] = $val;
                    }
                }
                # -----------------------------------------------------------------
                $baseDeglosada2 = $this->Reportes_Model->getReporteCisa_deglosadoS($frg, $fechaVEnta);
                foreach ($baseDeglosada2 as $key => $val) {
                    $arreglo[] = $val->contrato;
                }
                $resultado = array_unique($arreglo);
                foreach ($baseDeglosada2 as $key => $val) {
                    if (in_array($val->contrato, $resultado)) {
                        $clave = array_search($val->contrato, $resultado);
                        unset($resultado[$clave]);
                        $contratos[] = $val;
                    }
                }
                # -----------------------------------------------------------------


                $datos = array( 
                    'getionBase' => $getionBase , 
                    'fechaVEnta' => $fechaVEnta,
                    'contratos' => $contratos,
                    'Ven_nombre' => $dat->row()->Ven_nombre,
                    'fechaInicial' => $fechaNotificacion , 
                    'fechaFinal' => $fechaFinal,
                    'frg' => $frgss->row()->G729_C17121
                );

                $this->load->view('Reportes/Reporte_Cisa_datos_Exporte', $datos);

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
                    

                    $base = $this->Reportes_Model->getReporteCisa($key2->G729_ConsInte__b, $fechaVEnta);
                   // var_dump($base);
                    if(count( $base) > 0){
                        foreach ($base as $key) {
                            $totalBaseMedicion++;
                            $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->G719_ConsInte__b, $fechaNotificacion, $fechaFinal.' 23:59:00');
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

                    $baseDeglosada2 = $this->Reportes_Model->getReporteCisa_deglosadoS($key2->G729_ConsInte__b, $fechaVEnta);
                    


                    foreach($baseDeglosada2 as $key){
                       $soporte = $this->Reportes_Model->tieneFechaPagoReporte($key->G719_ConsInte__b, $fechaNotificacion, $fechaFinal);
                    
                        if($soporte >= 1){
                        $json[$i]['cumple'] = 'SI';
                        }else{
                        $json[$i]['cumple'] = 'NO';
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] =$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                        $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                        $json[$i]['valorPagado'] = "$ ".number_format($key->Vlorpagado, 0, ',','.');
                        $json[$i]['SAP'] = $key->SAP ;

                        $fecha2 = NULL;
                        $fecha3 = NULL;
                        if(!is_null($key->Fecha_recepcion_soporte)){
                            $fecha2 = explode(" ", $key->Fecha_recepcion_soporte)[0];
                            $fecha2 = explode("-", $fecha2);
                            $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                        }

                        if(!is_null($key->Fecha_aprobacion_soporte)){
                            $fecha3 = explode(" ", $key->Fecha_aprobacion_soporte)[0];
                            $fecha3 = explode("-", $fecha3);
                            $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                        }


                        $json[$i]['fecha_soprte'] = $fecha2 ;
                        $json[$i]['fecha_soprte_ap'] = $fecha3 ;
                  
                        $i++;
                    }

                    
                }


                $arreglo = $newJson = array();
                foreach ($json as $key => $val) {
                    $arreglo[] = $val['contrato'];
                }
                $resultado = array_unique($arreglo);
                foreach ($json as $key => $val) {
                    if (in_array($val['contrato'], $resultado)) {
                        $clave = array_search($val['contrato'], $resultado);
                        unset($resultado[$clave]);
                        $newJson[] = $val;
                    }
                }
                unset($json);
                $json = $newJson;



                $datos = array( 
                    'datos' => $frg ,
                    'datos2' => $frg,
                    'Ven_nombre' => $dat->row()->Ven_nombre,
                    'fechaInicial' => $fechaNotificacion , 
                    'fechaFinal' => $fechaFinal,
                    'fechaVEnta' => $fechaVEnta,
                    'gestiones_deglosado' => $json
                );
                $this->load->view('Reportes/Reporte_Cisa_datos_total_exportar', $datos);
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
            $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
            $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
            $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
            $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');

            $json = array();
            $i = 0;
            $dias = $reporteDatos->row()->par_tiempo_asignacion;
            $j = 1;
            $arregloLiquidaciones = array();
            foreach ($baseSubrogacionDeglosada_ as $key) {

                if(!array_search($key->contrato,$arregloLiquidaciones)){
                    
                    $fechadiaFinmesAnterior = strtotime ( '+'.$dias.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

                   
                    
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
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                            if($radicadoSt == 1){
                                $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }
                           
                        }

                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['liquidacion'] = $key->liquidacion ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = $deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                $arregloLiquidaciones[$j] = $key->contrato;
                $j++;
                    
            }

            foreach ($baseSubrogacionDeglosada as $key) {

                if(!array_search($key->contrato,$arregloLiquidaciones)){
                    $fechadiaFinmesAnterior = strtotime ( '+'.$dias.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin.' 23:59:00');

                   
                    
                    if($radicado == 1){
                       $json[$i]['cumple'] = 'SI';
                    }else{
                        $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                        if($radicadoSt == 1){
                            $json[$i]['cumple'] = 'FUERA DE TIEMPO';
                        }else{
                            $radicadoStN = $this->Reportes_Model->NotieneRadicadoFueraTiempo_2($key->id, $nuevafechaDiaFin.' 23:59:00'); 
                            if($radicadoStN == 0){
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'NO ASIGNADO EN TIEMPO';
                            }
                        }
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['liquidacion'] = $key->liquidacion ;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] =$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                $arregloLiquidaciones[$j] = $key->contrato;
                $j++;
                
            }

            $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));

            $datos  = array(    'Subrogaciones_envio' => $baseSubrogacion , 
                                'Subrogaciones_envio_corregidos' => $baseSubrogacionCorr,
                                'frg' => $frgss->row()->G729_C17121,
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

                $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
                $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');

                $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
                $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
                $j=1;
                $arrayContadoresLiquidacion =array();
                foreach ($baseSubrogacion as $key) {
                    if(!array_search($key->contrato, $arrayContadoresLiquidacion)){
                        $totalObligaciones++;
                        $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                        $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                        $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

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
                                $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                                if($radicadoSt == 1){
                                    $radicadosFueradetiempo++;
                                }else{
                                    $sinradicarFueradeTiempo++;
                                }
                                
                            }

                        }
                    }
                    $arrayContadoresLiquidacion[$j] = $key->contrato;
                    $j++;

                }


                foreach ($baseSubrogacionCorr as $key) {
                    if(!array_search($key->contrato, $arrayContadoresLiquidacion)){
                        $totalObligaciones++;
                        $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                        $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                        $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin.' 23:59:00');

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
                                $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                                if($radicadoSt == 1){
                                    $radicadosFueradetiempo++;
                                }else{
                                    $sinradicarFueradeTiempo++;
                                }
                                
                            }
                        }
                    }
                    $arrayContadoresLiquidacion[$j] = $key->contrato;
                    $j++;
                        
                }   


                $frg[$valor]['Total'] = $totalObligaciones;
                $frg[$valor]['cumplen'] = $cumplimiento;
                $frg[$valor]['nocumplen'] = $Fallos;
                $frg[$valor]['sinasignarsintiempo'] = $sinradicarFueradeTiempo;
                $frg[$valor]['radicadosfueradetiempo'] = $radicadosFueradetiempo;
                $frg[$valor]['Frg'] = $key2->Frg;
                $valor++;
                
                $arregloLiquidaciones = array();
                $j=1;
               
                foreach ($baseSubrogacionDeglosada_ as $key) {
                    
                    if(!array_search($key->contrato,$arregloLiquidaciones)){
                        $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial )) ;
                        $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                        $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

                       
                        
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
                                $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                                if($radicadoSt == 1){
                                    $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                                }else{
                                    $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                                }
                               
                            }
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['liquidacion'] = $key->liquidacion ;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                       $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                    $arregloLiquidaciones[$j] = $key->contrato;
                    $j++;
                    
                }

                foreach ($baseSubrogacionDeglosada as $key) {
                     if(!array_search($key->contrato,$arregloLiquidaciones)){
                        $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                        $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                        $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

                       
                        
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
                                $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                                if($radicadoSt == 1){
                                    $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                                }else{
                                    $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                                }
                               
                            }
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['liquidacion'] = $key->liquidacion;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                       $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                    $arregloLiquidaciones[$j] = $key->contrato;
                    $j++;
                    
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
        $dias = $reporteDatos->row()->par_tiempo_asignacion;

        

        if($frg != NULL && $frg != 0){
            //primero buscar la base de medicion
            $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
            $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
            $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
            $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($frg, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');

            $json = array();
            $i = 0;
            $tiempo = $reporteDatos->row()->par_tiempo_asignacion;
            $j = 1;
            $arregloLiquidaciones = array();
            

                
            foreach ($baseSubrogacionDeglosada_ as $key) {
                
                if(!array_search($key->contrato,$arregloLiquidaciones)){
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

                   
                    
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
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                            if($radicadoSt == 1){
                                $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }
                           
                        }
                    }

                    

                    $deudor = trim(utf8_encode($key->nombre));
                    
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['liquidacion'] = $key->liquidacion;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] = $deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                $arregloLiquidaciones[$j]=$key->contrato;
                $j++;

                
            }

            foreach ($baseSubrogacionDeglosada as $key) {

                if(!array_search($key->contrato,$arregloLiquidaciones)){
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin.' 23:59:00');
                    
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
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                            if($radicadoSt == 1){
                                $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                            }else{
                                $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                            }
                           
                        }
                    }

                    $deudor = trim(utf8_encode($key->nombre));
                    
                    $json[$i]['contrato'] = $key->contrato ;
                    $json[$i]['liquidacion'] = $key->liquidacion;
                    $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                    $json[$i]['nombre'] =$deudor ;
                    $json[$i]['identificacion'] = $key->identificacion;
                   $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                $arregloLiquidaciones[$j]=$key->contrato;
                $j++;
                    
            }

            $frgss = $this->db->get_where('G729',array('G729_ConsInte__b' => $frg));

            $datos  = array(    'Subrogaciones_envio' => $baseSubrogacion , 
                                'Subrogaciones_envio_corregidos' => $baseSubrogacionCorr,
                                'frg' => $frgss->row()->G729_C17121,
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

                $baseSubrogacion = $this->Reportes_Model->getBaseMemorialesSUbrogacion_1($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
                $baseSubrogacionCorr = $this->Reportes_Model->getBaseMemorialesSUbrogacion_2($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');

                $baseSubrogacionDeglosada_ = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_1($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');
                $baseSubrogacionDeglosada = $this->Reportes_Model->getBaseMemorialesSUbrogacion_deglosado_2($key2->G729_ConsInte__b, $abogado , $fechaInicial, $fechaFinal.' 23:59:00');

                foreach ($baseSubrogacion as $key) {
                    
                    $totalObligaciones++;
                    $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                    $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

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
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
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
                    $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial_Corregido, $nuevafechaDiaFin.' 23:59:00');

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
                            $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
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


                $j = 1;
                $arregloLiquidaciones = array();
                
                foreach ($baseSubrogacionDeglosada_ as $key) {
                    if(!array_search($key->contrato,$arregloLiquidaciones)){
                        $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial ) ) ;
                        $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                        $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

                       
                        
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
                                $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                                if($radicadoSt == 1){
                                    $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                                }else{
                                    $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                                }
                               
                            }

                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['liquidacion'] = $key->liquidacion;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] = $deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                       $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                    $arregloLiquidaciones[$j]=$key->contrato;
                    $j++;

                    
                }

                foreach ($baseSubrogacionDeglosada as $key) {

                    if(!array_search($key->contrato,$arregloLiquidaciones)){
                        $fechadiaFinmesAnterior = strtotime ( '+'.$tiempo.' day' , strtotime ( $key->Fecha_envio_Memorial_Corregido ) ) ;
                        $nuevafechaDiaFin = date ( 'Y-m-d' , $fechadiaFinmesAnterior );
                        $radicado = $this->Reportes_Model->tieneRadicado($key->id, $key->Fecha_envio_Memorial, $nuevafechaDiaFin.' 23:59:00');

                       
                        
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
                                $radicadoSt = $this->Reportes_Model->tieneRadicadoFueraTiempo($key->id, $nuevafechaDiaFin.' 23:59:00');
                                if($radicadoSt == 1){
                                    $json[$i]['cumple'] = 'ASIGNADA FUERA DE TIEMPO';
                                }else{
                                    $json[$i]['cumple'] = 'SIN ASIGNAR FUERA DE TIEMPO';
                                }
                               
                            }
                        }

                        $deudor = trim(utf8_encode($key->nombre));
                        
                        $json[$i]['contrato'] = $key->contrato ;
                        $json[$i]['liquidacion'] = $key->liquidacion;
                        $json[$i]['ifinanciero'] = utf8_encode($key->intermediario);
                        $json[$i]['nombre'] =$deudor ;
                        $json[$i]['identificacion'] = $key->identificacion;
                       $json[$i]['tipo_identificacion'] = $key->tipo_identificacion;
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
                    $arregloLiquidaciones[$j]=$key->contrato;
                    $j++;
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
    // Creado por Jeisson Patiño 27/11/2018, funciones para traer los datos del informe FRG Gestores

    function InformeGestores(){

        if($this->session->userdata('login_ok')){
                      
            $Frgs = $this->Configuraciones_Model->getFrgs();
            $gestores = $this->Reportes_Model->GetGestores();
            $datos = array( 'frgs' =>  $Frgs, 'gestores'=>$gestores);


            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/InformeGestores', $datos);
            $this->load->view('Includes/footer');

        }else{
            $this->load->view('Login/login');
        }

    }

    
    function getFrgGestores(){
        
        $frgs = $_POST['frg'];
        $idgestores = $_POST['gestores'];
        $fechaInicial = $_POST['fechainicial'];
        $fechaFinal = $_POST['fechafinal'];

      /* $frgs = '2';
        $idgestores='3429';
        $fechaInicial='2016-09-07';
        $fechaFinal ='2016-09-20';*/

        if( $frgs != NULL && $frgs != '' && $frgs != 0){

            $arregloFrgGestores = $this->Reportes_Model->getInformeFrgGestion($frgs,$idgestores,$fechaInicial,$fechaFinal);
            $arreglocantidad = $this->Reportes_Model->getCantidadGestionada($frgs,$idgestores,$fechaInicial,$fechaFinal);
              $json = array();
              $i= 0;
            foreach ($arregloFrgGestores as $key) {

                    $deudor = trim(utf8_encode($key->NombreDeudor));
                    
                    $json[$i]['TipoIdentificacion'] = $key->TipoIdentificacion ;
                    $json[$i]['NumeroId'] = utf8_encode($key->NumeroId);
                    $json[$i]['NombreDeudor'] =$deudor ;
                    $json[$i]['NumeroLiquidacion'] = $key->NumeroLiquidacion;
                    $json[$i]['FechaPagoGarantia'] = $key->FechaPagoGarantia;
                    $json[$i]['Intermediariofinancero'] = $key->Intermediariofinancero;
                    $json[$i]['FechaGestion'] = $key->FechaGestion;
                    $json[$i]['Gestor'] = $key->Gestor;
                    
                   $fecha2 = NULL;
                   $fecha3 = NULL;
                   if(!is_null($key->FechaPagoGarantia)){
                        $fecha2 = explode(" ", $key->FechaPagoGarantia)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    if(!is_null($key->FechaGestion)){
                        $fecha3 = explode(" ", $key->FechaGestion)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }                   
                    $json[$i]['FechaPagoGarantia'] =  $fecha2;
                    $json[$i]['FechaGestion'] =  $fecha3;
                  $i++;
              
            } 
            $i= 0;
            $json1 = array();
            foreach ($arreglocantidad as $key) {

                    $json1[$i]['cantidad'] = $key->cantidad;
                    $json1[$i]['Gestor'] = $key->Gestor;
                    $i++;
            } 

            $datos = array( 'ResultadoFrgGestiones' => json_encode($json), 'ResultadoCantidadGestionada' => json_encode($json1));

            //var_dump(json_encode($json)); 
            $this->load->view('Reportes/InformeGestoresDatos', $datos);
        }

    }

    function ExportarGestores($frgs = null , $idgestores = null ,$fechaInicial = null,  $fechaFinal=null  ){


        if( $frgs != NULL && $frgs != '' && $frgs != 0){

            $arregloFrgGestores = $this->Reportes_Model->getInformeFrgGestion($frgs,$idgestores,$fechaInicial,$fechaFinal);
            $arreglocantidad = $this->Reportes_Model->getCantidadGestionada($frgs,$idgestores,$fechaInicial,$fechaFinal);
              $json = array();
              $i= 0;
            foreach ($arregloFrgGestores as $key) {

                    $deudor = trim(utf8_encode($key->NombreDeudor));
                    
                    $json[$i]['TipoIdentificacion'] = $key->TipoIdentificacion ;
                    $json[$i]['NumeroId'] = utf8_encode($key->NumeroId);
                    $json[$i]['NombreDeudor'] =$deudor ;
                    $json[$i]['NumeroLiquidacion'] = $key->NumeroLiquidacion;
                    $json[$i]['FechaPagoGarantia'] = $key->FechaPagoGarantia;
                    $json[$i]['Intermediariofinancero'] = $key->Intermediariofinancero;
                    $json[$i]['FechaGestion'] = $key->FechaGestion;
                    $json[$i]['Gestor'] = $key->Gestor;
                    
                   $fecha2 = NULL;
                   $fecha3 = NULL;
                   if(!is_null($key->FechaPagoGarantia)){
                        $fecha2 = explode(" ", $key->FechaPagoGarantia)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    if(!is_null($key->FechaGestion)){
                        $fecha3 = explode(" ", $key->FechaGestion)[0];
                        $fecha3 = explode("-", $fecha3);
                        $fecha3 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
                    }                   
                    $json[$i]['FechaPagoGarantia'] =  $fecha2;
                    $json[$i]['FechaGestion'] =  $fecha3;
                  $i++;
              
            } 
            $i= 0;
            $json1 = array();
            foreach ($arreglocantidad as $key) {

                    $json1[$i]['cantidad'] = $key->cantidad;
                    $json1[$i]['Gestor'] = $key->Gestor;
                    $i++;
            } 

            $datos = array( 'ResultadoFrgGestiones' => json_encode($json), 'ResultadoCantidadGestionada' => json_encode($json1));

            //var_dump(json_encode($json)); 
            $this->load->view('Reportes/ExportarGestores', $datos);
        }

    }



    function imprimirPlano2 ($texto){
        $file = fopen("archivo.txt", "w");
        fwrite($file, $texto . PHP_EOL);
        fwrite($file, "Otra más" . PHP_EOL);
        fclose($file);
    }
 // Exportar Log de elimianciones Datos Liquidaciones Extrajudiciales,  judiciales, abogados y gestores 

    function ExportarLogeliminaciones($fechainicial, $fechafinal){


        if( $fechainicial != NULL && $fechainicial != '' && $fechainicial != 0){

            $arregloExtra = $this->Reportes_Model->LogeliminacionExtrajudicial($fechainicial,$fechafinal);
            
            
              $json = array();
              $i= 0;
            foreach ($arregloExtra as $key) {

                    $json[$i]['NombreUsuario'] = utf8_encode($key->NombreUsuario);
                    $json[$i]['Identificacion'] = $key->Identificacion;
                    $json[$i]['Cargo'] = $key->Cargo;
                    $json[$i]['Fechaeliminacion'] = $key->Fechaeliminacion;
                    $fecha1 = NULL;

                   /*if(!is_null($key->Fechaeliminacion)){
                        $fecha1 = explode(" ", $key->Fechaeliminacion)[0];
                        $fecha1 = explode("-", $fecha2);
                        $fecha1 = $fecha1[2]."/".$fecha1[1]."/".$fecha1[0];
                    }
                    $json[$i]['Fechaeliminacion'] = $fecha1;*/
                    $json[$i]['NumeroLiquidacioneliminado'] = $key->NumeroLiquidacioneliminado;
                  $i++;

               //$this->imprimirPlano2(json_encode($json));
            } 
            $arreglojudicial = $this->Reportes_Model->LogeliminacionJudicial($fechainicial,$fechafinal);
           $i= 0;
            $json1 = array();
            foreach ($arreglojudicial as $key) {

                    $json1[$i]['NombreUsuario'] = utf8_encode($key->NombreUsuario) ;
                    $json1[$i]['Identificacion'] = $key->Identificacion;
                    $json1[$i]['Cargo'] =$key->Cargo ;
                    $json1[$i]['Fechaeliminacion'] = $key->Fechaeliminacion;
                    /*$fecha2 = NULL;
                   if(!is_null($key->Fechaeliminacion)){
                        $fecha2 = explode(" ", $key->Fechaeliminacion)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    $json1[$i]['Fechaeliminacion'] = $fecha2;*/
                    $json1[$i]['NumeroLiquidacioneliminado'] = $key->NumeroLiquidacioneliminado;
                  $i++;
                  
            } 
            //$this->imprimirPlano2(json_encode($json1));

            $arreglousuarios = $this->Reportes_Model->LogeliminacionUsuarios($fechainicial,$fechafinal);

            $i= 0;
            $json2 = array();
            foreach ($arreglousuarios as $key) {

                    $json2[$i]['NombreUsuario'] = utf8_encode($key->NombreUsuario) ;
                    $json2[$i]['Identificacion'] = $key->Identificacion;
                    $json2[$i]['Cargo1'] =$key->Cargo1 ;
                    $json2[$i]['Fechaeliminacion'] = $key->Fechaeliminacion;
                    /*$fecha2 = NULL;
                   if(!is_null($key->Fechaeliminacion)){
                        $fecha2 = explode(" ", $key->Fechaeliminacion)[0];
                        $fecha2 = explode("-", $fecha2);
                        $fecha2 = $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
                    }
                    $json2[$i]['Fechaeliminacion'] = $fecha2;*/
                    $json2[$i]['UsuEliminado'] = utf8_encode($key->UsuEliminado);
                    $json2[$i]['NoId'] = $key->NoId;
                    $json2[$i]['Cargo'] = $key->Cargo;
                  $i++;
            } 
            $this->imprimirPlano2(json_encode($json2));

            $datos = array( 'ResultadoExtrajudicial' => json_encode($json), 'ResultadoJudicial' => json_encode($json1),'ResultadoUsuarios' => json_encode($json2));

        
            $this->load->view('Reportes/exportarLogEliminacion', $datos);

        }else{
            Echo 'Paila no trae nada';

        }

    }

    function LogEliminacion(){

        if($this->session->userdata('login_ok')){
                      
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Reportes/LogEliminacion');
            $this->load->view('Includes/footer');

        }else{
            $this->load->view('Login/login');
        }

    }
}
?>