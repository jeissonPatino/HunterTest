<section class="content-header">
    <h1>
        GARANTÍAS Y PAGARÉS
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Garantias y Pagares</li>
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
						<input type="hidden" id="NumeroCon" name="NumeroCon" value="0">
						<div class="form-group">
							<Label>No. Garantia</Label>
							<input type="text" class="form-control" placeholder="No. Garantia"  id="garantia" name="garantia" required disabled>
						</div>
						<div class="form-group">
							<Label>No. Pagaré</Label>
							<input type="text" class="form-control" placeholder="No. Pagaré"  id="pagare" name="pagare" required disabled>
						</div>
						<label>No. Contrato / No. Liquidaci&oacute;n</label> 
			  			<div class="input-group input-group-sm">
				            <input type="text" class="form-control" placeholder="Número de Contrato"  id="NumeroContratoTex" name="Number" required disabled>
				            <span class="input-group-btn">
				              	<button  class="btn btn-info btn-flat" id="btnFiltrar2" type="button"><i class="fa fa-search"></i></button>
				            </span>
				      	</div>
					</form>
					
				</div>
				<div class="col-md-8">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">GARANTIAS Y PAGARÉS</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">No. Garantia</th>
										<th style="text-align:center;">No. Pagaré</th>
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
			"aaData": <?php echo $garantias; ?>,
	        "aoColumns": [
            	{ mData: "garantia" },
            	{ mData: "pagare" },
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
               $(".trobligacion").click(function(){
               		var garantia = $(this).find("td:first").html();
               		getdatos(garantia);
               });
            },
	    });



		$("#agregar").click(function(){
			$("#garantia").prop('disabled', false);
			$("#pagare").prop('disabled', false);
			$("#NumeroContratoTex").prop('disabled', false);
			

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#garantia").prop('disabled', false);
			$("#pagare").prop('disabled', false);

			$("#NumeroContratoTex").prop('disabled', false);
			$("#delete").attr('disabled', true);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#garantia").prop('disabled', true);
			$("#pagare").prop('disabled', true);
			$("#NumeroContratoTex").prop('disabled', true);

			$("#departamento").val(" ");
			$("#ciudad").val(" ");
			$("#const_int_").val(0);


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
		            	url: '<?php echo base_url();?>auxiliar/eliminarGarantias',  
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
			if($("#NumeroCon").val() == '0'){
				alert("Por favor revisa el número de contrato, valida que se este sea valido!");
				$("#NumeroContratoTex").focus();
			}else{
				if(form.valid()){
					alertify.confirm("¿Ésta seguro de esta operación?", function (e) {
		    			if (e) {

				  			var formData = new FormData($("#FrmAbogados")[0]);
				          	$.ajax({
				            	url: '<?php echo base_url();?>auxiliar/guardarGarantias',  
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
	});

	
	function validarContrato(getId){
	
		$.ajax({
			url     : '<?php echo base_url();?>auxiliar/getIdContrato/'+getId,
			type    : 'POST',
			success : function(data){
				if(data.length > 0){
					$("#NumeroCon").val(data);
					$("#btnFiltrar2").prop('disabled', true);
					alertify.success('Número de contrato Valido!');
				}else{
					alertify.error('Ese número de contrato no existe');
				}
			}
		});
	}

	


	function getdatos(varid){

		$("#garantia").prop('disabled', true);
		$("#pagare").prop('disabled', true);
		$("#NumeroContratoTex").prop('disabled', true);

		$("#garantia").val('');
		$("#pagare").val('');
		$("#NumeroContratoTex").val(" ");
		
		$("#const_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosgarantiabyGarantia/'+varid, {format: "json"}, function(data) { 

			//$("#selpaises").val(data[0].Tipo_de_proceso);

			$("#NumeroCon").val(data[0].idCn);
		
			$("#garantia").val(data[0].Garantia);
			$("#pagare").val(data[0].Pagare);
			$("#NumeroContratoTex").val(data[0].Contrato);
			$("#const_int_").val(data[0].id);

			$("#agregar").attr('disabled', true);
			$("#edit").attr('disabled', false);
			$("#delete").attr('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', true);
		});
	}
</script>
