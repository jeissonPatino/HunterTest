<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Conceptos_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function Conceptos__aPagar(){
    	$this->db->select("vcp_anho ,vcp_codigo, vcp_total_pago, vcp_estado, vcp_fecha_ingreso, concepto, vcp_id");
    	$this->db->from("valores_conceptos_pagos");
    	$this->db->join("conceptos", "codigo = vcp_codigo");
    	$query = $this->db->get();

    	return $query->result();
    }

	function Conceptos__aPagar_by($id){
    	$this->db->select("vcp_anho ,vcp_codigo, vcp_total_pago, vcp_estado, vcp_fecha_ingreso, concepto, vcp_id");
    	$this->db->from("valores_conceptos_pagos");
    	$this->db->join("conceptos", "codigo = vcp_codigo");
		$this->db->where('vcp_id', $id);
    	$query = $this->db->get();

    	return $query->result();
    }

    function getValoresSubrogacion($contrato){
    	$this->db->select("G719_C17026 as contrato, G719_C17393 as fecha_tramite, G719_C17212 as otra_fecha, G719_C17034 as valor_pagado, G719_C17216 as decision");
    	$this->db->from("G719");
    	$this->db->where("G719_C17026", $contrato);
    	$query = $this->db->get();
    	return $query->result();
    }

    function getValoresConcepto($anho, $concepto){
    	$this->db->select("vcp_total_pago");
    	$this->db->from("valores_conceptos_pagos");
    	$this->db->where("vcp_codigo", $concepto);
    	$this->db->where("vcp_anho", $anho);
		$this->db->where("vcp_estado", 'ACTIVO');
    	$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->row()->vcp_total_pago;
		}else{
			return 0;
		}
    		
    }

    function Conceptos__aPagar_by_codigo($codigo){
        $this->db->select("vcp_anho ,vcp_codigo, vcp_total_pago, vcp_estado, vcp_fecha_ingreso, concepto, vcp_id");
        $this->db->from("valores_conceptos_pagos");
        $this->db->join("conceptos", "codigo = vcp_codigo");
        $this->db->where('vcp_codigo', $codigo);
        $query = $this->db->get();

        return $query->result();
    }
}
?>