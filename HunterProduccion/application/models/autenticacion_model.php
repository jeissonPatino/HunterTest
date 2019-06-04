<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Autenticacion_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

     function verificaUsuario($codigo, $password){
        $this->db->select('USUARI_ConsInte__b, USUARI_Codigo____b');
        $this->db->where('USUARI_Codigo____b', $codigo);
        $this->db->where('USUARI_Clave_____b', $password);
        $this->db->where('USUARI_Bloqueado_b', 0);
        $query = $this->db->get('USUARI');
        // si el resultado de la query es positivo
        if ($query->num_rows() > 0){
            // devolvemos TRUE
            return TRUE;
            // si el resultado de la query no es positivo
        } else {
            // devolvemos FALSE
            return FALSE;
        }
    }


    function getdatosUsuario($codigo){
       
        $this->db->select('USUARI.USUARI_ConsInte__b as USUARI_ConsInte__b, 
                            USUARI.USUARI_Codigo____b as USUARI_Codigo____b, 
                            USUARI.USUARI_Nombre____b as USUARI_Nombre____b, 
                            USUARI.USUARI_Cargo_____b as USUARI_Cargo_____b, 
                            USUARI_FechCrea__b, 
                            G723_ConsInte__b, 
                            USUARI_LlaveExte_b
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
                            ,USUARI_reportes_p
                            ,USUARI_configuracion_eliminarObligaciones_p
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
                            Exportar_datos_adicionales_permisos_,
                            Eliminar_Gestiones_judiciales_permisos_,
                            GestionarDatosClientes,
                            EliminarGestores,
                            Logeliminacion');
        $this->db->from('USUARI');
        $this->db->join('G723' , 'G723_C17204 = USUARI_Identific_b', 'LEFT');
        $this->db->where('USUARI_Codigo____b', $codigo);
        $query = $this->db->get();
        return $query->result();
    }


}

?>