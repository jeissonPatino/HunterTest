
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar sidebar-collapse">
        <!-- sidebar menu: : style can be found in sidebar.less -->
       <ul class="sidebar-nav">
           <li class="sidebar-brand">Menú Principal</li>
                    <?php if($this->session->userdata('USUARI_asignacion_abogados_p') == '1' || $this->session->userdata('USUARI_asignacion_gestores_p') == '1') { ?>
            <li id="ULasignacion"  class="treeview" >
                <a href="#">
                     <i class="fa fa-cogs"></i> <span>      Asignación</span>
                     <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata('USUARI_asignacion_abogados_p') == '1'){ ?>
                    <li id="LIabogados" ><a href="<?php echo base_url();?>asignacion/abogadosFrg">Abogados</a></li>
                    <?php } 
                    if($this->session->userdata('USUARI_asignacion_gestores_p') == '1'){
                    ?>   
                    <li id="LIgestores"><a href="<?php echo base_url();?>asignacion/gestores">Gestores</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('tpo_usuario') == 'FNG') { ?>
        
                    <li id="LIabogadosSuer"><a href="<?php echo base_url();?>asignacion/supercargueFNG">Asinagción abogados total</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            




            <?php  if($this->session->userdata('USUARI_configuracion_abogados_p') == '1' || $this->session->userdata('USUARI_configuracion_actuaciones_p') == '1' || $this->session->userdata('USUARI_configuracion_acuerdos_p') == '1' || $this->session->userdata('USUARI_configuracion_ciudades_p') == '1' || $this->session->userdata('USUARI_configuracion_salario_p') == '1' || $this->session->userdata('USUARI_configuracion_despachos_p') == '1' || $this->session->userdata('USUARI_configuracion_etapas_p') == '1' || $this->session->userdata('USUARI_configuracion_facturas_p') == '1' || $this->session->userdata('USUARI_configuracion_gastos_p') == '1' || $this->session->userdata('USUARI_configuracion_FRG_p') == '1' || $this->session->userdata('USUARI_configuracion_subgestiones_p') == '1' || $this->session->userdata('USUARI_configuracion_usuarios_p') == '1' || $this->session->userdata('GestionarDatosClientes') == '1' || $this->session->userdata('firmas_abogados_permiso_') == '1' || $this->session->userdata('configurar_valores_conceptos_permisos_') == '1' || $this->session->userdata('cargar_devolucion_subrogaciones_permisos_') == '1' || $this->session->userdata('cargar_envio_subrogaciones_permisos_') == '1') { ?>
           
           <li id="ULconfiguracion" class="treeview">
                <a href="#">
                     <i class="fa fa-cogs"></i> <span >     Configuración</span>
                     <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu" id="listaConfiguraciones">
                
                    <?php if($this->session->userdata('USUARI_configuracion_abogados_p') == '1') { ?>
                    <li id="LIabgadosAux"><a href="<?php echo base_url();?>auxiliar/Abogados">Abogados</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('firmas_abogados_permiso_') == '1') { ?>
                    <li id="LIfirmas"><a href="<?php echo base_url();?>auxiliar/firmas_abogados">Firmas de abogados</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('USUARI_configuracion_actuaciones_p') == '1') { ?>
                    <li id="LIactuaciones"><a href="<?php echo base_url();?>auxiliar/Actuaciones">Actuaciones</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_acuerdos_p') == '1') { ?>
                    <li id="LIacuerdos"><a href="<?php echo base_url();?>auxiliar/acuerdosPago">Acuerdos de pago</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_ciudades_p') == '1') { ?>
                    <li id="LIciudades"><a href="<?php echo base_url();?>auxiliar/ciudades">Ciudades</a></li>
                    <!---->
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_salario_p') == '1') { ?>
                    <li id="LIsalario"><a href="<?php echo base_url();?>configuraciones/generales"><span>Configuracion salario</span></a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_despachos_p') == '1') { ?>
                    <li id="LIdespacho"><a href="<?php echo base_url();?>auxiliar/despachos">Despachos</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_etapas_p') == '1') { ?>
                    <li id="LIetapas"><a href="<?php echo base_url();?>auxiliar/etapas">Etapas</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_facturas_p') == '1') { ?>
                    <li id="LIfacturas"><a href="<?php echo base_url();?>auxiliar/facturas">Facturas</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_gastos_p') == '1') { ?>
                    <li id="LIgastos"><a href="<?php echo base_url();?>auxiliar/gastos_judiciales">Facturas gastos judiciales</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_FRG_p') == '1') { ?>
                    <li id="LIfrg"><a href="<?php echo base_url();?>auxiliar/frg">FRG</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_subgestiones_p') == '1') { ?>

                    <li id="LIsubgestiones"><a href="<?php echo base_url();?>auxiliar/subgestiones">Subgestiones</a></li>
                    <?php } ?>

                   <?php if($this->session->userdata('GestionarDatosClientes') == '1') { ?>

                    <li id="LIUsers"><a href="<?php echo base_url();?>configuraciones/DatosClientes">Gestionar Datos clientes</a></li>
                    <?php } ?>

                     <?php if($this->session->userdata('Logeliminacion') == '1') { ?>

                    <li id="LIUsers"><a href="<?php echo base_url();?>reportes/LogEliminacion">Log Datos Eliminación</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('USUARI_configuracion_usuarios_p') == '1') { ?>
                        <li id="LIUsers"><a href="<?php echo base_url();?>configuraciones/crear_Users">Usuarios</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('USUARI_configuracion_usuarios_p') == '1') { ?>
                        <li id="LIreportesconfig"><a href="<?php echo base_url();?>configuraciones/reportes">Configuración informes</a></li>
                    <?php } ?>
                    
                    <?php if($this->session->userdata('USUARI_configuracion_eliminarObligaciones_p') == '1') { ?>
                        <li id="LIeliminarObligacionnes"><a href="<?php echo base_url();?>configuraciones/obligaciones">Eliminar obligaciones</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('configurar_valores_conceptos_permisos_') == '1' ) { ?>
                    <li id="LiValConceptos"><a href="<?php echo base_url();?>auxiliar/valores_conceptos_pagar">Conseptos y valores a pagar</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('cargar_envio_subrogaciones_permisos_') == '1'  ) { ?>
                    <li id="LISubgarantiasCorregido"><a href="<?php echo base_url();?>Conceptos/cargarSubrogacionesCorregido">F. Eenvío M. subrogación corregido</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('cargar_devolucion_subrogaciones_permisos_') == '1' ) { ?>
                    <li id="LISubgarantiasDevolucion"><a href="<?php echo base_url();?>Conceptos/cargarSubrogacionesDevolucion">F. Devolución M. subrogación FRG</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('cargar_fecha_terminacion_permisos_') == '1' ) { ?>
                        <li id="LIFechaTer"><a href="<?php echo base_url();?>auxiliar/fechasEnvioTerminacion">Cargar F. envío terminación</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('Eliminar_Facturas_permisos_') == '1' ) { ?>
                        <li id="LIELiminarFacturas"><a href="<?php echo base_url();?>auxiliar/eliminarFactura">Eliminar facturas</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('Exportar_datos_adicionales_permisos_') == '1' ) { ?>
                    <li id="LIExpo_datos_ad"><a href="<?php echo base_url();?>auxiliar/exportarDatosAdicionales">Datos adicionales</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('Eliminar_Gestiones_judiciales_permisos_') == '1' ) { ?>
                    <li id="LIEliminarGetsiones"><a href="<?php echo base_url();?>auxiliar/getJudicialesForDelete">Eliminar gestión judicial</a></li>
                    <?php } ?>


                    <?php if($this->session->userdata('EliminarGestores') == '1' ) { ?>
                    <li id="LIUsers"><a href="<?php echo base_url();?>configuraciones/GestionAbogaos_Gestores">Eliminar Abogados Y Gestores</a></li>
                    <?php } ?>
                    
                    <?php if($this->session->userdata('Eliminar_Gestiones_judiciales_permisos_') == '1' ) { ?>
                    <li id="LIEliminarGetsionesE"><a href="<?php echo base_url();?>auxiliar/eliminarGestionExtrajudiciales">Eliminar gestión extrajudicial</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('tpo_usuario') == 'FNG') { ?>
                    <li id="LIutilidades"><a href="<?php echo base_url();?>utilidades/cambiarBotones">Cambiar botones</a></li>
                    <?php } ?>
                
					<!-- (ACB2) -->			   
                    <?php if($this->session->userdata('USUARI_configuracion_subgestiones_p') == '1') { ?>
                    <li id="LIsubgestiones"><a href="<?php echo base_url();?>extrajudicial/cargueMasivoAcuerdosDePago">Carga masiva liquidaciones acuerdo de pago</a></li>
                    <?php } ?>
					
				</ul>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('subrogacion_permiso_') == '1' || $this->session->userdata('Sentencia_irrecuperable_permiso_') == '1' || $this->session->userdata('cisa_permiso_') == '1' || $this->session->userdata('gastos_judiciales_permiso_') == '1') { ?>
            <li id="ULAUXILIARES" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i><span>        Aplicación facturación</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata('subrogacion_permiso_') == '1' ) { ?>
                    <li id="LIAux-subrogacion"><a href="<?php echo base_url();?>Conceptos/subrogacion">Subrogación</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('Sentencia_irrecuperable_permiso_') == '1' ) { ?>
                    <li id="LIAux-sentencias"><a href="<?php echo base_url();?>Conceptos/sentencia_irrecuperable">Sentencia irrecuperable </a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('cisa_permiso_') == '1' ) { ?>
                    <li id="LIAux-CISA"><a href="<?php echo base_url();?>Conceptos/cisa">CISA</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('gastos_judiciales_permiso_') == '1' ) { ?>
                    <li id="LIAux-sentencias"><a href="<?php echo base_url();?>Conceptos/gastosJudiciales">Gastos judiciales</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>


            <?php if($this->session->userdata('USUARI_gestion_extrajudicial_p') == '1' || $this->session->userdata('USUARI_gestion_judicial_p') == '1' || $this->session->userdata('USUARI_gestion_exfuncionarios_p') == '1') { ?>
            <li id="ULcartera" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i></i> <span>       Gestión cartera FNG</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata('USUARI_gestion_extrajudicial_p') == '1') { ?>
                    <li id="LIExtrajudicial"><a href="<?php echo base_url();?>Extrajudicial/">Gestión extrajudicial </a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_gestion_judicial_p') == '1' ) { ?>
                    <li id="LIjudicial"><a href="<?php echo base_url();?>cartera_fng/">Gestión judicial </a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_gestion_exfuncionarios_p') == '1' ) { ?>
                    <li id="LIExfuncionarios"><a href="<?php echo base_url();?>Extrajudicial/Exfuncionarios">Exfuncionarios</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('USUARI_historico_extrajudicial_p') == '1' || $this->session->userdata('USUARI_historico_judicial_p') == '1' || $this->session->userdata('USUARI_historico_medidas_p') == '1' ) { ?>
            <li id="ULhistorico" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i><span>Históricos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php  if(  $this->session->userdata('USUARI_historico_extrajudicial_p') == '1') { ?>
                    <li id="LIHextrajudicial"><a href="<?php echo base_url();?>historicos/historicoExtraJudicial">Gestión extrajudicial </a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('USUARI_historico_judicial_p') == '1' ) { ?>
                    <li id="LIHjudicial"><a href="<?php echo base_url();?>historicos/historicoJudicial">Gestión judicial </a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('USUARI_historico_medidas_p') == '1' ) { ?>
                    <li id="LIHmedidas"><a href="<?php echo base_url();?>historicos/historicoMedidas">Gestión medidas cautelares</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('tpo_usuario') == 'FNG') { ?>
            <li id="ULhistorico_SAP" class="treeview">
                <a href="#">
                     <i class="fa fa-cogs"></i><span>       Históricos SAP</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li id="LIHextrajudicial_SAP"><a href="<?php echo base_url();?>historicos/gestionExtrajudicial_SAP">Gestión extrajudicial SAP</a></li>
                    <li id="LIHjudicial_SAP"><a href="<?php echo base_url();?>historicos/historicoJudicial_SAP">Gestión judicial SAP</a></li>
                    <li id="LIHmedidas_SAP"><a href="<?php echo base_url();?>historicos/historicoMedidas_SAP">Gestión medidas cautelares SAP</a></li>
                     <li id="LIHmedidas_SAP_SUPER"><a href="<?php echo base_url();?>historicos/superhistoricoSap">Gestión total SAP</a></li>
                </ul>
            </li>
            <?php } ?>
            
            <?php if($this->session->userdata('Rep_asignacion_abogados_permiso_') == '1' || $this->session->userdata('Rep_gestion_judicial_mensual_permiso_') == '1' || $this->session->userdata('Rep_subrogaciones_efectivas_permiso_') == '1' || $this->session->userdata('Rep_soporte_cisa_permiso_') == '1') { ?>
            <li id="LIreportes"  class="treeview">
                <a href="#">
                   <i class="fa fa-file-excel-o"></i><span>     Informes FRG</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <?php  if(  $this->session->userdata('Rep_asignacion_abogados_permiso_') == '1') { ?>
                    <li id="asignacion_abogados"><a href="<?php echo base_url();?>reportes/asignacion_de_abogados">Asignación de abogados</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_gestion_judicial_mensual_permiso_') == '1' ) { ?>
                    <li id="gestion_extrajudicial_mensual"><a href="<?php echo base_url();?>reportes/gestion_extrajudicial_mensual">Gestión extrajudicial mensual</a></li>
                    <?php } ?>
                    
                   <?php  if( $this->session->userdata('Rep_gestion_judicial_mensual_permiso_') == '1' ) { ?>
                    <li id="InformeGestores"><a href="<?php echo base_url();?>reportes/InformeGestores">Gestión Gestores de Recuperación</a></li>
                    <?php } ?>
                    
                    <?php if( $this->session->userdata('Rep_subrogaciones_efectivas_permiso_') == '1' ) { ?>
                    <li id="LIsubrogaciones_"><a href="<?php echo base_url();?>reportes/subrogaciones_efectivas">Subrogaciones efectivas</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_soporte_cisa_permiso_') == '1' ) { ?>
                    <li id="LiSoptreCisa"><a href="<?php echo base_url();?>reportes/soporte_cisa">Soporte CISA</a></li>
                    <?php } ?>
                </ul>

            </li>
            <?php } ?>

            <?php if($this->session->userdata('Rep_radicacion_memorial_permiso_') == '1' || $this->session->userdata('Rep_gestion_judicial_permiso_') == '1' ) { ?>
            <li id="LIreportes2"  class="treeview">
                <a href="#">
                   <i class="fa fa-file-excel-o"></i><span>     Informes abogados</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                   
                    <?php  if( $this->session->userdata('Rep_radicacion_memorial_permiso_') == '1' ) { ?>
                    <li id="LIradicacionMemoriales"><a href="<?php echo base_url();?>reportes/radicacion_memoriales_subrogaciones">Radicación memoriales subrogación</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_gestion_judicial_permiso_') == '1' ) { ?>
                    <li id="LIJudicialesEsta"><a href="<?php echo base_url();?>reportes/Judiciales">Gestión judicial </a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_reporte_medidas_cautelares_permiso_') == '3' ) { ?>
                    <li id="LIHmedidas"><a href="#">Reporte de medidas cautelares prácticadas.</a></li>
                    <?php } ?>
                </ul>

            </li>
            <?php } ?>

            <?php  if( $this->session->userdata('Rep_medidas_cautelares_efectivas_permiso_') == '3' ) { ?>
            <li id="LIreportes3"  class="treeview">
                <a href="#">
                  <i class="dropdown-toggle" data-toggle="dropdown"></i> <span>Informe gerencial</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <?php  if( $this->session->userdata('Rep_medidas_cautelares_efectivas_permiso_') == '3' ) { ?>
                    <li id="LIHjudicial"><a href="#">Reporte de medidas cautelares efectivas</a></li>
                    <?php } ?>
                    
                </ul>

            </li>
            <?php } ?>

           


            <!--<li id="LIutilidades">
                <a href="#">
                  <i class="fa fa-money"></i> <span>UTILIDADES</span>
                </a>
            </li>-->
        </ul>
    </section>
  <!-- /.sidebar -->
</aside>
<script type="text/javascript">
  $(document).ready(function(){
  $("ul#listaConfiguraciones li").sort(sort_ascending).appendTo('ul#listaConfiguraciones');
 
  function sort_ascending(a, b) {
    return ($(b).text()) < ($(a).text()) ? 1 : -1;       
  }
});
   
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
