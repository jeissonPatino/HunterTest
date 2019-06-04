
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar sidebar-collapse">
      <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo utf8_encode($this->session->userdata('nombres')); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Menú Principal</li>

            <?php if($this->session->userdata('USUARI_asignacion_abogados_p') == '1' || $this->session->userdata('USUARI_asignacion_gestores_p') == '1') { ?>
            <li id="ULasignacion" class="treeview ">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>ASIGNACIÓN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata('USUARI_asignacion_abogados_p') == '1'){ ?>
                    <li id="LIabogados"><a href="<?php echo base_url();?>asignacion/abogadosFrg"><i class="fa fa-circle-o"></i>ABOGADOS</a></li>
                    <?php } 
                    if($this->session->userdata('USUARI_asignacion_gestores_p') == '1'){
                    ?>   
                    <li id="LIgestores"><a href="<?php echo base_url();?>asignacion/gestores"><i class="fa fa-circle-o"></i>GESTORES</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('tpo_usuario') == 'FNG') { ?>
        
                    <li id="LIabogadosSuer"><a href="<?php echo base_url();?>asignacion/supercargueFNG"><i class="fa fa-circle-o"></i>ASIGNACION ABOGADOS TOTAL</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            




            <?php  if($this->session->userdata('USUARI_configuracion_abogados_p') == '1' || $this->session->userdata('USUARI_configuracion_actuaciones_p') == '1' || $this->session->userdata('USUARI_configuracion_acuerdos_p') == '1' || $this->session->userdata('USUARI_configuracion_ciudades_p') == '1' || $this->session->userdata('USUARI_configuracion_salario_p') == '1' || $this->session->userdata('USUARI_configuracion_despachos_p') == '1' || $this->session->userdata('USUARI_configuracion_etapas_p') == '1' || $this->session->userdata('USUARI_configuracion_facturas_p') == '1' || $this->session->userdata('USUARI_configuracion_gastos_p') == '1' || $this->session->userdata('USUARI_configuracion_FRG_p') == '1' || $this->session->userdata('USUARI_configuracion_subgestiones_p') == '1' || $this->session->userdata('USUARI_configuracion_usuarios_p') == '1' || $this->session->userdata('firmas_abogados_permiso_') == '1' || $this->session->userdata('configurar_valores_conceptos_permisos_') == '1' || $this->session->userdata('cargar_subrogaciones_permisos_') == '1' ) { ?>
            <li id="ULconfiguracion" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>CONFIGURACIÓN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata('USUARI_configuracion_abogados_p') == '1') { ?>
                    <li id="LIabgadosAux"><a href="<?php echo base_url();?>auxiliar/Abogados"><i class="fa fa-circle-o"></i>ABOGADOS</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('firmas_abogados_permiso_') == '1') { ?>
                    <li id="LIfirmas"><a href="<?php echo base_url();?>auxiliar/firmas_abogados"><i class="fa fa-circle-o"></i>FIRMAS DE ABOGADO</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('USUARI_configuracion_actuaciones_p') == '1') { ?>
                    <li id="LIactuaciones"><a href="<?php echo base_url();?>auxiliar/Actuaciones"><i class="fa fa-circle-o"></i>ACTUACIONES</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_acuerdos_p') == '1') { ?>
                    <li id="LIacuerdos"><a href="<?php echo base_url();?>auxiliar/acuerdosPago"><i class="fa fa-circle-o"></i>ACUERDOS DE PAGO</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_ciudades_p') == '1') { ?>
                    <li id="LIciudades"><a href="<?php echo base_url();?>auxiliar/ciudades"><i class="fa fa-circle-o"></i>CIUDADES</a></li>
                    <!---->
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_salario_p') == '1') { ?>
                    <li id="LIsalario"><a href="<?php echo base_url();?>configuraciones/generales"><i class="fa fa-circle-o"></i><span>CONFIGURACIÓN SALARIO</span></a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_despachos_p') == '1') { ?>
                    <li id="LIdespacho"><a href="<?php echo base_url();?>auxiliar/despachos"><i class="fa fa-circle-o"></i>DESPACHOS</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_etapas_p') == '1') { ?>
                    <li id="LIetapas"><a href="<?php echo base_url();?>auxiliar/etapas"><i class="fa fa-circle-o"></i>ETAPAS</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_facturas_p') == '1') { ?>
                    <li id="LIfacturas"><a href="<?php echo base_url();?>auxiliar/facturas"><i class="fa fa-circle-o"></i>FACTURAS</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_gastos_p') == '1') { ?>
                    <li id="LIgastos"><a href="<?php echo base_url();?>auxiliar/gastos_judiciales"><i class="fa fa-circle-o"></i>FACTURAS GASTOS JUDICIALES</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_FRG_p') == '1') { ?>
                    <li id="LIfrg"><a href="<?php echo base_url();?>auxiliar/frg"><i class="fa fa-circle-o"></i>FRG</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_subgestiones_p') == '1') { ?>
                    <!--
                    <li id="LIif"><a href=""><i class="fa fa-circle-o"></i>IF</a></li>
                    
                    <li id="LImedidas"><a href=""><i class="fa fa-circle-o"></i>MEDIDAS CAUTELARES</a></li>
                    -->
                    <li id="LIsubgestiones"><a href="<?php echo base_url();?>auxiliar/subgestiones"><i class="fa fa-circle-o"></i>SUBGESTIONES</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_usuarios_p') == '1') { ?>
                        <li id="LIUsers"><a href="<?php echo base_url();?>configuraciones/crear_Users"><i class="fa fa-circle-o"></i>USUARIOS</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('USUARI_configuracion_usuarios_p') == '1') { ?>
                        <li id="LIreportesconfig"><a href="<?php echo base_url();?>configuraciones/reportes"><i class="fa fa-circle-o"></i>CONFIGURACIÓN INFORMES</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_configuracion_eliminarObligaciones_p') == '1') { ?>
                        <li id="LIeliminarObligacionnes"><a href="<?php echo base_url();?>configuraciones/obligaciones"><i class="fa fa-circle-o"></i>ELIMINAR OBLIGACIONES</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('configurar_valores_conceptos_permisos_') == '1' ) { ?>
                    <li id="LiValConceptos"><a href="<?php echo base_url();?>auxiliar/valores_conceptos_pagar"><i class="fa fa-circle-o"></i>CONCEPTOS Y VALORES A PAGAR</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('cargar_subrogaciones_permisos_') == '1' ) { ?>
                    <li id="LIGarantias"><a href="<?php echo base_url();?>Conceptos/cargar_subrogaciones"><i class="fa fa-circle-o"></i>CARGAR SUBROGACIONES</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('cargar_fecha_terminacion_permisos_') == '1' ) { ?>
                        <li id="LIFechaTer"><a href="<?php echo base_url();?>auxiliar/fechasEnvioTerminacion"><i class="fa fa-circle-o"></i>CARGAR F. ENVIO TERMINACIÓN</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('Eliminar_Facturas_permisos_') == '1' ) { ?>
                        <li id="LIELiminarFacturas"><a href="<?php echo base_url();?>auxiliar/eliminarFactura"><i class="fa fa-circle-o"></i>ELIMINAR FACTURAS</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('Exportar_datos_adicionales_permisos_') == '1' ) { ?>
                    <li id="LIExpo_datos_ad"><a href="<?php echo base_url();?>auxiliar/exportarDatosAdicionales"><i class="fa fa-circle-o"></i>DATOS ADICIONALES</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('Eliminar_Gestiones_judiciales_permisos_') == '1' ) { ?>
                    <li id="LIEliminarGetsiones"><a href="<?php echo base_url();?>auxiliar/getJudicialesForDelete"><i class="fa fa-circle-o"></i>ELIMINAR GESTIÓN JUDICIAL</a></li>
                    <?php } ?>
                    
                    <?php if($this->session->userdata('Eliminar_Gestiones_judiciales_permisos_') == '1' ) { ?>
                    <li id="LIEliminarGetsionesE"><a href="<?php echo base_url();?>auxiliar/getExtraJudicialesForDelete"><i class="fa fa-circle-o"></i>ELIMINAR GESTIÓN EXTRAJUDICIAL</a></li>
                    <?php } ?>

                    <?php if($this->session->userdata('tpo_usuario') == 'FNG') { ?>
                    <li id="LIutilidades"><a href="<?php echo base_url();?>utilidades/cambiarBotones"><i class="fa fa-circle-o"></i>CAMBIAR BOTONES</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('subrogacion_permiso_') == '1' || $this->session->userdata('Sentencia_irrecuperable_permiso_') == '1' || $this->session->userdata('cisa_permiso_') == '1' || $this->session->userdata('gastos_judiciales_permiso_') == '1') { ?>
            <li id="ULAUXILIARES" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>APLICACIÓN FACTURACIÓN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata('subrogacion_permiso_') == '1' ) { ?>
                    <li id="LIAux-subrogacion"><a href="<?php echo base_url();?>Conceptos/subrogacion"><i class="fa fa-circle-o"></i>SUBROGACIÓN</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('Sentencia_irrecuperable_permiso_') == '1' ) { ?>
                    <li id="LIAux-sentencias"><a href="<?php echo base_url();?>Conceptos/sentencia_irrecuperable"><i class="fa fa-circle-o"></i>SENTENCIA IRRECUPERABLE</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('cisa_permiso_') == '1' ) { ?>
                    <li id="LIAux-CISA"><a href="<?php echo base_url();?>Conceptos/cisa"><i class="fa fa-circle-o"></i>CISA</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('gastos_judiciales_permiso_') == '1' ) { ?>
                    <li id="LIAux-sentencias"><a href="<?php echo base_url();?>Conceptos/gastosJudiciales"><i class="fa fa-circle-o"></i>GASTOS JUDICIALES</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>


            <?php if($this->session->userdata('USUARI_gestion_extrajudicial_p') == '1' || $this->session->userdata('USUARI_gestion_judicial_p') == '1' || $this->session->userdata('USUARI_gestion_exfuncionarios_p') == '1') { ?>
            <li id="ULcartera" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>GESTIÓN CARTERA FNG</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if($this->session->userdata('USUARI_gestion_extrajudicial_p') == '1') { ?>
                    <li id="LIExtrajudicial"><a href="<?php echo base_url();?>Extrajudicial/"><i class="fa fa-circle-o"></i>GESTIÓN EXTRAJUDICIAL</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_gestion_judicial_p') == '1' ) { ?>
                    <li id="LIjudicial"><a href="<?php echo base_url();?>cartera_fng/"><i class="fa fa-circle-o"></i>GESTIÓN JUDICIAL</a></li>
                    <?php } ?>
                    <?php if($this->session->userdata('USUARI_gestion_exfuncionarios_p') == '1' ) { ?>
                    <li id="LIExfuncionarios"><a href="<?php echo base_url();?>Extrajudicial/Exfuncionarios"><i class="fa fa-circle-o"></i>EXFUNCIONARIOS</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('USUARI_historico_extrajudicial_p') == '1' || $this->session->userdata('USUARI_historico_judicial_p') == '1' || $this->session->userdata('USUARI_historico_medidas_p') == '1' ) { ?>
            <li id="ULhistorico" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>HISTÓRICOS</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php  if(  $this->session->userdata('USUARI_historico_extrajudicial_p') == '1') { ?>
                    <li id="LIHextrajudicial"><a href="<?php echo base_url();?>historicos/historicoExtraJudicial"><i class="fa fa-circle-o"></i>GESTIÓN EXTRAJUDICIAL</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('USUARI_historico_judicial_p') == '1' ) { ?>
                    <li id="LIHjudicial"><a href="<?php echo base_url();?>historicos/historicoJudicial"><i class="fa fa-circle-o"></i>GESTIÓN JUDICIAL</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('USUARI_historico_medidas_p') == '1' ) { ?>
                    <li id="LIHmedidas"><a href="<?php echo base_url();?>historicos/historicoMedidas"><i class="fa fa-circle-o"></i>GESTIÓN MEDIDAS CAUTELARES</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

            <?php if($this->session->userdata('tpo_usuario') == 'FNG') { ?>
            <li id="ULhistorico_SAP" class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>HISTÓRICOS SAP</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li id="LIHextrajudicial_SAP"><a href="<?php echo base_url();?>historicos/gestionExtrajudicial_SAP"><i class="fa fa-circle-o"></i>GESTIÓN EXTRAJUDICIAL SAP</a></li>
                    <li id="LIHjudicial_SAP"><a href="<?php echo base_url();?>historicos/historicoJudicial_SAP"><i class="fa fa-circle-o"></i>GESTIÓN JUDICIAL SAP</a></li>
                    <li id="LIHmedidas_SAP"><a href="<?php echo base_url();?>historicos/historicoMedidas_SAP"><i class="fa fa-circle-o"></i>GESTIÓN MEDIDAS CAUTELARES SAP</a></li>
                     <li id="LIHmedidas_SAP_SUPER"><a href="<?php echo base_url();?>historicos/superhistoricoSap"><i class="fa fa-circle-o"></i>GESTIÓN TOTAL SAP</a></li>
                </ul>
            </li>
            <?php } ?>
            
            <?php if($this->session->userdata('Rep_asignacion_abogados_permiso_') == '1' || $this->session->userdata('Rep_gestion_judicial_mensual_permiso_') == '1' || $this->session->userdata('Rep_subrogaciones_efectivas_permiso_') == '1' || $this->session->userdata('Rep_soporte_cisa_permiso_') == '1') { ?>
            <li id="LIreportes"  class="treeview">
                <a href="#">
                  <i class="fa fa-file-excel-o"></i> <span>INFORMES FRG</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <?php  if(  $this->session->userdata('Rep_asignacion_abogados_permiso_') == '1') { ?>
                    <li id="asignacion_abogados"><a href="<?php echo base_url();?>reportes/asignacion_de_abogados"><i class="fa fa-circle-o"></i>ASIGNACIÓN DE ABOGADOS</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_gestion_judicial_mensual_permiso_') == '1' ) { ?>
                    <li id="gestion_extrajudicial_mensual"><a href="<?php echo base_url();?>reportes/gestion_extrajudicial_mensual"><i class="fa fa-circle-o"></i>GESTIÓN EXTRAJUDICIAL MENSUAL</a></li>
                    <?php } ?>
                    <?php if( $this->session->userdata('Rep_subrogaciones_efectivas_permiso_') == '1' ) { ?>
                    <li id="LIsubrogaciones_"><a href="<?php echo base_url();?>reportes/subrogaciones_efectivas"><i class="fa fa-circle-o"></i>SUBROGACIONES EFECTIVAS</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_soporte_cisa_permiso_') == '1' ) { ?>
                    <li id="LiSoptreCisa"><a href="<?php echo base_url();?>reportes/soporte_cisa"><i class="fa fa-circle-o"></i>SOPORTE CISA</a></li>
                    <?php } ?>
                </ul>

            </li>
            <?php } ?>

            <?php if($this->session->userdata('Rep_radicacion_memorial_permiso_') == '1' || $this->session->userdata('Rep_gestion_judicial_permiso_') == '1' ) { ?>
            <li id="LIreportes2"  class="treeview">
                <a href="#">
                  <i class="fa fa-file-excel-o"></i> <span>INFORMES ABOGADOS</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                   
                    <?php  if( $this->session->userdata('Rep_radicacion_memorial_permiso_') == '1' ) { ?>
                    <li id="LIradicacionMemoriales"><a href="<?php echo base_url();?>reportes/radicacion_memoriales_subrogaciones"><i class="fa fa-circle-o"></i>RADICACIÓN MEMORIALES SUBROGACIÓN</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_gestion_judicial_permiso_') == '1' ) { ?>
                    <li id="LIJudicialesEsta"><a href="<?php echo base_url();?>reportes/Judiciales"><i class="fa fa-circle-o"></i>GESTIÓN JUDICIAL</a></li>
                    <?php } ?>
                    <?php  if( $this->session->userdata('Rep_reporte_medidas_cautelares_permiso_') == '3' ) { ?>
                    <li id="LIHmedidas"><a href="#"><i class="fa fa-circle-o"></i>Reporte de medidas cautelares prácticadas.</a></li>
                    <?php } ?>
                </ul>

            </li>
            <?php } ?>

            <?php  if( $this->session->userdata('Rep_medidas_cautelares_efectivas_permiso_') == '3' ) { ?>
            <li id="LIreportes3"  class="treeview">
                <a href="#">
                  <i class="fa fa-file-excel-o"></i> <span>INFORME GERENCIAL</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <?php  if( $this->session->userdata('Rep_medidas_cautelares_efectivas_permiso_') == '3' ) { ?>
                    <li id="LIHjudicial"><a href="#"><i class="fa fa-circle-o"></i>Reporte de medidas cautelares efectivas</a></li>
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
