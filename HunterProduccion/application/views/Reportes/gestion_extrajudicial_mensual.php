<section class="content-header">
    <h1>
        REPORTES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Gestión extrajudicial mensual</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Informes FRG - Gestión extrajudicial mensual</h3>
		</div>
		<div class="box-body">
			<!-- de aqui estan desarrollados los reportes -->
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>FRG:</label>
						<select id="cmbFrgs" multiple class="form-control">
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
						<label>Mes:</label>
						<div class="input-group">
							<input type="text" class="form-control pull-right" placeholder="Fecha inicial" id="reservation" readonly="readonly">
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<button class="btn btn-primary  btn-block" id="BtnBuscarInformes"><i class="fa fa-search"></i></button>
				</div>	
				<div class="col-md-3">
					<a href="<?php echo base_url();?>reportes/exportar_gestion_extrajudicial_mensual" class="btn btn-success  " id="btonExportar">Excel</a>
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

<script type="text/javascript">
 	$(function(){
 		var value = '';
	 	$.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "mm-yyyy",
           	
            titleFormat: "mm/yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

     	$("#reservation").datepicker({
        	language: "es",
            autoclose: true,
            todayHighlight: true,
            viewMode: 1, 
    		minViewMode: 1
        });

	    $("#btonExportar").hide();
	    $("#BtnBuscarInformes").hide();

        $("#BtnBuscarInformes").click(function(){
        	$.ajax({
        		type    : "POST",
        		url     : "<?php echo base_url();?>reportes/buscar_gestion_extrajudicial_mensual",
        		data    : { frg: value, fechainicial:$("#reservation").val() },
        		success : function (data){
        			$("#Resultadobusqueda").html(data);

        			$("#btonExportar").attr('href', '<?php echo base_url();?>reportes/exportar_gestion_extrajudicial_mensual/'+ $("#cmbFrgs").val() + "/" + $("#reservation").val());
        			$("#btonExportar").show();
        		}
        	});
        });

        $("#cmbFrgs").change(function(){
        	value = $(this).val();
        	$("#BtnBuscarInformes").show();
        });
 	});
 </script>
