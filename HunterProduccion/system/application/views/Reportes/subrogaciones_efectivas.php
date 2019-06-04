<section class="content-header">
    <h1>
        Reportes
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Subrogaciones efectivas</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">INFORMES FRG - Subrogaciones efectivas</h3>
		</div>
		<div class="box-body">
			<!-- de aqui estan desarrollados los reportes -->
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>Frg:</label>
						<select id="cmbFrgs" class="form-control">
							<option value="0">Todos los FRG</option>
							<?php 
								foreach ($frgs as $key) {
									echo "<option value='".$key->G729_ConsInte__b."'>".utf8_encode($key->Frg)."</option>";
								}
							?>
						</select>
					</div>
				</div>	
			
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
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<button class="btn btn-primary  btn-block" id="BtnBuscarInformes"><i class="fa fa-search"></i></button>
				</div>	
				<div class="col-md-3">
					<a href="<?php echo base_url();?>reportes/exportarAsignacionAbogados" class="btn btn-primary  btn-block" id="btonExportar">Excel</a>
				</div>	
			</div>
		</div>
	</div>

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Resultados de la búsqueda</h3>
		</div>
		<div class="box-body" id="Resultadobusqueda">
			
		</div>
	</div>
</section>

<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
 <script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
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

	    $("#btonExportar").hide();
        $("#BtnBuscarInformes").click(function(){
        	$.ajax({
        		type    : "POST",
        		url     : "<?php echo base_url();?>reportes/getSubrogaciones_efectivas",
        		data    : { frg: $("#cmbFrgs").val() ,fechainicial:$("#reservation").val() , fechafinal: $("#reservationfinal").val()},
        		success : function (data){
        			$("#Resultadobusqueda").html(data);

        			$("#btonExportar").attr('href', '<?php echo base_url();?>reportes/getSubrogaciones_efectivas_exportar/'+ $("#cmbFrgs").val() + "/"+ $("#reservation").val() + "/" + $("#reservationfinal").val() );
        			$("#btonExportar").show();
        		}
        	});
        });

        
 	});
 </script>