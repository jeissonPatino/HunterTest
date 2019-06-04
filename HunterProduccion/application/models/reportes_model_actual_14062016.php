<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reportes_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getReportes(){
    	$this->db->select('G759_ConsInte__b as id, G759_C17411 as reporte');
    	$this->db->from('G759');
    	$query = $this->db->get();
    	return $query->result();
    }

    function getTipoReporte($G759_ConsInte__b){
    	$this->db->select('G759_C17410 as tpo');
    	$this->db->from('G759');
    	$this->db->where('G759_ConsInte__b', $G759_ConsInte__b);
    	$query = $this->db->get();
    	return $query->row()->tpo;
    }

    function getArmadoRporte($G759_ConsInte__b){
    	$this->db->select('G759_C17409 as operacionDivisor,
    					  G759_C17411 as nombreGrafica,
    					  G759_C17412 as tipoGrafica,
    					  G759_C17413 as operacionDividendo,
    					  G759_C17396 as analisis,
    					  G759_C17395 as aplicacion,
    					  G759_C17397 as buscarPor,
    					  G759_C17398 as condicion,
    					  G759_C17399 as valorCondicion,
    					  G759_C17400 as agrupadoPor1,
    					  G759_C17401 as agrupadoPor2,
    					  G759_C17402 as fechaInicial,
    					  G759_C17403 as fechaFinal,
    					  G759_C17404 as diasMaximos,
    					  G759_C17405 as operacion,
    					  G759_C17406 as dividendo,
    					  G759_C17407 as divisor,
    					  G759_ConsInte__b as m');
    	$this->db->from('G759');
    	$this->db->where('G759_ConsInte__b', $G759_ConsInte__b);
    	$query = $this->db->get();
    	return $query->result();
    }

    public function findTipoCampoGuionAsociado($campo) {

        $this->db->select('PREGUN_Tipo______b as tpo');
    	$this->db->from('PREGUN');
    	$this->db->where('PREGUN_ConsInte__GUION__b', '719');
    	$this->db->where('PREGUN_ConsInte__b', $campo);
    	$query = $this->db->get();
    	return $query->row()->tpo;
    }

    public function findTipoCampoGuionAsociado2($campo) {

        $this->db->select('PREGUN_ConsInte__GUION__PRE_B as tpo');
    	$this->db->from('PREGUN');
    	$this->db->where('PREGUN_ConsInte__GUION__b', '719');
    	$this->db->where('PREGUN_ConsInte__b', $campo);
    	$query = $this->db->get();
    	return $query->row()->tpo;
    }

    public function findCampoAsociado($campo) {

        $this->db->distinct('CAMPO__ConsInte__PREGUN_b ');
    	$this->db->from('PREGUN');
    	$this->db->join('CAMPO_','PREGUN.PREGUN_ConsInte__b = CAMPO_.CAMPO__ConsInte__PREGUN_b');
    	$this->db->where('CAMPO__ConsInte__b = (select PREGUI_ConsInte__CAMPO__b from PREGUI where PREGUI_ConsInte__PREGUN_b = '.$campo .')');
    	$query = $this->db->get();
    	return $query->row()->CAMPO__ConsInte__PREGUN_b;
    }

    function ejecutarConsulta($select, $from, $join = null, $queryJoin = null, $where = null, $group = null){
    	$this->db->select($select);
    	$this->db->from($from);

    	if($join != null){
    		$this->db->join($join, $queryJoin);
    	}

    	if($where != null){
    		$this->db->where($where);
    	}

    	if($group != null){
    		$this->db->group_by($group);
    	}

    	$query = $this->db->get();
    	return $query->result();
    }

    function getFrgById($id){
    	$this->db->select('DISTINCT G729_C17121 ');
    	$this->db->from('G719');
    	$this->db->join('G729', 'G719_C17029 = G729_ConsInte__b');
    	$this->db->where('G719_C17029', $id);
    	
    	return $this->db->get()->row()->G729_C17121;
    }

    function getReportesDataBase(){
        $this->db->select('rep_nombre, rep_id, rep_orden');
        $this->db->from('Reportes');
        $this->db->where('rep_estado', 'ACTIVO');
        $query = $this->db->get();
        return $query->result();
    }

    function getReportesAsignacion_abogados($frg = NULL, $abogado = NULL, $fechaInicial, $fechaFinal){
        //Nombre deudor, No de identificación,  valor pagado

        $this->db->select('G719_C17051, G719_C17048, G719_C17050, G719_C17029 AS FRG, G719_C17153 AS abogado');
        $this->db->from('G719');
        $this->db->where("G719_FechaInsercion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        if($abogado != 0  && $abogado != NULL ){
            $this->db->where("G719_C17153", $abogado); 
        }

        $query = $this->db->get();
        return $query->result();
    }

     function getReportesAsignacion_abogados_deglosado($frg = NULL, $abogado = NULL, $fechaInicial, $fechaFinal){
        //Nombre deudor, No de identificación,  valor pagado

        $this->db->select('G719_C17026 AS contrato, G730_C17126 AS intermediario, G717_C17240 as nombre, G717_C17005 as identificacion,  G719_C17034 as Vlorpagado, G719_C17051, G719_C17048, G719_C17050 ');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030', 'left');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b', 'left');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181', 'left');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_FechaInsercion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        if($abogado != 0  && $abogado != NULL ){
            $this->db->where("G719_C17153", $abogado); 
        }

        $query = $this->db->get();
        return $query->result();
    }

    //function para obtener los reportes extrajudicales mensuales
    function getGestion_extrajudicial_mansual($frg= NULL, $fechaInicial ){
        $finales = array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');

        $fechaInicial = explode('-', $fechaInicial);
        $mes = $fechaInicial[0];
        $fechaInicial = $fechaInicial[1].'-'.$fechaInicial[0];
        $fechaInicial2 = $fechaInicial.'-01';
        

        $fechaFinal = $fechaInicial.'-'.$finales[$mes - 1];

        $this->db->select('G719_ConsInte__b, G719_C17032 as Fecha_pago, G719_C17035 as saldo, G719_C17295 as fecha_ultimoAbono');
        $this->db->from('G719');
        $this->db->where("G719_C17032 BETWEEN '".$fechaInicial2."' AND '".$fechaFinal."' ");
       
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getGestion_extrajudicial_mansual_total($frg= NULL, $fechaInicial ){
        $finales = array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');

        $fechaInicial = explode('-', $fechaInicial);
        $mes = $fechaInicial[0];
        $fechaInicial = $fechaInicial[1].'-'.$fechaInicial[0];
        $fechaInicial2 = $fechaInicial.'-01';
        

        $fechaFinal = $fechaInicial.'-'.$finales[$mes - 1];

        $this->db->select('G719_ConsInte__b, G719_C17032 as Fecha_pago, G719_C17035 as saldo, G719_C17295 as fecha_ultimoAbono');
        $this->db->from('G719');
        $this->db->where("G719_C17032 BETWEEN '".$fechaInicial2."' AND '".$fechaFinal."' ");
       
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }


    function getGestion_extrajudicial_mansual_deglosado($frg= NULL, $fechaInicial ){

        $finales = array('31', '28', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31');

        $fechaInicial = explode('-', $fechaInicial);
        $mes = $fechaInicial[0];
        $fechaInicial = $fechaInicial[1].'-'.$fechaInicial[0];
        $fechaInicial2 = $fechaInicial.'-01';
        

        $fechaFinal = $fechaInicial.'-'.$finales[$mes - 1];

       


        $this->db->select('G719_C17026 AS contrato, G730_C17126 AS intermediario, G717_C17240 as nombre, G717_C17005 as identificacion,  G719_C17034 as Vlorpagado, G719_C17051, G719_C17048, G719_C17050 ');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030', 'left');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b', 'left');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181', 'left');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_C17032 BETWEEN '".$fechaInicial2."' AND '".$fechaFinal."' ");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        

        $query = $this->db->get();
        return $query->result();
    }

    //validar si un contrato tiene gestion Extrajudicial
    function tieneGestionExtrajudicial($id_obligacion, $fechaInicial, $fechaFinal){
        $this->db->select('G742_ConsInte__b');
        $this->db->from('G742');
        $this->db->where('G742_C17244', $id_obligacion); 
        $this->db->where("G742_C17242 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");   
        $query = $this->db->get();
        return $query->num_rows();      
                           
    }

    //function para encontrar los subrogaciones efectivas

    function getSUbrogaciones_Efectivas($frg = NULL, $fechaInicial, $fechaFinal){
        $this->db->select('G719_C17039 as sap, G719_C17035 as SaldoFNG, G719_C17212 as fecha_envio');
        $this->db->from('G719');
        $this->db->where("G719_FechaInsercion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17035 > 0 ");
        $this->db->where("G719_C17212 IS NOT NULL");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getReportessubrogacionesEfectivas_deglosado($frg = NULL, $fechaInicial, $fechaFinal){
        //Nombre deudor, No de identificación,  valor pagado

        $this->db->select('G719_C17026 AS contrato, G730_C17126 AS intermediario, G717_C17240 as nombre, G717_C17005 as identificacion,  G719_C17034 as Vlorpagado, G719_C17051, G719_C17048, G719_C17050 ');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030', 'left');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b', 'left');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181', 'left');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_FechaInsercion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17035 > 0 ");
        $this->db->where("G719_C17212 IS NOT NULL");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }


}
?>