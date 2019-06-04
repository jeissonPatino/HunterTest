<section class="content-header">
    <h1>
       Facturas gastos judiciales
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Facturas gastos judiciales</li>
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
							<h3 class="box-title">No. Liquidaci&oacute;n</h3>
							<div class="box-tools">
								
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">No. Liquidación</th>
									</tr>
								</thead>
								<tbody>
									<?php
										/*foreach ($contratos as $key) {
											echo '<tr style="cursor:pointer;">
													<td class="tdMinimo" dato= "'.$key->ConsInte__b.'" contrato="'.$key->descripcion.'" >'.utf8_encode($key->descripcion).'</td>
												  </tr>';
										}*/
									?>
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
				<div class="col-md-8">
					<form id="FrmAbogados" method="POST">
						<input type="hidden" id="const_int_" name="id" value="0">
						<input type="hidden" id="NumeroContrato" name="NumeroContrato" value="0">
						<div class="row">
					  		<div class="col-md-6"   >
					  			<label>No. Cuenta de cobro gastos judiciales</label>
					  			<input type="text" class="form-control" placeholder="No. Cuenta de cobro gastos judiciale"  id="CuentaCobro" name="CuentaCobro" required disabled>
			  			 	</div>
					  		
					  		<div class="col-md-6"  >
					  			<label>Fecha cuenta de cobro gastos judiciales</label>
					  		 	<input type="text" class="form-control datemask1" placeholder="Fecha cuenta de cobro gastos judiciales"  id="FechaCobro" name="FechaCobro" required disabled>
				  		    </div>
			
					  	</div>
					  	<div class="row">
					  		<div class="col-md-6">
					  			<label>Concepto gastos judiciales</label>
					  			
					  			<select class="form-control"  required name="Concepto" id="Concepto" disabled>
					  				<option value="0">Seleccione</option>
					  				<?php 
					  					foreach ($conceptos as $key) {
					  						echo "<option value='".$key->LISOPC_ConsInte__b."'>".utf8_encode($key->LISOPC_Nombre____b)."</option>";
					  					}
				  					?>
					  			</select>
					  		 	
				  		 	</div>
					  		<div class="col-md-6">
					  			<label>Otro concepto</label> 
				  			 	<input type="text" class="form-control" placeholder="Otro concepto"  id="Otro" name="Otro"  disabled>  
					  		</div>
					  	</div>
					  	<div class="row">
					  		<div class="col-md-6">
					  			<label>Valor facturado gastos judiciales</label> 
					  			<input type="text" class="form-control" placeholder="Valor facturado gastos judiciales"  id="Valor" name="Valor" required disabled>
					  		</div>
					  		
					  		<div class="col-md-6">
					  			<label>Número de Contrato</label> 
					  			<div class="input-group input-group-sm">
						            <input type="text" class="form-control" placeholder="Número de Contrato"  id="NumeroContratoTex" name="Number" required disabled>
						            <span class="input-group-btn">
						              	<button  class="btn btn-info btn-flat" id="btnFiltrar2" type="button"><i class="fa fa-search"></i></button>
						            </span>
						      	</div>
					  		</div>
					  	</div>
					</form>
				  	
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
		$.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "yyyy-mm-dd",
            titleFormat: "yyyy-mm-dd", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

         //datemask1 dd/mm/yyyy
        $(".datemask1").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        });

		$("#tblAbogados").DataTable({
				
           	"aaData": <?php echo $valores; ?>,
	        "aoColumns": [
            	{ "sTitle": "Obligacion" },
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
               		getId($(this).attr('dato'));
               });
            },

	    });

	    var search_input = $("#tblAbogados").closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Buscar');



		$("#agregar").click(function(){
			$("#CuentaCobro").prop('disabled', false);
			$("#FechaCobro").prop('disabled', false);
			$("#Valor").prop('disabled', false);
			$("#NumeroContratoTex").prop('disabled', false);
			$("#Concepto").prop('disabled', false);
			//$("#Otro").prop('disabled', false);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$(this).attr('disabled', true);
			$("#edit").attr('disabled', true);
			$("#delete").attr('disabled', true);
		});

		$("#edit").click(function(){
			$("#CuentaCobro").prop('disabled', false);
			$("#FechaCobro").prop('disabled', false);
			$("#Valor").prop('disabled', false);
			$("#NumeroContratoTex").prop('disabled', false);
			$("#Concepto").prop('disabled', false);
			//$("#Otro").prop('disabled', false);


			$("#delete").attr('disabled', true);

			$("#cancel").attr('disabled', false);
			$("#Save").attr('disabled', false);
			$("#agregar").attr('disabled', true);
			$(this).attr('disabled', true);
			$("#SMLV").val($("#jodace").attr('codigo'));
		});

		$("#cancel").click(function(){
			$("#CuentaCobro").prop('disabled', true);
			$("#FechaCobro").prop('disabled', true);
			$("#Valor").prop('disabled', true);
			$("#NumeroContratoTex").prop('disabled', true);
			$("#Concepto").prop('disabled', true);
			$("#Otro").prop('disabled', true);

			$("#CuentaCobro").val('');
			$("#FechaCobro").val('');
			$("#Valor").val('');
			$("#NumeroContrato").val('');
			$("#Concepto").val(0);
			$("#Otro").val('');
			$("#const_int_").val(0);
			$("#NumeroContrato").val(0);


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
		            	url: '<?php echo base_url();?>auxiliar/eliminarGastosJudiciales',  
		            	type: 'POST',
			            data: { id : $("#NumeroContrato").val() },
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
			            	url: '<?php echo base_url();?>auxiliar/guardarGastosJudiciales',  
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

     	$("#Concepto").change(function(){
     		//alert($('#Concepto option:selected').text());
     		if($('#Concepto option:selected').text() == 'OTROS'){
     			$("#Otro").prop('disabled', false);
     			$("#Otro").prop('required', true);
     		}else{
     			$("#Otro").prop('disabled', true);
     			$("#Otro").prop('required', false);
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

		$("#CuentaCobro").prop('disabled', true);
		$("#FechaCobro").prop('disabled', true);
		$("#Valor").prop('disabled', true);
		
		$("#Concepto").prop('disabled', true);
		$("#Otro").prop('disabled', true);

		$("#CuentaCobro").val('');
		$("#FechaCobro").val('');
		$("#Valor").val('');
		$("#NumeroContratoTex").val('');
		$("#Concepto").val(0);
		$("#Otro").val('');
	
		$("#const_int_").val(0);

		$.getJSON('<?php echo base_url();?>auxiliar/getDatosgastoJudiciales/'+varid, {format: "json"}, function(data) { 

			$("#NumeroContrato").val(varid);
			$("#btnFiltrar2").prop('disabled', true);
			//$("#selpaises").val(data[0].Tipo_de_proceso);
			if(data.length > 0){
				$("#CuentaCobro").val(data[0].CuentaCobro);
				$("#FechaCobro").val(data[0].FechaCobro);
				$("#Valor").val(data[0].Valor);
				
				$("#Concepto option").filter(function() {
				    //may want to use $.trim in here
				    return $(this).val() == data[0].Concepto; 
				}).prop('selected', true);


				$("#NumeroContratoTex").val(contrato);
		
					
				
				$("#Otro").val(data[0].Otro);

				$("#agregar").attr('disabled', true);
				$("#edit").attr('disabled', false);
				$("#delete").attr('disabled', false);

				$("#cancel").attr('disabled', true);
				$("#Save").attr('disabled', true);
			}else{
				$("#CuentaCobro").prop('disabled', false);
				$("#FechaCobro").prop('disabled', false);
				$("#Valor").prop('disabled', false);
				
				$("#Concepto").prop('disabled', false);
				//$("#Otro").prop('disabled', false);

				$("#NumeroContratoTex").val(contrato);

				$("#cancel").attr('disabled', false);
				$("#Save").attr('disabled', false);
				$("#agregar").attr('disabled', true);
				$("#edit").attr('disabled', true);
				$("#delete").attr('disabled', true);
			}
			
		});

		
	}
</script>
