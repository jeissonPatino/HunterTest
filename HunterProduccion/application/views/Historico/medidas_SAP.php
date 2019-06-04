<section class="content-header">
    <h1>
       
      Histórico medidas cautelares SAP
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Histórico medidas cautelares SAP</li>
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
								<div class="col-md-3">
									<div class="form-group">
										<label>Fecha inicial:</label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" placeholder="Fecha inicial" id="reservation">
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>	
								<div class="col-md-3">
									<div class="form-group">
										<label>Fecha final:</label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" placeholder="Fecha final" id="reservationfinal">
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label style="visibility:hidden;">Fecha final:</label>
										<div class="input-group">
											<button class="btn btn-primary" id="BtnBuscar"><i class="fa fa-search"></i></button>
										</div><!-- /.input group -->
									</div><!-- /.form group -->
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
										<th style="text-align:center;">No. Contrato / No. Liquidación</th>
										<th style="text-align:center;">No. Proceso SAP</th>
										<th style="text-align:center;">Valor Pagado</th>
										<th style="text-align:center;">Clase de Medida</th>
										<th style="text-align:center;">Fecha Solicitud</th>
										<th style="text-align:center;">Fecha Practica</th>
										<th style="text-align:center;">Fecha Decreto</th>
										<th style="text-align:center;">Calificación</th>
										<th style="text-align:center;">Ejecutor</th>
										
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
	busqueda = {
		medidas : function(medida, fechainicial, fechaFinal){
			$.getJSON('<?php echo base_url();?>historicos/getMedidasJson_SAP/'+ medida +"/"+ fechainicial +"/"+ fechaFinal, {format: "json"}, function(data) {

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
			        	//falta tipo de proceso
			        	//falta etapa
			        	{ mData: "Medida" },
			        	{ mData: "FechaSolicitud"},
			        	{ mData: "FechaInforme" },
			        	{ mData: "FechaDecreto"},
			        	{ mData: "calificar"},
		            	{ mData: "users" }
		            	
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
			             'csv'
			        ]
			    });

			});			
		}
	}

	$(function(){

		$("#Clase_de_medida").change(function(){
			busqueda.medidas($(this).val(), $("#reservation").val(), $("#reservationfinal").val());
		});

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

     	$("#reservation").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate',function(selected){
	        startDate = new Date(selected.date.valueOf());
	        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
	        $('#reservationfinal').datepicker('setStartDate', startDate);
	    }); 

	    $("#reservationfinal").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true
        });

        $("#BtnBuscar").click(function(){
        	busqueda.medidas($("#Clase_de_medida").val(), $("#reservation").val(), $("#reservationfinal").val());
        });

		$("#tblAbogados").DataTable({
			"aaData": <?php echo $medidas; ?>,
	        "aoColumns": [
	        	{ mData : "noombres"},
	        	{ mData : "tipo_identificacion"},
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
            	{ mData: "users" }
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
	             'csv'
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
