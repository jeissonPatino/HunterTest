<section class="content-header">
    <h1>
       
        HISTÓRICO MEDIDAS CAUTELARES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Histórico medidas cautelares</li>
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
							<div class="form-group">
								<label>Clase de Medidas</label>
								<select class="form-control" id="Clase_de_medida">
									<option value="0">Seleccione</option>
									<?php
										foreach ($medidasCautelares as $key) {
											echo "<option value='".$key->G731_ConsInte__b."'>".utf8_encode($key->medida)."</option>";
										}
									?>
								</select>
							</div>
							<div class="row">
								<div class="col-md-4">
									<a class="btn btn-success" href="<?php echo base_url();?>historicos/exportarHistoricoMedidas">
										Exportar a excel completo
									</a>
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
										<th style="text-align:center;">C.C</th>
										<th style="text-align:center;">IF</th>
										<th style="text-align:center;">No. Liquidación</th>
										<th style="text-align:center;">No. Proceso SAP</th>
										<th style="text-align:center;">Valor Pagado</th>
										<th style="text-align:center;">Clase de Medida</th>
										<th style="text-align:center;">Fecha Solicitud</th>
										<th style="text-align:center;">Fecha Practica</th>
										<th style="text-align:center;">Fecha Decreto</th>
										<th style="text-align:center;">Calificación</th>
										<th style="text-align:center;">Ejecutor</th>
										<th style="text-align:center;">FRG</th>
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
                <h4 class="modal-title" >DATOS MEDIDA CAUTELAR</h4>
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

	$(function(){

		$("#Clase_de_medida").change(function(){
			$.getJSON('<?php echo base_url();?>historicos/getMedidasJson/'+$(this).val(), {format: "json"}, function(data) {

    			if($.fn.dataTable.isDataTable( '#tblAbogados' )){
    				$("#tblAbogados").dataTable().fnDestroy();
    			} 

				$("#tblAbogados").DataTable({
					"aaData": data,
			        "aoColumns": [
			        	{ mData : "noombres"},
			        	{ mData : "identificacion"},
			        	{ mData : "intermediario"},
			        	{ mData: "contrato" },
			        	{ mData : "SAP"},
			        	{ mData : "Vlorpagado"},
			        	//falta tipo de proceso
			        	//falta etapa
			        	{ mData: "Medida" },
			        	{ mData: "FechaSolicitud"},
			        	{ mData: "FechaInforme" },
			        	{ mData: "FechaDecreto"},
			        	{ mData: "calificar"},
		            	{ mData: "users" },
				        { mData: "frg" }  	
		            	
		            ],
		         
		            "bJQueryUI": true,
		            "bProcessing": true,
		            "bSort": true,
		            "aaSorting":[[7,"desc"]],
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
		});

		$("#tblAbogados").DataTable({
			"aaData": <?php echo $medidas; ?>,
	        "aoColumns": [
	        	{ mData : "noombres"},
	        	{ mData : "identificacion"},
	        	{ mData : "intermediario"},
	        	{ mData : "contrato" },
	        	{ mData : "SAP"},
	        	{ mData : "Vlorpagado"},
	        	//falta tipo de proceso
	        	//falta etapa
	        	{ mData: "Medida" },
	        	{ mData: "FechaSolicitud"},
	        	{ mData: "FechaInforme" },
	        	{ mData: "FechaDecreto"},
	        	{ mData: "calificar"},
            	{ mData: "users" },
		        { mData: "frg" }  	
            ],
         
            "bJQueryUI": true,
            "bProcessing": true,
            "bSort": true,
            "aaSorting":[[7,"desc"]],
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



	function getdatos(varid){
		$.ajax({
    		url    : '<?php echo base_url();?>historicos/historicoMedidasById/'+ varid,
    		success  : function(data){
    			$("#datosGestionExtraJudicial").html(data);
    			$("#Modal-datos-extrajudicial").modal();
    		}
    	});
	}
</script>
