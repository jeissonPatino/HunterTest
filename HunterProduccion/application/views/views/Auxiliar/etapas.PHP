<section class="content-header">
    <h1>
        ETAPAS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Etapas</li>
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
							<Label>Tipo de Proceso</Label>
							<select id="selProcesos" name ="selProcesos" class="form-control" disabled>
								<option value="0">Tipo de proceso</option>
								<?php 
									foreach ($procesos as $key) {
										echo "<option value='".$key->Id."'>".utf8_encode($key->Nombre_b)."</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<Label >Código etapa</Label>
							<input type="text" class="form-control" placeholder="Código etapa"  id="codigo" name="codigo" required disabled>
						</div>
						<div class="form-group">
							<Label>Etapa FNG</Label>
							<input type="text" class="form-control" placeholder="Etapa FNG"  id="etapa" name="etapa" required disabled>
						</div>
						<div class="form-group">
							<Label>Imagen del boton</Label>
							<input type="file" class="form-control" id="bottonCara" name="bottonCara" disabled>
							<input type="hidden" id="hidenesto" name="hidenesto" value='0'>
						</div>
						<div class="form-group">
							<Label>Orden Etapa</Label>
							<input type="text" placeholder="Orden de la etapa" class="form-control" id="Orden" name="Orden" required disabled>
						</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<img alt="Imagen de la opción" style="margin: 0 auto 0;" width="200" height="200" id="imagen" src=""/>
							</div>
							<div class="col-md-2"></div>
						</div>
						
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">ETAPAS</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Tipo de proceso </th>
										<th style="text-align:center;">Etapa FNG </th>
										<th style="text-align:center;">Código</th>
										<th style="text-align:center;">Orden</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($etapas as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->G725_ConsInte__b.');">'.utf8_encode($key->proceso).'</td>
													<td class="tdMinimo" onclick=" getdatos('.$key->G725_ConsInte__b.');">'.utf8_encode($key->Etapa).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->G725_ConsInte__b.');">'.utf8_encode($key->Codigo).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->G725_ConsInte__b.');">'.utf8_encode($key->Campo_orden).'</td>
												  </tr>';
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
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<script type="text/javascript">


	$.validator.setDefaults({
	    submitHandler: function() { 
	         $("#FrmAbogados").submit();
	    }
	});

	$(function(){
		$("#bottonCara").change(function(e) {
            addImage2(e); 
            $("#hidenesto").val(1);
           // alert("Hola Cambie" + e.target.files[0]);
        });

        function addImage2(e){
            var file = e.target.files[0],
            imageType = /image.*/;

            if (!file.type.match(imageType))
                return;

            var reader = new FileReader();
            reader.onload = fileOnload2;
            reader.readAsDataURL(file);
        }

        function fileOnload2(e) {
            var result= e.target.result;
            $('#imagen').attr("src",result);
        }


		$("#tblAbogados").DataTable({
				"oLanguage": {
	                "sLengthMenu": "_MENU_ registros por página ",
	                "sZeroRecords": "0 resultados en el criterio de busqueda",
	                "sInfo": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
	                "sInfoEmpty": "0 a 0 de 0 registros",
	                "sInfoFiltered": "(Filtrado de _MAX_ total registros)",
	                "sSearch": "Buscar:",
	                "sPaginationType": "full_numbers",
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
			$("#selProcesos").prop('disabled', false);
			$("#Orden").prop('disabled', false);
			$("#etapa").prop('disabled', false);
			$("#codigo").prop('disabled', false);
			$("#bottonCara").prop('disabled', false);
			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);

			$("#hidenesto").val(0);
		});

		$("#edit").click(function(){
			$("#selProcesos").prop('disabled', false);
			$("#bottonCara").prop('disabled', false);
			$("#etapa").prop('disabled', false);
			$("#codigo").prop('disabled', false);
			$("#delete").attr('disabled', true);
			$("#Orden").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#hidenesto").val(0);
		
		});

		$("#cancel").click(function(){
			$("#selProcesos").prop('disabled', true);
			$("#bottonCara").prop('disabled', true);
			$("#etapa").prop('disabled', true);
			$("#codigo").prop('disabled', true);
			$("#selProcesos").val(0);
			$("#Orden").prop('disabled', true);
			$("#departamento").val(" ");
			$("#ciudad").val(" ");
			$("#const_int_").val(0);
			$("#hidenesto").val(0);


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
			            	url: '<?php echo base_url();?>auxiliar/eliminarEtapas',  
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
			            	url: '<?php echo base_url();?>auxiliar/guardarDatosEtapas',  
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

		$("#selProcesos").prop('disabled', true);
		$("#hidenesto").val(0);
		$("#etapa").prop('disabled', true);
		$("#codigo").prop('disabled', true);
		$("#Orden").prop('disabled', true);
		$("#bottonCara").prop('disabled', true);

		$("#selProcesos").val(0);
		$("#etapa").val(" ");
		$("#codigo").val(" ");
		$("#const_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getdatosEtapas/'+varid, {format: "json"}, function(data) { 

			//$("#selpaises").val(data[0].Tipo_de_proceso);

			$("#selProcesos option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].proceso; 
			}).prop('selected', true);
			$("#Orden").val(data[0].Campo_orden);
		
			$('#imagen').attr("src",data[0].Campo_Imagen);

			$("#etapa").val(data[0].etapa);
			//$("#selEtapas").val(data[0].Etapa);	
			$("#codigo").val(data[0].codigo);
			$("#const_int_").val(data[0].id);

			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);

			$("#cancel").attr('disabled', true);
			$("#Save").attr('disabled', true);
		});
	}
</script>
