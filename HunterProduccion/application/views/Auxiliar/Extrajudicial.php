<section class="content-header">
    <h1>
       
        Eliminar gestión extrajudicial
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">ELiminar gestión extrajudicial</li>
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
							<div class="box-tools">
								
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
										<th style="text-align:center;">No. Liquidaci&oacute;n</th>
										<th style="text-align:center;">Proceso SAP</th>
										<th style="text-align:center;">Valor Pagado</th>
										<th style="text-align:center;">Estado del cliente</th>
										<th style="text-align:center;">Gesti&oacute;n</th>
										<th style="text-align:center;">Subgesti&oacute;n</th>
										<th style="text-align:center;">Fecha gesti&oacute;n</th>
										<th style="text-align:center;">Medio de comunicaci&oacute;n</th>
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
                <h4 class="modal-title" >GESTION EXTRAJUDICIAL</h4>
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
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/bajadas/Jzip.js"></script>
<!--<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.min.js"></script>


<script type="text/javascript">
	buscar = {
		extrajudicial : function(numeroLiquidacion){
		debugger;
			$.getJSON('<?php echo base_url();?>historicos/gestionExtrajudicialJson_e/'+ numeroLiquidacion, {format: "json"}, function(data) {

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
			        	{ mData : "contrato" },
			        	{ mData : "SAP"},
			        	{ mData : "Vlorpagado"},
			        	{ mData : "resultadocomunicacion" },
			        	{ mData : "gestion" },
		            	{ mData : "subgestion" },
			       		{ mData : "fechaIngreso" },
		            	{ mData : "mediocomunicacion" },
		            	{ mData : "frg"},
		            	{ mData : "users"},
		            	{ mData  : "eliminar"}
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

	$(function(){
		//buscar.extrajudicial(null , null, null);
		$("#btnBuscarNoLiquidacion").click(function(){
			if ($("#txtNoLiquidacion").val().length < 1){
				alertify.error('Debe ingresar numero de liquidacion a buscar');
			}else{
				buscar.extrajudicial($("#txtNoLiquidacion").val());	
			}
			
		});

	});
	

	function getdatos(varid){

		

		$.ajax({
    		url    : '<?php echo base_url();?>historicos/getDatosgestionExtrajudicial/'+ varid,
    		success  : function(data){
    			$("#datosGestionExtraJudicial").html(data);
    			$("#Modal-datos-extrajudicial").modal();
    		}
    	});
		
	}

	function eliminarGestion(varId,numLiquidacion){
 		alertify.confirm("¿Esta seguro que esta operación?", function (e) {
		    if (e) {
		    	$.ajax({
		 			url    : '<?php echo base_url();?>auxiliar/eliminarGestionExtraJudicial',
		 			type   : 'POST',
		 			data   : { IdEliminar : varId, NumLiquidacion : numLiquidacion},
		 			success : function(data){
		 				buscar.extrajudicial($("#txtNoLiquidacion").val());	
		 			}
		 		});
		    } else {
		        
		    }
		});
 	}
</script>
