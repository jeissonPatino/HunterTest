<section class="content-header">
    <h1>
        Eliminar gestion judicial
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Eliminar gestion judicial</li>
    </ol>
</section>

<section class="content">
	

	<!-- Salario Minimo -->
	<div class="box">
		<div class="box-header with-border">
			
		</div>
		<div class="box-body">
			<div class="row-fuid">
				
				<div class="col-md-12">
					<div class="box">
						<div class="box-header">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Nº Liquidación</label>
							  			<input type="text" class="form-control " placeholder="Ingrese Numero Liquidación a Buscar"  id="txtNoLiquidacion" name="txtNoLiquidacion" > 
									</div>
						  		</div>
						  		<div class="col-md-8" style="padding-top: 25px;">
									<div class="form-group">
						
											<button class="btn" id="btnBuscarNoLiquidacion">Buscar Liquidación</button>
									</div>
						  		</div>
							</div>
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Nombre Deudor</th>
										<th style="text-align:center;">Tipo Identificación</th>
										<th style="text-align:center;">No. Identificación</th>
										<th style="text-align:center;">IF</th>
										<th style="text-align:center;">No. Liquidación</th>
										<th style="text-align:center;">Proceso SAP</th>
										<th style="text-align:center;">Valor Pagado</th>
										<th style="text-align:center;">Tipo de proceso</th>
										<th style="text-align:center;">Etapa</th>
										<th style="text-align:center;">Actuación</th>
										<th style="text-align: center;">Fecha Tramite</th>
										<th style="text-align:center;">Fecha informe</th>
										<th style="text-align:center;">FRG</th>
										<th style="text-align:center;">Abogado / Gestor</th>
										<th style="text-align:center;"></th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
			</div>
			<div class="row-fluid">
				
			</div>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->


<div class="modal fade" tabindex="-1" role="dialog" id="Modal-datos-extrajudicial">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" >DATOS GESTION JUDICIALES</h4>
            </div>
            <div class="modal-body" id="datosGestionExtraJudicial">
                
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


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
	buscar = {
		judicial : function(numeroliquidacion){
			$.getJSON('<?php echo base_url();?>historicos/historicoJudicialjson/'+numeroliquidacion, {format: "json"}, function(data) {

    			if($.fn.dataTable.isDataTable( '#tblAbogados' )){
    				$("#tblAbogados").dataTable().fnDestroy();
    			} 

				$("#tblAbogados").DataTable({
					"aaData": data,
			        "aoColumns": [
			        	{ mData : "noombres"},
			        	{ mData : "tipo_identificacion"},
			        	{ mData : "identificacion"},
			        	{ mData : "intermediario"},
			        	{ mData: "contrato" },
			        	{ mData : "SAP"},
			        	{ mData : "Vlorpagado"},
			        	{ mData: "TipoProceso" },
			        	{ mData: "Etapa" },
			        	{ mData: "actuacion" },
			        	{ mData: "txtFechaTramite" },
			       		{ mData: "txtFechaIngreso" },
				        { mData: "frg" } ,
				        { mData: "users"} ,
				        { mData: "eliminar"} 	
		            ],
		         
		            "bJQueryUI": true,
		            "bProcessing": true,
		            "bSort": true,
		            "aaSorting":[[4,"desc"]],
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
		          		var id = aData.id;
			            $(nRow).attr("dato",id);
		             	$(nRow).attr("class",'trobligacion');
		             	
			            return nRow;
		               
		            },
		            "fnDrawCallback": function (oSettings, json) {
		               //Aqui va el comando para activar los otros botones
		               $(".trobligacion").dblclick(function(){
		               		var garantia = $(this).attr('dato');
		               		getdatos(garantia);
		               });
		            },
		            "dom": 'Bfrtip',
			        "buttons": [
			             'excel'
			        ]
			    });
			});
		}
	}
	/*$(function(){
		$("#selProcesos").change(function(){
			$("#selEtapas").html('<option value="0">Seleccione</option>');
			$("#selActuaciones").html('<option value="0">Seleccione</option>');
			
			$.getJSON('<?php echo base_url();?>auxiliar/getFiltrosComboEtapas/'+$(this).val(), {format: "json"}, function(data) { 
				var etapa = '<option value="0">Seleccione</option>';
				$.each(data, function(i, item) {
					etapa += '<option value="'+ item.id +'" codigo="'+ item.codigo + '">'+ item.descripcion +'</option>';
				});
				$("#selEtapas").html(etapa);

				$("#selEtapas").change(function(){
					$("#selActuaciones").html('');
					$.ajax({
			            url      : "<?php echo base_url();?>cartera_fng/eventoBotonEtapajson",
			            type     : "POST",
			            data     : { consInteEtapaSeleccionada : $(this).val() },
			            success  : function(data){
			                $("#selActuaciones").html(data);
			                $("#selActuaciones").change(function(){
			                	buscar.judicial($("#selProcesos").val(), $("#selEtapas").val(), $(this).val());	
			                });
			            }
			        });
			        buscar.judicial($("#selProcesos").val(), $(this).val(), 0);	
				});


			});

			buscar.judicial($(this).val(), 0, 0);
		});

		$("#tblAbogados").DataTable({
			"aaData": <?php echo $judicial; ?>,
	        "aoColumns": [
	        	{ mData : "noombres"},
	        	{ mData : "identificacion"},
	        	{ mData : "intermediario"},
	        	{ mData: "contrato" },
	        	{ mData : "SAP"},
	        	{ mData : "Vlorpagado"},
	        	{ mData: "TipoProceso" },
	        	{ mData: "Etapa" },
	        	{ mData: "actuacion" },
	        	{ mData: "txtFechaTramite" },
	       		{ mData: "txtFechaIngreso" },
		        { mData: "frg" },
				{ mData: "users"},
		        { mData: "eliminar"}  	
            ],
         
            "bJQueryUI": true,
            "bProcessing": true,
            "bSort": true,
            "aaSorting":[[4,"desc"]],
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
          		var id = aData.id;
	            $(nRow).attr("dato",id);
             	$(nRow).attr("class",'trobligacion');
             	
	            return nRow;
               
            },
            "fnDrawCallback": function (oSettings, json) {
               //Aqui va el comando para activar los otros botones
               $(".trobligacion").dblclick(function(){
               		var garantia = $(this).attr('dato');
               		getdatos(garantia);
               });
            },
            "dom": 'Bfrtip',
	        "buttons": [
	             'excel'
	        ]
	    });

	});*/
	$(function(){
		//buscar.extrajudicial(null , null, null);
		$("#btnBuscarNoLiquidacion").click(function(){
			if ($("#txtNoLiquidacion").val().length < 1){
				alertify.error('Debe ingresar numero de liquidacion a buscar');
			}else{
				buscar.judicial($("#txtNoLiquidacion").val());	
			}
			
		});

	});
	


	function getdatos(varid){

		

		$.ajax({
    		url    : '<?php echo base_url();?>historicos/getDatosgestionJudicial/'+ varid,
    		success  : function(data){
    			$("#datosGestionExtraJudicial").html(data);
    			$("#Modal-datos-extrajudicial").modal();
    		}
    	});
		
	}

	function eliminarGestion(varId,numliquidacion){
		
 		alertify.confirm("¿Esta seguro que esta operación?", function (e) {
		    if (e) {
		    	$.ajax({
		 			url    : '<?php echo base_url();?>cartera_fng/eliminarGestion',
		 			type   : 'POST',
		 			data   : { IdEliminar : varId, NumLiquidacion : numliquidacion },
		 			success : function(data){
		 				buscar.judicial($("#selProcesos").val(), $("#selEtapas").val(), $("#selActuaciones").val());	
		 			}
		 		});
		    } else {
		        // user clicked "cancel"
		    }
		});
 	}
</script>
