<section class="content-header">
    <h1>
        ACUERDOS DE PAGO
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Acuerdos de pago</li>
    </ol>
</section>

<section class="content">
	<div class="box">
        <div class="box-body">
                  
			
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
				<div class="col-md-5">
					<form id="FrmAbogados" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Número de Liquidación</label> 
						  			<div class="input-group input-group-sm">
							            <input type="text" class="form-control"  placeholder="Número de Liquidación"  id="Nocontrato" name="Nocontrato" required disabled>
							            <span class="input-group-btn">
							              	<button disabled class="btn btn-info btn-flat" id="btnFiltrar2" type="button"><i class="fa fa-search"></i></button>
							            </span>
							      	</div>
								</div>
								<div class="form-group">
									<Label>Fecha consignación anticipo</Label>
									<input type="text" class="form-control datemask" placeholder="Fecha consignación anticipo"  id="FechaAnticipo" name="FechaAnticipo" required disabled>
								</div>
								<div class="form-group">
									<Label >Valor del acuerdo</Label>
									<input type="text" class="form-control" placeholder="Valor del acuerdo"  id="ValorAcuerdo" name="ValorAcuerdo" required disabled>
								</div>
								<div class="form-group">
									<Label >Valor cuota del acuerdo</Label>
									<input type="text" class="form-control" placeholder="Valor cuota del acuerdo"  id="Cuota" name="Cuota" required disabled>
								</div>
								<div class="form-group">
									<Label >Fecha de pago de la última cuota</Label>
									<input type="text" class="form-control datemask" placeholder="Fecha de pago de la última cuota"  id="FechaPagoUltimaCuota" name="FechaPagoUltimaCuota"  disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<Label >Fecha liquidación</Label>
									<input type="text" class="form-control datemask" placeholder="Fecha liquidación"  id="FechaLiquidacion" name="FechaLiquidacion" required disabled>
								</div>
								<div class="form-group">
									<Label>Fecha legalización</Label>
									<input type="text" class="form-control datemask" placeholder="Fecha legalización"  id="Legalizacion" name="Legalizacion" required disabled>
								</div>
								<div class="form-group">
									<Label>Plazo acuerdo de pago</Label>
									<input type="text" class="form-control" placeholder="Plazo acuerdo de pago"  id="AcuerdoPlazo" name="AcuerdoPlazo" required disabled>
								</div>
								<div class="form-group">
									<Label>Fecha de pago de la primera cuota</Label>
									<input type="text" class="form-control datemask" placeholder="Fecha de pago de la primera cuota"  id="FechaPrimeraCuoota" name="FechaPrimeraCuoota"  disabled>
								</div>
								<div class="form-group">
									<Label>Taza de interés corriente %</Label>
									<input type="text" class="form-control" placeholder="Taza de interés corriente %"  id="TazaInteres" name="TazaInteres"  disabled>
								</div>
							</div>
						</div>
						<input type="hidden" id="const_int_" name="id" value="0">	
						<input type="hidden" id="const_contrato_" name="const_contrato_" value="0">
						
					</form>
					
				</div>
				<div class="col-md-7">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Obligaciones</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th  style="text-align:center;">No. Liquidaci&oacute;n</th>
										
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($clientes as $key) {

											
											if($key->liquidacion != '' && !is_null($key->liquidacion)){
						                     	echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->id.');">'.$key->liquidacion.'</td>
												  </tr>';
							                }
																		
										}
									?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
			
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/Validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">


	$.validator.setDefaults({
	    submitHandler: function() { 
	         $("#FrmAbogados").submit();
	    }
	});

	$(function(){

		$("#tblAbogados").DataTable({
				"oLanguage": {
	                "sLengthMenu": "_MENU_ registros por página ",
	                "sZeroRecords": "0 resultados en el criterio de busqueda",
	                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
	                "sInfoEmpty": "0 a 0 de 0 registros",
	                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
	                "sSearch": "Buscar:",
	                "sPaginationType": "simple",
	                "oPaginate": {
				        "sNext": ">>",
				        "sPrevious": "<<",
				        "sFirst":    "|<<",
            			"sLast":    ">>|",
			      	}
	            },
	           "iDisplayLength": 10,
	           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
	    });



		

		$("#edit").click(function(){
			//$("#Legalizacion").attr('disabled', false);
			//$("#Nocontrato").attr('disabled', true);
			$("#FechaAnticipo").attr('disabled', false);
			//$("#ValorAcuerdo").attr('disabled', false);
			//$("#Cuota").attr('disabled', false);
			$("#FechaPagoUltimaCuota").attr('disabled', false);
			$("#FechaLiquidacion").attr('disabled', false);
			$("#AcuerdoPlazo").attr('disabled', false);
			$("#FechaPrimeraCuoota").attr('disabled', false);
			//$("#TazaInteres").attr('disabled', false);
			//$("#btnFiltrar2").attr('disabled', false);
			
			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#Legalizacion").attr('disabled', true);
			$("#Nocontrato").attr('disabled', true);
			$("#FechaAnticipo").attr('disabled', true);
			$("#ValorAcuerdo").attr('disabled', true);
			$("#Cuota").attr('disabled', true);
			$("#FechaPagoUltimaCuota").attr('disabled', true);
			$("#FechaLiquidacion").attr('disabled', true);
			$("#AcuerdoPlazo").attr('disabled', true);
			$("#FechaPrimeraCuoota").attr('disabled', true);
			$("#TazaInteres").attr('disabled', true);
			$("#btnFiltrar2").attr('disabled', true);

			$(this).attr('disabled', true);

			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
			$("#Save").attr('disabled', true);
	
		});

		

		$("#delete").click(function(){
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
				if (e) {
					$.ajax({
						url: '<?php echo base_url();?>auxiliar/eliminarAcuerdoPago',  
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

		$("#Save").click(function(){
			alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
		    	if (e) {
					var form = $("#FrmAbogados");
					if(form.valid()){
			  			var formData = new FormData($("#FrmAbogados")[0]);
			          	$.ajax({
			            	url: '<?php echo base_url();?>auxiliar/guardarAcuerdoDePago',  
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
			validarContrato($("#Nocontrato").val());
		});

		$("#Nocontrato").keypress(function(e){
     		if(e.keyCode == 13)
		    {
		        validarContrato($(this).val());
		    }
     	});
	});

	
	function getId(id){
	
		$.ajax({
			url     : '<?php echo base_url();?>auxiliar/getIdContrato/',
			type    : 'POST',
			data : { liquidacion : id},
			success : function(data){
				if(data.length > 0){
					getdatos(data, id);
				}else{
					alertify.error('Ese número de contrato no existe');
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
					alertify.success('Número de contrato Valido!');
				}else{
					alertify.error('Ese número de contrato no existe');
				}
			}
		});
	}
	
	function getdatos(varid, liquidacion){
		$("#const_int_").val(0);
		$("#FechaLiquidacion").val('');
		$("#Legalizacion").val('');
		$("#ValorAcuerdo").val('');
		$("#FechaAnticipo").val('');
		$("#Cuota").val('');
		$("#AcuerdoPlazo").val('');
		$("#TazaInteres").val( '');

		$.getJSON('<?php echo base_url();?>auxiliar/getdatosAcuerdo_pago/'+varid, {format: "json"}, function(data) { 
			$("#const_int_").val(data[0].id);
			$("#const_contrato_").val(data[0].codigo);
			$("#Legalizacion").val(data[0].legalizacion.split(' ')[0]);
			$("#Nocontrato").val(data[0].contrato);

			$("#Nocontrato").attr('disabled', true);
			$("#btnFiltrar2").attr('disabled', true);


			if(data[0].consignacion_ant){
				$("#FechaAnticipo").val(data[0].consignacion_ant.split(' ')[0]);
			}
			
			$("#ValorAcuerdo").val(Number(data[0].valor).toFixed(0));
			
			$("#Cuota").val(Number(data[0].cuota).toFixed(0));
			if(data[0].ultimaCuota){
				$("#FechaPagoUltimaCuota").val(data[0].ultimaCuota.split(' ')[0]);
			}
			
			if(data[0].liquidacion){
				$("#FechaLiquidacion").val(data[0].liquidacion.split(' ')[0]);
			}
			
			$("#AcuerdoPlazo").val(data[0].plazo);
			
			if(data[0].primeracuota){
				$("#FechaPrimeraCuoota").val(data[0].primeracuota.split(' ')[0]);
			}
			
			$("#TazaInteres").val( Number(data[0].interes).toFixed(0));
			
		
		
		

			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);

			$("#cancel").attr('disabled', true);
			$("#Save").attr('disabled', true);
		});
	}
</script>
