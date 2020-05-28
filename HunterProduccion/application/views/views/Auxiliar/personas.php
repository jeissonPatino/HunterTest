<section class="content-header">
    <h1>
        RELACIÓN PERSONAS - OBLIGACIÓN
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Personas - Obligación</li>
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
						<input type="hidden" id="user_int_" name="usuario" value="0">
						<input type="hidden" id="contr_int_" name="contrato" value="0">
						
						
						<div class="form-group">
							<label>Identificación Cliente</label> 
				  			<div class="input-group input-group-sm">
					            <input type="text" class="form-control" placeholder="Identificación Cliente"  id="cedula" name="cedula" required disabled>
					            <span class="input-group-btn">
					              	<button  class="btn btn-info btn-flat" id="btnFiltrar3" type="button"><i class="fa fa-search"></i></button>
					            </span>
					      	</div>
						</div>
						<div class="form-group">
							<label>Número de Contrato</label> 
				  			<div class="input-group input-group-sm">
					            <input type="text" class="form-control" placeholder="Número de Contrato"  id="NumeroContratoTex" name="Number" required disabled>
					            <span class="input-group-btn">
					              	<button  class="btn btn-info btn-flat" id="btnFiltrar2" type="button"><i class="fa fa-search"></i></button>
					            </span>
					      	</div>
						</div>
						<div class="form-group">
							<Label>Rol</Label>
							<select id="selRoles" name ="selRoles" class="form-control" disabled>
								<option value="0">Rol</option>
								<?php 
									foreach ($roles as $key) {
										echo "<option value='".$key->Id."'>".utf8_encode($key->Nombre_b)."</option>";
									}
								?>
							</select>
						</div>
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">PERSONAS - OBLIGACIONES</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Identificación</th>
										<th style="text-align:center;">No. Liquidaci&oacute;n</th>
										<th style="text-align:center;">Rol</th>
										<th style="text-align:center;">Id</th>
									</tr>
								</thead>
								<tbody>
									<?php
										/*foreach ($obligaciones as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" onclick=" getdatos('.$key->Id.');">'.utf8_encode($key->nombre_Usuario).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->Id.');">'.utf8_encode($key->OBLIGACION).'</td>
												  	<td class="tdMinimo" onclick=" getdatos('.$key->Id.');">'.utf8_encode($key->Roles).'</td>
												  </tr>';
										}*/
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

		$("#tblAbogados").DataTable({
			"aaData": <?php echo $obligaciones; ?>,
	        "aoColumns": [
            	{ mData: "cliente" },
            	{ mData: "contrato" },
            	{ mData: "rol" },
            	{ mData: 'id'}
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
          		var id = aData[3];
          		
	            $(nRow).attr("dato",id);
             	$(nRow).attr("class",'trobligacion');
	            return nRow;
               
            },
            "fnDrawCallback": function (oSettings, json) {
               //Aqui va el comando para activar los otros botones
               
               $(".trobligacion").click(function(){
               		var garantia = $(this).find("td:last").html();
               		//alert(garantia);
               		var garantia = $(this).find("td:last").html();
               		getdatos(garantia);
               });
            },
	    });



		$("#agregar").click(function(){
			$("#cedula").prop('disabled', false);
			
			$("#NumeroContratoTex").prop('disabled', false);
			$("#selRoles").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#cedula").prop('disabled', false);
			
			$("#NumeroContratoTex").prop('disabled', false);
			$("#selRoles").prop('disabled', false);
			$("#delete").attr('disabled', true);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#cedula").prop('disabled', true);
			
			$("#NumeroContratoTex").prop('disabled', true);
			$("#selRoles").prop('disabled', true);

			$("#selRoles").val(0);
	
			$("#NumeroContratoTex").val(" ");
			$("#cedula").val(" ");

			$("#const_int_").val(0);
			$("#user_int_").val(0);
			$("#contr_int_").val(0);


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
				            	url: '<?php echo base_url();?>auxiliar/eliminarRelacion',  
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
			var form = $("#FrmAbogados");
			if(form.valid()){
				alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
	    			if (e) {
			  			var formData = new FormData($("#FrmAbogados")[0]);
			          	$.ajax({
			            	url: '<?php echo base_url();?>auxiliar/guardarRelacion',  
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
			     	} else {
				        // user clicked "cancel"
			    	}
			   	});	
		  	}else{
		  		alertify.error('No deben haber campos vacios, por favor rellena el formulario!!');
		  	}	
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

     	$("#btnFiltrar2").click(function(){
			validarUsuario($("#cedula").val());
		});

		$("#cedula").keypress(function(e){
     		if(e.keyCode == 13)
		    {
		        validarUsuario($(this).val());
		    }
     	});
	});
	

	function validarContrato(getId){
	
		$.ajax({
			url     : '<?php echo base_url();?>auxiliar/getIdContrato/'+getId,
			type    : 'POST',
			success : function(data){
				if(data.length > 0){
					$("#contr_int_").val(data);
					$("#NumeroContratoTex").prop('disabled', true);
					$("#btnFiltrar2").prop('disabled', true);
					alertify.success('Numero de contrato Valido!');
				}else{
					alertify.error('Ese numero de contrato no existe');
				}
			}
		});
	}

	function validarUsuario(getId){
	
		$.ajax({
			url     : '<?php echo base_url();?>auxiliar/getIdUsuario/'+getId,
			type    : 'POST',
			success : function(data){
				if(data.length > 0){
					$("#user_int_").val(data);
					$("#btnFiltrar3").prop('disabled', true);
					$("#cedula").prop('disabled', true);
					alertify.success('Identificación Valida!');
				}else{
					alertify.error('Ese numero de contrato no existe');
				}
			}
		});
	}
	

	function getdatos(varid){

		$("#selRoles").prop('disabled', true);
		
		$("#cedula").prop('disabled', true);
		$("#NumeroContratoTex").prop('disabled', true);

		$("#selpaises").val(0);
		$("#selEtapas").val(0);
		$("#departamento").val(" ");
		$("#ciudad").val(" ");
		$("#const_int_").val(0);
		$("#user_int_").val(0);
		$("#contr_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosRelacion/'+varid, {format: "json"}, function(data) { 

			//$("#selpaises").val(data[0].Tipo_de_proceso);

			$("#selRoles option").filter(function() {
			    //may want to use $.trim in here
			    return $(this).val() == data[0].idrol; 
			}).prop('selected', true);

			$("#btnFiltrar2").prop('disabled', true);
			$("#btnFiltrar3").prop('disabled', true);

			$("#cedula").val(data[0].usuario);
			//$("#selEtapas").val(data[0].Etapa);	
			$("#NumeroContratoTex").val(data[0].contrato);
			$("#const_int_").val(data[0].id);
			$("#user_int_").val(data[0].idUsuario);
			$("#contr_int_").val(data[0].idcontrato);

			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', true);
		});
	}
</script>
