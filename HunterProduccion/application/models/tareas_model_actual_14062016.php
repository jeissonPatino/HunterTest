<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tareas_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getNumeroTareas($codigoUsuario){
        $this->db->select('G738_ConsInte__b');
        $this->db->where('G738_Usuario', $codigoUsuario);
        $this->db->where('G738_C17189', 1); //esto es por si toca filtrarlo por eso lo dejo
       
        $query = $this->db->get('G738');
        return $query->num_rows();
    }

    function getTareas($codigoUsuario){
    	 $this->db->select('G738_C17195 as fecha_ejecucion,
    	 					G738_C17196 as hora_ejecucion,
    	 					G738_C17186 as contrato_ejecucion,
    	 					G738_C17188 as descripcion,
                            G738_ConsInte__b
    	 					');
    	$this->db->from('G738');
    	$this->db->where('G738_Usuario', $codigoUsuario);
        $this->db->where('G738_C17189', 1);
	 	$query =  $this->db->get();
	 	return $query->result();
    }

    function getTareabyId($id){
        $this->db->select('G738_C17195 as fecha_ejecucion,
                            G738_C17196 as hora_ejecucion,
                            G738_C17186 as contrato_ejecucion,
                            G738_C17188 as descripcion,
                            G738_C17197 as cliente, 
                            G738_ConsInte__b
                            ');
        $this->db->from('G738');
        $this->db->where('G738_ConsInte__b', $id);
        $query =  $this->db->get();
        return $query->result();
    }
}

?>