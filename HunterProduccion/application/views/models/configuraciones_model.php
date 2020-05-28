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
        $this->db->select('Id as id, FRGId , CCAbogado as cedula, Nombre as Nombre, Celular as celular, CorreoElectronico as correo');     
        $this->db->order_by('Nombre', 'ASC');
        $query = $this->db->get('Abogados');

        return $query->result();
    }
	
	function getGestores(){
        $this->db->select(' USUARI_ConsInte__b as id, USUARI_Nombre____b as nombre');     
		$this->db->where('USUARI_Cargo_____b', 'GESTOR');
		$this->db->order_by('USUARI_Nombre____b', 'ASC');
		$query = $this->db->get('USUARI');
        return $query->result();
    }

    function getAbogadoById($Id){
        $this->db->select('Id as id, CCAbogado as cedula, FRGId, Nombre as Nombre, Celular as celular, CorreoElectronico as correo, Direccion, Telefono, FirmaAbogado');   
        $this->db->where('Id', $Id);  
        $query = $this->db->get('Abogados');
        return $query->result();
    }

    function getAbogadoByfrg($FRGId){
        $this->db->select('Id as id, FRGId,  CCAbogado as cedula, Nombre as Nombre, Celular as celular, CorreoElectronico as correo, Direccion, Telefono, FirmaAbogado');   
        $this->db->where('FRGId', $FRGId);  
        $query = $this->db->get('Abogados');
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
                            Nombre_b as Tipo_de_proceso, 
                            G725_C17108 as Etapa, 
                            G725_C17107 as codigoEtapa,
                            G724_C17104 as Codigo_actuacion, 
                            G724_C17105 as Descripcion_actuacion'); 
        $this->db->join('ParametroGeneral', 'Id = G724_C17102');
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
        $this->db->select('Departamento');
        $this->db->from('Ciudad');
        $this->db->group_by('Departamento');
        $this->db->order_by('Departamento', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    function getCiudades(){
        $this->db->select(' Id as id, 
                            Departamento as Departamento, 
                            Ciudad as ciudad ');    
        
        $this->db->order_by('Ciudad', 'ASC');
        $query = $this->db->get('Ciudad');
        return $query->result();
    }

    function getCiudadesById($G741_ConsInte__b){
          $this->db->select('Id as id, 
                            Departamento as Departamento, 
                            Ciudad as ciudad');   
        $this->db->where('Id', $G741_ConsInte__b);
        $query = $this->db->get('Ciudad');
        return $query->result();
    }

    //getdatos adicionales
    function getDatosAdicionales(){
        $this->db->select('TOP 1000 NombreDeudor as Deudor, NroIdentificacion as identificacion,
                           TelefonoDomicilio as TelefonoD, TelefonoOficina as TelefonoO,
                           DireccionDomicilio as DireccionD, Ciudad as ciudadD,
                           DireccionOficina as DireccionO, CiudadOficina as CiudadO,
                           Celular as Celular, CelularAdicional as CelularA,
                           CorreoElectronico as Mail, NroObligacionesDeudor as Nobligaciones, Id as idusuario');
        $this->db->join('Ciudad', 'Id = CiudadDomicilio');
        $query = $this->db->get('InformacionCliente');
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
        $this->db->select('G725_C17108 as Etapa, G725_C17107 as Codigo, Nombre_b as proceso, G725_ConsInte__b, Campo_Imagen, Campo_orden');
        $this->db->from('G725');
        $this->db->join('ParametroGeneral', 'Id = G725_C17106');
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
        $this->db->select(' FRG as Frg, 
                            Direccion as direccion, 
                            Ciudad as ciudad, 
                            Telefono as telefono, 
                            NombrePersonaContacto as contacto, 
                            Id');
        $query = $this->db->get('FRG');
        return $query->result();
    }

    function getDatosFrgs($contrato){
        $this->db->select(' FRG as Frg, 
                            Direccion as direccion, 
                            Ciudad as ciudad, 
                            Telefono as telefono, 
                            NombrePersonaContacto as contacto, 
                            Id');
        $this->db->where('Id', $contrato);
        $query = $this->db->get('FRG');

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
                            NoContrato as contrato,  
                            G734_ConsInte__b, Id');
        $this->db->join('InformacionCredito','Id = G734_C17241');
        $this->db->where('G734_C17135', $contrato);
        $query = $this->db->get('G734');
        return $query->result();
    }


    //IF
    function getIF(){
        $this->db->select('NombreIF,
                            Id');
        $query = $this->db->get('IntermediarioFinanciero');
        return $query->result();
    }

    function getIFByid($id){
        $this->db->select(' NombreIF,
                            Id');
        $this->db->where('Id', $id);
        $query = $this->db->get('IntermediarioFinanciero');
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
        $this->db->select(' InformacionClientesId as usuario,
                            NumeroContratoId as contrato,
                            Rol as rol,
                            Id,
                            NroIdentificacion as nombre_Usuario,
                            Nombre_b as Roles,
                            NoContrato as OBLIGACION');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->join('ParametroGeneral', 'Id = Rol');

        $query = $this->db->get('ClienteObligacion');
        return $query->result();

    }

     function getObligacionesPersonasByID($id){
        $this->db->select(' InformacionClientesId as usuario,
                            NumeroContratoId as contrato,
                            Rol as rol,
                            Id,
                            NroIdentificacion as nombre_Usuario,
                            Nombre_b as Roles,
                            NoContrato as OBLIGACION');
        $this->db->join('InformacionCredito', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->join('ParametroGeneral', 'Id = Rol');
        
        $this->db->where('Id', $id);
        $query = $this->db->get('ClienteObligacion');
        return $query->result();

    }

    //Despachos
    Function getDespachos(){
       $this->db->select('  Despacho as despacho,
                            Ciudad as ciudad,
                            Id as id');
        $this->db->join('Ciudad', 'Id = CiudadDespacho', 'LEFT');
        $query = $this->db->get('Despacho'); 
        return $query->result(); 
    }

    Function getDespachosById($id){
        $this->db->select('  Despacho as despacho,
                            Ciudad as ciudad,
                            Id as id');
        $this->db->join('Ciudad', 'Id = CiudadDespacho', 'LEFT');
        $this->db->where('Id', $id);
        $query = $this->db->get('Despacho');  
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
                            ,cargar_subrogaciones_permisos_ 
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
                            Eliminar_Facturas_permisos_');
        $this->db->where('USUARI_ConsInte__b', $id);
        $query = $this->db->get('USUARI');  
        return $query->result(); 
    }

    function getDatosinicialesCalificados($idUsuario){
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



}
?>