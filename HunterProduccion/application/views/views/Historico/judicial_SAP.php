<section class="content-header">
    <h1>
        HISTORICO GESTIONES JUDICIAL PARA
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Historico gestion judicial SAP</li>
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
										<label>Tipo de Proceso</label>
										<select class="form-control" id="selProcesos">
											<option value="0">Seleccione</option>
											<?php 
												foreach ($Procesos as $key) {
													echo "<option value='".$key->Id."'>".utf8_encode($key->Nombre_b)."</option>";
												}
											?>
										</select>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Etapa</label>
										<select class="form-control" id="selEtapas">
											<option value="0">Seleccione</option>
										</select>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Actuaciones</label>
										<select class="form-control" id="selActuaciones">
											<option value="0">Seleccione</option>
										</select>
									</div>
								</div>
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
						</div><!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-hover" id="tblAbogados">
								<thead>
									<tr>
										<th style="text-align:center;">Nombre Deudor</th>
										<th style="text-align:center;">C.C</th>
										<th style="text-align:center;">IF</th>
										<th style="text-align:center;">No. Contrato / No. Liquidación</th>
										<th style="text-align:center;">Proceso SAP</th>
										<th style="text-align:center;">Valor Pagado</th>
										<th style="text-align:center;">Tipo de proceso</th>
										<th style="text-align:center;">Etapa</th>
										<th style="text-align:center;">Actuación</th>
										<th style="text-align: center;">Fecha Tramite</th>
										<th style="text-align:center;">Fecha informe</th>
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
		judicial : function(proceso, etapa, actuacion, fechainicial, fechafinal){
			$.getJSON('<?php echo base_url();?>historicos/historicoJudicialjson_SAP/'+ proceso +'/'+ etapa +'/'+actuacion+"/"+ fechainicial +"/"+ fechafinal, {format: "json"}, function(data) {

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
			        	{ mData: "TipoProceso" },
			        	{ mData: "Etapa" },
			        	{ mData: "actuacion" },
			        	{ mData: "txtFechaTramite" },
			       		{ mData: "txtFechaIngreso" }
		            	
		            	
		            	
		            	
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
						 'csv'
			        ]
			    });
			});
		}
	}
	$(function(){
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
			                	buscar.judicial($("#selProcesos").val(), $("#selEtapas").val(), $(this).val(), $("#reservation").val(), $("#reservationfinal").val());	
			                });
			            }
			        });
			        buscar.judicial($("#selProcesos").val(), $(this).val(), 0, $("#reservation").val(), $("#reservationfinal").val());	
				});


			});

			buscar.judicial($(this).val(), 0, 0,$("#reservation").val(), $("#reservationfinal").val());
		});

		$("#BtnBuscar").click(function(){
        	buscar.judicial($("#selProcesos").val(), $("#selEtapas").val(), $("#selActuaciones").val(), $("#reservation").val(), $("#reservationfinal").val());	
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
	       		{ mData: "txtFechaIngreso" }
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
				  'csv'
	        ]
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
</script>
