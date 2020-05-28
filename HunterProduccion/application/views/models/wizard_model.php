<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wizard_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getdatosWizard($codigo){
        $this->db->select('G724_ConsInte__b, G724_C17105 ');
        $this->db->where('G724_C17103', $codigo); 
        $query = $this->db->get('G724');
        return $query->result();
    }

    function guardardatos($tabla, $datos){
        return $this->db->insert($tabla, $datos);
    }

    function editarDatos($tabla, $datos, $id, $dtabla){
        $this->db->where($dtabla, $id);
        return $this->db->update($tabla, $datos);
    }

    function borrarDatos($tabla, $id, $dtabla){
        $this->db->where($dtabla, $id);
        return $this->db->delete($tabla);
    }

    function getDeudores($contrato){
        $this->db->select(' Id as id,  NombreDeudor as deudor');
        $this->db->join('ClienteObligacion', 'NumeroContratoId = Id ');
        $this->db->join('ParametroGeneral', 'Id = Rol');
        $this->db->join('InformacionCliente', 'Id = InformacionClientesId'); 
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');

        return $query->result();
    }

    function getco_Deudores($contrato){
        $this->db->select(' Id as id,  NombreDeudor as deudor');
        $this->db->join('ClienteObligacion', 'NumeroContratoId = Id ');
        $this->db->join('ParametroGeneral', 'Id = Rol');
        $this->db->join('InformacionCliente', 'Id = InformacionClientesId'); 
        $this->db->where('Id', $contrato); 
        $this->db->where('Rol != 1786'); 
        $query = $this->db->get('InformacionCredito');

        return $query->result();
    }

    function getRolDeudor($contrato, $usuario){
        $this->db->select('Nombre_b');
        $this->db->join('ClienteObligacion', 'NumeroContratoId = Id ');
        $this->db->join('ParametroGeneral', 'Id = Rol');
        $this->db->join('InformacionCliente', 'Id = InformacionClientesId'); 
        $this->db->where('Id', $contrato); 
        $this->db->where('Id', $usuario); 
        $query = $this->db->get('InformacionCredito');

        return $query->row()->Nombre_b;
    }

   

    function getGestionIlocalizado($gestion){
        $this->db->select('G732_ConsInte__b as gestion, G732_c17131 as enunciado ');
        $this->db->where('G732_C17130', $gestion); 
        $query = $this->db->get('G732');
        return $query->result();

    }

    function getSubgestiones($gestion){
        $this->db->select('G732_ConsInte__b as id, G732_C17131 as enunciado ');
        $this->db->where('G732_C17130', $gestion); 
        $query = $this->db->get('G732');
        return $query->result();
    }

    function getSubgestionestabla(){
        $this->db->select('G732_ConsInte__b as id, G732_C17131 as enunciado, a.Nombre_b as gestion, b.Nombre_b as comunicacion ');
        $this->db->join('ParametroGeneral a', 'a.Id = G732_C17130'); 
        $this->db->join('ParametroGeneral b', 'b.Id = G732_C17129'); 
        $query = $this->db->get('G732');
        return $query->result();
    }

     function getSubgestionestablaById($id){
        $this->db->select('G732_ConsInte__b as id, G732_C17131 as enunciado, G732_C17130 as gestion , G732_C17129 ');
        $this->db->where('G732_ConsInte__b', $id);
        $query = $this->db->get('G732');
        return $query->result();
    }


    function getgestionExtrajudicial($contrato){
        $this->db->select(' Id as id, 
                            NombreDeudor as nombres,
                            FechaEjecucion as fechaIngreso ,
                            HoraEjecucion as Niidea,
                            NumeroContrato as contrato,
                            Ejecutor as users,
                            G742_C17426 as tarea,
                            Observaciones as observaciones,
                            a.Nombre_b as mediocomunicacion,
                            b.Nombre_b as resultadocomunicacion,
                            c.Nombre_b as gestion,
                            G732_C17131 as subgestion');
       
        $this->db->join('ParametroGeneral a', 'a.Id = MedioComunicacion', 'left');
        $this->db->join('ParametroGeneral b', 'b.Id = ResultadoComunicacion', 'left');
        $this->db->join('ParametroGeneral c', 'c.Id = Gestion', 'left');
        $this->db->join('G732', 'G732_ConsInte__b = SubGesstion', 'left');
        $this->db->join('InformacionCliente', 'Id = IdCliente', 'left');
        $this->db->where('NumeroContrato', $contrato); 
        $query = $this->db->get('GestionExtrajudicial');
        return $query->result();
    }

    function getgestionExtrajudicialtotal($resultadocomunicacion = NULL, $gestion = NULL, $subgestion = NULL){
        $this->db->select(' Id as id, 
                            NombreDeudor as nombres,
                            NroIdentificacion as identificacion,
                            NroProcesoJudicialSAP as SAP,  
                            ValorPagado as Vlorpagado,
                            FechaEjecucion as fechaIngreso ,
                            HoraEjecucion as Niidea,
                            NoContrato as contrato,
                            G719_C17423 as liquidacion,
                            Ejecutor as users,
                            Observaciones as observaciones,
                            a.Nombre_b as mediocomunicacion,
                            b.Nombre_b as resultadocomunicacion,
                            c.Nombre_b as gestion,
                            NombreIF as financiero,
                            G732_C17131 as subgestion,
                            FRG as FRG');
       
        $this->db->join('ParametroGeneral a', 'a.Id = MedioComunicacion');
        $this->db->join('ParametroGeneral b', 'b.Id = ResultadoComunicacion');
        $this->db->join('ParametroGeneral c', 'c.Id = Gestion');
        $this->db->join('G732', 'G732_ConsInte__b = SubGesstion', 'left');
        $this->db->join('InformacionCliente', 'Id = IdCliente');
        $this->db->join('InformacionCredito', 'Id = NumeroContrato');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');
        $this->db->join('FRG', 'Id = FRG','LEFT');
        $this->db->join('USUARI', 'USUARI_ConsInte__b = Usuario');

        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }

        if($resultadocomunicacion != NULL && $resultadocomunicacion != '' && $resultadocomunicacion != 0){
            $this->db->where('ResultadoComunicacion',  $resultadocomunicacion);     
        }

        if($gestion != NULL && $gestion != '' && $gestion != 0){
            $this->db->where('Gestion',  $gestion);
        }

        if($subgestion != NULL && $subgestion != '' && $subgestion != 0){
            $this->db->where('SubGesstion', $subgestion );
        }

		$this->db->order_by('FechaEjecucion','DESC');

        $query = $this->db->get('GestionExtrajudicial');
        return $query->result();
    }


    function getgestionExtrajudicialtotal_SAP($resultadocomunicacion = NULL, $gestion = NULL, $subgestion = NULL, $fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select(' Id as id, 
                            NombreDeudor as nombres,
                            NroIdentificacion as identificacion,
                            NroProcesoJudicialSAP as SAP,  
                            ValorPagado as Vlorpagado,
                            FechaEjecucion as fechaIngreso ,
                            HoraEjecucion as Niidea,
                            NoContrato as contrato,
                            G719_C17423 as liquidacion,
                            USUARI_Nombre____b  as users,
                            Observaciones as observaciones,
                            MedioComunicacion as mediocomunicacion,
                            ResultadoComunicacion as resultadocomunicacion,
                            Gestion as gestion,
                            IntermediarioFinanciero as financiero,
                            SubGesstion as subgestion');
       

        $this->db->join('InformacionCliente', 'Id = IdCliente');
        $this->db->join('InformacionCredito', 'Id = NumeroContrato');
        $this->db->join('USUARI', 'USUARI_ConsInte__b = Usuario');

        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }

        if($resultadocomunicacion != NULL && $resultadocomunicacion != '' && $resultadocomunicacion != 0){
            $this->db->where('ResultadoComunicacion',  $resultadocomunicacion);     
        }

        if($gestion != NULL && $gestion != '' && $gestion != 0){
            $this->db->where('Gestion',  $gestion);
        }

        if($subgestion != NULL && $subgestion != '' && $subgestion != 0){
            $this->db->where('SubGesstion', $subgestion );
        }

        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("FechaEjecucion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('FechaEjecucion',  $fechaInicial);   
        }

        $this->db->order_by('FechaEjecucion','DESC');

        $query = $this->db->get('GestionExtrajudicial');
        return $query->result();
    }




    function getgestionExtrajudicialtotalById($id){
        $this->db->select(' Id as id, 
                            NombreDeudor as nombres,
                            FechaEjecucion as fechaIngreso ,
                            HoraEjecucion as Niidea,
                            NumeroContrato as contrato,
                            Ejecutor as users,
                            Observaciones as observaciones,
                            a.Nombre_b as mediocomunicacion,
                            b.Nombre_b as resultadocomunicacion,
                            c.Nombre_b as gestion,
                            G732_C17131 as subgestion');
       
        $this->db->join('ParametroGeneral a', 'a.Id = MedioComunicacion');
        $this->db->join('ParametroGeneral b', 'b.Id = ResultadoComunicacion');
        $this->db->join('ParametroGeneral c', 'c.Id = Gestion');
        $this->db->join('G732', 'G732_ConsInte__b = SubGesstion', 'left');
        $this->db->join('InformacionCliente', 'Id = IdCliente');
        $this->db->where('Id', $id); 
        $query = $this->db->get('GestionExtrajudicial');
        return $query->result();
    }


    function getgestioJudicial($contrato){
        $this->db->select(' Id as id, 
                            G724_C17105 as actuacion ,
                            G735_C17138 as contrato,
                            NumeroContrato as txtFechaTramite,
                            G735_C17140 as users,
                            a.Nombre_b as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G725_C17108 as Etapa' );
        $this->db->join('G725', 'G725_ConsInte__b = G735_C17142', 'LEFT');
        $this->db->join('ParametroGeneral a', 'a.Id = G735_C17143');
        $this->db->join('G724', 'G724_ConsInte__b = Actuacion');
        $this->db->where('G735_C17138', $contrato); 
        $query = $this->db->get('G735');
        return $query->result();
    }

    function getgestioJudicialTotal($proceso = NULL, $etapa = NULL, $actuaciones = NULL){
        $this->db->select(' Id as id, 
                            G724_C17105 as actuacion ,
                            NoContrato as contrato,
                            G719_C17423 as liquidacion,
                            NumeroContrato as txtFechaTramite,
                            USUARI_Nombre____b as users,
                            G735_C17143 as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G725_C17108 as Etapa,
                            NombreDeudor as nombres,
                            NroIdentificacion as identificacion,
                            NroProcesoJudicialSAP as SAP,  
                            ValorPagado as Vlorpagado,
                            NombreIF as financiero,
                            b.Nombre_b as claseProceso,
                            FRG as FRG' );

        $this->db->join('ParametroGeneral b', 'b.Id = G735_C17143','LEFT');
        $this->db->join('G725', 'G725_ConsInte__b = G735_C17142', 'LEFT');
        $this->db->join('G724', 'G724_ConsInte__b = Actuacion');


        $this->db->join('InformacionCredito', 'Id = G735_C17138');
        $this->db->join('ClienteObligacion', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');
        $this->db->join('FRG', 'Id = FRG','LEFT');
        $this->db->join('USUARI', 'USUARI_ConsInte__b = Usuario');

        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }

        if($proceso != NULL && $proceso != '' && $proceso != 0){
            $this->db->where('G735_C17143',  $proceso);     
        }

        if($etapa != NULL && $etapa != '' && $etapa != 0){
            $this->db->where('G735_C17142',  $etapa);
        }

        if($actuaciones != NULL && $actuaciones != '' && $actuaciones != 0){
            $this->db->where('Actuacion', $actuaciones );
        }
        $this->db->where('ClienteObligacion.Rol', 1786);
		$this->db->order_by('G735_C17141','DESC');

        $query = $this->db->get('G735');
        return $query->result();
    }


    function getgestioJudicialTotal_SAP($proceso = NULL, $etapa = NULL, $actuaciones = NULL, $fechaInicial = NULL, $fechaFinal = NULL){
        $this->db->select(' Id as id, 
                            Actuacion as actuacion ,
                            NoContrato as contrato,
                            G719_C17423 as liquidacion,
                            NumeroContrato as txtFechaTramite,
                            G735_C17140 as users,
                            G735_C17143 as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G735_C17142 as Etapa,
                            NombreDeudor as nombres,
                            NroIdentificacion as identificacion,
                            NroProcesoJudicialSAP as SAP,  
                            ValorPagado as Vlorpagado,
                            IntermediarioFinanciero as financiero,
                            G735_C17143 as claseProceso' );

        $this->db->join('InformacionCredito', 'Id = G735_C17138');
        $this->db->join('ClienteObligacion', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');


        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }

        if($proceso != NULL && $proceso != '' && $proceso != 0){
            $this->db->where('G735_C17143',  $proceso);     
        }

        if($etapa != NULL && $etapa != '' && $etapa != 0){
            $this->db->where('G735_C17142',  $etapa);
        }

        if($actuaciones != NULL && $actuaciones != '' && $actuaciones != 0){
            $this->db->where('Actuacion', $actuaciones );
        }

        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G735_C17141',  $fechaInicial);   
        }
        $this->db->where('ClienteObligacion.Rol', 1786);
        $this->db->order_by('G735_C17141','DESC');

        $query = $this->db->get('G735');
        return $query->result();
    }

    function getgestioJudicialById($contrato){
        $this->db->select(' Id as id, 
                            G724_C17105 as actuacion ,
                            G735_C17138 as contrato,
                            NumeroContrato as txtFechaTramite,
                            G735_C17140 as users,
                            Nombre_b as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G725_C17108 as Etapa' );
        $this->db->join('G725', 'G725_ConsInte__b = G735_C17142', 'LEFT');
        $this->db->join('G724', 'G724_ConsInte__b = Actuacion');
        $this->db->join('ParametroGeneral', 'Id = G735_C17143');
        
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('G735');
        return $query->result();
    }

    function getMedidasCautelares($contrato){

        $this->db->select(' G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G736_C17151 as contrato,
                            G736_C17283 as FechaInforme,
                            G731_C17128 as Medida,
                            resultadoMedida' );
        $this->db->join('G731', 'G731_ConsInte__b = G736_C17150');
        $this->db->where('G736_C17151', $contrato); 
        $query = $this->db->get('G736');
        return $query->result();
    }

    function getMedidasCautelaresTotal($medida = NULL){

        $this->db->select(' G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            NoContrato as contrato,
                            G719_C17423 as liquidacion,
                            G736_C17283 as FechaInforme,
                            NombreDeudor as nombres,
                            NroIdentificacion as identificacion,
                            NroProcesoJudicialSAP as SAP,  
                            ValorPagado as Vlorpagado,
                            NombreIF as financiero,
                            G731_C17128 as Medida,
                            resultadoMedida,
                            FRG as FRG' );

        $this->db->join('G731', 'G731_ConsInte__b = G736_C17150');
        $this->db->join('InformacionCredito', 'Id = G736_C17151');
        $this->db->join('ClienteObligacion', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        $this->db->join('IntermediarioFinanciero', 'Id = IntermediarioFinanciero','LEFT');
        $this->db->join('FRG', 'Id = FRG','LEFT');


        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }

        if($medida != NULL && $medida != '' && $medida != 0){
            $this->db->where('G736_C17150', $medida);
        }
        $this->db->where('ClienteObligacion.Rol', 1786);
        $query = $this->db->get('G736');
        return $query->result();
    }


    function getMedidasCautelaresTotal_SAP($medida = NULL, $fechaInicial = NULL, $fechaFinal = NULL){

        $this->db->select(' G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            NoContrato as contrato,
                            G719_C17423 as liquidacion,
                            G736_C17283 as FechaInforme,
                            NombreDeudor as nombres,
                            NroIdentificacion as identificacion,
                            NroProcesoJudicialSAP as SAP,  
                            ValorPagado as Vlorpagado,
                            IntermediarioFinanciero as financiero,
                            G736_C17150 as Medida,
                            resultadoMedida' );
        $this->db->join('InformacionCredito', 'Id = G736_C17151');
        $this->db->join('ClienteObligacion', 'Id = NumeroContratoId');
        $this->db->join('InformacionCliente','Id = InformacionClientesId');
        if ($this->session->userdata('tpo_usuario') == 'ABOGADO') {
          if( $this->session->userdata('codigo_abogado') != NULL){
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }else{
              $this->db->where('InformacionCredito.Abogado IS NOT NULL');
              $this->db->where('InformacionCredito.Abogado', $this->session->userdata('codigo_abogado'));
          }
        }elseif ($this->session->userdata('tpo_usuario') == 'GESTOR') {
            if($this->session->userdata('identificacion') != NULL){
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }else{
                $this->db->where('InformacionCredito.G719_C17347 IS NOT NULL');
                $this->db->where('InformacionCredito.G719_C17347', $this->session->userdata('identificacion'));
            }
        }elseif ($this->session->userdata('tpo_usuario') == 'FRG') {
            if($this->session->userdata('frg') != NULL){
                 $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }else{
                $this->db->where('InformacionCredito.FRG IS NOT NULL');
                $this->db->where('InformacionCredito.FRG', $this->session->userdata('frg'));
            }
        }

        if($medida != NULL && $medida != '' && $medida != 0){
            $this->db->where('G736_C17150', $medida);
        }

        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G736_C17283 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G736_C17283',  $fechaInicial);   
        }
        
        $this->db->where('ClienteObligacion.Rol', 1786);
        $query = $this->db->get('G736');
        return $query->result();
    }


    function getMedidasCautelaresById($id){
         $this->db->select(' G736_ConsInte__b as id, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G736_C17151 as contrato,
                            G736_C17283 as FechaInforme,
                            G731_C17128 as Medida' );
        $this->db->join('G731', 'G731_ConsInte__b = G736_C17150');
        $this->db->where('G736_ConsInte__b', $id); 
        $query = $this->db->get('G736');
        return $query->result();
    }

    function getCodeudores($contrato){
        $this->db->select(' Id as id,
                            NroIdentificacion as Identificacion, 
                            NombreDeudor as nombre, 
                            NroObligacionesDeudor as Numero_obligaciones');
       
        $this->db->join('ParametroGeneral', 'Id = Rol ');
        $this->db->join('InformacionCliente', 'Id = InformacionClientesId');
        $this->db->where('NumeroContratoId', $contrato); 
        $this->db->where('Id != 1786'); 
        $query = $this->db->get('ClienteObligacion');
        if($query->num_rows() > 0){
           return $query->result();
       }else{
        return 0;
       }
        
    }
	
	

    function gerAcuerdoPago($contrato){
        $this->db->select(' FechaPagoUltimaCuota as CONTRATO, 
                            FechaLiquidacion as FECHA_CONSIGNACION_ANTICIPO, 
                            FechaConsignacionAnticipo as FECHA_DE_LEGALIZACION,
                            FechaLegalizacion as VALOR_DEL_ACUERDO,
                            ValorRecaudo as PLAZO_ACUERDO_DE_PAGO,
                            PlazoAcuerdoPago as VALOR_CUOTA_DEL_ACUERDO,
                            ValorCuotaAcuerdo as FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA,
                            NumeroContrato as FECHA_LIQUIDACION,
                            FechaPagoPrimeraCuota as FECHA_ULTIMACUOTA,
                            TasaInteresCorrienteAcuerdoPago as TASAINTERES,
                            Id as id');
    
        $this->db->where('FechaPagoUltimaCuota', $contrato); 
        $query = $this->db->get('AcuerdosPago');
        return $query->result();
    }

    function gerAcuerdoPagoById($contrato){
        $this->db->select(' NoContrato as CONTRATO, 
                            FechaLiquidacion as FECHA_CONSIGNACION_ANTICIPO, 
                            FechaConsignacionAnticipo as FECHA_DE_LEGALIZACION,
                            FechaLegalizacion as VALOR_DEL_ACUERDO,
                            ValorRecaudo as PLAZO_ACUERDO_DE_PAGO,
                            PlazoAcuerdoPago as VALOR_CUOTA_DEL_ACUERDO,
                            ValorCuotaAcuerdo as FECHA_DE_PAGO_DE_LA_PRIMERA_CUOTA,
                            NumeroContrato as FECHA_LIQUIDACION,
                            FechaPagoPrimeraCuota as FECHA_ULTIMACUOTA,
                            TasaInteresCorrienteAcuerdoPago as TASAINTERES,
                            Id as id');
        $this->db->from('AcuerdosPago');
        $this->db->join('InformacionCredito', 'Id = FechaPagoUltimaCuota');
        $this->db->where('Id', $contrato); 
        $query = $this->db->get();
        return $query->result();
    }

    function getGarantias($contrato){
        $this->db->select(' G734_ConsInte__b as id,
                            G734_C17135 as garantia, 
                            G734_C17136 as pagare,
                            NoContrato as contrato,
                            G719_C17425 as vPagado');
        $this->db->join('InformacionCredito','G734_C17241 = Id');
        $this->db->where('G734_C17241', $contrato); 
        $query = $this->db->get('G734');
        return $query->result();
    }

    function getGarantiasxLiquidacion($liquidacion){
        $this->db->select(' G734_ConsInte__b as id,
                            G734_C17135 as garantia, 
                            G734_C17136 as pagare,
                            NoContrato as contrato,
                            G719_C17425 as vPagado');
        $this->db->join('InformacionCredito','G734_C17241 = Id');
        $this->db->where('G719_C17423', $liquidacion); 
        $query = $this->db->get('G734');
        return $query->result();
    }

    


    function getLiquidacionN($contrato){
        $this->db->select('G719_C17423 as eso');
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');
        if($query->num_rows() > 0){
            return $query->row()->eso;
        }else{
            return 0;
        }
        
    }
    function getGarantiasById($contrato){
        $this->db->select(' G734_ConsInte__b as id,
                            G734_C17135 as garantia, 
                            G734_C17136 as pagare');
        $this->db->where('G734_ConsInte__b', $contrato); 
        $query = $this->db->get('G734');
        return $query->result();
    }

    function getFacturasbyid($contrato){
        $this->db->select(' FechaFacturacionAutoSubRogacion as FECHA_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            NroFacturaAutoSubRogacion as N_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            FechaAutoSubRogacion as FECHA_AUTO_DE_SUBROGACION,
                            NroFacturaSentenciaIrrecuperable as N_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            FechaSentenciaIrrecuperable as FECHA_SENTENCIA_IRRECUPERABLE,
                            FechaFacturaSentenciaIrrecuperable as FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            NroFacturaSoporteCISA as N_DE_FACTURAS_SOPORTES_CISA,
                            FechaLiquidacionCredito as FECHA_LIQUIDACION_CREDITO,
                            FechaAutoIrrecuperable as FECHA_AUTO_IRRECUPERABLE,
                            b.Nombre_b As SOPORTE,
                            FechaFacturaSoporteCISA as VALOR_FACTURADO_AUTO_DE_SUBROGACION, 
                            FechaFacturaSoporteCISA_ as FECHA_FACTURA_SOPORTES_CISA, 
                            ValorFacturadoSentenciaIrrecuperable as VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE,
                            ValorFacturadoSoporteCISA as VALOR_FACTURADO_SOPORTES_CISA,
                            a.Nombre_b As RENUNCIA_Y_PAZ_Y_SALVO_O_CESION,
                            NumeroContratoId as N_CONTRATO,
                            FechaFacturaHonorarioCISA2 as HONORARIOS_VENTA_CISA,
                            FechaFacturaHonorarioCISA3 as N_Factura_honorarios_venta_CISA,
                            FechaFacturaHonorarioCISA4 as Fecha_de_factura_honorarios_venta_CISA,
                            Id ,
                            FechaRecepcionSoporte,
                            Fecha_aprovacion_soporte');
        $this->db->join('ParametroGeneral a', 'a.Id = FechaFacturaHonorarioCISA1 ', 'LEFT');
        $this->db->join('ParametroGeneral b', 'b.Id = Soporte ', 'LEFT');        
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('Factura');
        return $query->result();
    }

    function getFacturas($contrato){
        $this->db->select(' FechaFacturacionAutoSubRogacion as FECHA_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            NroFacturaAutoSubRogacion as N_DE_FACTURA_AUTO_DE_SUBROGACION, 
                            FechaAutoSubRogacion as FECHA_AUTO_DE_SUBROGACION,
                            
                            NroFacturaSentenciaIrrecuperable as N_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            FechaSentenciaIrrecuperable as FECHA_SENTENCIA_IRRECUPERABLE,
                            FechaFacturaSentenciaIrrecuperable as FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE,
                            NroFacturaSoporteCISA as N_DE_FACTURAS_SOPORTES_CISA,
                            FechaLiquidacionCredito as FECHA_LIQUIDACION_CREDITO,
                            FechaAutoIrrecuperable as FECHA_AUTO_IRRECUPERABLE,
                            Soporte as SOPORTE,
                            FechaFacturaSoporteCISA as VALOR_FACTURADO_AUTO_DE_SUBROGACION, 
                            FechaFacturaSoporteCISA_ as FECHA_FACTURA_SOPORTES_CISA, 
                            ValorFacturadoSentenciaIrrecuperable as VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE,
                            ValorFacturadoSoporteCISA as VALOR_FACTURADO_SOPORTES_CISA,
                            FechaFacturaHonorarioCISA1 as RENUNCIA_Y_PAZ_Y_SALVO_O_CESION,
                            NumeroContratoId as N_CONTRATO,
                            FechaFacturaHonorarioCISA2 as HONORARIOS_VENTA_CISA,
                            FechaFacturaHonorarioCISA3 as N_Factura_honorarios_venta_CISA,
                            FechaFacturaHonorarioCISA4 as Fecha_de_factura_honorarios_venta_CISA,
                            Id,
                            FechaRecepcionSoporte,
                            Fecha_aprovacion_soporte ');
                            
        $this->db->where('NumeroContratoId', $contrato); 
        $query = $this->db->get('Factura');
        return $query->result();
    }

    function getinformacionJudicial($contrato){
        $this->db->select('RadicadoExpediente AS Radicado_o_expediente, 
                           FechaDemanda AS Fech_demanda, 
                           FechaAdmisionDemanda AS Fecha_admision_demanda,
                           FechaMandamientoPago AS Fecha_mandamiento_de_pago,
                           G719_C17222 As Total_gastos_judiciales,
                           G719_C17426 As abogado_if,
                           Id as id,
                           G719_C17427 as fechaenvioterminacion');
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');
        return $query->result();
    
    }

    function getInformacionAbogado($contrato){
        
        $this->db->select(' Nombre as Abogado,
                            Celular as celular,
                            CorreoElectronico as correo,
                            direccion,
                            telefono,
                            G719_C17051 as Fecha_asignacion_abogado,
                            G719_C17054 as No_Poliza,
                            G719_C17056 as Fecha_de_aprobacion_de_Poliza,
                            G719_C17055 as Fecha_de_vencimiento,
                            FRG as frg,
                            G728_C17116 as firma,
                            G719_C17220 as promotor');
		$this->db->join('Abogados', 'Id = Abogado', 'LEFT');
        //FirmaAbogado,  FRG Id
        $this->db->join('G728', 'G728_ConsInte__b = FirmaAbogado', 'LEFT');
        $this->db->join('FRG', 'Id = Frg_ConsInte__b', 'LEFT');

        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');
        return $query->result();
    }

    function getPazYsalvo($contrato){
        
        $this->db->select(' G719_C17071 AS Fecha_de_expedicion_del_paz_y_salvo,
                            G719_C17070 AS Paz_y_salvo,
                            G719_C17073 AS Fecha_venta');
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');
        return $query->result();
    }

    function getSubrogacion($contrato){
        
        $this->db->select(' FechaEnvioMemorialSubrogacionFRG AS Fecha_envio_memorial_de_subrogacion_al_FRG,
                            FechaDevolucionFRGMemorialSubrogacionxErrores AS Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores,
                            G719_C17050 AS Fecha_envio_memorial_de_subrogacion_corregido,
                            G719_C17212 AS Fecha_radicacion_memorial,
                            G719_C17213 As Fecha_pronunciamiento,
                            a.G724_C17105  AS Decision,
                            G719_C17218 AS Fecha_impugnacion_decision_final,
                            b.G724_C17105 As Nombre_clase_de_impugnacion,
                            c.G724_C17105 As decicion_Final,
                            FechaDecisionFinal');
        $this->db->join('G724 a', 'G719_C17214 = a.G724_ConsInte__b', 'LEFT');
        $this->db->join('G724 b', 'G719_C17215 = b.G724_ConsInte__b', 'LEFT');
        $this->db->join('G724 c', 'G719_C17216 = c.G724_ConsInte__b', 'LEFT');
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');
        return $query->result();
    }

    function getSubrogacionByCOntrato($contrato){
        
        $this->db->select('G719_C17212 AS Fecha_radicacion_memorial');
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');
        return $query->row()->Fecha_radicacion_memorial;
    }

    function getSubrogacionParaDecicionFinal($contrato){
        
        $this->db->select('G719_C17218 AS Fecha_inpugnacion');
        $this->db->where('Id', $contrato); 
        $query = $this->db->get('InformacionCredito');
        return $query->row()->Fecha_inpugnacion;
    }

    function getDatosAdicionales($clienteId){
       
        $this->db->select(' G743_C17256 AS Telefono,
                            G743_C17257 AS Direccion,
                            Ciudad AS Ciudad,
                            G743_C17363 AS Correo_electronico,
                            G743_C17260 AS Descripcion,
                            G743_C17361 AS Fecha,
                            G743_ConsInte__b as id,
                            a.Nombre_b As Calificacion_correo,
                            b.Nombre_b As Calificacion_telefono,
                            c.Nombre_b As Calificacion_direccion,
                            d.Nombre_b As Calificacion_ciudad,
                            e.Nombre_b As Calificacion_descripcion,
                            NoContrato as obligacion,
                            NombreDeudor as deudor,
                            G743_C17269 as rol');
        $this->db->join('Ciudad', 'Id = G743_C17258', 'LEFT');
   

        $this->db->join('ParametroGeneral a', 'a.Id = G743_C17262 ', 'LEFT');
        $this->db->join('ParametroGeneral b', 'b.Id = G743_C17263 ', 'LEFT');
        $this->db->join('ParametroGeneral c', 'c.Id = G743_C17264 ', 'LEFT');
        $this->db->join('ParametroGeneral d', 'd.Id = G743_C17265 ', 'LEFT');
        $this->db->join('ParametroGeneral e', 'e.Id = G743_C17266 ', 'LEFT');
        $this->db->join('InformacionCredito', 'Id = G743_C17267 ', 'LEFT');
        $this->db->join('InformacionCliente', 'Id = G743_C17268 ', 'LEFT');
        $this->db->where('G743_C17261', $clienteId); 
        $query = $this->db->get('G743');
        return $query->result();
    }

    function getDatosAdicionalesByid($id){
        $this->db->select(' G743_C17256 AS Telefono,
                            G743_C17257 AS Direccion,
                            Ciudad AS Ciudad,
                            G743_C17363 AS Correo_electronico,
                    
                            G743_C17260 AS Descripcion,
                            G743_C17361 AS Fecha,
                            G743_ConsInte__b as id,
                            a.Nombre_b As Calificacion_correo,
                            b.Nombre_b As Calificacion_telefono,
                            c.Nombre_b As Calificacion_direccion,
                            d.Nombre_b As Calificacion_ciudad,
                            e.Nombre_b As Calificacion_descripcion');
        $this->db->join('Ciudad', 'Id = G743_C17258', 'LEFT');
        $this->db->join('ParametroGeneral a', 'a.Id = G743_C17262 ', 'LEFT');
        $this->db->join('ParametroGeneral b', 'b.Id = G743_C17263 ', 'LEFT');
        $this->db->join('ParametroGeneral c', 'c.Id = G743_C17264 ', 'LEFT');
        $this->db->join('ParametroGeneral d', 'd.Id = G743_C17265 ', 'LEFT');
        $this->db->join('ParametroGeneral e', 'e.Id = G743_C17266 ', 'LEFT');

        $this->db->where('G743_ConsInte__b', $id); 
        $query = $this->db->get('G743');
        return $query->result();
    }


    function getSalariomin(){
        $this->db->select('G758_C17367 as minimo');
        $query = $this->db->get('G758');
        return $query->row()->minimo;
    }

    function validarSAP($sap){
        $this->db->select('Id');
        $this->db->where('NroProcesoJudicialSAP', $sap);
        $query = $this->db->get('InformacionCredito');

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function validarObligacion($contrato){
        $this->db->select('Id');
        $this->db->where('NoContrato', $contrato);
        $query = $this->db->get('InformacionCredito');

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function validarLiquidacion($liquidacion){
        $this->db->select('Id');
        $this->db->where('G719_C17423', $liquidacion);
        $query = $this->db->get('InformacionCredito');

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }



    function getgestionExtrajudicialtotal_SAP_Final($fechaInicial = NULL, $fechaFinal = NULL, $id){
        $this->db->select('TOP 1 Id as id, 
                            NombreDeudor as nombres,
                            NroIdentificacion as identificacion,
                            NroProcesoJudicialSAP as SAP,  
                            ValorPagado as Vlorpagado,
                            FechaEjecucion as fechaIngreso ,
                            HoraEjecucion as Niidea,
                            NoContrato as contrato,
                            G719_C17423 as liquidacion,
                            Ejecutor as users,
                            Observaciones as observaciones,
                            MedioComunicacion as mediocomunicacion,
                            ResultadoComunicacion as resultadocomunicacion,
                            Gestion as gestion,
                            IntermediarioFinanciero as financiero,
                            SubGesstion as subgestion,
                            Nombre as abogado,
                            G719_C17051 as fechaabogado,
                            G719_C17054 as poliza,
                            G719_C17056 as fecha_aprovacion,
                            G719_C17055 as fecha_vencimiento
                            NumeroContrato');
       

        $this->db->join('InformacionCliente', 'Id = IdCliente');
        $this->db->join('InformacionCredito', 'Id = NumeroContrato');
        $this->db->join('Abogados', 'Id =  Abogado', 'LEFT');
        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("FechaEjecucion BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('FechaEjecucion',  $fechaInicial);   
        }
        $this->db->where('NumeroContrato',  $id);   
        $this->db->order_by('FechaEjecucion','DESC');

        $query = $this->db->get('GestionExtrajudicial');
        
        if( $query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
        
    }


    function getgestioJudicialTotal_SAP_Final($fechaInicial = NULL, $fechaFinal = NULL, $idContrato){

        $this->db->select('TOP 1 Id as id, 
                            Actuacion as actuacion ,
                            NumeroContrato as txtFechaTramite,
                            G735_C17140 as users,
                            G735_C17143 as TipoProceso,
                            G735_C17219 as txtObservaciones,
                            G735_C17141 as txtFechaIngreso,
                            G735_C17142 as Etapa,
                            G735_C17143 as claseProceso,
                            Nombre as abogado,
                            G719_C17051 as fechaabogado,
                            G719_C17054 as poliza,
                            G719_C17056 as fecha_aprovacion,
                            G719_C17055 as fecha_vencimiento,
                            NroProcesoJudicialSAP as SAP,
                            G719_C17423 as liquidacion,
                            G719_C17212 AS Fecha_radicacion_memorial,
                            G719_C17213 As Fecha_pronunciamiento,
                            G719_C17214 AS Decision' );

        $this->db->join('InformacionCredito', 'Id = G735_C17138');
        $this->db->join('Abogados', 'Id =  Abogado', 'LEFT');


        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G735_C17141 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G735_C17141',  $fechaInicial);   
        }

        $this->db->where("G735_C17138", $idContrato);
        $this->db->order_by('G735_C17141','DESC');

        $query = $this->db->get('G735');
        if( $query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
    }


    function getMedidasCautelaresTotal_SAP_final($fechaInicial = NULL, $fechaFinal = NULL, $contrato){

        $this->db->select(' TOP 1 G736_ConsInte__b, 
                            G736_C17144 as FechaSolicitud,
                            G736_C17145 as FechaDecreto,
                            G736_C17284 as users,
                            G736_C17146 as FechaPractica,
                            G736_C17147 as Secuestre,
                            G736_C17148 as OtroBien,
                            G736_C17149 as Observaciones,
                            G736_C17283 as FechaInforme,
                            G736_C17150 as Medida,
                            resultadoMedida' );

        
        if($fechaInicial != NULL && $fechaFinal != NULL){
            $this->db->where("G736_C17283 BETWEEN '".$fechaInicial."' AND '".$fechaFinal."'");
        }

        if($fechaInicial != NULL && $fechaFinal == NULL){
            $this->db->where('G736_C17283',  $fechaInicial);   
        }
        $this->db->where("G736_C17151", $contrato);
        $this->db->order_by('G736_C17283','DESC');
        $query = $this->db->get('G736');
        if( $query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
        
    }


    
                           
}