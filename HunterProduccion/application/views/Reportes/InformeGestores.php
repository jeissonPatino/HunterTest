<section class="content-header">
    <h1>
        Reportes
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
        <li class="active">FRG Gestores</li>
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
			</div>
			<div class="row">
				<div class="col-md-3">
					<button class="btn btn-primary  btn-block" id="BtnFrgGestores"><i class="fa fa-search"></i>&nbsp;&nbsp;Buscar</button>
				</div>
				<div class="col-md-3">
					<a href="<?php echo base_url();?>reportes/ExportarGestores" class="btn btn-primary  btn-block" id="ExportarGestores">
							<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar a Excel</a>
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

  					$("#ExportarGestores").attr('href', '<?php echo base_url();?>reportes/ExportarGestores/'+ $("#cmbFrgs").val() + "/" + $("#cmbGestores").val() +"/" + $("#reservation").val() +"/"+ $("#reservationfinal").val());

        			$("#ExportarGestores").show();
        		}

        	})
        	.fail(function() {
    		alert( "error" );
  			});

        	
        }
        });

       
 	});

 </script>