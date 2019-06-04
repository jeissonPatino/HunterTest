<section class="content-header">
    <h1>
      Facturas
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Facturas</li>
    </ol>
</section>

<section class="content">
	<div class="box">
        <div class="box-body">
                  
			<a class="btn btn-app" id="agregar">
				<i class="fa fa-plus"></i> Agregar
			</a>
			<a class="btn btn-app" id="edit" disabled>
				<i class="fa fa-edit"></i> Editar
			</a>
			<a class="btn btn-app"  id="delete" disabled>
				<i class="fa fa-trash"></i> Eliminar
			</a>
			<a class="btn btn-app" id="Save" disabled>
				<i class="fa fa-save"></i> Guardar
			</a>
			<a class="btn btn-app" id="cancel" disabled>
				<i class="fa fa-close"></i> Cancelar
			</a>
    	</div><!-- /.box-body -->
  	</div><!-- /.box -->

	<!-- Salario Minimo -->
	<div class="box">
		<div class="box-header with-border">
			
		</div>
		<div class="box-body">
			<div class="row-fuid">
				<div class="col-md-4">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">No. Contrato / No. Liquidaci&oacute;n</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:left;">No. Liquidación</th>
									</tr>
								</thead>
								<tbody>
									<?php
									/*	foreach ($ciudades as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->ciudad).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->Departamento).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.utf8_encode($key->pais).'</td>
												  </tr>';
										}*/
									?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
				<div class="col-md-7">
					<!-- Subrogación -->
					<form id="FrmAbogados" method="POST">
						<div class="box-header with-border">
							<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve">
									SUBROGACIÓN
								</a>
							</h4>
						</div>
						<div id="collapseTwelve" class="panel-collapse">
							<div class="box-body">
								<input type="hidden" id="const_int_" name="id" value="0">
								<input type="hidden" id="NumeroContrato" name="NumeroContrato" value="0">
							  	<div class="row">
							  		<div class="col-md-6"  >
							  			<label>Número de Liquidación</label> 
							  			<div class="input-group input-group-sm">
								            <input type="text" class="form-control" placeholder="Número de Liquidación"  id="NumeroContratoTex" name="NumeroContratoTex"  disabled>
								            <span class="input-group-btn">
								              	<button class="btn btn-info btn-flat" id="btnFiltrar2" type="button"><i class="fa fa-search"></i></button>
								            </span>
								      	</div>
							  			
							  			
							  		</div>
							  		<div class="col-md-6"  >
							  			<label>No. Factura auto de subrogación</label>
							  			<input type="text" class="form-control " placeholder="No. Factura auto de subrogación"  id="txtFacturaAutoSub" name="txtFacturaAutoSub"  disabled> 
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-6">
							  			<label>Fecha de factura auto de subrogación</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha de factura auto de subrogación"  id="txtFechaFacuraSub" name="txtFechaFacuraSub"  disabled>
							  		</div>
							  		<div class="col-md-6">
							  			<label>Fecha auto de subrogación</label>   
							  			<input type="text" class="form-control datemask1" placeholder="Fecha auto de subrogación"  id="txtFechaAutoSub" name="txtFechaAutoSub"  disabled>
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-6"   >
							  			<label>Valor facturado auto de subrogación</label>
							  			<select class="form-control" id="txtValorFacturadoAutoSub" name="txtValorFacturadoAutoSub"  disabled>
							  				<option value="0" >Seleccione</option>
							  				<?php 
							  					foreach ($subrogaciones as $key) {
							  						echo '<option value="'.$key->vcp_total_pago.'">$ '.number_format($key->vcp_total_pago).'</option>';
							  					}
							  				?>
							  			</select>
							  			<!--<input type="text"  placeholder="Valor facturado auto de subrogación"  > -->
							  		</div>
							  		
							  	</div>
						
							</div>
						</div>
						<!-- IRRECUPERABLE -->
						<div class="box-header with-border">
							<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseIrrecuperable">
									IRRECUPERABLE
								</a>
							</h4>
						</div>
						<div id="collapseIrrecuperable" class="panel-collapse collapse">
							<div class="box-body">
							  	<div class="row">
							  		<div class="col-md-6"   >
							  			<label>No. Factura sentencia irrecuperable</label> 
							  			<input type="text" class="form-control" placeholder="No. Factura sentencia irrecuperable"  id="txtFacturaSentenciaIrr" name="txtFacturaSentenciaIrr"  disabled> 
							  		</div>
							  		<div class="col-md-6"  >
							  			<label>Fecha sentencia irrecuperable</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha sentencia irrecuperable"  id="txtFechaSentenciaIrr" name="txtFechaSentenciaIrr"  disabled> 
							  		</div>
							  		
							  	</div>
							  	<div class="row">
							  		<div class="col-md-6">
							  			<label>Fecha de factura sentencia irrecuperable</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha de factura sentencia irrecuperable"  id="txtFechaFacturaIrr" name="txtFechaFacturaIrr"  disabled> 
							  		</div>
							  		
							  		<div class="col-md-6">
							  			<label>Fecha liquidación crédito</label>   
							  			<input type="text" class="form-control datemask1" placeholder="Fecha liquidación crédito"  id="txtFechaLiquidacionIrr" name="txtFechaLiquidacionIrr"  disabled> 
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-6">
							  			<label>Fecha auto de subrogación</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha auto de subrogación"  id="txtFechaAutoSubrogacionIrr" name="txtFechaAutoSubrogacionIrr"  disabled> 
							  		</div>
							  		<div class="col-md-6">
							  			<label>Valor facturado sentencia irrecuperable</label> 
							  			<select class="form-control"  id="txtValorFActuradoIrr" name="txtValorFActuradoIrr"  disabled>
							  				<option value="0" >Seleccione</option>
							  				<?php 
							  					foreach ($Irrecuperables as $key) {
							  						echo '<option value="'.$key->vcp_total_pago.'">$ '.number_format($key->vcp_total_pago).'</option>';
							  					}
							  				?>
							  			</select>
							  			<!--<input type="text" class="form-control" placeholder="Valor facturado sentencia irrecuperable"  id="txtValorFActuradoIrr" name="txtValorFActuradoIrr"  disabled> -->
							  		</div>
							  	</div>
						
							</div>
						</div>
						<!-- CISA -->
						<div class="box-header with-border">
							<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseSoporte">
									SOPORTES CISA
								</a>
							</h4>
						</div>
						<div id="collapseSoporte" class="panel-collapse collapse">
							<div class="box-body">
								<div class="row">
							  		<div class="col-md-6"   >
							  			<label>Fecha recepción soporte</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha recepción soporte"  id="txtFechaRecepcion" name="txtFechaRecepcion"  disabled> 
							  		</div>
							  		<div class="col-md-6"  >
							  			<label>Fecha aprobación soporte</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha aprobación"  id="txtFechaAprobacion" name="txtFechaAprobacion"  disabled> 
							  		</div>
			
							  	</div>
							  	<div class="row">
							  		<div class="col-md-6"   >
							  			<label>No. Factura soportes CISA</label> 
							  			<input type="text" class="form-control" placeholder="No. Facturas soportes CISA"  id="txtFacturaCISA" name="txtFacturaCISA"  disabled> 
							  		</div>
							  		<div class="col-md-6"  >
							  			<label>Fecha factura soportes CISA</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha factura soportes CISA"  id="txtFechaFacturaCISA" name="txtFechaFacturaCISA"  disabled> 
							  		</div>
			
							  	</div>
							  	<div class="row">
							  		<div class="col-md-6">
							  			<label>Soporte</label> 
							  			<select class="form-control" name="txtSoporteCISA" id="txtSoporteCISA" disabled>
							  				<option value="0">Seleccione</option>
							  				<?php 
							  					foreach ($sino as $key) {
							  						echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
							  					}
						  					?>
							  			</select>
							  			 
							  		</div>
							  		<div class="col-md-6">
							  			<label>Renuncia y paz y salvo o cesión</label> 
							  			<select class="form-control" name="txtRenunciaCISA" id="txtRenunciaCISA" disabled>
							  				<option value="0">Seleccione</option>
							  				<?php 
							  					foreach ($renucia as $key) {
							  						echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
							  					}
						  					?>
							  			</select>
							  			
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-6">
							  			<label>Valor facturado soportes CISA</label> 
							  			<input type="text" class="form-control" placeholder="Valor facturado soportes CISA"  id="txtValoFacturadoCISA" name="txtValoFacturadoCISA"  disabled> 
							  		</div>
							  		
							  	</div>
								
							</div>
						</div>

						<div class="box-header with-border">
							<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseCISA">
									HONORARIOS CISA
								</a>
							</h4>
						</div>
						<div id="collapseCISA" class="panel-collapse collapse">
							  	<div class="row">
							  			
							  		<div class="col-md-6">
							  
							  			<label>No. Factura honorarios venta CISA</label> 
							  			<input type="text" class="form-control" placeholder="No. Factura honorarios venta CISA"  id="txtFacturaHonorariosCISA" name="txtFacturaHonorariosCISA"  disabled> 
							  		</div>
							  		<div class="col-md-6">
							  			<label>Fecha de factura honorarios venta CISA</label> 
							  			<input type="text" class="form-control datemask1" placeholder="Fecha de factura honorarios venta CISA"  id="txtFechaFacturaHonorariosCISA" name="txtFechaFacturaHonorariosCISA"  disabled> 
							  		</div>
							  	</div>
								<div class="row">
							  		
							  		<div class="col-md-6">
							  			<label>Honorarios venta CISA</label> 
							  			<select class="form-control"  id="txtHonorariosVentaCISA" name="txtHonorariosVentaCISA"  disabled>
							  				<option value="0" >Seleccione</option>
							  				<?php 
							  					foreach ($Honorarios as $key) {
							  						echo '<option value="'.$key->vcp_total_pago.'">$ '.number_format($key->vcp_total_pago).'</option>';
							  					}
							  				?>
							  			</select>

							  			
							  			<!--<input type="text" class="form-control" placeholder="Honorarios venta CISA"  id="txtHonorariosVentaCISA" name="txtHonorariosVentaCISA"  disabled> -->
							  		</div>
							  	</div>
							</div>
						</div>
						<!-- GASTOs 
						<div class="box-header with-border">
							<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen">
									GASTOS JUDICIALES
								</a>
							</h4>
						</div>
						<div id="collapseThirteen" class="panel-collapse collapse">
							<div class="box-body">
								
								<table class="table table-hover" id="tabladatos_Extras">
									<thead>
										<tr>
											<th>No. Cuenta de cobro gastos judiciales</th>
											<th>Concepto gastos judiciales</th>
											<th>Otro concepto</th>
											<th>Fecha Cuenta de cobro gastos judiciales</th>
											<th>Valor facturado gastos judiciales</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
						  		
							</div>
						</div>-->
					</form>	
				</div>
			</div>
			<div class="row-fluid">
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->
<style type="text/css">
	.dataTables_filter input {width:40px; }
</style>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">
	

	$.validator.setDefaults({
	    submitHandler: function() { 
	         $("#FrmAbogados").submit();
	    }
	});

	$(function(){
		$.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "yyyy-mm-dd",
            titleFormat: "dd/mm/yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

         //datemask1 dd/mm/yyyy
        $(".datemask1").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        });

		$("#tblAbogados").DataTable({

			"aaData": <?php echo $obligaciones; ?>,
			"aoColumns": [
				{ mData: "obligacion" }
			],
		 	"lengthChange": false,
			"bJQueryUI": true,
			"bProcessing": true,
			"bSort": false,
			"bSortClasses": false,
			"bDeferRender": true,
			"sPaginationType": "simple",
			"autoWidth": false,
			"oLanguage": {
				"sLengthMenu": "_MENU_.",
				"sZeroRecords": "No hay registros",
				"sInfo": "_START_ a _END_ de _TOTAL_ registros",
				"sInfoEmpty": "0 a 0 de 0 registros",
				"sInfoFiltered": "(Filtrado de _MAX_ total registros)",
				"sSearch": "Buscar",
				"oPaginate": {
					"sNext": ">>",
					"sPrevious": "<<"
				}
				
			},
			"iDisplayLength": 10,
			"aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]],
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				var id = aData.G719_ConsInte__b;
				$(nRow).attr("dato",id);
				$(nRow).attr("class",'trobligacion');
				
				return nRow;
			   
			},
			"fnDrawCallback": function (oSettings, json) {
			   //Aqui va el comando para activar los otros botones
			  
				$(".trobligacion").dblclick(function(){
					var garantia = $(this).attr('dato');
               		getdatos(garantia, $(this).text());
                });
			   
			},
			
	    });

		


	    



		$("#agregar").click(function(){
			$("#txtFacturaAutoSub").prop('disabled', false);
			$("#txtFechaAutoSub").prop('disabled', false);
			$("#txtFechaFacuraSub").prop('disabled', false);
			$("#txtValorFacturadoAutoSub").prop('disabled', false);
			$("#NumeroContratoTex").prop('disabled', false);
			

			$("#txtValorFActuradoIrr").prop('disabled', false);
			$("#txtFechaLiquidacionIrr").prop('disabled', false);
			$("#txtFechaFacturaIrr").prop('disabled', false);
			$("#txtFechaSentenciaIrr").prop('disabled', false);
			$("#txtFacturaSentenciaIrr").prop('disabled', false);
			$("#txtFechaAutoSubrogacionIrr").prop('disabled', false);

			$("#txtHonorariosVentaCISA").prop('disabled', false);
			$("#txtRenunciaCISA").prop('disabled', false);
			$("#txtSoporteCISA").prop('disabled', false);
			$("#txtFacturaCISA").prop('disabled', false);
			$("#txtFacturaHonorariosCISA").prop('disabled', false);
			$("#txtValoFacturadoCISA").prop('disabled', false);
			$("#txtFechaFacturaCISA").prop('disabled', false);
			$("#txtFechaFacturaHonorariosCISA").prop('disabled', false);

			$("#txtFechaAprobacion").prop('disabled', false);
			$("#txtFechaRecepcion").prop('disabled', false);


			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);

			$("#NumeroContratoTex").blur(function(){
				$("#txtFacturaAutoSub").prop('required', true);
				$("#txtFechaAutoSub").prop('required', true);
				$("#txtFechaFacuraSub").prop('required', true);
				$("#txtValorFacturadoAutoSub").prop('required', true);
				$("#NumeroContratoTex").prop('required', true);
			});



		});

		$("#edit").click(function(){
			$("#txtFacturaAutoSub").prop('disabled', false);
			$("#txtFechaAutoSub").prop('disabled', false);
			$("#txtFechaFacuraSub").prop('disabled', false);
			$("#txtValorFacturadoAutoSub").prop('disabled', false);
			$("#NumeroContratoTex").prop('disabled', false);
			

			$("#txtValorFActuradoIrr").prop('disabled', false);
			$("#txtFechaLiquidacionIrr").prop('disabled', false);
			$("#txtFechaFacturaIrr").prop('disabled', false);
			$("#txtFechaSentenciaIrr").prop('disabled', false);
			$("#txtFacturaSentenciaIrr").prop('disabled', false);
			$("#txtFechaAutoSubrogacionIrr").prop('disabled', false);

			$("#txtHonorariosVentaCISA").prop('disabled', false);
			$("#txtRenunciaCISA").prop('disabled', false);
			$("#txtSoporteCISA").prop('disabled', false);
			$("#txtFacturaCISA").prop('disabled', false);
			$("#txtFacturaHonorariosCISA").prop('disabled', false);
			$("#txtValoFacturadoCISA").prop('disabled', false);
			$("#txtFechaFacturaCISA").prop('disabled', false);
			$("#txtFechaFacturaHonorariosCISA").prop('disabled', false);

			$("#txtFechaAprobacion").prop('disabled', false);
			$("#txtFechaRecepcion").prop('disabled', false);


			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#txtFacturaAutoSub").prop('disabled', true);
			$("#txtFechaAutoSub").prop('disabled', true);
			$("#txtFechaFacuraSub").prop('disabled', true);
			$("#txtValorFacturadoAutoSub").prop('disabled', true);
			$("#NumeroContratoTex").prop('disabled', true);
			

			$("#txtValorFActuradoIrr").prop('disabled', true);
			$("#txtFechaLiquidacionIrr").prop('disabled', true);
			$("#txtFechaFacturaIrr").prop('disabled', true);
			$("#txtFechaSentenciaIrr").prop('disabled', true);
			$("#txtFacturaSentenciaIrr").prop('disabled', true);
			$("#txtFechaAutoSubrogacionIrr").prop('disabled', true);

			$("#txtHonorariosVentaCISA").prop('disabled', true);
			$("#txtRenunciaCISA").prop('disabled', true);
			$("#txtSoporteCISA").prop('disabled', true);
			$("#txtFacturaCISA").prop('disabled', true);
			$("#txtFacturaHonorariosCISA").prop('disabled', true);
			$("#txtValoFacturadoCISA").prop('disabled', true);
			$("#txtFechaFacturaCISA").prop('disabled', true);
			$("#txtFechaFacturaHonorariosCISA").prop('disabled', true);
			$("#const_int_").val(0);


			$("#txtFechaAprobacion").prop('disabled', true);
			$("#txtFechaRecepcion").prop('disabled', true);

			$("#txtFacturaAutoSub").prop('required', false);
			$("#txtFechaAutoSub").prop('required', false);
			$("#txtFechaFacuraSub").prop('required', false);
			$("#txtValorFacturadoAutoSub").prop('required', false);
			$("#NumeroContratoTex").prop('required', false);
			

			$("#txtValorFActuradoIrr").prop('required', false);
			$("#txtFechaLiquidacionIrr").prop('required', false);
			$("#txtFechaFacturaIrr").prop('required', false);
			$("#txtFechaSentenciaIrr").prop('required', false);
			$("#txtFacturaSentenciaIrr").prop('required', false);
			$("#txtFechaAutoSubrogacionIrr").prop('required', false);

			$("#txtHonorariosVentaCISA").prop('required', false);
			$("#txtRenunciaCISA").prop('required', false);
			$("#txtSoporteCISA").prop('required', false);
			$("#txtFacturaCISA").prop('required', false);
			$("#txtFacturaHonorariosCISA").prop('required', false);
			$("#txtValoFacturadoCISA").prop('required', false);
			$("#txtFechaFacturaCISA").prop('required', false);
			$("#txtFechaFacturaHonorariosCISA").prop('required', false);

			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
			$("#Save").attr('disabled', true);
	
		});

		

		$("#delete").click(function(){
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
			    	if (e) {
		         	 	 
		                $.ajax({
			            	url: '<?php echo base_url();?>auxiliar/eliminarFacturas',  
			            	type: 'POST',
				            data: { id : $("#const_int_").val() },
				            //una vez finalizado correctamente
				            success: function(data){
				            	if(data == '1'){
				            		alertify.success('Datos eliminados correctamente');
				            		window.location.reload(true);
				            	}else{
				            		alertify.error('Un error a ocurrido');
				            	}
				               
				                
				            },
				            //si ha ocurrido un error
				            error: function(){
				                alertify.error('Ocurrio un error relacionado con la red, al momento de guardar, intenta mas tarde');
				            }
				        });
				    } else {
				        // user clicked "cancel"
				    }
				});
		});
		
		
		$("#txtFacturaAutoSub").blur(function(){
			$("#txtFacturaAutoSub").prop('required', true);
			$("#txtFechaAutoSub").prop('required', true);
			$("#txtFechaFacuraSub").prop('required', true);
			$("#txtValorFacturadoAutoSub").prop('required', true);
			$("#NumeroContratoTex").prop('required', true);
		});


		$("#txtFechaFacuraSub").blur(function(){
			$("#txtFacturaAutoSub").prop('required', true);
			$("#txtFechaAutoSub").prop('required', true);
			$("#txtFechaFacuraSub").prop('required', true);
			$("#txtValorFacturadoAutoSub").prop('required', true);
			$("#NumeroContratoTex").prop('required', true);
		});


		$("#txtValorFacturadoAutoSub").change(function(){
			$("#txtFacturaAutoSub").prop('required', true);
			$("#txtFechaAutoSub").prop('required', true);
			$("#txtFechaFacuraSub").prop('required', true);
			$("#txtValorFacturadoAutoSub").prop('required', true);
			$("#NumeroContratoTex").prop('required', true);
		});

		/*$("#txtValorFacturadoAutoSub").blur(function(){
			$("#txtFacturaAutoSub").prop('required', true);
			$("#txtFechaAutoSub").prop('required', true);
			$("#txtFechaFacuraSub").prop('required', true);
			$("#txtValorFacturadoAutoSub").prop('required', true);
			$("#NumeroContratoTex").prop('required', true);
		});
*/
		/* irrecuperables  */

		$("#txtFacturaSentenciaIrr").blur(function(){
			$("#txtValorFActuradoIrr").prop('required', true);
			$("#txtFechaLiquidacionIrr").prop('required', true);
			$("#txtFechaFacturaIrr").prop('required', true);
			$("#txtFechaSentenciaIrr").prop('required', true);
			$("#txtFacturaSentenciaIrr").prop('required', true);
			$("#txtFechaAutoSubrogacionIrr").prop('required', true);
		});

		$("#txtValorFActuradoIrr").change(function(){
			$("#txtValorFActuradoIrr").prop('required', true);
			$("#txtFechaLiquidacionIrr").prop('required', true);
			$("#txtFechaFacturaIrr").prop('required', true);
			$("#txtFechaSentenciaIrr").prop('required', true);
			$("#txtFacturaSentenciaIrr").prop('required', true);
			$("#txtFechaAutoSubrogacionIrr").prop('required', true);
		});

		$("#txtFechaLiquidacionIrr").blur(function(){
			$("#txtValorFActuradoIrr").prop('required', true);
			$("#txtFechaLiquidacionIrr").prop('required', true);
			$("#txtFechaFacturaIrr").prop('required', true);
			$("#txtFechaSentenciaIrr").prop('required', true);
			$("#txtFacturaSentenciaIrr").prop('required', true);
			$("#txtFechaAutoSubrogacionIrr").prop('required', true);
		});

		$("#txtFechaFacturaIrr").blur(function(){
			$("#txtValorFActuradoIrr").prop('required', true);
			$("#txtFechaLiquidacionIrr").prop('required', true);
			$("#txtFechaFacturaIrr").prop('required', true);
			$("#txtFechaSentenciaIrr").prop('required', true);
			$("#txtFacturaSentenciaIrr").prop('required', true);
			$("#txtFechaAutoSubrogacionIrr").prop('required', true);
		});


		$("#txtFechaSentenciaIrr").blur(function(){
			$("#txtValorFActuradoIrr").prop('required', true);
			$("#txtFechaLiquidacionIrr").prop('required', true);
			$("#txtFechaFacturaIrr").prop('required', true);
			$("#txtFechaSentenciaIrr").prop('required', true);
			$("#txtFacturaSentenciaIrr").prop('required', true);
			$("#txtFechaAutoSubrogacionIrr").prop('required', true);
		});

		$("#txtFechaAutoSubrogacionIrr").blur(function(){
			$("#txtValorFActuradoIrr").prop('required', true);
			$("#txtFechaLiquidacionIrr").prop('required', true);
			$("#txtFechaFacturaIrr").prop('required', true);
			$("#txtFechaSentenciaIrr").prop('required', true);
			$("#txtFacturaSentenciaIrr").prop('required', true);
			$("#txtFechaAutoSubrogacionIrr").prop('required', true);
		});


		/* CISA */
		$("#txtFacturaCISA").blur(function(){
			//$("#txtHonorariosVentaCISA").prop('required', true);
			$("#txtRenunciaCISA").prop('required', true);
			$("#txtSoporteCISA").prop('required', true);
			$("#txtFacturaCISA").prop('required', true);
			//$("#txtFacturaHonorariosCISA").prop('required', true);
			
			/*$("#txtFechaAprobacion").prop('disabled', false);
			$("#txtFechaRecepcion").prop('disabled', false);*/
		});

		$("#txtHonorariosVentaCISA").blur(function(){
			//$("#txtHonorariosVentaCISA").prop('required', true);
			//$("#txtRenunciaCISA").prop('required', true);
			//$("#txtSoporteCISA").prop('required', true);
			//$("#txtFacturaCISA").prop('required', true);
			$("#txtFacturaHonorariosCISA").prop('required', true);
			
		});

		$("#txtRenunciaCISA").blur(function(){
			//$("#txtHonorariosVentaCISA").prop('required', true);
			$("#txtRenunciaCISA").prop('required', true);
			$("#txtSoporteCISA").prop('required', true);
			$("#txtFacturaCISA").prop('required', true);
			//$("#txtFacturaHonorariosCISA").prop('required', true);
			
		});

		$("#txtSoporteCISA").blur(function(){
			//$("#txtHonorariosVentaCISA").prop('required', true);
			$("#txtRenunciaCISA").prop('required', true);
			$("#txtSoporteCISA").prop('required', true);
			$("#txtFacturaCISA").prop('required', true);
			//$("#txtFacturaHonorariosCISA").prop('required', true);
			
		});

		$("#txtFacturaHonorariosCISA").blur(function(){
			$("#txtHonorariosVentaCISA").prop('required', true);
			//$("#txtRenunciaCISA").prop('required', true);
			//$("#txtSoporteCISA").prop('required', true);
			//$("#txtFacturaCISA").prop('required', true);
			$("#txtFacturaHonorariosCISA").prop('required', true);
			
		});

		/*$("#txtValoFacturadoCISA").blur(function(){
			
			$("#txtValoFacturadoCISA").prop('required', true);
			$("#txtFechaFacturaCISA").prop('required', true);
			$("#txtFechaFacturaHonorariosCISA").prop('required', true);
		});*/

		$("#txtFechaFacturaCISA").blur(function(){
			
			$("#txtValoFacturadoCISA").prop('required', true);
			$("#txtFechaFacturaCISA").prop('required', true);
			//$("#txtFechaFacturaHonorariosCISA").prop('required', true);
		});

		$("#txtFechaFacturaHonorariosCISA").blur(function(){
			
//			$("#txtValoFacturadoCISA").prop('required', true);
			$("#txtFechaFacturaCISA").prop('required', true);
			$("#txtFechaFacturaHonorariosCISA").prop('required', true);
		});


		
		


		$("#Save").click(function(){
			alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
			    	if (e) {
						var form = $("#FrmAbogados");
						if(form.valid()){
				  			var formData = new FormData($("#FrmAbogados")[0]);
				          	$.ajax({
				            	url: '<?php echo base_url();?>auxiliar/guardarFacturas',  
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
					            		window.location.reload(true);
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
				 	} else {
				        // user clicked "cancel"
				    }	
				});
		});

		$("#btnFiltrar2").click(function(){
			validarContrato($("#NumeroContratoTex").val());
		});

		$("#NumeroContratoTex").keypress(function(e){
     		if(e.keyCode == 13)
		    {
		        validarContrato($(this).val());
		    }
     	});
	});

	function getId(getId){
	
		$.ajax({
			url     : '<?php echo base_url();?>auxiliar/getIdContrato/'+getId,
			type    : 'POST',
			success : function(data){
				if(data.length > 0){
					getdatos(data, getId);
					//alert(data);
				}else{
					alertify.error('Ese numero de contrato no existe');
				}
			}
		});
	}

	function validarContrato(getId){
	
		$.ajax({
			url     : '<?php echo base_url();?>auxiliar/getIdContrato/'+getId,
			type    : 'POST',
			success : function(data){
				if(data.length > 0){
					$("#NumeroContrato").val(data);
					alertify.success('Numero de contrato Valido!');
				}else{
					alertify.error('Ese numero de contrato no existe');
				}
			}
		});
	}

	function getdatos(varid, contrato){

		$("#txtFacturaAutoSub").prop('disabled', true);
		$("#txtFechaAutoSub").prop('disabled', true);
		$("#txtFechaFacuraSub").prop('disabled', true);
		$("#txtValorFacturadoAutoSub").prop('disabled', true);
		$("#NumeroContratoTex").prop('disabled', true);
		

		$("#txtValorFActuradoIrr").prop('disabled', true);
		$("#txtFechaLiquidacionIrr").prop('disabled', true);
		$("#txtFechaFacturaIrr").prop('disabled', true);
		$("#txtFechaSentenciaIrr").prop('disabled', true);
		$("#txtFacturaSentenciaIrr").prop('disabled', true);
		$("#txtFechaAutoSubrogacionIrr").prop('disabled', true);

		$("#txtHonorariosVentaCISA").prop('disabled', true);
		$("#txtRenunciaCISA").prop('disabled', true);
		$("#txtSoporteCISA").prop('disabled', true);
		$("#txtFacturaCISA").prop('disabled', true);
		$("#txtFacturaHonorariosCISA").prop('disabled', true);
		$("#txtValoFacturadoCISA").prop('disabled', true);
		$("#txtFechaFacturaCISA").prop('disabled', true);
		$("#txtFechaFacturaHonorariosCISA").prop('disabled', true);

		$("#txtFechaAprobacion").prop('disabled', true);
		$("#txtFechaRecepcion").prop('disabled', true);
		

		$("#txtFacturaAutoSub").val('');
		$("#txtFechaAutoSub").val('');
		$("#txtFechaFacuraSub").val('');
		$("#txtValorFacturadoAutoSub").val('');
		$("#NumeroContratoTex").val('');
		

		$("#txtValorFActuradoIrr").val('');
		$("#txtFechaLiquidacionIrr").val('');
		$("#txtFechaFacturaIrr").val('');
		$("#txtFechaSentenciaIrr").val('');
		$("#txtFacturaSentenciaIrr").val('');
		$("#txtFechaAutoSubrogacionIrr").val('');

		$("#txtHonorariosVentaCISA").val('');
		$("#txtRenunciaCISA").val(0);
		$("#txtSoporteCISA").val(0);
		$("#txtFacturaCISA").val('');
		$("#txtFacturaHonorariosCISA").val('');
		$("#txtValoFacturadoCISA").val('');
		$("#txtFechaFacturaCISA").val('');
		$("#txtFechaFacturaHonorariosCISA").val('');
	
		$("#const_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosFacturasForupdate/'+varid, {format: "json"}, function(data) { 
			
			
			$("#NumeroContrato").val(varid);
			$("#NumeroContratoTex").val(contrato);
			if(data.length > 0){

				$("#const_int_").val(data[0].id);
				$("#txtFacturaAutoSub").val(data[0].N_DE_FACTURA_AUTO_DE_SUBROGACION);
				$("#txtFechaAutoSub").val(data[0].FECHA_AUTO_DE_SUBROGACION);
				$("#txtFechaFacuraSub").val(data[0].FECHA_DE_FACTURA_AUTO_DE_SUBROGACION);


				if( data[0].VALOR_FACTURADO_AUTO_DE_SUBROGACION != null){
					$("#txtValorFacturadoAutoSub option").filter(function() {
					    //may want to use $.trim in here
					    return $(this).val() == data[0].VALOR_FACTURADO_AUTO_DE_SUBROGACION; 
					}).prop('selected', true);
				}else{
					$("#txtValorFacturadoAutoSub option").filter(function() {
					    //may want to use $.trim in here
					    return $(this).val() == 0; 
					}).prop('selected', true);
				}

				
				
				
				if( data[0].VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE != null){
					$("#txtValorFActuradoIrr option").filter(function() {
					    //may want to use $.trim in here
					    return $(this).val() == data[0].VALOR_FACTURADO_SENTENCIA_IRRECUPERABLE; 
					}).prop('selected', true);
				}else{
					$("#txtValorFActuradoIrr option").filter(function() {
					    //may want to use $.trim in here
					    return $(this).val() == 0; 
					}).prop('selected', true);
				}
				
				
				$("#txtFechaLiquidacionIrr").val(data[0].FECHA_LIQUIDACION_CREDITO);
				$("#txtFechaFacturaIrr").val(data[0].FECHA_DE_FACTURA_SENTENCIA_IRRECUPERABLE);
				$("#txtFechaSentenciaIrr").val(data[0].FECHA_SENTENCIA_IRRECUPERABLE);
				$("#txtFacturaSentenciaIrr").val(data[0].N_DE_FACTURA_SENTENCIA_IRRECUPERABLE);
				$("#txtFechaAutoSubrogacionIrr").val(data[0].FECHA_AUTO_DE_SUBROGACION2);
				$("#txtFechaAprobacion").val(data[0].FECHAAPROBACION);
				$("#txtFechaRecepcion").val(data[0].FECHARECPCION);
				//$("#txtHonorariosVentaCISA").val(data[0].HONORARIOS_VENTA_CISA);
				

				if( data[0].HONORARIOS_VENTA_CISA != null){
					$("#txtHonorariosVentaCISA option").filter(function() {
					    //may want to use $.trim in here
					    return $(this).val() == data[0].HONORARIOS_VENTA_CISA; 
					}).prop('selected', true);
				}else{
					$("#txtHonorariosVentaCISA option").filter(function() {
					    //may want to use $.trim in here
					    return $(this).val() == 0; 
					}).prop('selected', true);
				}


				$("#txtRenunciaCISA option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == data[0].RENUNCIA_Y_PAZ_Y_SALVO_O_CESION; 
				}).prop('selected', true);

				
				$("#txtSoporteCISA option").filter(function() {
			    //may want to use $.trim in here
				    return $(this).val() == data[0].SOPORTE; 
				}).prop('selected', true);


				$("#txtFacturaCISA").val(data[0].N_DE_FACTURAS_SOPORTES_CISA);
				$("#txtFacturaHonorariosCISA").val(data[0].N_Factura_honorarios_venta_CISA);
				$("#txtValoFacturadoCISA").val(data[0].VALOR_FACTURADO_SOPORTES_CISA);
				$("#txtFechaFacturaCISA").val(data[0].FECHA_FACTURA_SOPORTES_CISA);
				$("#txtFechaFacturaHonorariosCISA").val(data[0].Fecha_de_factura_honorarios_venta_CISA);

				$("#agregar").attr('disabled', true);
				$("#edit").attr('disabled', false);
				$("#delete").attr('disabled', false);
				$("#cancel").attr('disabled', true);
				$("#Save").attr('disabled', true);

			}else{

				$("#txtFacturaAutoSub").prop('disabled', false);
				$("#txtFechaAutoSub").prop('disabled', false);
				$("#txtFechaFacuraSub").prop('disabled', false);
				$("#txtValorFacturadoAutoSub").prop('disabled', false);
				$("#NumeroContratoTex").prop('disabled', true);
				

				$("#txtValorFActuradoIrr").prop('disabled', false);
				$("#txtFechaLiquidacionIrr").prop('disabled', false);
				$("#txtFechaFacturaIrr").prop('disabled', false);
				$("#txtFechaSentenciaIrr").prop('disabled', false);
				$("#txtFacturaSentenciaIrr").prop('disabled', false);
				$("#txtFechaAutoSubrogacionIrr").prop('disabled', false);

				$("#txtHonorariosVentaCISA").prop('disabled', false);
				$("#txtRenunciaCISA").prop('disabled', false);
				$("#txtSoporteCISA").prop('disabled', false);
				$("#txtFacturaCISA").prop('disabled', false);
				$("#txtFacturaHonorariosCISA").prop('disabled', false);
				$("#txtValoFacturadoCISA").prop('disabled', false);
				$("#txtFechaFacturaCISA").prop('disabled', false);
				$("#txtFechaFacturaHonorariosCISA").prop('disabled', false);

				$("#txtFechaAprobacion").prop('disabled', false);
				$("#txtFechaRecepcion").prop('disabled', false);

				$("#cancel").attr('disabled', false);
				$("#Save").attr('disabled', false);
				$("#agregar").attr('disabled', true);
				$("#edit").attr('disabled', true);
				$("#delete").attr('disabled', true);


				
				$("#txtValorFacturadoAutoSub option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == 0; 
				}).prop('selected', true);
				
				$("#txtValorFActuradoIrr option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == 0; 
				}).prop('selected', true);
				
				
				$("#txtHonorariosVentaCISA option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == 0; 
				}).prop('selected', true);
				




			}
			
			
		});

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosgastoJudiciales/'+varid, {format: "json"}, function(data) { 
			if($.fn.dataTable.isDataTable( '#tabladatos_Extras' )){
				$("#tabladatos_Extras").dataTable().fnDestroy();
			}

				
			$("#tabladatos_Extras").DataTable({
				"aaData": data,
				"aoColumns": [
					{ mData: "CuentaCobro" }
					,{ mData: "Concepto" }
					,{ mData: "Otro" }
					,{ mData: "FechaCobro" }
					,{ mData: "Valor" }
				],
			 
				"bJQueryUI": true,
				"bProcessing": true,
				"bSort": false,
				"bSortClasses": false,
				"bDeferRender": true,
				"sPaginationType": "simple",
				"oLanguage": {
					"sLengthMenu": "_MENU_ reg.",
					"sZeroRecords": "No hay registros",
					"sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
					"sInfoEmpty": "0 a 0 de 0 registros",
					"sInfoFiltered": "(Filtrado de _MAX_ total registros)",
					"sSearch": "",
					"oPaginate": {
						"sNext": ">>",
						"sPrevious": "<<"
					}
					
				},
				"iDisplayLength": 10,
				"aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]],
				"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
					var id = aData[0];
					$(nRow).attr("dato",id);
					$(nRow).attr("class",'trobligacion');
					
					return nRow;
				   
				},
				"fnDrawCallback": function (oSettings, json) {
				   //Aqui va el comando para activar los otros botones
				  
					$(".trobligacion").dblclick(function(){
						var garantia = $(this).find("td:first").html().replace(' ', '');
	               		getId(garantia);
	                });
				   
				},
	   		});
		});
	}
</script>
