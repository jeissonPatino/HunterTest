<section class="content-header">
    <h1>
      FIRMAS DE ABOGADOS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Firmas de abogados</li>
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
					<form id="FrmAbogados" method="post">
						<input type="hidden" id="const_int_" name="id" value="0">
						<div class="form-group">
							<Label >Nombre de la firma</Label>
							<input type="text" class="form-control" placeholder="Nombre de la firma"  id="txtNombre" name="txtNombre" required disabled>
						</div>
						<div class="form-group">
							<Label>Teléfono</Label>
							<input type="text" class="form-control" placeholder="Teléfono"  id="txtTelefono"  name="txtTelefono" disabled>
						</div>
						<div class="form-group">
							<Label>Ciudad</Label>
							<select id="cmbCiudades" name="cmbCiudades" disabled  class="form-control">
								<option value="0">Seleccione</option>
								<?php foreach ($ciudades as $key): ?>
										<option value="<?php echo $key->id;?>"><?php echo utf8_encode($key->ciudad);?> </option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<Label>Dirección</Label>
							<input type="text" class="form-control" placeholder="Dirección"  id="TxtDireccion"  name="TxtDireccion" disabled>
						</div>
						<div class="form-group">
							<Label>Correo Electrónico</Label>
							<input type="text" class="form-control" placeholder="Correo Electronico"  id="correo" name="correo" disabled>
						</div>
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Firmas de abogados</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Nombre</th>
										<th style="text-align:center;">Teléfono</th>
										<th style="text-align:center;">Ciudad</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($firmas as $key) { ?>
										<tr>
											<td onclick="javascript: getdatos(<?php echo $key->G728_ConsInte__b;?>);" style="text-align:center;"><?php echo  utf8_encode($key->nombres);?> </td>
											<td onclick="javascript: getdatos(<?php echo $key->G728_ConsInte__b;?>);"style="text-align:center;"><?php echo  $key->telefono;?> </td>
											<td onclick="javascript: getdatos(<?php echo $key->G728_ConsInte__b;?>);"style="text-align:center;"><?php echo  utf8_encode($key->ciudad);?> </td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->

					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Abogados de la firma</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="Tablaabogados">
								<thead>
									<tr>
										<th style="text-align:center;">Nombre</th>
										<th style="text-align:center;">Cedula</th>
									</tr>
								</thead>
								<tbody>
									
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
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
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
				        "sPrevious": "<<"
			      	}
	            },
	            "sPaginationType": "simple",
	           "iDisplayLength": 10,
	           "aLengthMenu": [[10, 20, 30, 40], [10, 20, 30, 40]]
	    });



		$("#agregar").click(function(){
			$("#txtNombre").prop('disabled', false);
			$("#correo").prop('disabled', false);
			$("#cmbCiudades").prop('disabled', false);
			$("#TxtDireccion").prop('disabled', false);
			$("#txtTelefono").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#txtNombre").prop('disabled', false);
			$("#correo").prop('disabled', false);
			$("#cmbCiudades").prop('disabled', false);

			$("#TxtDireccion").prop('disabled', false);
			$("#txtTelefono").prop('disabled', false);



			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
			$("#delete").attr('disabled', true);
		});

		$("#cancel").click(function(){
			$("#txtNombre").prop('disabled', true);
			$("#correo").prop('disabled', true);
			$("#cmbCiudades").prop('disabled', true);

			$("#TxtDireccion").prop('disabled', true);
			$("#txtTelefono").prop('disabled', true);

			$("#cedula").val("");
			$("#celular").val("");
			$("#nombre").val("");	
			$("#correo").val("");
			$("#delete").attr('disabled', true);


			$(this).attr('disabled', true);
			$("#agregar").attr('disabled', false);
			$("#Save").attr('disabled', true);
			$("#SMLV").val('');
			$("#edit").attr('disabled', true);
		});

		

		$("#delete").click(function(){
			alertify.confirm("¿Ésta seguro que desea eliminar el registro?", function (e) {
		    	if (e) {
	         	 	$.ajax({
		            	url: '<?php echo base_url();?>auxiliar/eliminarFirmas',  
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
			            	url: '<?php echo base_url();?>auxiliar/guardarFirmas',  
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
	});

	function getdatos(varid){
		$.getJSON('<?php echo base_url();?>auxiliar/getDatosFirma/'+varid, {format: "json"}, function(data) { 
			

			$("#cmbCiudades option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].ciudad; 
			}).prop('selected', true);

			$("#txtNombre").val(data[0].nombres);
			$("#correo").val(data[0].correo);
			$("#const_int_").val(data[0].id);

			$("#txtTelefono").val(data[0].telefono);
			$("#TxtDireccion").val(data[0].direccion);

			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);
			$("#cancel").attr('disabled', false);
		});

		$.getJSON('<?php echo base_url();?>auxiliar/getAbogadosByFirma/'+varid, {format: "json"}, function(data) { 
			if($.fn.dataTable.isDataTable( '#Tablaabogados' )){
				$("#Tablaabogados").dataTable().fnDestroy();
			}


			var tblFacturas = $("#Tablaabogados").DataTable({
					"aaData": data,
					"aoColumns": [
			            { mData: "Nombre" },
						{ mData: "cedula"}
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
										   
					},
					"fnDrawCallback": function (oSettings, json) {
					   //Aqui va el comando para activar los otros botones
					   
					},
					
					"bProcessing": true,
					"bSort": true,
					"bSortClasses": false,
					"bDeferRender": true,
					"sPaginationType": "simple",
		            "iDisplayLength": 20,
		            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
		    });
		});

	
	}
</script>
