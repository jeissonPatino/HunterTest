<section class="content-header">
    <h1>
        REPORTES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Soportes CISA</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">INFORMES FRG - Soportes CISA</h3>
		</div>
		<div class="box-body">
			<!-- de aqui estan desarrollados los reportes -->
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>FRG:</label>
						<select id="cmbFrgs" class="form-control">
							<option value="0">Todos los FRG</option>
							<?php 
								foreach ($frgs as $key) {
									echo "<option value='".$key->Id."'>".utf8_encode($key->Frg)."</option>";
								}
							?>
						</select>
					</div>
				</div>	
			
				<div class="col-md-4">
					<div class="form-group">
						<label>Venta:</label>
						<div class="input-group">
							<select id="cmbVentasCisas" class="form-control">
                                <option value="0">Seleccione</option>
                                <?php 
                                    foreach ($fechas as $key) {
                                        echo "<option value='".$key->ven_id."'>".utf8_encode($key->Ven_nombre)."</option>";
                                    }
                                ?>
                                
                            </select>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>			
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<button class="btn btn-primary  btn-block" id="BtnBuscarInformes"><i class="fa fa-search"></i></button>
				</div>	
				<div class="col-md-3">
					<a href="<?php echo base_url();?>reportes/exportarAsignacionAbogados" class="btn btn-success " id="btonExportar">Excel</a>
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

     	

	    $("#btonExportar").hide();
        $("#BtnBuscarInformes").click(function(){
        	$.ajax({
        		type    : "POST",
        		url     : "<?php echo base_url();?>reportes/getdatosReporteCisa",
        		data    : { frg: $("#cmbFrgs").val() , venta: $("#cmbVentasCisas").val()},
        		success : function (data){
        			$("#Resultadobusqueda").html(data);

        			$("#btonExportar").attr('href', '<?php echo base_url();?>reportes/exportarCisa/'+ $("#cmbFrgs").val() + "/"+ $("#cmbVentasCisas").val() );
        			$("#btonExportar").show();
        		}
        	});
        });

        
 	});
 </script>