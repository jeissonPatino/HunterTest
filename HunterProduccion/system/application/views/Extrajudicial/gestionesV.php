<section class="content-header">
    <h1>
        CARTERA FNG - CLIENTES NUEVOS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>extrajudicial">Cartera Fng</a></li>
        <li><a href="<?php echo base_url();?>extrajudicial/clientesNuevos">Cartera Fng - Clientes Nuevos</a></li>
     	<li class="active">Cartera Fng - Información Clientes nuevos</li>
    </ol>
</section>

<style type="text/css">
  a {
    cursor: pointer;
  }
  img {
  	width: 100px;
	height: 75px;
  }
</style>

<div class="modal fade" tabindex="-1" role="dialog" id="Modal-datos-extrajudicial">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="titulodeestaJoda"></h4>
            </div>
            <div class="modal-body" id="datosGestionExtraJudicial">
                
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<section class="content">
	<?php 

		if(isset($vista)){
			switch ($vista) {
				case '2':
				//viene de Clientes nuevos
					echo '<a href="'.base_url().'extraJudicial/clientesNuevos" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';	
					break;
				case '3':
				//viene de clientes con datos nuevos
					echo '<a href="'.base_url().'extraJudicial/clientesDatoNuevo" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '4':
				//viene de clientes con acuerdo de pago
					echo '<a href="'.base_url().'extraJudicial/clientesConacuerdodepago" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '5':
				//viene de clientes quince dias sin gestin
					echo '<a href="'.base_url().'extraJudicial/clientesSingestionquinceDias" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '6':
				//viene de mis clientes vigentes
					echo '<a href="'.base_url().'extraJudicial/misclientesVigentes" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '7':
				//viene de cartera exfuncionario
					echo '<a href="'.base_url().'extraJudicial/Exfuncionarios" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '8':
				//viene de Obligaciones Vendidas
					echo '<a href="'.base_url().'extraJudicial/ObligacinesVendidas" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '9':
				//viene de Paz y salvo
					echo '<a href="'.base_url().'extraJudicial/PazySalvo" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;

				case '10':
				//viene de Paz y salvo
					echo '<a href="'.base_url().'extraJudicial/busquedaAvanzada" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
					break;
					
			}
		}else{
			//viene de Clientes nuevos
			echo '<a href="'.base_url().'extraJudicial/clientesNuevos" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';
		}
		
	?>
	
	<div class="box box-solid">
	    <div class="box-body">
			<div class="panel box box-primary">

				<div class="box-header with-border">
					<h4 class="box-title">
						<a>
							DATOS PERSONALES
						</a>
					</h4>
				</div>
				<div id="collapseDatos" >
					<div class="box-body">
	<?php
		$cliente_int_b = 0;
		foreach ($cliente as $key) { ?>
						<div class="row-fluid">
									
							<div class="col-md-12"> 
								<div class="row">

									<div class="col-md-3">
										<div class="form-group">
					                      	<label for="TxtNombreDeudor">Nombre deudor</label>
					                    </div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->Deudor);?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtIdentificacion">No. Identificación</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->identificacion;?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtDireccion">Dirección domicilio</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->DireccionD;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCiudad">Ciudad domicilio</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->ciudadD);?>
									</div>
								</div>



								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtTelfonoD">Teléfono domicilio</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->TelefonoD;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtelefonoO">Teléfono oficina</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->TelefonoO;?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtCelular">Celular</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->Celular;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCelulara">Celular adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->CelularA;?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtMail">Correo electrónico</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->Mail;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtNumero">No. de obligaciones deudor</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->Nobligaciones;?>
									</div>
								</div>
							</div>
							
						</div>
	<?php }	?>		
					</div>
				</div>
			</div>
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							OBLIGACIONES
						</a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse">
					<div class="box-body">
						<div row="row-fluid">
							<div class="col-md-2">
								<table class="table table-hover table-bordered" id="RowContrato">
									<thead>
										<th>N° Obligacion</th>
									</thead>
									<tbody>
										<?php
											foreach ($contratos as $contrato) {
												echo "<tr><td style='cursor:pointer;' contrato ='".$contrato->No_CONTRATO."'>".$contrato->OBLIGACION."</td></tr>";
											}
										?>
									</tbody>
								</table>
								
							</div>
							<div class="col-md-10">
								<div class="panel box box-primary">
									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOneOne">
												DATOS OBLIGACION
											</a>
										</h4>
									</div>
									<div id="collapseOneOne" class="panel-collapse ">
										<div class="box-body">
											<div class="row-fluid">
												<div class="col-md-12">
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">No. Contrato</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtNumeroContrato" >
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">Valor pagado</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtValorPagado">
															
														</div>
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">Fecha de pago de la garantía</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtFechagarantia" >
															
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="txtNumero">Intermediario financiero</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtIntermediarioF" >
															
														</div>
														
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">Cobertura</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtCobertura">
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtNumero">Judicializable</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtJudicial">
															
														</div>
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">FRG</label>
										                 	</div>
														</div>
														<div class="col-md-3"  id="txtFrg" >
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">No. de proceso judicial SAP</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtSap">
															
														</div>
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtNumero">Despacho judicial</label>
										                 	</div>
														</div>
														<div class="col-md-3"  id="txtDespacho" >
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">Clase de proceso</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtClase">
															
														</div>
													</div>


													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">Estado del proceso</label>
										                 	</div>
														</div>
														<div class="col-md-3"  id="txtEstado" >
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label for="txtNumero">Rol</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtRol">
															
														</div>
													</div>



												</div>
											</div>
										  	

											<div class="row-fluid" id="campos" style="display:none;" style="text-align:center;">
				
												
												<div class="col-md-3">
													<a href="#"  data-toggle="modal" data-target="#Modal-Menu-Extrajudicial" >
								        				<img src="<?php echo base_url();?>assets/img/gestionExtrajudicial.png" style=" width: auto; height: auto;" id="logoHunter">
								        			</a>
												</div>
												
												<div class="col-md-3">
													<a href="#" data-toggle="modal" data-target="#Modal-Simulador">
								        				<img src="<?php echo base_url();?>assets/img/simulador.png" style=" width: auto; height: auto;" id="logoHunter">
								        			</a>
												</div>

												<div class="col-md-3">
													<a href="#" id="gestionJudicial" >
								        				<!--<img src="<?php //echo base_url();?>assets/img/botones/Extrajudicial/todasObligaciones.png" style=" width: auto; height: auto;" id="logoHunter">-->
								        			</a>
												</div>

												<div class="col-md-3">
													<a href="<?php echo base_url();?>assets/libreto/LIBRETO_CALL_CENTER.pdf" target="_blank">
								        				<img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/libretoCallCenter.png" style=" width: auto; height: auto;" id="logoHunter">
								        			</a>
												</div>

											</div>
											
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsetwo">
												HISTORICO GESTION EXTRAJUDICIAL
											</a>
										</h4>
									</div>
									<div id="collapsetwo" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											<table class="table table-hover table-bordered" id="tblHistoricoExtrajudicial">
												<thead>
													<tr>
														<th>Cliente Gestionado</th>
														<th>Medio Comunicación</th>
														<th>Resultado Comunicación</th>
														<th>Gestión</th>
														<th>Subgestión</th>
														<th>Observaciones</th>
														<th>Ejecutor</th>
														<th>Fecha Ejecución</th>
														<th>Hora Ejecución</th>
													</tr>
												</thead>
												<tbody id="tablaExtraJudicial">

												</tbody>
												
											</table>
										</div><!-- /.box-body -->
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsethree">
												HISTORICO GESTION JUDICIAL
											</a>
										</h4>
									</div>
									<div id="collapsethree" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											<table class="table table-hover table-bordered" id="tblHistoricoJudicial">
												<thead>
													<tr>
														<th>Tipo de proceso	</th>
														<th>Fecha de informe</th>
														<th>Etapa</th>
														<th>Actuación</th>
														<th>Fecha de trámite</th>
														<th>Observaciones</th>
														<th>Ejecutor</th>
													</tr>
												</thead>
												<tbody id="tablaJudicial">

												</tbody>
												
											</table>
										</div><!-- /.box-body -->
									</div>


									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsefour">
												HISTORICO GESTION MEDIDAS
											</a>
										</h4>
									</div>
									<div id="collapsefour" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
										  	<table class="table table-hover table-bordered" id="tblHistoricoMedidas">
												<thead>
													<tr>
														<th>Fecha Informe</th>
														<th>Medida Cautelar</th>
														<th>Fecha Solicitud</th>
														<th>Fecha Decreto</th>
														<th>Fecha Práctica</th>
														<th>Secuestre</th>
													</tr>
												</thead>
												<tbody id="tablaMedidas">

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsefive">
												CODEUDORES
											</a>
										</h4>
									</div>
									<div id="collapsefive" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
										  	<table class="table table-hover table-bordered">
												<thead>
													<tr>
														<th>N° Obligaciones</th>
														<th>Detalle Obligaciones Asociadas</th>
														<th>Nombre</th>
														<th>Identificación</th>
													</tr>
												</thead>
												<tbody id="tablaCodeudores">

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
												ACUERDOS DE PAGO
											</a>
										</h4>
									</div>
									<div id="collapseSix" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
										  	<table class="table table-hover table-bordered" id="tblAcuerdoPago">
												<thead>
													<tr>
														<th>Fecha consignación anticipo</th>
														<th>Fecha de legalización</th>
														<th>Valor del acuerdo</th>
														<th>Plazo acuerdo de Pago</th>
														<th>Valor cuota del acuerdo</th>
														<th>Fecha de pago de la primera cuota</th>
														<th>Fecha liquidación</th>
														<th>Fecha de pago de la ultima cuota</th>
														<th>Tasa de interes</th>
													</tr>
												</thead>
												<tbody id="tablaAcuerdosPago">

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseSven">
												GARANTIAS - PAGARÉS
											</a>
										</h4>
									</div>
									<div id="collapseSven" class="panel-collapse collapse ">
										<div class="box-body">
										  	<table class="table table-hover table-bordered" id="tblGarantiaPagare">
												<thead>
													<tr>
														<th>N° Garantia</th>
														<th>N° Pagare</th>
													</tr>
												</thead>
												<tbody id="tablaGarantiaPagares">

												</tbody>
												
											</table>
										</div>
									</div>


									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseEigth">
												FACTURAS
											</a>
										</h4>
									</div>
									<div id="collapseEigth" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
										  	<table class="table table-hover table-bordered" id="tblFacturas">
												<thead>
													<tr>
														<th>N° DE FACTURA AUTO DE SUBROGACIÓN</th>
														<th>FECHA DE FACTURA AUTO DE SUBROGACIÓN</th>
														<th>FECHA AUTO DE SUBROGACIÓN</th>
														<th>No. DE FACTURA SENTENCIA IRRECUPERABLE</th>
														<th>FECHA SENTENCIA IRRECUPERABLE</th>
														<th>FECHA DE FACTURA SENTENCIA IRRECUPERABLE</th>
														<th>FECHA LIQUIDACIÓN CRÉDITO</th>
														<th>FECHA AUTO IRRECUPERABLE</th>
														<th>SOPORTE</th>
														<th>VALOR FACTURADO AUTO DE SUBROGACIÓN</th>
														<th>FECHA FACTURA SOPORTES CISA</th>
														<th>VALOR FACTURADO SENTENCIA IRRECUPERABLE</th>
														<th>VALOR FACTURADO SOPORTES CISA</th>
														<th>RENUNCIA Y PAZ Y SALVO O CESIÓN</th>
														<th>No. CONTRATO</th>
														<th>HONORARIOS VENTA CISA</th>
														<th>No. FACTURA HONORARIOS VENTA CISA</th>
														<th>FECHA DE FACTURA HONORARIOS VENTA CISA</th>
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
												INFORMACIÓN JUDICIAL
											</a>
										</h4>
									</div>
									<div id="collapseNine" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"><label>Radicado o expediente</label> </div>
										  		<div class="col-md-3" id="RedicadoExpediente"> </div>
										  		<div class="col-md-3"><label>Fecha demanda</label> </div>
										  		<div class="col-md-3"  id="Fecchademanda"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha admisión demanda</label> </div>
										  		<div class="col-md-3" id="fechaadmiciondenabda"> </div>
										  		<div class="col-md-3"><label>Fecha mandamiento de pago</label> </div>
										  		<div class="col-md-3" id="fechamandamientoPago"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Total gastos judiciales</label> </div>
										  		<div class="col-md-3"  id="totalGastosJudicales"> </div>
										  		<div class="col-md-3"> </div>
										  		<div class="col-md-3"> </div>
										  	</div>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTen">
												INFORMACIÓN ABOGADO
											</a>
										</h4>
									</div>
									<div id="collapseTen" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"><label>Abogado</label> </div>
										  		<div class="col-md-3" id="abogadoCarajo"> </div>
										  		<div class="col-md-3"><label>Fecha asignación abogado</label> </div>
										  		<div class="col-md-3"  id="fechaAsignacionabogado"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"   ><label>No. Póliza</label> </div>
										  		<div class="col-md-3" id="NumeroPoliza"> </div>
										  		<div class="col-md-3"  ><label>Fecha de aprobación de póliza</label> </div>
										  		<div class="col-md-3" id="fechaaprovaciondelapoliza"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha de vencimiento</label> </div>
										  		<div class="col-md-3"  id="fechadevencimientocarajo"> </div>
										  		<div class="col-md-3"> </div>
										  		<div class="col-md-3"> </div>
										  	</div>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">
												PAZ Y SALVO / VENTA
											</a>
										</h4>
									</div>
									<div id="collapseEleven" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Fecha de expedición del paz y salvo</label> </div>
										  		<div class="col-md-3" id="fechapazysalvo"> </div>
										  		<div class="col-md-3"  ><label>Paz y salvo</label> </div>
										  		<div class="col-md-3" id="pazysalvo"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha venta</label> </div>
										  		<div class="col-md-3"  id="fechadeventacarajos"> </div>
										  		<div class="col-md-3"> </div>
										  		<div class="col-md-3"> </div>
										  	</div>
										</div>
									</div>

									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve">
												SUBROGACIÓN
											</a>
										</h4>
									</div>
									<div id="collapseTwelve" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Fecha envío memorial de subrogación al FRG</label> </div>
										  		<div class="col-md-3" id="fechaenviomemorial"> </div>
										  		<div class="col-md-3"  ><label>Fecha devolución FRG memorial de subrogación por errores</label> </div>
										  		<div class="col-md-3" id="fechadevolocionmemorial"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha envío memorial de subrogación corregido</label> </div>
										  		<div class="col-md-3"  id="fechaenviomemeorialcorregido"> </div>
										  		<div class="col-md-3"><label>Fecha radicación memorial</label>   </div>
										  		<div class="col-md-3" id="fecharedicacionMemorial"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Fecha pronunciamiento</label> </div>
										  		<div class="col-md-3" id="fechapronunciamiento"> </div>
										  		<div class="col-md-3"  ><label>Decisión</label> </div>
										  		<div class="col-md-3" id="decision"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha impugnación</label> </div>
										  		<div class="col-md-3"  id="fechaimpugnacion"> </div>
										  		<div class="col-md-3"><label>Nombre clase de impugnación</label></div>
										  		<div class="col-md-3" id="nombreclaseimpugnacion"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Decisión final</label> </div>
										  		<div class="col-md-3" id="decicionfinal"> </div>
										  		<div class="col-md-3"  > </div>
										  		<div class="col-md-3" > </div>
										  	</div>
										  	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen">
							DATOS ADICIONALES
						</a>
					</h4>
				</div>
				<div id="collapseThirteen" class="panel-collapse collapse">
					<div class="box-body">
						<button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
						</br>
						</br>
						<table class="table table-hover" id="tabladatos_Extras">
							<thead>
								<tr>
									<th>TELEFONO</th>
									<th>DIRECCIÓN</th>
									<th>CIUDAD</th>
									<th>CORREO ELECTRONICO</th>
									<th>CALIFICACIÓN</th>
									<th>DESCRIPCIÓN</th>
									<th>FECHA</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($datosadicionales as $key) {
										echo '  <td>'.$key->Telefono.'</td>
												<td>'.$key->Direccion.'</td>
												<td>'.$key->Ciudad.'</td>
												<td>'.$key->Correo_electronico.'</td>
												<td>'.$key->Calificacion.'</td>
												<td>'.$key->Descripcion.'</td>
												<td>'.$key->Fecha.'</td>';
									}
								?>
							</tbody>
						</table>
				  		
					</div>
				</div>
			</div>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->


<div class="modal fade" tabindex="-1" role="dialog" id="Modal-Menu-Extrajudicial">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" >Gestión ExtraJudicial</h4>
            </div>
            <div class="modal-body" >
            	<div class="nav-tabs-custom">
	                <!-- Tabs within a box -->
	                <ul class="nav nav-tabs pull-left">
	              		<li class="active"><a id="tab1" href="#revenue-chart" data-toggle="tab">Que quieres hacer</a></li>
                  		<li><a id="tab2" href="#revenue-chart2" data-toggle="">Localizado o Ilocalizado</a></li>
           			    <li><a id="tab3" href="#revenue-chart3" data-toggle="">Gestiones</a></li>
           			    <li><a id="tab4" href="#revenue-chart4" data-toggle="">subgestiones</a></li>
	                </ul>
	                <div class="tab-content no-padding">
	                  	<!-- Morris chart - Sales -->
	                  	<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: auto;">
	                  		<div class="row">
	                  			<div class="col-md-2">

	                  			</div>
	                  			<div class="col-md-8">
	                  				<div class="form-group">
	                  					<label>Deudor</label>
	                  					<select class="form-control" id="SelDeudores">

	                  					</select>
	                  				</div>
	                  			</div>
	                  			<div class="col-md-2">

	                  			</div>
	                  		</div>
	                  		<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	                  		<div class="row" id="opcionesDeudor" style="display:none;">
	                  			<div class="col-md-3">
	                  				<a  onclick="javascript: getdatosTab1(1792);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/llamar.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
	                  			</div>
	                  			<div class="col-md-3">
	                  				<a  onclick="javascript: getdatosTab1(1793);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/reunion.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
	                  			</div>
	                  			<div class="col-md-3">
	                  				<a  onclick="javascript: getdatosTab1(1794);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/correo.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
	                  			</div>

	                  			<div class="col-md-3">
	                  				<a  onclick="javascript: getdatosTab1(1795);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/visita.png" style=" width: 100%; height: auto;" id="logoHunter"></a>
	                  			</div>
	                  		</div>
	                  		<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	                  		<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	            		</div>

	            		<div class="chart tab-pane" id="revenue-chart2" style="position: relative; height: auto;">
	            			<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	            			<div class="row" >
	                  			<div class="col-md-3">
	                  				&nbsp;
	                  			</div>
	                  			<div class="col-md-3">
	                  				<a  onclick="javascript: getdatosTab2(1780);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/localizado.png" style=" width: 100%; height: 100px;" id="logoHunter"></a>
	                  			</div>
	                  			<div class="col-md-3">
	                  				<a  onclick="javascript: getdatosTab2(1781);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/ilocalizado.png" style=" width: 100%; height: 100px;" id="logoHunter"></a>
	                  			</div>
	                  			<div class="col-md-3">
	                  				&nbsp;
	                  			</div>
	                  		</div>

	                  		<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>

	                  		<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	            		</div>

	            		<div class="chart tab-pane" id="revenue-chart3" style="position: relative; height: auto;">
	            			<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	            			<div class="row" id="localizado" style="display:none;">
	                  			<div class="col-md-3">
	                  				<a  onclick="javascript: getdatosTab3(1782);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/con_intencion_pago.png" style=" width: 100%; height: 100px;" id="logoHunter"></a>
	                  			</div>
	                  			<div class="col-md-3">
	                  				<a onclick="javascript: getdatosTab3(1783);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/sin_intencion_pago.png" style=" width: 100%; height: 100px;" id="logoHunter"></a>
	                  			</div>
	                  			<div class="col-md-3">
	                  				<a onclick="javascript: getdatosTab3(1784);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/caso_especial.png" style=" width: 100%; height: 100px;" id="logoHunter"></a>
	                  			</div>
	                  			<div class="col-md-3">
	                  				<a onclick="javascript: getdatosTab3(1785);"><img src="<?php echo base_url();?>assets/img/botones/Extrajudicial/mensaje.png" style=" width: 100%; height: 100px;" id="logoHunter"></a>
	                  			</div>
	                  		</div>

	                  		<div class="row" id="Ilocalizadosqui" style="display:none;">
	                  			<div class="col-md-4" id="IlocalizadosquiGestiones">
	                  				Subgestiones :*
	                  			</div>
	                  			<div class="col-md-8">
	                  				<div class="form-group">
	                  					<label for="txtObservaciones">Observaciones</label>
	                  					<textarea class="form-control" id="txtObservacionesExtrajudiciales2"></textarea>
	                  				</div>
	                  				<button class="btn" data-toggle="modal" data-target="#Modal-tareas">Agregar Nueva Tarea</button>
	                  			</div>
	                  		</div>
	                  		<div class="row" id="Ilocalizado2" style="display:none;">
	                  			<div class="col-md-4">
	                  				<button class="btn" id="btnguardarSaltandoUltimo">Guardar</button>
	                  			</div>
	                  			<div class="col-md-8">
	                  				
	                  			</div>
	                  		</div>
	                  		<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>

	                  		<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	            		</div>

	            		<div class="chart tab-pane" id="revenue-chart4" style="position: relative; height: auto;">
	            			<div class="row" >
	                  			<div class="col-md-12">
	                  				&nbsp;
	                  			</div>
	              
	                  		</div>
	            			<div class="row" >
	                  			<div class="col-md-7" id="subgestionesFinales">
	                  				Subgestiones :*
	                  			</div>
	                  			<div class="col-md-5">
	                  				<div class="form-group">
	                  					<label for="txtObservaciones">Observaciones</label>
	                  					<textarea class="form-control" id="txtObservacionesExtrajudiciales"></textarea>
	                  				</div>
	                  				<button class="btn" data-toggle="modal" data-target="#Modal-tareas">Agregar Nueva Tarea</button>
	                  			</div>
	                  		</div>
	                  		<div class="row">
	                  			<div class="col-md-4">
	                  				<button class="btn" id="btnGuardarExtrajudicial">Guardar</button>
	                  			</div>
	                  			<div class="col-md-8">
	                  				
	                  			</div>
	                  		</div>
	            		</div>
	                </div>
	          	</div><!-- /.nav-tabs-custom -->	 
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<!-- /.modla para el simulador -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="Modal-Simulador">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Simulador</h4>
            </div>
            <div class="modal-body" >
                <div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseObligacciob">
							DATOS DE LA OBLIGACION
						</a>
					</h4>
				</div>
				<div id="collapseObligacciob" class="panel-collapse ">
					<div class="box-body">
						<?php foreach ($otrosDatos as $key) {
							echo '<div class="row">
						  		<div class="col-md-3"><label>Nombre del Deudor</label></div>
						  		<div class="col-md-3">'.$key->Deudor.'</div>
						  		<div class="col-md-3"><label>Numero de Identificación</label></div>
						  		<div class="col-md-3">'.$key->identificacion.'</div>
						  	</div>';
						  	
						}?>
					  	<div class="row">
					  		<div class="col-md-3"><label>Numero de Contrato</label></div>
					  		<div class="col-md-3" id='simularContrato'></div>
					  		<div class="col-md-3"><label>Intermediario Financiero</label></div>
					  		<div class="col-md-3" id="simuladorIntemediario"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fondo Administrador de Cartera</label></div>
					  		<div class="col-md-3" id="simuladorfondoCartera"></div>
					  		<div class="col-md-3"><label>Valor Pagado Por el FNG</label></div>
					  		<div class="col-md-3" id="simuladorValorPagadoFng"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fecha de Pago</label></div>
					  		<div class="col-md-3" id="simuladorFechaPago"></div>
					  		<div class="col-md-3"><label>Saldo Capital a la Fecha</label></div>
					  		<div class="col-md-3" id="simuladorSaldo"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fecha ultimo abono registrado</label></div>
					  		<div class="col-md-3" id="simuladorUltimoabono"></div>
					  		<div class="col-md-3"></div>
					  		<div class="col-md-3"></div>
					  	</div>
					</div>
				</div>

				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseEstado">
							ESTADO DE CUENTA PARA PAGO TOTAL
						</a>
					</h4>
				</div>
				<div id="collapseEstado" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><button class="btn btn-primary" id="calculoEstadoSimulador"> Calcular </button></div>
					  	</div>
					  	<div class="row">
					  		&nbsp;
					  	</div>
					  	<div class="row">
					  		<div class="col-md-6">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Fecha Liquidación</label>
										<div class="col-sm-8">
											<input type="text" class="form-control datemask1" value="<?php echo date("Y-m-d"); ?>" id="txtSimuladorFEchaLiquidacion">
										</div>
									</div>
								</form>
					  		</div>
					  		<div class="col-md-3"><label>Tasa de Mora</label></div>
					  		<div class="col-md-3" id="simuladorTasamora"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Intereses Moratorios</label></div>
					  		<div class="col-md-3" id="simuladorMoratorios"></div>
					  		<div class="col-md-3"><label>Saldo Capital</label></div>
					  		<div class="col-md-3" id="simuladSaldoCapital"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Gastos Judiciales</label></div>
					  		<div class="col-md-3" id="simuladorgastosJudiciales"></div>
					  		<div class="col-md-3"><label>Total a Pagar</label></div>
					  		<div class="col-md-3" id="TotalApagarSimulador"></div>
					  	</div>
					</div>
				</div>


				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseAcuerdoPago">
							CONDICIONES PARA REALIZAR ACUERDO DE PAGO
						</a>
					</h4>
				</div>
				<div id="collapseAcuerdoPago" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><button class="btn btn-primary" id="btnCalcular2Simulador"> Calcular </button></div>
					  	</div>
					  	<div class="row">
					  		&nbsp;
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Valor Anticipo</label></div>
					  		<div class="col-md-3" id="anticipoSimulador"></div>
					  		<div class="col-md-6">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Porcentaje Anticipo</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="10" id="txtPorcentajeSmulador">
										</div>
									</div>
								</form>
							</div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Fecha Limite de Pago</label></div>
					  		<div class="col-md-3" id="fechaLimitePagoLiquidacion"></div>
					  		<div class="col-md-3"><label>Monto de Capital a Diferir</label></div>
					  		<div class="col-md-3" id="MontocapitalDiferirSimulador"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Monto de Intereses</label></div>
					  		<div class="col-md-3" id="interecescalcluloSimulador"></div>
					  		<div class="col-md-3"><label>Saldo para amortizar</label></div>
					  		<div class="col-md-3" id="saldoadiferirSimulador"></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>Valor Cuotas</label></div>
					  		<div class="col-md-3" id="valordelascuotasSimulador"></div>
					  		<div class="col-md-6">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Numero de Cuotas</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="10" id="txtNumeroCuotas">
										</div>
									</div>
								</form>
							</div>
					  	</div>
					</div>
				</div>

				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseAbogado">
							HONORARIOS ABOGADO
						</a>
					</h4>
				</div>
				<div id="collapseAbogado" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><button class="btn btn-primary" id="btnCalcularAbogado"> Calcular </button></div>
					  	</div>
					  	<div class="row">
					  		&nbsp;
					  	</div>
					  	<div class="row">
					  		<div class="col-md-7">
					  			<form class="form-horizontal">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Porcentaje Honorarios</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value='10' id="txtHonorariosSimulador">
										</div>
									</div>
								</form>
					  		</div>
					  		<div class="col-md-3"><label>Valor Honorarios</label></div>
					  		<div class="col-md-2" id="valorHonorarios"></div>
					  	</div>
					</div>
				</div>

				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapsePAGO">
							DATOS PARA REALIZAR EL PAGO
						</a>
					</h4>
				</div>
				<div id="collapsePAGO" class="panel-collapse collapse ">
					<div class="box-body">
					  	<div class="row">
					  		<div class="col-md-3"><label>BANCO</label></div>
					  		<div class="col-md-3"><label>Bancolombia</label></div>
					  		<div class="col-md-3"><label>CONVENIO N°</label></div>
					  		<div class="col-md-3"><label>53821</label></div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-3"><label>TITULAR DE LA CUENTA</label></div>
					  		<div class="col-md-3"><label>Fondo Nacional de Garantías S.A.</label></div>
					  		<div class="col-md-3"><label>NUMERO DE REFERENCIA</label></div>
					  		<div class="col-md-3" id="referenciaCOntratop"></div>
					  	</div>
					</div>
				</div>

			</div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<div class="modal fade" tabindex="-1" role="dialog" id="Modal-Menu">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="">Gestión Judicial</h4>
            </div>
            <div class="modal-body" >
            	<div>
	        		<button class="btn btn-primary" data-toggle="modal" data-target="#Modal-Medidas" >Registrar Medida</button>
	        		<br><br>
	        	</div>
        		
                <div class="row">
                	<div class="col-md-1" >

                	</div>
                    <div class="col-md-10" >
                    	<div class="nav-tabs-custom">
			                <!-- Tabs within a box -->
			                <ul class="nav nav-tabs pull-left">
			              		<li class="active"><a id="getsionJudicialTab1" href="#gestionJudicial1" data-toggle="tab">Etapas</a></li>
			                 	<li><a id="getsionJudicialTab2" href="#gestionJudicial2" data-toggle="">Actuaciones</a></li>
			                </ul>
			                <div class="tab-content no-padding">
			                  	<!-- Morris chart - Sales -->
			                  	<div class="chart tab-pane active" id="gestionJudicial1" style="position: relative; height: auto;">
			                  		<p class="text-white alert-info" ><h2>Ejecutivo</h2></p>
			                  		<div class="row-fluid">
			                  			<div class="col-md-2">&nbsp;</div>
			                  			<div class="col-md-8">
											
			                  				<div class="row">
					                  			<div class="col-md-12">&nbsp;</div>
					                  		</div>
					                  		<div class="row">
					                      		<div class="col-md-4">
					                                <a onclick="javascript: getDatosWizard(1, 'Demanda');"><img src="<?php echo base_url();?>assets/img/botones/Demanda.png"></a>
					                            </div>
					                      			<div class="col-md-4">
					                                <a onclick="javascript: getDatosWizard('10', 'Embargo');"><img src="<?php echo base_url();?>assets/img/botones/Embargo.png"></a>
					                            </div>
					                      			<div class="col-md-4">
					                                <a onclick="javascript: getDatosWizard(11,'Secuestro');"><img src="<?php echo base_url();?>assets/img/botones/Secuestro.png"></a>
					                            </div>
					                      	
					                            
					                    	</div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-4">
					                                <a onclick="javascript: getDatosWizard(2, 'Notificación');"><img src="<?php echo base_url();?>assets/img/botones/Notificacion.png"></a>
					                            </div>
					                            <div class="col-md-4">
					                                <a   onclick="javascript: getDatosWizard(9, 'Liquidación de créditos y costas' );"><img src="<?php echo base_url();?>assets/img/botones/Liquidacion.png"></a>
					                            </div>

					                            <div class="col-md-4">
					                                <a   onclick="javascript: getDatosWizard(12, 'Avalúo');"><img src="<?php echo base_url();?>assets/img/botones/Avaluo.png"></a>
					                            </div>
					                           
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            

					                            <div class="col-md-4">
					                                <a onclick="javascript: getDatosWizard(3, 'Contestacion Demanda y/o excepciones');"><img src="<?php echo base_url();?>assets/img/botones/Contestacion_demanda.png"></a>
					                            </div>
					                            <div class="col-md-4">
					                                <a  onclick="javascript: getDatosWizard(8, 'Segunda Instancia');"><img src="<?php echo base_url();?>assets/img/botones/Segunda_Instancia.png"></a>
					                            </div>
					                            <div class="col-md-4">
					                                <a  onclick="javascript: getDatosWizard(13, 'Remate');"><img src="<?php echo base_url();?>assets/img/botones/Remate.png"></a>
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(4, 'Subrogacion');"><img src="<?php echo base_url();?>assets/img/botones/Subrogacion.png"></a>
					                            </div>
					                            
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(7, 'Sentencia');"><img src="<?php echo base_url();?>assets/img/botones/Sentencia.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(14, 'Impulso Procesal');"><img src="<?php echo base_url();?>assets/img/botones/Impulso_Procesal.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(17, 'Terminación');"><img src="<?php echo base_url();?>assets/img/botones/Terminacion.png"></a>
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                        	
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(5, 'Audiencia');"><img src="<?php echo base_url();?>assets/img/botones/Audiencia.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a onclick="javascript: getDatosWizard(6, 'Acuerdo Pago FNG');"><img src="<?php echo base_url();?>assets/img/botones/Acuerdo_Pago.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(15, 'Desistimiento Táctico');" ><img src="<?php echo base_url();?>assets/img/botones/Desistimiento_Tactico.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a  onclick="javascript: getDatosWizard(16, 'Venta de Cartera');"><img src="<?php echo base_url();?>assets/img/botones/Venta_Cartera.png"></a>
					                            </div>
					                        </div>
			                  			</div>
			                  		</div>
			                  		
			                    </div>
			                 
			                  	<div class="chart tab-pane" id="gestionJudicial2" style="position: relative; height: auto;">
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
		                  		 	<h4 class="modal-title" id="tituloModal"></h4>
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
			                  		<div class="row-fluid">
			                  			<div class="col-md-12">
			                  				<div class="row">
			                  					
							                    <div class="col-md-8" >
							                        <div class="form-group" id="modalBody">
							                            
							                        </div>
							                    </div>
							                    <div class="col-md-4">
							                        <!-- text input -->
							                        <div class="form-group">
							                            <label>Fecha Trámite*</label>
							                            <input type="text" class="form-control datemask1" id="txtFecha" placeholder="Fecha Tramite">
							                        </div>

							                        <div class="form-group">
							                            <label>Observaciones</label>
							                            <textarea class="form-control" rows="3" id="txtObservaciones" placeholder="Observaciones"></textarea>
							                        </div>
							                    </div>
							                </div>
							                <div class="row">

							                    <div class="col-md-9" >
							                        <div class="form-group" id="modalBody">
							                            
							                        </div>
							                    </div>
							                    <div class="col-md-3">
							                       <button class="btn btn-primary" id="GuardarBtn" type="button">Guardar</button>
							                    </div>
							                </div>
			                  			</div>
			                  		</div>
			                  	</div>
		                 	</div>
		                </div>
		            </div>
		        </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>





<div class="modal fade" tabindex="-1" role="dialog" id="Modal-tareas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" >Agregar Tareas</h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Que quieres hacer?</label>
                            <select class="form-control" id="gestionCombo">
                            	<option value="1792">Llamar</option>
                            	<option value="1793">Reunión</option>
                            	<option value="1794">Correo</option>
                            	<option value="1795">Visita</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Resumen de Datos Asociados</label>
                            <input type="text" readonly class="form-control" id="tareasEstaVaina">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Descripcion</label>
                            <textarea class="form-control" rows="3" id="txtDescripcion" placeholder="Descripcion"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Fecha Programada</label>
                            <input type="text" class="form-control especial" id="txtFechaPrgramdad" placeholder="Fecha Tramite">
                        </div>
                    </div>
                </div>

                 <div class="bootstrap-timepicker">
                	<div class="form-group">
                  		<label>Time picker:</label>
	                  	<div class="input-group">
		                    <input type="text" class="form-control timepicker" id="timepikerettx">
		                    <div class="input-group-addon">
		                      	<i class="fa fa-clock-o"></i>
		                    </div>
	                  	</div><!-- /.input group -->
	                </div><!-- /.form group -->
              	</div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
                <button class="btn btn-primary" id="GuardarBtnTarea" type="button">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<div class="modal fade" tabindex="3" role="dialog" id="Modal-Medidas">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="">Medidas Cautelares</h4>
            </div>
            <div class="modal-body" >
            	
                <div class="row">
                	<div class="col-md-1" >

                	</div>
                    <div class="col-md-10" >
                    	<div class="nav-tabs-custom">
			                <!-- Tabs within a box -->
			                <ul class="nav nav-tabs pull-left">
			              		<li class="active"><a id="getsionMedidas1" href="#medidas1" data-toggle="tab">Medidas</a></li>
			                 	<li><a id="getsionMedidas2" href="#medidas2" data-toggle="">Datos Medida</a></li>
			                </ul>
			                <div class="tab-content no-padding">
			                  	<!-- Morris chart - Sales -->
			                  	<div class="chart tab-pane active" id="medidas1" style="position: relative; height: auto;">
			                  		<p class="text-white alert-info" ><h2>Medida</h2></p>
			                  		<div class="row-fluid">
			                  			<div class="col-md-2">&nbsp;</div>
			                  			<div class="col-md-8">
											
			                  				<div class="row">
					                  			<div class="col-md-12">&nbsp;</div>
					                  		</div>
					                  		<div class="row">
					                      		<div class="col-md-3">
					                                <a onclick="javascript: getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoInmueble.png"></a>
					                            </div>
					                      			<div class="col-md-3">
					                                <a onclick="javascript: getMedidas(2);"><img src="<?php echo base_url();?>assets/img/medidas/embargoVehiculo.png"></a>
					                            </div>
				                      			<div class="col-md-3">
					                                <a onclick="javascript: getMedidas(3);"><img src="<?php echo base_url();?>assets/img/medidas/embargoEstabComercio.png"></a>
					                            </div>
					                      		<div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(4);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRetenSalario.png"></a>
					                            </div>
					            
					                    	</div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(5);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRetenCuentasAhCorr.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript: getMedidas(6);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRemanentes.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(7);"><img src="<?php echo base_url();?>assets/img/medidas/embargoSecuestroBienes.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(8);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRazonSocial.png"></a>
					                            </div>
					                           
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            

					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(9);"><img src="<?php echo base_url();?>assets/img/medidas/embargoMaqEquipo.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(10);"><img src="<?php echo base_url();?>assets/img/medidas/embargoAcciones.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(11);"><img src="<?php echo base_url();?>assets/img/medidas/embargoCuotasParticipacion.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(12);"><img src="<?php echo base_url();?>assets/img/medidas/embargoPosesion.png"></a>
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(13);"><img src="<?php echo base_url();?>assets/img/medidas/embargoCreditos.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(14);"><img src="<?php echo base_url();?>assets/img/medidas/embargoUsufructo.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(15);"><img src="<?php echo base_url();?>assets/img/medidas/embargoGarantiaInmob.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                               
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
			                  			</div>
			                  		</div>
			                  		
			                    </div>
			                 
			                  	<div class="chart tab-pane" id="medidas2" style="position: relative; height: auto;">
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
		                  		 	<h4 class="modal-title" id="tituloModal"></h4>
		                  		 	<div class="row">
			                  			<div class="col-md-12">&nbsp;</div>
			                  		</div>
									<form class="form-horizontal">
										<div class="form-group">
											<label for="txtSolicitudF" class="col-sm-2 control-label">Fecha Solicitud *</label>
											<div class="col-sm-10">
												<input type="text" class="form-control datemask1" id="txtSolicitudF" placeholder="Fecha Solicitud">
											</div>
										</div>
										<div class="form-group">
											<label for="txtDecretoF" class="col-sm-2 control-label">Fecha Decreto </label>
											<div class="col-sm-10">
												<input type="text" class="form-control datemask1" id="txtDecretoF" placeholder="Fecha Decreto">
											</div>
										</div>
										
										<div class="form-group">
											<label for="txtPracticaF" class="col-sm-2 control-label">Fecha Práctica </label>
											<div class="col-sm-10">
												<input type="text" class="form-control datemask1" id="txtPracticaF" placeholder="Fecha Práctica">
											</div>
										</div>
										<div class="form-group">
											<label for="txtSecuestro" class="col-sm-2 control-label">Secuestre </label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txtSecuestro" placeholder="Secuestre">
											</div>
										</div>
										<div class="form-group">
											<label for="txtOtroBien" class="col-sm-2 control-label">Otro Bien </label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="txtOtroBien" placeholder="Otro Bien">
											</div>
										</div>
										<div class="form-group">
											<label for="txtObservacionesFechas" class="col-sm-2 control-label">Observaciones</label>
											<div class="col-sm-10">
												<textarea class="form-control" id="txtObservacionesFechas" placeholder="Observaciones"></textarea>
											</div>
										</div>
									</form>
			                  		<div class="row-fluid">
			                  				
						                <div class="row">

						                    <div class="col-md-9" >
						                        <div class="form-group" id="modalBody">
						                            
						                        </div>
						                    </div>
						                    <div class="col-md-3">
						                       <button class="btn btn-primary" id="GuardarBtnMedidas" type="button">Guardar</button>
						                    </div>
						                </div>
			                  			
			                  		</div>
			                  	</div>
		                 	</div>
		                </div>
		            </div>
		        </div>
		    </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
 <!-- bootstrap time picker -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
var numeroContrato = 0;
var nombreContrato= '';
var comunicacion = 0;
var resultadocomunicacion = 0;
var gestion = 0;
var subgestion  = 0;
var etapa = 0;
var medidaCautelar = 0;


var interesxmora = 0;
var saldosimulador = 0;
var fachasimulador = '';
var simuladorFinalos = 0;
var valoragadoFNG = 0;
	
	fng = {
		codeudores : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getCodeudores/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaCodeudores").html(tablaExtraJudicial);
	    			$(".obligacionesHref").click(function(e){
	    				e.preventDefault();
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/detallesObligaciones/'+ $(this).attr('usuario'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("CODEUDORES");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});
	    		}

	    	});
		},

		judicial : function (varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getgestioJudicial/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			
	    			$("#tablaJudicial").html(tablaExtraJudicial);
	    			$(".judicalesTr").click(function(){
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/getDatosgestionJudicial/'+ $(this).attr('idcontrato'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("HISTORICO GESTION JUDICIAL");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});

	    			if($.fn.dataTable.isDataTable( '#tblHistoricoJudicial' )){
	    				console.log('es data table');
	    				$("#tblHistoricoJudicial").dataTable().fnDestroy();
	    			}

	    			var dataTableJudicial = $("#tblHistoricoJudicial").dataTable({
							"oLanguage": {
				                "sLengthMenu": "_MENU_ registros por pagina",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": "Siguiente",
							        "sPrevious": "Anterior"
						      	}
				            },
				           
				            "fnDrawCallback": function (oSettings, json) {
				               //Aqui va el comando para activar los otros botones
				               
				            },

				           "iDisplayLength": 10,
				           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
				    });
	
	    			



	    		}
	    	});
		},

		extrajudicial : function (varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getgestionExtrajudicial/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaExtraJudicial").html(tablaExtraJudicial);

	    			if($.fn.dataTable.isDataTable( '#tblHistoricoExtrajudicial' )){
	    				$("#tblHistoricoExtrajudicial").dataTable().fnDestroy();
	    			}


	    			var tblHistoricoExtrajudicial = $("#tblHistoricoExtrajudicial").DataTable({
							"oLanguage": {
				                "sLengthMenu": "_MENU_ registros por pagina",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": "Siguiente",
							        "sPrevious": "Anterior"
						      	}
				            },
				           
				            "fnDrawCallback": function (oSettings, json) {
				               //Aqui va el comando para activar los otros botones
				               
				            },

				           "iDisplayLength": 10,
				           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
				    });

	    			$(".extrajudicalesTr").click(function(){
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/getDatosgestionExtrajudicial/'+ $(this).attr('idcontrato'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("HISTORICO GESTION EXTRAJUDICIAL");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});
	    		}
	    	});
		},

		medidas : function (varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getTablaMedida/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaMedidas").html(tablaExtraJudicial);
	    			if($.fn.dataTable.isDataTable( '#tblHistoricoMedidas' )){
	    				$("#tblHistoricoMedidas").dataTable().fnDestroy();
	    			}


	    			var tblHistoricoMedidas = $("#tblHistoricoMedidas").DataTable({
							"oLanguage": {
				                "sLengthMenu": "_MENU_ registros por pagina",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": "Siguiente",
							        "sPrevious": "Anterior"
						      	}
				            },
				           
				            "fnDrawCallback": function (oSettings, json) {
				               //Aqui va el comando para activar los otros botones
				               
				            },

				           "iDisplayLength": 10,
				           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
				    });

	    			$(".medidasTr").click(function(){
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/getDatosMedidas/'+ $(this).attr('idcontrato'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("HISTORICO MEDIDAS CAUTELARES");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});

	    		}
	    	});
		},

		garantias : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getGarantias/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaGarantiaPagares").html(tablaExtraJudicial);
	    			$(".garantiaTr").click(function(){
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/getDatosGarantias/'+ $(this).attr('contrato'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("GARANTIAS Y PAGARÉS");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});
	    			if($.fn.dataTable.isDataTable( '#tblGarantiaPagare' )){
	    				$("#tblGarantiaPagare").dataTable().fnDestroy();
	    			}


	    			var tblGarantiaPagare = $("#tblGarantiaPagare").DataTable({
							"oLanguage": {
				                "sLengthMenu": "_MENU_ registros por pagina",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": "Siguiente",
							        "sPrevious": "Anterior"
						      	}
				            },
				           
				            "fnDrawCallback": function (oSettings, json) {
				               //Aqui va el comando para activar los otros botones
				               
				            },

				           "iDisplayLength": 10,
				           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
				    });
	    		}
	    	});
		},

		acuerdopago : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/gerAcuerdoPago/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaGarantiaPagares").html(tablaExtraJudicial);
	    			$(".acuerdoTr").click(function(){
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/getDatosAcuerdoDepago/'+ $(this).attr('idcontrato'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("ACUERDO DE PAGO");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});
	    			if($.fn.dataTable.isDataTable( '#tblAcuerdoPago' )){
	    				$("#tblAcuerdoPago").dataTable().fnDestroy();
	    			}


	    			var tblAcuerdoPago = $("#tblAcuerdoPago").DataTable({
							"oLanguage": {
				                "sLengthMenu": "_MENU_ registros por pagina",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": "Siguiente",
							        "sPrevious": "Anterior"
						      	}
				            },
				           
				            "fnDrawCallback": function (oSettings, json) {
				               //Aqui va el comando para activar los otros botones
				               
				            },

				           "iDisplayLength": 10,
				           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
				    });
	    		}
	    	});
		},

		facturas : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturas/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaFacturas").html(tablaExtraJudicial);

	    			$("#facturasTr").click(function(){
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ $(this).attr('idcontrato'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("FACTURAS");
				    			$("#datosGestionExtraJudicial").html(data);
				    			$("#Modal-datos-extrajudicial").modal();
				    		}
				    	});
	    			});
	    			if($.fn.dataTable.isDataTable( '#tblFacturas' )){
	    				$("#tblFacturas").dataTable().fnDestroy();
	    			}


	    			var tblFacturas =$("#tblFacturas").DataTable({
							"oLanguage": {
				                "sLengthMenu": "_MENU_ registros por pagina",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": "Siguiente",
							        "sPrevious": "Anterior"
						      	}
				            },
				           
				            "fnDrawCallback": function (oSettings, json) {
				               //Aqui va el comando para activar los otros botones
				               
				            },

				           "iDisplayLength": 10,
				           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
				    });
	    		}
	    	});
			
		},

		infoJudicial : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getinformacionJudicial/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			//$("#tablaFacturas").html(tablaExtraJudicial);

	    			$.each(tablaExtraJudicial, function(i, item) {
	    				$("#RedicadoExpediente").html(item.Radicado_o_expediente);
	    				var x = item.Fech_demanda;
	    				if(x){
	    					$("#Fecchademanda").html(x.split(' ')[0]);
	    				}
		    			
		    			var f = item.Fecha_admision_demanda;
		    			if(f){
		    				$("#fechaadmiciondenabda").html(f.split(' ')[0]);
		    			}
		    			
		    			var  m = item.Fecha_mandamiento_de_pago;
		    			if(m){
		    				$("#fechamandamientoPago").html(m.split(' ')[0]);
		    			}
		    			
		    			$("#totalGastosJudicales").html("$ "+ Number(item.Total_gastos_judiciales).toFixed(0));
	    			});
	    			
	    		}
	    	});
			
		},

		abogado : function(varcontrato){
			
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getInformacionAbogado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			//$("#tablaFacturas").html(tablaExtraJudicial);

	    			$.each(tablaExtraJudicial, function(i, item) {
	    				$("#abogadoCarajo").html(item.Abogado);
	    				var x = item.Fecha_asignacion_abogado;
	    				
	    				if(x){
	    					$("#fechaAsignacionabogado").html(x.split(' ')[0]);
	    				}
		    			
		    		
		    			$("#NumeroPoliza").html( item.No_Poliza );
		    		
		    			
		    			var  m = item.Fecha_de_aprobacion_de_Poliza;
		    			if(m){
		    				$("#fechaaprovaciondelapoliza").html(m.split(' ')[0]);	
		    			}
		    			
		    			var f = item.Fecha_de_vencimiento;
		    			if(f){
		    				$("#fechadevencimientocarajo").html(f.split(' ')[0]);
		    			}

		    			
	    			});
	    		}
	    	});
		},

		pazysalvo : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getPazYsalvo/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			//$("#tablaFacturas").html(tablaExtraJudicial);

	    			$.each(tablaExtraJudicial, function(i, item) {

	    				var x = item.Fecha_de_expedicion_del_paz_y_salvo;
	    				if(x){
	    					$("#fechapazysalvo").html(x.split(' ')[0]);
	    				}
		    			var paz = 'NO';
		    			if(item.Paz_y_salvo == '1405'){
		    				paz = 'SI';
		    			}
		    			$("#pazysalvo").html(paz);
		    			var m = item.Fecha_venta;
		    			if(m){
		    				$("#fechadeventacarajos").html(m.split(' ')[0]);	
		    			}
	    			});

	    		}
	    	});
		},

		subrogacion : function(varcontrato){
			
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getSubrogacion/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){

	    			$.each(tablaExtraJudicial, function(i, item) {

	    				var x = item.Fecha_envio_memorial_de_subrogacion_al_FRG;
	    				if(x){
	    					$("#fechaenviomemorial").html(x.split(' ')[0]);
	    				}
		    			
		    			var m = item.Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores;
		    			if(m){
		    				$("#fechadevolocionmemorial").html(m.split(' ')[0]);	
		    			}

		    			var n = item.Fecha_envio_memorial_de_subrogacion_corregido;
		    			if(n){
		    				$("#fechaenviomemeorialcorregido").html(n.split(' ')[0]);
		    			}
		    			
		    			var o = item.Fecha_radicacion_memorial;
		    			if(o){
		    				$("#fecharedicacionMemorial").html(o.split(' ')[0]);
		    			}
		    			
		    			var p = item.Fecha_pronunciamiento;
		    			if(p){
		    				$("#fechapronunciamiento").html(p.split(' ')[0]);	
		    			}
		    			
		    			$("#decision").html(item.Decision);

		    			var q = item.Fecha_impugnacion_decision_final;
		    			if(q){
		    				$("#fechaimpugnacion").html(q.split(' ')[0]);
		    			}
		    			
		    			$("#nombreclaseimpugnacion").html(item.Nombre_clase_de_impugnacion);
	    			});
	    		}
	    	});
		}
	}
	$(function(){

		$(".timepicker").timepicker({
            showInputs: false,
            timeFormat: 'HH:mm:ss',
	        minTime: 'now', // 11:45:00 AM,
	        showMeridian: false,
	        showSeconds : true
        });

        $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "yyyy-dd-mm",
            titleFormat: "yyyy-dd-mm", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

         //datemask1 dd/mm/yyyy
        $(".datemask1").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        });


		$("#tabladatos_Extras").DataTable({
				"oLanguage": {
	                "sLengthMenu": "_MENU_ registros por pagina",
	                "sZeroRecords": "0 resultados en el criterio de busqueda",
	                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
	                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
	                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
	                "sSearch": "Buscar:",
	                "oPaginate": {
				        "sNext": "Siguiente",
				        "sPrevious": "Anterior"
			      	}
	            },
	           
	            "fnDrawCallback": function (oSettings, json) {
	               //Aqui va el comando para activar los otros botones
	               
	            },

	           "iDisplayLength": 10,
	           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
	    });

	    $("#RowContrato td").click(function(){
	    	var dato = $(this).attr('contrato').replace(' ', '');
	    	$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosObligaciones/'+ dato,
	    		dataType : 'json',
	    		success  : function(data){
	    			$.each(data, function(i, item) {
					    $("#txtNumeroContrato").html(item.Contrato);

					    var sal = item.Vlorpagado;
		    			$("#txtValorPagado").html("$ "+ formatNumber.new(Number(sal).toFixed(0)));
		    			$("#txtIntermediarioF").html(item.financiero);

		    			$("#txtCobertura").html(item.Cobertura + ' %');
		    			var fecha = item.fgarantia;
		    			if(fecha){
		    				fecha = fecha.split(' ')[0];
		    			}else{
		    				fecha = '';
		    			}
		    			$("#txtFechagarantia").html(fecha);
		    			var textto = 'NO';
		    			if($.isNumeric(item.Judiciable)){
		    				textto = 'SI';
		    			}
		    			$("#txtJudicial").html(textto);


		    			$("#txtFrg").html(item.FRG);
		    			$("#txtSap").html(item.SAP);
		    			$("#txtDespacho").html(item.Despacho);


		    			$("#txtClase").html(item.claseProceso);
		    			$("#txtEstado").html(item.estadoP);
		    			

		    			$("#tareasEstaVaina").val(item.Contrato);

		    			//esta es la carga del simulador
		    			var otherfecha = item.ultimoavnoFecha;
		    			if(otherfecha){
		    				otherfecha = otherfecha.split(' ')[0];
		    			}
		    			$("#simularContrato").html(item.Contrato);
		    			$("#simuladorUltimoabono").html(otherfecha);

		    			var Jodete = item.saldo;
		    			$("#simuladorSaldo").html("$ "+formatNumber.new(Number(Jodete).toFixed(0)));

		    			$("#simuladorfondoCartera").html(item.FRG);
		    			$("#simuladorIntemediario").html(item.financiero);
		    			$("#simuladorFechaPago").html(fecha);
		    			
		    			$("#simuladorValorPagadoFng").html("$ "+ formatNumber.new(Number(sal).toFixed(0)));

		    			$("#simuladorTasamora").html(formatNumber.new(item.interespormora) +" %");
		    			$("#simuladorgastosJudiciales").html("$ " + formatNumber.new(item.GastoJudiciales));
		    			$("#simuladSaldoCapital").html("$ "+formatNumber.new(Number(Jodete).toFixed(0)));

		    			var mora = ((item.interespormora / 100) * item.saldo);
		    			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
		    			var resta  = restaFechas(fecha, txtFechaLiquida);
		    			//console.log(resta);
		    			var finalis = ((mora * resta) / 365);
		    			$("#simuladorMoratorios").html("$ " + formatNumber.new(Number(finalis).toFixed(0)));
		    			

		    			var suma = Number(finalis) + Number(item.saldo);
		    			$("#TotalApagarSimulador").html("$ "+ formatNumber.new(Number(suma).toFixed(0)));
		    			numeroContrato  = dato;
		    			nombreContrato = item.Contrato;
		    			
		    			$("#fechaLimitePagoLiquidacion").html(sumaFecha(15, txtFechaLiquida));

		    			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));


		    			var anticipo = (suma * 0.1);
		    			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

		    			var estoaqui = ( item.saldo - anticipo)
		    			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));

		    			var saldodigerrir = Number(estoaqui) + Number(finalis);
		    			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

		    			var valor = (item.Vlorpagado * 0.1);
		    			$("#valorHonorarios").html("$ "+ formatNumber.new(valor.toFixed(0)));

		    			$("#referenciaCOntratop").html("<label>"+nombreContrato+"</label>");


		    			interesxmora = item.interespormora;
						saldosimulador = Number(Jodete).toFixed(0);
						fachasimulador = fecha;
						simuladorFinalos = finalis;
						valoragadoFNG = item.Vlorpagado;
					});
	    			//$("#gestionJudicial").attr('href', '<?php echo base_url();?>cartera_fng/gestionJudicialmenu/<?php echo $identificacion;?>/'+dato);
	    		
	    		}
	    	});

	    	$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosDeudores/'+ dato,
	    		dataType : 'json',
	    		success  : function(data){
	    			var select = '<option value="0">Seleccione un deudor</option>';
	    			$.each(data, function(i, item) {
					    select += '<option value="'+ item.id +'">'+ item.deudor+'</option>';
					});
	    			
	    			$("#SelDeudores").html(select);

	    			$("#SelDeudores").change(function(){
	    				$("#opcionesDeudor").show();
	    				var Jsoe = $("#tareasEstaVaina").val();
	    				$("#tareasEstaVaina").val(Jsoe + ' ' + $("#SelDeudores option:selected").text());
	    			});
	    		}
	    	});

	    	$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getRolusuario',
	    		type   : 'POST',
	    		data   : {contrato: dato , usuario:<?php echo $idUsuario;?>},
	    		success  : function(data){
	    			$("#txtRol").html(data);
	    		}
	    	});


	    	fng.extrajudicial(dato);
	    	fng.judicial(dato);
	    	fng.medidas(dato);
	    	fng.acuerdopago(dato);
	    	fng.garantias(dato);
	    	fng.codeudores(dato);
	    	fng.facturas(dato);
	    	fng.infoJudicial(dato);
	    	fng.abogado(dato);
	    	fng.pazysalvo(dato);
	    	fng.subrogacion(dato);

	    	$("#campos").show();
	    	
	    });

		$("#calculoEstadoSimulador").click(function(){

			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var resta  = restaFechas(fachasimulador, txtFechaLiquida);
			//console.log(resta);
			var finalis = ((mora * resta) / 365);
			$("#simuladorMoratorios").html("$ " + formatNumber.new(finalis.toFixed(0)));
			var suma = Number(finalis) + Number(saldosimulador);
			$("#TotalApagarSimulador").html("$ "+ formatNumber.new(suma.toFixed(0)));
			var anticipo = (suma * 0.1);
			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));
			var saldodigerrir = Number(estoaqui) + Number(finalis);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

			$("#fechaLimitePagoLiquidacion").html('');
			$("#fechaLimitePagoLiquidacion").html(sumaFecha(15, txtFechaLiquida));


			var resltao = getValorCuota( saldosimulador, 13, $("#txtNumeroCuotas").val(), finalis);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

		});

		$("#btnCalcular2Simulador").click(function(){

			var interes = $("#txtPorcentajeSmulador").val();
			var suma = Number(simuladorFinalos) + Number(saldosimulador);
			var anticipo = (suma * ( interes / 100 ));

			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var resta  = restaFechas(fachasimulador, txtFechaLiquida);
			//console.log(resta);
			var finalis = ((mora * resta) / 365);

			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));

			var saldodigerrir = Number(estoaqui) + Number(simuladorFinalos);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

			var resltao = getValorCuota( saldosimulador, 13, $("#txtNumeroCuotas").val(), finalis);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

		});

		$("#btnCalcularAbogado").click(function(){
			var interes = $("#txtHonorariosSimulador").val();
			var valor = (valoragadoFNG * (interes / 100));
			$("#valorHonorarios").html("$ "+ formatNumber.new(valor.toFixed(0)));
		});


		$("#GuardarBtnMedidas").click(function(){
			if( $("#txtSolicitudF").val().length < 1){
				alert('Es necesario elegir una fecha de Solicitud!');
				$("#txtSolicitudF").focus();
			}else{
				alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
		                    url       : '<?php echo base_url();?>cartera_fng/guardarMedidas',
		                    type      : 'POST',
		                    data      : {
										
											FechaSolicitud  : $("#txtSolicitudF").val(),
											FechaDecreto    : $("#txtDecretoF").val(),
											FechaPractica   : $("#txtPracticaF").val(),
											Secuestre       : $("#txtSecuestro").val() ,
											OtroBien        : $("#txtOtroBien").val(),
											Observaciones   : $("#txtObservacionesFechas").val(),
											medidaCautelar  : medidaCautelar,
		                                  	contrato 		: numeroContrato
		                                },
		                    success   : function(data){
		                       if(data == 1){
		                          
		                          $("#Modal-Medidas").modal('hide');
		                          $("#Modal-Menu").modal('hide');
		                          fng.medidas(numeroContrato);
		                          alertify.success("Medida Cautelar guardada satisfactoriamente");
		                       }else{
		                          alertify.error("Medida Cautelar, No se pudo guardar");
		                         
		                       }
		                    }
		                });
				    } else {
				        // user clicked "cancel"
				    }
				});



			}
		});

		$("#GuardarBtn").click(function(){

			if( $("#txtFecha").val().length < 1){
				alert('Es necesario elegir una fecha!');
				$("#txtFecha").focus();
			}if(!$("input[name=optionsRadios]:checked").val()) {
				alert('No hay actuación seleccionada');
			}else{
				alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    	if (e) {
		         	 	$.ajax({
		                    url       : '<?php echo base_url();?>cartera_fng/guardardatosWizard',
		                    type      : 'POST',
		                    data      : {
		                                  actuacion : $('input:radio[name=optionsRadios]:checked').val() ,
		                                  contrato  : numeroContrato ,
		                                  etapa   : etapa,
		                                  txtFechaTramite : $("#txtFecha").val(),
		                                  TipoProceso  : 1 ,
		                                  txtObservaciones : $("#txtObservaciones").val()
		                                },
		                    success   : function(data){
		                       if(data == 1){
		                          
		                          $("#Modal-Demanda").modal('hide');
		                          $("#Modal-Menu").modal('hide');
		                          fng.judicial(numeroContrato);
								  $("input:radio[name=optionsRadios]").prop("checked", false);
								  $("#txtFecha").val('');
								  $("#txtObservaciones").val('');
		                          alertify.success("Gestión Judicial guardada satisfactoriamente");
		                       }else{
		                          alertify.error("Gestión Judicial, No se pudo guardar");
		                         
		                       }
		                    }
		                });
				    } else {
				        // user clicked "cancel"
				    }
				});

			}
            
        });

		$("#btnGuardarExtrajudicial").click(function(){
			alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    if (e) {
		         	$.ajax({
	                    url       : '<?php echo base_url();?>cartera_fng/guardarExtrajudicial',
	                    type      : 'POST',
	                    data      : {
	                                  subgestion : $('input:radio[name=cafeSeleccionado]:checked').val() ,
	                                  cliente  : $("#SelDeudores").val(),
	                                  contrato  : numeroContrato ,
	                                  gestion : gestion,
	                                  resultadocomunicacion  : resultadocomunicacion ,
	                                  mediocomunicacion : comunicacion,
	                                  txtObservaciones : $("#txtObservacionesExtrajudiciales").val()
	                                },
	                    success   : function(data){
	                       if(data == 1){
	                          $("#Modal-Menu-Extrajudicial").modal('hide');
	                          fng.extrajudicial(numeroContrato);
							  $("#SelDeudores").val(0);
							  $("#txtObservacionesExtrajudiciales").val('');
							  $("input:radio[name=cafeSeleccionado]").prop("checked", false);
	                          alertify.success("Gestión Extrajudicial guardada satisfactoriamente");
	                       }else{
	                          alertify.error("Gestión Extrajudicial, No se pudo guardar");
	                         
	                       }
	                    }
	                });
			    } else {
			        // user clicked "cancel"
			    }
			});
		});


		
		$("#btnguardarSaltandoUltimo").click(function(){
			alertify.confirm("¿Esta seguro que desea guardar el registro?", function (e) {
			    if (e) {
			        $.ajax({
	                    url       : '<?php echo base_url();?>cartera_fng/guardarExtrajudicial2',
	                    type      : 'POST',
	                    data      : {
	                                  cliente  : $("#SelDeudores").val(),
	                                  contrato  : numeroContrato ,
	                                  gestion : $('input:radio[name=localizadoSeleccionado]:checked').val(),
	                                  resultadocomunicacion  : resultadocomunicacion ,
	                                  mediocomunicacion : comunicacion,
	                                  txtObservaciones : $("#txtObservacionesExtrajudiciales2").val()
	                                },
	                    success   : function(data){
	                       if(data == 1){
	                          $("#Modal-Menu-Extrajudicial").modal('hide');
	                          fng.extrajudicial(numeroContrato);
							  
	                          alertify.success("Gestión Extrajudicial guardada satisfactoriamente");
	                       }else{
	                          alertify.error("Gestión Extrajudicial, No se pudo guardar");
	                         
	                       }
	                    }
	                });
			    } else {
			        // user clicked "cancel"
			    }
			});
			
		});


		$("#GuardarBtnTarea").click(function(){
			alertify.confirm("¿Esta seguro que desea guardar esta Tarea?", function (e) {
			    if (e) {
			        var fechas = getFechaHOy($("#txtFechaPrgramdad").val());
	            	if(fechas == 1){
	            		var horas = soloHoraMayor($("#timepikerettx").val());
	            		if(horas != 0){
	            			alertify.error('La hora esta vencida, por favor elija Otra');
	            			$("#timepikerettx").focus();
	            		}else{
	            			guardarTarea();
	            		}
	            	}else{
	            		guardarTarea();
            		}
			    } else {
			        // user clicked "cancel"
			    }
			});
		});
	});

	var formatNumber = {
				separador: ".", // separador para los miles
				sepDecimal: ',', // separador para los decimales
				formatear:function (num){
					num +='';
					var splitStr = num.split('.');
					var splitLeft = splitStr[0];
					var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
					var regx = /(\d+)(\d{3})/;
					while (regx.test(splitLeft)) {
						splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
					}
					return this.simbol + splitLeft +splitRight;
				},
				new:function(num, simbol){
					this.simbol = simbol ||'';
					return this.formatear(num);
				}
			}

	function guardarTarea(){
		$.ajax({
            url       : '<?php echo base_url();?>tareas/guardarTareas',
            type      : 'POST',
            data      : {
                          contrato  : nombreContrato ,
                          fechaProgramada : $("#txtFechaPrgramdad").val(),
                          id_cliente  : $("#SelDeudores").val() ,
                          mediocomunicacion : $("#gestionCombo").val(),
                          resultadocomunicacion : resultadocomunicacion,
                          HoraProgramada : $("#timepikerettx").val(),
                          txtdescripcion : $("#txtDescripcion").val(),
                          nombrecliente   : $("#SelDeudores option:selected").text()
                          //
                        },
            success   : function(data){
               if(data == 1){
                  
                  $("#Modal-tareas").modal('hide');
                  alertify.success("Tarea Guardada satisfactoriamente");
               }else{
                  alertify.error("Tarea, No se pudo guardar");
                 
               }
            }
        });
	}

	function getDatosWizard(consInteEtapaSeleccionada, nombreEtapa){
		etapa = consInteEtapaSeleccionada;
        $.ajax({
            url      : "<?php echo base_url();?>cartera_fng/eventoBotonEtapa",
            type     : "POST",
       
            data     : { consInteEtapaSeleccionada : consInteEtapaSeleccionada },
            success  : function(data){
                $("#tituloModal").html("Etapa Seleccionada : "+nombreEtapa+" , Elija una actuación*");
                $("#modalBody").html(data);
                $("#getsionJudicialTab2").attr('data-toggle','tab');
                $("#getsionJudicialTab2").click();
            }
        });
	}


	function getdatosTab1(queQuieresHacerSeleccionado){
		$("#tab2").attr('data-toggle','tab');
		$("#tab2").click();
		comunicacion = queQuieresHacerSeleccionado;
	}

	function getdatosTab2(localizadoSeleccionado){
		$("#tab1").attr('data-toggle','');
		$("#tab3").attr('data-toggle','tab');
		resultadocomunicacion = localizadoSeleccionado;

		if(localizadoSeleccionado == 1780){
			$("#localizado").show();
			$("#ilocalizado").hide();
		}else{
			$("#localizado").hide();
			$("#Ilocalizadosqui").show();
			$("#Ilocalizado2").show();
			
			$.ajax({
	            url      : "<?php echo base_url();?>cartera_fng/eventoBotonIlocalizado",
	            type     : "POST",
	       
	            data     : { localizadoSeleccionado : localizadoSeleccionado },
	            success  : function(data){
	                $("#IlocalizadosquiGestiones").html('Subgestiones :* '+ data);
	            }
	        });
		}

		$("#tab3").click();
	}


	function getdatosTab3(cafeSeleccionado){
		$("#tab2").attr('data-toggle','');
		$("#tab4").attr('data-toggle','tab');
		gestion = cafeSeleccionado;
		$.ajax({
            url      : "<?php echo base_url();?>cartera_fng/getSubgestiones",
            type     : "POST",
       
            data     : { cafeSeleccionado : cafeSeleccionado },
            success  : function(data){
                $("#subgestionesFinales").html('Subgestiones :* '+ data);
            }
        });

        $("#tab4").click();
		
	}

	function getMedidas(varId){
		medidaCautelar = varId;
		$("#getsionMedidas2").attr('data-toggle' ,'tab');
		$("#getsionMedidas2").click();
	}

	function soloHoraMayor(valorCampo) {
		var error = 0;
		var hora = new Date();
		h = valorCampo.split(":")[0];
		m = valorCampo.split(":")[1];
		//alert (h);
		//alert (m);
		h1 = hora.getHours();
		m1 = hora.getMinutes();
		//alert (h1);
		//alert (m1);
	
		if(h1 > h){
			error = 1;
		}else if (h1 == h){
			if (m1 > m){
				error = 1;
			}
		}

		return (error);
	}

	function getFechaHOy(datenow){
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();

		if(dd<10) {
		    dd='0'+dd
		} 

		if(mm<10) {
		    mm='0'+mm
		} 

		var dia = datenow.split("-")[2];
		var mes = datenow.split("-")[1];
		var ano = datenow.split("-")[0];

		var res = 0;

		var f1 = new Date(yyyy, mm, dd); 
		var f2 = new Date(ano, mes, dia, 2);
		f1.setHours(0,0,0,0);
		f2.setHours(0,0,0,0);
		if (f1.getTime() == f2.getTime()){
		   res = 1;
		}

		return res;
	}

	function restaFechas(f1,f2){
		var aFecha1 = f1.split('-'); 
		var aFecha2 = f2.split('-'); 
		var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
		var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
		var dif = fFecha2 - fFecha1;
		var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
		return dias;
 	}

 	function sumaFecha(d, fecha){
 		fecha = fecha.split('-');

 		newfecha = fecha[1] + "/" + fecha[2] + "/" + fecha[0];

		var Fecha = new Date();
		var sFecha = newfecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
		var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
		var aFecha = sFecha.split(sep);
		var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
		fecha= new Date(newfecha);
		fecha.setDate(fecha.getDate()+parseInt(d));
		var anno=fecha.getFullYear();
		var mes= fecha.getMonth()+1;
		var dia= fecha.getDate();
		mes = (mes < 10) ? ("0" + mes) : mes;
		dia = (dia < 10) ? ("0" + dia) : dia;
		sep = '-';
		var fechaFinal = anno+sep+mes+sep+dia;

		return (fechaFinal);
 	}


 	function getValorCuota( varMontoCapital, varInteres, varNumCuotas, varMontoIntereses){
 		var salminimo = <?php echo $Sminimo;?>;
 		var result = '';
 		if (varNumCuotas > 0) {
            var i = (varInteres / 12) / 100;
            var valorCuota = (varMontoCapital * ((i * Math.pow(1 + i, varNumCuotas)) / ((Math.pow(1 + i, varNumCuotas)) - 1))) + (varMontoIntereses / varNumCuotas);
            var cuotaRound = Math.round(valorCuota);
            var smdlv = ( salminimo / 30) * 5;

            return cuotaRound;
        }
 	}



</script>
