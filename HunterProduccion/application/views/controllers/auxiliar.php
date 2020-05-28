<?php

if (!defined('BASEPATH'))exit('No direct script access allowed');

class Auxiliar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Configuraciones_Model');
        $this->load->model('Wizard_Model');
        $this->load->model("CarteraFng_Model");
        $this->load->model("Obligaciones_Model");
		$this->load->model("Extrajudicial_Model");
        $this->load->model("Conceptos_Model");
    }

    public function getIdContrato(){
        if($this->session->userdata('login_ok')){
            $NumeroContrato = $_POST['liquidacion'];
            echo $contrato = $this->Obligaciones_Model->getIdObligacionByLiquidacion($NumeroContrato);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function getIdUsuario($identificacion){
        if($this->session->userdata('login_ok')){
            echo $usuario = $this->Obligaciones_Model->getIdUsuario($identificacion);
        }else{
            $this->load->view('Login/login');
        }
    }

    public function Abogados(){
        if($this->session->userdata('login_ok')){
           	$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIabgadosAux');
            $Frgs = $this->Configuraciones_Model->getFrgs();
           	$abogados = $this->Configuraciones_Model->getAbogados();
            $this->db->select('[G728_C17116] as nombres,
                                G728_ConsInte__b');
            $this->db->from('G728');
            $query = $this->db->get();


           	$data = array('abogados' => $abogados, 'frg' =>  $Frgs, 'firmas' => $query->result());
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/abogados', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    
    }

    function getDatosAbodado($consinte){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getAbogadoById($consinte);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['cedula'] = $key->cedula;
                $datos[$i]['nombre'] = utf8_encode($key->Nombre);
                $datos[$i]['celular'] = $key->celular;
                $datos[$i]['correo'] = $key->correo;
                $datos[$i]['frg'] = $key->FRGId;
                $datos[$i]['direccion'] = utf8_encode($key->direccion);
                $datos[$i]['telefono'] = utf8_encode($key->telefono) ;
                $datos[$i]['firma'] = $key->FirmaAbogado;
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }

    function guardarAbogads(){
    	if($this->session->userdata('login_ok')){
           	$datos = array(
           					'CCAbogado' => $_POST['cedula'],
           					'Nombre' => utf8_decode($_POST['nombre']),
           					'Celular' => $_POST['celular'],
           					'CorreoElectronico' => $_POST['correo'],
                            'FRGId' => $_POST['cmbFrgs'],
                            'direccion' => $_POST['TxtDireccion'],
                            'telefono' => $_POST['txtTelefono'],
                            'FirmaAbogado' => $_POST['cambFirmas']
           				);

           /*$datos = array(
                            'CCAbogado' => $_POST['cedula'],
                            'Nombre' => utf8_decode($_POST['nombre']),
                            'Celular' => $_POST['celular'],
                            'CorreoElectronico' => $_POST['correo'],
                            'FRGId' => $_POST['cmbFrgs']
                        );*/

            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('Abogados', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('Abogados', $datos, $_POST['id'], 'Id');
            }

       	 	  if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarDatos(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('Abogados', $_POST['id'], 'Id');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    // AUXILIAR ACTUACIONES
     public function Actuaciones(){
        if($this->session->userdata('login_ok')){
            $procesos = $this->CarteraFng_Model->getListasLisop(191);
            $etapa     = $this->CarteraFng_Model->getFiltrosCombo('G725', 'G725_ConsInte__b', 'G725_C17108');
            $abogados = $this->Configuraciones_Model->getActuaciones();
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIactuaciones');
			
            $data = array('Auxiliar' => $abogados, 'procesos' => $procesos, 'etapas' => $etapa);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/Actuaciones', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosActuaciones($consinte){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getActuacionesById($consinte);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['Tipo_de_proceso'] = $key->Tipo_de_proceso;
                $datos[$i]['Etapa'] = utf8_encode($key->Etapa);
                $datos[$i]['Codigo_actuacion'] = $key->Codigo_actuacion;
                $datos[$i]['Descripcion_actuacion'] = utf8_encode($key->Descripcion_actuacion);
                $datos[$i]['codigo'] = $key->codigoEtapa;

                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }

    function guardarActuaciones(){
      if($this->session->userdata('login_ok')){
            $datos = array(
                    'G724_C17102' => $_POST['selProcesos'],
                    'G724_C17103' => $_POST['selEtapas'],
                    'G724_C17104' => $_POST['celular'],
                    'G724_C17105' => utf8_decode($_POST['correo'])
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G724', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G724', $datos, $_POST['id'], 'G724_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarActuaciones(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G724', $_POST['id'], 'G724_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function getFiltrosComboEtapas($id){
        if($this->session->userdata('login_ok')){
            
            $abogados = $this->Configuraciones_Model->getFiltrosComboEtapas($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->G725_ConsInte__b;
                $datos[$i]['descripcion'] = utf8_encode($key->descripcion);
                $datos[$i]['codigo'] = utf8_encode($key->G725_C17107);
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }

    function validarCodigo($codigo, $etapa){
        if($this->session->userdata('login_ok')){
            
            $abogados = $this->Configuraciones_Model->validarActuacion($codigo, $etapa);
            if($abogados){
                echo "1";
            }else{
                echo "2";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    //ciudades
    function ciudades(){
        if($this->session->userdata('login_ok')){
            $ciudades = $this->Configuraciones_Model->getCiudades();
            $paises = $this->Configuraciones_Model->getListaDepartamentos();
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIciudades');
			
            $data = array('ciudades' => $ciudades, 'departamentos' => $paises);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/ciudades', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosCiudades($id){
        
         if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getCiudadesById($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['ciudad'] = utf8_encode($key->ciudad);
                $datos[$i]['departamento'] = utf8_encode($key->Departamento);

                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }

    function guardarCiudades(){
      if($this->session->userdata('login_ok')){
            $datos = array(
                    'Ciudad' => utf8_decode($_POST['ciudad']),
                    'Departamento' => $_POST['departamento']
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('Ciudad', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('Ciudad', $datos, $_POST['id'], 'Id');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarCiudades(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G741', $_POST['id'], 'G741_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    //dtaos Adicionales
    function datosAdcicionales(){
        if($this->session->userdata('login_ok')){
            $personas = $this->Configuraciones_Model->getDatosAdicionales();
            $ciudades = $this->Configuraciones_Model->getCiudades();
            $calificacion = $this->CarteraFng_Model->getListasLisop(198);
			
			
			
            $data = array('personas' => $personas, 'ciudades' => $ciudades, 'calificacion' => $calificacion);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/datosAdcicionales', $data );
            $this->load->view('Includes/footer');
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosadicionales($idcliente){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getDatosAdicionalesByUser($idcliente);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['CORREO_ELECTRONICO'] = $key->CORREO_ELECTRONICO;
                $datos[$i]['TELEFONO'] = $key->TELEFONO;
                $datos[$i]['DIRECCION'] = utf8_encode($key->DIRECCION);
                $datos[$i]['CIUDAD'] = $key->CIUDAD;
                $datos[$i]['CALIFICACION'] = $key->CALIFICACION;
                $datos[$i]['DESCRIPCION'] = utf8_encode($key->DESCRIPCION);
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getdatosadicionalesbyid($iddato){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Wizard_Model->getDatosAdicionalesByid($iddato);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $fecha = explode(" ", $key->Fecha)[0];
                $fecha = explode("-", $fecha);

                echo '<div class="row">
                    <div class="col-md-3" ><label>Telefono</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->Telefono.' </div>
                    <div class="col-md-3" ><label>Calificación</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->Calificacion_telefono.' </div>
                </div>

                <div class="row">
                    <div class="col-md-3" ><label>Dirección</label> </div>
                    <div class="col-md-3" id="Datosgestion">'.utf8_encode($key->Direccion).' </div>
                    <div class="col-md-3" ><label>Calificación</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->Calificacion_direccion.' </div>
                </div>

                <div class="row">
                    <div class="col-md-3"><label>Ciudad</label> </div>
                    <div class="col-md-3"  id="DatosSubgestion"> '. $key->Ciudad.'</div>
                    <div class="col-md-3" ><label>Calificación</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->Calificacion_ciudad.' </div>
                </div>

                <div class="row">
                    <div class="col-md-3"><label>Correo Electronico</label>   </div>
                    <div class="col-md-3" id="DatosResultado">'.$key->Correo_electronico.' </div>
                    <div class="col-md-3" ><label>Calificación</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->Calificacion_correo.' </div>
                </div>

                <div class="row">
                    <div class="col-md-3"   ><label>Descripción</label> </div>
                    <div class="col-md-3" id="fechapronunciamiento">'.utf8_encode($key->Descripcion).' </div>
                    
                    <div class="col-md-3" ><label>Calificación</label> </div>
                    <div class="col-md-3" id="DatosMedio">'.$key->Calificacion_descripcion.' </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3"  ><label>Fecha</label> </div>
                    <div class="col-md-3" id="DatosFecha">'.$fecha[2]."/".$fecha[1]."/".$fecha[0].' </div>
                </div>
                ';

            }

        }else{
            $this->load->view('Login/login');
        }
        
    }

    function guardarDatosIniciales(){
        if($this->session->userdata('login_ok')){
            $idUsuario = $_POST['ID_PERSONAS'];

            $datosPersonales = $this->db->get_where('InformacionCliente', array('NroIdentificacion' => $_POST['IdentificacionUsers']));
            
            
            $ciudadDomicilio = $datosPersonales->row()->CiudadDomicilio ;
            $ciudadOficina = $datosPersonales->row()->CiudadOficina ;
            $tefonoOficina = $datosPersonales->row()->TelefonoOficina ;
            $telefonoDomicilio = $datosPersonales->row()->TelefonoDomicilio ;
            $celular = $datosPersonales->row()->Celular ;
            $celularAdicional = $datosPersonales->row()->CelularAdicional ;
            $mail = $datosPersonales->row()->CorreoElectronico ;
            $direccionDomicilio = $datosPersonales->row()->DireccionDomicilio ;
            $direccionOficina = $datosPersonales->row()->DireccionOficina ;
            $iddeusuario = $datosPersonales->row()->Id;
            $dir_Adicional = $datosPersonales->row()->dir_Adicional;
            $tele_adicional = $datosPersonales->row()->tele_adicional;
            $ciudad_adicional = $datosPersonales->row()->ciudad_adicional;

            if($_POST['seldireccion_domicilio'] == '1801'){
                $direccionDomicilio = $_POST['direccion_domicilio'];
            }

            if($_POST['Selciudad_domicilio'] == '1801'){
                $ciudadDomicilio = $_POST['ciudad_domicilio'];
            }

            if($_POST['Seldireccion_oficina'] == '1801'){
                $direccionOficina = $_POST['direccion_oficina'];
            }

            if($_POST['selCiudad_oficina'] == '1801'){
                $ciudadOficina = $_POST['ciudad_oficina'];
            }

            if($_POST['selTelefono_domicilio'] == '1801'){
                $telefonoDomicilio = $_POST['telefono_domicilio'];
            }

            if($_POST['selTelefono_oficina'] == '1801'){
                $tefonoOficina = $_POST['telefono_oficina'];
            }

            if($_POST['selCelular'] == '1801'){
                $celular = $_POST['celular'];
            }

            if($_POST['selCelularAdicional'] == '1801'){
                $celularAdicional = $_POST['celular_adicional'];
            }

            if($_POST['selCorreoOficial'] == '1801'){
                $mail = $_POST['correo_electronico'];
            }

            if($_POST['selciudad_adicional'] == '1801'){
                $ciudad_adicional = $_POST['ciudad_adicional'];
            }

            if($_POST['seldiradicional'] == '1801'){
                $dir_Adicional = $_POST['dir_Adicional'];
            }

            if($_POST['selTelAdicional'] == '1801'){
                $tele_adicional = $_POST['tele_adicional'];
            }

            $datosNormales = array( 'CiudadDomicilio' => $ciudadDomicilio,
                                    'CiudadOficina' => $ciudadOficina,
                                    'TelefonoOficina' => $tefonoOficina,
                                    'TelefonoDomicilio' => $telefonoDomicilio,
                                    'Celular' => $celular,
                                    'CelularAdicional' => $celularAdicional,
                                    'CorreoElectronico' => $mail,
                                    'DireccionDomicilio' => $direccionDomicilio,
                                    'DireccionOficina' => $direccionOficina,
                                    'tele_adicional' => $tele_adicional,
                                    'dir_Adicional' => $dir_Adicional,
                                    'ciudad_adicional' => $ciudad_adicional );
            
            $resultados = $this->Wizard_Model->editarDatos('InformacionCliente', $datosNormales, $iddeusuario, 'Id');

            $datosIniciales = array( 'ciudadDomicilio' => $ciudadDomicilio,
                                     'ciudadOficina' => $ciudadOficina,
                                     'tefonoOficina' => $tefonoOficina,
                                     'telefonoDomicilio' => $telefonoDomicilio,
                                     'celular' => $celular,
                                     'celularAdicional' => $celularAdicional,
                                     'mail' => $mail,
                                     'direccionDomicilio' => $direccionDomicilio,
                                     'direccionOficina' => $direccionOficina,
                                     'tele_adicional' => $tele_adicional,
                                     'dir_Adicional' => $dir_Adicional,
                                     'ciudad_adicional' => $ciudad_adicional,

                                     'iddeusuario' => $iddeusuario,

                                     'cal_ciudadDomicilio' => $_POST['Selciudad_domicilio'],
                                     'cal_ciudadOficina' => $_POST['selCiudad_oficina'],
                                     'cal_tefonoOficina' => $_POST['selTelefono_oficina'],
                                     'cal_telefonoDomicilio' => $_POST['selTelefono_domicilio'],
                                     'cal_celular' => $_POST['selCelular'] ,
                                     'cal_celularAdicional' => $_POST['selCelularAdicional'],
                                     'cal_mail' => $_POST['selCorreoOficial'], 
                                     'cal_direccionDomicilio' => $_POST['seldireccion_domicilio'],
                                     'cal_direccionOficina' => $_POST['Seldireccion_oficina'] ,
                                     'cal_tele_adicional' => $_POST['selTelAdicional'],
                                     'cal_dir_Adicional' => $_POST['seldiradicional'],
                                     'cal_ciudad_adicional' => $_POST['selciudad_adicional']

                                     );
            $resultado = $this->Wizard_Model->guardardatos('Log_datos_iniciales', $datosIniciales);
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


    function getdatosInicialesbyid($iddato){
        if($this->session->userdata('login_ok')){

            $this->db->select("id_log_datos
                          ,x.Ciudad as ciudadDomicilio
                          ,y.Ciudad as ciudadOficina
                          ,tefonoOficina
                          ,telefonoDomicilio
                          ,celular
                          ,celularAdicional
                          ,mail
                          ,direccionDomicilio
                          ,direccionOficina
                          ,iddeusuario
                          ,dir_Adicional
                          ,tele_adicional
                          ,z.Ciudad as ciudad_adicional
                          ,a.Nombre_b As cal_ciudadDomicilio
                          ,b.Nombre_b As cal_ciudadOficina
                          ,c.Nombre_b As cal_tefonoOficina
                          ,d.Nombre_b As cal_telefonoDomicilio
                          ,e.Nombre_b As cal_celular
                          ,f.Nombre_b As cal_celularAdicional
                          ,g.Nombre_b As cal_mail
                          ,h.Nombre_b As cal_direccionDomicilio
                          ,i.Nombre_b As cal_direccionOficina
                          ,j.Nombre_b As cal_dir_Adicional
                          ,k.Nombre_b As cal_tele_adicional
                          ,l.Nombre_b As cal_ciudad_adicional
                          ,fecha_modificacion");
            $this->db->from("Log_datos_iniciales");

            $this->db->join('Ciudad x', 'x.Id = ciudadDomicilio', 'LEFT');
            $this->db->join('Ciudad y', 'y.Id = ciudadOficina', 'LEFT');
            $this->db->join('Ciudad z', 'z.Id = ciudad_adicional', 'LEFT');

            $this->db->join('ParametroGeneral a', 'a.Id = cal_ciudadDomicilio ', 'LEFT');
            $this->db->join('ParametroGeneral b', 'b.Id = cal_ciudadOficina ', 'LEFT');
            $this->db->join('ParametroGeneral c', 'c.Id = cal_tefonoOficina ', 'LEFT');
            $this->db->join('ParametroGeneral d', 'd.Id = cal_telefonoDomicilio ', 'LEFT');
            $this->db->join('ParametroGeneral e', 'e.Id = cal_celular ', 'LEFT');
            $this->db->join('ParametroGeneral f', 'f.Id = cal_celularAdicional ', 'LEFT');
            $this->db->join('ParametroGeneral g', 'g.Id = cal_mail ', 'LEFT');
            $this->db->join('ParametroGeneral h', 'h.Id = cal_direccionDomicilio ', 'LEFT');
            $this->db->join('ParametroGeneral i', 'i.Id = cal_direccionOficina ', 'LEFT');
            $this->db->join('ParametroGeneral j', 'j.Id = cal_dir_Adicional ', 'LEFT');
            $this->db->join('ParametroGeneral k', 'k.Id = cal_tele_adicional ', 'LEFT');
            $this->db->join('ParametroGeneral l', 'l.Id = cal_ciudad_adicional ', 'LEFT');
            $this->db->where("id_log_datos", $iddato);
            $query = $this->db->get();
            $abogados = $query->result();


            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $fecha = explode(" ", $key->fecha_modificacion)[0];
                $fecha = explode("-", $fecha);
                echo '<table class="table table-hover table-bordered"><tbody>';
                echo '<tr >
                        <th >Ciudad de Domicilio </th>
                        <td>'.utf8_encode($key->ciudadDomicilio).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_ciudadDomicilio.' </td>
                    </tr>
                    <tr>
                        <th>Ciudad de Oficina</th>
                        <td>'.utf8_encode($key->ciudadOficina).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_ciudadOficina.' </td>
                    </tr>
                    <tr>
                        <th>Telefono de Oficina</th>
                        <td>'.utf8_encode($key->tefonoOficina).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_tefonoOficina.' </td>
                    </tr>
                    <tr>
                        <th>Telefono Domicilio</th>
                        <td>'.utf8_encode($key->telefonoDomicilio).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_telefonoDomicilio.' </td>
                    </tr>
                    <tr>
                        <th>Celular</th>
                        <td>'.utf8_encode($key->celular).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_celular.' </td>
                    </tr>
                    <tr>
                        <th>Celular Adicional</th>
                        <td>'.utf8_encode($key->celularAdicional).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_celularAdicional.' </td>
                    </tr>
                    <tr>
                        <th>Correo Electronico</th>
                        <td>'.utf8_encode($key->mail).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_mail.' </td>
                    </tr>
                    <tr>
                        <th>Dirección de Domicilio</th>
                        <td>'.utf8_encode($key->direccionDomicilio).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_direccionDomicilio.' </td>
                    </tr>
                    <tr>
                        <th>Dirección Oficina</th>
                        <td>'.utf8_encode($key->direccionOficina).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_direccionOficina.' </td>
                    </tr>
                    <tr>
                        <th>Dirección Adicional</th>
                        <td>'.utf8_encode($key->dir_Adicional).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_dir_Adicional.' </td>
                    </tr>
                    <tr>
                        <th>Telefono Adicional</th>
                        <td>'.utf8_encode($key->tele_adicional).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_tele_adicional.' </td>
                    </tr>
                    <tr>
                        <th>Ciudad Adicional</th>
                        <td>'.utf8_encode($key->ciudad_adicional).' </td>
                        <th>Calificación</th>
                        <td>'.$key->cal_ciudad_adicional.' </td>
                    </tr>
                    <tr>
                        <th>Fecha Registro</th>
                        <td>'.$fecha[2]."/".$fecha[1]."/".$fecha[0].' </td>
                    </tr>
                    </tbody></table>
                ';

            }

        }else{
            $this->load->view('Login/login');
        }
        
    }
    

    function guardarDatosadicionales(){
        if($this->session->userdata('login_ok')){

           // $this->load->helper('date');
            //$datestring = "%Y-%m-%d %h:%s:%i";
            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $idUsuario = $_POST['ID_PERSONAS'];

            $CORREO_ELECTRONICO = NULL;
            $TELEFONO = NULL;
            $DIRECCION = NULL;
            $CIUDAD = NULL;
            $DESCRIPCION = NULL;
            $ID_PERSONAS = NULL;
            $selCalificacionCorreo = 0;
            $selCalificacionTelefono = 0;
            $selCalificacionDireccion = 0;
            $selCalificacionCiudad = 0;  
            
            if(!is_null($_POST['CORREO_ELECTRONICO']) && $_POST['CORREO_ELECTRONICO'] != ''){
                $CORREO_ELECTRONICO = $_POST['CORREO_ELECTRONICO'];
            } 

            if(!is_null($_POST['TELEFONO']) && $_POST['TELEFONO'] != ''){
                $TELEFONO = $_POST['TELEFONO'];
            }       

            if(!is_null($_POST['DIRECCION']) && $_POST['DIRECCION'] != ''){
                $DIRECCION = utf8_decode($_POST['DIRECCION']);
            } 

            if(!is_null($_POST['CIUDAD']) && $_POST['CIUDAD'] != ''){
                $CIUDAD = $_POST['CIUDAD'];
            } 


            if( $_POST['selCalificacionCorreo'] != 0){
                $selCalificacionCorreo = $_POST['selCalificacionCorreo'];
            } 

            if( $_POST['selCalificacionTelefono'] != 0){
                $selCalificacionTelefono = $_POST['selCalificacionTelefono'];
            } 

            if( $_POST['selCalificacionDireccion'] != 0){
                $selCalificacionDireccion = $_POST['selCalificacionDireccion'];
            } 

            if( $_POST['selCalificacionCiudad'] != 0){
                $selCalificacionCiudad = $_POST['selCalificacionCiudad'];
            } 

            if( $CORREO_ELECTRONICO == '' && $TELEFONO == '' && $DIRECCION == '' && $CIUDAD == '' && $selCalificacionCorreo == 0 && $selCalificacionTelefono == 0 && $selCalificacionDireccion == 0 && $selCalificacionCiudad == 0 ){

            }else{
                $datos = array(
                    'G743_C17363' => $CORREO_ELECTRONICO,
                    'G743_C17256' => $TELEFONO,
                    'G743_C17257' => $DIRECCION,
                    'G743_C17258' => $CIUDAD,
                   
                    'G743_C17260' => utf8_decode($_POST['DESCRIPCION']),
                    'G743_C17261' => $_POST['ID_PERSONAS'],
                    'G743_C17361' => $fechaIngreso,

                    'G743_C17262' => $selCalificacionCorreo,
                    'G743_C17263' => $selCalificacionTelefono,
                    'G743_C17264' => $selCalificacionDireccion,
                    'G743_C17265' => $selCalificacionCiudad,
                    'G743_C17267' => $_POST['obligaciones'],
                    'G743_C17268' => $_POST['DeudoresAqui'],
                    'G743_C17269' => $_POST['rolUsers_']
                );

                /* $datos = array(
                    'G743_C17363' => $CORREO_ELECTRONICO,
                    'G743_C17256' => $TELEFONO,
                    'G743_C17257' => $DIRECCION,
                    'G743_C17258' => $CIUDAD,
                   
                    'G743_C17260' => utf8_decode($_POST['DESCRIPCION']),
                    'G743_C17261' => $_POST['ID_PERSONAS'],
                    'G743_C17361' => $fechaIngreso,

                    'G743_C17262' => $selCalificacionCorreo,
                    'G743_C17263' => $selCalificacionTelefono,
                    'G743_C17264' => $selCalificacionDireccion,
                    'G743_C17265' => $selCalificacionCiudad
                );*/
            }
           
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G743', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G743', $datos, $_POST['ID_PERSONAS'], 'G743_C17261');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


    function eliminarDatosAdicionales(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G743', $_POST['ID_PERSONAS'], 'G743_C17261');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    //Acuerdos de pago
    function acuerdosPago(){
        if($this->session->userdata('login_ok')){
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIacuerdos');
			
			$clientes = $this->Extrajudicial_Model->getClientesacuerdoPago();
			$datos = array('clientes' => $clientes);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/acuerdospago',$datos  );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }
	
	function getdatosAcuerdo_pago($id){
		
		if($this->session->userdata('login_ok')){
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIacuerdos');
			$clientes = $this->Extrajudicial_Model->getDatosAcuerdosdePago($id);
			echo json_encode($clientes);
        }else{
            $this->load->view('Login/login');
        }
	}
	
	function eliminarAcuerdoPago(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('AcuerdosPago', $_POST['id'], 'Id');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }
	
	function guardarAcuerdoDePago(){
		 if($this->session->userdata('login_ok')){

			date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");
			

           
            $legalizacion = '';
            $ValorAcuerdo = '';
            $Cuota = '';
            $tazadeinterez = '';

            

            if(isset($_POST['Legalizacion'])){
                $legalizacion = $_POST['Legalizacion'];
            }

            if(isset($_POST['ValorAcuerdo'])){
                $ValorAcuerdo = $_POST['ValorAcuerdo'];
            }

            if(isset($_POST['AcuerdoPlazo'])){
                $Cuota = $_POST['AcuerdoPlazo'];
            }

            if(isset($_POST['TazaInteres'])){
                 $tazadeinterez = $_POST['TazaInteres'];
            }

            $datos = array(
                    'FechaPagoUltimaCuota' => $_POST['const_contrato_'],
                    'NumeroContrato' => $_POST['FechaLiquidacion'],
                    'FechaLiquidacion' => $_POST['FechaAnticipo'],
                    'FechaConsignacionAnticipo' => $legalizacion,
					'FechaLegalizacion' => $ValorAcuerdo,
                    'ValorRecaudo' => $_POST['AcuerdoPlazo'],
                    'PlazoAcuerdoPago' => $Cuota,
					'ValorCuotaAcuerdo' => $_POST['FechaPrimeraCuoota'],
					'FechaPagoPrimeraCuota' => $_POST['FechaPagoUltimaCuota'],
					'TasaInteresCorrienteAcuerdoPago' => $tazadeinterez
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('AcuerdosPago', $datos);
            }else{
                $datos = array(
                    'FechaPagoUltimaCuota' => $_POST['const_contrato_'],
                    'NumeroContrato' => $_POST['FechaLiquidacion'],
                    'FechaLiquidacion' => $_POST['FechaAnticipo'],
                    'ValorRecaudo' => $_POST['AcuerdoPlazo'],
                    'ValorCuotaAcuerdo' => $_POST['FechaPrimeraCuoota'],
                    'FechaPagoPrimeraCuota' => $_POST['FechaPagoUltimaCuota']
                  );


                $resultado = $this->Wizard_Model->editarDatos('AcuerdosPago', $datos, $_POST['id'], 'Id');
                $Cuota =  $_POST['AcuerdoPlazo'];
                
                $this->db->where('cor_acuerdo_de_pago', $_POST['id']);
                $this->db->delete('Tabla_control_correos_acuerdos_pago');
                
                for ($i=0; $i < $Cuota; $i++) { 
                    $fechaCuota = strtotime ( '+'.$i.' month' , strtotime ( $_POST['FechaPrimeraCuoota'] ) ) ;
                    $nuevaFecha = date ( 'Y-m-d' , $fechaCuota );
                    
                    $datosAcuerdo = array( 'cor_acuerdo_de_pago' => $_POST['id'],
                                           'cor_fecha_pago_cuota' => $nuevaFecha,
                                           'cor_estado_correo' => 'NOENVIADO' );
                    $insert = $this->db->insert('Tabla_control_correos_acuerdos_pago', $datosAcuerdo);
                }
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
	}


    //aux Despachos
    function despachos(){
        if($this->session->userdata('login_ok')){
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIdespacho');

            $despachos = $this->Configuraciones_Model->getDespachos();
            $ciudades = $this->Configuraciones_Model->getCiudades();
            $data = array('ciudades' => $ciudades, 'despachos' => $despachos);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/despachos',$data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getdatosDespachos($idEtapa){
       if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getDespachosById($idEtapa);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['despacho'] = utf8_encode($key->despacho);
                $datos[$i]['ciudas'] = $key->ciudad;
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarDatosDespachos(){
      if($this->session->userdata('login_ok')){

        date_default_timezone_set('America/Bogota');
        $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array(
                    'Despacho' => utf8_decode($_POST['despacho']),
                    'CiudadDespacho' => $_POST['selpaises']
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('Despacho', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('Despacho', $datos, $_POST['id'], 'Id');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


    function eliminarDespachos(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('Despacho', $_POST['id'], 'Id');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


    //etapas
    function etapas(){
        if($this->session->userdata('login_ok')){
            $procesos = $this->CarteraFng_Model->getListasLisop(191);
            $etapas = $this->Configuraciones_Model->getetapas();
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIetapas');
			
            $data = array('procesos' => $procesos, 'etapas' => $etapas);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/etapas',$data );
            $this->load->view('Includes/footer',$datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getdatosEtapas($idEtapa){
       if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getetapasById($idEtapa);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->G725_ConsInte__b;
                $datos[$i]['etapa'] = utf8_encode($key->Etapa);
                $datos[$i]['codigo'] = $key->Codigo;
                $datos[$i]['proceso'] = $key->proceso;
                $datos[$i]['Campo_orden'] = $key->Campo_orden;
                $datos[$i]['Campo_Imagen'] = base_url()."assets/imagenes/etapas/".$key->Campo_Imagen;
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarDatosEtapas(){
        if($this->session->userdata('login_ok')){

            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");
            $datos = array();

            if($_POST['hidenesto'] == '0'){
                $datos = array(
                    'G725_C17108' => utf8_decode($_POST['etapa']),
                    'G725_C17107' => $_POST['codigo'],
                    'G725_C17106' => $_POST['selProcesos'],
                    'G725_Usuario' => $this->session->userdata('identificacion'),
                    'Campo_orden'  => $_POST['Orden']
                  );
            }else{
                $serv = $_SERVER['DOCUMENT_ROOT']."CRMApps/secured/assets/";

                $ruta = $serv."imagenes";
                if(!file_exists($ruta))
                {
                    mkdir($ruta);
                }

                $etapas = $ruta."/etapas";
                if(!file_exists($etapas)){
                     mkdir($etapas);
                }
                       

                $extencion = explode('.', basename($_FILES['bottonCara']['name']));
                $nombre = md5('Etapa'.rand().$extencion[0]);    
                $target_path = $etapas.'/'.$nombre.'.'.$extencion[1]; 
                $target_path = str_replace(' ', '', $target_path);
                
                
                copy($_FILES['bottonCara']['tmp_name'], $target_path);
                $fileName = $nombre.'.'.$extencion[1]; 
                $fileName = str_replace(' ', '', $fileName);

                $datos = array(
                    'G725_C17108' => utf8_decode($_POST['etapa']),
                    'G725_C17107' => $_POST['codigo'],
                    'G725_C17106' => $_POST['selProcesos'],
                    'G725_Usuario' => $this->session->userdata('identificacion'),
                    'Campo_orden'  => $_POST['Orden'],
                    'Campo_Imagen' => $fileName
                );

            }
            
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G725', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G725', $datos, $_POST['id'], 'G725_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


    function eliminarEtapas(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G725', $_POST['id'], 'G725_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


    //facturas
    function facturas(){
        if($this->session->userdata('login_ok')){
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIfacturas');
            $datosSIno = $this->CarteraFng_Model->getListasLisop(159);
            $datosPasysalvo = $this->CarteraFng_Model->getListasLisop(199);
            $obliogaciones = $this->Obligaciones_Model->getObligaciones();
            $conseptoSubrogacion =  $this->Conceptos_Model->Conceptos__aPagar_by_codigo('AUX001');
            $conseptoIrrecuperables =  $this->Conceptos_Model->Conceptos__aPagar_by_codigo('AUX002');
            $conseptoHonorarios =  $this->Conceptos_Model->Conceptos__aPagar_by_codigo('AUX004');
            $datos = array();
            $i = 0;
            $nuevo = 0;
            $viejo = 0;
            foreach ($obliogaciones as $key) {
                
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $nuevo = $key->liquidacion;
                    if($nuevo != $viejo){
                        $datos[$i]['obligacion'] = $key->liquidacion;
                        $datos[$i]['Id'] = $key->Id;
                        $i++; 
                    }
                    $viejo = $nuevo;
                    
                }

            }

            $data = array('obligaciones' => json_encode($datos), 'sino' => $datosSIno, 'renucia' => $datosPasysalvo, 'subrogaciones' => $conseptoSubrogacion, 'Irrecuperables' => $conseptoIrrecuperables, 'Honorarios' => $conseptoHonorarios);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/facturas',  $data);
            $this->load->view('Includes/footer',$datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

     function getDatosFacturasForupdate($Contrato){
        if($this->session->userdata('login_ok')){
            $datosObligacion = $this->Wizard_Model->getFacturas($Contrato);
            $tablaExtraJudicial  = '';
            $datos = array();
            $i = 0;
            foreach ($datosObligacion as $key) {
                $FECHA = NULL;
                $otra = NULL;
                $fachaE = NULL;
                $fechaD = NULL;
                $Ffecha1 = NULL;
                $tfech = NULL;
                $ver = NULL;
                $j = NULL;


                if(!is_null($key->FECHA_DE_FACTURA_AUTO_DE_SUBROGACION)){
                    $FECHA = explode(" ", $key->FECHA_DE_FACTURA_AUTO_DE_SUBROGACION)[0];
                    $FECHA = explode("-", $FECHA);
                    $FECHA = $FECHA[2] ."/". $FECHA[1] ."/". $FECHA[0];
                }
                

                if(!is_null($key->FECHA_AUTO_DE_SUBROGACION)){
                    $otra = explode(" ", $key->FECHA_AUTO_DE_SUBROGACION)[0];
                    $otra = explode("-",  $otra);
                    $otra = $otra[2]."/". $otra[1]. "/". $otra[0] ;
                }

                if(!is_null($key->FECHA_SENTENCIA_IRRECUPERABLE)){
                    $fachaE = explode(" ", $key->FECHA_SENTENCIA_IRRECUPERABLE)[0];
                    $fachaE = explode("-", $fachaE);
                    $fachaE = $fachaE[2]."/". $fachaE[1]."/". $fachaE[0];
                }

                if(!is_null($key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)){
                    $fechaD = explode(" ", $key->FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE)[0];
                    $fechaD = explode("-", $fechaD);
                    $fechaD = $fechaD[2]."/". $fechaD[1]."/". $fechaD[0];
                }   

                if(!is_null($key->FECHA_LIQUIDACION_CREDITO)){
                    $Ffecha1 = explode(" ", $key->FECHA_LIQUIDACION_CREDITO)[0];
                    $Ffecha1 = explode("-", $Ffecha1);
                    $Ffecha1 = $Ffecha1[2]."/". $Ffecha1[1]."/". $Ffecha1[0];
                }

                if(!is_null($key->FECHA_AUTO_IRRECUPERABLE)){
                    $tfech = explode(" ", $key->FECHA_AUTO_IRRECUPERABLE)[0];
                    $tfech = explode("-",  $tfech);
                    $tfech = $tfech[2]."/". $tfech[1]."/". $tfech[0];
                }


                if(!is_null($key->FECHA_FACTURA_SOPORTES_CISA)){
                    $ver = explode(" ", $key->FECHA_FACTURA_SOPORTES_CISA)[0];
                    $ver = explode("-", $ver);
                    $ver = $ver[2]."/". $ver[1]."/". $ver[0];
                }

                if(!is_null($key->Fecha_de_factura_honorarios_venta_CISA)){
                    $j = explode(" ", $key->Fecha_de_factura_honorarios_venta_CISA)[0];
                    $j = explode("-", $j);
                    $j = $j[2]."/". $j[1]."/". $j[0];
                }

                $aprbacion = NULL;
                if(!is_null($key->Fecha_aprovacion_soporte)){
                    $aprbacion = explode(" ", $key->Fecha_aprovacion_soporte)[0];
                    $aprbacion = explode("-", $aprbacion);
                    $aprbacion = $aprbacion[2]."/". $aprbacion[1]."/". $aprbacion[0];
                }

                $recepion = NULL;
                if(!is_null($key->FechaRecepcionSoporte)){
                    $recepion = explode(" ", $key->FechaRecepcionSoporte)[0];
                    $recepion = explode("-", $recepion);
                    $recepion = $recepion[2]."/". $recepion[1]."/". $recepion[0];
                }

                $datos[$i]['FECHA_DE_FACTURA_AUTO_DE_SUBROGACION'] = $FECHA;
                $datos[$i]['FECHA_AUTO_DE_SUBROGACION'] =  $otra;
                $datos[$i]['N_DE_FACTURA_AUTO_DE_SUBROGACION'] = $key->N_DE_FACTURA_AUTO_DE_SUBROGACION;
                $datos[$i]['VALOR_FACTURADO_AUTO_DE_SUBROGACION'] = $key->VALOR_FACTURADO_AUTO_DE_SUBROGACION;
                
                $datos[$i]['FECHA_SENTENCIA_IRRECUPERABLE'] = $fachaE;
                $datos[$i]['FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE'] = $fechaD;
                $datos[$i]['FECHA_LIQUIDACION_CREDITO'] = $Ffecha1;
                $datos[$i]['N_DE_FACTURA_SENTENCIA_IRRECUPERABLE'] = $key->N_DE_FACTURA_SENTENCIA_IRRECUPERABLE;
                $datos[$i]['VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE'] = $key->VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE;
                
                $datos[$i]['FECHA_FACTURA_SOPORTES_CISA'] = $ver;
                $datos[$i]['Fecha_de_factura_honorarios_venta_CISA'] = $j;
                $datos[$i]['N_DE_FACTURAS_SOPORTES_CISA'] = $key->N_DE_FACTURAS_SOPORTES_CISA;
                $datos[$i]['SOPORTE'] = $key->SOPORTE;
                $datos[$i]['RENUNCIA_Y_PAZ_Y_SALVO_O_CESION'] = $key->RENUNCIA_Y_PAZ_Y_SALVO_O_CESION;
                $datos[$i]['VALOR_FACTURADO_SOPORTES_CISA'] = $key->VALOR_FACTURADO_SOPORTES_CISA;
                $datos[$i]['N_Factura_honorarios_venta_CISA'] = $key->N_Factura_honorarios_venta_CISA;
                $datos[$i]['HONORARIOS_VENTA_CISA'] = number_format($key->HONORARIOS_VENTA_CISA, 0, ',', '.');
                $datos[$i]['FECHA_AUTO_DE_SUBROGACION2'] = $tfech;
                $datos[$i]['FECHAAPROBACION'] = $aprbacion;
                $datos[$i]['FECHARECPCION'] = $recepion;
                $datos[$i]['id'] = $key->Id;
                $i++;
            }
            echo json_encode($datos);
        }else{
            echo "No tienes Permiso para ver este contenido!";
        }
    } 

    function guardarFacturas(){
        if($this->session->userdata('login_ok')){

            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

            $FechaFacturacionAutoSubRogacion = NULL;
            $NroFacturaAutoSubRogacion = NULL; 
            $FechaAutoSubRogacion = NULL;
            $NroFacturaSentenciaIrrecuperable = NULL;
            $FechaSentenciaIrrecuperable = NULL;
            $FechaFacturaSentenciaIrrecuperable = NULL;
            $NroFacturaSoporteCISA = NULL;
            $FechaLiquidacionCredito = NULL;
            $FechaAutoIrrecuperable = NULL;
            $Soporte = NULL;
            $FechaFacturaSoporteCISA = NULL;
            $FechaFacturaSoporteCISA_ = NULL;
            $ValorFacturadoSentenciaIrrecuperable = NULL;
            $ValorFacturadoSoporteCISA = NULL;
            $FechaFacturaHonorarioCISA1 = NULL;
            $NumeroContratoId = NULL;
            $FechaFacturaHonorarioCISA2 = NULL;
            $FechaFacturaHonorarioCISA3 = NULL;
            $FechaFacturaHonorarioCISA4 = NULL;
            $txtFechaRecepcion = NULL;
            $txtFechaAprobacion = NULL;

            if($_POST['txtFechaFacuraSub'] != '' && $_POST['txtFechaFacuraSub'] != NULL){
                $FechaFacturacionAutoSubRogacion = $_POST['txtFechaFacuraSub'];
            }

            if($_POST['txtFacturaAutoSub'] != '' && $_POST['txtFacturaAutoSub'] != NULL){
                $NroFacturaAutoSubRogacion = $_POST['txtFacturaAutoSub'];
            }

            if($_POST['txtFechaAutoSub'] != '' && $_POST['txtFechaAutoSub'] != NULL){
                $FechaAutoSubRogacion = $_POST['txtFechaAutoSub'];
            }

            if($_POST['txtFacturaSentenciaIrr'] != '' && $_POST['txtFacturaSentenciaIrr'] != NULL){
                $NroFacturaSentenciaIrrecuperable = $_POST['txtFacturaSentenciaIrr'];
            }

            if($_POST['txtFechaSentenciaIrr'] != '' && $_POST['txtFechaSentenciaIrr'] != NULL){
                $FechaSentenciaIrrecuperable = $_POST['txtFechaSentenciaIrr'];
            }

            if($_POST['txtFechaFacturaIrr'] != '' && $_POST['txtFechaFacturaIrr'] != NULL){
                $FechaFacturaSentenciaIrrecuperable = $_POST['txtFechaFacturaIrr'];
            }

            if($_POST['txtFechaLiquidacionIrr'] != '' && $_POST['txtFechaLiquidacionIrr'] != NULL){
                $FechaLiquidacionCredito = $_POST['txtFechaLiquidacionIrr'];
            }

            if($_POST['txtFechaAutoSubrogacionIrr'] != '' && $_POST['txtFechaAutoSubrogacionIrr'] != NULL){
                $FechaAutoIrrecuperable = $_POST['txtFechaAutoSubrogacionIrr'];
            }

            if($_POST['txtValorFacturadoAutoSub'] != '' && $_POST['txtValorFacturadoAutoSub'] != NULL){
               $FechaFacturaSoporteCISA = $_POST['txtValorFacturadoAutoSub'];
            }

            if($_POST['txtFechaFacturaCISA'] != '' && $_POST['txtFechaFacturaCISA'] != NULL){
                $FechaFacturaSoporteCISA_ = $_POST['txtFechaFacturaCISA'];
            }

            if(isset($_POST['txtValorFActuradoIrr'])){
                if($_POST['txtValorFActuradoIrr'] != '' && $_POST['txtValorFActuradoIrr'] != NULL){
                    $ValorFacturadoSentenciaIrrecuperable = $_POST['txtValorFActuradoIrr'];
                }
            }
            

            if($_POST['txtValoFacturadoCISA'] != '' && $_POST['txtValoFacturadoCISA'] != NULL){
                $ValorFacturadoSoporteCISA = $_POST['txtValoFacturadoCISA'];

            }
            
            if($_POST['txtRenunciaCISA'] != '' && $_POST['txtRenunciaCISA'] != NULL){
                $FechaFacturaHonorarioCISA1 = $_POST['txtRenunciaCISA'];
            }

            if($_POST['NumeroContrato'] != '' && $_POST['NumeroContrato'] != NULL){
                $NumeroContratoId = $_POST['NumeroContrato'];
            }

            if($_POST['txtHonorariosVentaCISA'] != '' && $_POST['txtHonorariosVentaCISA'] != NULL){
                $FechaFacturaHonorarioCISA2 = $_POST['txtHonorariosVentaCISA'];
            }

            if($_POST['txtFacturaHonorariosCISA'] != '' && $_POST['txtFacturaHonorariosCISA'] != NULL){
                $FechaFacturaHonorarioCISA3 = $_POST['txtFacturaHonorariosCISA'];
            }

            if($_POST['txtFechaFacturaHonorariosCISA'] != '' && $_POST['txtFechaFacturaHonorariosCISA'] != NULL){
                $FechaFacturaHonorarioCISA4 = $_POST['txtFechaFacturaHonorariosCISA'];
            }

            if($_POST['txtSoporteCISA'] != '' && $_POST['txtSoporteCISA'] != NULL){
                $Soporte = $_POST['txtSoporteCISA'];
            }

            if($_POST['txtFacturaCISA'] != '' && $_POST['txtFacturaCISA'] != NULL){
                $NroFacturaSoporteCISA = $_POST['txtFacturaCISA'];
            }

            if(isset($_POST['txtFechaRecepcion'] )){
                if($_POST['txtFechaRecepcion']  != '' && $_POST['txtFechaRecepcion'] != NULL){
                    $txtFechaRecepcion = $_POST['txtFechaRecepcion'];
                }
            }
            if(isset($_POST['txtFechaAprobacion'] )){
                if($_POST['txtFechaAprobacion']  != '' && $_POST['txtFechaAprobacion'] != NULL){
                    $txtFechaAprobacion = $_POST['txtFechaAprobacion'];
                }
            }

            
             
            $datos = array(
                    'FechaFacturacionAutoSubRogacion' => $FechaFacturacionAutoSubRogacion,
                    'NroFacturaAutoSubRogacion' => $NroFacturaAutoSubRogacion, 
                    'FechaAutoSubRogacion' => $FechaAutoSubRogacion,
                    'NroFacturaSentenciaIrrecuperable' => $NroFacturaSentenciaIrrecuperable,
                    'FechaSentenciaIrrecuperable' => $FechaSentenciaIrrecuperable,
                    'FechaFacturaSentenciaIrrecuperable' => $FechaFacturaSentenciaIrrecuperable,
                    'NroFacturaSoporteCISA' => $NroFacturaSoporteCISA,
                    'FechaLiquidacionCredito' => $FechaLiquidacionCredito,
                    'FechaAutoIrrecuperable' => $FechaAutoIrrecuperable,
                    'Soporte' => $Soporte,
                    'FechaFacturaSoporteCISA' => $FechaFacturaSoporteCISA,
                    'FechaFacturaSoporteCISA_' => $FechaFacturaSoporteCISA_,
                    'ValorFacturadoSentenciaIrrecuperable' => $ValorFacturadoSentenciaIrrecuperable,
                    'ValorFacturadoSoporteCISA' => $ValorFacturadoSoporteCISA,
                    'FechaFacturaHonorarioCISA1' => $FechaFacturaHonorarioCISA1,
                    'NumeroContratoId' => $NumeroContratoId,
                    'FechaFacturaHonorarioCISA2' => $FechaFacturaHonorarioCISA2,
                    'FechaFacturaHonorarioCISA3' => $FechaFacturaHonorarioCISA3,
                    'FechaFacturaHonorarioCISA4' => $FechaFacturaHonorarioCISA4,
                    'FechaRecepcionSoporte' => $txtFechaRecepcion, 
                    'Fecha_aprovacion_soporte' => $txtFechaAprobacion,
                    'FechaInsercion' => $fechaIngreso,

                    'Usuario' => $this->session->userdata('identificacion')
                  );

            $this->db->select('G719_C17423');
            $this->db->from('InformacionCredito');
            $this->db->where('Id', $NumeroContratoId);
            $query = $this->db->get();
            $liquidacion = 0;
            if( $query->num_rows() >  0){
                if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                    $liquidacion = $query->row()->G719_C17423;
                }
            }else{
                $this->db->select('G719_C17423');
                $this->db->from('InformacionCredito');
                $this->db->where('G719_C17423', $NumeroContratoId);
                $query = $this->db->get();
                if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                    $liquidacion = $query->row()->G719_C17423;
                }
            }

            $resultado = false;
            if($_POST['id'] == '0'){
                if($liquidacion == 0){
                    $resultado = $this->Wizard_Model->guardardatos('Factura', $datos);
                }else{
                    $this->db->select('Id');
                    $this->db->from('InformacionCredito');
                    $this->db->where('G719_C17423', $liquidacion);
                    $query = $this->db->get();
                    $variable = $query->result();
                    $resultado = false;
                    foreach ($variable as $key) {
                         $datos = array(
                                'FechaFacturacionAutoSubRogacion' => $FechaFacturacionAutoSubRogacion,
                                'NroFacturaAutoSubRogacion' => $NroFacturaAutoSubRogacion, 
                                'FechaAutoSubRogacion' => $FechaAutoSubRogacion,
                                'NroFacturaSentenciaIrrecuperable' => $NroFacturaSentenciaIrrecuperable,
                                'FechaSentenciaIrrecuperable' => $FechaSentenciaIrrecuperable,
                                'FechaFacturaSentenciaIrrecuperable' => $FechaFacturaSentenciaIrrecuperable,
                                'NroFacturaSoporteCISA' => $NroFacturaSoporteCISA,
                                'FechaLiquidacionCredito' => $FechaLiquidacionCredito,
                                'FechaAutoIrrecuperable' => $FechaAutoIrrecuperable,
                                'Soporte' => $Soporte,
                                'FechaFacturaSoporteCISA' => $FechaFacturaSoporteCISA,
                                'FechaFacturaSoporteCISA_' => $FechaFacturaSoporteCISA_,
                                'ValorFacturadoSentenciaIrrecuperable' => $ValorFacturadoSentenciaIrrecuperable,
                                'ValorFacturadoSoporteCISA' => $ValorFacturadoSoporteCISA,
                                'FechaFacturaHonorarioCISA1' => $FechaFacturaHonorarioCISA1,
                                'NumeroContratoId' => $key->Id,
                                'FechaFacturaHonorarioCISA2' => $FechaFacturaHonorarioCISA2,
                                'FechaFacturaHonorarioCISA3' => $FechaFacturaHonorarioCISA3,
                                'FechaFacturaHonorarioCISA4' => $FechaFacturaHonorarioCISA4,
                                'FechaRecepcionSoporte' => $txtFechaRecepcion, 
                                'Fecha_aprovacion_soporte' => $txtFechaAprobacion,
                                'FechaInsercion' => $fechaIngreso,
                                'Usuario' => $this->session->userdata('identificacion')
                            );
                        $resultado = $this->Wizard_Model->guardardatos('Factura', $datos);
                    }
                }
                
            }else{
                    //2016-02-16

                $FechaFacturacionAutoSubRogacion = NULL;
                $NroFacturaAutoSubRogacion = NULL; 
                $FechaAutoSubRogacion = NULL;
                $NroFacturaSentenciaIrrecuperable = NULL;
                $FechaSentenciaIrrecuperable = NULL;
                $FechaFacturaSentenciaIrrecuperable = NULL;
                $NroFacturaSoporteCISA = NULL;
                $FechaLiquidacionCredito = NULL;
                $FechaAutoIrrecuperable = NULL;
                $Soporte = NULL;
                $FechaFacturaSoporteCISA = NULL;
                $FechaFacturaSoporteCISA_ = NULL;
                $ValorFacturadoSentenciaIrrecuperable = NULL;
                $ValorFacturadoSoporteCISA = NULL;
                $FechaFacturaHonorarioCISA1 = NULL;
                $NumeroContratoId = NULL;
                $FechaFacturaHonorarioCISA2 = NULL;
                $FechaFacturaHonorarioCISA3 = NULL;
                $FechaFacturaHonorarioCISA4 = NULL;
                $txtFechaRecepcion = NULL;
                $txtFechaAprobacion = NULL;


                if($_POST['txtFechaFacuraSub'] != '' && $_POST['txtFechaFacuraSub'] != NULL){
                    $pos = strpos($_POST['txtFechaFacuraSub'], '/');
                    if($pos === false){
                        $FechaFacturacionAutoSubRogacion = $_POST['txtFechaFacuraSub'];
                    }else{
                        $fecha1 = explode("/", $_POST['txtFechaFacuraSub']);
                        $FechaFacturacionAutoSubRogacion = $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                    }
                    
                }

                if($_POST['txtFacturaAutoSub'] != '' && $_POST['txtFacturaAutoSub'] != NULL){
                    $NroFacturaAutoSubRogacion = $_POST['txtFacturaAutoSub'];
                }

                if($_POST['txtFechaAutoSub'] != '' && $_POST['txtFechaAutoSub'] != NULL){
                    $pos = strpos($_POST['txtFechaAutoSub'], '/');
                    if($pos === false){
                        $FechaAutoSubRogacion = $_POST['txtFechaAutoSub'];
                    }else{
                        $fecha2 = explode("/", $_POST['txtFechaAutoSub']);
                        $FechaAutoSubRogacion = $fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
                    }
                    
                }

                if($_POST['txtFacturaSentenciaIrr'] != '' && $_POST['txtFacturaSentenciaIrr'] != NULL){
                    $NroFacturaSentenciaIrrecuperable = $_POST['txtFacturaSentenciaIrr'];
                }

                if($_POST['txtFechaSentenciaIrr'] != '' && $_POST['txtFechaSentenciaIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaSentenciaIrr'], '/');
                    if($pos === false){
                        $FechaSentenciaIrrecuperable = $_POST['txtFechaSentenciaIrr'];
                    }else{
                        $fecha3 = explode("/", $_POST['txtFechaSentenciaIrr']);
                        $FechaSentenciaIrrecuperable = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];
                    }
                    
                }

                if($_POST['txtFechaFacturaIrr'] != '' && $_POST['txtFechaFacturaIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaFacturaIrr'], '/');
                    if($pos === false){
                        $FechaFacturaSentenciaIrrecuperable = $_POST['txtFechaFacturaIrr'];
                    }else{
                        $fecha4 = explode("/", $_POST['txtFechaFacturaIrr']);
                        $FechaFacturaSentenciaIrrecuperable = $fecha4[2]."-".$fecha4[1]."-".$fecha4[0];
                    }
                    
                }

                if($_POST['txtFechaLiquidacionIrr'] != '' && $_POST['txtFechaLiquidacionIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaLiquidacionIrr'], '/');
                    if($pos === false){
                        $FechaLiquidacionCredito = $_POST['txtFechaLiquidacionIrr'];
                    }else{
                        $fecha5 = explode("/", $_POST['txtFechaLiquidacionIrr']);
                        $FechaLiquidacionCredito = $fecha5[2]."-".$fecha5[1]."-".$fecha5[0];
                    }
                    
                }

                if($_POST['txtFechaAutoSubrogacionIrr'] != '' && $_POST['txtFechaAutoSubrogacionIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaAutoSubrogacionIrr'], '/');
                    if($pos === false){
                        $FechaAutoIrrecuperable = $_POST['txtFechaAutoSubrogacionIrr'];
                    }else{
                        $fecha6 = explode("/", $_POST['txtFechaAutoSubrogacionIrr']);
                        $FechaAutoIrrecuperable = $fecha6[2]."-".$fecha6[1]."-".$fecha6[0];
                    }

                }

                if($_POST['txtValorFacturadoAutoSub'] != '' && $_POST['txtValorFacturadoAutoSub'] != NULL){
                   $FechaFacturaSoporteCISA = $_POST['txtValorFacturadoAutoSub'];
                }

                if($_POST['txtFechaFacturaCISA'] != '' && $_POST['txtFechaFacturaCISA'] != NULL){
                    $pos = strpos($_POST['txtFechaFacturaCISA'], '/');
                    if($pos === false){
                        $FechaFacturaSoporteCISA_ = $_POST['txtFechaFacturaCISA'];
                    }else{
                        $fecha7 = explode("/", $_POST['txtFechaFacturaCISA']);
                        $FechaFacturaSoporteCISA_ =  $fecha7[2]."-".$fecha7[1]."-".$fecha7[0];
                    }

                }

                if($_POST['txtValorFActuradoIrr'] != '' && $_POST['txtValorFActuradoIrr'] != NULL){
                    $ValorFacturadoSentenciaIrrecuperable = $_POST['txtValorFActuradoIrr'];
                }

                if($_POST['txtValoFacturadoCISA'] != '' && $_POST['txtValoFacturadoCISA'] != NULL){
                    $ValorFacturadoSoporteCISA = $_POST['txtValoFacturadoCISA'];

                }
                
                if($_POST['txtRenunciaCISA'] != '' && $_POST['txtRenunciaCISA'] != NULL){
                    $FechaFacturaHonorarioCISA1 = $_POST['txtRenunciaCISA'];
                }

                if($_POST['NumeroContrato'] != '' && $_POST['NumeroContrato'] != NULL){
                    $NumeroContratoId = $_POST['NumeroContrato'];
                }

                if($_POST['txtHonorariosVentaCISA'] != '' && $_POST['txtHonorariosVentaCISA'] != NULL){
                    $FechaFacturaHonorarioCISA2 = $_POST['txtHonorariosVentaCISA'];
                }

                if($_POST['txtFacturaHonorariosCISA'] != '' && $_POST['txtFacturaHonorariosCISA'] != NULL){
                    $FechaFacturaHonorarioCISA3 = $_POST['txtFacturaHonorariosCISA'];
                }

                if($_POST['txtFechaFacturaHonorariosCISA'] != '' && $_POST['txtFechaFacturaHonorariosCISA'] != NULL){
                    $pos = strpos($_POST['txtFechaFacturaHonorariosCISA'], '/');
                    if($pos === false){
                        $FechaFacturaHonorarioCISA4 = $_POST['txtFechaFacturaHonorariosCISA'];
                    }else{
                        $fecha8 = explode("/", $_POST['txtFechaFacturaHonorariosCISA']);
                        $FechaFacturaHonorarioCISA4 = $fecha8[2]."-".$fecha8[1]."-".$fecha8[0];
                    }
                    
                }


                if($_POST['txtSoporteCISA'] != '' && $_POST['txtSoporteCISA'] != NULL){
                    $Soporte = $_POST['txtSoporteCISA'];
                }

                if($_POST['txtFacturaCISA'] != '' && $_POST['txtFacturaCISA'] != NULL){
                    $NroFacturaSoporteCISA = $_POST['txtFacturaCISA'];
                }


                if($_POST['txtFechaRecepcion'] != '' && $_POST['txtFechaRecepcion'] != NULL){
                    $pos = strpos($_POST['txtFechaRecepcion'], '/');
                    if($pos === false){
                        $txtFechaRecepcion = $_POST['txtFechaRecepcion'];
                    }else{
                        $fecha8 = explode("/", $_POST['txtFechaRecepcion']);
                        $txtFechaRecepcion = $fecha8[2]."-".$fecha8[1]."-".$fecha8[0];
                    }
                    
                }

                if($_POST['txtFechaAprobacion'] != '' && $_POST['txtFechaAprobacion'] != NULL){
                    $pos = strpos($_POST['txtFechaAprobacion'], '/');
                    if($pos === false){
                        $txtFechaAprobacion = $_POST['txtFechaAprobacion'];
                    }else{
                        $fecha8 = explode("/", $_POST['txtFechaAprobacion']);
                        $txtFechaAprobacion = $fecha8[2]."-".$fecha8[1]."-".$fecha8[0];
                    }
                    
                }

                $this->db->select('G719_C17423');
                $this->db->from('InformacionCredito');
                $this->db->where('Id', $NumeroContratoId);
                $query = $this->db->get();
                $liquidacion = 0;
                if( $query->num_rows() >  0){
                    if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                        $liquidacion = $query->row()->G719_C17423;
                    }
                }else{
                    $this->db->select('G719_C17423');
                    $this->db->from('InformacionCredito');
                    $this->db->where('G719_C17423', $NumeroContratoId);
                    $query = $this->db->get();
                    if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                        $liquidacion = $query->row()->G719_C17423;
                    }
                }

                

                

                $datos = array(
                    'FechaFacturacionAutoSubRogacion' => $FechaFacturacionAutoSubRogacion,
                    'NroFacturaAutoSubRogacion' => $NroFacturaAutoSubRogacion, 
                    'FechaAutoSubRogacion' => $FechaAutoSubRogacion,
                    'NroFacturaSentenciaIrrecuperable' => $NroFacturaSentenciaIrrecuperable,
                    'FechaSentenciaIrrecuperable' => $FechaSentenciaIrrecuperable,
                    'FechaFacturaSentenciaIrrecuperable' => $FechaFacturaSentenciaIrrecuperable,
                    'NroFacturaSoporteCISA' => $NroFacturaSoporteCISA,
                    'FechaLiquidacionCredito' => $FechaLiquidacionCredito,
                    'FechaAutoIrrecuperable' => $FechaAutoIrrecuperable,
                    'Soporte' => $Soporte,
                    'FechaFacturaSoporteCISA' => $FechaFacturaSoporteCISA,
                    'FechaFacturaSoporteCISA_' => $FechaFacturaSoporteCISA_,
                    'ValorFacturadoSentenciaIrrecuperable' => $ValorFacturadoSentenciaIrrecuperable,
                    'ValorFacturadoSoporteCISA' => $ValorFacturadoSoporteCISA,
                    'FechaFacturaHonorarioCISA1' => $FechaFacturaHonorarioCISA1,
                    'NumeroContratoId' => $NumeroContratoId,
                    'FechaFacturaHonorarioCISA2' => $FechaFacturaHonorarioCISA2,
                    'FechaFacturaHonorarioCISA3' => $FechaFacturaHonorarioCISA3,
                    'FechaFacturaHonorarioCISA4' => $FechaFacturaHonorarioCISA4,
                    'FechaInsercion' => $fechaIngreso,
                    'FechaRecepcionSoporte' => $txtFechaRecepcion, 
                    'Fecha_aprovacion_soporte' => $txtFechaAprobacion,
                    'Usuario' => $this->session->userdata('identificacion')
                );

                $resultado = $this->Wizard_Model->editarDatos('Factura', $datos, $_POST['id'], 'Id');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
            }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarFacturas(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('Factura', $_POST['id'], 'Id');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


    //gastos Judiciales
    function gastos_judiciales(){


        if($this->session->userdata('login_ok')){

            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIgastos');
            $conceptos = $this->CarteraFng_Model->getListasLisop(189);
            $i = 0;
            $dataset = array();
            $obliogaciones = $this->Obligaciones_Model->getObligaciones();
            foreach ($obliogaciones as $key) {
             
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $dataset[$i][0] = $key->liquidacion;
                }else{
                    $dataset[$i][0] = $key->No_CONTRATO;
                }

                
                $i++; 
            }

            $datos = array('valores' => json_encode($dataset), 'conceptos' => $conceptos);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/gastosjudiciales', $datos);
            $this->load->view('Includes/footer',$datosFooter);

        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosgastoJudiciales($contrato){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getDatosjudicialesByContrato($contrato);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->G745_ConsInte__b;
                $datos[$i]['CuentaCobro'] = $key->CuentaCobro;
                $datos[$i]['FechaCobro'] = explode(" ", $key->FechaCobro)[0];
                $datos[$i]['Valor'] = number_format($key->Valor);
                $datos[$i]['Otro'] = $key->Otro;
                $datos[$i]['Contrato'] = $key->Contrato;
                $datos[$i]['Concepto'] = utf8_encode($key->Concepto);
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarGastosJudiciales(){
        
        if($this->session->userdata('login_ok')){

        date_default_timezone_set('America/Bogota');
        $fechaIngreso =  date("Y-m-d H:i:s");

            $otros = '';
            if(isset($_POST['Otro'])){
                $otros = $_POST['Otro'];
            }
            $datos = array(
                    'G745_C17287' => utf8_decode($_POST['CuentaCobro']),
                    'G745_C17288' => $_POST['Concepto'],
                    'G745_C17289' => $_POST['FechaCobro'],
                    'G745_C17290' => $_POST['Valor'],
                    'G745_C17291' => $otros ,
                    'G745_C17292' => $_POST['NumeroContrato']
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G745', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G745', $datos, $_POST['id'], 'G745_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarGastosJudiciales(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G745', $_POST['id'], 'G745_C17292');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


     //Firmas de abogado
    function firmas_abogados(){
        if($this->session->userdata('login_ok')){
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIfirmas');
            $ciudades = $this->Configuraciones_Model->getCiudades();

            $this->db->select('[G728_C17116] as nombres
                              ,[G728_C17117] as telefono
                              ,[G728_C17118] as direccion
                              ,Ciudad as ciudad
                              ,[G728_C17120] as correo,
                              G728_ConsInte__b');
            $this->db->from('G728');
            $this->db->join('Ciudad','Id = G728_C17119');
            $query = $this->db->get();
            $datos = array('firmas' => $query->result(), 'ciudades' => $ciudades );
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/firmas', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosFirma($id){
        $this->db->select('[G728_C17116] as nombres
                              ,[G728_C17117] as telefono
                              ,[G728_C17118] as direccion
                              ,G728_C17119 as ciudad
                              ,[G728_C17120] as correo,
                              G728_ConsInte__b');
        $this->db->from('G728');
        $this->db->where('G728_ConsInte__b', $id);
        $query = $this->db->get();

        $datos = array();
        $i=0;
        $r = $query->result();
        foreach ( $r as $key) {
            $datos[$i]['nombres'] = utf8_encode($key->nombres);
            $datos[$i]['telefono'] = utf8_encode($key->telefono);
            $datos[$i]['direccion'] = utf8_encode($key->direccion);
            $datos[$i]['ciudad'] = utf8_encode($key->ciudad);
            $datos[$i]['correo'] = utf8_encode($key->correo);
            $datos[$i]['id'] = $key->G728_ConsInte__b;
            $i++;
        }

        echo json_encode($datos);
    }

    function getAbogadosByFirma($id){
        $this->db->select('Id as id, FRGId,  CCAbogado as cedula, Nombre as Nombre, Celular as celular, CorreoElectronico as correo, Direccion, Telefono');   
        $this->db->where('FirmaAbogado', $id);  
        $query = $this->db->get('Abogados');
        $datos = array();
        $i=0;
        $r = $query->result();
        foreach ( $r as $key) {
            $datos[$i]['Nombre'] = utf8_encode($key->Nombre);
            $datos[$i]['cedula'] = utf8_encode($key->cedula);
            $i++;
        }
        echo json_encode($datos);
    }

    function guardarFirmas(){
        if($this->session->userdata('login_ok')){
            $datos = array(
                            'G728_C17116' => utf8_decode($_POST['txtNombre']),
                            'G728_C17117' => utf8_decode($_POST['txtTelefono']),
                            'G728_C17118' => utf8_decode($_POST['TxtDireccion']),
                            'G728_C17119' => utf8_decode($_POST['cmbCiudades']),
                            'G728_C17120' => utf8_decode($_POST['correo'])
                        );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G728', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G728', $datos, $_POST['id'], 'G728_ConsInte__b');
            }

              if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarFirmas(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G728', $_POST['id'], 'G728_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

     //Frg
    function frg(){
        if($this->session->userdata('login_ok')){
            $frg  = $this->Configuraciones_Model->getFrgs();
            $ciudades = $this->Configuraciones_Model->getCiudades();
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIfrg');
			
            $datos = array('frg'=> $frg, 'ciudades' => $ciudades);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/frg', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosfrgbyId($id){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getDatosFrgs($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->Id;
                $datos[$i]['Frg'] = utf8_encode($key->Frg);
                $datos[$i]['direccion'] = utf8_encode($key->direccion);
                $datos[$i]['ciudad'] = utf8_encode($key->ciudad);
                $datos[$i]['telefono'] = $key->telefono;
                $datos[$i]['contacto'] = $key->contacto;
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarGastosFrg(){
        
        if($this->session->userdata('login_ok')){

        date_default_timezone_set('America/Bogota');
        $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array(
                    'FRG' => utf8_decode($_POST['frg']),
                    'Direccion' => $_POST['direccion'],
                    'Ciudad' => $_POST['selCiudades'],
                    'Telefono' => $_POST['telefono'],
                    'NombrePersonaContacto' => $_POST['contacto']
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('FRG', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('FRG', $datos, $_POST['id'], 'Id');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarGastosFrg(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('FRG', $_POST['id'], 'Id');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

     //GARANTIAs Y PAGARÉS
    function garantias_pagares(){
        if($this->session->userdata('login_ok')){
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIGarantias');
            $garantias = $this->Configuraciones_Model->getGarantias();
            $data = array('garantias' => json_encode($garantias));
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/garantias',  $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosgarantiabyGarantia($id){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getGarantiasByGarantia($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->G734_ConsInte__b;
                $datos[$i]['Garantia'] = $key->Garantia;
                $datos[$i]['Pagare'] = $key->pagare;
                $datos[$i]['Contrato'] = $key->contrato;
                $datos[$i]['idCn'] = $key->Id;
                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarGarantias(){
        
        if($this->session->userdata('login_ok')){

        date_default_timezone_set('America/Bogota');
        $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array(
                    'G734_C17135' => $_POST['garantia'],
                    'G734_C17136' => $_POST['pagare'],
                    'G734_C17241' => $_POST['NumeroCon']
                   
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G734', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G734', $datos, $_POST['id'], 'G734_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarGarantias(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G734', $_POST['id'], 'G734_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }



      //IF
    function if_(){
        if($this->session->userdata('login_ok')){
            $ids = $this->Configuraciones_Model->getIF();
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIif');
            $datos = array('ids' => $ids);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/if', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosIf($id){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getIFByid($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->Id;
                $datos[$i]['Ifs'] = $key->NombreIF;

                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarIf(){
        
        if($this->session->userdata('login_ok')){

        date_default_timezone_set('America/Bogota');
        $fechaIngreso =  date("Y-m-d H:i:s");

            $datos = array(
                    'NombreIF' => utf8_decode($_POST['Ifses'])
    
                   
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('IntermediarioFinanciero', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('IntermediarioFinanciero', $datos, $_POST['id'], 'Id');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarIf(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('IntermediarioFinanciero', $_POST['id'], 'Id');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }



      //Medidas Cautelares
    function medidas_cautelares(){
        if($this->session->userdata('login_ok')){
            $medias = $this->Configuraciones_Model->getMedidas();
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LImedidas');
			
            $datos = array('medidas' => $medias);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/medidas', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosMedidas($id){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getMedidasByid($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->G731_ConsInte__b;
                $datos[$i]['codigo'] = $key->codigo;
                $datos[$i]['descripcion'] = utf8_encode($key->descripcion);

                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarMedidas(){
        
        if($this->session->userdata('login_ok')){

            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

                           
            $datos = array(
                    'G731_C17127' => $_POST['codigo'],
                    'G731_C17128' => utf8_decode($_POST['descripcion'])
                   
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G731', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G731', $datos, $_POST['id'], 'G731_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarMedidas(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G731', $_POST['id'], 'G731_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    
      //personas
    function personas(){
        if($this->session->userdata('login_ok')){
            $rools = $this->CarteraFng_Model->getListasLisop(194);
            $obligaciones = $this->Configuraciones_Model->getObligacionesPersonas();
			
            $data = array();
            $i = 0;
            foreach($obligaciones as $key){
                $data[$i]['cliente'] = utf8_encode($key->nombre_Usuario) ;
                $data[$i]['contrato'] = $key->OBLIGACION ;
                $data[$i]['rol'] = utf8_encode($key->Roles) ;
                $data[$i]['id'] = $key->Id;
                $i++;
            }

            $datos = array('obligaciones' => json_encode($data), 'roles' =>$rools);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/personas', $datos);
            $this->load->view('Includes/footer');
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosRelacion($id){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Configuraciones_Model->getObligacionesPersonasByID($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->Id;
                $datos[$i]['idUsuario'] = $key->usuario;
                $datos[$i]['idcontrato'] = $key->contrato;
                $datos[$i]['idrol'] = $key->rol;

                $datos[$i]['usuario'] = $key->nombre_Usuario;
                $datos[$i]['contrato'] = utf8_encode($key->OBLIGACION);
                $datos[$i]['rol'] = utf8_encode($key->Roles);


                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarRelacion(){
        
        if($this->session->userdata('login_ok')){

            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

                           
            $datos = array(
                    'InformacionClientesId' => $_POST['usuario'],
                    'NumeroContratoId' => $_POST['contrato'],
                    'Rol' => $_POST['selRoles']
                   
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('ClienteObligacion', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('ClienteObligacion', $datos, $_POST['id'], 'Id');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarRelacion(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('ClienteObligacion', $_POST['id'], 'Id');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }


     //subgestion
    function subgestiones(){
        if($this->session->userdata('login_ok')){
            
            $getiones = $this->CarteraFng_Model->getListasLisop(193);
            $subgetiones = $this->Wizard_Model->getSubgestionestabla();
            $data = array('gestiones' => $getiones, 'subgestiones' => $subgetiones);
			$datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIsubgestiones');

            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/subgestiones', $data);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function getDatosSubgestion($id){
        if($this->session->userdata('login_ok')){
            $abogados = $this->Wizard_Model->getSubgestionestablaById($id);
            $datos = array();
            $i = 0;
            foreach ($abogados as $key) {
                $datos[$i]['id'] = $key->id;
                $datos[$i]['comn'] = $key->G732_C17129;
                $datos[$i]['gestion'] = $key->gestion;
                $datos[$i]['subgestion'] = utf8_encode($key->enunciado);

                $i++;
            }
            echo json_encode($datos);
        }else{
            $this->load->view('Login/login');
        } 
    }

    function guardarSubgestion(){
        
        if($this->session->userdata('login_ok')){

            date_default_timezone_set('America/Bogota');
            $fechaIngreso =  date("Y-m-d H:i:s");

                           
            $datos = array(
                    'G732_C17131' => utf8_decode($_POST['etapa']),
                    'G732_C17130' => $_POST['selgestiones'],
                    'G732_C17129' => $_POST['selResultado']
                   
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G732', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G732', $datos, $_POST['id'], 'G732_ConsInte__b');
            }

            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarSubgestion(){
        if($this->session->userdata('login_ok')){
            $resultado = false;
            $resultado = $this->Wizard_Model->borrarDatos('G732', $_POST['id'], 'G732_ConsInte__b');
            if($resultado){
                echo "1";
            }else{
                echo "Nada";
            }
        }else{
            $this->load->view('Login/login');
        }
    }

    //valores por
    function valores_conceptos_pagar(){
        if($this->session->userdata('login_ok')){
            
            $this->load->model("Conceptos_Model");
            $conceptos = $this->Conceptos_Model->Conceptos__aPagar();
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LiValConceptos');
            $datos = array("conceptos" => $conceptos);
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/conceptos_a_pagar', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }


    //Esto es para configurar los estados de extrajudicial


    //Esto es para configurar La gestion Extrajudicial

    //esto es para cargar los correos por el FRG
    function getCorreosFrg($frg){
        if($this->session->userdata('login_ok')){
           //$array = array('Nombres' => 'Jose David', 'Correo' => 'josegiron@outlook.es');
            
            $this->db->select('corr_correo, corr_nombre, corr_id');
            $this->db->from('Relacion_frg_correo');
            $this->db->where('corr_frg', $frg );
            $query = $this->db->get();
            $res = $query->result();
            $array  = array();
            $i= 0;
            foreach ($res as $key) {
                $array[$i]['Nombres'] = utf8_encode($key->corr_nombre);
                $array[$i]['Correo'] = $key->corr_correo;
                $array[$i]['buttones'] = '<button class="btn btn-sm btn-danger eliminador" datos="'.$key->corr_id.'"><i class="fa fa-trash"></i></button>';
                $i++;
            }
           
           echo json_encode($array);
        }else{
            $this->load->view('Login/login');
        }
    }

    function crearCorreoFng(){
        if($this->session->userdata('login_ok')){
           //$array = array('Nombres' => 'Jose David', 'Correo' => 'josegiron@outlook.es');
            $correo = $_POST['Correo'];
            $nombre = utf8_decode($_POST['Nombres']);
            $freg = $_POST['frg'];

            $array = array( 'corr_nombre' => $nombre
                            , 'corr_correo' => $correo 
                            , 'corr_frg' => $freg);
            
          if($this->db->insert('Relacion_frg_correo', $array)){
            echo 'Si';
          }else{
            echo 'No';
          }
        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarCorreoFng($id){
        if($this->session->userdata('login_ok')){
            //$array = array('Nombres' => 'Jose David', 'Correo' => 'josegiron@outlook.es');
            $this->db->where('corr_id', $id);
          if($this->db->delete('Relacion_frg_correo')){
            echo 'Si';
          }else{
            echo 'No';
          }
        }else{
            $this->load->view('Login/login');
        }
    }

    //Function para cargar las fechas de Envio Memoriales de terniacino
    function fechasEnvioTerminacion(){
        if($this->session->userdata('login_ok')){
            
            $this->load->model("Conceptos_Model");
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIFechaTer');
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/fechas_envio_terminacion');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function carguemasAbogadosSuperFNG(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
           
            
            $filtro = $_POST['filtro'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit','128M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $k = 1;
            $frg = '';
            
            $i = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != ""){
                        if($this->Wizard_Model->validarSAP($value['A'])){

                            $fechaAsignacin = explode('/', $value['B']);
                            $fechaAbogado = $fechaAsignacin[2]."-".$fechaAsignacin[1]."-".$fechaAsignacin[0];

                            $datos = array(
                                'G719_C17427' => $fechaAbogado
                            );


                            $resultado = false;
                            $resultado = $this->Wizard_Model->editarDatos('InformacionCredito', $datos, $value['A'], $filtro);

                            if($resultado){
                                $acertados += 1;
                            }else{
                                $fallos +=1;
                            }
                                                      
                        }else{
                            $fallosExistenciales +=1;
                        }
                        
                    }else{
                        $validador += 1;
                    }

                     $i++;
                }
            }

            //$this->envioCorreoMaxibo($usuarios, $abogado, $frg);

            $result['valid'] = "1";
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['noexisten'] = $fallosExistenciales;
            $result['registros'] = $i;
            $result['message'] = 'Datos Cargados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  

        }else{
            $this->load->view('Login/login');
        }

    }


    function SUperCargueABogados(){
        if($this->session->userdata('login_ok')){
            
            $filtro = $_POST['filtro'];
            $sap = $_POST['txtnumeroSap'];
            $fecha = $_POST['txtfecha'];
            if($this->Wizard_Model->validarSAP($sap)){
                $datos = array(
                                'G719_C17427' => $fecha
                            );
                $resultado = false;
                $resultado = $this->Wizard_Model->editarDatos('InformacionCredito', $datos, $sap, $filtro);

                if($resultado){  
                    //$this->mandarCorreo($sap, $abogado); 
                    echo "1";
                }else{
                    echo "No";
                }
            }else{
                echo 'NOP';
            }

        }else{
            $this->load->view('Login/login');
        }
    }

    function eliminarFactura(){
        if($this->session->userdata('login_ok')){
            
            $this->load->model("Conceptos_Model");
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIELiminarFacturas');
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/eliminarFacturas');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    function EliminarFacturaUnoUno(){
        if($this->session->userdata('login_ok')){
            
            $filtro = $_POST['filtro'];
            $factura = $_POST['txtnumeroSap'];
            
            $this->db->select('Id');
            $this->db->from('Factura');
            $this->db->where($filtro, $factura);
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $datos = array();
                
                if($filtro == 'NroFacturaAutoSubRogacion'){
                    //Subrogacion
                    $datos = array( 'FechaFacturacionAutoSubRogacion' => NULL, 
                                    'NroFacturaAutoSubRogacion' => NULL,
                                    'FechaAutoSubRogacion' => NULL,
                                    'FechaFacturaSoporteCISA' => NULL);

                }else if($filtro == 'NroFacturaSentenciaIrrecuperable'){
                    //Irrecuperable
                    $datos = array( 'FechaFacturaSentenciaIrrecuperable' => NULL, 
                                    'NroFacturaSentenciaIrrecuperable' => NULL, 
                                    'FechaAutoIrrecuperable' => NULL, 
                                    'FechaSentenciaIrrecuperable' => NULL, 
                                    'FechaLiquidacionCredito' => NULL,
                                    'ValorFacturadoSentenciaIrrecuperable' => NULL);

                }else if($filtro == 'NroFacturaSoporteCISA'){
                    //Soporte
                    $datos = array( 'FechaRecepcionSoporte' => NULL, 
                                    'Fecha_aprovacion_soporte' => NULL,
                                    'NroFacturaSoporteCISA' => NULL,
                                    'FechaFacturaHonorarioCISA2' => NULL,
                                    'Soporte' => NULL,
                                    'FechaFacturaHonorarioCISA1' => NULL);
                }else{
                    //VEnta CISA
                    $datos = array( 'FechaFacturaHonorarioCISA4' => NULL,
                                    'FechaFacturaHonorarioCISA3' => NULL,
                                    'FechaFacturaHonorarioCISA2' => NULL);
                }   

                $resultado = false;
                $resultado = $this->Wizard_Model->editarDatos('Factura', $datos, $query->row()->Id, 'Id');

                if($resultado){  
                    //$this->mandarCorreo($sap, $abogado); 
                    echo "1";
                }else{
                    echo "No";
                }
            }else{
                echo 'NOP';
            }

        }else{
            $this->load->view('Login/login');
        }
    }

    function EliminarFacturasMasivo(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
           
            
            $filtro = $_POST['filtro'];
            $name   = $_FILES['FilExcell']['name'];
            $tname  = $_FILES['FilExcell']['tmp_name'];
            ini_set('memory_limit','128M'); 
            $obj_excel = PHPExcel_IOFactory::load($tname);       
            $sheetData = $obj_excel->getActiveSheet()->toArray(null,true,true,true);
            $arr_datos = array();
            $acertados = 0;
            $fallos    = 0;
            $fallosExistenciales = 0;
            
            $highestRow = $obj_excel->getActiveSheet()->getHighestRow(); 
            $validador = 0;
            $k = 1;
            $frg = '';
            
            $i = 0;
            foreach ($sheetData as $index => $value) {            
                if ( $index > 0 ){
                    if($validador > 3){
                        break;
                    }    
                    if($value['A'] != ""){

                        $this->db->from('Factura');
                        $this->db->where($filtro, $value['A']);
                        $query = $this->db->get();

                        if($query->num_rows() > 0){
                            $datos = array();
                            
                            if($filtro == 'NroFacturaAutoSubRogacion'){
                                //Subrogacion
                                $datos = array( 'FechaFacturacionAutoSubRogacion' => NULL, 
                                                'NroFacturaAutoSubRogacion' => NULL,
                                                'FechaAutoSubRogacion' => NULL,
                                                'FechaFacturaSoporteCISA' => NULL);

                            }else if($filtro == 'NroFacturaSentenciaIrrecuperable'){
                                //Irrecuperable
                                $datos = array( 'FechaFacturaSentenciaIrrecuperable' => NULL, 
                                                'NroFacturaSentenciaIrrecuperable' => NULL, 
                                                'FechaAutoIrrecuperable' => NULL, 
                                                'FechaSentenciaIrrecuperable' => NULL, 
                                                'FechaLiquidacionCredito' => NULL,
                                                'ValorFacturadoSentenciaIrrecuperable' => NULL);

                            }else if($filtro == 'NroFacturaSoporteCISA'){
                                //Soporte
                                $datos = array( 'FechaRecepcionSoporte' => NULL, 
                                                'Fecha_aprovacion_soporte' => NULL,
                                                'NroFacturaSoporteCISA' => NULL,
                                                'FechaFacturaHonorarioCISA2' => NULL,
                                                'Soporte' => NULL,
                                                'FechaFacturaHonorarioCISA1' => NULL);
                            }else{
                                //VEnta CISA
                                $datos = array( 'FechaFacturaHonorarioCISA4' => NULL,
                                                'FechaFacturaHonorarioCISA3' => NULL,
                                                'FechaFacturaHonorarioCISA2' => NULL);
                            }   

                            $resultado = false;
                            $resultado = $this->Wizard_Model->editarDatos('Factura', $datos, $query->row()->Id, 'Id');

                            if($resultado){
                                $acertados += 1;
                            }else{
                                $fallos +=1;
                            }
                                                      
                        }else{
                            $fallosExistenciales +=1;
                        }
                        
                    }else{
                        $validador += 1;
                    }

                     $i++;
                }
            }

            //$this->envioCorreoMaxibo($usuarios, $abogado, $frg);

            $result['valid'] = "1";
            $result['total'] = $acertados;
            $result['fallaron'] = $fallos;
            $result['noexisten'] = $fallosExistenciales;
            $result['registros'] = $i;
            $result['message'] = 'Datos Cargados';
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($result));  

        }else{
            $this->load->view('Login/login');
        }
    }
    
}
?>