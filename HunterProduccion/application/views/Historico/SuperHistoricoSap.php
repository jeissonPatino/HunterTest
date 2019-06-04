<section class="content-header">
    <h1>
       
       HISTÓRICO GESTIÓN EXTRAJUDICIAL
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Histórico gestión extrajudicial</li>
    </ol>
</section>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
								<div class="col-md-3">
									<div class="form-group">
										<label>Fecha inicial:</label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" placeholder="Fecha inicial" id="reservation" readonly="readonly">
										</div><!-- /.input group -->
									</div><!-- /.form group -->
								</div>	
								<div class="col-md-3">
									<div class="form-group">
										<label>Fecha final:</label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" placeholder="Fecha final" id="reservationfinal" readonly="readonly">
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
										<th style="text-align:center;">Proceso SAP</th>
										<th style="text-align:center;">Nombre Abogado</th>
										<th style="text-align:center;">Fecha de Asignacíón del Abogado</th>
										<th style="text-align:center;">Póliza</th>
										<th style="text-align:center;">Fecha de Aprobación</th>
										<th style="text-align:center;">Fecha de Vencimiento</th>
										<th style="text-align:center;">Promotor/Liquidador</th>
										<th style="text-align:center;">Fecha de Fijación del Aviso</th>


										<!-- Historicojudicial -->
										<th style="text-align:center;">Fecha informe</th>
										<th style="text-align:center;">Etapa</th>
										<th style="text-align:center;">Actuación</th>
										<th style="text-align: center;">Fecha Tramite</th>
										<th style="text-align:center;">Observaciones</th>
										
										
										<!-- HistoricoMedidas -->
										<th style="text-align:center;">Clase de Medida</th>
										<th style="text-align:center;">Fecha Solicitud</th>
										<th style="text-align:center;">Fecha Decreto</th>
										<th style="text-align:center;">Fecha Practica</th>


										<th style="text-align:center;">No. Liquidación</th>
										<th style="text-align:center;">Fecha Radicación del Memorial</th>
										<th style="text-align:center;">Fecha Decisión</th>
										<th style="text-align:center;">Desición</th>										
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
	buscar = {
		total : function(fechaInicial, fechaFinal){
			$.getJSON('<?php echo base_url();?>historicos/getSuperHistorico_json/'+ fechaInicial +'/'+fechaFinal, {format: "json"}, function(data) {

    			if($.fn.dataTable.isDataTable( '#tblAbogados' )){
    				$("#tblAbogados").dataTable().fnDestroy();
    			} 

				$("#tblAbogados").DataTable({
					"aaData": data,
			        "aoColumns": [
		        		{ mData : "SAP"},
			        	{ mData : "noombres"},
			        	{ mData : "fechaAsignacion"},
			        	{ mData : "poliza"},
			        	{ mData : "fechaAPoliza"},
			        	{ mData : "fechaVPoliza" },
			        	{ mData : "promotor"},
			        	{ mData : "fechaFijacion"},


			        	//Esto es judicial
			        	{ mData: "txtFechaIngreso" },
			        	{ mData: "Etapa" },
			        	{ mData: "actuacion" },
			        	{ mData: "txtFechaTramite" },
						{ mData: "Observaciones" },
			        	
			        
		            	//esto es medidas
		            	{ mData: "Medida" },
			        	{ mData: "FechaSolicitud"},
			        	{ mData: "FechaDecreto"},
			        	{ mData: "FechaInforme" },

			        	//subrogaciones
			        	{ mData: "credito" },
			        	{ mData: "radMemo"},
			        	{ mData: "Fechadecision"},
			        	{ mData: "decision" }
		            ],
		         
		             "dom": 'Blfrtip',
					"bJQueryUI": true,
					"bProcessing": true,
					"bSort": true,
					"bSortClasses": false,
					"bDeferRender": true,
					"sPaginationType": "simple",
		            "iDisplayLength": 20,
		            "aaSorting":[[0,"asc"]],
				    "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  fieldSeparator : ';',
			                  charset: 'utf-8',
			                  extension: '.csv',
								filename: 'HISTÓRICO GESTIÓN EXTRAJUDICIAL'}],
		            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
					"oLanguage": {
		                "sLengthMenu": "_MENU_ registros por página",
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
		            
			        "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
		          		var id = aData.id;
			            $(nRow).attr("dato",id);
		             	$(nRow).attr("class",'trobligacion');
			            return nRow;
		               
		            },
		            "fnDrawCallback": function (oSettings, json) {
		               //Aqui va el comando para activar los otros botones
		               
		            }
			    });

			});
		}
	}

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
        	buscar.total($("#reservation").val(), $("#reservationfinal").val());
        });

		/*
		
		*/
		$("#tblAbogados").DataTable({
			"aaData": <?php echo $datos; ?>,
	        "aoColumns": [
	        	{ mData : "SAP"},
	        	{ mData : "noombres"},
	        	{ mData : "fechaAsignacion"},
	        	{ mData : "poliza"},
	        	{ mData : "fechaAPoliza"},
	        	{ mData : "fechaVPoliza" },
	        	{ mData : "promotor"},
	        	{ mData : "fechaFijacion"},


	        	//Esto es judicial
	        	{ mData: "txtFechaIngreso" },
	        	{ mData: "Etapa" },
	        	{ mData: "actuacion" },
	        	{ mData: "txtFechaTramite" },
				{ mData: "Observaciones" },
	        	
	        
            	//esto es medidas
            	{ mData: "Medida" },
	        	{ mData: "FechaSolicitud"},
	        	{ mData: "FechaDecreto"},
	        	{ mData: "FechaInforme" },

	        	//subrogaciones
	        	{ mData: "credito" },
	        	{ mData: "radMemo"},
	        	{ mData: "Fechadecision"},
	        	{ mData: "decision" }
            ],
         
             "dom": 'Blfrtip',
					"bJQueryUI": true,
					"bProcessing": true,
					"bSort": true,
					"bSortClasses": false,
					"bDeferRender": true,
					"sPaginationType": "simple",
		            "iDisplayLength": 20,
		            "aaSorting":[[0,"asc"]],
				    "buttons": [{
			                  extend: 'csv',
			                  text: 'Excel',
			                  fieldSeparator : ';',
			                  charset: 'utf-8',
			                  extension: '.csv',
								filename: 'HISTÓRICO GESTIÓN EXTRAJUDICIAL'}],
		            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
					"oLanguage": {
		                "sLengthMenu": "_MENU_ registros por página",
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
	        "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
          		var id = aData.id;
	            $(nRow).attr("dato",id);
             	$(nRow).attr("class",'trobligacion');
	            return nRow;
               
            },
            "fnDrawCallback": function (oSettings, json) {
               //Aqui va el comando para activar los otros botones
               
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
</script>
