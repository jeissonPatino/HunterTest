<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configuraciones_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


    function getMinimo(){
        $this->db->select('G758_C17367, G758_ConsInte__b');     
        $query = $this->db->get('G758');
        return $query->result();
    }

    function delete(){

        return $this->db->empty_table('G758'); 
    }

    function getAbogados(){
        $this->db->select('G723_ConsInte__b as id, Frg_ConsInte__b , G723_C17204 as cedula, G723_C17099 as Nombre, G723_C17100 as celular, G723_C17101 as correo');     
        $this->db->order_by('G723_C17099', 'ASC');
        $query = $this->db->get('G723');

        return $query->result();
    }
	
	function getGestores(){
        $this->db->select(' USUARI_ConsInte__b as id, USUARI_Nombre____b as nombre');     
		$this->db->where('USUARI_Cargo_____b', 'GESTOR');
		$this->db->order_by('USUARI_Nombre____b', 'ASC');
		$query = $this->db->get('USUARI');
        return $query->result();
    }

    function getAbogadoById($G723_ConsInte__b){
        $this->db->select('G723_ConsInte__b as id, G723_C17204 as cedula, Frg_ConsInte__b, G723_C17099 as Nombre, G723_C17100 as celular, G723_C17101 as correo, direccion, telefono, Firma_abogados');   
        $this->db->where('G723_ConsInte__b', $G723_ConsInte__b);  
        $query = $this->db->get('G723');
        return $query->result();
    }

    function getAbogadoByfrg($Frg_ConsInte__b){
        $this->db->select('G723_ConsInte__b as id, Frg_ConsInte__b,  G723_C17204 as cedula, G723_C17099 as Nombre, G723_C17100 as celular, G723_C17101 as correo, direccion, telefono, Firma_abogados');   
        $this->db->where('Frg_ConsInte__b', $Frg_ConsInte__b);  
        $query = $this->db->get('G723');
        return $query->result();
    }

    function getActuaciones(){
        $this->db->select('G724_ConsInte__b as id, 
                            G724_C17102 as Tipo_de_proceso, 
                            G724_C17103 as Etapa, 
                            G724_C17104 as Codigo_actuacion, 
                            G724_C17105 as Descripcion_actuacion');     
        $query = $this->db->get('G724');
        return $query->result();
    }

    function validarActuacion($codigo, $etapa){
        $this->db->select('G724_ConsInte__b as id, 
                            G724_C17102 as Tipo_de_proceso, 
                            G724_C17103 as Etapa, 
                            G724_C17104 as Codigo_actuacion, 
                            G724_C17105 as Descripcion_actuacion');     
        $this->db->where('G724_C17103', $etapa );
        $this->db->where('G724_C17104', $codigo );
        $query = $this->db->get('G724');
        if ($query->num_rows() > 1){
             return true;
        }else{
            return false;
        }
       
    }

    function getActuacionesById($G724_ConsInte__b){
        $this->db->select('G724_ConsInte__b as id, 
                            LISOPC_Nombre____b as Tipo_de_proceso, 
                            G725_C17108 as Etapa, 
                            G725_C17107 as codigoEtapa,
                            G724_C17104 as Codigo_actuacion, 
                            G724_C17105 as Descripcion_actuacion'); 
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G724_C17102');
        $this->db->join('G725', 'G725_ConsInte__b = G724_C17103');
        $this->db->where('G724_ConsInte__b', $G724_ConsInte__b);  
        $query = $this->db->get('G724');
         return $query->result();
    }

    function getFiltrosComboEtapas($proceso){
        $this->db->select('G725_ConsInte__b,  G725_C17107 , G725_C17108 AS descripcion');
        $this->db->from('G725');
        $this->db->where('G725_C17106', $proceso);
        $this->db->order_by('G725_C17108', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


    function getListaDepartamentos(){
        $this->db->select('G718_C17016');
        $this->db->from('G718');
        $this->db->group_by('G718_C17016');
        $this->db->order_by('G718_C17016', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    function getCiudades(){
        $this->db->select(' G718_ConsInte__b as id, 
                            G718_C17016 as Departamento, 
                            G718_C17015 as ciudad ');    
        
        $this->db->order_by('G718_C17015', 'ASC');
        $query = $this->db->get('G718');
        return $query->result();
    }

    function getCiudadesById($G741_ConsInte__b){
          $this->db->select('G718_ConsInte__b as id, 
                            G718_C17016 as Departamento, 
                            G718_C17015 as ciudad');   
        $this->db->where('G718_ConsInte__b', $G741_ConsInte__b);
        $query = $this->db->get('G718');
        return $query->result();
    }

    //getdatos adicionales
    function getDatosAdicionales(){
        $this->db->select('TOP 1000 G717_C17240 as Deudor, G717_C17005 as identificacion,
            tipo_identificacion as tipo_identificacion,
                           G717_C17006 as TelefonoD, G717_C17008 as TelefonoO,
                           G717_C17007 as DireccionD, G718_C17015 as ciudadD,
                           G717_C17009 as DireccionO, G717_C17013 as CiudadO,
                           G717_C17010 as Celular, G717_C17011 as CelularA,
                           G717_C17017 as Mail, G717_C17154 as Nobligaciones, G717_ConsInte__b as idusuario');
        $this->db->join('G718', 'G718_ConsInte__b = G717_C17012');
        $query = $this->db->get('G717');
        return $query->result();
    }

    function getDatosAdicionalesByUser($cliente){
        $this->db->select(' G743_C17363 as CORREO_ELECTRONICO,
                            G743_C17256 as TELEFONO,
                            G743_C17257 as DIRECCION,
                            G743_C17258 as CIUDAD,
                            G743_C17259 as CALIFICACION,
                            G743_C17260 as DESCRIPCION,
                            G743_C17261 as ID_PERSONAS,
                            G743_ConsInte__b as id ');
        $this->db->where('G743_C17261', $cliente);
        $query = $this->db->get('G743');
        return $query->result();
    }

    
    //Etapas
    function getetapas(){
        $this->db->select('G725_C17108 as Etapa, G725_C17107 as Codigo, LISOPC_Nombre____b as proceso, G725_ConsInte__b, Campo_Imagen, Campo_orden');
        $this->db->from('G725');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G725_C17106');
        $query = $this->db->get();
        return $query->result();
    }

    function getetapasById($G725_ConsInte__b){
        $this->db->select('G725_C17108 as Etapa, G725_C17107 as Codigo, G725_C17106 as proceso, G725_ConsInte__b, Campo_orden , Campo_Imagen');

        $this->db->where('G725_ConsInte__b', $G725_ConsInte__b);
        $query = $this->db->get('G725');

        return $query->result();
    }

    //Gatos judiciales por contrato elegido
    function getDatosjudicialesByContrato($contrato){
        $this->db->select(' TOP 1 G745_C17287 as CuentaCobro, 
                            G745_C17288 as Concepto, 
                            G745_C17289 as FechaCobro, 
                            G745_C17290 as Valor, 
                            G745_C17291 as Otro, 
                            G745_C17292 as Contrato,
                            G745_ConsInte__b');

        $this->db->where('G745_C17292', $contrato);
        $this->db->order_by('G745_ConsInte__b', 'DESC');
        $query = $this->db->get('G745');

        return $query->result();
    }

    //Frg
    function getFrgs(){
        $this->db->select(' G729_C17121 as Frg, 
                            G729_C17122 as direccion, 
                            G729_C17123 as ciudad, 
                            G729_C17124 as telefono, 
                            G729_C17125 as contacto, 
                            G729_ConsInte__b');
        $query = $this->db->get('G729');
        return $query->result();
    }

    function getDatosFrgs($contrato){
        $this->db->select(' G729_C17121 as Frg, 
                            G729_C17122 as direccion, 
                            G729_C17123 as ciudad, 
                            G729_C17124 as telefono, 
                            G729_C17125 as contacto, 
                            G729_ConsInte__b');
        $this->db->where('G729_ConsInte__b', $contrato);
        $query = $this->db->get('G729');

        return $query->result();
    }


    //garantias y pagares
    function getGarantias(){
        $this->db->select(' G734_C17135 as garantia, 
                            G734_C17136 as pagare,
                            G734_ConsInte__b');
        $this->db->where('G734_C17135 != 0');
        $query = $this->db->get('G734');
        return $query->result();
    }

    function getGarantiasByGarantia($contrato){
        $this->db->select(' G734_C17135 as Garantia, 
                            G734_C17136 as pagare, 
                            G719_C17026 as contrato,  
                            G734_ConsInte__b, G719_ConsInte__b');
        $this->db->join('G719','G719_ConsInte__b = G734_C17241');
        $this->db->where('G734_C17135', $contrato);
        $query = $this->db->get('G734');
        return $query->result();
    }


    //IF
    function getIF(){
        $this->db->select('G730_C17126,
                            G730_ConsInte__b');
        $query = $this->db->get('G730');
        return $query->result();
    }

    function getIFByid($id){
        $this->db->select(' G730_C17126,
                            G730_ConsInte__b');
        $this->db->where('G730_ConsInte__b', $id);
        $query = $this->db->get('G730');
        return $query->result();
    }

    //medidas Cautelares
    
     function getMedidas(){
        $this->db->select('G731_C17127 as codigo,
                            G731_C17128 as descripcion,
                            G731_ConsInte__b');
        $query = $this->db->get('G731');
        return $query->result();
    }

    function getMedidasByid($id){
        $this->db->select('G731_C17127 as codigo,
                            G731_C17128 as descripcion,
                            G731_ConsInte__b');
        $this->db->where('G731_ConsInte__b', $id);
        $query = $this->db->get('G731');
        return $query->result();
    }

    //function para obtener los relaciones de usuario y rol
    function getObligacionesPersonas(){
        $this->db->select(' G737_C17181 as usuario,
                            G737_C17182 as contrato,
                            G737_C17183 as rol,
                            G737_ConsInte__b,
                            G717_C17005 as nombre_Usuario,
                            LISOPC_Nombre____b as Roles,
                            G719_C17026 as OBLIGACION');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183');

        $query = $this->db->get('G737');
        return $query->result();

    }

     function getObligacionesPersonasByID($id){
        $this->db->select(' G737_C17181 as usuario,
                            G737_C17182 as contrato,
                            G737_C17183 as rol,
                            G737_ConsInte__b,
                            G717_C17005 as nombre_Usuario,
                            LISOPC_Nombre____b as Roles,
                            G719_C17026 as OBLIGACION');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->join('LISOPC', 'LISOPC_ConsInte__b = G737_C17183');
        
        $this->db->where('G737_ConsInte__b', $id);
        $query = $this->db->get('G737');
        return $query->result();

    }

    //Despachos
    Function getDespachos(){
       $this->db->select('  G733_C17132 as despacho,
                            G718_C17015 as ciudad,
                            G733_ConsInte__b as id');
        $this->db->join('G718', 'G718_ConsInte__b = G733_C17133', 'LEFT');
        $query = $this->db->get('G733'); 
        return $query->result(); 
    }

    Function getDespachosById($id){
        $this->db->select('  G733_C17132 as despacho,
                            G718_C17015 as ciudad,
                            G733_ConsInte__b as id');
        $this->db->join('G718', 'G718_ConsInte__b = G733_C17133', 'LEFT');
        $this->db->where('G733_ConsInte__b', $id);
        $query = $this->db->get('G733');  
        return $query->result(); 
    }


    function getUsuarios(){
        $this->db->select(' USUARI_ConsInte__b as id,
                            USUARI_Codigo____b as codigo,
                            USUARI_Nombre____b as nombres,
                            USUARI_Cargo_____b as cargo,
                            USUARI_Identific_b as identificacion');
        $query = $this->db->get('USUARI');  
        return $query->result(); 
    }

    function getUsuariosByid($id){
        $this->db->select(' USUARI_ConsInte__b as id,
                            USUARI_Codigo____b as codigo,
                            USUARI_Nombre____b as nombres,
                            USUARI_Cargo_____b as cargo,
                            USUARI_Identific_b as identificacion
                            ,USUARI_asignacion_abogados_p
                            ,USUARI_asignacion_gestores_p
                            ,USUARI_configuracion_abogados_p
                            ,USUARI_configuracion_actuaciones_p
                            ,USUARI_configuracion_acuerdos_p
                            ,USUARI_configuracion_ciudades_p
                            ,USUARI_configuracion_salario_p
                            ,USUARI_configuracion_despachos_p
                            ,USUARI_configuracion_etapas_p
                            ,USUARI_configuracion_facturas_p
                            ,USUARI_configuracion_gastos_p
                            ,USUARI_configuracion_FRG_p
                            ,USUARI_configuracion_subgestiones_p
                            ,USUARI_configuracion_usuarios_p
                            ,USUARI_gestion_extrajudicial_p
                            ,USUARI_gestion_judicial_p
                            ,USUARI_gestion_exfuncionarios_p
                            ,USUARI_historico_extrajudicial_p
                            ,USUARI_historico_judicial_p
                            ,USUARI_historico_medidas_p
                            ,USUARI_configuracion_eliminarObligaciones_p
                            ,USUARI_reportes_p
                            ,USUARI_LlaveExte_b
                            ,firmas_abogados_permiso_ 
                            ,configurar_valores_conceptos_permisos_ 
                            ,cargar_devolucion_subrogaciones_permisos_ 
                            ,cargar_envio_subrogaciones_permisos_ 
                            ,subrogacion_permiso_ 
                            ,Sentencia_irrecuperable_permiso_ 
                            ,cisa_permiso_ 
                            ,gastos_judiciales_permiso_ 
                            ,Rep_asignacion_abogados_permiso_ 
                            ,Rep_gestion_judicial_mensual_permiso_ 
                            ,Rep_subrogaciones_efectivas_permiso_ 
                            ,Rep_soporte_cisa_permiso_ 
                            ,Rep_radicacion_memorial_permiso_ 
                            ,Rep_gestion_judicial_permiso_ 
                            ,Rep_reporte_medidas_cautelares_permiso_ 
                            ,Rep_medidas_cautelares_efectivas_permiso_ ,
                            cargar_fecha_terminacion_permisos_,
                            Eliminar_Facturas_permisos_,
                            GestionarDatosClientes,
                            Exportar_datos_adicionales_permisos_,
                            Eliminar_Gestiones_judiciales_permisos_,
                            EliminarGestores,
                            Logeliminacion,
                            EnvioCorreo');
        $this->db->where('USUARI_ConsInte__b', $id);
        $query = $this->db->get('USUARI');  
        return $query->result(); 
    }

    function getDatosinicialesCalificados($idUsuario){
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
        $this->db->where("iddeusuario", $idUsuario);

        $query = $this->db->get();
        return $query->result();

    }

    function getEtapasByProceso($proceso){
        $this->db->select('G725_ConsInte__b, Campo_Imagen, Campo_orden, G725_C17108 as Etapa');
        $this->db->from('G725');
        $this->db->where('G725_C17106', $proceso);
        $this->db->order_by('Campo_orden', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    
    /////// Funciones modulos depuracion  Datos no Efectivos, Creado por Jeisson Patiño 17/12/2018

    function getDatosinicialesNoEfectivos(){
        $this->db->select("id_log_datos
                            ,G717_C17005 as identificacion
                            ,tipo_identificacion as tipo_identifiacion
                            ,G719_C17026 as liquidacion 
                          ,x.G718_C17015 as ciudadDomicilio
                          ,y.G718_C17015 as ciudadOficina
                          ,DATOS.tefonoOficina
                          ,DATOS.telefonoDomicilio
                          ,DATOS.celular
                          ,DATOS.celularAdicional
                          ,DATOS.mail
                          ,DATOS.direccionDomicilio
                          ,DATOS.direccionOficina
                          ,DATOS.iddeusuario
                          ,DATOS.dir_Adicional
                          ,DATOS.tele_adicional
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
        $this->db->from("Log_datos_iniciales as DATOS");

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
        $this->db->join('G717 cliente', 'cliente.G717_ConsInte__b = iddeusuario', 'LEFT');
        $this->db->join('G737', 'cliente.G717_ConsInte__b = G737_C17181', 'LEFT');
        $this->db->join('G719', 'G719_ConsInte__b = G737_C17182', 'LEFT');
        $this->db->where("cal_celular = 1802 or cal_celularAdicional = 1802 or cal_ciudad_adicional = 1802 or cal_ciudadDomicilio = 1802 or cal_ciudadOficina = 1802 or cal_dir_Adicional = 1802 or cal_direccionDomicilio = 1802 or  cal_direccionOficina = 1802 or  cal_mail = 1802 or cal_tefonoOficina = 1802 or cal_tele_adicional = 1802 or cal_telefonoDomicilio = 1802");
        $this->db->where("G719_C17026 is not null");
        $this->db->order_by("G719_C17026","DESC");
        $query = $this->db->get();
        return $query->result();

    }


function DepurarDatosNoEfectivos(){
         
        $this->db->query("UPDATE Log_datos_iniciales SET celular = NULL, cal_celular = 0 where cal_celular = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET celularAdicional = null, cal_celularAdicional = 0 where cal_celularAdicional = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET ciudad_adicional = null,    cal_ciudad_adicional = 0 where cal_ciudad_adicional = '1802'");
        $this->db->query("UPDATE Log_datos_iniciales SET direccionDomicilio = null,  cal_direccionDomicilio= 0 where cal_direccionDomicilio = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET direccionOficina = null, cal_direccionOficina = 0 WHERe cal_direccionOficina = '1802'");
        $this->db->query("UPDATE Log_datos_iniciales SET telefonoDomicilio = null, cal_telefonoDomicilio = 0 where cal_telefonoDomicilio = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET mail = null, cal_mail= 0  where cal_mail = '1802'  ");
        $this->db->query("UPDATE Log_datos_iniciales SET tefonoOficina = null, cal_tefonoOficina = 0  where cal_tefonoOficina = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET tele_adicional = null, cal_tele_adicional = 0  where cal_tele_adicional = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET dir_Adicional = null, cal_dir_Adicional = 0 WHERE  cal_dir_Adicional = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET ciudadDomicilio = null, cal_ciudadDomicilio = 0 where cal_ciudadDomicilio = '1802' ");
        $this->db->query("UPDATE Log_datos_iniciales SET ciudadOficina = null , cal_ciudadOficina = 0 where cal_ciudadOficina = '1802'");
        
    } 

    function DatosNoEfectivosInforme(){
        $this->db->select("liquidacion,
                            TipoIdentificacion,
                            Identificacion,
                            Direccion_domicilio,
                            Calificacion_Dir_Domicilio,
                            Ciudad_domicilio,
                            Calificacion_Ciudad_domicilio,
                            Direccion_oficina,
                            Calificacion_Direccion_oficina,
                            Ciudad_oficina,
                            Calificacion_Ciudad_oficina,
                            Telefono_domicilio,
                            Calificacion_Telefono_domicilio,
                            Telefono_oficina,
                            Calificacion_Telefono_oficina,
                            Celular,
                            Calificacion_Celular,
                            Celular_adicional,
                            Calificacion_Celular_adicional,
                            Correo_electronico,
                            Calificacion_Correo_electronico,
                            Direccion_adicional,
                            Calificacion_Direccion_adicional,
                            Ciudad_adicional,
                            Calificacion_Ciudad_adicional,
                            Telefono_adicional,
                            Calificacion_Telefono_adicional,
                            Fecha_modificacion");
        $this->db->from("GestionDatosCliente");
        $this->db->where("Calificacion_Celular  = 'No Efectivo' or 
                        Calificacion_Celular_adicional = 'No Efectivo' or 
                        Calificacion_Ciudad_adicional = 'No Efectivo' or 
                        Calificacion_Ciudad_domicilio = 'No Efectivo' or 
                        Calificacion_Ciudad_oficina = 'No Efectivo' or 
                        Calificacion_Correo_electronico = 'No Efectivo' or 
                        Calificacion_Dir_Domicilio = 'No Efectivo' or 
                        Calificacion_Direccion_adicional = 'No Efectivo' or 
                        Calificacion_Direccion_oficina = 'No Efectivo' or 
                        Calificacion_Telefono_adicional = 'No Efectivo' or 
                        Calificacion_Telefono_domicilio = 'No Efectivo' or 
                        Calificacion_Telefono_oficina = 'No Efectivo'");
        $this->db->order_by("liquidacion","DESC");
        $query = $this->db->get();
        return $query->result();

    }


     function DatosEfectivosInforme(){
        $this->db->select("liquidacion,
                            TipoIdentificacion,
                            Identificacion,
                            Direccion_domicilio,
                            Calificacion_Dir_Domicilio,
                            Ciudad_domicilio,
                            Calificacion_Ciudad_domicilio,
                            Direccion_oficina,
                            Calificacion_Direccion_oficina,
                            Ciudad_oficina,
                            Calificacion_Ciudad_oficina,
                            Telefono_domicilio,
                            Calificacion_Telefono_domicilio,
                            Telefono_oficina,
                            Calificacion_Telefono_oficina,
                            Celular,
                            Calificacion_Celular,
                            Celular_adicional,
                            Calificacion_Celular_adicional,
                            Correo_electronico,
                            Calificacion_Correo_electronico,
                            Direccion_adicional,
                            Calificacion_Direccion_adicional,
                            Ciudad_adicional,
                            Calificacion_Ciudad_adicional,
                            Telefono_adicional,
                            Calificacion_Telefono_adicional,
                            Fecha_modificacion");
        $this->db->from("GestionDatosCliente");
        $this->db->where("Calificacion_Celular  = 'Efectivo' AND 
                        Calificacion_Celular_adicional = 'Efectivo' AND 
                        Calificacion_Ciudad_adicional = 'Efectivo' AND 
                        Calificacion_Ciudad_domicilio = 'Efectivo' AND 
                        Calificacion_Ciudad_oficina = 'Efectivo' AND 
                        Calificacion_Correo_electronico = 'Efectivo' AND 
                        Calificacion_Dir_Domicilio = 'Efectivo' AND 
                        Calificacion_Direccion_adicional = 'Efectivo' AND 
                        Calificacion_Direccion_oficina = 'Efectivo' AND 
                        Calificacion_Telefono_adicional = 'Efectivo' AND 
                        Calificacion_Telefono_domicilio = 'Efectivo' AND 
                        Calificacion_Telefono_oficina = 'Efectivo'");
        $this->db->order_by("liquidacion","DESC");
        $query = $this->db->get();
        return $query->result();

    }


    function DatosSinGestionarInforme(){
         $this->db->select("liquidacion,
                            TipoIdentificacion,
                            Identificacion,
                            Direccion_domicilio,
                            Calificacion_Dir_Domicilio,
                            Ciudad_domicilio,
                            Calificacion_Ciudad_domicilio,
                            Direccion_oficina,
                            Calificacion_Direccion_oficina,
                            Ciudad_oficina,
                            Calificacion_Ciudad_oficina,
                            Telefono_domicilio,
                            Calificacion_Telefono_domicilio,
                            Telefono_oficina,
                            Calificacion_Telefono_oficina,
                            Celular,
                            Calificacion_Celular,
                            Celular_adicional,
                            Calificacion_Celular_adicional,
                            Correo_electronico,
                            Calificacion_Correo_electronico,
                            Direccion_adicional,
                            Calificacion_Direccion_adicional,
                            Ciudad_adicional,
                            Calificacion_Ciudad_adicional,
                            Telefono_adicional,
                            Calificacion_Telefono_adicional,
                            Fecha_modificacion");
        $this->db->from("GestionDatosCliente");
        $this->db->where("Calificacion_Celular  is null or 
                        Calificacion_Celular_adicional is null or 
                        Calificacion_Ciudad_adicional is null or 
                        Calificacion_Ciudad_domicilio is null or 
                        Calificacion_Ciudad_oficina is null or 
                        Calificacion_Correo_electronico is null or 
                        Calificacion_Dir_Domicilio is null or 
                        Calificacion_Direccion_adicional is null or 
                        Calificacion_Direccion_oficina is null or 
                        Calificacion_Telefono_adicional is null or 
                        Calificacion_Telefono_domicilio is null or 
                        Calificacion_Telefono_oficina is null");
        $this->db->order_by("liquidacion","DESC");
        $query = $this->db->get();
        return $query->result();

    }

    function LimpriarTablaInformes(){
        $this->db->query("Delete From GestionDatosCliente where convert(date,Fecha_modificacion) != convert(date,getdate())");
    }

    function IngresarDatosLog_Datos_Inciales(){
        $this->db->query("insert into Log_datos_iniciales (ciudadDomicilio,  ciudadOficina,tefonoOficina, telefonoDomicilio, celular, celularAdicional, mail, direccionDomicilio, direccionOficina,  iddeusuario,dir_Adicional,  tele_adicional,  ciudad_adicional,  cal_ciudadDomicilio,  cal_ciudadOficina,  cal_tefonoOficina,  cal_telefonoDomicilio,  cal_celular,  cal_celularAdicional, cal_mail, cal_direccionDomicilio, cal_direccionOficina, cal_dir_Adicional, cal_tele_adicional, cal_ciudad_adicional, fecha_modificacion)
            Select X.G718_ConsInte__b,  Y.G718_ConsInte__b, Telefono_oficina, Telefono_domicilio, Celular, Celular_adicional, Correo_electronico, Direccion_domicilio, Direccion_oficina, G717.G717_ConsInte__b, Direccion_adicional, Telefono_adicional, Z.G718_ConsInte__b,A.LISOPC_ConsInte__b,B.LISOPC_ConsInte__b,C.LISOPC_ConsInte__b, D.LISOPC_ConsInte__b, E.LISOPC_ConsInte__b, F.LISOPC_ConsInte__b, G.LISOPC_ConsInte__b,H.LISOPC_ConsInte__b,I.LISOPC_ConsInte__b,J.LISOPC_ConsInte__b,K.LISOPC_ConsInte__b,M.LISOPC_ConsInte__b,Fecha_modificacion From GestionDatosCliente 
            LEFT JOIN G718 AS X ON X.G718_C17015 = Ciudad_domicilio
            LEFT JOIN G718 AS Y ON Y.G718_C17015 = Ciudad_oficina
            LEFT JOIN G718 AS Z ON Z.G718_C17015 = Ciudad_adicional
            LEFT JOIN G717 ON G717.G717_C17005 = Identificacion
            LEFT JOIN LISOPC AS A ON A.LISOPC_Nombre____b = Calificacion_Ciudad_domicilio
            LEFT JOIN LISOPC AS B ON B.LISOPC_Nombre____b = Calificacion_Ciudad_oficina
            LEFT JOIN LISOPC AS C ON C.LISOPC_Nombre____b = Calificacion_Telefono_oficina
            LEFT JOIN LISOPC AS D ON D.LISOPC_Nombre____b = Calificacion_Telefono_domicilio
            LEFT JOIN LISOPC AS E ON E.LISOPC_Nombre____b = Calificacion_Celular
            LEFT JOIN LISOPC AS F ON F.LISOPC_Nombre____b = Calificacion_Celular_adicional
            LEFT JOIN LISOPC AS G ON G.LISOPC_Nombre____b = Calificacion_Correo_electronico
            LEFT JOIN LISOPC AS H ON H.LISOPC_Nombre____b = Calificacion_Dir_Domicilio
            LEFT JOIN LISOPC AS I ON I.LISOPC_Nombre____b = Calificacion_Direccion_oficina
            LEFT JOIN LISOPC AS J ON J.LISOPC_Nombre____b = Calificacion_Direccion_adicional
            LEFT JOIN LISOPC AS K ON K.LISOPC_Nombre____b = Calificacion_Telefono_adicional
            LEFT JOIN LISOPC AS M ON M.LISOPC_Nombre____b = Calificacion_Ciudad_adicional");
    } 

// Funciones eliminar datos Gestores y Abogados Jeisson Patiño 

    function DatosAbogadosEliminar(){

        $abogado = 'ABOGADO';
         
        $this->db->select('USUARI_ConsInte__b as id,
                        USUARI_Codigo____b as codigo,
                        USUARI_Nombre____b as nombres,
                        USUARI_Cargo_____b as cargo,
                        USUARI_Identific_b as identificacion');
        $this->db->from('USUARI');
        $this->db->where('USUARI_Cargo_____b = ', $abogado);
        
        $query = $this->db->get();
         return $query->result();
        var_dump($query);
    } 

    function DatosGestoresEliminar(){


         $gestor = 'GESTOR';
         
        $this->db->select('USUARI_ConsInte__b as id,
                        USUARI_Codigo____b as codigo,
                        USUARI_Nombre____b as nombres,
                        USUARI_Cargo_____b as cargo,
                        USUARI_Identific_b as identificacion');
        $this->db->from('USUARI');
        $this->db->where('USUARI_Cargo_____b =',$gestor);
        $query = $this->db->get();

         return $query->result();
        
    } 



    function envioCorreoSupervisoresFRG(){

        $this->db->select('NombreAbogado,
                           CorreoAbogado');
        $this->db->from('ENVIO_CORREOS_ABOGADOS');
        $query = $this->db->get();
        return $query->result();
    }

    function enviar(){
        $this->db->select('CASE 
                                WHEN FechaEnvio = GETDATE() THEN 1
                                WHEN FechaEnvio != GETDATE() THEN 0
                           END');
        $this->db->from('ENVIO_CORREOS_ABOGADOS');
        $query = $this->db->get();
        if ($query->num_rows() > 1){
             return true;
        }else{
            return false;
        }
    }

// funcion para el adjunto del correo 
    function getAdjuntoCorreoIlocalizados(){
        $this->db->select('');
        $this->db->from('ENVIO_CORREOS_ABOGADOS');
        $query = $this->db->get();
        if ($query->num_rows() > 1){
             return true;
        }else{
            return false;
        }
    }

    
}
?>