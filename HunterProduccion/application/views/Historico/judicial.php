<section class="content-header">
    <h1>
     HISTÓRICO GESTIÓN JUDICIAL
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Histórico gestión judicial</li>
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
								<div class="col-md-3">
									<div class="form-group">
										<label>Fecha inicial:</label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" placeholder="Fecha inicial" id="reservation" readonly="readonly">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Fecha final:</label>
										<div class="input-group">
											<input type="text" class="form-control pull-right" placeholder="Fecha final" id="reservationfinal" readonly="readonly">
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>&nbsp;</label>
										<div class="input-group">
											<button class="btn btn-primary" id="BtnBuscar"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>&nbsp;</label>
										<div class="input-group">
											<a id="btnExportarExcel" class="btn btn-success" href="#">Excel</a>
										</div>
									</div>
								</div>
							</div>

						</div>
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
		judicial : function(fechaInicial, fechaFinal){
			$.getJSON('<?php echo base_url();?>historicos/historicoJudicialjson/'+ fechaInicial +'/'+ fechaFinal, {format: "json"}, function(data) {

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
				        { mData: "users"} 	
		            ],
		         	
					"bJQueryUI": true,
					"bProcessing": true,
					"bSort": true,
					"bSortClasses": false,
					"bDeferRender": true,
					"sPaginationType": "simple",
		            "iDisplayLength": 20,
		            "aaSorting":[[0,"asc"]],
				    
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
		               $(".trobligacion").dblclick(function(){
		               		var garantia = $(this).attr('dato');
		               		getdatos(garantia);
		               });
		            }
			    });
			});
		}
	}

	$("#btnExportarExcel").click(function(){
		var fechaIni= $("#reservation").val();
		var fechaFin= $("#reservationfinal").val();
		if (fechaIni.length>0 && fechaFin.length>0) {
			document.location.href="<?php echo base_url();?>historicos/exportarHistoricoJudicial/"+fechaIni+'/'+fechaFin;
		}else{
			alert('Debe seleccionar fecha inicial y fecha final');
		}

		var fechaInicio = new Date(fechaIni).getTime();
		var fechaFin    = new Date(fechaFin).getTime();
		var diff = (fechaFin - fechaInicio)/(1000*60*60*24);
		if(diff > 365){
			alertify.error("El rango de fecha debe ser inferior a 1 año");	
			return false;			
		}

		return false;
	});


	$("#BtnBuscar").click(function(){
		var fechaIni= $("#reservation").val();
		var fechaFin= $("#reservationfinal").val();
		var fechaInicio = new Date(fechaIni).getTime();
		var fechaFin    = new Date(fechaFin).getTime();
		var diff = (fechaFin - fechaInicio)/(1000*60*60*24);
		if(diff > 365){
			alertify.error("El rango de fecha debe ser inferior a 1 año");				
		}else{
			buscar.judicial($("#reservation").val(), $("#reservationfinal").val());	
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

		$("#tblAbogados").DataTable({
			"aaData": <?php echo $judicial; ?>,
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
		        { mData: "frg" },
				{ mData: "users"} 	
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
            "iDisplayLength": 20,
           "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]],
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
</script>