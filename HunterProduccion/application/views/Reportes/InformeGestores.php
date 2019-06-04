<section class="content-header">
    <h1>
        REPORTES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">Gestión Gestores de Recuperación</li>
    </ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Informes FRG - Gestión Gestores de Recuperación</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label>FRG:</label>
						<select id="cmbFrgs"  name="cmbFrgs"   class="form-control">
							<option value="">Todos los FRG</option>
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
						<label>Gestores:</label>
						<select id="cmbGestores" name="cmbGestores" class="form-control">
							<option value="0">Seleccione</option>
							
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
					<button class="btn btn-primary  btn-block" id="BtnFrgGestores"><i class="fa fa-search"></i></button>
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

<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

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

		// Obtener los gestores a partir del codigo FRG.
		$( "#cmbFrgs" ).change(function() {
		    if ($(this).val()!='') {
			    var path = "<?php echo base_url('reportes/getFrgGestoresById');?>";
			    var options='<option value="">Seleccione</option>';
			    $("#cmbGestores").html(options);
				$.ajax({
					type:"POST",
					url: path,
					data:{ codigo : $(this).val() }, 
					dataType:'json',
					success:function(response){
	                    $.each(response, function(id, dato){
	                        options+='<option value="'+dato.id+'">'+dato.valor+'</option>';
	                    }); 
	                    $("#cmbGestores").html(options);
					}, error: function(){
						alertify.error("Ocurrio un error buscando gestores.");
					}
				});
		    }else{
		    	return false;
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


        $("#BtnFrgGestores").click(function(){

    	if ($("#cmbFrgs").val() == null || $("#cmbFrgs").val() ==''|| 
    		$("#cmbGestores").val()== null || $("#cmbGestores").val() =='' || 
    		$("#reservation").val()== null || $("#reservation").val() =='' || 
    		$("#reservationfinal").val()== null || $("#reservationfinal").val() ==''){
    		alertify.error("Debe ingresar un filtro de búsqueda.");
    	
    	}else{
        	$.ajax({
        		type    : "POST",
        		url     : "<?php echo base_url();?>reportes/getFrgGestores",
        		data    : { 
						frg: $("#cmbFrgs").val(), 
						gestores:$("#cmbGestores").val() ,
						fechainicial:$("#reservation").val() , 
						fechafinal: $("#reservationfinal").val()
				},

        		success : function (data){

        			/*console.log(data);
        			alert(data.codigo);
        			alert(data.mensaje);*/

        			$("#Resultadobusqueda").html(data);
        			/*if (data.codigo ==1){
    					alertify.success(data.mensaje);
    	
        			}else{
        				alertify.error(data.mensaje);
        			}*/
        		}

        	})
        	.fail(function() {
    		alert( "error" );
  			});

        	
        }
        });

       
 	});

 </script>