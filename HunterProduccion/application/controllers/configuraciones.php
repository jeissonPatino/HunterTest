<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');
require_once APPPATH.'controllers/login.php';
class Configuraciones extends Login {

    public function __construct() {
        parent::__construct();
        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
        $this->load->model('Reportes_Model');
    }

    public function generales() {

        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Configuraciones Generales');
            $minimo = $this->Configuraciones_Model->getMinimo();
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIsalario');

            $datos = array('minimo' => $minimo);
            
            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Configuraciones/generales', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
        

       
    }

    function eliminardatos(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G758', $_POST['id'], 'G758_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function guardarDatos(){
        if($this->session->userdata('login_ok')){
            $datos  = array('G758_C17367' => $_POST['minimo'] );
           // $this->Configuraciones_Model->delete();
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G758', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G758', $datos, $_POST['id'], 'G758_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            echo "No tienes permiso para ver esto!";
        }
    }

    //crear usuarios
    function crear_Users(){
         if($this->session->userdata('login_ok')){
            $data = array('title' => 'Configuraciones Generales');
            $minimo = $this->Configuraciones_Model->getUsuarios();
            $frg  = $this->Configuraciones_Model->getFrgs();

            $datas = array();
            $i= 0;
            foreach ($minimo as $key) {

                $datas[$i]['codigo'] = utf8_encode($key->codigo) ;
                $datas[$i]['nombres'] = utf8_encode($key->nombres) ;
                $datas[$i]['identificacion'] = $key->identificacion ;
                $datas[$i]['cargo'] = utf8_encode($key->cargo) ;
                $datas[$i]['id'] = $key->id ;
           
                $i++;

            }
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIUsers');

            $datos = array('usuarios' => json_encode($datas), 'frgs' => $frg);
            
            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Configuraciones/usuarios', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
        
    }

    function eliminarUsuario(){
        if($this->session->userdata('login_ok')){
            $usuario = $this->session->userdata('nombres');
            $id = $this->session->userdata('identificacion');
            $resultado = false;
            $usuarioE = $_POST['id'];
            $usuarioEli = $this->Reportes_Model->LlenarTablaLogeliminacionUsuarios($usuario,$id,$usuarioE);

            $resultado = $this->Wizard_Model->borrarDatos('USUARI', $_POST['id'], 'USUARI_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

   

    function guardarusuario(){
        if($this->session->userdata('login_ok')){
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");
            $contr = 0;
            if(isset($_POST['txPassword'])){
                if($_POST['txPassword'] != ''){
                    $contr = $this->encriptaPassword($_POST['txPassword']);
                }
            }
           


            $USUARI_asignacion_abogados_p = 0;
            $USUARI_asignacion_gestores_p = 0;
            $USUARI_configuracion_abogados_p = 0;
            $USUARI_configuracion_actuaciones_p = 0;
            $USUARI_configuracion_acuerdos_p = 0;
            $USUARI_configuracion_ciudades_p = 0;
            $USUARI_configuracion_salario_p = 0;
            $USUARI_configuracion_despachos_p = 0;
            $USUARI_configuracion_etapas_p = 0;
            $USUARI_configuracion_facturas_p = 0;
            $USUARI_configuracion_gastos_p = 0;
            $USUARI_configuracion_FRG_p = 0;
            $USUARI_configuracion_subgestiones_p = 0;
            $USUARI_configuracion_usuarios_p = 0;
            $USUARI_gestion_extrajudicial_p = 0;
            $USUARI_gestion_judicial_p = 0;
            $USUARI_gestion_exfuncionarios_p = 0;
            $USUARI_historico_extrajudicial_p = 0;
            $USUARI_historico_judicial_p = 0;
            $USUARI_historico_medidas_p = 0;
            $USUARI_configuracion_eliminarObligaciones_p = 0;

            $cargar_fecha_terminacion_permisos_ = 0;
            $Eliminar_Facturas_permisos_ = 0;
            $GestionarDatosClientes = 0;

            $EliminarGestores = 0;
            $Logeliminacion = 0;

            $Rep_asignacion_abogados_permiso_ = 0;
            $Rep_gestion_judicial_mensual_permiso_ = 0;
            $Rep_subrogaciones_efectivas_permiso_ = 0;
            $Rep_soporte_cisa_permiso_ = 0;
            $Rep_radicacion_memorial_permiso_ = 0;
            $Rep_gestion_judicial_permiso_ = 0;
            $Rep_reporte_medidas_cautelares_permiso_ = 0;
            $Rep_medidas_cautelares_efectivas_permiso_ = 0;


            $firmas_abogados_permiso_ = 0;
            $configurar_valores_conceptos_permisos_ = 0;
            $cargar_devolucion_subrogaciones_permisos_ = 0;
            $cargar_envio_subrogaciones_permisos_ = 0;
            $subrogacion_permiso_ = 0;
            $Sentencia_irrecuperable_permiso_ = 0;
            $cisa_permiso_ = 0;
            $gastos_judiciales_permiso_ = 0;

            $Exportar_datos_adicionales_permisos_ = 0;
            $Eliminar_Gestiones_judiciales_permisos_ = 0;



            $frg = 0;
            if(isset($_POST['cargar_fecha_terminacion_permisos_'])) $cargar_fecha_terminacion_permisos_ = $_POST['cargar_fecha_terminacion_permisos_'];
            if(isset($_POST['Eliminar_Facturas_permisos_'])) $Eliminar_Facturas_permisos_ = $_POST['Eliminar_Facturas_permisos_'];
            if(isset($_POST['GestionarDatosClientes'])) $GestionarDatosClientes = $_POST['GestionarDatosClientes'];

            if(isset($_POST['EliminarGestores_EliminarAbogados'])) $EliminarGestores = $_POST['EliminarGestores_EliminarAbogados'];

            if(isset($_POST['Logeliminar_Datos'])) $Logeliminacion = $_POST['Logeliminar_Datos'];

            if(isset($_POST['selFrg'])) $frg = $_POST['selFrg'];
            if(isset($_POST['abogados'])) $USUARI_asignacion_abogados_p = $_POST['abogados'];
            if(isset($_POST['gestores'])) $USUARI_asignacion_gestores_p = $_POST['gestores'];
            if(isset($_POST['abogadosC'])) $USUARI_configuracion_abogados_p = $_POST['abogadosC'];
            if(isset($_POST['actuaciones'])) $USUARI_configuracion_actuaciones_p = $_POST['actuaciones'];
            if(isset($_POST['acuerdos'])) $USUARI_configuracion_acuerdos_p = $_POST['acuerdos'];
            if(isset($_POST['ciudades'])) $USUARI_configuracion_ciudades_p = $_POST['ciudades'];
            if(isset($_POST['salario'])) $USUARI_configuracion_salario_p = $_POST['salario'];
            if(isset($_POST['despachos'])) $USUARI_configuracion_despachos_p = $_POST['despachos'];
            if(isset($_POST['etapas'])) $USUARI_configuracion_etapas_p = $_POST['etapas'];
            if(isset($_POST['facturas'])) $USUARI_configuracion_facturas_p = $_POST['facturas'];
            if(isset($_POST['gastos'])) $USUARI_configuracion_gastos_p = $_POST['gastos'];
            if(isset($_POST['frg'])) $USUARI_configuracion_FRG_p = $_POST['frg'];
            if(isset($_POST['subgestiones'])) $USUARI_configuracion_subgestiones_p = $_POST['subgestiones'];
            if(isset($_POST['usuarios'])) $USUARI_configuracion_usuarios_p = $_POST['usuarios'];
            if(isset($_POST['carteraextrajudicial'])) $USUARI_gestion_extrajudicial_p = $_POST['carteraextrajudicial'];
            if(isset($_POST['carterajudicial'])) $USUARI_gestion_judicial_p = $_POST['carterajudicial'];
            if(isset($_POST['carteraexfuncionarios'])) $USUARI_gestion_exfuncionarios_p = $_POST['carteraexfuncionarios'];
            if(isset($_POST['historicoextrajudicial'])) $USUARI_historico_extrajudicial_p = $_POST['historicoextrajudicial'];
            if(isset($_POST['historicojudicial'])) $USUARI_historico_judicial_p = $_POST['historicojudicial'];
            if(isset($_POST['historicomedidascautelares'])) $USUARI_historico_medidas_p = $_POST['historicomedidascautelares'];
            if(isset($_POST['obligaciones'])) $USUARI_configuracion_eliminarObligaciones_p = $_POST['obligaciones'];

            if(isset($_POST['reporte_1'])) $Rep_asignacion_abogados_permiso_ = $_POST['reporte_1'];
            if(isset($_POST['reporte_2'])) $Rep_gestion_judicial_mensual_permiso_ = $_POST['reporte_2'];
            if(isset($_POST['reporte_3'])) $Rep_subrogaciones_efectivas_permiso_ = $_POST['reporte_3'];
            if(isset($_POST['reporte_4'])) $Rep_soporte_cisa_permiso_ = $_POST['reporte_4'];
            if(isset($_POST['reporte_5'])) $Rep_radicacion_memorial_permiso_ = $_POST['reporte_5'];
            if(isset($_POST['reporte_6'])) $Rep_gestion_judicial_permiso_ = $_POST['reporte_6'];
            if(isset($_POST['reporte_7'])) $Rep_reporte_medidas_cautelares_permiso_ = $_POST['reporte_7'];
            if(isset($_POST['reporte_8'])) $Rep_medidas_cautelares_efectivas_permiso_ = $_POST['reporte_8'];

            if(isset($_POST['firmas_abogados_permiso_'])) $firmas_abogados_permiso_ = $_POST['firmas_abogados_permiso_'];
            if(isset($_POST['configurar_valores_conceptos_permisos_'])) $configurar_valores_conceptos_permisos_ = $_POST['configurar_valores_conceptos_permisos_'];
            if(isset($_POST['cargar_devolucion_subrogaciones_permisos_'])) $cargar_devolucion_subrogaciones_permisos_ = $_POST['cargar_devolucion_subrogaciones_permisos_'];
            if(isset($_POST['cargar_envio_subrogaciones_permisos_'])) $cargar_envio_subrogaciones_permisos_ = $_POST['cargar_envio_subrogaciones_permisos_'];

            if(isset($_POST['subrogacion_permiso_'])) $subrogacion_permiso_ = $_POST['subrogacion_permiso_'];
            if(isset($_POST['Sentencia_irrecuperable_permiso_'])) $Sentencia_irrecuperable_permiso_ = $_POST['Sentencia_irrecuperable_permiso_'];
            if(isset($_POST['cisa_permiso_'])) $cisa_permiso_ = $_POST['cisa_permiso_'];
            if(isset($_POST['gastos_judiciales_permiso_'])) $gastos_judiciales_permiso_ = $_POST['gastos_judiciales_permiso_'];


            if(isset($_POST['Exportar_datos_adicionales_permisos_'])) $Exportar_datos_adicionales_permisos_ = $_POST['Exportar_datos_adicionales_permisos_'];
            if(isset($_POST['Eliminar_Gestiones_judiciales_permisos_'])) $Eliminar_Gestiones_judiciales_permisos_ = $_POST['Eliminar_Gestiones_judiciales_permisos_'];

            $datos  = array();

            if($contr == 0){
                $datos  = array(
                            'USUARI_Codigo____b' => utf8_decode($_POST['txtUsuario']),
                            'USUARI_Nombre____b' => utf8_decode($_POST['txtNombre']),
                            'USUARI_Cargo_____b' => $_POST['selCargo'],
                            'USUARI_Identific_b' => $_POST['txtIdentifiaccaion'],
                            'USUARI_Bloqueado_b' => 0,
                            'USUARI_FechCrea__b' => $fechaIngreso,

                            'USUARI_asignacion_abogados_p' => $USUARI_asignacion_abogados_p,
                            'USUARI_asignacion_gestores_p' => $USUARI_asignacion_gestores_p,
                            'USUARI_configuracion_abogados_p' => $USUARI_configuracion_abogados_p,
                            'USUARI_configuracion_actuaciones_p' => $USUARI_configuracion_actuaciones_p,
                            'USUARI_configuracion_acuerdos_p' => $USUARI_configuracion_acuerdos_p,
                            'USUARI_configuracion_ciudades_p' => $USUARI_configuracion_ciudades_p,
                            'USUARI_configuracion_salario_p' => $USUARI_configuracion_salario_p,
                            'USUARI_configuracion_despachos_p' => $USUARI_configuracion_despachos_p,
                            'USUARI_configuracion_etapas_p' => $USUARI_configuracion_etapas_p,
                            'USUARI_configuracion_facturas_p' => $USUARI_configuracion_facturas_p,
                            'USUARI_configuracion_gastos_p' => $USUARI_configuracion_gastos_p,
                            'USUARI_configuracion_FRG_p' => $USUARI_configuracion_FRG_p,
                            'USUARI_configuracion_subgestiones_p' => $USUARI_configuracion_subgestiones_p,
                            'USUARI_configuracion_usuarios_p' => $USUARI_configuracion_usuarios_p,
                            'USUARI_gestion_extrajudicial_p' => $USUARI_gestion_extrajudicial_p,
                            'USUARI_gestion_judicial_p' => $USUARI_gestion_judicial_p,
                            'USUARI_gestion_exfuncionarios_p' => $USUARI_gestion_exfuncionarios_p,
                            'USUARI_historico_extrajudicial_p' => $USUARI_historico_extrajudicial_p,
                            'USUARI_historico_judicial_p' => $USUARI_historico_judicial_p,
                            'USUARI_historico_medidas_p' => $USUARI_historico_medidas_p,
                            'Rep_asignacion_abogados_permiso_' => $Rep_asignacion_abogados_permiso_,
                            'Rep_gestion_judicial_mensual_permiso_' => $Rep_gestion_judicial_mensual_permiso_,
                            'Rep_subrogaciones_efectivas_permiso_' => $Rep_subrogaciones_efectivas_permiso_,
                            'Rep_soporte_cisa_permiso_' => $Rep_soporte_cisa_permiso_,
                            'Rep_radicacion_memorial_permiso_' => $Rep_radicacion_memorial_permiso_,
                            'Rep_gestion_judicial_permiso_' => $Rep_gestion_judicial_permiso_,
                            'Rep_reporte_medidas_cautelares_permiso_' => $Rep_reporte_medidas_cautelares_permiso_,
                            'Rep_medidas_cautelares_efectivas_permiso_' => $Rep_medidas_cautelares_efectivas_permiso_,

                            'firmas_abogados_permiso_' => $firmas_abogados_permiso_,
                            'configurar_valores_conceptos_permisos_' => $configurar_valores_conceptos_permisos_,
                            'cargar_devolucion_subrogaciones_permisos_' => $cargar_devolucion_subrogaciones_permisos_,
                            'cargar_envio_subrogaciones_permisos_' => $cargar_envio_subrogaciones_permisos_,
                            'subrogacion_permiso_' => $subrogacion_permiso_,
                            'Sentencia_irrecuperable_permiso_' => $Sentencia_irrecuperable_permiso_,
                            'cisa_permiso_' => $cisa_permiso_,
                            'gastos_judiciales_permiso_' => $gastos_judiciales_permiso_,

                            'USUARI_configuracion_eliminarObligaciones_p' => $USUARI_configuracion_eliminarObligaciones_p,
                            'USUARI_LlaveExte_b' => $frg,
                            'cargar_fecha_terminacion_permisos_' => $cargar_fecha_terminacion_permisos_ ,
                            'Eliminar_Facturas_permisos_' => $Eliminar_Facturas_permisos_,

                            'GestionarDatosClientes' => $GestionarDatosClientes,

                            'EliminarGestores' => $EliminarGestores,

                            'Logeliminacion' => $Logeliminacion,


                            'Exportar_datos_adicionales_permisos_' => $Exportar_datos_adicionales_permisos_ ,
                            'Eliminar_Gestiones_judiciales_permisos_' => $Eliminar_Gestiones_judiciales_permisos_
                             );
            }else{
                $datos  = array(
                            'USUARI_Codigo____b' => utf8_decode($_POST['txtUsuario']),
                            'USUARI_Nombre____b' => utf8_decode($_POST['txtNombre']),
                            'USUARI_Cargo_____b' => $_POST['selCargo'],
                            'USUARI_Identific_b' => $_POST['txtIdentifiaccaion'],
                            'USUARI_Clave_____b' => $contr,
                            'USUARI_Bloqueado_b' => 0,
                            'USUARI_FechCrea__b' => $fechaIngreso,

                            'USUARI_asignacion_abogados_p' => $USUARI_asignacion_abogados_p,
                            'USUARI_asignacion_gestores_p' => $USUARI_asignacion_gestores_p,
                            'USUARI_configuracion_abogados_p' => $USUARI_configuracion_abogados_p,
                            'USUARI_configuracion_actuaciones_p' => $USUARI_configuracion_actuaciones_p,
                            'USUARI_configuracion_acuerdos_p' => $USUARI_configuracion_acuerdos_p,
                            'USUARI_configuracion_ciudades_p' => $USUARI_configuracion_ciudades_p,
                            'USUARI_configuracion_salario_p' => $USUARI_configuracion_salario_p,
                            'USUARI_configuracion_despachos_p' => $USUARI_configuracion_despachos_p,
                            'USUARI_configuracion_etapas_p' => $USUARI_configuracion_etapas_p,
                            'USUARI_configuracion_facturas_p' => $USUARI_configuracion_facturas_p,
                            'USUARI_configuracion_gastos_p' => $USUARI_configuracion_gastos_p,
                            'USUARI_configuracion_FRG_p' => $USUARI_configuracion_FRG_p,
                            'USUARI_configuracion_subgestiones_p' => $USUARI_configuracion_subgestiones_p,
                            'USUARI_configuracion_usuarios_p' => $USUARI_configuracion_usuarios_p,
                            'USUARI_gestion_extrajudicial_p' => $USUARI_gestion_extrajudicial_p,
                            'USUARI_gestion_judicial_p' => $USUARI_gestion_judicial_p,
                            'USUARI_gestion_exfuncionarios_p' => $USUARI_gestion_exfuncionarios_p,
                            'USUARI_historico_extrajudicial_p' => $USUARI_historico_extrajudicial_p,
                            'USUARI_historico_judicial_p' => $USUARI_historico_judicial_p,
                            'USUARI_historico_medidas_p' => $USUARI_historico_medidas_p,
                            'Rep_asignacion_abogados_permiso_' => $Rep_asignacion_abogados_permiso_,
                            'Rep_gestion_judicial_mensual_permiso_' => $Rep_gestion_judicial_mensual_permiso_,
                            'Rep_subrogaciones_efectivas_permiso_' => $Rep_subrogaciones_efectivas_permiso_,
                            'Rep_soporte_cisa_permiso_' => $Rep_soporte_cisa_permiso_,
                            'Rep_radicacion_memorial_permiso_' => $Rep_radicacion_memorial_permiso_,
                            'Rep_gestion_judicial_permiso_' => $Rep_gestion_judicial_permiso_,
                            'Rep_reporte_medidas_cautelares_permiso_' => $Rep_reporte_medidas_cautelares_permiso_,
                            'Rep_medidas_cautelares_efectivas_permiso_' => $Rep_medidas_cautelares_efectivas_permiso_,

                            'firmas_abogados_permiso_' => $firmas_abogados_permiso_,
                            'configurar_valores_conceptos_permisos_' => $configurar_valores_conceptos_permisos_,
                            'cargar_devolucion_subrogaciones_permisos_' => $cargar_devolucion_subrogaciones_permisos_,
                            'cargar_envio_subrogaciones_permisos_' => $cargar_envio_subrogaciones_permisos_,
                            'subrogacion_permiso_' => $subrogacion_permiso_,
                            'Sentencia_irrecuperable_permiso_' => $Sentencia_irrecuperable_permiso_,
                            'cisa_permiso_' => $cisa_permiso_,
                            'gastos_judiciales_permiso_' => $gastos_judiciales_permiso_,


                            'USUARI_LlaveExte_b' => $frg,
                            'USUARI_configuracion_eliminarObligaciones_p' => $USUARI_configuracion_eliminarObligaciones_p,
                            'cargar_fecha_terminacion_permisos_' => $cargar_fecha_terminacion_permisos_ ,
                            'Eliminar_Facturas_permisos_' => $Eliminar_Facturas_permisos_,

                            'GestionarDatosClientes' => $GestionarDatosClientes,
                            'EliminarGestores' => $EliminarGestores,
                            'Logeliminacion' => $Logeliminacion,

                            'Exportar_datos_adicionales_permisos_' => $Exportar_datos_adicionales_permisos_ ,
                            'Eliminar_Gestiones_judiciales_permisos_' => $Eliminar_Gestiones_judiciales_permisos_
                             );
            }
            
     
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('USUARI', $datos);
                
            }else{
                $resultado = $this->Wizard_Model->editarDatos('USUARI', $datos, $_POST['id'], 'USUARI_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            echo "No tienes permiso para ver esto!";
        }
    }

    function getDatosUsuario($consinte){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getUsuariosByid($consinte);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['codigo'] = utf8_encode($key->codigo);
                $datos[$i]['nombres'] = utf8_encode($key->nombres);
                $datos[$i]['identificacion'] = $key->identificacion;
                $datos[$i]['cargo'] = $key->cargo;
                $datos[$i]['USUARI_asignacion_abogados_p'] = $key->USUARI_asignacion_abogados_p;
                $datos[$i]['USUARI_asignacion_gestores_p'] = $key->USUARI_asignacion_gestores_p;
                $datos[$i]['USUARI_configuracion_abogados_p'] = $key->USUARI_configuracion_abogados_p;
                $datos[$i]['USUARI_configuracion_actuaciones_p'] = $key->USUARI_configuracion_actuaciones_p;
                $datos[$i]['USUARI_configuracion_acuerdos_p'] = $key->USUARI_configuracion_acuerdos_p;
                $datos[$i]['USUARI_configuracion_ciudades_p'] = $key->USUARI_configuracion_ciudades_p;
                $datos[$i]['USUARI_configuracion_salario_p'] = $key->USUARI_configuracion_salario_p;
                $datos[$i]['USUARI_configuracion_despachos_p'] = $key->USUARI_configuracion_despachos_p;
                $datos[$i]['USUARI_configuracion_etapas_p'] = $key->USUARI_configuracion_etapas_p;
                $datos[$i]['USUARI_configuracion_facturas_p'] = $key->USUARI_configuracion_facturas_p;
                $datos[$i]['USUARI_configuracion_gastos_p'] = $key->USUARI_configuracion_gastos_p;
                $datos[$i]['USUARI_configuracion_FRG_p'] = $key->USUARI_configuracion_FRG_p;
                $datos[$i]['USUARI_configuracion_subgestiones_p'] = $key->USUARI_configuracion_subgestiones_p;
                $datos[$i]['USUARI_configuracion_usuarios_p'] = $key->USUARI_configuracion_usuarios_p;
                $datos[$i]['USUARI_gestion_extrajudicial_p'] = $key->USUARI_gestion_extrajudicial_p;
                $datos[$i]['USUARI_gestion_judicial_p'] = $key->USUARI_gestion_judicial_p;
                $datos[$i]['USUARI_gestion_exfuncionarios_p'] = $key->USUARI_gestion_exfuncionarios_p;
                $datos[$i]['USUARI_historico_extrajudicial_p'] = $key->USUARI_historico_extrajudicial_p;
                $datos[$i]['USUARI_historico_judicial_p'] = $key->USUARI_historico_judicial_p;
                $datos[$i]['USUARI_historico_medidas_p'] = $key->USUARI_historico_medidas_p;

                $datos[$i]['Rep_asignacion_abogados_permiso_'] = $key->Rep_asignacion_abogados_permiso_;
                $datos[$i]['Rep_gestion_judicial_mensual_permiso_'] = $key->Rep_gestion_judicial_mensual_permiso_;
                $datos[$i]['Rep_subrogaciones_efectivas_permiso_'] = $key->Rep_subrogaciones_efectivas_permiso_;
                $datos[$i]['Rep_soporte_cisa_permiso_'] = $key->Rep_soporte_cisa_permiso_;
                $datos[$i]['Rep_radicacion_memorial_permiso_'] = $key->Rep_radicacion_memorial_permiso_;
                $datos[$i]['Rep_gestion_judicial_permiso_'] = $key->Rep_gestion_judicial_permiso_;
                $datos[$i]['Rep_reporte_medidas_cautelares_permiso_'] = $key->Rep_reporte_medidas_cautelares_permiso_;
                $datos[$i]['Rep_medidas_cautelares_efectivas_permiso_'] = $key->Rep_medidas_cautelares_efectivas_permiso_;

                $datos[$i]['USUARI_configuracion_eliminarObligaciones_p'] = $key->USUARI_configuracion_eliminarObligaciones_p;
                $datos[$i]['USUARI_LlaveExte_b'] = $key->USUARI_LlaveExte_b;

                $datos[$i]['firmas_abogados_permiso_'] = $key->firmas_abogados_permiso_;
                $datos[$i]['configurar_valores_conceptos_permisos_'] = $key->configurar_valores_conceptos_permisos_;
                $datos[$i]['cargar_devolucion_subrogaciones_permisos_'] = $key->cargar_devolucion_subrogaciones_permisos_;
                $datos[$i]['cargar_envio_subrogaciones_permisos_'] = $key->cargar_envio_subrogaciones_permisos_;
                $datos[$i]['subrogacion_permiso_'] = $key->subrogacion_permiso_;
                $datos[$i]['Sentencia_irrecuperable_permiso_'] = $key->Sentencia_irrecuperable_permiso_;
                $datos[$i]['cisa_permiso_'] = $key->cisa_permiso_;
                $datos[$i]['gastos_judiciales_permiso_'] = $key->gastos_judiciales_permiso_;
                $datos[$i]['cargar_fecha_terminacion_permisos_'] = $key->cargar_fecha_terminacion_permisos_;
                $datos[$i]['Eliminar_Facturas_permisos_'] = $key->Eliminar_Facturas_permisos_;
                $datos[$i]['GestionarDatosClientes'] = $key->GestionarDatosClientes;

                $datos[$i]['EliminarGestores'] = $key->EliminarGestores;

                $datos[$i]['Logeliminacion'] = $key->Logeliminacion;

                $datos[$i]['Exportar_datos_adicionales_permisos_'] = $key->Exportar_datos_adicionales_permisos_;
                $datos[$i]['Eliminar_Gestiones_judiciales_permisos_'] = $key->Eliminar_Gestiones_judiciales_permisos_;

                
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }
 



    //Aqui se parametrisan los reportes

    public function reportes(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Configuraciones Generales');
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIreportesconfig'); 

            $reportes = $this->Reportes_Model->getReportesDataBase();
            $datos = array('reportes' => $reportes);
            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Configuraciones/reportes', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }  

    public function guardarParametros(){
        if($this->session->userdata('login_ok')){
            if(isset($_POST['meta']) && isset($_POST['ejecucionTiempo'])){

                $this->db->where('par_rep_id', $_POST['idRporte']);
                $this->db->delete('Parametros_reportes'); 

                $datos = array('par_meta'=> $_POST['meta'], 'par_tiempo_asignacion' => $_POST['ejecucionTiempo'], 'par_rep_id' => $_POST['idRporte']);
                $resultado = $this->Wizard_Model->guardardatos('Parametros_reportes', $datos);
                
                if( $resultado ){
                    echo "1";
                }else{
                    echo "No";
                }
            }else if(isset($_POST['numeroObligaciones'])){
                $this->db->where('par_rep_id', $_POST['idRporte']);
                $this->db->delete('Parametros_reportes'); 
                $datos = array('cant_obligaciones'=> $_POST['numeroObligaciones'], 'par_rep_id' => $_POST['idRporte']);
                $resultado = $this->Wizard_Model->guardardatos('Parametros_reportes', $datos);
                
                if( $resultado ){
                    echo "1";
                }else{
                    echo "No";
                }

            }else if(isset($_POST['metaabogados'])){
                $this->db->where('par_rep_id', $_POST['idRporte']);
                $this->db->delete('Parametros_reportes'); 
                $datos = array( 'par_meta'=> $_POST['metaabogados'], 
                                'par_tiempo_asignacion' =>$_POST['diastrancurridos'],
                                'par_rep_id' => $_POST['idRporte']);
                $resultado = $this->Wizard_Model->guardardatos('Parametros_reportes', $datos);
                
                if( $resultado ){
                    echo "1";
                }else{
                    echo "No";
                }
            }
        }else{
            echo "No tienes permisos para ver este contenido!";
        }
    }  

    public function GetdatosReporte($id){
        if($this->session->userdata('login_ok')){
            $reporteDatos = $this->db->get_where('Parametros_reportes',array('par_rep_id' => $id));
            $datos = array('meta' => $reporteDatos->row()->par_meta ,'tiempo' => $reporteDatos->row()->par_tiempo_asignacion , 'obligaciones' => $reporteDatos->row()->cant_obligaciones);
            echo json_encode($datos);
        }else{
            echo "No tienes permisos para ver este contenido!";
        }
    }

    //Estos son los elinadores de obligaciones
    function obligaciones(){
        if($this->session->userdata('login_ok')){
            $data = array('title' => 'Eliminar Obligaciones');
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIeliminarObligacionnes'); 

            $this->load->view('Includes/head', $data);
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Configuraciones/obligaciones');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    //
    function eliminarObligaciones(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");


            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit','128M'); 
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
                     
                    if($value['A'] != ""){
                        if($this->Wizard_Model->validarObligacion($value['A'])){
                            $datos = array(
                                'estado_obligacion' => 2
                            );
                            $resultado = false;
                            /*$resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], 'G719_C17026');*/
                            $this->db->where('G719_C17026', $value['A']);
                            if($this->db->delete('G719')){
                                $acertados += 1;
                                //Aqui guardamos en el log la eliminacion 
                                $datosLog = array(
                                    'log_user_id' => $this->session->userdata('identificacion'),
                                    'log_descripcion' => 'Eliminación de la obligacion '.$value['A'].'',
                                    'log_fecha' => $fechaIngreso
                                );

                                $this->Wizard_Model->guardardatos('log_users', $datosLog);
                            }else{
                                $fallos +=1;
                            }
                        
                        
                        }else if($this->Wizard_Model->validarLiquidacion($value['A'])){
                            $datos = array(
                                    'estado_obligacion' => 2
                            );
                            $resultado = false;
                          // $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], 'G719_C17423');
                            $this->db->where('G719_C17423', $value['A']);
                            if($this->db->delete('G719')){
                                $acertados += 1;
                                //Aqui guardamos en el log la eliminacion
                                $datosLog = array(
                                    'log_user_id' => $this->session->userdata('identificacion'),
                                    'log_descripcion' => 'Eliminación de la obligacion '.$value['A'].'',
                                    'log_fecha' => $fechaIngreso
                                );

                                $this->Wizard_Model->guardardatos('log_users', $datosLog);

                            }else{
                                $fallos +=1;
                            }
                        }
                    }else{
                        $fallosExistenciales++;
                    }

                    $i++;
                }
            }

            $result['valid'] = "1";
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['noexisten'] = $fallosExistenciales;
            $result['registros'] = $i;
            $result['message'] = 'Datos Eliminados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  
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

    function guardarBaseMemoriales(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");
            set_time_limit(600);

            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit','128M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $existentes = 0;
            $validadorFormato = true;

            foreach ($sheetData as $index => $value) {

                if ( $index > 1 ){
                    if($validador == 3){
                        break;
                    }
                     
                    if($value['A'] != ""){
                        $i++;
                        $liquidacionZeros = $this->completarZerosLiquidacion($value['A']);
                        $value['A'] =$this->Wizard_Model->getNumeroContrato($liquidacionZeros);

                        if($this->Wizard_Model->validarObligacion($value['A'])){
                            $this->db->select('Sub_id');
                            $this->db->from('Tabla_base_medicion_subrogaciones');
                            $this->db->where('Sub_contrato', $value['A']);
                            $segurida = $this->db->get();

                            if($segurida->num_rows() > 0){
                                $existentes++;
                                $year = date('Y');
                                //obtengo la info de la obligacion
                                $this->db->select('G719_C17029 as frg,  G719_C17039 as sap, G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $obligacion = $this->db->get();

                                //busco a ver si tiene factura subrogacion
                                $fecha_factura = NULL;
                                $fecha_auto = NULL;
                                $numero_factutra =NULL;
                                
                                $this->db->select('G744_ConsInte__b, G744_C17262 as fecha_factura, G744_C17264 as fecha_auto, G744_C17263 as numero ');
                                $this->db->from('G744');
                                $this->db->where('G744_C17280', $obligacion->row()->G719_ConsInte__b);
                                $aja = $this->db->get();
                                $res = $aja->result();

                                foreach ($res as $key) {
                                    $fecha_factura = $key->fecha_factura;
                                    $fecha_auto = $key->fecha_auto;
                                    $numero_factutra = $key->numero;
                                }

                                $datosArray= array( 'Sub_contrato'          =>  $value['A'],
                                                    'Sub_fecha_year'        => $year ,
                                                    'Sub_fecha_cargue'      => $fechaIngreso,
                                                    'Sub_usuari_carga'      => $this->session->userdata('identificacion'),
                                                    'Sub_sap'               => $obligacion->row()->sap,
                                                    'Sub_Frg'               => $obligacion->row()->frg,
                                                    'Sub_factura_subrogacion' => $numero_factutra,
                                                    'Sub_fecha_factura'     => $fecha_factura,
                                                    'Sub_fecha_auto'        => $fecha_auto,
                                                    'Sub_id_obligacion'     => $obligacion->row()->G719_ConsInte__b);
                                $this->db->where('Sub_id', $segurida->row()->Sub_id);
                                $resultado = $this->db->update('Tabla_base_medicion_subrogaciones', $datosArray);
                                if($resultado){
                                    //$acertados++;
                                }
                            }else{
                                $year = date('Y');
                                //obtengo la info de la obligacion
                                $this->db->select('G719_C17029 as frg,  G719_C17039 as sap, G719_ConsInte__b');
                                $this->db->from('G719');
                                $this->db->where('G719_C17026', $value['A']);
                                $obligacion = $this->db->get();

                                //busco a ver si tiene factura subrogacion
                                $fecha_factura = NULL;
                                $fecha_auto = NULL;
                                $numero_factutra =NULL;
                                
                                $this->db->select('G744_ConsInte__b, G744_C17262 as fecha_factura, G744_C17264 as fecha_auto, G744_C17263 as numero ');
                                $this->db->from('G744');
                                $this->db->where('G744_C17280', $obligacion->row()->G719_ConsInte__b);
                                $aja = $this->db->get();
                                $res = $aja->result();

                                foreach ($res as $key) {
                                    $fecha_factura = $key->fecha_factura;
                                    $fecha_auto = $key->fecha_auto;
                                    $numero_factutra = $key->numero;
                                }

                                $datosArray= array( 'Sub_contrato'          =>  $value['A'],
                                                    'Sub_fecha_year'        => $year ,
                                                    'Sub_fecha_cargue'      => $fechaIngreso,
                                                    'Sub_usuari_carga'      => $this->session->userdata('identificacion'),
                                                    'Sub_sap'               => $obligacion->row()->sap,
                                                    'Sub_Frg'               => $obligacion->row()->frg,
                                                    'Sub_factura_subrogacion' => $numero_factutra,
                                                    'Sub_fecha_factura'     => $fecha_factura,
                                                    'Sub_fecha_auto'        => $fecha_auto,
                                                    'Sub_id_obligacion'     => $obligacion->row()->G719_ConsInte__b);
                                $resultado = $this->db->insert('Tabla_base_medicion_subrogaciones', $datosArray);
                                if($resultado){
                                    $acertados++;
                                }
                            }
                        }else{
                            $fallosExistenciales++;
                        }
                    }else{
                        $validador++;
                    }
                   
                }
            }

            if($validadorFormato){
                $result['valid'] = "1";
                $result['total'] = $acertados;
                $result['fallaron'] = $fallos;
                $result['noexisten'] = $fallosExistenciales;
                $result['registros'] = $i;
                $result['baseAnte'] =  $existentes;
                $result['message'] = 'Se ha guardado la base';
                $this->output
                     ->set_content_type('application/json')
                     ->set_output(json_encode($result));    
            }else{
                $result['valid'] = "0";
                $result['message'] = $mensajeRespuesta;
                $this->output
                     ->set_content_type('application/json')
                     ->set_output(json_encode($result));    
            }
            
        }else{
            $this->load->view('Login/login');
        }    
    }


    function getFechasVentas(){
        /*Daniel Salgado Req 6 Ajuste de query a Modelo*/
        $dat = $this->Reportes_Model->datosCisaventas();
        $array = array();
        $i = 0;
        foreach($dat as $key){
             $array[$i]['Ven_nombre'] = utf8_encode($key->Ven_nombre);
             $fechaV =explode('-',$key->Ven_fecha_venta);
             $array[$i]['Ven_fecha_venta'] = $fechaV[2]."/".$fechaV[1]."/".$fechaV[0];
             $fechaN =explode('-',$key->Ven_fecha_notificacion);
             $array[$i]['Ven_fecha_notificacion'] = $fechaN[2]."/".$fechaN[1]."/".$fechaN[0];
             $fechaM =explode('-',$key->Ven_fecha_Maxima);
             $array[$i]['Ven_fecha_Maxima'] = $fechaM[2]."/".$fechaM[1]."/".$fechaM[0];
             $array[$i]['ven_id'] = $key->ven_id;
             $array[$i]['Ven_meta'] = $key->Ven_meta;
             $i++;
        }

        echo json_encode($array);
    }

    function guardarParametrosCisa(){
        $array = array();
        $array['Ven_nombre'] = $_POST['txtNombreVenta'];
        $array['Ven_fecha_venta'] = $_POST['txtFechaVenta'];
        $array['Ven_fecha_notificacion'] = $_POST['txtFechaNotificacion'];
        $array['Ven_meta'] = $_POST['txtMetaCISA'];

        $fechamesAnterior = strtotime ( '+'.$_POST['txtMetaCISA'].' day' , strtotime (  $_POST['txtFechaNotificacion'] ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $fechamesAnterior );
        $fechaInsert = date('Y-m-d');
        $array['Ven_fecha_Maxima'] =  $nuevafecha;
        $array['Ven_fecha_creacion'] =  $fechaInsert;
        $array['Ven_usuario'] = $this->session->userdata('identificacion');
        $array['Ven_estado'] =  'ACTIVO';

        if($this->db->insert('Parametros_cisa',  $array)){
            echo '1';
        }else{
            echo '2';
        }
    }


    function eliminarParamerosCIsa($id){
        $array = array();
        $this->db->where('ven_id', $id);
        if($this->db->delete('Parametros_cisa')){
            echo '1';
        }else{
            echo '2';
        }
    }
    
    function getBaseSurbogaciones(){
        
        $year = date('Y');
        $this->db->select('Sub_contrato as contrato, Sub_sap as sap, G729_C17121 as frg');
        $this->db->from('Tabla_base_medicion_subrogaciones');
        $this->db->join('G729', 'Sub_Frg = G729_ConsInte__b','LEFT');
        $this->db->where('Sub_fecha_year', $year);

        $query = $this->db->get();
        $result = $query->result();
        $json = array();
        $i = 0;
        foreach ($result as $key ) {
            $json[$i]['contrato'] = $key->contrato ;
            $json[$i]['sap'] = $key->sap ;
            $json[$i]['frg'] = utf8_encode($key->frg) ;
            $i++;
            
        }
        echo json_encode($json);
    }


///// Funcion Depuracion Datos no efectivos Clientes Jeisson Patiño
     function DatosClientes(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $Depuracion = $this->Configuraciones_Model->LimpriarTablaInformes();
            $noEfectivos = $this->Configuraciones_Model->getDatosinicialesNoEfectivos();
            
            $datosIniciales = array();
            $j = 0;
            foreach($noEfectivos as $key){
                $fecha2 = null;
                if(!is_null($key->fecha_modificacion)){
                    $fecha = explode(" ", $key->fecha_modificacion)[0];
                    $fecha = explode("-", $fecha);
                    $fecha2 = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                }
                $datosIniciales[$j]['liquidacion'] =        utf8_encode($key->liquidacion) ;
                $datosIniciales[$j]['tipo_identifiacion'] = utf8_encode($key->tipo_identifiacion) ;
                $datosIniciales[$j]['identificacion'] =     utf8_encode($key->identificacion) ;
                $datosIniciales[$j]['ciudadDomicilio'] =    utf8_encode($key->ciudadDomicilio) ;
                $datosIniciales[$j]['ciudadOficina'] =      utf8_encode($key->ciudadOficina) ;
                $datosIniciales[$j]['tefonoOficina'] =      utf8_encode($key->tefonoOficina) ;
                $datosIniciales[$j]['telefonoDomicilio'] =  utf8_encode($key->telefonoDomicilio) ; 
                $datosIniciales[$j]['celular'] =            utf8_encode($key->celular) ;
                $datosIniciales[$j]['celularAdicional'] =   utf8_encode($key->celularAdicional) ;
                $datosIniciales[$j]['mail'] =               utf8_encode($key->mail) ;
                $datosIniciales[$j]['direccionDomicilio'] = utf8_encode($key->direccionDomicilio) ;
                $datosIniciales[$j]['direccionOficina'] =   utf8_encode($key->direccionOficina) ;
                $datosIniciales[$j]['dir_Adicional'] =      utf8_encode($key->dir_Adicional) ;
                $datosIniciales[$j]['tele_adicional'] =     utf8_encode($key->tele_adicional) ;
                $datosIniciales[$j]['ciudad_adicional'] =   utf8_encode($key->ciudad_adicional) ;
                $datosIniciales[$j]['cal_ciudadDomicilio']= utf8_encode($key->cal_ciudadDomicilio) ;
                $datosIniciales[$j]['cal_ciudadOficina'] =  utf8_encode($key->cal_ciudadOficina) ;
                $datosIniciales[$j]['cal_tefonoOficina'] =  utf8_encode($key->cal_tefonoOficina) ;
                $datosIniciales[$j]['cal_telefonoDomicilio'] = utf8_encode($key->cal_telefonoDomicilio) ;
                $datosIniciales[$j]['cal_celular'] =        utf8_encode($key->cal_celular) ;
                $datosIniciales[$j]['cal_celularAdicional'] = utf8_encode($key->cal_celularAdicional) ;
                $datosIniciales[$j]['cal_mail']             = utf8_encode($key->cal_mail) ;
                $datosIniciales[$j]['cal_direccionDomicilio'] = utf8_encode($key->cal_direccionDomicilio) ;
                $datosIniciales[$j]['cal_direccionOficina'] = utf8_encode($key->cal_direccionOficina) ;
                $datosIniciales[$j]['cal_dir_Adicional'] = utf8_encode($key->cal_dir_Adicional) ;
                $datosIniciales[$j]['cal_tele_adicional'] = utf8_encode($key->cal_tele_adicional) ;
                $datosIniciales[$j]['cal_ciudad_adicional'] = utf8_encode($key->cal_ciudad_adicional) ;
                $datosIniciales[$j]['fecha_modificacion'] = $fecha2 ;
                $datosIniciales[$j]['id_log_datos'] = $key->id_log_datos;
                $j++;
            }

            $noEfectivosinformes = $this->Configuraciones_Model->DatosNoEfectivosInforme();
            $datosInforme1 = array();
            $j = 0;
            foreach($noEfectivosinformes as $key){
                $fecha2 = null;
                if(!is_null($key->Fecha_modificacion)){
                    $fecha = explode(" ", $key->Fecha_modificacion)[0];
                    $fecha = explode("-", $fecha);
                    $fecha2 = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                }
                $datosInforme1[$j]['liquidacion'] = utf8_encode($key->liquidacion) ;
                $datosInforme1[$j]['TipoIdentificacion'] = utf8_encode($key->TipoIdentificacion) ;
                $datosInforme1[$j]['Identificacion'] = utf8_encode($key->Identificacion) ;
                $datosInforme1[$j]['Direccion_domicilio'] = utf8_encode($key->Direccion_domicilio) ;
                $datosInforme1[$j]['Calificacion_Dir_Domicilio'] = utf8_encode($key->Calificacion_Dir_Domicilio) ;
                $datosInforme1[$j]['Ciudad_domicilio'] = utf8_encode($key->Ciudad_domicilio) ;
                $datosInforme1[$j]['Calificacion_Ciudad_domicilio'] = utf8_encode($key->Calificacion_Ciudad_domicilio) ; 
                $datosInforme1[$j]['Direccion_oficina'] = utf8_encode($key->Direccion_oficina) ;
                $datosInforme1[$j]['Calificacion_Direccion_oficina'] = utf8_encode($key->Calificacion_Direccion_oficina) ;
                $datosInforme1[$j]['Ciudad_oficina'] = utf8_encode($key->Ciudad_oficina) ;
                $datosInforme1[$j]['Calificacion_Ciudad_oficina'] = utf8_encode($key->Calificacion_Ciudad_oficina) ;
                $datosInforme1[$j]['Telefono_domicilio'] = utf8_encode($key->Telefono_domicilio) ;
                $datosInforme1[$j]['Calificacion_Telefono_domicilio'] = utf8_encode($key->Calificacion_Telefono_domicilio) ;
                $datosInforme1[$j]['Telefono_oficina'] = utf8_encode($key->Telefono_oficina) ;
                $datosInforme1[$j]['Calificacion_Telefono_oficina'] = utf8_encode($key->Calificacion_Telefono_oficina) ;
                $datosInforme1[$j]['Celular'] = utf8_encode($key->Celular) ;
                $datosInforme1[$j]['Calificacion_Celular'] = utf8_encode($key->Calificacion_Celular) ;
                $datosInforme1[$j]['Celular_adicional'] = utf8_encode($key->Celular_adicional) ;
                $datosInforme1[$j]['Calificacion_Celular_adicional'] = utf8_encode($key->Calificacion_Celular_adicional) ;
                $datosInforme1[$j]['Correo_electronico'] = utf8_encode($key->Correo_electronico) ;
                $datosInforme1[$j]['Calificacion_Correo_electronico'] = utf8_encode($key->Calificacion_Correo_electronico) ;
                $datosInforme1[$j]['Direccion_adicional'] = utf8_encode($key->Direccion_adicional) ;
                $datosInforme1[$j]['Calificacion_Direccion_adicional'] = utf8_encode($key->Calificacion_Direccion_adicional) ;
                $datosInforme1[$j]['Ciudad_adicional'] = utf8_encode($key->Ciudad_adicional) ;
                $datosInforme1[$j]['Calificacion_Ciudad_adicional'] = utf8_encode($key->Calificacion_Ciudad_adicional) ;
                $datosInforme1[$j]['Telefono_adicional'] = utf8_encode($key->Telefono_adicional) ;
                $datosInforme1[$j]['Calificacion_Telefono_adicional'] = utf8_encode($key->Calificacion_Telefono_adicional) ;
                $datosInforme1[$j]['Fecha_modificacion'] = $fecha2 ;
                $j++;
            }

            $Efectivosinforme = $this->Configuraciones_Model->DatosEfectivosInforme();
            $datosInforme2 = array();
            $j = 0;
            foreach($Efectivosinforme as $key){
                $fecha2 = null;
                if(!is_null($key->Fecha_modificacion)){
                    $fecha = explode(" ", $key->Fecha_modificacion)[0];
                    $fecha = explode("-", $fecha);
                    $fecha2 = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                }
                $datosInforme2[$j]['liquidacion'] = utf8_encode($key->liquidacion) ;
                $datosInforme2[$j]['TipoIdentificacion'] = utf8_encode($key->TipoIdentificacion) ;
                $datosInforme2[$j]['Identificacion'] = utf8_encode($key->Identificacion) ;
                $datosInforme2[$j]['Direccion_domicilio'] = utf8_encode($key->Direccion_domicilio) ;
                $datosInforme2[$j]['Calificacion_Dir_Domicilio'] = utf8_encode($key->Calificacion_Dir_Domicilio) ;
                $datosInforme2[$j]['Ciudad_domicilio'] = utf8_encode($key->Ciudad_domicilio) ;
                $datosInforme2[$j]['Calificacion_Ciudad_domicilio'] = utf8_encode($key->Calificacion_Ciudad_domicilio) ; 
                $datosInforme2[$j]['Direccion_oficina'] = utf8_encode($key->Direccion_oficina) ;
                $datosInforme2[$j]['Calificacion_Direccion_oficina'] = utf8_encode($key->Calificacion_Direccion_oficina) ;
                $datosInforme2[$j]['Ciudad_oficina'] = utf8_encode($key->Ciudad_oficina) ;
                $datosInforme2[$j]['Calificacion_Ciudad_oficina'] = utf8_encode($key->Calificacion_Ciudad_oficina) ;
                $datosInforme2[$j]['Telefono_domicilio'] = utf8_encode($key->Telefono_domicilio) ;
                $datosInforme2[$j]['Calificacion_Telefono_domicilio'] = utf8_encode($key->Calificacion_Telefono_domicilio) ;
                $datosInforme2[$j]['Telefono_oficina'] = utf8_encode($key->Telefono_oficina) ;
                $datosInforme2[$j]['Calificacion_Telefono_oficina'] = utf8_encode($key->Calificacion_Telefono_oficina) ;
                $datosInforme2[$j]['Celular'] = utf8_encode($key->Celular) ;
                $datosInforme2[$j]['Calificacion_Celular'] = utf8_encode($key->Calificacion_Celular) ;
                $datosInforme2[$j]['Celular_adicional'] = utf8_encode($key->Celular_adicional) ;
                $datosInforme2[$j]['Calificacion_Celular_adicional'] = utf8_encode($key->Calificacion_Celular_adicional) ;
                $datosInforme2[$j]['Correo_electronico'] = utf8_encode($key->Correo_electronico) ;
                $datosInforme2[$j]['Calificacion_Correo_electronico'] = utf8_encode($key->Calificacion_Correo_electronico) ;
                $datosInforme2[$j]['Direccion_adicional'] = utf8_encode($key->Direccion_adicional) ;
                $datosInforme2[$j]['Calificacion_Direccion_adicional'] = utf8_encode($key->Calificacion_Direccion_adicional) ;
                $datosInforme2[$j]['Ciudad_adicional'] = utf8_encode($key->Ciudad_adicional) ;
                $datosInforme2[$j]['Calificacion_Ciudad_adicional'] = utf8_encode($key->Calificacion_Ciudad_adicional) ;
                $datosInforme2[$j]['Telefono_adicional'] = utf8_encode($key->Telefono_adicional) ;
                $datosInforme2[$j]['Calificacion_Telefono_adicional'] = utf8_encode($key->Calificacion_Telefono_adicional) ;
                $datosInforme2[$j]['Fecha_modificacion'] = $fecha2 ;
                $j++;
            }

            $DatosSinGestionarInforme = $this->Configuraciones_Model->DatosSinGestionarInforme();
            $datosInforme3 = array();
            $j = 0;
            foreach($DatosSinGestionarInforme as $key){
                $fecha2 = null;
                if(!is_null($key->Fecha_modificacion)){
                    $fecha = explode(" ", $key->Fecha_modificacion)[0];
                    $fecha = explode("-", $fecha);
                    $fecha2 = "<span style='display: none;'>".$fecha[0]."/".$fecha[1]."/".$fecha[2]."</span>".$fecha[2]."/".$fecha[1]."/".$fecha[0];
                }
                $datosInforme3[$j]['liquidacion'] = utf8_encode($key->liquidacion) ;
                $datosInforme3[$j]['TipoIdentificacion'] = utf8_encode($key->TipoIdentificacion) ;
                $datosInforme3[$j]['Identificacion'] = utf8_encode($key->Identificacion) ;
                $datosInforme3[$j]['Direccion_domicilio'] = utf8_encode($key->Direccion_domicilio) ;
                $datosInforme3[$j]['Calificacion_Dir_Domicilio'] = utf8_encode($key->Calificacion_Dir_Domicilio) ;
                $datosInforme3[$j]['Ciudad_domicilio'] = utf8_encode($key->Ciudad_domicilio) ;
                $datosInforme3[$j]['Calificacion_Ciudad_domicilio'] = utf8_encode($key->Calificacion_Ciudad_domicilio) ; 
                $datosInforme3[$j]['Direccion_oficina'] = utf8_encode($key->Direccion_oficina) ;
                $datosInforme3[$j]['Calificacion_Direccion_oficina'] = utf8_encode($key->Calificacion_Direccion_oficina) ;
                $datosInforme3[$j]['Ciudad_oficina'] = utf8_encode($key->Ciudad_oficina) ;
                $datosInforme3[$j]['Calificacion_Ciudad_oficina'] = utf8_encode($key->Calificacion_Ciudad_oficina) ;
                $datosInforme3[$j]['Telefono_domicilio'] = utf8_encode($key->Telefono_domicilio) ;
                $datosInforme3[$j]['Calificacion_Telefono_domicilio'] = utf8_encode($key->Calificacion_Telefono_domicilio) ;
                $datosInforme3[$j]['Telefono_oficina'] = utf8_encode($key->Telefono_oficina) ;
                $datosInforme3[$j]['Calificacion_Telefono_oficina'] = utf8_encode($key->Calificacion_Telefono_oficina) ;
                $datosInforme3[$j]['Celular'] = utf8_encode($key->Celular) ;
                $datosInforme3[$j]['Calificacion_Celular'] = utf8_encode($key->Calificacion_Celular) ;
                $datosInforme3[$j]['Celular_adicional'] = utf8_encode($key->Celular_adicional) ;
                $datosInforme3[$j]['Calificacion_Celular_adicional'] = utf8_encode($key->Calificacion_Celular_adicional) ;
                $datosInforme3[$j]['Correo_electronico'] = utf8_encode($key->Correo_electronico) ;
                $datosInforme3[$j]['Calificacion_Correo_electronico'] = utf8_encode($key->Calificacion_Correo_electronico) ;
                $datosInforme3[$j]['Direccion_adicional'] = utf8_encode($key->Direccion_adicional) ;
                $datosInforme3[$j]['Calificacion_Direccion_adicional'] = utf8_encode($key->Calificacion_Direccion_adicional) ;
                $datosInforme3[$j]['Ciudad_adicional'] = utf8_encode($key->Ciudad_adicional) ;
                $datosInforme3[$j]['Calificacion_Ciudad_adicional'] = utf8_encode($key->Calificacion_Ciudad_adicional) ;
                $datosInforme3[$j]['Telefono_adicional'] = utf8_encode($key->Telefono_adicional) ;
                $datosInforme3[$j]['Calificacion_Telefono_adicional'] = utf8_encode($key->Calificacion_Telefono_adicional) ;
                $datosInforme3[$j]['Fecha_modificacion'] = $fecha2 ;
                $j++;
            }

            $datos = array( 'ResultadoNoEfectivoInforme' => json_encode($datosInforme1),
                            'DatoSinGestionar' => json_encode($datosInforme3),
                                'ResultadoEfectivoInforme' => json_encode($datosInforme2),
                                'ResultadoNoEfectivos' => json_encode($datosIniciales));

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/GestionarDatosCliente',$datos);
            $this->load->view('Includes/footer');
        }else{
            echo "no tienes permisos para ver esto";
        }
    }

    function DepurarDatosNoEfectivos(){


        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $noEfectivos = $this->Configuraciones_Model->DepurarDatosNoEfectivos();
            echo "1";    
        }      
    }

    function imprimirPlano ($texto){
        $file = fopen("archivo.txt", "w");
        fwrite($file, $texto . PHP_EOL);
        fwrite($file, "Otra más" . PHP_EOL);
        fclose($file);
    }

   

   function CargarMasivaDatosCLientes(){
         $agregar = $this->Configuraciones_Model->IngresarDatosLog_Datos_Inciales();
        if($this->session->userdata('login_ok')){
           
            $this->load->library('excel');
            date_default_timezone_set('America/Bogota');
            $name   = $_FILES['FilExcell2']['name'];
          //  var_dump($_FILES[0]);
            $tname  = $_FILES['FilExcell2']['tmp_name'];
          //  var_dump( $tname);
            ini_set('memory_limit', '1024M');
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            //$sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            $i = 0;
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $obj_excel->getActiveSheet()->getStyle('AB1:AB'.$highestRow)->getNumberFormat()->setFormatCode("YYYY-m-d");
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $validador = 0;
            $datos = array( );
            $j = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 1 ){
                    if($validador > 26){
                        break;
                    }
                    
                    if($value['A'] != ""){ 
                    
                     $queryS = "INSERT INTO GestionDatosCliente
                            VALUES ('".$value['A']."','".$value['B']."','".$value['C']."','".$value['D']."','".$value['E']."','".$value['F']."','".$value['G']."','".$value['H']."','".$value['I']."','".$value['J']."','".$value['K']."','".$value['L']."','".$value['M']."','".$value['N']."','".$value['O']."','".$value['P']."','".$value['Q']."','".$value['R']."','".$value['S']."','".$value['T']."','".$value['U']."','".$value['V']."','".$value['W']."','".$value['X']."','".$value['Y']."','".$value['Z']."','".$value['AA']."',getdate())";        
                         
                        /*$this ->imprimirPlano($queryS);*/
                        $this->db->query($queryS);
                         

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

            
       $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($resultados));

        }else{
            $this->load->view('Login/login');
        }
    }

    function LimpriarTablaInformes(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $noEfectivos = $this->Configuraciones_Model->LimpriarTablaInformes();
            echo "1";  

        }  
    }

    // Datos Abogados y Gestroes Jeisson Patiño

    function GestionAbogaos_Gestores(){
         if($this->session->userdata('login_ok')){
            $abogadosDelete = $this->Configuraciones_Model->DatosAbogadosEliminar();
            $registros = array();
            $i= 0;
            foreach ($abogadosDelete as $key) {
                $registros[$i]['codigo'] = utf8_encode($key->codigo) ;
                $registros[$i]['nombres'] = utf8_encode($key->nombres) ;
                $registros[$i]['identificacion'] = $key->identificacion ;
                $registros[$i]['cargo'] = utf8_encode($key->cargo) ;
                $registros[$i]['id'] = $key->id ;
           
                $i++;

            }
            $gestoresDelete = $this->Configuraciones_Model->DatosGestoresEliminar();
            $datosGestores = array();
            $i= 0;
            foreach ($gestoresDelete as $key) {
                $datosGestores[$i]['codigo'] = utf8_encode($key->codigo) ;
                $datosGestores[$i]['nombres'] = utf8_encode($key->nombres) ;
                $datosGestores[$i]['identificacion'] = $key->identificacion ;
                $datosGestores[$i]['cargo'] = utf8_encode($key->cargo) ;
                $datosGestores[$i]['id'] = $key->id ;
           
                $i++;

            }
            $datos = array('AbogadosEliminar' => json_encode($registros),
                            'GestoresEliminar' => json_encode($datosGestores));
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/EliminacionAbogadosGestores', $datos);
            $this->load->view('Includes/footer');
        }else{
            $this->load->view('Login/login');
        }
        
    }
    
}

?>