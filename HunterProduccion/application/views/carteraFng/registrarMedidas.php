<div class="modal fade" tabindex="3" role="dialog" id="Modal-Medidas">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="">Medidas Cautelares</h4>
            </div>
            <div class="modal-body" >
            	
                <div class="row row-primary">
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
			                  		<p class="text-blue alert-info" >Medida</p>
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
					                                <a onclick="javascript: getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoVehiculo.png"></a>
					                            </div>
				                      			<div class="col-md-3">
					                                <a onclick="javascript: getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoEstabComercio.png"></a>
					                            </div>
					                      		<div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRetenSalario.png"></a>
					                            </div>
					            
					                    	</div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRetenCuentasAhCorr.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript: getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRemanentes.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoSecuestroBienes.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoRazonSocial.png"></a>
					                            </div>
					                           
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            

					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoMaqEquipo.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoAcciones.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoCuotasParticipacion.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoPosesion.png"></a>
					                            </div>
					                            
					                        </div>
					                        <div class="row">
					                            <div class="col-md-12">
					                                &nbsp;
					                            </div>
					                        </div>
					                        <div class="row">
					                            
					                            <div class="col-md-3">
					                                <a onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoCreditos.png"></a>
					                            </div>
					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoUsufructo.png"></a>
					                            </div>

					                            <div class="col-md-3">
					                                <a   onclick="javascript:  getMedidas(1);"><img src="<?php echo base_url();?>assets/img/medidas/embargoGarantiaInmob.png"></a>
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
												<input type="text" class="form-control datemask" id="txtSolicitudF" placeholder="Fecha Solicitud">
											</div>
										</div>
										<div class="form-group">
											<label for="txtDecretoF" class="col-sm-2 control-label">Fecha Decreto </label>
											<div class="col-sm-10">
												<input type="text" class="form-control datemask" id="txtDecretoF" placeholder="Fecha Decreto">
											</div>
										</div>
										<div class="form-group">
											<label for="txtSolicitudF" class="col-sm-2 control-label">Fecha Solicitud </label>
											<div class="col-sm-10">
												<input type="text" class="form-control datemask" id="txtSolicitudF" placeholder="Fecha Solicitud">
											</div>
										</div>
										<div class="form-group">
											<label for="txtPracticaF" class="col-sm-2 control-label">Fecha Práctica </label>
											<div class="col-sm-10">
												<input type="text" class="form-control datemask" id="txtPracticaF" placeholder="Fecha Práctica">
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
												<input type="text" class="form-control" id="txOtroBien" placeholder="Otro Bien">
											</div>
										</div>
										<div class="form-group">
											<label for="txtObservaciones" class="col-sm-2 control-label">Observaciones</label>
											<div class="col-sm-10">
												<textarea class="form-control" id="txtObservaciones" placeholder="Observaciones"></textarea>
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