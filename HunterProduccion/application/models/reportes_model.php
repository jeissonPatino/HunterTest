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

    function getParametrosReportes($reporte){
        $this->db->select('par_meta, par_tiempo_asignacion, cant_obligaciones');
        $this->db->from('Parametros_reportes');
        $this->db->join('Reportes', 'par_rep_id = rep_id');
        $this->db->where('rep_orden', $reporte);
        return $this->db->get();
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
    	$this->db->select('DISTINCT FRG ');
    	$this->db->from('InformacionCredito');
    	$this->db->join('FRG', 'FRG = Id');
    	$this->db->where('FRG', $id);
    	
    	return $this->db->get()->row()->FRG;
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

        $this->db->select('G719_C17051, FechaEnvioMemorialSubrogacionFRG, G719_C17423, G719_C17050, FRG AS FRG, Abogado AS abogado');
        $this->db->from('InformacionCredito');
        //G719_C17051
        $this->db->where("FechaEnvioMemorialSubrogacionFRG BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        $this->db->where("NroProcesoJudicialSAP IS NOT NULL");
        $this->db->where("NroProcesoJudicialSAP != ''");

        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        if($abogado != 0  && $abogado != NULL ){
            $this->db->where("Abogado", $abogado); 
        }
        $this->db->order_by('G719_C17423', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

     function getReportesAsignacion_abogados_deglosado($frg = NULL, $abogado = NULL, $fechaInicial, $fechaFinal){
        //Nombre deudor, No de identificación,  valor pagado
        $this->db->select('G719_C17423 AS contrato, NombreIF AS intermediario, NombreDeudor as nombre, NroIdentificacion as identificacion, tipo_identificacion as tipo_identificacion, ValorPagado as Vlorpagado, G719_C17051, FechaEnvioMemorialSubrogacionFRG, G719_C17050 ');
        $this->db->from('InformacionCredito');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero', 'left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b', 'left');
        $this->db->join('InformacionCliente','Id = InformacionClientesId', 'left');
        $this->db->where('Rol','1786');
        $this->db->where("NroProcesoJudicialSAP IS NOT NULL");
        $this->db->where("NroProcesoJudicialSAP != ''");
        $this->db->where("FechaEnvioMemorialSubrogacionFRG BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        if($abogado != 0  && $abogado != NULL ){
            $this->db->where("Abogado", $abogado); 
        }
        $this->db->order_by('G719_C17423', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //function para obtener los reportes extrajudicales mensuales
    function getGestion_extrajudicial_mensual_Saldo_0($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia, $fechaInicialAbono, $fechaFinalAbono ){
        
        $this->db->select(' G719_ConsInte__b, 
                            FechaPagoGarantia as Fecha_pago, 
                            SaldoFNG as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('InformacionCredito');
        $this->db->where("FechaPagoGarantia < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("SaldoFNG = 0");
        $this->db->where("G719_C17295 BETWEEN '".$fechaInicialAbono."' AND '".$fechaFinalAbono."' ");
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getGestion_extrajudicial_mensual_Saldo_1($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia ){
        
        $this->db->select('G719_ConsInte__b, 
                            FechaPagoGarantia as Fecha_pago, 
                            SaldoFNG as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('InformacionCredito');
        $this->db->where("FechaPagoGarantia < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("SaldoFNG > 0");
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getGestion_extrajudicial_mensual_Saldo_0_Total($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia, $fechaInicialAbono, $fechaFinalAbono ){
        
        $this->db->select('G719_ConsInte__b, 
                            FechaPagoGarantia as Fecha_pago, 
                            SaldoFNG as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('InformacionCredito');
        $this->db->where("FechaPagoGarantia < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("SaldoFNG = 0");
        $this->db->where("G719_C17295 BETWEEN '".$fechaInicialAbono."' AND '".$fechaFinalAbono."' ");
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getGestion_extrajudicial_mensual_Saldo_1_Total($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia ){
        
        $this->db->select('G719_ConsInte__b, 
                            FechaPagoGarantia as Fecha_pago, 
                            SaldoFNG as saldo, 
                            G719_C17295 as fecha_ultimoAbono,
                            G719_C17423');
        $this->db->from('InformacionCredito');
 	    $this->db->where("FechaPagoGarantia < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("SaldoFNG > 0");
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }


    function getGestion_extrajudicial_mensual_deglosado_0($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia, $fechaInicialAbono, $fechaFinalAbono ){


        $this->db->select('G719_ConsInte__b, G719_C17423 AS contrato, NombreIF AS intermediario, NombreDeudor as nombre, NroIdentificacion as identificacion, tipo_identificacion as tipo_identificacion,  ValorPagado as Vlorpagado, G719_C17051, FechaEnvioMemorialSubrogacionFRG, G719_C17050 ');
        $this->db->from('InformacionCredito');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->where('Rol','1786');
        $this->db->where("FechaPagoGarantia < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("SaldoFNG = 0");
        $this->db->where("NroIdentificacion NOT LIKE '99999999'");
        $this->db->where("NombreDeudor NOT LIKE '%BORRADO%'");
        $this->db->where("G719_C17295 BETWEEN '".$fechaInicialAbono."' AND '".$fechaFinalAbono."' ");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        
        $this->db->order_by('G719_C17423');
        $query = $this->db->get();
        return $query->result();
    }

    function getGestion_extrajudicial_mensual_deglosado_1($frg= NULL, $fechaInicialPagoGarantia, $fechaFinalPagoGarantia ){

        $this->db->select(' G719_ConsInte__b, G719_C17423 AS contrato, 
                            NombreIF AS intermediario, 
                            NombreDeudor as nombre, 
                            NroIdentificacion as identificacion, 
                            tipo_identificacion as tipo_identificacion,
                            ValorPagado as Vlorpagado,
                            G719_C17051, FechaEnvioMemorialSubrogacionFRG, G719_C17050 ');
        $this->db->from('InformacionCredito');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->where('Rol','1786');
        $this->db->where("FechaPagoGarantia < '".$fechaFinalPagoGarantia."' ");
        $this->db->where("SaldoFNG > 0");
        $this->db->where("NroIdentificacion NOT LIKE '99999999'");
        $this->db->where("NombreDeudor NOT LIKE '%BORRADO%'");
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        $this->db->order_by('G719_C17423');

        $query = $this->db->get();
        return $query->result();
    }

    //validar si un contrato tiene gestion Extrajudicial
    function tieneGestionExtrajudicial($id_obligacion, $fechaInicial, $fechaFinal){
        $this->db->select('Id');
        $this->db->from('GestionExtrajudicial');
        $this->db->where('G735_C17139', $id_obligacion); 
        $this->db->where("FechaEjecucion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");   
        $query = $this->db->get();
        return $query->num_rows();      
                           
    }

     function getBaseSubrogacionesEfectivas($frg = NULL){
        $this->db->select('COUNT(*) as cantidad');
        $this->db->from('Tabla_base_medicion_subrogaciones');
        $this->db->join('InformacionCredito','Sub_id_obligacion = G719_ConsInte__b');
        if(!is_null($frg)) $this->db->where('Sub_Frg', $frg);
        $year = date('Y');
        $this->db->where("Sub_fecha_year", $year);
        $query = $this->db->get();
        return $query;
                           
    }


    //function para encontrar los subrogaciones efectivas

    function getSubrogacionesEfectivas($frg = NULL, $fechaInicial, $fechaFinal){
        
        $this->db->select('InformacionCredito.G719_C17423  as Sub_contrato, Sub_sap, Sub_Frg, Sub_factura_subrogacion, Sub_fecha_factura, Sub_fecha_auto, Sub_id_obligacion');
        $this->db->from('Tabla_base_medicion_subrogaciones');
        $this->db->join('InformacionCredito','Sub_id_obligacion = G719_ConsInte__b');
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

    function getReporteSubrogacionesEfectivasDeglosado($frg = NULL, $fechaInicial, $fechaFinal){
        //Nombre deudor, No de identificación,  valor pagado

        $this->db->select('InformacionCredito.G719_C17423 AS contrato, NombreIF AS intermediario, NombreDeudor as nombre, NroIdentificacion as identificacion, tipo_identificacion as tipo_identificacion, ValorPagado as Vlorpagado, G719_C17051, FechaEnvioMemorialSubrogacionFRG, G719_C17050, Sub_factura_subrogacion, Sub_fecha_factura, Sub_fecha_auto ');
        $this->db->from('Tabla_base_medicion_subrogaciones');
        $this->db->join('InformacionCredito','Sub_id_obligacion = G719_ConsInte__b');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero', 'left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b','left');
        $this->db->join('InformacionCliente','Id = InformacionClientesId','left');
        
        $this->db->where('Rol','1786');
        $this->db->where('NroIdentificacion != ','99999999');
        $this->db->where("Sub_fecha_factura BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        $year = date('Y');
        $this->db->where("Sub_fecha_year", $year);
        //OR G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' 
        if($frg != 0 && $frg != NULL){
            $this->db->where("Sub_Frg", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getReporteSubrogacionesEfectivasGeneral($frg = NULL){
        //Nombre deudor, No de identificación,  valor pagado

        $this->db->select('InformacionCredito.G719_C17423 AS contrato, NombreIF AS intermediario, NombreDeudor as nombre, NroIdentificacion as identificacion, tipo_identificacion as tipo_identificacion, ValorPagado as Vlorpagado, G719_C17051, FechaEnvioMemorialSubrogacionFRG, G719_C17050, Sub_factura_subrogacion, Sub_fecha_factura, Sub_fecha_auto ');
        $this->db->from('Tabla_base_medicion_subrogaciones');
        $this->db->join('InformacionCredito','Sub_id_obligacion = G719_ConsInte__b');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero', 'left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b','left');
        $this->db->join('InformacionCliente','Id = InformacionClientesId','left');
        $this->db->where('Rol','1786');
        $this->db->where('NroIdentificacion != ','99999999');
        $year = date('Y');
        $this->db->where("Sub_fecha_year", $year);
        if($frg != 0 && $frg != NULL){
            $this->db->where("Sub_Frg", $frg);
        }

        $query = $this->db->get();
        return $query->result();
    }
    function getBaseGEstionesJudiciales($frg = NULL){
        $this->db->select('G719_ConsInte__b');
        $this->db->from('InformacionCredito');
        
        $this->db->where("NroProcesoJudicialSAP IS NOT NULL");
        $this->db->where("NroProcesoJudicialSAP != '' ");
        $this->db->where("G719_C17051 IS NOT NULL");
        $this->db->where("G719_C17051 != '' ");

        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getBaseGEstionesJudiciales_deglosado($frg = NULL, $fechaInforme){

           $this->db->select('G719_ConsInte__b,
                            G719_C17423 AS contrato, 
                            NroProcesoJudicialSAP as SAP,
                            NombreIF AS intermediario, 
                            NombreDeudor as nombre, 
                            NroIdentificacion as identificacion,  
                            tipo_identificacion as tipo_identificacion,
                            G719_C17051 as fecha_abogado, 
                            FechaEnvioMemorialSubrogacionFRG , 
                            G719_C17050 as fecha_envio_corregido,
                            FechaDevolucionFRGMemorialSubrogacionxErrores as fecha_envio_errores,
                            SaldoFNG as SaldoalaFecha,
                            ValorPagado as Vlorpagado,
                            FechaPagoGarantia as fechaSaldo,
                            G719_C17073 as Fecha_Venta,
                            G719_C17295 as fecha_ultimo_abono,
                            FRG');
        $this->db->from('InformacionCredito');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero', 'left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b', 'left');
        $this->db->join('InformacionCliente','Id = InformacionClientesId', 'left');
        $this->db->join('FRG', 'Id = FRG');
        $this->db->where('Rol','1786');
        $this->db->where('G719_C17423 IS NOT NULL');
        $this->db->where("NroProcesoJudicialSAP IS NOT NULL");
        $this->db->where("NroProcesoJudicialSAP != '' ");
        $this->db->where("NroIdentificacion != '99999999' ");
        $this->db->where("(case when FechaEnvioMemorialSubrogacionFRG is not null then 1
                                 else (case when G719_C17050 is not null then 1 else 0 end ) end) = 1");
        $this->db->where("(case when FechaDevolucionFRGMemorialSubrogacionxErrores is null then 1
                                 else (case when G719_C17050 is not null then 1 else 0 end ) end) = 1");
        $this->db->where("((SELECT (FechaEnvioMemorialSubrogacionFRG +95)) <= '".$fechaInforme."' or (SELECT (G719_C17050 +95))<= '".$fechaInforme."')");
        $this->db->where("(case when SaldoFNG > 0 then 1 else 
                            (case when (SELECT (G719_C17295+91)) <  '".$fechaInforme."' then 1 else 0 end )
                             end) = 1");
        $this->db->where("(case when G719_C17073 is null then 1
                                 else (case when (SELECT ( G719_C17073+181)) >='".$fechaInforme."' then 1 else 0 end ) end) = 1");

        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        } 
        $this->db->order_by('G719_C17423');
      
        
        $query = $this->db->get();
        return $query->result();

    } 

   

//validar si un contrato tiene gestion Judicial
    function tieneGestionJudicial($noLiquidacion, $fechaInicial, $fechaFinal){
        $this->db->select('Id');
        $this->db->from('G735');
        $this->db->join('InformacionCredito','G735_C17138 = G719_ConsInte__b');
        $this->db->where('G719_C17423', $noLiquidacion); 
        $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");   
        $query = $this->db->get();
        return $query->num_rows();      
                           
    }
	////Manuel Ochoa - Softtek - 19/11/2015 - REQ02
    function getGestionJudicialDatos($noLiquidacion, $fechaInicial, $fechaFinal){
        $this->db->select('TOP 1 Actuacion as Actuacion,
								G735_C17139 as FechaTramite,
								G735_C17140 as Ejecutor,
								G735_C17141 as FechaInforme,
								G735_C17142 as ETAPA,
								G735_C17143 as TipoProceso,
								G735_C17219 as Observaciones');
        $this->db->from('G735');
        $this->db->join('InformacionCredito','G735_C17138 = G719_ConsInte__b');
        $this->db->where('G719_C17423', $noLiquidacion); 
        $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' "); 
		$this->db->order_by("G735_C17141", "DESC");
        $query = $this->db->get();
        return $query->row();   
                           
    }	

    function getReporteCisa($frg = NULL, $fechaVenta){
        $this->db->select('G719_ConsInte__b, G719_C17423 AS liquidacion');
        $this->db->from('InformacionCredito');
        $this->db->where("NroProcesoJudicialSAP IS NOT NULL");
        $this->db->where("NroProcesoJudicialSAP != '' ");
        $this->db->where("G719_C17073", $fechaVenta);

        
        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        $this->db->order_by("G719_C17423","DESC");
        $query = $this->db->get();
        return $query->result();
        
    }



    function getReporteCisa_deglosadoS($frg = NULL, $fechaVenta){
        $this->db->select('distinct G719_C17423 AS contrato, 
                            NroProcesoJudicialSAP as SAP,
                            NombreIF AS intermediario, 
                            NombreDeudor as nombre, 
                            NroIdentificacion as identificacion,  
                            tipo_identificacion as tipo_identificacion,
                            ValorPagado as Vlorpagado, 
                            G719_C17051 as fecha_abogado,
                            FechaAprobacionSoporte,
                            Fecha_recepcion_soporte,
                            G719_C17073 fechaVenta,
                            G719_ConsInte__b
                            ');
        $this->db->from('InformacionCredito');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->join('Factura','G735_C17139Id = G719_ConsInte__b', 'LEFT');
        $this->db->where('Rol','1786');
        $this->db->where("NroProcesoJudicialSAP IS NOT NULL");
        $this->db->where("NroProcesoJudicialSAP != '' ");
        $this->db->where("G719_C17073", $fechaVenta);

        if($frg != 0 && $frg != NULL){
            $this->db->where("FRG", $frg);
        }
        $this->db->order_by("G719_C17423, FechaAprobacionSoporte","DESC");
        $query = $this->db->get();
        return $query->result();
    }

    function tieneFechaPagoReporte($obligacion, $fechaInicial, $fechaFinal){
        $this->db->select('');
        $this->db->from('Factura');
        $this->db->where('G735_C17139Id', $obligacion); 
        $this->db->where("FechaAprobacionSoporte BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        $query = $this->db->get();
        return $query->num_rows();      
    }

    function getBaseMemorialesSUbrogacion_1($frg, $abogado, $fechaInicial, $fechaFinal){
        $this->db->select('max (G719_ConsInte__b) AS id, FechaEnvioMemorialSubrogacionFRG as Fecha_envio_Memorial, G719_C17050 as Fecha_envio_Memorial_Corregido, FRG as FRG
            ,G719_C17423 AS contrato, NroProcesoJudicialSAP as SAP');
        $this->db->from('InformacionCredito');
        $this->db->join ('Abogados','Id = Abogado','LEFT');
        $this->db->where("FechaEnvioMemorialSubrogacionFRG BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where("G719_C17050 is null");
        $this->db->where("G719_C17423 is not null");
        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('Abogado', $abogado);
        }
        $query = $this->db->group_by('FechaEnvioMemorialSubrogacionFRG,G719_C17050,FRG,G719_C17423,NroProcesoJudicialSAP');
        $query = $this->db->get();

        return $query->result();
    }

    function getBaseMemorialesSUbrogacion_deglosado_1($frg, $abogado, $fechaInicial, $fechaFinal){
        $this->db->select('max(G719_ConsInte__b) AS id, FechaEnvioMemorialSubrogacionFRG as Fecha_envio_Memorial, G719_C17050 as Fecha_envio_Memorial_Corregido, FRG as FRG,
            Nombre as Abogado ,G719_C17423 AS liquidacion, NroProcesoJudicialSAP as SAP,Abogado,  NombreDeudor as nombre, NroIdentificacion as identificacion,
            tipo_identificacion as tipo_identificacion,
            NombreIF AS intermediario,G719_C17423 AS contrato,G719_C17212 as radicacion ');
        $this->db->from('InformacionCredito');
        $this->db->join('Abogados', 'Id = Abogado', 'left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b','left');
        $this->db->join('InformacionCliente','Id = InformacionClientesId','left');
        $this->db->join('IntermediarioFinanciero','Id = IntermediarioFinanciero','left');
        $this->db->where("FechaEnvioMemorialSubrogacionFRG BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where("G719_C17050 is null");
        $this->db->where("G719_C17423 is not null");

        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('Abogado', $abogado);
        }
        $query = $this->db->group_by('FechaEnvioMemorialSubrogacionFRG,G719_C17050,FRG,Nombre,G719_C17423,NroProcesoJudicialSAP,Abogado,NombreDeudor,NroIdentificacion,tipo_identificacion,NombreIF,G719_C17423,G719_C17212');
        $query = $this->db->order_by('contrato','desc');
        $query = $this->db->get();

        return $query->result();
    }

    function getBaseMemorialesSUbrogacion_2($frg, $abogado, $fechaInicial, $fechaFinal){
        $this->db->select('max (G719_ConsInte__b) AS id, FechaEnvioMemorialSubrogacionFRG as Fecha_envio_Memorial, G719_C17050 as Fecha_envio_Memorial_Corregido, FRG as FRG
            ,G719_C17423 AS contrato, NroProcesoJudicialSAP as SAP');
        $this->db->from('InformacionCredito');
        $this->db->join ('Abogados','Id = Abogado','LEFT');
        $this->db->where("G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where("G719_C17423 is not null");

        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('Abogado', $abogado);
        }
        $query = $this->db->group_by('FechaEnvioMemorialSubrogacionFRG,G719_C17050,FRG,G719_C17423,NroProcesoJudicialSAP');
        $query = $this->db->get();

        return $query->result();
    }

    function getBaseMemorialesSUbrogacion_deglosado_2($frg, $abogado, $fechaInicial, $fechaFinal){
         $this->db->select('max(G719_ConsInte__b) AS id, FechaEnvioMemorialSubrogacionFRG as Fecha_envio_Memorial, G719_C17050 as Fecha_envio_Memorial_Corregido, FRG as FRG,
            Nombre as Abogado ,G719_C17423 AS liquidacion, NroProcesoJudicialSAP as SAP,Abogado,  NombreDeudor as nombre, NroIdentificacion as identificacion, tipo_identificacion as tipo_identificacion,
            NombreIF AS intermediario,G719_C17423 AS contrato,G719_C17212 as radicacion ');
        $this->db->from('InformacionCredito');
        $this->db->join('Abogados', 'Id = Abogado', 'left');
        $this->db->join('ClienteObligacion', 'G735_C17139Id = G719_ConsInte__b');
        $this->db->join('InformacionCliente','Id = InformacionClientesId','left');
        $this->db->join('IntermediarioFinanciero','Id = IntermediarioFinanciero','left');
        $this->db->where("G719_C17050 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where("G719_C17423 is not null");

        if($frg != NULL && $frg != 0 && $frg != ''){
            $this->db->where('FRG', $frg);
        }

        if($abogado != NULL && $abogado != 0 && $abogado != ''){
            $this->db->where('Abogado', $abogado);
        }
        $query = $this->db->group_by('FechaEnvioMemorialSubrogacionFRG,G719_C17050,FRG,Nombre,G719_C17423,NroProcesoJudicialSAP,Abogado,NombreDeudor,NroIdentificacion,tipo_identificacion, NombreIF,G719_C17423,G719_C17212');
        $query = $this->db->order_by('contrato','desc');
        $query = $this->db->get();
        return $query->result();
    }

    function tieneRadicado($id_obligacion, $fechaInicial, $fechaFinal){
        $this->db->select('G719_C17212');
        $this->db->from('InformacionCredito');
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
        $this->db->from('InformacionCredito');
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
        $this->db->from('InformacionCredito');
        $this->db->where("FechaEnvioMemorialSubrogacionFRG > '".$fechaInicial."'");
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
        $this->db->from('InformacionCredito');
        $this->db->where("G719_C17050 > '".$fechaInicial."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
        $this->db->where("G719_C17212 IS NULL");
        $query = $this->db->get();

        return $query->result();
    }


    function NotieneRadicadoFueraTiempo_CON($id_obligacion, $fechaInicial){
        $fechaFinal = date('Y-m-d');
        $this->db->select('G719_C17212');
        $this->db->from('InformacionCredito');
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
        $this->db->from('InformacionCredito');
        $this->db->where("G719_C17212 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        $this->db->where('G719_ConsInte__b', $id_obligacion);
       
        $query = $this->db->get();
       
        return $query->row()->G719_C17212;
       
    }

    function datosCisaventas (){
        $this->db->select('Ven_nombre,Ven_fecha_venta,Ven_fecha_notificacion,Ven_fecha_Maxima, ven_id, Ven_meta');
        $this->db->from('Parametros_cisa');
        $this->db->where('Ven_estado' , 'ACTIVO');
        $query = $this->db->get();
        return $query->result();
    }
    

    // Creado por Jeisson Patiño 27/11/2018, funcion par atraer los datos del informe FRG Gestores
    function GetGestores(){
         $this->db->select('IdGestor,
                            Gestor');
         $this->db->where("Gestor is not null");

        
        $query = $this->db->group_by('Gestor, IdGestor');
        $query = $this->db->get('InformefrgGestores');
        return $query->result();
    }

	    function GetGestoresByFRG( $codigo ){
        $this->db->select('IdGestor, Gestor');
        $this->db->where('Gestor is not null');
        $this->db->where('IdFRG', $codigo);
        $this->db->order_by("Gestor", "asc");
        $query = $this->db->group_by('Gestor, IdGestor');
        $query = $this->db->get('InformefrgGestores');
        return $query->result();
    }
    function getCantidadGestionada($frg = NULL, $gestores = NULL, $fechaInicial, $fechaFinal){
         $this->db->select('Count(NumeroLiquidacion) as cantidad,
                            Gestor');
         $this->db->where("Gestor is not null");
         $this->db->where("FechaGestion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
         if($frg != 0 && $frg != NULL){
            $this->db->where("IdFRG", $frg);
        }
        if($gestores != 0  && $gestores != NULL ){
            $this->db->where("IdGestor", $gestores); 
        }
        $query = $this->db->group_by('Gestor');
        $query = $this->db->get('InformefrgGestores');
        return $query->result();
    }
    
    function getInformeFrgGestion($frg = NULL, $gestores = NULL, $fechaInicial, $fechaFinal){
        
 
        $this->db->select(' NumeroLiquidacion,
                            NombreDeudor,
                            TipoIdentificacion, 
                            NumeroId, 
                            Intermediariofinancero, 
                            FechaPagoGarantia, 
                            FechaGestion,
                            Gestor,
                            IdFRG,
                            IdGestor');
        
        $this->db->where("FechaGestion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");

        if($frg != 0 && $frg != NULL){
            $this->db->where("IdFRG", $frg);
        }
        if($gestores != 0  && $gestores != NULL ){
            $this->db->where("IdGestor", $gestores); 
        }
        $this->db->order_by('FechaGestion', 'DESC');
        $query = $this->db->get('InformefrgGestores');
        return $query->result();
    }



    // funciones para la generacion de logs Jeisson Patiño 
    function LlenarTablaLogeliminacionUsuarios ($usuario,$id,$usuarioE){
        $modulo = 'GestoresAbogados';
        $accion = 'Eliminacion';

        $this->db->query("Insert [LogeliminacionDatos] 
                        (NombreUsuario,Identificacion,Cargo,Fecha,usuarioeliminado,tipousaurio,numeroUsuarioEliminado,Modulo,Accion) 
                        Values ('".$usuario."',(select USUARI_Identific_b from USUARI where USUARI_ConsInte__b ='".$id."'),
                        (select USUARI_Cargo_____b from USUARI where USUARI_ConsInte__b ='".$id."'),
                        Getdate(),
                        (select USUARI_Nombre____b from USUARI where USUARI_ConsInte__b ='".$usuarioE."'),
                        (select USUARI_Cargo_____b from USUARI where USUARI_ConsInte__b ='".$usuarioE."'),
                        (select USUARI_Identific_b from USUARI where USUARI_ConsInte__b ='".$usuarioE."'),'".$modulo."','".$accion."')");
        
        
    }

    // Datos Liquidaciones Extrajudiciales
    function LlenarTablaLogeliminacionLiquidacionExtra ($usuario,$id,$NumLiquidacion){

        $modulo = 'Extrajudicial';
        $accion = 'Eliminacion';

        $this->db->query("Insert [LogeliminacionDatos] 
                        (NombreUsuario,Identificacion,Cargo,Fecha,Liquidacion,Modulo,Accion) 
                        Values ('".$usuario."',(select USUARI_Identific_b from USUARI where USUARI_ConsInte__b ='".$id."'),
                        (select USUARI_Cargo_____b from USUARI where USUARI_ConsInte__b ='".$id."'),
                        Getdate(),
                        '".$NumLiquidacion."','".$modulo."','".$accion."')");

    }

 


    // Datos liquidaciones Judiciales 
    function LlenarTablaLogeliminacionLiquidacionJudicial ($usuario,$id,$numLiquidacion){

        $modulo = 'Judicial';
        $accion = 'Eliminacion';

        $this->db->query("Insert [LogeliminacionDatos] 
                        (NombreUsuario,Identificacion,Cargo,Fecha,Liquidacion,Modulo,Accion) 
                        Values ('".$usuario."',(select USUARI_Identific_b from USUARI where USUARI_ConsInte__b ='".$id."'),
                        (select USUARI_Cargo_____b from USUARI where USUARI_ConsInte__b ='".$id."'),
                        Getdate(),
                        '".$numLiquidacion."','".$modulo."', '".$accion."')");

        
    }



    function LogeliminacionExtrajudicial($fechaInicial,$fechaFinal){
        $this->db->Select(" Loge.NombreUsuario As 'NombreUsuario',
                            Loge.Identificacion as 'Identificacion', 
                            Loge.Cargo as 'Cargo', 
                            Loge.Fecha as 'Fechaeliminacion',
                            Loge.Liquidacion as 'NumeroLiquidacioneliminado',
                            Loge.Modulo as 'Mudulo',
                            loge.Accion as 'Accion'");
        $this->db->from('LogeliminacionDatos as Loge');
        $this->db->where("Modulo = 'Extrajudicial' and Accion = 'Eliminacion' and Fecha BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' AND Liquidacion is not null");

        $this->db->order_by('Fecha', 'DESC');

        $query = $this->db->get();
        return $query->result();

    }

    function LogeliminacionJudicial($fechaInicial,$fechaFinal){
        $this->db->Select(" Loge.NombreUsuario As 'NombreUsuario',
                            Loge.Identificacion as 'Identificacion', 
                            Loge.Cargo as 'Cargo', 
                            Loge.Fecha as 'Fechaeliminacion',
                            Loge.Liquidacion as 'NumeroLiquidacioneliminado',
                            Loge.Modulo as 'Mudulo',
                            loge.Accion as 'Accion'");
        $this->db->from('LogeliminacionDatos as Loge');
        $this->db->where("Modulo = 'Judicial' and Accion = 'Eliminacion' AND Liquidacion is not null");
        $this->db->where("Fecha BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        $this->db->order_by('Fecha', 'DESC');

        $query = $this->db->get();
        return $query->result();

    }


    function LogeliminacionUsuarios($fechaInicial,$fechaFinal){
        $this->db->Select(" Loge.NombreUsuario As 'NombreUsuario',
                            Loge.Identificacion as 'Identificacion', 
                            Loge.Cargo as 'Cargo1', 
                            Loge.Fecha as 'Fechaeliminacion',
                            Loge.usuarioeliminado as 'UsuEliminado',
                            Loge.numeroUsuarioEliminado as 'NoId',
                            Loge.tipousaurio as 'Cargo'");
        $this->db->from('LogeliminacionDatos as Loge');
        $this->db->where("Modulo = 'GestoresAbogados' and Accion = 'Eliminacion' AND usuarioeliminado is not null ");
        $this->db->where("Fecha BETWEEN '".$fechaInicial."' AND '".$fechaFinal."' ");
        $this->db->order_by('Fecha', 'DESC');

        $query = $this->db->get();
        return $query->result();

    }

}
?>