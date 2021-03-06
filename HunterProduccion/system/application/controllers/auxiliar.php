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
                $datos[$i]['frg'] = $key->Frg_ConsInte__b;
                $datos[$i]['direccion'] = utf8_encode($key->direccion);
                $datos[$i]['telefono'] = utf8_encode($key->telefono) ;
                $datos[$i]['firma'] = $key->Firma_abogados;
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
           					'G723_C17204' => $_POST['cedula'],
           					'G723_C17099' => utf8_decode($_POST['nombre']),
           					'G723_C17100' => $_POST['celular'],
           					'G723_C17101' => $_POST['correo'],
                            'Frg_ConsInte__b' => $_POST['cmbFrgs'],
                            'direccion' => $_POST['TxtDireccion'],
                            'telefono' => $_POST['txtTelefono'],
                            'Firma_abogados' => $_POST['cambFirmas']
           				);

           /*$datos = array(
                            'G723_C17204' => $_POST['cedula'],
                            'G723_C17099' => utf8_decode($_POST['nombre']),
                            'G723_C17100' => $_POST['celular'],
                            'G723_C17101' => $_POST['correo'],
                            'Frg_ConsInte__b' => $_POST['cmbFrgs']
                        );*/

            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G723', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G723', $datos, $_POST['id'], 'G723_ConsInte__b');
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
            $resultado = $this->Wizard_Model->borrarDatos('G723', $_POST['id'], 'G723_ConsInte__b');
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
                    'G718_C17015' => utf8_decode($_POST['ciudad']),
                    'G718_C17016' => $_POST['departamento']
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G718', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G718', $datos, $_POST['id'], 'G718_ConsInte__b');
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

            $datosPersonales = $this->db->get_where('G717', array('G717_C17005' => $_POST['IdentificacionUsers']));
            
            
            $ciudadDomicilio = $datosPersonales->row()->G717_C17012 ;
            $ciudadOficina = $datosPersonales->row()->G717_C17013 ;
            $tefonoOficina = $datosPersonales->row()->G717_C17008 ;
            $telefonoDomicilio = $datosPersonales->row()->G717_C17006 ;
            $celular = $datosPersonales->row()->G717_C17010 ;
            $celularAdicional = $datosPersonales->row()->G717_C17011 ;
            $mail = $datosPersonales->row()->G717_C17017 ;
            $direccionDomicilio = $datosPersonales->row()->G717_C17007 ;
            $direccionOficina = $datosPersonales->row()->G717_C17009 ;
            $iddeusuario = $datosPersonales->row()->G717_ConsInte__b;
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

            $datosNormales = array( 'G717_C17012' => $ciudadDomicilio,
                                    'G717_C17013' => $ciudadOficina,
                                    'G717_C17008' => $tefonoOficina,
                                    'G717_C17006' => $telefonoDomicilio,
                                    'G717_C17010' => $celular,
                                    'G717_C17011' => $celularAdicional,
                                    'G717_C17017' => $mail,
                                    'G717_C17007' => $direccionDomicilio,
                                    'G717_C17009' => $direccionOficina,
                                    'tele_adicional' => $tele_adicional,
                                    'dir_Adicional' => $dir_Adicional,
                                    'ciudad_adicional' => $ciudad_adicional );
            
            $resultados = $this->Wizard_Model->editarDatos('G717', $datosNormales, $iddeusuario, 'G717_ConsInte__b');

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
                          ,x.G718_C17015 as ciudadDomicilio
                          ,y.G718_C17015 as ciudadOficina
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
                          ,z.G718_C17015 as ciudad_adicional
                          ,a.LISOPC_Nombre____b As cal_ciudadDomicilio
                          ,b.LISOPC_Nombre____b As cal_ciudadOficina
                          ,c.LISOPC_Nombre____b As cal_tefonoOficina
                          ,d.LISOPC_Nombre____b As cal_telefonoDomicilio
                          ,e.LISOPC_Nombre____b As cal_celular
                          ,f.LISOPC_Nombre____b As cal_celularAdicional
                          ,g.LISOPC_Nombre____b As cal_mail
                          ,h.LISOPC_Nombre____b As cal_direccionDomicilio
                          ,i.LISOPC_Nombre____b As cal_direccionOficina
                          ,j.LISOPC_Nombre____b As cal_dir_Adicional
                          ,k.LISOPC_Nombre____b As cal_tele_adicional
                          ,l.LISOPC_Nombre____b As cal_ciudad_adicional
                          ,fecha_modificacion");
            $this->db->from("Log_datos_iniciales");

            $this->db->join('G718 x', 'x.G718_ConsInte__b = ciudadDomicilio', 'LEFT');
            $this->db->join('G718 y', 'y.G718_ConsInte__b = ciudadOficina', 'LEFT');
            $this->db->join('G718 z', 'z.G718_ConsInte__b = ciudad_adicional', 'LEFT');

            $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = cal_ciudadDomicilio ', 'LEFT');
            $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = cal_ciudadOficina ', 'LEFT');
            $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = cal_tefonoOficina ', 'LEFT');
            $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = cal_telefonoDomicilio ', 'LEFT');
            $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = cal_celular ', 'LEFT');
            $this->db->join('LISOPC f', 'f.LISOPC_ConsInte__b = cal_celularAdicional ', 'LEFT');
            $this->db->join('LISOPC g', 'g.LISOPC_ConsInte__b = cal_mail ', 'LEFT');
            $this->db->join('LISOPC h', 'h.LISOPC_ConsInte__b = cal_direccionDomicilio ', 'LEFT');
            $this->db->join('LISOPC i', 'i.LISOPC_ConsInte__b = cal_direccionOficina ', 'LEFT');
            $this->db->join('LISOPC j', 'j.LISOPC_ConsInte__b = cal_dir_Adicional ', 'LEFT');
            $this->db->join('LISOPC k', 'k.LISOPC_ConsInte__b = cal_tele_adicional ', 'LEFT');
            $this->db->join('LISOPC l', 'l.LISOPC_ConsInte__b = cal_ciudad_adicional ', 'LEFT');
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
            $resultado = $this->Wizard_Model->borrarDatos('G726', $_POST['id'], 'G726_ConsInte__b');
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
                    'G726_C17237' => $_POST['const_contrato_'],
                    'G726_C17109' => $_POST['FechaLiquidacion'],
                    'G726_C17110' => $_POST['FechaAnticipo'],
                    'G726_C17111' => $legalizacion,
					'G726_C17112' => $ValorAcuerdo,
                    'G726_C17113' => $_POST['AcuerdoPlazo'],
                    'G726_C17223' => $Cuota,
					'G726_C17224' => $_POST['FechaPrimeraCuoota'],
					'G726_C17225' => $_POST['FechaPagoUltimaCuota'],
					'G726_c17419' => $tazadeinterez
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G726', $datos);
            }else{
                $datos = array(
                    'G726_C17237' => $_POST['const_contrato_'],
                    'G726_C17109' => $_POST['FechaLiquidacion'],
                    'G726_C17110' => $_POST['FechaAnticipo'],
                    'G726_C17113' => $_POST['AcuerdoPlazo'],
                    'G726_C17224' => $_POST['FechaPrimeraCuoota'],
                    'G726_C17225' => $_POST['FechaPagoUltimaCuota']
                  );


                $resultado = $this->Wizard_Model->editarDatos('G726', $datos, $_POST['id'], 'G726_ConsInte__b');
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
                    'G733_C17132' => utf8_decode($_POST['despacho']),
                    'G733_C17133' => $_POST['selpaises']
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G733', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G733', $datos, $_POST['id'], 'G733_ConsInte__b');
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
            $resultado = $this->Wizard_Model->borrarDatos('G733', $_POST['id'], 'G733_ConsInte__b');
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


                $serv = $_SERVER['DOCUMENT_ROOT'].$Laverdadera."/assets/";

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
                        $datos[$i]['G719_ConsInte__b'] = $key->G719_ConsInte__b;
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
                if(!is_null($key->Fecha_recepcion_soporte)){
                    $recepion = explode(" ", $key->Fecha_recepcion_soporte)[0];
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
                $datos[$i]['id'] = $key->G744_ConsInte__b;
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

            $G744_C17262 = NULL;
            $G744_C17263 = NULL; 
            $G744_C17264 = NULL;
            $G744_C17265 = NULL;
            $G744_C17266 = NULL;
            $G744_C17267 = NULL;
            $G744_C17270 = NULL;
            $G744_C17285 = NULL;
            $G744_C17286 = NULL;
            $G744_C17275 = NULL;
            $G744_C17276 = NULL;
            $G744_C17268 = NULL;
            $G744_C17277 = NULL;
            $G744_C17278 = NULL;
            $G744_C17279 = NULL;
            $G744_C17280 = NULL;
            $G744_C17269 = NULL;
            $G744_C17423 = NULL;
            $G744_C17424 = NULL;
            $txtFechaRecepcion = NULL;
            $txtFechaAprobacion = NULL;

            if($_POST['txtFechaFacuraSub'] != '' && $_POST['txtFechaFacuraSub'] != NULL){
                $G744_C17262 = $_POST['txtFechaFacuraSub'];
            }

            if($_POST['txtFacturaAutoSub'] != '' && $_POST['txtFacturaAutoSub'] != NULL){
                $G744_C17263 = $_POST['txtFacturaAutoSub'];
            }

            if($_POST['txtFechaAutoSub'] != '' && $_POST['txtFechaAutoSub'] != NULL){
                $G744_C17264 = $_POST['txtFechaAutoSub'];
            }

            if($_POST['txtFacturaSentenciaIrr'] != '' && $_POST['txtFacturaSentenciaIrr'] != NULL){
                $G744_C17265 = $_POST['txtFacturaSentenciaIrr'];
            }

            if($_POST['txtFechaSentenciaIrr'] != '' && $_POST['txtFechaSentenciaIrr'] != NULL){
                $G744_C17266 = $_POST['txtFechaSentenciaIrr'];
            }

            if($_POST['txtFechaFacturaIrr'] != '' && $_POST['txtFechaFacturaIrr'] != NULL){
                $G744_C17267 = $_POST['txtFechaFacturaIrr'];
            }

            if($_POST['txtFechaLiquidacionIrr'] != '' && $_POST['txtFechaLiquidacionIrr'] != NULL){
                $G744_C17285 = $_POST['txtFechaLiquidacionIrr'];
            }

            if($_POST['txtFechaAutoSubrogacionIrr'] != '' && $_POST['txtFechaAutoSubrogacionIrr'] != NULL){
                $G744_C17286 = $_POST['txtFechaAutoSubrogacionIrr'];
            }

            if($_POST['txtValorFacturadoAutoSub'] != '' && $_POST['txtValorFacturadoAutoSub'] != NULL){
               $G744_C17276 = $_POST['txtValorFacturadoAutoSub'];
            }

            if($_POST['txtFechaFacturaCISA'] != '' && $_POST['txtFechaFacturaCISA'] != NULL){
                $G744_C17268 = $_POST['txtFechaFacturaCISA'];
            }

            if(isset($_POST['txtValorFActuradoIrr'])){
                if($_POST['txtValorFActuradoIrr'] != '' && $_POST['txtValorFActuradoIrr'] != NULL){
                    $G744_C17277 = $_POST['txtValorFActuradoIrr'];
                }
            }
            

            if($_POST['txtValoFacturadoCISA'] != '' && $_POST['txtValoFacturadoCISA'] != NULL){
                $G744_C17278 = $_POST['txtValoFacturadoCISA'];

            }
            
            if($_POST['txtRenunciaCISA'] != '' && $_POST['txtRenunciaCISA'] != NULL){
                $G744_C17279 = $_POST['txtRenunciaCISA'];
            }

            if($_POST['NumeroContrato'] != '' && $_POST['NumeroContrato'] != NULL){
                $G744_C17280 = $_POST['NumeroContrato'];
            }

            if($_POST['txtHonorariosVentaCISA'] != '' && $_POST['txtHonorariosVentaCISA'] != NULL){
                $G744_C17269 = $_POST['txtHonorariosVentaCISA'];
            }

            if($_POST['txtFacturaHonorariosCISA'] != '' && $_POST['txtFacturaHonorariosCISA'] != NULL){
                $G744_C17423 = $_POST['txtFacturaHonorariosCISA'];
            }

            if($_POST['txtFechaFacturaHonorariosCISA'] != '' && $_POST['txtFechaFacturaHonorariosCISA'] != NULL){
                $G744_C17424 = $_POST['txtFechaFacturaHonorariosCISA'];
            }

            if($_POST['txtSoporteCISA'] != '' && $_POST['txtSoporteCISA'] != NULL){
                $G744_C17275 = $_POST['txtSoporteCISA'];
            }

            if($_POST['txtFacturaCISA'] != '' && $_POST['txtFacturaCISA'] != NULL){
                $G744_C17270 = $_POST['txtFacturaCISA'];
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
                    'G744_C17262' => $G744_C17262,
                    'G744_C17263' => $G744_C17263, 
                    'G744_C17264' => $G744_C17264,
                    'G744_C17265' => $G744_C17265,
                    'G744_C17266' => $G744_C17266,
                    'G744_C17267' => $G744_C17267,
                    'G744_C17270' => $G744_C17270,
                    'G744_C17285' => $G744_C17285,
                    'G744_C17286' => $G744_C17286,
                    'G744_C17275' => $G744_C17275,
                    'G744_C17276' => $G744_C17276,
                    'G744_C17268' => $G744_C17268,
                    'G744_C17277' => $G744_C17277,
                    'G744_C17278' => $G744_C17278,
                    'G744_C17279' => $G744_C17279,
                    'G744_C17280' => $G744_C17280,
                    'G744_C17269' => $G744_C17269,
                    'G744_C17423' => $G744_C17423,
                    'G744_C17424' => $G744_C17424,
                    'Fecha_recepcion_soporte' => $txtFechaRecepcion, 
                    'Fecha_aprovacion_soporte' => $txtFechaAprobacion,
                    'G744_FechaInsercion' => $fechaIngreso,

                    'G744_Usuario' => $this->session->userdata('identificacion')
                  );

            $this->db->select('G719_C17423');
            $this->db->from('G719');
            $this->db->where('G719_ConsInte__b', $G744_C17280);
            $query = $this->db->get();
            $liquidacion = 0;
            if( $query->num_rows() >  0){
                if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                    $liquidacion = $query->row()->G719_C17423;
                }
            }else{
                $this->db->select('G719_C17423');
                $this->db->from('G719');
                $this->db->where('G719_C17423', $G744_C17280);
                $query = $this->db->get();
                if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                    $liquidacion = $query->row()->G719_C17423;
                }
            }

            $resultado = false;
            if($_POST['id'] == '0'){
                if($liquidacion == 0){
                    $resultado = $this->Wizard_Model->guardardatos('G744', $datos);
                }else{
                    $this->db->select('G719_ConsInte__b');
                    $this->db->from('G719');
                    $this->db->where('G719_C17423', $liquidacion);
                    $query = $this->db->get();
                    $variable = $query->result();
                    $resultado = false;
                    foreach ($variable as $key) {
                         $datos = array(
                                'G744_C17262' => $G744_C17262,
                                'G744_C17263' => $G744_C17263, 
                                'G744_C17264' => $G744_C17264,
                                'G744_C17265' => $G744_C17265,
                                'G744_C17266' => $G744_C17266,
                                'G744_C17267' => $G744_C17267,
                                'G744_C17270' => $G744_C17270,
                                'G744_C17285' => $G744_C17285,
                                'G744_C17286' => $G744_C17286,
                                'G744_C17275' => $G744_C17275,
                                'G744_C17276' => $G744_C17276,
                                'G744_C17268' => $G744_C17268,
                                'G744_C17277' => $G744_C17277,
                                'G744_C17278' => $G744_C17278,
                                'G744_C17279' => $G744_C17279,
                                'G744_C17280' => $key->G719_ConsInte__b,
                                'G744_C17269' => $G744_C17269,
                                'G744_C17423' => $G744_C17423,
                                'G744_C17424' => $G744_C17424,
                                'Fecha_recepcion_soporte' => $txtFechaRecepcion, 
                                'Fecha_aprovacion_soporte' => $txtFechaAprobacion,
                                'G744_FechaInsercion' => $fechaIngreso,
                                'G744_Usuario' => $this->session->userdata('identificacion')
                            );
                        $resultado = $this->Wizard_Model->guardardatos('G744', $datos);
                    }
                }
                
            }else{
                    //2016-02-16

                $G744_C17262 = NULL;
                $G744_C17263 = NULL; 
                $G744_C17264 = NULL;
                $G744_C17265 = NULL;
                $G744_C17266 = NULL;
                $G744_C17267 = NULL;
                $G744_C17270 = NULL;
                $G744_C17285 = NULL;
                $G744_C17286 = NULL;
                $G744_C17275 = NULL;
                $G744_C17276 = NULL;
                $G744_C17268 = NULL;
                $G744_C17277 = NULL;
                $G744_C17278 = NULL;
                $G744_C17279 = NULL;
                $G744_C17280 = NULL;
                $G744_C17269 = NULL;
                $G744_C17423 = NULL;
                $G744_C17424 = NULL;
                $txtFechaRecepcion = NULL;
                $txtFechaAprobacion = NULL;


                if($_POST['txtFechaFacuraSub'] != '' && $_POST['txtFechaFacuraSub'] != NULL){
                    $pos = strpos($_POST['txtFechaFacuraSub'], '/');
                    if($pos === false){
                        $G744_C17262 = $_POST['txtFechaFacuraSub'];
                    }else{
                        $fecha1 = explode("/", $_POST['txtFechaFacuraSub']);
                        $G744_C17262 = $fecha1[2]."-".$fecha1[1]."-".$fecha1[0];
                    }
                    
                }

                if($_POST['txtFacturaAutoSub'] != '' && $_POST['txtFacturaAutoSub'] != NULL){
                    $G744_C17263 = $_POST['txtFacturaAutoSub'];
                }

                if($_POST['txtFechaAutoSub'] != '' && $_POST['txtFechaAutoSub'] != NULL){
                    $pos = strpos($_POST['txtFechaAutoSub'], '/');
                    if($pos === false){
                        $G744_C17264 = $_POST['txtFechaAutoSub'];
                    }else{
                        $fecha2 = explode("/", $_POST['txtFechaAutoSub']);
                        $G744_C17264 = $fecha2[2]."-".$fecha2[1]."-".$fecha2[0];
                    }
                    
                }

                if($_POST['txtFacturaSentenciaIrr'] != '' && $_POST['txtFacturaSentenciaIrr'] != NULL){
                    $G744_C17265 = $_POST['txtFacturaSentenciaIrr'];
                }

                if($_POST['txtFechaSentenciaIrr'] != '' && $_POST['txtFechaSentenciaIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaSentenciaIrr'], '/');
                    if($pos === false){
                        $G744_C17266 = $_POST['txtFechaSentenciaIrr'];
                    }else{
                        $fecha3 = explode("/", $_POST['txtFechaSentenciaIrr']);
                        $G744_C17266 = $fecha3[2]."-".$fecha3[1]."-".$fecha3[0];
                    }
                    
                }

                if($_POST['txtFechaFacturaIrr'] != '' && $_POST['txtFechaFacturaIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaFacturaIrr'], '/');
                    if($pos === false){
                        $G744_C17267 = $_POST['txtFechaFacturaIrr'];
                    }else{
                        $fecha4 = explode("/", $_POST['txtFechaFacturaIrr']);
                        $G744_C17267 = $fecha4[2]."-".$fecha4[1]."-".$fecha4[0];
                    }
                    
                }

                if($_POST['txtFechaLiquidacionIrr'] != '' && $_POST['txtFechaLiquidacionIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaLiquidacionIrr'], '/');
                    if($pos === false){
                        $G744_C17285 = $_POST['txtFechaLiquidacionIrr'];
                    }else{
                        $fecha5 = explode("/", $_POST['txtFechaLiquidacionIrr']);
                        $G744_C17285 = $fecha5[2]."-".$fecha5[1]."-".$fecha5[0];
                    }
                    
                }

                if($_POST['txtFechaAutoSubrogacionIrr'] != '' && $_POST['txtFechaAutoSubrogacionIrr'] != NULL){
                    $pos = strpos($_POST['txtFechaAutoSubrogacionIrr'], '/');
                    if($pos === false){
                        $G744_C17286 = $_POST['txtFechaAutoSubrogacionIrr'];
                    }else{
                        $fecha6 = explode("/", $_POST['txtFechaAutoSubrogacionIrr']);
                        $G744_C17286 = $fecha6[2]."-".$fecha6[1]."-".$fecha6[0];
                    }

                }

                if($_POST['txtValorFacturadoAutoSub'] != '' && $_POST['txtValorFacturadoAutoSub'] != NULL){
                   $G744_C17276 = $_POST['txtValorFacturadoAutoSub'];
                }

                if($_POST['txtFechaFacturaCISA'] != '' && $_POST['txtFechaFacturaCISA'] != NULL){
                    $pos = strpos($_POST['txtFechaFacturaCISA'], '/');
                    if($pos === false){
                        $G744_C17268 = $_POST['txtFechaFacturaCISA'];
                    }else{
                        $fecha7 = explode("/", $_POST['txtFechaFacturaCISA']);
                        $G744_C17268 =  $fecha7[2]."-".$fecha7[1]."-".$fecha7[0];
                    }

                }

                if($_POST['txtValorFActuradoIrr'] != '' && $_POST['txtValorFActuradoIrr'] != NULL){
                    $G744_C17277 = $_POST['txtValorFActuradoIrr'];
                }

                if($_POST['txtValoFacturadoCISA'] != '' && $_POST['txtValoFacturadoCISA'] != NULL){
                    $G744_C17278 = $_POST['txtValoFacturadoCISA'];

                }
                
                if($_POST['txtRenunciaCISA'] != '' && $_POST['txtRenunciaCISA'] != NULL){
                    $G744_C17279 = $_POST['txtRenunciaCISA'];
                }

                if($_POST['NumeroContrato'] != '' && $_POST['NumeroContrato'] != NULL){
                    $G744_C17280 = $_POST['NumeroContrato'];
                }

                if($_POST['txtHonorariosVentaCISA'] != '' && $_POST['txtHonorariosVentaCISA'] != NULL){
                    $G744_C17269 = $_POST['txtHonorariosVentaCISA'];
                }

                if($_POST['txtFacturaHonorariosCISA'] != '' && $_POST['txtFacturaHonorariosCISA'] != NULL){
                    $G744_C17423 = $_POST['txtFacturaHonorariosCISA'];
                }

                if($_POST['txtFechaFacturaHonorariosCISA'] != '' && $_POST['txtFechaFacturaHonorariosCISA'] != NULL){
                    $pos = strpos($_POST['txtFechaFacturaHonorariosCISA'], '/');
                    if($pos === false){
                        $G744_C17424 = $_POST['txtFechaFacturaHonorariosCISA'];
                    }else{
                        $fecha8 = explode("/", $_POST['txtFechaFacturaHonorariosCISA']);
                        $G744_C17424 = $fecha8[2]."-".$fecha8[1]."-".$fecha8[0];
                    }
                    
                }


                if($_POST['txtSoporteCISA'] != '' && $_POST['txtSoporteCISA'] != NULL){
                    $G744_C17275 = $_POST['txtSoporteCISA'];
                }

                if($_POST['txtFacturaCISA'] != '' && $_POST['txtFacturaCISA'] != NULL){
                    $G744_C17270 = $_POST['txtFacturaCISA'];
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
                $this->db->from('G719');
                $this->db->where('G719_ConsInte__b', $G744_C17280);
                $query = $this->db->get();
                $liquidacion = 0;
                if( $query->num_rows() >  0){
                    if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                        $liquidacion = $query->row()->G719_C17423;
                    }
                }else{
                    $this->db->select('G719_C17423');
                    $this->db->from('G719');
                    $this->db->where('G719_C17423', $G744_C17280);
                    $query = $this->db->get();
                    if($query->row()->G719_C17423 != NULL && $query->row()->G719_C17423 != '' ){
                        $liquidacion = $query->row()->G719_C17423;
                    }
                }

                

                

                $datos = array(
                    'G744_C17262' => $G744_C17262,
                    'G744_C17263' => $G744_C17263, 
                    'G744_C17264' => $G744_C17264,
                    'G744_C17265' => $G744_C17265,
                    'G744_C17266' => $G744_C17266,
                    'G744_C17267' => $G744_C17267,
                    'G744_C17270' => $G744_C17270,
                    'G744_C17285' => $G744_C17285,
                    'G744_C17286' => $G744_C17286,
                    'G744_C17275' => $G744_C17275,
                    'G744_C17276' => $G744_C17276,
                    'G744_C17268' => $G744_C17268,
                    'G744_C17277' => $G744_C17277,
                    'G744_C17278' => $G744_C17278,
                    'G744_C17279' => $G744_C17279,
                    'G744_C17280' => $G744_C17280,
                    'G744_C17269' => $G744_C17269,
                    'G744_C17423' => $G744_C17423,
                    'G744_C17424' => $G744_C17424,
                    'G744_FechaInsercion' => $fechaIngreso,
                    'Fecha_recepcion_soporte' => $txtFechaRecepcion, 
                    'Fecha_aprovacion_soporte' => $txtFechaAprobacion,
                    'G744_Usuario' => $this->session->userdata('identificacion')
                );

                $resultado = $this->Wizard_Model->editarDatos('G744', $datos, $_POST['id'], 'G744_ConsInte__b');
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
            $resultado = $this->Wizard_Model->borrarDatos('G744', $_POST['id'], 'G744_ConsInte__b');
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
            $nuevo = 0;
            $viejo = 0;
            foreach ($obliogaciones as $key) {
                if($key->liquidacion != '' && !is_null($key->liquidacion)){
                    $nuevo = $key->liquidacion;
                    if($nuevo != $viejo){
                        $dataset[$i][0] = $key->liquidacion;
                        $i++;
                    }
                    $viejo = $nuevo;
                }
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
                              ,G718_C17015 as ciudad
                              ,[G728_C17120] as correo,
                              G728_ConsInte__b');
            $this->db->from('G728');
            $this->db->join('G718','G718_ConsInte__b = G728_C17119');
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
        $this->db->select('G723_ConsInte__b as id, Frg_ConsInte__b,  G723_C17204 as cedula, G723_C17099 as Nombre, G723_C17100 as celular, G723_C17101 as correo, direccion, telefono');   
        $this->db->where('Firma_abogados', $id);  
        $query = $this->db->get('G723');
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
                $datos[$i]['id'] = $key->G729_ConsInte__b;
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
                    'G729_C17121' => utf8_decode($_POST['frg']),
                    'G729_C17122' => $_POST['direccion'],
                    'G729_C17123' => $_POST['selCiudades'],
                    'G729_C17124' => $_POST['telefono'],
                    'G729_C17125' => $_POST['contacto']
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G729', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G729', $datos, $_POST['id'], 'G729_ConsInte__b');
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
            $resultado = $this->Wizard_Model->borrarDatos('G729', $_POST['id'], 'G729_ConsInte__b');
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
                $datos[$i]['idCn'] = $key->G719_ConsInte__b;
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
                $datos[$i]['id'] = $key->G730_ConsInte__b;
                $datos[$i]['Ifs'] = $key->G730_C17126;

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
                    'G730_C17126' => utf8_decode($_POST['Ifses'])
    
                   
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G730', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G730', $datos, $_POST['id'], 'G730_ConsInte__b');
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
            $resultado = $this->Wizard_Model->borrarDatos('G730', $_POST['id'], 'G730_ConsInte__b');
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
                $data[$i]['id'] = $key->G737_ConsInte__b;
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
                $datos[$i]['id'] = $key->G737_ConsInte__b;
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
                    'G737_C17181' => $_POST['usuario'],
                    'G737_C17182' => $_POST['contrato'],
                    'G737_C17183' => $_POST['selRoles']
                   
                  );
            $resultado = false;
            if($_POST['id'] == '0'){
                $resultado = $this->Wizard_Model->guardardatos('G737', $datos);
            }else{
                $resultado = $this->Wizard_Model->editarDatos('G737', $datos, $_POST['id'], 'G737_ConsInte__b');
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
            $resultado = $this->Wizard_Model->borrarDatos('G737', $_POST['id'], 'G737_ConsInte__b');
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
                            $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $value['A'], $filtro);

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
                $resultado = $this->Wizard_Model->editarDatos('G719', $datos, $sap, $filtro);

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
            $selPor = $_POST['selPor'];
            $liquiacion = $_POST['liquidacion'];
            if($selPor == 'G719_C17026'){

                $this->db->select('G719_ConsInte__b');
                $this->db->from('G719');
                $this->db->where('G719_C17026', $liquiacion);
                $query2 = $this->db->get();  

                $this->db->select('G744_ConsInte__b');
                $this->db->from('G744');
                $this->db->where($filtro, $factura);
                $this->db->where('G744_C17280', $query2->row()->G719_ConsInte__b);
                $query = $this->db->get();

                if($query->num_rows() > 0){
                    $datos = array();
                    
                    if($filtro == 'G744_C17263'){
                        //Subrogacion
                        $datos = array( 'G744_C17262' => NULL, 
                                        'G744_C17263' => NULL,
                                        'G744_C17264' => NULL,
                                        'G744_C17276' => NULL);

                    }else if($filtro == 'G744_C17265'){
                        //Irrecuperable
                        $datos = array( 'G744_C17267' => NULL, 
                                        'G744_C17265' => NULL, 
                                        'G744_C17286' => NULL, 
                                        'G744_C17266' => NULL, 
                                        'G744_C17285' => NULL,
                                        'G744_C17277' => NULL);

                    }else if($filtro == 'G744_C17270'){
                        //Soporte
                        $datos = array( 'Fecha_recepcion_soporte' => NULL, 
                                        'Fecha_aprovacion_soporte' => NULL,
                                        'G744_C17270' => NULL,
                                        'G744_C17278' => NULL,
                                        'G744_C17275' => NULL,
                                        'G744_C17279' => NULL,
                                        'G744_C17268' => NULL);
                    }else{
                        //VEnta CISA
                        $datos = array( 'G744_C17424' => NULL,
                                        'G744_C17423' => NULL,
                                        'G744_C17269' => NULL);
                    }   

                    $resultado = false;
                    $resultado = $this->Wizard_Model->editarDatos('G744', $datos, $query->row()->G744_ConsInte__b, 'G744_ConsInte__b');

                    if($resultado){  
                        //$this->mandarCorreo($sap, $abogado); 
                        echo "1";
                    }else{
                        echo "No";
                    }
                }
    
            }else{
                $resultado = false;
                $numero = 0;
                $this->db->select('G719_ConsInte__b');
                $this->db->from('G719');
                $this->db->where("G719_C17423 LIKE '%".$liquiacion."%' ");
                $query2 = $this->db->get(); 
                $result = $query2->result();
                foreach ($result as $key) {
                    //echo $key->G719_ConsInte__b;
                    $this->db->select('G744_ConsInte__b');
                    $this->db->from('G744');
                    $this->db->where($filtro, $factura);
                    $this->db->where('G744_C17280', $key->G719_ConsInte__b);
                    $query = $this->db->get();

                    if($query->num_rows() > 0){
                        $datos = array();
                        
                        if($filtro == 'G744_C17263'){
                            //Subrogacion
                            $datos = array( 'G744_C17262' => NULL, 
                                            'G744_C17263' => NULL,
                                            'G744_C17264' => NULL,
                                            'G744_C17276' => NULL);

                        }else if($filtro == 'G744_C17265'){
                            //Irrecuperable
                            $datos = array( 'G744_C17267' => NULL, 
                                            'G744_C17265' => NULL, 
                                            'G744_C17286' => NULL, 
                                            'G744_C17266' => NULL, 
                                            'G744_C17285' => NULL,
                                            'G744_C17277' => NULL);

                        }else if($filtro == 'G744_C17270'){
                            //Soporte
                            $datos = array( 'Fecha_recepcion_soporte' => NULL, 
                                            'Fecha_aprovacion_soporte' => NULL,
                                            'G744_C17270' => NULL,
                                            'G744_C17278' => NULL,
                                            'G744_C17275' => NULL,
                                            'G744_C17279' => NULL,
                                            'G744_C17268' => NULL);
                        }else{
                            //VEnta CISA
                            $datos = array( 'G744_C17424' => NULL,
                                            'G744_C17423' => NULL,
                                            'G744_C17269' => NULL);
                        }   
                        
                        $resultado = $this->Wizard_Model->editarDatos('G744', $datos, $query->row()->G744_ConsInte__b, 'G744_ConsInte__b');
                        if($resultado){  
                            $numero += 1;
                        }
                    }
                }
                if($numero > 0){  
                    //$this->mandarCorreo($sap, $abogado); 
                    echo "1";
                }else{
                    echo "Nojoda";
                }
            }

        }else{
            $this->load->view('Login/login');
        }
    }

    function EliminarFacturasMasivo(){
        if($this->session->userdata('login_ok')){
            $this->load->library('excel');
           
            
            $filtro = $_POST['filtro'];
            $comboFiltros = $_POST['cmbFiltrosLiquid'];

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

                        if($comboFiltros == 'G719_C17026'){

                            $this->db->select('G719_ConsInte__b');
                            $this->db->from('G719');
                            $this->db->where('G719_C17026', $value['A']);
                            $query2 = $this->db->get();  

                            $this->db->select('G744_ConsInte__b');
                            $this->db->from('G744');
                            $this->db->where($filtro, $value['B']);
                            $this->db->where('G744_C17280', $query2->row()->G719_ConsInte__b);
                            $query = $this->db->get();

                            if($query->num_rows() > 0){
                                $datos = array();
                                
                                if($filtro == 'G744_C17263'){
                                    //Subrogacion
                                    $datos = array( 'G744_C17262' => NULL, 
                                                    'G744_C17263' => NULL,
                                                    'G744_C17264' => NULL,
                                                    'G744_C17276' => NULL);

                                }else if($filtro == 'G744_C17265'){
                                    //Irrecuperable
                                    $datos = array( 'G744_C17267' => NULL, 
                                                    'G744_C17265' => NULL, 
                                                    'G744_C17286' => NULL, 
                                                    'G744_C17266' => NULL, 
                                                    'G744_C17285' => NULL,
                                                    'G744_C17277' => NULL);

                                }else if($filtro == 'G744_C17270'){
                                    //Soporte
                                    $datos = array( 'Fecha_recepcion_soporte' => NULL, 
                                                    'Fecha_aprovacion_soporte' => NULL,
                                                    'G744_C17270' => NULL,
                                                    'G744_C17278' => NULL,
                                                    'G744_C17275' => NULL,
                                                    'G744_C17279' => NULL,
                                                    'G744_C17268' => NULL);
                                }else{
                                    //VEnta CISA
                                    $datos = array( 'G744_C17424' => NULL,
                                                    'G744_C17423' => NULL,
                                                    'G744_C17269' => NULL);
                                }    

                                $resultado = false;
                                $resultado = $this->Wizard_Model->editarDatos('G744', $datos, $query->row()->G744_ConsInte__b, 'G744_ConsInte__b');

                                if($resultado){
                                    $acertados += 1;
                                }else{
                                    $fallos +=1;
                                }
                                                          
                            }else{
                                $fallosExistenciales +=1;
                            }
                        }else{
                            $this->db->select('G719_ConsInte__b');
                            $this->db->from('G719');
                            $this->db->where("G719_C17423 LIKE '%".$value['A']."%' ");
                            $query2 = $this->db->get(); 
                            $result = $query2->result();
                            if($query2->num_rows() > 0){
                                foreach ($result as $key) {
                                    $this->db->select('G744_ConsInte__b');
                                    $this->db->from('G744');
                                    $this->db->where($filtro, $value['B']);
                                    $this->db->where('G744_C17280', $key->G719_ConsInte__b);
                                    $query = $this->db->get();

                                    if($query->num_rows() > 0){
                                        $datos = array();
                                        
                                        if($filtro == 'G744_C17263'){
                                            //Subrogacion
                                            $datos = array( 'G744_C17262' => NULL, 
                                                            'G744_C17263' => NULL,
                                                            'G744_C17264' => NULL,
                                                            'G744_C17276' => NULL);

                                        }else if($filtro == 'G744_C17265'){
                                            //Irrecuperable
                                            $datos = array( 'G744_C17267' => NULL, 
                                                            'G744_C17265' => NULL, 
                                                            'G744_C17286' => NULL, 
                                                            'G744_C17266' => NULL, 
                                                            'G744_C17285' => NULL,
                                                            'G744_C17277' => NULL);

                                        }else if($filtro == 'G744_C17270'){
                                            //Soporte
                                            $datos = array( 'Fecha_recepcion_soporte' => NULL, 
                                                            'Fecha_aprovacion_soporte' => NULL,
                                                            'G744_C17270' => NULL,
                                                            'G744_C17278' => NULL,
                                                            'G744_C17275' => NULL,
                                                            'G744_C17279' => NULL,
                                                            'G744_C17268' => NULL);
                                        }else{
                                            //VEnta CISA
                                            $datos = array( 'G744_C17424' => NULL,
                                                            'G744_C17423' => NULL,
                                                            'G744_C17269' => NULL);
                                        }     

                                        $resultado = false;
                                        $resultado = $this->Wizard_Model->editarDatos('G744', $datos, $query->row()->G744_ConsInte__b, 'G744_ConsInte__b');

                                        if($resultado){
                                            $acertados += 1;
                                        }else{
                                            $fallos +=1;
                                        }
                                                                  
                                    }
                                }
                            }else{
                                $fallosExistenciales +=1;
                            }
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


    //esta funcion es para ver los datos adicionales y exportarlos
    function exportarDatosAdicionales(){
        if($this->session->userdata('login_ok')){
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIExpo_datos_ad');
            
            $this->db->select('G743_C17363 as correeo, G743_C17256 as telefono, G743_C17257 as direccion, G718_C17015 as ciudad, G743_C17260 as observacion, G743_C17361 as fecha_ingreso, G743_C17269 as rol, G717_C17240 as deudor, G717_C17005 as identificacion , G719_C17423 as liquidacion, a.LISOPC_Nombre____b As Calificacion_correo, b.LISOPC_Nombre____b As Calificacion_telefono,                           c.LISOPC_Nombre____b As Calificacion_direccion, d.LISOPC_Nombre____b As Calificacion_ciudad,        e.LISOPC_Nombre____b As Calificacion_descripcion');
            $this->db->from('G743');
            $this->db->join('G718', 'G718_ConsInte__b = G743_C17258', 'LEFT');
            $this->db->join('G717', 'G717_ConsInte__b = G743_C17268', 'LEFT');
            $this->db->join('G719', 'G719_ConsInte__b = G743_C17267', 'LEFT');
            $this->db->join('LISOPC a', 'a.LISOPC_ConsInte__b = G743_C17262 ', 'LEFT');
            $this->db->join('LISOPC b', 'b.LISOPC_ConsInte__b = G743_C17263 ', 'LEFT');
            $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = G743_C17264 ', 'LEFT');
            $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = G743_C17265 ', 'LEFT');
            $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = G743_C17266 ', 'LEFT');


            $query = $this->db->get();
            $result = $query->result();

            $this->db->select('id_log_datos, a.G718_C17015 as ciudadDomicilio , b.G718_C17015 as ciudadOficina ,tefonoOficina ,telefonoDomicilio ,celular, celularAdicional ,mail  as correo ,direccionDomicilio ,direccionOficina ,iddeusuario , G717_C17240 as deudor, G717_C17005 as identificacion , fecha_modificacion ,c.LISOPC_Nombre____b As cal_ciudadDomicilio                          ,d.LISOPC_Nombre____b As cal_ciudadOficina, e.LISOPC_Nombre____b As cal_tefonoOficina
                ,f.LISOPC_Nombre____b As cal_telefonoDomicilio ,g.LISOPC_Nombre____b As cal_celular
                ,h.LISOPC_Nombre____b As cal_celularAdicional ,i.LISOPC_Nombre____b As cal_mail
                ,j.LISOPC_Nombre____b As cal_direccionDomicilio ,k.LISOPC_Nombre____b As cal_direccionOficina ,l.LISOPC_Nombre____b As cal_dir_Adicional ,m.LISOPC_Nombre____b As cal_tele_adicional       ,n.LISOPC_Nombre____b As cal_ciudad_adicional');

            $this->db->from('Log_datos_iniciales');
            $this->db->join('G718 a', 'a.G718_ConsInte__b = ciudadDomicilio', 'LEFT');
            $this->db->join('G718 b', 'b.G718_ConsInte__b = ciudadOficina', 'LEFT');
            $this->db->join('G717', 'G717.G717_ConsInte__b = iddeusuario');

            $this->db->join('LISOPC c', 'c.LISOPC_ConsInte__b = cal_ciudadDomicilio ', 'LEFT');
            $this->db->join('LISOPC d', 'd.LISOPC_ConsInte__b = cal_ciudadOficina ', 'LEFT');
            $this->db->join('LISOPC e', 'e.LISOPC_ConsInte__b = cal_tefonoOficina ', 'LEFT');
            $this->db->join('LISOPC f', 'f.LISOPC_ConsInte__b = cal_telefonoDomicilio ', 'LEFT');
            $this->db->join('LISOPC g', 'g.LISOPC_ConsInte__b = cal_celular ', 'LEFT');
            $this->db->join('LISOPC h', 'h.LISOPC_ConsInte__b = cal_celularAdicional ', 'LEFT');
            $this->db->join('LISOPC i', 'i.LISOPC_ConsInte__b = cal_mail ', 'LEFT');
            $this->db->join('LISOPC j', 'j.LISOPC_ConsInte__b = cal_direccionDomicilio ', 'LEFT');
            $this->db->join('LISOPC k', 'k.LISOPC_ConsInte__b = cal_direccionOficina ', 'LEFT');
            $this->db->join('LISOPC l', 'l.LISOPC_ConsInte__b = cal_dir_Adicional ', 'LEFT');
            $this->db->join('LISOPC m', 'm.LISOPC_ConsInte__b = cal_tele_adicional ', 'LEFT');
            $this->db->join('LISOPC n', 'n.LISOPC_ConsInte__b = cal_ciudad_adicional ', 'LEFT');

            $query2 = $this->db->get();
            $result2 = $query2->result();


            $datosAdcicionales = array();
            $i = 0;
            $idViejo = 0;
            $idNuevo = 0;
            foreach ($result2 as $key2) {
                $idNuevo = $key2->id_log_datos;
                if($idNuevo != $idViejo){
                    $datosAdcicionales[$i]['correeo'] = utf8_encode($key2->correo) ;
                    $datosAdcicionales[$i]['telefono'] = utf8_encode($key2->telefonoDomicilio) ;
                    $datosAdcicionales[$i]['direccion'] = utf8_encode($key2->direccionDomicilio) ;
                    $datosAdcicionales[$i]['ciudad'] = utf8_encode($key2->ciudadDomicilio) ;
                    $datosAdcicionales[$i]['observacion'] = NULL ;
                    $fecha = explode(' ', $key2->fecha_modificacion)[0];
                    $fecha = explode('-', $fecha);
                    $datosAdcicionales[$i]['fecharegistro'] = "<span style='display: none;'>".$fecha[2].$fecha[1].$fecha[0]."</span>".$fecha[2].'/'.$fecha[1].'/'.$fecha[0] ;
                    $datosAdcicionales[$i]['rol'] = 'Deudor' ;
                    $datosAdcicionales[$i]['deudor'] = utf8_encode($key2->deudor) ;
                    $datosAdcicionales[$i]['liquidacion'] = NULL ;
                    $datosAdcicionales[$i]['identificacion'] = utf8_encode($key2->identificacion) ;

                    $datosAdcicionales[$i]['ciudadOficina'] = utf8_encode($key2->ciudadOficina) ;
                    $datosAdcicionales[$i]['tefonoOficina'] = utf8_encode($key2->tefonoOficina) ;
                    $datosAdcicionales[$i]['celular'] = utf8_encode($key2->celular) ;
                    $datosAdcicionales[$i]['celularAdicional'] = utf8_encode($key2->celularAdicional) ;
                    $datosAdcicionales[$i]['direccionOficina'] = utf8_encode($key2->direccionOficina) ;

                    $datosAdcicionales[$i]['Calificacion_correo'] = utf8_encode($key2->cal_mail);
                    $datosAdcicionales[$i]['Calificacion_telefono'] = utf8_encode($key2->cal_telefonoDomicilio);
                    $datosAdcicionales[$i]['Calificacion_direccion'] = utf8_encode($key2->cal_direccionDomicilio) ;
                    $datosAdcicionales[$i]['Calificacion_ciudad'] = utf8_encode($key2->cal_ciudad_adicional) ;


                    $datosAdcicionales[$i]['cal_ciudadDomicilio'] = utf8_encode($key2->cal_ciudadDomicilio) ;
                    $datosAdcicionales[$i]['cal_ciudadOficina'] = utf8_encode($key2->cal_ciudadOficina) ;
                    $datosAdcicionales[$i]['cal_tefonoOficina'] = utf8_encode($key2->cal_tefonoOficina) ;
                    $datosAdcicionales[$i]['cal_telefonoDomicilio'] = utf8_encode($key2->cal_telefonoDomicilio) ;
                    $datosAdcicionales[$i]['cal_celular'] = utf8_encode($key2->cal_celular) ;
                    $datosAdcicionales[$i]['cal_celularAdicional'] = utf8_encode($key2->cal_celularAdicional) ;
                    $datosAdcicionales[$i]['cal_mail'] = utf8_encode($key2->cal_mail) ;
                    $datosAdcicionales[$i]['cal_direccionDomicilio'] = utf8_encode($key2->cal_direccionDomicilio) ;
                    $datosAdcicionales[$i]['cal_direccionOficina'] = utf8_encode($key2->cal_direccionOficina) ;
                    $datosAdcicionales[$i]['cal_dir_Adicional'] = utf8_encode($key2->cal_dir_Adicional) ;
                    $datosAdcicionales[$i]['cal_tele_adicional'] = utf8_encode($key2->cal_tele_adicional) ;
                    $datosAdcicionales[$i]['cal_ciudad_adicional'] = utf8_encode($key2->cal_ciudad_adicional) ;



                   $i++;
                }
                $idViejo = $idNuevo;
            }  

            foreach ($result as $key) {
                $datosAdcicionales[$i]['correeo'] = utf8_encode($key->correeo) ;
                $datosAdcicionales[$i]['telefono'] = utf8_encode($key->telefono) ;
                $datosAdcicionales[$i]['direccion'] = utf8_encode($key->direccion) ;
                $datosAdcicionales[$i]['ciudad'] = utf8_encode($key->ciudad) ;
                $datosAdcicionales[$i]['observacion'] = utf8_encode($key->observacion) ;
                $fecha = explode(' ', $key->fecha_ingreso)[0];
                $fecha = explode('-', $fecha);
                $datosAdcicionales[$i]['fecharegistro'] = $fecha[2].'/'.$fecha[1].'/'.$fecha[0] ;
                $datosAdcicionales[$i]['rol'] = utf8_encode($key->rol) ;
                $datosAdcicionales[$i]['deudor'] = utf8_encode($key->deudor) ;
                $datosAdcicionales[$i]['liquidacion'] = utf8_encode($key->liquidacion) ;
                $datosAdcicionales[$i]['identificacion'] = utf8_encode($key->identificacion) ;


                $datosAdcicionales[$i]['Calificacion_correo'] = utf8_encode($key->Calificacion_correo);
                $datosAdcicionales[$i]['Calificacion_telefono'] = utf8_encode($key->Calificacion_telefono);
                $datosAdcicionales[$i]['Calificacion_direccion'] = utf8_encode($key->Calificacion_direccion);
                $datosAdcicionales[$i]['Calificacion_ciudad'] = utf8_encode($key->Calificacion_ciudad);


                $datosAdcicionales[$i]['ciudadOficina'] = NULL ;
                $datosAdcicionales[$i]['tefonoOficina'] = NULL ;
                $datosAdcicionales[$i]['celular'] = NULL ;
                $datosAdcicionales[$i]['celularAdicional'] = NULL;
                $datosAdcicionales[$i]['direccionOficina'] = NULL;


                $datosAdcicionales[$i]['cal_ciudadDomicilio'] = NULL ;
                $datosAdcicionales[$i]['cal_ciudadOficina'] = NULL ;
                $datosAdcicionales[$i]['cal_tefonoOficina'] = NULL ;
                $datosAdcicionales[$i]['cal_telefonoDomicilio'] = NULL ;
                $datosAdcicionales[$i]['cal_celular'] = NULL ;
                $datosAdcicionales[$i]['cal_celularAdicional'] = NULL ;
                $datosAdcicionales[$i]['cal_mail'] = NULL ;
                $datosAdcicionales[$i]['cal_direccionDomicilio'] = NULL ;
                $datosAdcicionales[$i]['cal_direccionOficina'] = NULL ;
                $datosAdcicionales[$i]['cal_dir_Adicional'] = NULL ;
                $datosAdcicionales[$i]['cal_tele_adicional'] = NULL;
                $datosAdcicionales[$i]['cal_ciudad_adicional'] = NULL ;

               $i++;
            }  



            $datos = array('DatosAdicionales' => json_encode($datosAdcicionales));
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/datosAdcicionales', $datos);
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

    //esta es para eliminar las gestiones judiciales mal echas
    function getJudicialesForDelete(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIEliminarGetsiones');
            $extrajudicial = $this->Wizard_Model->getgestioJudicialTotal();
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
            $this->load->view('Auxiliar/judicial', $data );
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

        //esta es para eliminar las gestiones judiciales mal echas
    function getExtraJudicialesForDelete(){
        if($this->session->userdata('login_ok')){
            ini_set('memory_limit', '1024M');
            $datosFooter = array('ul'=> 'ULconfiguracion' , 'li' => 'LIEliminarGetsionesE');
            
            $this->load->view('Includes/head');
            $this->load->view('Includes/header');
            $this->load->view('Includes/sidebar');
            $this->load->view('Auxiliar/Extrajudicial');
            $this->load->view('Includes/footer', $datosFooter);
        }else{
            $this->load->view('Login/login');
        }
    }

     //eliminar gestion Judicial
    function eliminarGestionExtrajudicial(){
        if($this->session->userdata('login_ok')){
            $this->db->where('G742_ConsInte__b', $_POST['IdEliminar']);
            if($this->db->delete('G742')){
                echo '1';
            }else{
                echo '0';
            }
        }else{
            echo "No tiene permisos para ver esta información!";
        }
    }

    
}
?>