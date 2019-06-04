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
        $this->db->select('rep_nombre, rep_id, rep_orden, rep_param');
        $this->db->from('Reportes');
        $this->db->where('rep_estado', 'ACTIVO');
        $query = $this->db->get();
        return $query->result();
    }

    function getReportesAsignacion_abogados($frg = NULL, $abogado = NULL, $fechaInicial, $fechaFinal){
        //Nombre deudor, No de identificación,  valor pagado

        $this->db->select('G719_C17051, G719_C17048,  G719_C17423, G719_C17050, G719_C17029 AS FRG, G719_C17153 AS abogado');
        $this->db->from('G719');
        //G719_C17051
        $this->db->where("G719_C17048 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17039 != ''");

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

        $this->db->select('G719_C17423 AS contrato, G730_C17126 AS intermediario, G717_C17240 as nombre, G717_C17005 as identificacion,  G719_C17034 as Vlorpagado, G719_C17051, G719_C17048, G719_C17050 ');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030', 'left');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b', 'left');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181', 'left');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17039 != ''");
        $this->db->where("G719_C17048 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
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
    function getGestion_extrajudicial_mansual_Saldo_0($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia, $fechaInicialAbono, $fechaFinalAbono ){
        
        $this->db->select(' G719_ConsInte__b, 
                            G719_C17032 as Fecha_pago, 
                            G719_C17035 as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('G719');
        $this->db->where("G719_C17032 < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("G719_C17035 = 0");
        $this->db->where("G719_C17295 BETWEEN '".$fechaInicialAbono."' AND '".$fechaFinalAbono."' ");
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getGestion_extrajudicial_mansual_Saldo_1($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia ){
        
        $this->db->select('G719_ConsInte__b, 
                            G719_C17032 as Fecha_pago, 
                            G719_C17035 as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('G719');
        $this->db->where("G719_C17032 < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("G719_C17035 > 0");
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getGestion_extrajudicial_mansual_Saldo_0_Total($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia, $fechaInicialAbono, $fechaFinalAbono ){
        
        $this->db->select('G719_ConsInte__b, 
                            G719_C17032 as Fecha_pago, 
                            G719_C17035 as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('G719');
        $this->db->where("G719_C17032 < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("G719_C17035 = 0");
        $this->db->where("G719_C17295 BETWEEN '".$fechaInicialAbono."' AND '".$fechaFinalAbono."' ");
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getGestion_extrajudicial_mansual_Saldo_1_Total($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia ){
        
        $this->db->select('G719_ConsInte__b, 
                            G719_C17032 as Fecha_pago, 
                            G719_C17035 as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('G719');
 	    $this->db->where("G719_C17032 < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("G719_C17035 > 0");
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }


    function getGestion_extrajudicial_mansual_deglosado_0($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia, $fechaInicialAbono, $fechaFinalAbono ){

        $this->db->select('G719_ConsInte__b, G719_C17423 AS contrato, G730_C17126 AS intermediario, G717_C17240 as nombre, G717_C17005 as identificacion,  G719_C17034 as Vlorpagado, G719_C17051, G719_C17048, G719_C17050 ');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_C17032 < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("G719_C17035 = 0");
        $this->db->where("G719_C17295 BETWEEN '".$fechaInicialAbono."' AND '".$fechaFinalAbono."' ");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        

        $query = $this->db->get();
        return $query->result();
    }

    function getGestion_extrajudicial_mansual_deglosado_1($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia ){

        $this->db->select(' G719_ConsInte__b, G719_C17423 AS contrato, 
                            G730_C17126 AS intermediario, 
                            G717_C17240 as nombre, 
                            G717_C17005 as identificacion, 
                            G719_C17034 as Vlorpagado,
                            G719_C17051, G719_C17048, G719_C17050 ');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_C17032 < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("G719_C17035 > 0");
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
        
        $this->db->select('G719.G719_C17423  as Sub_contrato, Sub_sap, Sub_Frg, Sub_factura_subrogacion, Sub_fecha_factura, Sub_fecha_auto, Sub_id_obligacion');
        $this->db->from('Tabla_base_medicion_subrogaciones');
        $this->db->join('G719','Sub_id_obligacion = G719_ConsInte__b');
        $this->db->where("Sub_fecha_factura BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        $this->db->where("Sub_sap IS NOT NULL");
        $this->db->where("Sub_sap != '' ");
        $this->db->where("Sub_fecha_factura IS NOT NULL");
        $this->db->where("Sub_fecha_factura != ''");
        $year = date('Y');
        $this->db->where("Sub_fecha_year", $year);
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("Sub_Frg", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getReportessubrogacionesEfectivas_deglosado($frg = NULL, $fechaInicial, $fechaFinal){
        //Nombre deudor, No de identificación,  valor pagado

        $this->db->select('G719.G719_C17423 AS contrato, G730_C17126 AS intermediario, G717_C17240 as nombre, G717_C17005 as identificacion,  G719_C17034 as Vlorpagado, G719_C17051, G719_C17048, G719_C17050, Sub_factura_subrogacion, Sub_fecha_factura, Sub_fecha_auto ');
        $this->db->from('Tabla_base_medicion_subrogaciones');
        $this->db->join('G719','Sub_id_obligacion = G719_ConsInte__b');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        
        $this->db->where('G737_C17183','1786');
        $this->db->where("Sub_fecha_factura BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        $this->db->where("Sub_sap IS NOT NULL");
        $this->db->where("Sub_sap != '' ");
        $this->db->where("Sub_fecha_factura IS NOT NULL");
        $this->db->where("Sub_fecha_factura != '' ");
        $year = date('Y');
        $this->db->where("Sub_fecha_year", $year);
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("Sub_Frg", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getBaseGEstionesJudiciales($frg = NULL){
        $this->db->select('G719_ConsInte__b');
        $this->db->from('G719');
        
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17039 != '' ");
        $this->db->where("G719_C17051 IS NOT NULL");
        $this->db->where("G719_C17051 != '' ");

        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getBaseGEstionesJudiciales_deglosado($frg = NULL){
       $this->db->select('  G719_ConsInte__b,
                            G719_C17423 AS contrato, 
                            G719_C17039 as SAP,
                            G730_C17126 AS intermediario, 
                            G717_C17240 as nombre, 
                            G717_C17005 as identificacion,  
                            G719_C17034 as Vlorpagado, 
                            G719_C17051 as fecha_abogado, 
                            G719_C17048, 
                            G719_C17050');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030', 'left');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b', 'left');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181', 'left');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17039 != '' ");
        $this->db->where("G719_C17051 IS NOT NULL");
        $this->db->where("G719_C17051 != '' ");

        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

//validar si un contrato tiene gestion Judicial
    function tieneGestionJudicial($id_obligacion, $fechaInicial, $fechaFinal){
        $this->db->select('G735_ConsInte__b');
        $this->db->from('G735');
        $this->db->where('G735_C17138', $id_obligacion); 
        $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");   
        $query = $this->db->get();
        return $query->num_rows();      
                           
    }

    function getReporteCisa($frg = NULL, $fechaVenta){
        $this->db->select('G719_ConsInte__b');
        $this->db->from('G719');
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17039 != '' ");
        $this->db->where("G719_C17073", $fechaVenta);

        
        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }

        $query = $this->db->get();
        return $query->result();
        
    }



    function getReporteCisa_deglosadoS($frg = NULL, $fechaVenta){
        $this->db->select(' G719_C17423 AS contrato, 
                            G719_C17039 as SAP,
                            G730_C17126 AS intermediario, 
                            G717_C17240 as nombre, 
                            G717_C17005 as identificacion,  
                            G719_C17034 as Vlorpagado, 
                            G719_C17051 as fecha_abogado,
                            Fecha_aprovacion_soporte,
                            Fecha_recepcion_soporte,
                            G719_ConsInte__b
                            ');
        $this->db->from('G719');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030');
        $this->db->join('G737', 'G737_C17182 = G719_ConsInte__b');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->join('G744','G744_C17280 = G719_ConsInte__b', 'LEFT');
        $this->db->where('G737_C17183','1786');
        $this->db->where("G719_C17039 IS NOT NULL");
        $this->db->where("G719_C17039 != '' ");
        $this->db->where("G719_C17073", $fechaVenta);

        if($frg != 0 && $frg != NULL){
            $this->db->where("G719_C17029", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function tieneFechaPagoReporte($obligacion, $fechaInicial, $fechaFinal){
        $this->db->select('');
        $this->db->from('G744');
        $this->db->where('G744_C17280', $obligacion); 
        $this->db->where("Fecha_aprovacion_soporte BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");   
        $query = $this->db->get();
        return $query->num_rows();      
    }

    function getBaseMemorialesSUbrogacion_1($frg, $abogado, $fechaInicial, $fechaFinal){
        $this->db->select('DISTINCT id,Fecha_envio_Memorial, Fecha_envio_Memorial_Corregido, FRG , abogado, contrato, SAP');
        $this->db->from('Vista_base_memoriales_subrogacion');
        $this->db->where("Fecha_envio_Memorial BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");

        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('abogado', $abogado);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function getBaseMemorialesSUbrogacion_deglosado_1($frg, $abogado, $fechaInicial, $fechaFinal){
        $this->db->select('DISTINCT id,Fecha_envio_Memorial, Fecha_envio_Memorial_Corregido, FRG , abogado, contrato, SAP, 
                            G717_C17240 as nombre, 
                            G717_C17005 as identificacion,
                            G730_C17126 AS intermediario, radicacion');
        $this->db->from('Vista_base_memoriales_subrogacion');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030');
        $this->db->join('G737', 'G737_C17182 = id');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->where('G737_C17183','1786');
        $this->db->where("Fecha_envio_Memorial BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");

        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('abogado', $abogado);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function getBaseMemorialesSUbrogacion_2($frg, $abogado, $fechaInicial, $fechaFinal){
        $this->db->select('DISTINCT id,Fecha_envio_Memorial, Fecha_envio_Memorial_Corregido, FRG , abogado, contrato, SAP');
        $this->db->from('Vista_envio_Memorial_corregido');
        $this->db->where("Fecha_envio_Memorial_Corregido BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");

        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('abogado', $abogado);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function getBaseMemorialesSUbrogacion_deglosado_2($frg, $abogado, $fechaInicial, $fechaFinal){
        $this->db->select('DISTINCT id,Fecha_envio_Memorial, Fecha_envio_Memorial_Corregido, FRG , abogado, contrato, SAP, 
                            G717_C17240 as nombre, 
                            G717_C17005 as identificacion,
                            G730_C17126 AS intermediario, radicacion ');
        $this->db->from('Vista_envio_Memorial_corregido');
        $this->db->join('G730', 'G730_ConsInte__b = G719_C17030');
        $this->db->join('G737', 'G737_C17182 = id');
        $this->db->join('G717','G717_ConsInte__b = G737_C17181');
        $this->db->where("Fecha_envio_Memorial_Corregido BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where('G737_C17183','1786');
        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('abogado', $abogado);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function tieneRadicado($id_obligacion, $fechaInicial, $fechaFinal){
        $this->db->select('G719_C17212');
        $this->db->from('G719');
        $this->db->where("G719_C17212 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
        $this->db->where("G719_C17212 IS NOT NULL");
        $this->db->where("G719_C17212 != '' ");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return 1;
        }else{
            return 0;
        }
    }

    function tieneRadicadoFueraTiempo($id_obligacion, $fechaInicial){
     
        $this->db->select('G719_C17212');
        $this->db->from('G719');
        $this->db->where("G719_C17212 > '".$fechaInicial."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
        $this->db->where("G719_C17212 IS NOT NULL");
        $this->db->where("G719_C17212 != '' ");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return 1;
        }else{
            return 0;
        }
    }

    function NotieneRadicadoFueraTiempo($id_obligacion, $fechaInicial){
        $fechaFinal = date('Y-m-d');
        $this->db->select('G719_C17212');
        $this->db->from('G719');
        $this->db->where("G719_C17048 > '".$fechaInicial."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
       // $this->db->where("G719_C17212 IS NULL");
        //$this->db->where("G719_C17212 = '' ");
        $query = $this->db->get();
        return $query->result();
/* if($query->num_rows() > 0){
            return 1;
        }else{
            return 0;
        }*/
    }

    function NotieneRadicadoFueraTiempo_2($id_obligacion, $fechaInicial){
     
       $fechaFinal = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('G719');
        $this->db->where("G719_C17050 > '".$fechaInicial."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
        $this->db->where("G719_C17212 IS NULL");
        $query = $this->db->get();

        return $query->result();
    }


    function NotieneRadicadoFueraTiempo_CON($id_obligacion, $fechaInicial){
        $fechaFinal = date('Y-m-d');
        $this->db->select('G719_C17212');
        $this->db->from('G719');
        $this->db->where("G719_C17212 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
        //$this->db->where("G719_C17212 IS NULL");
        //$this->db->where("G719_C17212 = '' ");
        $query = $this->db->get();

        return $query->row()->G719_C17212;
    }

    function NotieneRadicadoFueraTiempo_CON_($id_obligacion, $fechaInicial){
     
       $fechaFinal = date('Y-m-d');
        $this->db->select('G719_C17212');
        $this->db->from('G719');
        $this->db->where("G719_C17212 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
       
        $query = $this->db->get();
       
        return $query->row()->G719_C17212;
       
    }


}
?>