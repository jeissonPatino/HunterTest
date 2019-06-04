<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Historicos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
        $this->load->model("CarteraFng_Model");
        $this->load->model("Obligaciones_Model");
    }

    public function historicoExtraJudicial(){
    	if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
           	$datosFooter = array('ul'=> 'ULhistorico' , 'li' => 'LIHextrajudicial');
            $abogados =array();
           /*	$extrajudicial = $this->Wizard_Model->getgestionExtrajudicialtotal();
           	
           	$i = 0;
           	foreach ($extrajudicial as $key) {
           	    $fecha1 = null;
				$fecha = null;
				$fecha2 = null;
				if(!is_null($key->fechaIngreso)){
					$fecha1 = explode(" ", $key->fechaIngreso)[0];
					$fecha2 = explode("-", $fecha1);
					$fecha =  "<span style='display: none;'>".$fecha2[0].$fecha2[1].$fecha2[2]."</span>".$fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
				}
                
                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }

                $abogados[$i]['fechaIngreso'] = $fecha;
                $abogados[$i]['Niidea'] = $key->Niidea ;
          
                $abogados[$i]['users'] = utf8_encode($key->users) ;
                $abogados[$i]['observaciones'] = utf8_encode($key->observaciones) ;
                $abogados[$i]['mediocomunicacion'] = utf8_encode($key->mediocomunicacion );
                $abogados[$i]['resultadocomunicacion'] = utf8_encode($key->resultadocomunicacion) ;
                $abogados[$i]['gestion'] = utf8_encode($key->gestion);
                $abogados[$i]['subgestion'] = utf8_encode($key->subgestion);
                $abogados[$i]['noombres'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$".number_format($key->Vlorpagado,0, ',', '.');
                $abogados[$i]['id'] = $key->id;
                $abogados[$i]['frg'] = utf8_encode($key->FRG);
                $i++;
           	}
            */
           	$data = array('extrajudicial' => json_encode($abogados));
			
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Historico/extrajudicial', $data );
            $this->load->view('Includes/footer', $datosFooter );
        }else{
            $this->load->view('Login/login');
        }
    }


    public function gestionExtrajudicial_SAP(){
        set_time_limit(6000);
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $datosFooter = array('ul'=> 'ULhistorico_SAP' , 'li' => 'LIHextrajudicial_SAP');
            $extrajudicial = array();
            //$extrajudicial = $this->Wizard_Model->getgestionExtrajudicialtotal_SAP();
            $abogados =array();
            $i = 0;
            foreach ($extrajudicial as $key) {
                $fecha1 = null;
                $fecha = null;
                $fecha2 = null;
                if(!is_null($key->fechaIngreso)){
                    $fecha1 = explode(" ", $key->fechaIngreso)[0];
                    $fecha2 = explode("-", $fecha1);
                    $fecha =  $fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
                }
                
                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }

                $abogados[$i]['fechaIngreso'] = $fecha;
                $abogados[$i]['Niidea'] = $key->Niidea ;
          
                $abogados[$i]['users'] = utf8_encode($key->users) ;
                $abogados[$i]['observaciones'] = utf8_encode($key->observaciones) ;
                $abogados[$i]['mediocomunicacion'] = utf8_encode($key->mediocomunicacion );
                $abogados[$i]['resultadocomunicacion'] = utf8_encode($key->resultadocomunicacion) ;
                $abogados[$i]['gestion'] = utf8_encode($key->gestion);
                $abogados[$i]['subgestion'] = utf8_encode($key->subgestion);
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$ ".number_format($key->Vlorpagado,0, ',', '.');

                $abogados[$i]['id'] = $key->id;
        
                $i++;
            }

            $data = array('extrajudicial' => json_encode($abogados));
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Historico/extrajudicial_SAP', $data );
            $this->load->view('Includes/footer', $datosFooter );
        }else{
            $this->load->view('Login/login');
        }
    }

    public function gestionExtrajudicialJson($fechaInicial, $FechaFinal){
        ini_set('memory_limit','512M');
        if($this->session->userdata('login_ok')){
            $extrajudicial = $this->Wizard_Model->getgestionExtrajudicialFecha($fechaInicial, $FechaFinal);
            $abogados =array();
            $i = 0;
            foreach ($extrajudicial as $key) {
                $fecha1 = null;
                $fecha = null;
                $fecha2 = null;
                if(!is_null($key->fechaIngreso)){
                    $fecha1 = explode(" ", $key->fechaIngreso)[0];
                    $fecha2 = explode("-", $fecha1);
                    $fecha =  $fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
                }
                
                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }

                $abogados[$i]['fechaIngreso'] = $fecha;
                $abogados[$i]['Niidea'] = $key->Niidea ;
          
                $abogados[$i]['users'] = utf8_encode($key->users) ;
                $abogados[$i]['observaciones'] = utf8_encode($key->observaciones) ;
                $abogados[$i]['mediocomunicacion'] = utf8_encode($key->mediocomunicacion );
                $abogados[$i]['resultadocomunicacion'] = utf8_encode($key->resultadocomunicacion) ;
                $abogados[$i]['gestion'] = utf8_encode($key->gestion);
                $abogados[$i]['subgestion'] = utf8_encode($key->subgestion);
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$".number_format($key->Vlorpagado,0, ',', '.');
                $abogados[$i]['id'] = $key->id;
                $abogados[$i]['frg'] = utf8_encode($key->FRG);
                $abogados[$i]['eliminar'] = '<a class="btn btn-sm btn-danger" role="button" title="Eliminar" onclick="javascript: eliminarGestion('.$key->id.')"><i class="fa fa-trash"></i></a>';
                $i++;
            }
            echo json_encode($abogados);
        }else{
            echo "No tienes permisos para ver esta información";
        }
    }


    public function gestionExtrajudicialJson_e($numeroLiquidacion){
        if($this->session->userdata('login_ok')){
            $extrajudicial = $this->Wizard_Model->getGestionExtrajudicialTotalEliminar($numeroLiquidacion);
            $abogados =array();
            $i = 0;
            foreach ($extrajudicial as $key) {
                $fecha1 = null;
                $fecha = null;
                $fecha2 = null;
                if(!is_null($key->fechaIngreso)){
                    $fecha1 = explode(" ", $key->fechaIngreso)[0];
                    $fecha2 = explode("-", $fecha1);
                    $fecha =  $fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
                }
                
                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }

                $abogados[$i]['fechaIngreso'] = $fecha;
                $abogados[$i]['Niidea'] = $key->Niidea ;
          
                $abogados[$i]['users'] = utf8_encode($key->users) ;
                $abogados[$i]['observaciones'] = utf8_encode($key->observaciones) ;
                $abogados[$i]['mediocomunicacion'] = utf8_encode($key->mediocomunicacion );
                $abogados[$i]['resultadocomunicacion'] = utf8_encode($key->resultadocomunicacion) ;
                $abogados[$i]['gestion'] = utf8_encode($key->gestion);
                $abogados[$i]['subgestion'] = utf8_encode($key->subgestion);
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                 $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$".number_format($key->Vlorpagado,0, ',', '.');
                $abogados[$i]['id'] = $key->id;
                $abogados[$i]['frg'] = utf8_encode($key->FRG);
                $abogados[$i]['eliminar'] = '<a class="btn btn-sm btn-danger" role="button" title="Eliminar" onclick="javascript: eliminarGestion('.$key->id.','.$abogados[$i]['contrato'].')"><i class="fa fa-trash"></i></a>';
                $i++;
            }
            echo json_encode($abogados);
        }else{
            echo "No tienes permisos para ver esta información";
        }
    }

    public function gestionExtrajudicialJson_SAP($estado, $gestion, $subgestion, $fechaInicial=NULL, $fechaFInal = NULL){

        if($this->session->userdata('login_ok')){
            $extrajudicial = $this->Wizard_Model->getgestionExtrajudicialtotal_SAP($estado, $gestion, $subgestion, $fechaInicial, $fechaFInal);
            $abogados =array();
            $i = 0;
            foreach ($extrajudicial as $key) {
                $fecha1 = null;
                $fecha = null;
                $fecha2 = null;
                if(!is_null($key->fechaIngreso)){
                    $fecha1 = explode(" ", $key->fechaIngreso)[0];
                    $fecha2 = explode("-", $fecha1);
                    $fecha =  $fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
                }
                
                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }

                $abogados[$i]['fechaIngreso'] = $fecha;
                $abogados[$i]['Niidea'] = $key->Niidea ;
          
                $abogados[$i]['users'] = utf8_encode($key->users) ;
                $abogados[$i]['observaciones'] = utf8_encode($key->observaciones) ;
                $abogados[$i]['mediocomunicacion'] = utf8_encode($key->mediocomunicacion );
                $abogados[$i]['resultadocomunicacion'] = utf8_encode($key->resultadocomunicacion) ;
                $abogados[$i]['gestion'] = utf8_encode($key->gestion);
                $abogados[$i]['subgestion'] = utf8_encode($key->subgestion);
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$ ".number_format($key->Vlorpagado,0, ',', '.');

                $abogados[$i]['id'] = $key->id;
                $i++;
            }
            echo json_encode($abogados);
        }else{
            echo "No tienes permisos para ver esta información";
        }
    }

    public function exportarExtrajudicial($fechaInicial, $fechaFinal){
        ini_set('memory_limit', '1024M');
		set_time_limit(6000);
        $extrajudicial = $this->Wizard_Model->getgestionExtrajudicialFecha($fechaInicial, $fechaFinal);
        $data = array('extrajudicial' => $extrajudicial);
        $this->load->view('Historico/exportarExtrajudicial', $data );
    }

    function getDatosgestionExtrajudicial($id){
		set_time_limit(6000);
        if($this->session->userdata('login_ok')){

            $datosObligacion = $this->Wizard_Model->getgestionExtrajudicialtotalById($id);
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
                    <div class="col-md-3" id="DatosFecha">'.$fecha[2]."/". $fecha[1]."/". $fecha[0].' </div>
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

    

    public function historicoJudicial(){
    	if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
           	$datosFooter = array('ul'=> 'ULhistorico' , 'li' => 'LIHjudicial');
            $extrajudicial = array();
           	//$extrajudicial = $this->Wizard_Model->getgestioJudicialTotal();
            $procesos = $this->CarteraFng_Model->getListasLisop(191);
           	$abogados =array();
           	$i = 0;
           	foreach ($extrajudicial as $key) {
                $fecha = explode(" ", $key->txtFechaIngreso)[0];
                $fecha = explode("-", $fecha);

                $fecha1 = explode(" ", $key->txtFechaTramite)[0];
                $fecha1 = explode("-", $fecha1);

                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);

                $abogados[$i]['Etapa'] = utf8_encode($key->Etapa) ;
                $abogados[$i]['txtFechaIngreso'] =  $fecha[2]."/". $fecha[1]."/". $fecha[0] ;
                $abogados[$i]['txtObservaciones'] = utf8_encode($key->txtObservaciones) ;
                $abogados[$i]['TipoProceso'] = utf8_encode($key->claseProceso) ;
                $abogados[$i]['users'] = utf8_encode($key->users );
                $abogados[$i]['txtFechaTramite'] = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
               if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }
                $abogados[$i]['actuacion'] = utf8_encode($key->actuacion);
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$".number_format($key->Vlorpagado,0, ',', '.');
                $abogados[$i]['frg'] = utf8_encode($key->FRG);
                $abogados[$i]['id'] = $key->id;
                $abogados[$i]['eliminar'] = '<a class="btn btn-sm btn-danger" role="button" title="Eliminar" onclick="javascript: eliminarGestion('.$key->id.')"><i class="fa fa-trash"></i></a>';
                $i++;
           	}

           	$data = array('judicial' => json_encode($abogados), 'Procesos' => $procesos );
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Historico/judicial', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    public function historicoJudicial_SAP(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $datosFooter = array('ul'=> 'ULhistorico_SAP' , 'li' => 'LIHjudicial_SAP');
            $extrajudicial = $this->Wizard_Model->getgestioJudicialTotal_SAP();
            $procesos = $this->CarteraFng_Model->getListasLisop(191);
            $abogados =array();
            $i = 0;
            foreach ($extrajudicial as $key) {
                $fecha = explode(" ", $key->txtFechaIngreso)[0];
                $fecha = explode("-", $fecha);

                $fecha1 = explode(" ", $key->txtFechaTramite)[0];
                $fecha1 = explode("-", $fecha1);

                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);

                $abogados[$i]['Etapa'] = utf8_encode($key->Etapa) ;
                $abogados[$i]['txtFechaIngreso'] = $fecha[2]."/". $fecha[1]."/". $fecha[0] ;
                $abogados[$i]['txtObservaciones'] = utf8_encode($key->txtObservaciones) ;
                $abogados[$i]['TipoProceso'] = utf8_encode($key->claseProceso) ;
                $abogados[$i]['users'] = utf8_encode($key->users );
                $abogados[$i]['txtFechaTramite'] = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
               if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }
                $abogados[$i]['actuacion'] = utf8_encode($key->actuacion);
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = number_format($key->Vlorpagado, 0);

                $abogados[$i]['id'] = $key->id;
                $i++;
            }

            $data = array('judicial' => json_encode($abogados), 'Procesos' => $procesos );
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Historico/judicial_SAP', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function historicoJudicialjson($fechaInicial, $fechaFinal){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');

            $extrajudicial = $this->Wizard_Model->getgestioJudicialTotal($fechaInicial, $fechaFinal);
           
            $abogados =array();
            $i = 0;
            foreach ($extrajudicial as $key) {

                $fecha = explode(" ", $key->txtFechaIngreso)[0];
                $fecha = explode("-", $fecha);

                $fecha1 = explode(" ", $key->txtFechaTramite)[0];
                $fecha1 = explode("-", $fecha1);

                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);

                $abogados[$i]['Etapa'] = utf8_encode($key->Etapa) ;
                $abogados[$i]['txtFechaIngreso'] =  "<span style='display: none;'>".$fecha[0].$fecha[1].$fecha[2]."</span>".$fecha[2]."/". $fecha[1]."/". $fecha[0] ;
                $abogados[$i]['txtObservaciones'] = utf8_encode($key->txtObservaciones) ;
                $abogados[$i]['TipoProceso'] = utf8_encode($key->claseProceso) ;
                $abogados[$i]['users'] = utf8_encode($key->users );
                $abogados[$i]['txtFechaTramite'] = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
               if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }
                $abogados[$i]['actuacion'] = utf8_encode($key->actuacion);
                $abogados[$i]['noombres'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = number_format($key->Vlorpagado, 0);
                $abogados[$i]['frg'] = utf8_encode($key->FRG);
                $abogados[$i]['id'] = $key->id;
                 $abogados[$i]['eliminar'] = '<a class="btn btn-sm btn-danger" role="button" title="Eliminar" onclick="javascript: eliminarGestion('.$key->id.')"><i class="fa fa-trash"></i></a>';
                $i++;
            }

            echo json_encode($abogados);

        }else{
            $this->load->view('Login/login');
        }
    }

    function imprimirPlano3 ($texto){
        $file = fopen("archivo.txt", "w");
        fwrite($file, $texto . PHP_EOL);
        fwrite($file, "Otra más" . PHP_EOL);
        fclose($file);
    }

    public function historicoJudicialjson_SAP($numeroLiquidacion){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '512M');

            $extrajudicial = $this->Wizard_Model->getgestionJudicialEliminar($numeroLiquidacion);
           
            $abogados =array();
            $i = 0;
            foreach ($extrajudicial as $key) {

                $fecha = NULL;
                $fecha2 = NULL;
                if(!is_null($key->txtFechaIngreso)){
                    $fecha = explode(" ", $key->txtFechaIngreso)[0];
                    $fecha = explode("-", $fecha);
                    $fecha = $fecha[2]."/". $fecha[1]."/". $fecha[0] ;
                    $fecha2 = $fecha[0].$fecha[1].$fecha[2];
                }
                
                $fecha1  = NULL;
                if(!is_null($key->txtFechaTramite)){
                    $fecha1 = explode(" ", $key->txtFechaTramite)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                }
                

                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3);

                $abogados[$i]['Etapa'] = utf8_encode($key->Etapa) ;
                $abogados[$i]['txtFechaIngreso'] =  $fecha;
                $abogados[$i]['txtObservaciones'] = utf8_encode($key->txtObservaciones) ;
                $abogados[$i]['TipoProceso'] = utf8_encode($key->claseProceso) ;
                $abogados[$i]['users'] = utf8_encode($key->users );
                $abogados[$i]['txtFechaTramite'] =  $fecha1;
               if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }
                $abogados[$i]['actuacion'] = utf8_encode($key->actuacion);
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$ ".number_format($key->Vlorpagado,0, ',', '.');


                $abogados[$i]['id'] = $key->id;
                $i++;
            }

            echo json_encode($abogados);
            ///$this->imprimirPlano3(json_encode($abogados));

        }else{
            $this->load->view('Login/login');
        }
    }

    function exportarHistoricoJudicial($fechaInicial, $fechaFinal){
        ini_set('memory_limit', '1024M');
		set_time_limit(6000);
        $judicial = $this->Wizard_Model->getgestioJudicialTotal($fechaInicial, $fechaFinal);
        $data = array('judicial' => $judicial);
        $this->load->view('Historico/exportarjudiciales', $data );

        $this->imprimirPlano3(count($data) );      

    }  


    function getDatosgestionJudicial($id){
        if($this->session->userdata('login_ok')){

            $datosObligacion = $this->Wizard_Model->getgestioJudicialById($id);
            foreach ($datosObligacion as $key) {

                $fecha = explode(" ", $key->txtFechaIngreso)[0];
                $fecha = explode("-", $fecha);

                $fecha1 = explode(" ", $key->txtFechaTramite)[0];
                $fecha1 = explode("-", $fecha1);

                echo '<div class="row">
                    <div class="col-md-3" ><label>Tipo de Proceso</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.utf8_encode($key->TipoProceso) .' </div>
                    <div class="col-md-3" ><label>Fecha de informe</label> </div>
                    <div class="col-md-3" id="Datosgestion">'. $fecha[2]."/". $fecha[1]."/". $fecha[0] .' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Etapa</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion"> '.utf8_encode($key->Etapa).'</div>
                    <div class="col-md-3"><label>Actuación</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.utf8_encode($key->actuacion).' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Fecha Tramite</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">'.$fecha1[2]."/". $fecha1[1]."/". $fecha1[0].' </div>
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

       public function historicoMedidas(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '512M');
            $datosFooter = array('ul'=> 'ULhistorico' , 'li' => 'LIHmedidas');
            $extrajudicial = $this->Wizard_Model->getMedidasCautelaresTotal();
            $abogados =array();
            $i = 0;
            $this->db->select('G731_ConsInte__b, G731_C17128 as medida');
            $this->db->from('G731');
            $query = $this->db->get();
            $medidas = $query->result();
            foreach ($extrajudicial as $key) {
               
                $fechaAlla = NULL;
                if(!is_null($key->FechaPractica)){
                    $fecha = explode(" ", $key->FechaPractica)[0];
                    $fecha = explode("-", $fecha);
                   
                    $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                }
                

                
                $fecha5 = NULL;
                 $sapan = NULL;
                if(!is_null($key->FechaSolicitud)){
                    $fecha1 = explode(" ", $key->FechaSolicitud)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                    $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
                }
                

                $fecha4 = NULL;
                if(!is_null($key->FechaDecreto)){
                    $fecha3 = explode(" ", $key->FechaDecreto)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha4 = $fecha3[2]."/". $fecha3[1]."/". $fecha3[0];
                }
                
                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3); 

                $abogados[$i]['FechaSolicitud'] = $fecha5;
                $abogados[$i]['FechaDecreto'] = $fecha4;
                $abogados[$i]['users'] = utf8_encode($key->users) ;
                $abogados[$i]['Secuestre'] = utf8_encode($key->Secuestre) ;
                $abogados[$i]['OtroBien'] = utf8_encode($key->OtroBien );
                $abogados[$i]['Observaciones'] = utf8_encode($key->Observaciones) ;
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }
                $abogados[$i]['FechaInforme'] =  $fechaAlla;

                $abogados[$i]['Medida'] = utf8_encode($key->Medida);
                $abogados[$i]['id'] = $key->G736_ConsInte__b;
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$ ".number_format($key->Vlorpagado,0, ',', '.');
                if($key->resultadoMedida == 'SI'){
                    $abogados[$i]['calificar'] = 'EFECTIVA';
                }else if($key->resultadoMedida == 'NO'){
                    $abogados[$i]['calificar'] = 'NO EFECTIVA';
                }else{
                    $abogados[$i]['calificar'] = NULL;
                }
                $abogados[$i]['frg'] = utf8_encode($key->FRG);
                $i++;
            }

            $data = array('medidas' => json_encode($abogados), 'medidasCautelares' => $medidas);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Historico/medidas', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function historicoMedidas_SAP(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '512M');
            $datosFooter = array('ul'=> 'ULhistorico_SAP' , 'li' => 'LIHmedidas_SAP');
            $extrajudicial = $this->Wizard_Model->getMedidasCautelaresTotal_SAP();
            $abogados =array();
            $i = 0;
            $this->db->select('G731_ConsInte__b, G731_C17128 as medida');
            $this->db->from('G731');
            $query = $this->db->get();
            $medidas = $query->result();
            foreach ($extrajudicial as $key) {
               
                $fechaAlla = NULL;
                if(!is_null($key->FechaPractica)){
                    $fecha = explode(" ", $key->FechaPractica)[0];
                    $fecha = explode("-", $fecha);
                   
                    $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                }
                

                
                $fecha5 = NULL;
                 $sapan = NULL;
                if(!is_null($key->FechaSolicitud)){
                    $fecha1 = explode(" ", $key->FechaSolicitud)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                    $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
                }
                

                $fecha4 = NULL;
                if(!is_null($key->FechaDecreto)){
                    $fecha3 = explode(" ", $key->FechaDecreto)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha4 = $fecha3[2]."/". $fecha3[1]."/". $fecha3[0];
                }
                
                $deudor = trim(utf8_encode($key->nombres));
                $nombre = substr($deudor, 0, 3); 

                $abogados[$i]['FechaSolicitud'] = $fecha5;
                $abogados[$i]['FechaDecreto'] = $fecha4;
                $abogados[$i]['users'] = utf8_encode($key->users) ;
                $abogados[$i]['Secuestre'] = utf8_encode($key->Secuestre) ;
                $abogados[$i]['OtroBien'] = utf8_encode($key->OtroBien );
                $abogados[$i]['Observaciones'] = utf8_encode($key->Observaciones) ;
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $abogados[$i]['contrato'] =  $key->liquidacion;
                }else{
                    $abogados[$i]['contrato'] = $key->contrato ;
                }
                $abogados[$i]['FechaInforme'] =  $fechaAlla;

                $abogados[$i]['Medida'] = utf8_encode($key->Medida);
                $abogados[$i]['id'] = $key->G736_ConsInte__b;
                $abogados[$i]['noombres'] = $deudor ;
                $abogados[$i]['identificacion'] = $key->identificacion;
                $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
                $abogados[$i]['SAP'] = $key->SAP;
                $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
                $abogados[$i]['Vlorpagado'] = "$ ".number_format($key->Vlorpagado,0, ',', '.');

                if($key->resultadoMedida == 'SI'){
                    $abogados[$i]['calificar'] = 'EFECTIVA';
                }else if($key->resultadoMedida == 'NO'){
                    $abogados[$i]['calificar'] = 'NO EFECTIVA';
                }else{
                    $abogados[$i]['calificar'] = NULL;
                }
                $i++;
            }

            $data = array('medidas' => json_encode($abogados), 'medidasCautelares' => $medidas);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Historico/medidas_SAP', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function getMedidasJson($idMedida){
        $extrajudicial = $this->Wizard_Model->getMedidasCautelaresTotal($idMedida);
        $abogados =array();
        $i = 0;
        foreach ($extrajudicial as $key) {
               
            $fechaAlla = NULL;
            if(!is_null($key->FechaPractica)){
                $fecha = explode(" ", $key->FechaPractica)[0];
                $fecha = explode("-", $fecha);
               
                $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
            }
            

            
            $fecha5 = NULL;
             $sapan = NULL;
            if(!is_null($key->FechaSolicitud)){
                $fecha1 = explode(" ", $key->FechaSolicitud)[0];
                $fecha1 = explode("-", $fecha1);
                $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
            }
            

            $fecha4 = NULL;
            if(!is_null($key->FechaDecreto)){
                $fecha3 = explode(" ", $key->FechaDecreto)[0];
                $fecha3 = explode("-", $fecha3);
                $fecha4 = $fecha3[2]."/". $fecha3[1]."/". $fecha3[0];
            }
            
            $deudor = trim(utf8_encode($key->nombres));
            $nombre = substr($deudor, 0, 3); 

            $abogados[$i]['FechaSolicitud'] = $fecha5;
            $abogados[$i]['FechaDecreto'] = $fecha4;
            $abogados[$i]['users'] = utf8_encode($key->users) ;
            $abogados[$i]['Secuestre'] = utf8_encode($key->Secuestre) ;
            $abogados[$i]['OtroBien'] = utf8_encode($key->OtroBien );
            $abogados[$i]['Observaciones'] = utf8_encode($key->Observaciones) ;
            if($key->liquidacion != '' && !is_null($key->liquidacion)){
                $abogados[$i]['contrato'] =  $key->liquidacion;
            }else{
                $abogados[$i]['contrato'] = $key->contrato ;
            }
            $abogados[$i]['FechaInforme'] =  $fechaAlla;

            $abogados[$i]['Medida'] = utf8_encode($key->Medida);
            $abogados[$i]['id'] = $key->G736_ConsInte__b;
            $abogados[$i]['noombres'] = $deudor ;
            $abogados[$i]['identificacion'] = $key->identificacion;
            $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
            $abogados[$i]['SAP'] = $key->SAP;
            $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
            $abogados[$i]['Vlorpagado'] = "$ ".number_format($key->Vlorpagado,0, ',', '.');
            if($key->resultadoMedida == 'SI'){
                $abogados[$i]['calificar'] = 'EFECTIVA';
            }else if($key->resultadoMedida == 'NO'){
                $abogados[$i]['calificar'] = 'NO EFECTIVA';
            }else{
                $abogados[$i]['calificar'] = NULL;
            }
            $abogados[$i]['frg'] = utf8_encode($key->FRG);
            $i++;
        }

        echo json_encode($abogados);
    }


    public function getMedidasJson_SAP($idMedida, $fechaInicial=NULL, $fechaFInal = NULL){
        $extrajudicial = $this->Wizard_Model->getMedidasCautelaresTotal_SAP($idMedida, $fechaInicial, $fechaFInal);
        $abogados =array();
        $i = 0;
        foreach ($extrajudicial as $key) {
               
            $fechaAlla = NULL;
            if(!is_null($key->FechaPractica)){
                $fecha = explode(" ", $key->FechaPractica)[0];
                $fecha = explode("-", $fecha);
               
                $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
            }
            

            
            $fecha5 = NULL;
             $sapan = NULL;
            if(!is_null($key->FechaSolicitud)){
                $fecha1 = explode(" ", $key->FechaSolicitud)[0];
                $fecha1 = explode("-", $fecha1);
                $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
            }
            

            $fecha4 = NULL;
            if(!is_null($key->FechaDecreto)){
                $fecha3 = explode(" ", $key->FechaDecreto)[0];
                $fecha3 = explode("-", $fecha3);
                $fecha4 = $fecha3[2]."/". $fecha3[1]."/". $fecha3[0];
            }
            
            $deudor = trim(utf8_encode($key->nombres));
            $nombre = substr($deudor, 0, 3); 

            $abogados[$i]['FechaSolicitud'] = $fecha5;
            $abogados[$i]['FechaDecreto'] = $fecha4;
            $abogados[$i]['users'] = utf8_encode($key->users) ;
            $abogados[$i]['Secuestre'] = utf8_encode($key->Secuestre) ;
            $abogados[$i]['OtroBien'] = utf8_encode($key->OtroBien );
            $abogados[$i]['Observaciones'] = utf8_encode($key->Observaciones) ;
            if($key->liquidacion != '' && !is_null($key->liquidacion)){
                $abogados[$i]['contrato'] =  $key->liquidacion;
            }else{
                $abogados[$i]['contrato'] = $key->contrato ;
            }
            $abogados[$i]['FechaInforme'] =  $fechaAlla;

            $abogados[$i]['Medida'] = utf8_encode($key->Medida);
            $abogados[$i]['id'] = $key->G736_ConsInte__b;
            $abogados[$i]['noombres'] = $deudor ;
            $abogados[$i]['identificacion'] = $key->identificacion;
            $abogados[$i]['tipo_identificacion'] = $key->tipo_identificacion;
            $abogados[$i]['SAP'] = $key->SAP;
            $abogados[$i]['intermediario'] = utf8_encode($key->financiero);
            $abogados[$i]['Vlorpagado'] = "$ ".number_format($key->Vlorpagado,0, ',', '.');

            if($key->resultadoMedida == 'SI'){
                $abogados[$i]['calificar'] = 'EFECTIVA';
            }else if($key->resultadoMedida == 'NO'){
                $abogados[$i]['calificar'] = 'NO EFECTIVA';
            }else{
                $abogados[$i]['calificar'] = NULL;
            }
            $i++;
        }

        echo json_encode($abogados);
    }

    function exportarHistoricoMedidas(){
        ini_set('memory_limit', '512M');
        $judicial = $this->Wizard_Model->getMedidasCautelaresTotal();
        $data = array('judicial' => $judicial);
        $this->load->view('Historico/exportarMedidas', $data );
    }

    public function historicoMedidasById($id){
        if($this->session->userdata('login_ok')){
            
            $datosObligacion = $this->Wizard_Model->getMedidasCautelaresById($id);
            foreach ($datosObligacion as $key) {
                
                $fecha  = '';
                $fecha1 = '';
                $fecha2 = '';
                $fecha3 = '';

                if(!is_null($key->FechaInforme)){
                    $fecha = explode(" ", $key->FechaInforme)[0];
                    $fecha = explode("-", $fecha);
                    $fecha = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                }
                

                if(!is_null($key->FechaSolicitud)){
                    $fecha1 = explode(" ", $key->FechaSolicitud)[0];
                    $fecha1 = explode("-", $fecha1);
                    $fecha1 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                }

                if(!is_null($key->FechaDecreto)){
                    $fecha2 = explode(" ", $key->FechaDecreto)[0];
                    $fecha2 = explode("-", $fecha2);
                    $fecha2 = $fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
                }
                
                if(!is_null($key->FechaPractica)){
                    $fecha3 = explode(" ", $key->FechaPractica)[0];
                    $fecha3 = explode("-", $fecha3);
                    $fecha3 = $fecha3[2]."/". $fecha3[1]."/". $fecha3[0];
                }

            

                echo '<div class="row">
                    <div class="col-md-3" ><label>Fecha Informe</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$fecha.' </div>
                    <div class="col-md-3" ><label>Medida Cautelar</label> </div>
                    <div class="col-md-3" id="Datosgestion">'.utf8_encode($key->Medida).' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><label>Fecha Solicitud</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion"> '.$fecha1.'</div>
                    <div class="col-md-3"><label>Fecha Decreto</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.$fecha2.' </div>
                </div>
                <div class="row">
                    <div class="col-md-3"   ><label>Fecha Práctica</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">'.$fecha3.' </div>
                    <div class="col-md-3"  ><label>Secuestre</label> </div>
                    <div class="col-md-3" id="DatosFecha">'.utf8_encode($key->Secuestre).' </div>
                </div>
                <div class="row">
                    <div class="col-md-2"   ><label>Observaciones</label> </div>
                    <div class="col-md-10" id="fechapronunciamiento">'.utf8_encode($key->Observaciones).' </div>
                
                </div>';
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function superhistoricoSap(){
        ini_set('memory_limit', '1024M');
        $datosFooter = array('ul'=> 'ULhistorico_SAP' , 'li' => 'LIHmedidas_SAP_SUPER');

        $fechaFinal = date('Y-m-d');

         $fechaFinal = strtotime ( '+10 days' , strtotime ( $fechaFinal ) ) ;
        $fechaFinal = date ( 'Y-m-d' , $fechaFinal );

        $fechamesGarantia = strtotime ( '-2 month' , strtotime ( $fechaFinal ) ) ;
        $fechaInicial = date ( 'Y-m-d' , $fechamesGarantia );

        $this->db->select('G735_C17138');
        $this->db->from('G735');
        $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->group_by('G735_C17138');
        $query = $this->db->get();
        $res = $query->result();

        $abogados =array();
        $i = 0;
        foreach ($res as $key) {
           /* $extrajudicial = $this->Wizard_Model->getgestionExtrajudicialtotal_SAP_Final($fechaInicial, $fechaFinal, $key->G735_C17138);
            
            if( $extrajudicial != 0){
                /*foreach ($extrajudicial as $key4) {
                    $fecha1 = null;
                    $fecha = null;
                    $fecha2 = null;
                    if(!is_null($key4->fechaIngreso)){
                        $fecha1 = explode(" ", $key4->fechaIngreso)[0];
                        $fecha2 = explode("-", $fecha1);
                        $fecha =  "<span style='display: none;'>".$fecha2[0].$fecha2[1].$fecha2[2]."</span>".$fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
                    }
                    
                    
                    

                    $deudor = trim(utf8_encode($key4->abogado));
                    $nombre = substr($deudor, 0, 3);
                    if($key4->liquidacion != '' && !is_null($key4->liquidacion)){
                        $abogados[$i]['contrato'] =  $key4->liquidacion;
                    }else{
                        $abogados[$i]['contrato'] = $key4->contrato ;
                    }

                   

                    $abogados[$i]['fechaIngreso'] = $fecha;
                    $abogados[$i]['Niidea'] = $key4->Niidea ;
                    $abogados[$i]['users'] = utf8_encode($key4->users) ;
                    $abogados[$i]['observaciones'] = utf8_encode($key4->observaciones) ;
                    $abogados[$i]['mediocomunicacion'] = utf8_encode($key4->mediocomunicacion );
                    $abogados[$i]['resultadocomunicacion'] = utf8_encode($key4->resultadocomunicacion) ;
                    $abogados[$i]['gestion'] = utf8_encode($key4->gestion);
                    $abogados[$i]['subgestion'] = utf8_encode($key4->subgestion);
                    $abogados[$i]['noombres'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $abogados[$i]['identificacion'] = $key4->identificacion;
                    $abogados[$i]['SAP'] = $key4->SAP;
                    $abogados[$i]['intermediario'] = utf8_encode($key4->financiero);
                    $abogados[$i]['Vlorpagado'] = $key4->Vlorpagado;
                    $abogados[$i]['id'] = $key4->id;
                    $abogados[$i]['fechaAsignacion'] = $fechaAbogado;
                    $abogados[$i]['poliza'] = $key4->poliza;
                    $abogados[$i]['fechaAPoliza'] = $fechaAPoliza;
                    $abogados[$i]['fechaVPoliza'] = $fechaVPoliza;
                    $abogados[$i]['promotor'] = NULL;
                    $abogados[$i]['fechaFijacion'] = NULL;
                }*/

                //aqui traigo el judicial
                $judicial = $this->Wizard_Model->getgestioJudicialTotal_SAP_Final($fechaInicial, $fechaFinal, $key->G735_C17138);
                if($judicial == 0){
                    $abogados[$i]['Etapa'] = NULL;
                    $abogados[$i]['txtFechaIngreso'] =  NULL;
                    $abogados[$i]['txtObservaciones'] = NULL;
                    $abogados[$i]['TipoProceso'] = NULL;
                    $abogados[$i]['users'] = NULL;
                    $abogados[$i]['txtFechaTramite'] = NULL;
                    $abogados[$i]['actuacion'] = NULL;

                    $abogados[$i]['Observaciones'] = NULL;
                    $abogados[$i]['fechaAsignacion'] = NULL;
                    $abogados[$i]['poliza'] = NULL;
                    $abogados[$i]['fechaAPoliza'] = NULL;
                    $abogados[$i]['fechaVPoliza'] = NULL;
                    $abogados[$i]['promotor'] = NULL;
                    $abogados[$i]['fechaFijacion'] = NULL;
                    $abogados[$i]['credito'] = NULL;
                    $abogados[$i]['noombres'] = NULL;
                    $abogados[$i]['SAP'] = NULL;

                }else{
                    foreach ($judicial as $key2) {

                        $fecha = NULL;
                        $fecha2 = NULL;
                        if(!is_null($key2->txtFechaIngreso)){
                            $fecha = explode(" ", $key2->txtFechaIngreso)[0];
                            $fecha = explode("-", $fecha);
                            $fecha = $fecha[2]."/". $fecha[1]."/". $fecha[0] ;
                            $fecha2 = $fecha[0].$fecha[1].$fecha[2];
                        }
                        
                        $fecha1  = NULL;
                        if(!is_null($key2->txtFechaTramite)){
                            $fecha1 = explode(" ", $key2->txtFechaTramite)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha1 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                        }

                        $fechaAbogado = NULL;

                        if(!is_null($key2->fechaabogado)){
                            $fechaAbogado2 = explode(" ", $key2->fechaabogado)[0];
                            $fechaAbogado2 = explode("-", $fechaAbogado2);
                            $fechaAbogado =  $fechaAbogado2[0].$fechaAbogado2[1].$fechaAbogado2[2]."</span>".$fechaAbogado2[2]."/". $fechaAbogado2[1]."/". $fechaAbogado2[0];
                        }

                        $fechaAPoliza = NULL;
                        if(!is_null($key2->fecha_aprovacion)){
                            $fechaAPoliza2 = explode(" ", $key2->fecha_aprovacion)[0];
                            $fechaAPoliza2 = explode("-", $fechaAPoliza2);
                            $fechaAPoliza =  $fechaAPoliza2[0].$fechaAPoliza2[1].$fechaAPoliza2[2]."</span>".$fechaAPoliza2[2]."/". $fechaAPoliza2[1]."/". $fechaAbogado2[0];
                        }

                        $fechaVPoliza = NULL;
                        if(!is_null($key2->fecha_vencimiento)){
                            $fechaVPoliza2 = explode(" ", $key2->fecha_vencimiento)[0];
                            $ffechaVPoliza2 = explode("-", $fechaVPoliza2);
                            $fechaVPoliza =  $fechaVPoliza2[2]."/". $fechaVPoliza2[1]."/". $fechaVPoliza2[0];
                        }

                        $abogados[$i]['Etapa'] = utf8_encode($key2->Etapa) ;
                        $abogados[$i]['txtFechaIngreso'] =  $fecha;
                        $abogados[$i]['txtObservaciones'] = utf8_encode($key2->txtObservaciones) ;
                        $abogados[$i]['TipoProceso'] = utf8_encode($key2->claseProceso) ;
                        $abogados[$i]['users'] = utf8_encode($key2->users );
                        $abogados[$i]['txtFechaTramite'] =  $fecha1;
                        $abogados[$i]['actuacion'] = utf8_encode($key2->actuacion);
                        $abogados[$i]['Observaciones'] = utf8_encode($key2->txtObservaciones);
                        $abogados[$i]['fechaAsignacion'] = $fechaAbogado;
                        $abogados[$i]['poliza'] = $key2->poliza;
                        $abogados[$i]['fechaAPoliza'] = $fechaAPoliza;
                        $abogados[$i]['fechaVPoliza'] = $fechaVPoliza;
                        $abogados[$i]['promotor'] = NULL;
                        $abogados[$i]['fechaFijacion'] = NULL;
                        $abogados[$i]['credito'] = $key2->liquidacion;
                        $deudor = trim(utf8_encode($key2->abogado));
                        $nombre = substr($deudor, 0, 3);
                        $abogados[$i]['noombres'] = $deudor ;
                        $abogados[$i]['SAP'] = $key2->SAP;

                        $fechaAlla = NULL;
                        if(!is_null($key2->Fecha_radicacion_memorial)){
                            $fecha = explode(" ", $key2->Fecha_radicacion_memorial)[0];
                            $fecha = explode("-", $fecha);
                           
                            $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                        }
                        

                        
                        $fecha5 = NULL;
                        $sapan = NULL;
                        if(!is_null($key2->Fecha_pronunciamiento)){
                            $fecha1 = explode(" ", $key2->Fecha_pronunciamiento)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                            $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
                        }


                       
                        $abogados[$i]['radMemo'] = $fechaAlla ;
                        $abogados[$i]['Fechadecision'] = $fecha5 ;
                        $abogados[$i]['decision'] = $key2->Decision;


                    }
          
                }

                //aqui traigo la medida cautelar
                $medidas = $this->Wizard_Model->getMedidasCautelaresTotal_SAP_final($fechaInicial, $fechaFinal, $key->G735_C17138);
               
                if($medidas == 0){
                    $abogados[$i]['FechaSolicitud'] = NULL;
                    $abogados[$i]['FechaDecreto'] =  NULL;
                    $abogados[$i]['users'] =  NULL;
                    $abogados[$i]['Secuestre'] =  NULL;
                    $abogados[$i]['OtroBien'] =  NULL;
                    $abogados[$i]['Observaciones'] =  NULL;
                    $abogados[$i]['FechaInforme'] =  NULL;
                    $abogados[$i]['Medida'] =  NULL;
                    $abogados[$i]['calificar'] = NULL;
                }else{
                    foreach ($medidas as $key3) {
                       
                        $fechaAlla = NULL;
                        if(!is_null($key3->FechaPractica)){
                            $fecha = explode(" ", $key3->FechaPractica)[0];
                            $fecha = explode("-", $fecha);
                           
                            $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                        }
                        

                        
                        $fecha5 = NULL;
                        $sapan = NULL;
                        if(!is_null($key3->FechaSolicitud)){
                            $fecha1 = explode(" ", $key3->FechaSolicitud)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                            $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
                        }
                        

                        $fecha4 = NULL;
                        if(!is_null($key3->FechaDecreto)){
                            $fecha3 = explode(" ", $key3->FechaDecreto)[0];
                            $fecha3 = explode("-", $fecha3);
                            $fecha4 = $fecha3[2]."/". $fecha3[1]."/". $fecha3[0];
                        }
                        
                        $abogados[$i]['FechaSolicitud'] = $fecha5;
                        $abogados[$i]['FechaDecreto'] = $fecha4;
                        $abogados[$i]['users'] = utf8_encode($key3->users) ;
                        $abogados[$i]['Secuestre'] = utf8_encode($key3->Secuestre) ;
                        $abogados[$i]['OtroBien'] = utf8_encode($key3->OtroBien );
                        $abogados[$i]['Observaciones'] = utf8_encode($key3->Observaciones) ;
                        $abogados[$i]['FechaInforme'] =  $fechaAlla;
                        $abogados[$i]['Medida'] = utf8_encode($key3->Medida);
                    
                        if($key3->resultadoMedida == 'SI'){
                            $abogados[$i]['calificar'] = 'EFECTIVA';
                        }else if($key3->resultadoMedida == 'NO'){
                            $abogados[$i]['calificar'] = 'NO EFECTIVA';
                        }else{
                            $abogados[$i]['calificar'] = NULL;
                        }
                    }
                }

                

                $i++;
           // }
            
        }

        $array = array('datos' => json_encode($abogados));

        $this->load->view('Includes/head');
        $this->load->view('Includes/header');
        $this->load->view('Includes/sidebar');
        $this->load->view('Historico/SuperHistoricoSap', $array);
        $this->load->view('Includes/footer', $datosFooter);
    }

    function getSuperHistorico_json($fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select('G735_C17138');
        $this->db->from('G735');
        $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->group_by('G735_C17138');
        $query = $this->db->get();
        $res = $query->result();

        $abogados =array();
        $i = 0;
        foreach ($res as $key) {
           /* $extrajudicial = $this->Wizard_Model->getgestionExtrajudicialtotal_SAP_Final($fechaInicial, $fechaFinal, $key->G735_C17138);
            
            if( $extrajudicial != 0){
                /*foreach ($extrajudicial as $key4) {
                    $fecha1 = null;
                    $fecha = null;
                    $fecha2 = null;
                    if(!is_null($key4->fechaIngreso)){
                        $fecha1 = explode(" ", $key4->fechaIngreso)[0];
                        $fecha2 = explode("-", $fecha1);
                        $fecha =  "<span style='display: none;'>".$fecha2[0].$fecha2[1].$fecha2[2]."</span>".$fecha2[2]."/". $fecha2[1]."/". $fecha2[0];
                    }
                    
                    
                    

                    $deudor = trim(utf8_encode($key4->abogado));
                    $nombre = substr($deudor, 0, 3);
                    if($key4->liquidacion != '' && !is_null($key4->liquidacion)){
                        $abogados[$i]['contrato'] =  $key4->liquidacion;
                    }else{
                        $abogados[$i]['contrato'] = $key4->contrato ;
                    }

                   

                    $abogados[$i]['fechaIngreso'] = $fecha;
                    $abogados[$i]['Niidea'] = $key4->Niidea ;
                    $abogados[$i]['users'] = utf8_encode($key4->users) ;
                    $abogados[$i]['observaciones'] = utf8_encode($key4->observaciones) ;
                    $abogados[$i]['mediocomunicacion'] = utf8_encode($key4->mediocomunicacion );
                    $abogados[$i]['resultadocomunicacion'] = utf8_encode($key4->resultadocomunicacion) ;
                    $abogados[$i]['gestion'] = utf8_encode($key4->gestion);
                    $abogados[$i]['subgestion'] = utf8_encode($key4->subgestion);
                    $abogados[$i]['noombres'] = "<span style='display: none;'>".utf8_encode($nombre)."</span>".$deudor ;
                    $abogados[$i]['identificacion'] = $key4->identificacion;
                    $abogados[$i]['SAP'] = $key4->SAP;
                    $abogados[$i]['intermediario'] = utf8_encode($key4->financiero);
                    $abogados[$i]['Vlorpagado'] = $key4->Vlorpagado;
                    $abogados[$i]['id'] = $key4->id;
                    $abogados[$i]['fechaAsignacion'] = $fechaAbogado;
                    $abogados[$i]['poliza'] = $key4->poliza;
                    $abogados[$i]['fechaAPoliza'] = $fechaAPoliza;
                    $abogados[$i]['fechaVPoliza'] = $fechaVPoliza;
                    $abogados[$i]['promotor'] = NULL;
                    $abogados[$i]['fechaFijacion'] = NULL;
                }*/

                //aqui traigo el judicial
                $judicial = $this->Wizard_Model->getgestioJudicialTotal_SAP_Final($fechaInicial, $fechaFinal, $key->G735_C17138);
                if($judicial == 0){
                    $abogados[$i]['Etapa'] = NULL;
                    $abogados[$i]['txtFechaIngreso'] =  NULL;
                    $abogados[$i]['txtObservaciones'] = NULL;
                    $abogados[$i]['TipoProceso'] = NULL;
                    $abogados[$i]['users'] = NULL;
                    $abogados[$i]['txtFechaTramite'] = NULL;
                    $abogados[$i]['actuacion'] = NULL;

                    $abogados[$i]['Observaciones'] = NULL;
                    $abogados[$i]['fechaAsignacion'] = NULL;
                    $abogados[$i]['poliza'] = NULL;
                    $abogados[$i]['fechaAPoliza'] = NULL;
                    $abogados[$i]['fechaVPoliza'] = NULL;
                    $abogados[$i]['promotor'] = NULL;
                    $abogados[$i]['fechaFijacion'] = NULL;
                    $abogados[$i]['credito'] = NULL;
                    $abogados[$i]['noombres'] = NULL;
                    $abogados[$i]['SAP'] = NULL;

                }else{
                    foreach ($judicial as $key2) {

                        $fecha = NULL;
                        $fecha2 = NULL;
                        if(!is_null($key2->txtFechaIngreso)){
                            $fecha = explode(" ", $key2->txtFechaIngreso)[0];
                            $fecha = explode("-", $fecha);
                            $fecha = $fecha[2]."/". $fecha[1]."/". $fecha[0] ;
                            $fecha2 = $fecha[0].$fecha[1].$fecha[2];
                        }
                        
                        $fecha1  = NULL;
                        if(!is_null($key2->txtFechaTramite)){
                            $fecha1 = explode(" ", $key2->txtFechaTramite)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha1 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                        }

                        $fechaAbogado = NULL;

                        if(!is_null($key2->fechaabogado)){
                            $fechaAbogado2 = explode(" ", $key2->fechaabogado)[0];
                            $fechaAbogado2 = explode("-", $fechaAbogado2);
                            $fechaAbogado =  $fechaAbogado2[2]."/". $fechaAbogado2[1]."/". $fechaAbogado2[0];
                        }

                        $fechaAPoliza = NULL;
                        if(!is_null($key2->fecha_aprovacion)){
                            $fechaAPoliza2 = explode(" ", $key2->fecha_aprovacion)[0];
                            $fechaAPoliza2 = explode("-", $fechaAPoliza2);
                            $fechaAPoliza =  $fechaAPoliza2[2]."/". $fechaAPoliza2[1]."/". $fechaAbogado2[0];
                        }

                        $fechaVPoliza = NULL;
                        if(!is_null($key2->fecha_vencimiento)){
                            $fechaVPoliza2 = explode(" ", $key2->fecha_vencimiento)[0];
                            $ffechaVPoliza2 = explode("-", $fechaVPoliza2);
                            $fechaVPoliza =  $fechaVPoliza2[2]."/". $fechaVPoliza2[1]."/". $fechaVPoliza2[0];
                        }

                        $abogados[$i]['Etapa'] = utf8_encode($key2->Etapa) ;
                        $abogados[$i]['txtFechaIngreso'] =  $fecha;
                        $abogados[$i]['txtObservaciones'] = utf8_encode($key2->txtObservaciones) ;
                        $abogados[$i]['TipoProceso'] = utf8_encode($key2->claseProceso) ;
                        $abogados[$i]['users'] = utf8_encode($key2->users );
                        $abogados[$i]['txtFechaTramite'] =  $fecha1;
                        $abogados[$i]['actuacion'] = utf8_encode($key2->actuacion);
                        $abogados[$i]['Observaciones'] = utf8_encode($key2->txtObservaciones);
                        $abogados[$i]['fechaAsignacion'] = $fechaAbogado;
                        $abogados[$i]['poliza'] = $key2->poliza;
                        $abogados[$i]['fechaAPoliza'] = $fechaAPoliza;
                        $abogados[$i]['fechaVPoliza'] = $fechaVPoliza;
                        $abogados[$i]['promotor'] = NULL;
                        $abogados[$i]['fechaFijacion'] = NULL;
                        
                        
                        $abogados[$i]['credito'] = $key2->liquidacion;
                        $deudor = trim(utf8_encode($key2->abogado));
                        $nombre = substr($deudor, 0, 3);
                        $abogados[$i]['noombres'] = $deudor ;
                        $abogados[$i]['SAP'] = $key2->SAP;

                        $fechaAlla = NULL;
                        if(!is_null($key2->Fecha_radicacion_memorial)){
                            $fecha = explode(" ", $key2->Fecha_radicacion_memorial)[0];
                            $fecha = explode("-", $fecha);
                           
                            $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                        }
                        

                        
                        $fecha5 = NULL;
                        $sapan = NULL;
                        if(!is_null($key2->Fecha_pronunciamiento)){
                            $fecha1 = explode(" ", $key2->Fecha_pronunciamiento)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                            $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
                        }


                       
                        $abogados[$i]['radMemo'] = $fechaAlla ;
                        $abogados[$i]['Fechadecision'] = $fecha5 ;
                        $abogados[$i]['decision'] = $key2->Decision;


                    }
          
                }

                //aqui traigo la medida cautelar
                $medidas = $this->Wizard_Model->getMedidasCautelaresTotal_SAP_final($fechaInicial, $fechaFinal, $key->G735_C17138);
               
                if($medidas == 0){
                    $abogados[$i]['FechaSolicitud'] = NULL;
                    $abogados[$i]['FechaDecreto'] =  NULL;
                    $abogados[$i]['users'] =  NULL;
                    $abogados[$i]['Secuestre'] =  NULL;
                    $abogados[$i]['OtroBien'] =  NULL;
                    $abogados[$i]['Observaciones'] =  NULL;
                    $abogados[$i]['FechaInforme'] =  NULL;
                    $abogados[$i]['Medida'] =  NULL;
                    $abogados[$i]['calificar'] = NULL;
                }else{
                    foreach ($medidas as $key3) {
                       
                        $fechaAlla = NULL;
                        if(!is_null($key3->FechaPractica)){
                            $fecha = explode(" ", $key3->FechaPractica)[0];
                            $fecha = explode("-", $fecha);
                           
                            $fechaAlla = $fecha[2]."/". $fecha[1]."/". $fecha[0];
                        }
                        

                        
                        $fecha5 = NULL;
                        $sapan = NULL;
                        if(!is_null($key3->FechaSolicitud)){
                            $fecha1 = explode(" ", $key3->FechaSolicitud)[0];
                            $fecha1 = explode("-", $fecha1);
                            $fecha5 = $fecha1[2]."/". $fecha1[1]."/". $fecha1[0];
                            $sapan  = $fecha1[0].$fecha1[1].$fecha1[2];
                        }
                        

                        $fecha4 = NULL;
                        if(!is_null($key3->FechaDecreto)){
                            $fecha3 = explode(" ", $key3->FechaDecreto)[0];
                            $fecha3 = explode("-", $fecha3);
                            $fecha4 = $fecha3[2]."/". $fecha3[1]."/". $fecha3[0];
                        }
                        
                        $abogados[$i]['FechaSolicitud'] = $fecha5;
                        $abogados[$i]['FechaDecreto'] = $fecha4;
                        $abogados[$i]['users'] = utf8_encode($key3->users) ;
                        $abogados[$i]['Secuestre'] = utf8_encode($key3->Secuestre) ;
                        $abogados[$i]['OtroBien'] = utf8_encode($key3->OtroBien );
                        $abogados[$i]['Observaciones'] = utf8_encode($key3->Observaciones) ;
                        $abogados[$i]['FechaInforme'] =  $fechaAlla;
                        $abogados[$i]['Medida'] = utf8_encode($key3->Medida);
                    
                        if($key3->resultadoMedida == 'SI'){
                            $abogados[$i]['calificar'] = 'EFECTIVA';
                        }else if($key3->resultadoMedida == 'NO'){
                            $abogados[$i]['calificar'] = 'NO EFECTIVA';
                        }else{
                            $abogados[$i]['calificar'] = NULL;
                        }
                    }
                }

                $i++;
           // }
            
        }
        echo json_encode($abogados);
    }

}
?>