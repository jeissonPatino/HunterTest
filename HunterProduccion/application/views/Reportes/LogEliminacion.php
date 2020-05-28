<section class="content-header">
    <h1>
        CONFIGURACIÓN - LOG ELIMINACIÓN 
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Log Eliminación</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Log  Eliminación de Datos</h3>
		</div>
		<div class="box-body">
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
			<div class="row">	
				<div class="col-md-3">
					<a  class="btn btn-primary  btn-block" id="btonExportar"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Generar Log</a>
				</div>	
			</div>
		</div>
	</div>		
</section>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript">
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


        $("#btonExportar").click(function(){

    	if ($("#reservation").val()== null || $("#reservation").val() =='' || 
    		$("#reservationfinal").val()== null || $("#reservationfinal").val() ==''){
    		alert("Debe ingresar un filtro de búsqueda.");
    	
    	}else{
        	$.ajax({
        		type    : "POST",
        		url     : "<?php echo base_url();?>reportes/ExportarLogeliminaciones",
        		data    : { fechainicial:$("#reservation").val() , fechafinal: $("#reservationfinal").val()},
        		success : function (data){

  					$("#btonExportar").attr('href', '<?php echo base_url();?>Reportes/ExportarLogeliminaciones/' + $("#reservation").val() +"/"+ $("#reservationfinal").val());

        			
        		}
        	});

        	
        }
        });

       
 	});
</script>
