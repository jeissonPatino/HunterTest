<section class="content-header">
    <h1>
        GESTIÓN JUDICIAL - PROCESO ASOCIADO
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Procesos Asociados</li>
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
  .datepicker{
    z-index:10000 !important;
   }
</style>

<?php echo '<a href="javascript:history.back();" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>';?>


	<div class="box box-solid">
	    <div class="box-body">
			<div class="panel box box-primary">

				<div class="box-header with-border">
					<h4 class="box-title">
						<a>DATOS BÁSICOS TITULAR</a>
					</h4>
				</div>
				<div id="collapseDatos" class="panel-collapse">
					<div class="box-body">
					<?php
						$cliente_int_b = 0;
						foreach ($cliente as $key) { ?>
						<div class="row-primary ">		
							<div class="col-md-12"> 
								<div class="row ">
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
								<div class="row ">
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtIdentificacion">Tipo Identificación</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->tipo_identificacion;?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtDireccion">Dirección domicilio</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->DireccionD);?>
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
											<label for="TxtDireccion">Dirección oficina</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->DireccionO);?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCiudad">Ciudad oficina</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo utf8_encode($key->CiudadO);?>
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
											<label for="txtNumero">No. de liquidaciones del deudor</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $numeroLiquidaciones;?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtCelular">Dirección adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->dir_Adicional;?>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="TxtCelulara">Ciudad adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->ciudad_ad;?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtCelular">Teléfono adicional</label>
					                 	</div>
									</div>
									<div class="col-md-3">
										<?php echo $key->tele_adicional;?>
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
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen2">
							DATOS ADICIONALES DEL TITULAR
						</a>
					</h4>
				</div>
				<div id="collapseThirteen2" class="panel-collapse collapse">
					<div class="box-body table-responsive">
						<table class="table table-hover" id="tabladatos_Iniciales">
							<thead>
								<tr>
									<th>Dirección domicilio</th>
									<th>Calificación Dir. Domicilio</th>
									<th>Ciudad domicilio</th>
									<th>Calificación Ciudad domicilio</th>
									<th>Dirección oficina</th>
									<th>Calificación Dirección oficina</th>
									<th>Ciudad oficina</th>
									<th>Calificación Ciudad oficina</th>
									<th>Teléfono domicilio</th>
									<th>Calificación Teléfono domicilio</th>
									<th>Teléfono oficina</th>
									<th>Calificación Teléfono oficina</th>
									<th>Celular</th>
									<th>Calificación Celular</th>
									<th>Celular adicional</th>
									<th>Calificación Celular adicional</th>
									<th>Correo electrónico</th>
									<th>Calificación Correo electrónico</th>
									<th>Dirección adicional</th>
									<th>Calificación Dirección adicional</th>
									<th>Ciudad adicional</th>
									<th>Calificación Ciudad adicional</th>
									<th>Teléfono adicional</th>
									<th>Calificación Teléfono adicional</th>
									<th>Fecha</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
				  		
					</div>
				</div>
			</div>
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen">
							DATOS ADICIONALES DEL CODEUDOR
						</a>
					</h4>
				</div>
				<div id="collapseThirteen" class="panel-collapse collapse">
					<div class="box-body table-responsive">
						<table class="table table-hover" id="tabladatos_Extras">
							<thead>
								<tr>
									<th>LIQUIDACIÓN</th>
									<th>CODEUDOR</th>
									<th>ROL</th>
									<th>TELÉFONO</th>
									<th>CALIFICACIÓN TELEFONO</th>
									<th>DIRECCIÓN</th>
									<th>CALIFICACIÓN DIRECCIÓN</th>
									<th>CIUDAD</th>
									<th>CALIFICACIÓN CIUDAD</th>
									<th>CORREO ELECTRÓNICO</th>
									<th>CALIFICACIÓN CORREO</th>
									<th>DESCRIPCIÓN</th>
									<th>FECHA</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
				  		
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
										<th>Nº Liquidación</th>
									</thead>
									<tbody>
										<?php
										
											if($masliquidaciones > 0){
												for($i=0;$i < count($contratos); $i++){
													if(!is_null($contratos[$i])){
														if($contratos[$i]['contrato']!= ''){
															$this->db->select('TOP 1 Id, NombreIF');
														    $this->db->from('HistoricoProcesoAsociado');
														    $this->db->join('InformacionCredito', 'Id = idCredito','LEFT');
														    $this->db->join('IntermediarioFinanciero', 'Id = idIF','LEFT');
														    $this->db->where('liquidacion', $contratos[$i]['contrato']);
														    $query = $this->db->get();

													$color = $this->Obligaciones_Model->getColoresLiquidacicones($contratos[$i]['contrato']);
														json_decode($color);

													
														 	echo "<tr><td style='cursor:pointer;background-color:".$color."'; contrato ='".$query->row()->Id."'>".$contratos[$i]['contrato']." ".$query->row()->NombreIF ."</td></tr>";

														}
													}
												}
											}else{
												for($i=0;$i < count($contratos); $i++){
													if(!is_null($contratos[$i])){

													 	echo "<tr><td style='cursor:pointer;background-color:".$color."'; contrato ='".$contratos[$i]['No_CONTRATO']."'>".$contratos[$i]['contrato']." ".$contratos[$i]['if'] ."</td></tr>";



													}
												}
											}
										?>
									</tbody>
								</table>
								<table class="table table-hover table-bordered">
									<thead>
										<th>
											Especificaciones Color
										</th>
									</thead>
									<tbody>
										<tr>
											<td style="background-color:#ef251a75">Vendidos</td>
										</tr>	
										<tr>
											<td style="background-color:#ef7f1a94">Acuerdos de pago</td>
										</tr>
										<tr>
											<td style="background-color:#f7ec016b">Saldo Cero</td>
										</tr>
											<td style="background-color:#97b0f3">Otros</td>
										<tr>
											<td style="background-color:#5ace77">Paz y Salvo</td>
										</tr>
										<tr>
											<td style="background-color:#ad6d6d">Sentencia Irrecuperable</td>
										</tr>
										<tr>
											<td style="background-color:#fff">Saldo Favor</td>

										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-10">
								<div class="panel box box-primary">
									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOneOne">
												DATOS OBLIGACIÓN
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
																	<label for="TxtCelulara">Estado de Asignación</label>
											                 	</div>
															</div>
															<div class="col-md-3" id="AsigancionAbogado" >
																
															</div>
														</div>
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">No. Liquidación</label>
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
																<label for="TxtCelulara">Ciudad despacho</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtciudadDespacho">
															
														</div>
													</div>


													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label for="TxtCelulara">Clase de proceso</label>
										                 	</div>
														</div>
														<div class="col-md-3" id="txtClase">
															
														</div>

														<div class="col-md-3">
															<div class="form-group">
																<label for="txtMail">Estado del proceso</label>
										                 	</div>
														</div>
														<div class="col-md-3"  id="txtEstado" >
															
														</div>
														
													</div>



												</div>
											</div>
									
									<div class="box-header with-border box-primary">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapsetwo">
												HISTÓRICO GESTIÓN EXTRAJUDICIAL
											</a>
										</h4>
									</div>
									<div id="collapsetwo" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											<a id="exportarExtrajudicial" class="btn btn-primary">Exportar a Excel</a><br><br>
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
												HISTÓRICO GESTIÓN JUDICIAL
											</a>
										</h4>
									</div>
									<div id="collapsethree" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											
											<a id="exportarJudicial" class="btn btn-primary">Exportar a Excel</a><br><br>
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
														<th></th>
														
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
												HISTÓRICO GESTIÓN MEDIDAS
											</a>
										</h4>
									</div>
									<div id="collapsefour" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
											
											<a id="exportarMedidas" class="btn btn-primary">Exportar a Excel</a>
											<br><br>
										  	<table class="table table-hover table-bordered" id="tblHistoricoMedidas">
												<thead>
													<tr>
														<th>Fecha Informe</th>
														<th>Medida Cautelar</th>
														<th>Fecha Solicitud</th>
														<th>Fecha Decreto</th>
														<th>Fecha Práctica</th>
														<th>Secuestre</th>
														<th>Medida efectiva</th>
													</tr>
												</thead>
												<tbody>

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
												ACUERDO DE PAGO
											</a>
										</h4>
									</div>
									<div id="collapseSix" class="panel-collapse collapse ">
										<div class="box-body table-responsive no-padding">
										  	<table class="table table-hover table-bordered" id="tblAcuerdoPago">
												<thead>
													<tr>
														<th width='auto'>Fecha consignación anticipo</th>
														<th width='auto'>Fecha de legalización</th>
														<th width='auto'>Valor del acuerdo</th>
														<th width='auto'>Plazo acuerdo de Pago</th>
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
												GARANTÍAS - PAGARÉS
											</a>
										</h4>
									</div>
									<div id="collapseSven" class="panel-collapse collapse ">
										<div class="box-body">
										  	<table class="table table-hover table-bordered" id="tblGarantiaPagare">
												<thead>
													<tr>
														<th>N° Contrato</th>
														<th>N° Garantía</th>
														<th>N° Pagaré</th>
														<th>Valor Garantía</th>
													</tr>
												</thead>
												<tbody>

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
										<div class="box-body table-responsive">
										  	<table class="table table-hover table-bordered" id="tblFacturas">
												<thead>
													<tr>
														<th style="width:450px !important">N° de factura auto de subrogación</th>
														<th style="width:450px !important">Fecha de factura auto de subrogación</th>
														<th style="width:450px !important">Fecha auto de subrogación</th>
														<th style="width:450px !important">Valor facturado auto de subrogación</th>
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>

											<table class="table table-hover table-bordered" id="tblFacturasIrrecuperables">
												<thead>
													<tr>
														<th style="width:450px !important">No. Factura sentencia irrecuperable</th>
														<th style="width:450px !important">Fecha sentencia irrecuperable</th>
														<th style="width:450px !important">Fecha de factura sentencia irrecuperable</th>
														<th style="width:450px !important">Valor facturado sentencia irrecuperable</th>
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>



											<table class="table table-hover table-bordered" id="tblFacturasSoporte">
												<thead>
													<tr>
														<th style="width:450px !important">No. Factura soportes CISA</th>
														<th style="width:450px !important">Fecha recepción soporte</th>
														<th style="width:450px !important">Fecha aprobación soporte</th>
														<th style="width:450px !important">Valor facturado soportes CISA</th>
													</tr>
												</thead>
												<tbody id="tablaFacturas">

												</tbody>
												
											</table>

											<table class="table table-hover table-bordered" id="tblFacturasHonorarios">
												<thead>
													<tr>
														<th style="width:450px !important">No. Factura honorarios venta CISA</th>
														<th style="width:450px !important">Fecha de factura honorarios venta CISA</th>
														<th style="width:450px !important">Honorarios venta CISA</th>
														
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
										  		<div class="col-md-3"><label>Fecha mandamiento de pago</label> </div>
										  		<div class="col-md-3" id="fechaadmiciondenabda"> </div>
										  		<div class="col-md-3"><label>Nombre abogado IF</label> </div>
										  		<div class="col-md-3" id="txtNombreabogadoIf"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Total gastos judiciales</label> </div>
										  		<div class="col-md-3"  id="totalGastosJudicales"> </div>
										  		<div class="col-md-3"><label>Fecha envío memorial de terminación</label> </div>
										  		<div class="col-md-3"  id="FechaEnvioMemorialTerminacion"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha de terminación proceso</label> </div>
										  		<div class="col-md-3" id="judicialFechaTerminacion"> </div>
										  		
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
										  		<div class="col-md-3"><label>Promotor / Liquidador </label> </div>
										  		<div class="col-md-3" id="AbogadoPromotor"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha fijación del aviso</label> </div>
										  		<div class="col-md-3"  id="AbogadoFechaFijacion"> </div>
										  		<div class="col-md-3"><label>Celular</label> </div>
										  		<div class="col-md-3" id="AbogadoCelular"> </div>
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Correo electrónico</label> </div>
										  		<div class="col-md-9"  id="AbogadoCorreo"> </div>
										  		
										  	</div>
										  	<div class="row">
									  			<div class="col-md-3"><label>Teléfono</label> </div>
										  		<div class="col-md-3" id="AbogadoTelefono"> </div>

										  		<div class="col-md-3"><label>Dirección</label> </div>
										  		<div class="col-md-3"  id="AbogadoDireccion"> </div>
										  		
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Firma de abogados</label> </div>
										  		<div class="col-md-3" id="AbogadoFirma"> </div>
										  		<div class="col-md-3"><label>Frg</label> </div>
										  		<div class="col-md-3"  id="AbogadoFrg"> </div>
										  	</div>
										</div>
									</div>
									<div class="box-header with-border">
										<h4 class="box-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseEleven">
												PAZ Y SALVO FNG / FECHA DE VENTA
											</a>
										</h4>
									</div>
									<div id="collapseEleven" class="panel-collapse collapse ">
										<div class="box-body">
										  	<div class="row">
										  		<div class="col-md-3"   ><label>Fecha de expedición del paz y salvo</label> </div>
										  		<div class="col-md-3" id="fechapazysalvo"> </div>
										  		
										  	</div>
										  	<div class="row">
										  		<div class="col-md-3"><label>Fecha de venta</label> </div>
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
										  		<div class="col-md-3"  ><label>Fecha decisión final</label>  </div>
										  		<div class="col-md-3" id="Fechadecicionfinal"> </div>

										  		<div class="col-md-3"   ><label>Decisión final</label> </div>
										  		<div class="col-md-3" id="decicionfinal"> </div>
										  		
										  	</div>
										  	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div><!-- /.box-body -->
	</div><!-- /.box -->



<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/bajadas/Jzip.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>



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

var tipoProceso = 0;
	
fng = {
		codeudores : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getCodeudoresProcesoAsociado/'+ varcontrato,
	    		success  : function(tablaExtraJudicial){
	    			$("#tablaCodeudores").html(tablaExtraJudicial);
	    			$(".obligacionesHref").click(function(e){
	    				e.preventDefault();
	    				$.ajax({
				    		url    : '<?php echo base_url();?>cartera_fng/detallesObligaciones/'+ $(this).attr('usuario'),
				    		success  : function(data){
								$("#titulodeestaJoda").html("CODEUDORES");
				    			$("#datosGestionExtraJudicial").html(data);
				    			
				    		}
				    	});
	    			});
	    		}

	    	});
		},

		judicial : function (varcontrato){
			$.ajax({
	    		url    	 : '<?php echo base_url();?>cartera_fng/getgestioJudicialProcesoAsociado/'+ varcontrato,
	    		dataType : 'json',
	    		type     : 'POST',
	    		success  : function(tablaExtraJudicial){
	    			
					//$("#tblHistoricoJudicial").html(tablaExtraJudicial);
					
	    			

	    			if($.fn.dataTable.isDataTable( '#tblHistoricoJudicial' )){
	    				//console.log('es data table');
	    				$("#tblHistoricoJudicial").dataTable().fnDestroy();
						
	    			}
						
	    			var dataTableJudicial = $("#tblHistoricoJudicial").dataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "TipoProceso" },
								{ mData: "txtFechaIngreso" },
								{ mData: "Etapa" },
								{ mData: "actuacion" },
								{ mData: "fecha" },
								{ mData: "txtObservaciones" },
								{ mData: "users" }
								
							],
							"oLanguage": {
				                "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;

								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionJudicial');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionJudicial").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosgestionJudicial/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("HISTORICO GESTION JUDICIAL");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"aaSorting":[[1,"desc"]],
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				            
				    });
					
					
				
	    			



	    		}
	    	});
		},

		extrajudicial : function (varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getgestionExtrajudicial/'+ varcontrato,
	    		dataType : 'json',
	    		type     : 'POST',
	    		success  : function(tablaExtraJudicial){
	    			

	    			if($.fn.dataTable.isDataTable( '#tblHistoricoExtrajudicial' )){
	    				$("#tblHistoricoExtrajudicial").dataTable().fnDestroy();
	    			}


	    			var tblHistoricoExtrajudicial = $("#tblHistoricoExtrajudicial").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "nombres" },
								{ mData: "mediocomunicacion" },
								{ mData: "resultadocomunicacion" },
								{ mData: "gestion" },
								{ mData: "subgestion" },
								{ mData: "observaciones" },
								{ mData: "users" },
								{ mData: "fecha"},
								{ mData: "Niidea"}
							],
							"oLanguage": {
				                "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionExtraJudicial');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionExtraJudicial").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosgestionExtrajudicial/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("HISTORICO GESTION  EXTRAJUDICIAL");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"aaSorting":[[7,"desc"]],
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				           	"iDisplayLength": 20,
				           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
				
	    		}
	    	});
		},

		medidas : function (varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getTablaMedidaProcesoAsociado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType: 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			if($.fn.dataTable.isDataTable( '#tblHistoricoMedidas' )){
	    				$("#tblHistoricoMedidas").dataTable().fnDestroy();
	    			}


	    			var tblHistoricoMedidas = $("#tblHistoricoMedidas").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "fecha" },
								{ mData: "Medida" },
								{ mData: "var1" },
								{ mData: "var2" },
								{ mData: "var3" },
								{ mData: "Secuestre" },
								{mData : "calificar"}
							
								
							],
							"oLanguage": {
				                "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.G736_ConsInte__b;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionMedidas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionMedidas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosMedidas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("HISTORICO MEDIDAS CAUTELARES");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"aaSorting":[[0,"asc"]],
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
	    		}
	    	});
		},


		garantias : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getGarantiasProcesoAsociado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    		
	    			if($.fn.dataTable.isDataTable( '#tblGarantiaPagare' )){
	    				$("#tblGarantiaPagare").dataTable().fnDestroy();
	    			}


	    			var tblGarantiaPagare = $("#tblGarantiaPagare").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								{ mData: "contrato"},
								{ mData: "garantia" },
								{ mData: "pagare" },
								{ mData: "vPagado"}
							],
							"oLanguage": {
				                "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligaciongarania');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligaciongarania").dblclick(function(){
									var garantia = $(this).attr('id').replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosGarantias/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("GARANTIAS Y PAGARÉS");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });

					
							},

							"bJQueryUI": true,
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				           "iDisplayLength": 20,
				           "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
	    		}
	    	});
		},

		
		acuerdopago : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/gerAcuerdoPagoProcesoAsociado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType: 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			if($.fn.dataTable.isDataTable( '#tblAcuerdoPago' )){
	    				$("#tblAcuerdoPago").dataTable().fnDestroy();
	    			}


	    			var tblAcuerdoPago = $("#tblAcuerdoPago").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
								{ mData: "FECHA_CONSIGNACION_ANTICIPO"},
								{ mData: "FECHA_DE_LEGALIZACION" },
								{ mData: "VALOR_DEL_ACUERDO" },
								{ mData: "PLAZO_ACUERDO_DE_PAGO"}
							],
							"bAutoWidth": false , 
							"responsive" : true,
							"oLanguage": {
				               "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.id;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionMedidasPoh');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionMedidasPoh").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosAcuerdoDepago/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("ACUERDO DE PAGO");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
  		
				}
	    	});
		},

		

		facturas : function(varcontrato){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturasProcesoAsociado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    				    			

	    			if($.fn.dataTable.isDataTable( '#tblFacturas' )){
	    				$("#tblFacturas").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturas").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "N_DE_FACTURA_AUTO_DE_SUBROGACION" },
								{ mData: "FECHA"},
								
								{ mData: "FECHA_AUTO_DE_SUBROGACION" },
								{ mData: "VALOR_FACTURADO_AUTO_DE_SUBROGACION"}
							],
							"bAutoWidth": false , 
							"responsive" : true,
							"oLanguage": {
				               "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
	    		}
	    	});

	    	//Irrecuperables
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturasIrrecuperablesProcesoAsociado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			
	    			if($.fn.dataTable.isDataTable( '#tblFacturasIrrecuperables' )){
	    				$("#tblFacturasIrrecuperables").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturasIrrecuperables").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "N_DE_FACTURA_IRRECUPERABLE" },
								{ mData: "FECHA_SENTENCIA_IRRECUPERABLE"},
								
								{ mData: "FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE" },
								{ mData: "VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE"}
							],
							"bAutoWidth": false , 
							"responsive" : true,
							"oLanguage": {
				               "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
	    		}
	    	});


	    	//Soporte
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturasSOPORTE/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			
	    			if($.fn.dataTable.isDataTable( '#tblFacturasSoporte' )){
	    				$("#tblFacturasSoporte").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturasSoporte").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "NumeroFactura" },
					            { mData: "fecharecepcion" },
								{ mData: "fechaaprovacion"},
								{ mData: "valor"}
							],
							"bAutoWidth": false , 
							"responsive" : true,
							"oLanguage": {
				               "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
	    		}
	    	});


			//Honorarios
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getFacturasHonorarios/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			
	    			
	    			if($.fn.dataTable.isDataTable( '#tblFacturasHonorarios' )){
	    				$("#tblFacturasHonorarios").dataTable().fnDestroy();
	    			}


	    			var tblFacturas = $("#tblFacturasHonorarios").DataTable({
							"aaData": tablaExtraJudicial,
							"aoColumns": [
								
					            { mData: "NumeroFactura" },
					            { mData: "fecha" },
								{ mData: "valor"}
							],
							"bAutoWidth": false , 
							"responsive" : true,
							"oLanguage": {
				               "sLengthMenu": "_MENU_ Registros por página",
				                "sZeroRecords": "0 resultados en el criterio de busqueda",
				                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
				                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				                "sSearch": "Buscar:",
				                "oPaginate": {
							        "sNext": ">>",
							        "sPrevious": "<<"
						      	}
				            },
				            
					        "bScrollCollapse": true,
					        "bPaginate": false,
					        "bJQueryUI": true,
					 
				            "processing": true,
				           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
				            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.codigo;
								$(nRow).attr("id",id);
								$(nRow).attr("class",'trobligacionFacturas');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacionFacturas").dblclick(function(){
									var garantia = $(this).attr("id").replace(' ', '');
									$.ajax({
							    		url    : '<?php echo base_url();?>cartera_fng/getDatosFacturas/'+ garantia,
							    		success  : function(data){
											$("#titulodeestaJoda").html("DATOS FACTURA");
							    			$("#datosGestionExtraJudicial").html(data);
							    			
							    		}
							    	});
							   });
							},
							
							"bProcessing": true,
							"bSort": true,
							"bSortClasses": false,
							"bDeferRender": true,
							"sPaginationType": "simple",
				            "iDisplayLength": 20,
				            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
				    });
	    		}
	    	});
			
		},

		infoJudicial : function(varcontrato){

			$("#RedicadoExpediente").html('');
			$("#Fecchademanda").html('');
			$("#fechaadmiciondenabda").html('');
			$("#fechamandamientoPago").html('');
			$("#totalGastosJudicales").html('');
			$("#txtNombreabogadoIf").html('');
			$("#FechaEnvioMemorialTerminacion").html('');

			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getinformacionJudicialProcesoAsociado/'+ varcontrato,
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
		    			$("#judicialFechaTerminacion").html(item.fechaTErminacion);
		    			$("#txtNombreabogadoIf").html(item.abogadoIf);
		    			$("#FechaEnvioMemorialTerminacion").html(item.fechaEnvioTErminacion);
	    			});
	    			
	    		}
	    	});
			
		},


		abogado : function(varcontrato){

			$("#AbogadoDireccion").html('');
			$("#AbogadoTelefono").html('');
			$("#AbogadoCorreo").html('');
			$("#AbogadoCelular").html('');
			$("#AbogadoFirma").html('');
			$("#AbogadoFrg").html('');
			$("#AbogadoPromotor").html('');
			$("#abogadoCarajo").html('');
			$("#fechaAsignacionabogado").html('');
			$("#NumeroPoliza").html('');
			$("#fechaaprovaciondelapoliza").html('');
			$("#fechadevencimientocarajo").html('');


			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getInformacionAbogadoProcesoAsociado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			//$("#tablaFacturas").html(tablaExtraJudicial);

	    			$.each(tablaExtraJudicial, function(i, item) {
	    				$("#abogadoCarajo").html(item.Abogado);
	    				var x = item.Fecha_asignacion_abogado;
	    				
	    				if(x){

	    					x = x.split(' ')[0];
	    					x = x.split('-');
	    					$("#fechaAsignacionabogado").html(x[2] +'/' + x[1] + '/' + x[0]);
	    				}
		    			
		    		
		    			$("#NumeroPoliza").html( item.No_Poliza );
		    		
		    			
		    			var  m = item.Fecha_de_aprobacion_de_Poliza;
		    			if(m){
		    				m = m.split(' ')[0];
	    					m = m.split('-');
		    				$("#fechaaprovaciondelapoliza").html(m[2] +'/' + m[1] + '/' + m[0]);	
		    			}
		    			
		    			var f = item.Fecha_de_vencimiento;
		    			if(f){
		    				f = f.split(' ')[0];
	    					f = f.split('-');
		    				$("#fechadevencimientocarajo").html(f[2] +'/' + f[1] + '/' + f[0]);
		    			}

		    			$("#AbogadoDireccion").html(item.direccion);
                		$("#AbogadoTelefono").html(item.telefono);
                		$("#AbogadoCorreo").html(item.correo);
                		$("#AbogadoCelular").html(item.celular);
                		$("#AbogadoFirma").html(item.firma);
                		$("#AbogadoFrg").html(item.frg);
                		$("#AbogadoPromotor").html(item.promotor);
	    			});
	    		}
	    	});
		},

		pazysalvo : function(varcontrato){
			
			$("#fechapazysalvo").html('');
			$("#pazysalvo").html('');
			$("#fechadeventacarajos").html('');

			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getPazYsalvoProcesoAsociado/'+ varcontrato,
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

			$("#fechaenviomemorial").html('');
			$("#fechadevolocionmemorial").html('');	
			$("#fechaenviomemeorialcorregido").html('');
			$("#fecharedicacionMemorial").html('');
			$("#fechapronunciamiento").html('');
			$("#decision").html('');
			$("#fechaimpugnacion").html('');
			$("#nombreclaseimpugnacion").html('');
			$("#Fechadecicionfinal").html('');
			$("#decicionfinal").html('');

			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getSubrogacionProcesoAsociado/'+ varcontrato,
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){

	    			$.each(tablaExtraJudicial, function(i, item) {

	    			
						$("#fechaenviomemorial").html(item.Fecha_envio_memorial_de_subrogacion_al_FRG);
						$("#fechadevolocionmemorial").html(item.Fecha_devolucion_FRG_memorial_de_subrogacion_por_errores);	
						$("#fechaenviomemeorialcorregido").html(item.Fecha_envio_memorial_de_subrogacion_corregido);
						$("#fecharedicacionMemorial").html( item.Fecha_radicacion_memorial);
						$("#fechapronunciamiento").html(item.Fecha_pronunciamiento);	
						$("#decision").html(item.Decision);
						$("#fechaimpugnacion").html(item.Fecha_impugnacion_decision_final);
						$("#nombreclaseimpugnacion").html(item.Nombre_clase_de_impugnacion);
						$("#Fechadecicionfinal").html(item.Fecha_decision_final);
						$("#decicionfinal").html(item.decicion_Final);
	    			});
	    		}
	    	});
		},

		dartosadicionales : function (){
			
			alert('Entro dartosadicionales');
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosAdicionales/<?php echo $idUsuario;?>',
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			alert(tablaExtraJudicial);

	    			if($.fn.dataTable.isDataTable( '#tabladatos_Extras' )){
	    				$("#tabladatos_Extras").dataTable().fnDestroy();
	    				
	    			}

	    			$("#tabladatos_Extras").DataTable({
						"aaData": tablaExtraJudicial,
						"aoColumns": [
							{ mData: "obligaciones" },
							{ mData: "deudor"},
							{ mData: "rol" },

							{ mData: "TELEFONO" },
							{ mData: "Calificacion_telefono"},
							{ mData: "DIRECCION" },
							{ mData: "Calificacion_direccion"},
							{ mData: "CIUDAD" },
							{ mData: "Calificacion_ciudad"},
							{ mData: "CORREO_ELECTRONICO" },
							{ mData: "Calificacion_correo"},
							{ mData: "DESCRIPCION" },
							{ mData: "fecha"}
						],
						"oLanguage": {
			                "sLengthMenu": "_MENU_ Registros por página",
			                "sZeroRecords": "0 resultados en el criterio de busqueda",
			                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
			                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
			                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
			                "sSearch": "Buscar:",
			                "oPaginate": {
						        "sNext": ">>",
						        "sPrevious": "<<"
					      	}
			            },
			            "processing": true,
			           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
			            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
							var id = aData.id;
							$(nRow).attr("id",id);
							$(nRow).attr("class",'trobligacionDatosAdicionales');
							return nRow;
						   
						},
						"fnDrawCallback": function (oSettings, json) {
						   //Aqui va el comando para activar los otros botones
						   $(".trobligacionDatosAdicionales").dblclick(function(){
								var garantia = $(this).attr('id').replace(' ', '');
								$.ajax({
						    		url    : '<?php echo base_url();?>auxiliar/getdatosadicionalesbyid/'+ garantia,
						    		success  : function(data){
										$("#titulodeestaJoda").html("DATOS ADICIONALES");
						    			$("#datosGestionExtraJudicial").html(data);
						    			
						    		}
						    	});
						   });
						},
						"bJQueryUI": true,
						"bProcessing": true,
						"bSort": true,
						"bSortClasses": false,
						"bDeferRender": true,
						"sPaginationType": "simple",
			           	"iDisplayLength": 20,
			           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
			            "dom": 'Bfrtip',
				        "buttons": [
				             'excel'
				        ]
			    	});
	    		}
	    	});
			
		},

		datosIniciales : function(){
			
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosIniciales/<?php echo $idUsuario;?>',
	    		type   : 'POST',
	    		dataType : 'json',
	    		success  : function(tablaExtraJudicial){
	    			if($.fn.dataTable.isDataTable( '#tabladatos_Iniciales' )){
	    				$("#tabladatos_Iniciales").dataTable().fnDestroy();
	    			}

	    			$("#tabladatos_Iniciales").DataTable({
						"aaData": tablaExtraJudicial,
						"aoColumns": [
							{ mData: "direccionDomicilio" },
							{ mData: "cal_direccionDomicilio"},
							{ mData: "ciudadDomicilio" },
							{ mData: "cal_ciudadDomicilio"},
							{ mData: "direccionOficina" },
							{ mData: "cal_direccionOficina"},
							{ mData: "ciudadOficina" },
							{ mData: "cal_ciudadOficina"},
							{ mData: "telefonoDomicilio" },
							{ mData: "cal_telefonoDomicilio"},

							{ mData: "tefonoOficina" },
							{ mData: "cal_tefonoOficina"},
							{ mData: "celular" },
							{ mData: "cal_celular"},
							{ mData: "celularAdicional" },
							{ mData: "cal_celularAdicional"},
							{ mData: "mail" },
							{ mData: "cal_mail"},
							{ mData: "dir_Adicional" },
							{ mData: "cal_dir_Adicional"},

							{ mData: "ciudad_adicional" },
							{ mData: "cal_ciudad_adicional"},
							{ mData: "tele_adicional" },
							{ mData: "cal_tele_adicional"},
							
							{ mData: "fecha_modificacion"}
						],
						"oLanguage": {
			                "sLengthMenu": "_MENU_ Registros por página",
			                "sZeroRecords": "0 resultados en el criterio de busqueda",
			                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
			                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
			                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
			                "sSearch": "Buscar:",
			                "oPaginate": {
						        "sNext": ">>",
						        "sPrevious": "<<"
					      	}
			            },
			            "processing": true,
			           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
			            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			            	//alert( aData.id_log_datos);
							var id = aData.id_log_datos;
							$(nRow).attr("id",id);
							$(nRow).attr("class",'trobligacionDatosIniciales');
							return nRow;
						   
						},
						"fnDrawCallback": function (oSettings, json) {
						   //Aqui va el comando para activar los otros botones
						   $(".trobligacionDatosIniciales").dblclick(function(){
								var garantia = $(this).attr('id').replace(' ', '');
								$.ajax({
						    		url    : '<?php echo base_url();?>auxiliar/getdatosInicialesbyid/'+ garantia,
						    		success  : function(data){
										$("#titulodeestaJoda").html("DATOS ADICIONALES");
						    			$("#datosGestionExtraJudicial").html(data);
						    			
						    		}
						    	});
						   });
						},
						"bJQueryUI": true,
						"bProcessing": true,
						"bSort": true,
						"bSortClasses": false,
						"bDeferRender": true,
						"sPaginationType": "simple",
			            "iDisplayLength": 20,
			            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
			            "dom": 'Bfrtip',
				        "buttons": [
				             'excel'
				        ]
			       	});

			       	
	    		}
	    	});
		},

	} 


	$(function(){

		
        
	
		<?php if($datosadicionales != ''){ ?>
			$("#tabladatos_Extras").DataTable({
				"aaData": <?php echo $datosadicionales;?>,
				"aoColumns": [
                	{ mData: "obligaciones" },
					{ mData: "deudor"},
					{ mData: "rol" },
					{ mData: "TELEFONO" },
					{ mData: "Calificacion_telefono"},
					{ mData: "DIRECCION" },
					{ mData: "Calificacion_direccion"},
					{ mData: "CIUDAD" },
					{ mData: "Calificacion_ciudad"},
					{ mData: "CORREO_ELECTRONICO" },
					{ mData: "Calificacion_correo"},
					{ mData: "DESCRIPCION" },
					{ mData: "fecha"}
				],
				"oLanguage": {
	                "sLengthMenu": "_MENU_ Registros por página",
	                "sZeroRecords": "0 resultados en el criterio de busqueda",
	                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
	                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
	                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
	                "sSearch": "Buscar:",
	                "oPaginate": {
				        "sNext": ">>",
				        "sPrevious": "<<"
			      	}
	            },
	            "processing": true,
	           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
	            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
					var id = aData.id;
					$(nRow).attr("id",id);
					$(nRow).attr("class",'trobligacionDatosAdicionales');
					return nRow;
				   
				},
				"fnDrawCallback": function (oSettings, json) {
				   //Aqui va el comando para activar los otros botones
				   $(".trobligacionDatosAdicionales").dblclick(function(){
						var garantia = $(this).attr('id').replace(' ', '');
						$.ajax({
				    		url    : '<?php echo base_url();?>auxiliar/getdatosadicionalesbyid/'+ garantia,
				    		success  : function(data){
								$("#titulodeestaJoda").html("DATOS ADICIONALES");
				    			$("#datosGestionExtraJudicial").html(data);
				    			
				    		}
				    	});
				   });
				},
				"bJQueryUI": true,
				"bProcessing": true,
				"bSort": true,
				"bSortClasses": false,
				"bDeferRender": true,
				"sPaginationType": "simple",
	           	"iDisplayLength": 20,
	           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
	            "dom": 'Bfrtip',
		        "buttons": [
		             'excel'
		        ]
	    });


		<?php } ?>
		

		$("#tabladatos_Iniciales").DataTable({
			"aaData": <?php echo $iniciales;?>,
			"aoColumns": [

				{ mData: "direccionDomicilio" },
				{ mData: "cal_direccionDomicilio"},
				{ mData: "ciudadDomicilio" },
				{ mData: "cal_ciudadDomicilio"},
				{ mData: "direccionOficina" },
				{ mData: "cal_direccionOficina"},
				{ mData: "ciudadOficina" },
				{ mData: "cal_ciudadOficina"},
				{ mData: "telefonoDomicilio" },
				{ mData: "cal_telefonoDomicilio"},

				{ mData: "tefonoOficina" },
				{ mData: "cal_tefonoOficina"},
				{ mData: "celular" },
				{ mData: "cal_celular"},
				{ mData: "celularAdicional" },
				{ mData: "cal_celularAdicional"},
				{ mData: "mail" },
				{ mData: "cal_mail"},
				{ mData: "dir_Adicional" },
				{ mData: "cal_dir_Adicional"},

				{ mData: "ciudad_adicional" },
				{ mData: "cal_ciudad_adicional"},
				{ mData: "tele_adicional" },
				{ mData: "cal_tele_adicional"},
				
				{ mData: "fecha_modificacion"}
			],
			"oLanguage": {
                "sLengthMenu": "_MENU_ Registros por página",
                "sZeroRecords": "0 resultados en el criterio de busqueda",
                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando de 0 a 0 de 0 registros",
                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
			        "sNext": ">>",
			        "sPrevious": "<<"
		      	}
            },
            "processing": true,
           //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				var id = aData.id_log_datos;
				$(nRow).attr("id",id);
				$(nRow).attr("class",'trobligacionDatosIniciales');
				return nRow;
			   
			},
			"fnDrawCallback": function (oSettings, json) {
			   //Aqui va el comando para activar los otros botones
			   $(".trobligacionDatosIniciales").dblclick(function(){
					var garantia = $(this).attr('id').replace(' ', '');
					$.ajax({
			    		url    : '<?php echo base_url();?>auxiliar/getdatosInicialesbyid/'+ garantia,
			    		success  : function(data){
							$("#titulodeestaJoda").html("DATOS ADICIONALES");
			    			$("#datosGestionExtraJudicial").html(data);
			    			
			    		}
			    	});
			   });
			},
			"bJQueryUI": true,
			"bProcessing": true,
			"bSort": true,
			"bSortClasses": false,
			"bDeferRender": true,
			"sPaginationType": "simple",
           	"iDisplayLength": 20,
           	"aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
            "dom": 'Bfrtip',
	        "buttons": [
             	'excel'
	        ]
       	});

	    
	    

	   $("#RowContrato td").click(function(){



	    	$("#txtNumeroContrato").html('');
	    	$("#AsigancionAbogado").html('');
	    	$("#txtValorPagado").html('');
	    	$("#txtIntermediarioF").html('');
	    	$("#txtCobertura").html('');
	    	$("#txtFechagarantia").html('');
	    	$("#txtJudicial").html('');
	    	$("#txtFrg").html('');
	    	$("#txtSap").html('');
	    	$("#txtDespacho").html('');
	    	$("#txtciudadDespacho").html('');
	    	$("#txtClase").html('');
	    	$("#txtEstado").html('');
	    	$("#tareasEstaVaina").html('');
	    	$("#simularContrato").html('');
	    	$("#simuladorUltimoabono").html('');
	    	$("#simuladorSaldo").html('');
	    	$("#simuladorfondoCartera").html('');
			$("#simuladorIntemediario").html('');
			$("#simuladorFechaPago").html('');
			$("#simuladorValorPagadoFng").html('');
			$("#simuladorTasamora").html('');
			$("#simuladorgastosJudiciales").html('');
			$("#simuladSaldoCapital").html('');
			$("#simuladorMoratorios").html('');
			$("#TotalApagarSimulador").html('');
			$("#fechaLimitePagoLiquidacion").html('');
			$("#interecescalcluloSimulador").html('');
			$("#anticipoSimulador").html('');
			$("#MontocapitalDiferirSimulador").html('');
			$("#saldoadiferirSimulador").html('');
			$("#valorHonorarios").html('');
			$("#referenciaCOntratop").html('');
			$("#valordelascuotasSimulador").html('');
			
	    	var dato = $(this).attr('contrato').replace(' ', '');
	    	
	    	$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatosObligacionesProcesoAsociado/'+ dato,
	    		dataType : 'json',
	    		success  : function(data){
	    			$.each(data, function(i, item) {
	    				$("#AsigancionAbogado").html(item.EstadoAbogado);
					    $("#txtNumeroContrato").html(item.Contrato);

					    var sal = item.Vlorpagado;
		    			$("#txtValorPagado").html("$ "+ formatNumber.new(Number(sal).toFixed(0)));
		    			$("#txtIntermediarioF").html(item.financiero);

		    			$("#txtCobertura").html(item.Cobertura + ' %');
		    			var fecha = item.fgarantia;
		    			if(fecha){
		    				fecha = fecha.split(' ')[0];
		    				fecha = fecha.split('-');
		    				fecha = fecha[2] + "/" + fecha[1] + "/" + fecha[0];
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
		    			$("#txtciudadDespacho").html(item.ciudaddespacho);


		    			$("#txtClase").html(item.claseProceso);
		    			tipoProceso = item.procesoGu;

		    			

		    			$("#TxtTituloProceso").html('<h4>'+ item.claseProceso +'</h4>');
		    			if(item.claseProceso != 'EJECUTIVO'){
		    				$("#EjecutovosEtapas").hide();
		    				$("#otrasEtapas").show();
		    			}else{
							$.ajax({
								//EjecutovosEtapas
								url    : '<?php echo base_url();?>cartera_fng/getEtapasProceso/'+ tipoProceso,
								success  : function(data){
									$("#EjecutovosEtapas").html(data);
								}
							});
		    				$("#EjecutovosEtapas").show();
		    				$("#otrasEtapas").hide();
		    			}

		    			$("#txtEstado").html(item.estadoP);
		    			

		    			$("#tareasEstaVaina").val(item.Contrato);

		    			//esta es la carga del simulador
		    			var otherfecha = item.ultimoavnoFecha;
		    			if(otherfecha){
		    				otherfecha = otherfecha.split(' ')[0];
		    				otherfecha = otherfecha.split('-');
		    			}
		    			
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

	    	$("#exportarExtrajudicial").attr("href", '<?php echo base_url();?>cartera_fng/exportarExtrajudicial/'+ dato);
	    	$("#exportarJudicial").attr("href", '<?php echo base_url();?>cartera_fng/exportarJudicial/'+ dato);
	    	$("#exportarMedidas").attr("href", '<?php echo base_url();?>cartera_fng/exportarMedidas/'+ dato);

	    


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
	

		$("#obligaciones").change(function(){
			$.ajax({
	    		url    : '<?php echo base_url();?>cartera_fng/getdatoscoDeudores/'+ $(this).val(),
	    		dataType : 'json',
	    		success  : function(data){
	    			var select = '<option value="0">Seleccione un deudor</option>';
	    			$.each(data, function(i, item) {
					    select += '<option value="'+ item.id +'">'+ item.deudor+'</option>';
					});
	    			$("#rolUsers").val('');
	    			$("#DeudoresAqui").html(select);

	    			$("#DeudoresAqui").change(function(){
						$.ajax({
							url    : '<?php echo base_url();?>cartera_fng/getRolusuario',
							type   : 'POST',
							data   : {contrato: $("#obligaciones").val(), usuario: $(this).val()},
							success  : function(data){
								$("#rolUsers").val(data);
								$("#rolUsers1").val(data);
							}
						});
	    			});
	    		}
	    	});
		});

		$("#calculoEstadoSimulador").click(function(){

			//aqui se cosultan los intereses moratorios y el total a pagar
			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
			//console.log(txtFechaLiquida);
			var hijueputaFecha = fachasimulador.split("/");
			var resta  = restaFechas(hijueputaFecha[2] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[0], fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			//console.log(resta);
			
			//console.log(resta);

			var finalis = ((mora * resta) / 365);
			$("#simuladorMoratorios").html("$ " + formatNumber.new(finalis.toFixed(0)));
			var suma = Number(finalis) + Number(saldosimulador);
			$("#TotalApagarSimulador").html("$ "+ formatNumber.new(suma.toFixed(0)));
			var anticipo = (suma * 0.1);



			//esto es el anticipo y las ondiciones para realizar el pago
			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));
			var saldodigerrir = Number(estoaqui) + Number(finalis);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));

			$("#fechaLimitePagoLiquidacion").html('');
			var estasuma =sumaFecha(15,  fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			estasuma = estasuma.split('-');
			$("#fechaLimitePagoLiquidacion").html(estasuma[2]+"/"+estasuma[1]+"/"+estasuma[0]);


			var resltao = getValorCuota( saldosimulador, 0.13, $("#txtNumeroCuotas").val(), finalis);
			console.log(resltao);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

		});

		$("#btnCalcular2Simulador").click(function(){

			//aqui se cosultan los intereses moratorios y el total a pagar
			var interes = $("#txtPorcentajeSmulador").val()
			var mora = ((interesxmora / 100) * saldosimulador);
			var txtFechaLiquida = $("#txtSimuladorFEchaLiquidacion").val();
			var fechaLiquidacionEsta = txtFechaLiquida.split("/");
			//console.log(txtFechaLiquida);
			var hijueputaFecha = fachasimulador.split("/");
			var resta  = restaFechas(hijueputaFecha[2] + "-"+ hijueputaFecha[1] + "-"+ hijueputaFecha[0], fechaLiquidacionEsta[2] + "-"+ fechaLiquidacionEsta[1] + "-"+ fechaLiquidacionEsta[0]);
			//console.log(resta);
			
			//console.log(resta);

			var finalis = ((mora * resta) / 365);
			//$("#simuladorMoratorios").html("$ " + formatNumber.new(finalis.toFixed(0)));
			var suma = Number(finalis) + Number(saldosimulador);
			//$("#TotalApagarSimulador").html("$ "+ formatNumber.new(suma.toFixed(0)));
			var anticipo = (suma * ( interes / 100 ));

			//esto es el anticipo y las ondiciones para realizar el pago
			$("#anticipoSimulador").html("$ "+ formatNumber.new(anticipo.toFixed(0)));

			$("#interecescalcluloSimulador").html("$ " + formatNumber.new(finalis.toFixed(0)));

			var estoaqui = ( saldosimulador - anticipo);
			$("#MontocapitalDiferirSimulador").html("$ "+ formatNumber.new(estoaqui.toFixed(0)));
			var saldodigerrir = Number(estoaqui) + Number(finalis);
			$("#saldoadiferirSimulador").html("$ "+ formatNumber.new(saldodigerrir.toFixed(0)));



			var resltao = getValorCuota( saldosimulador, 0.13, $("#txtNumeroCuotas").val(), finalis);
			console.log(resltao);
			$("#valordelascuotasSimulador").html("$ "+ formatNumber.new(resltao.toFixed(0)));

		});

		$("#btnCalcularAbogado").click(function(){
			var interes = $("#txtHonorariosSimulador").val();
			var valor = (valoragadoFNG * (interes / 100));
			$("#valorHonorarios").html("$ "+ formatNumber.new(valor.toFixed(0)));
		});


		$("#GuardarBtnMedidas").click(function(){
			if( $("#txtSolicitudF").val().length < 1){
				alertify.error('Es necesario elegir una fecha de Solicitud!');
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
		                                  	contrato 		: numeroContrato,
		                                  	Calificacionesobligaciones : $('input:radio[name=Calificacionesobligaciones]:checked').val()
		                                },
		                    success   : function(data){
		                       if(data == 1){
		                       		$("#txtSolicitudF").val('');
									$("#txtDecretoF").val('');
									$("#txtPracticaF").val('');
									$("#txtSecuestro").val('');
									$("#txtOtroBien").val('');
									$("#txtObservacionesFechas").val('');
									$("input:radio[name=Calificacionesobligaciones]").prop("checked", false);

		                          	$("#getsionMedidas2").attr('data-toggle','');
                          		 	$("#getsionMedidas1").click();

		                          	
		                          //$("#Modal-Menu").modal('hide');
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
			var validador = 0;
			if( $("#txtFecha").val().length < 1){
				alertify.error("Es necesario elegir una fecha!");
				validador = 1;
				$("#txtFecha").focus();
			}
			
			if(!$("input[name=optionsRadios]:checked").val()) {
				alertify.error('No hay actuación seleccionada');
				validador = 1;
			}
			
			if(validador == 0) {
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
		                                  TipoProceso  : tipoProceso ,
		                                  txtObservaciones : $("#txtObservaciones").val()
		                                },
		                    success   : function(data){
		                       if(data == 1){
		                          
		                         
		                          
		                          fng.judicial(numeroContrato);
		                          fng.subrogacion(numeroContrato);
								  $("input:radio[name=optionsRadios]").prop("checked", false);
								  $("#txtFecha").val('');
								  $("#txtObservaciones").val('');
							   		$("#getsionJudicialTab2").attr('data-toggle','');
            						$("#getsionJudicialTab1").click();
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

		$("#cerrarJudiciales").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("input:radio[name=optionsRadios]").prop("checked", false);
					$("#txtFecha").val('');
					$("#txtObservaciones").val('');
					$("#getsionJudicialTab2").attr('data-toggle','');
					$("#getsionJudicialTab1").click();
					
			    } else {
			        // user clicked "cancel"
			    }

			});
		});

		$("#cerrarExtrajudicial").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("#SelDeudores").val(0);
					$("#opcionesDeudor").hide();
				  	$("#txtObservacionesExtrajudiciales").val('');
				 	$("input:radio[name=cafeSeleccionado]").prop("checked", false);
				 	$("#tab2").attr('data-toggle',' ');
				 	$("#tab3").attr('data-toggle',' ');
				 	$("#tab4").attr('data-toggle',' ');
				 	$("#tab1").attr('data-toggle','tab');
				 	$("#tab1").click();
				 	
			    } else {
			        // user clicked "cancel"
			    }

			});

		});

		$("#cerrarMedidas").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("#txtSolicitudF").val('');
					$("#txtDecretoF").val('');
					$("#txtPracticaF").val('');
					$("#txtSecuestro").val('');
					$("#txtOtroBien").val('');
					$("#txtObservacionesFechas").val('');

                  	$("#getsionMedidas2").attr('data-toggle','');
          		 	$("#getsionMedidas1").click();

                  	
			    } else {
			        // user clicked "cancel"
			    }
			});

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
	                          //$("#Modal-Menu-Extrajudicial").modal('hide');
	                          	fng.extrajudicial(numeroContrato);
							  	$("#SelDeudores").val(0);
								$("#opcionesDeudor").hide();
							  	$("#txtObservacionesExtrajudiciales").val('');
							 	$("input:radio[name=cafeSeleccionado]").prop("checked", false);
							 	$("#tab2").attr('data-toggle',' ');
							 	$("#tab3").attr('data-toggle',' ');
							 	$("#tab4").attr('data-toggle',' ');
							 	$("#tab1").attr('data-toggle','tab');
							 	$("#tab1").click();
							 	$("#ilocalizado").hide();
								$("#localizado").hide();
								$("#Ilocalizadosqui").hide();
								$("#Ilocalizado2").hide();
							 	
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

		$("#cerrarModalExtrajudicial").click(function(){ 
	

			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("#SelDeudores").val(0);
					$("#opcionesDeudor").hide();
				  	$("#txtObservacionesExtrajudiciales").val('');
				 	$("input:radio[name=cafeSeleccionado]").prop("checked", false);
				 	$("#tab2").attr('data-toggle',' ');
				 	$("#tab3").attr('data-toggle',' ');
				 	$("#tab4").attr('data-toggle',' ');
				 	$("#tab1").attr('data-toggle','tab');
				 	$("#tab1").click();

				 	$("#ilocalizado").hide();
					$("#localizado").hide();
					$("#Ilocalizadosqui").hide();
					$("#Ilocalizado2").hide();
				 	

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
	                                  gestion : 1816,
	                                  subgestion : $('input:radio[name=localizadoSeleccionado]:checked').val(),
	                                  resultadocomunicacion  : resultadocomunicacion ,
	                                  mediocomunicacion : comunicacion,
	                                  txtObservaciones : $("#txtObservacionesExtrajudiciales2").val()
	                                },
	                    success   : function(data){
	                       if(data == 1){
	                          //$("#Modal-Menu-Extrajudicial").modal('hide');
	                          	fng.extrajudicial(numeroContrato);
							  	$("#SelDeudores").val(0);
								$("#opcionesDeudor").hide();
							  	$("#txtObservacionesExtrajudiciales").val('');
							 	$("input:radio[name=cafeSeleccionado]").prop("checked", false);
							 	$("#tab2").attr('data-toggle',' ');
							 	$("#tab3").attr('data-toggle',' ');
							 	$("#tab4").attr('data-toggle',' ');
							 	$("#tab1").attr('data-toggle','tab');
							 	$("#tab1").click();
							 	$("#ilocalizado").hide();
								$("#localizado").hide();
								$("#Ilocalizadosqui").hide();
								$("#Ilocalizado2").hide();
							 
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


		$("#GuardarBtnDatosIniciales").click(function(){
			var valido = 0;
			

			if($("#direccion_domicilio").val().length > 0 ){
				if($("#seldireccion_domicilio").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la   domicilio");
					$("#seldireccion_domicilio").focus();
				}
			}

			if($("#ciudad_domicilio").val() != 0 ){
				if($("#Selciudad_domicilio").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la ciudad de domicilio");
					$("#Selciudad_domicilio").focus();
				}
			}

			if($("#direccion_oficina").val().length > 0 ){
				if($("#Seldireccion_oficina").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar la dirección de la oficina");
					$("#Seldireccion_oficina").focus();
				}
			}

			if($("#ciudad_oficina").val() != 0 ){
				if($("#selCiudad_oficina").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar lal ciudad de oficina");
					$("#selCiudad_oficina").focus();
				}
			}

			if($("#telefono_domicilio").val().length > 0 ){
				if($("#selTelefono_domicilio").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el telefono del domicilio");
					$("#selTelefono_domicilio").focus();
				}
			}

			if($("#telefono_oficina").val().length > 0 ){
				if($("#selTelefono_oficina").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el telefono de la oficina");
					$("#selTelefono_oficina").focus();
				}
			}

			if($("#Celular").val().length > 0 ){
				if($("#selCelular").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el celular");
					$("#selCelular").focus();
				}
			}

			if($("#celular_adicional").val().length > 0 ){
				if($("#selCelularAdicional").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el celular adicional");
					$("#selCelularadicional").focus();
				}
			}

			if($("#correo_electronico").val().length > 0 ){
				if($("#selCorreoOficial").val() == 0 ){
					valido = 1;
					alertify.error("Debe calificar el Correo");
					$("#selCorreoOficial").focus();
				}
			}

			if(valido == 0){
				var form = $("#FrmAbogados");
				if(form.valid()){
		  			var formData = new FormData($("#FrmIniciales")[0]);
		          	$.ajax({
		            	url: '<?php echo base_url();?>auxiliar/guardarDatosIniciales',  
		            	type: 'POST',
			            data: formData,
		            	cache: false,
		            	contentType: false,
		            	processData: false,
			            //una vez finalizado correctamente
			            success: function(data){
			            	if(data == '1'){
			            		form[0].reset();
			            		alertify.success('Datos ingresados correctamente');
			            		fng.datosIniciales();
			            		
			            	}else{
			            		alertify.error('Un error a ocurrido');
			            	}
			               
			                
			            },
			            //si ha ocurrido un error
			            error: function(){
			                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
			            }
			        });
			  	}else{
			  		alertify.error('No deben haber campos vacios, por favor rellena el formulario!!');
			  	}
			}


		});

		$(".cerrarAdicionales").click(function(){
			alertify.confirm("¿Ésta seguro que desea cerrar sin guardar?", function (e) {
			    if (e) {
		         	$("#correo").val('');
					$("#telefono").val('');
				  	$("#direccion").val('');
				 	$("#ciudad").val(0)
				 	$("#obligaciones").val(0)
				 	$("#DeudoresAqui").val(0)
				 	

			    } else {
			        // user clicked "cancel"
			    }
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

	

	

		});
	function getdatosTab1(queQuieresHacerSeleccionado){
		$("#tab2").attr('data-toggle','tab');
		$("#tab2").click();
		comunicacion = queQuieresHacerSeleccionado;
	}

	function getdatosTab2(localizadoSeleccionado){
		$("#tab1").attr('data-toggle','');
		$("#tab3").attr('data-toggle','tab');
		resultadocomunicacion = localizadoSeleccionado;
		$("#localizado").hide();
		$("#ilocalizado").hide();
		$("#Ilocalizadosqui").hide();
		$("#Ilocalizado2").hide();
		if(localizadoSeleccionado == '1780'){
			$("#localizado").show();
		
		}else{
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

	function calificarMedidas(idMedida, valor){

		alertify.confirm("¿Esta seguro que esta operación?", function (e) {
		    if (e) {
		    	if(valor === 1){
		    		valor = "SI";
		    	}else{
		    		valor = "NO";
		    	}

		        $.ajax({
		            url      : "<?php echo base_url();?>cartera_fng/calificarMedidas",
		            type     : "POST",
		            data     : { calificacion : valor, idMedidas : idMedida},
		            success  : function(data){
		                if(data == '1'){
		                    //$("#Modal-Menu").modal('hide');
		                    fng.medidas(numeroContrato);
		                    alertify.success("Medida Cautelar calificada satisfactoriamente");
		                }
		            }
		        });
		    } else {
		        // user clicked "cancel"
		    }
		});
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
		//console.log(f1);
		//console.log(f2);
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
            var i = (varInteres / 12);
            var valorCuota = (varMontoCapital * ((i * Math.pow(1 + i, varNumCuotas)) / ((Math.pow(1 + i, varNumCuotas)) - 1))) + (varMontoIntereses / varNumCuotas);
            var cuotaRound = Math.round(valorCuota);
            var smdlv = ( salminimo / 30) * 5;

            return cuotaRound;
        }
 	}

 	function eliminarGestion(varId){
 		alertify.confirm("¿Esta seguro que esta operación?", function (e) {
		    if (e) {
		    	$.ajax({
		 			url    : '<?php echo base_url();?>cartera_fng/eliminarGestion',
		 			type   : 'POST',
		 			data   : { IdEliminar : varId },
		 			success : function(data){
		 				fng.judicial(numeroContrato);
		 			}
		 		});
		    } else {
		        // user clicked "cancel"
		    }
		});
 	}
	
</script>
