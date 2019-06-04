 <?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Utilidades extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function cambiarBotones(){
    	if($this->session->userdata('login_ok')){
            $data = array('title' => 'Cambio Botones FNG');
			      $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIutilidades');
			       
            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Utilidades/cambioBotones');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function cambiarImagenes(){
    	if($this->session->userdata('login_ok')){
          $Ruta = $_SERVER['SCRIPT_NAME'];
          $newRUta = explode('/', $Ruta);
          $Laverdadera = '';

          for ($i=0; $i < count($newRUta) - 1; $i++) { 
             if($i == 0){
                $Laverdadera = $newRUta[$i];
             }else{
                $Laverdadera .= '/'.$newRUta[$i];
             }
              
          }
          /*$targetPath = $_SERVER['DOCUMENT_ROOT'].'fng/assets/botones/extrajudicial/';
          $targetPathMedidas = $_SERVER['DOCUMENT_ROOT'].'fng/assets/img/medidas/';*/
          
          //TEST
      		$targetPath = $_SERVER['DOCUMENT_ROOT'].$Laverdadera.'/assets/botones/extrajudicial/';
          $targetPathMedidas = $_SERVER['DOCUMENT_ROOT'].$Laverdadera.'/assets/img/medidas/';
          //PRODUCCION
          /*$targetPath = $_SERVER['DOCUMENT_ROOT'].'CRMApps/secured/assets/botones/extrajudicial/';
          $targetPathMedidas = $_SERVER['DOCUMENT_ROOT'].'CRMApps/secured/assets/mg/medidas/';*/
/* Hoja de datos */
           	if($_POST['HidGesExtraJudicial'] == 1){
           		unlink($targetPath.'botones-70.png');
           		copy($_FILES['GesExtraJudicial']['tmp_name'], $targetPath.'botones-70.png');
           	}

           	if($_POST['HidGesJudicial'] == 1){
           		unlink($targetPath.'botones-71.png');
           		copy($_FILES['GesJudicial']['tmp_name'], $targetPath.'botones-71.png');
           	}


           	if($_POST['HidSimulador'] == 1){
           		unlink($targetPath.'botones-72.png');
           		copy($_FILES['Simulador']['tmp_name'], $targetPath.'botones-72.png');
           	}


           	if($_POST['HidGestionarTodas'] == 1){
           		unlink($targetPath.'botones-69.png');
           		copy($_FILES['GestionarTodas']['tmp_name'], $targetPath.'botones-69.png');
           	}

           	if($_POST['HidLibretoCall'] == 1){
           		unlink($targetPath.'botones-68.png');
           		copy($_FILES['LibretoCall']['tmp_name'], $targetPath.'botones-68.png');
           	}



/* Judicial */

           	if($_POST['HidMisprocesosVigentes'] == 1){
           		unlink($targetPath.'botones-73.png');
           		copy($_FILES['MisprocesosVigentes']['tmp_name'], $targetPath.'botones-73.png');
           	}


           	if($_POST['HidMisprocesosIrrecuperables'] == 1){
           		unlink($targetPath.'botones-74.png');
           		copy($_FILES['MisprocesosIrrecuperables']['tmp_name'], $targetPath.'botones-74.png');
           	}

           	if($_POST['HidMisProcesosVendidos'] == 1){
           		unlink($targetPath.'botones-75.png');
           		copy($_FILES['MisProcesosVendidos']['tmp_name'], $targetPath.'botones-75.png');
           	}

           	if($_POST['HidBusquedaAvanzada'] == 1){
           		unlink($targetPath.'botones-77.png');
           		copy($_FILES['BusquedaAvanzada']['tmp_name'], $targetPath.'botones-77.png');
           	}


           	if($_POST['HidMisProcesosPazYsalvo'] == 1){
           		unlink($targetPath.'botones-78.png');
           		copy($_FILES['MisProcesosPazYsalvo']['tmp_name'], $targetPath.'botones-78.png');
           	}




/* Extrajudicial */
           	if($_POST['HidClientesNuevos'] == 1){
           		unlink($targetPath.'botones-43.png');
           		copy($_FILES['ClientesNuevos']['tmp_name'], $targetPath.'botones-43.png');
           	}

           	if($_POST['HidClienteDatosNuevos'] == 1){
           		unlink($targetPath.'botones-44.png');
           		copy($_FILES['ClienteDatosNuevos']['tmp_name'], $targetPath.'botones-44.png');
           	}


           	if($_POST['HidVlaorAdeudado'] == 1){
           		unlink($targetPath.'botones-45.png');
           		copy($_FILES['VlaorAdeudado']['tmp_name'], $targetPath.'botones-45.png');
           	}

           	if($_POST['HidAcuerdoDepago'] == 1){
           		unlink($targetPath.'botones-46.png');
           		copy($_FILES['AcuerdoDepago']['tmp_name'], $targetPath.'botones-46.png');
           	}

           	if($_POST['HidClientesVigentesExtrajudicial'] == 1){
           		unlink($targetPath.'botones-48.png');
           		copy($_FILES['ClientesVigentesExtrajudicial']['tmp_name'], $targetPath.'botones-48.png');
           	}

           	if($_POST['HidBusquedavanzadaExtrajudicial'] == 1){
           		unlink($targetPath.'botones-49.png');
           		copy($_FILES['BusquedavanzadaExtrajudicial']['tmp_name'], $targetPath.'botones-49.png');
           	}


       		if($_POST['HidObligacionesVendidas'] == 1){
           		unlink($targetPath.'botones-66.png');
           		copy($_FILES['ObligacionesVendidas']['tmp_name'], $targetPath.'botones-66.png');
           	}

           	if($_POST['HidPazySalv'] == 1){
           		unlink($targetPath.'botones-65.png');
           		copy($_FILES['PazySalv']['tmp_name'], $targetPath.'botones-65.png');
           	}

           	if($_POST['HidBoton1'] == 1){
           		unlink($targetPath.'botones-50.png');
           		copy($_FILES['Boton1']['tmp_name'], $targetPath.'botones-50.png');
           	}

           	if($_POST['HidBoton2'] == 1){
           		unlink($targetPath.'botones-51.png');
           		copy($_FILES['Boton2']['tmp_name'], $targetPath.'botones-51.png');
           	}

           	if($_POST['HidBoton3'] == 1){
           		unlink($targetPath.'botones-52.png');
           		copy($_FILES['Boton3']['tmp_name'], $targetPath.'botones-52.png');
           	}

           	if($_POST['HidBoton4'] == 1){
           		unlink($targetPath.'botones-53.png');
           		copy($_FILES['Boton4']['tmp_name'], $targetPath.'botones-53.png');
           	}

           	if($_POST['HidBoton5'] == 1){
           		unlink($targetPath.'botones-54.png');
           		copy($_FILES['Boton5']['tmp_name'], $targetPath.'botones-54.png');
           	}


            /* Medidas cautelares */
            if($_POST['HidembargoInmueble'] == 1){
              unlink($targetPathMedidas.'embargoInmueble.png');
              copy($_FILES['embargoInmueble']['tmp_name'], $targetPathMedidas.'embargoInmueble.png');
            }

            if($_POST['HidembargoVehiculo'] == 1){
              unlink($targetPathMedidas.'embargoVehiculo.png');
              copy($_FILES['embargoVehiculo']['tmp_name'], $targetPathMedidas.'embargoVehiculo.png');
            }

            if($_POST['HidembargoEstabComercio'] == 1){
              unlink($targetPathMedidas.'embargoEstabComercio.png');
              copy($_FILES['embargoEstabComercio']['tmp_name'], $targetPathMedidas.'embargoEstabComercio.png');
            }

            if($_POST['HidembargoRetenSalario'] == 1){
              unlink($targetPathMedidas.'embargoRetenSalario.png');
              copy($_FILES['embargoRetenSalario']['tmp_name'], $targetPathMedidas.'embargoRetenSalario.png');
            }

            if($_POST['HidembargoRetenCuentasAhCorr'] == 1){
              unlink($targetPathMedidas.'embargoRetenCuentasAhCorr.png');
              copy($_FILES['embargoRetenCuentasAhCorr']['tmp_name'], $targetPathMedidas.'embargoRetenCuentasAhCorr.png');
            }

            if($_POST['HidembargoRemanentes'] == 1){
              unlink($targetPathMedidas.'embargoRemanentes.png');
              copy($_FILES['embargoRemanentes']['tmp_name'], $targetPathMedidas.'embargoRemanentes.png');
            }

            if($_POST['HidembargoSecuestroBienes'] == 1){
              unlink($targetPathMedidas.'embargoSecuestroBienes.png');
              copy($_FILES['embargoSecuestroBienes']['tmp_name'], $targetPathMedidas.'embargoSecuestroBienes.png');
            }

            if($_POST['HidembargoRazonSocial'] == 1){
              unlink($targetPathMedidas.'embargoRazonSocial.png');
              copy($_FILES['embargoRazonSocial']['tmp_name'], $targetPathMedidas.'embargoRazonSocial.png');
            }

            if($_POST['HidembargoMaqEquipo'] == 1){
              unlink($targetPathMedidas.'embargoMaqEquipo.png');
              copy($_FILES['embargoMaqEquipo']['tmp_name'], $targetPathMedidas.'embargoMaqEquipo.png');
            }

            if($_POST['HidembargoAcciones'] == 1){
              unlink($targetPathMedidas.'embargoAcciones.png');
              copy($_FILES['embargoAcciones']['tmp_name'], $targetPathMedidas.'embargoAcciones.png');
            }

            if($_POST['HidembargoCuotasParticipacion'] == 1){
              unlink($targetPathMedidas.'embargoCuotasParticipacion.png');
              copy($_FILES['embargoCuotasParticipacion']['tmp_name'], $targetPathMedidas.'embargoCuotasParticipacion.png');
            }

            if($_POST['HidembargoPosesion'] == 1){
              unlink($targetPathMedidas.'embargoPosesion.png');
              copy($_FILES['embargoPosesion']['tmp_name'], $targetPathMedidas.'embargoPosesion.png');
            }

            if($_POST['HidembargoCreditos'] == 1){
              unlink($targetPathMedidas.'embargoCreditos.png');
              copy($_FILES['embargoCreditos']['tmp_name'], $targetPathMedidas.'embargoCreditos.png');
            }

            if($_POST['HidembargoUsufructo'] == 1){
              unlink($targetPathMedidas.'embargoUsufructo.png');
              copy($_FILES['embargoUsufructo']['tmp_name'], $targetPathMedidas.'embargoUsufructo.png');
            }

            if($_POST['HidembargoGarantiaInmob'] == 1){
              unlink($targetPathMedidas.'embargoGarantiaInmob.png');
              copy($_FILES['embargoGarantiaInmob']['tmp_name'], $targetPathMedidas.'embargoGarantiaInmob.png');
            }


           	echo '1';
        }else{
            echo 'No pudes ver este contenido';
        }
    }

}