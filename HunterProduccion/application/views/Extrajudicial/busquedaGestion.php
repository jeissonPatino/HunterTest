<section class="content-header">
    <h1>
        CARTERA FNG - BÚSQUEDA TIPO GESTIÓN
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>Extrajudicial">Cartera Fng</a></li>
        <li class="active">Búsqueda por Tipo Gestión</li>
    </ol>
</section>
<section class="content">
	<a href="<?php echo base_url();?>extrajudicial" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>
	<div class="box-body">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Estado Cliente:</label>
					<select id="cmbtipoEstado" class="form-control">
						<option value="0">Seleccione</option>
						<?php 
						
							foreach ($filtrosEstado as $key) {
								echo "<option value='".$key->G732_C17129."'>".utf8_encode($key->Nombre_b)."</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Gestión:</label>
					<select id="cmbtipoGestion" class="form-control">
						<option value="0">Seleccione</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Subgestion:</label>
					<select id="cmbtipoSubGestion" class="form-control">
						<option value="0">Seleccione</option>
						
					</select>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Fecha Inicial:</label>
					<div class="input-group">
						<input type="text" class="form-control pull-right" placeholder="Fecha Inicial" id="reservation" readonly="readonly">
					</div><!-- /.input group -->
				</div><!-- /.form group -->
			</div>	
			<div class="col-md-3">
				<div class="form-group">
					<label>Fecha Final:</label>
					<div class="input-group">
						<input type="text" class="form-control pull-right" placeholder="Fecha Final" id="reservationfinal" readonly="readonly">
					</div><!-- /.input group -->
				</div><!-- /.form group -->
			</div>	
			<div class="row">
				<div class="col-md-3">
					<button class="btn btn-primary " id="BtnBuscarInformes"><i class="fa fa-search"></i></button>
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

 	$("#cmbtipoEstado").change(function() {
	    if ($(this).val()!='') {
		    var path = "<?php echo base_url('extrajudicial/busquedaGestion');?>";
		    var options='<option value="">Seleccione</option>';
		    $("#cmbtipoGestion").html(options);
			$.ajax({
				type:"POST",
				url: path,
				data:{ codigo : $(this).val() }, 
				dataType:'json',
				success:function(response){
                    $.each(response, function(id, dato){
                        options+='<option value="'+dato.id+'">'+dato.valor+'</option>';
                    }); 
                    $("#cmbtipoGestion").html(options);
				}, error: function(){
					alertify.error("Ocurrio un error buscando gestores.");
				}
			});
	    }else{
	    	return false;
	    }
	});


 	$("#cmbtipoGestion").change(function() {
	    if ($(this).val()!='') {
		    var path = "<?php echo base_url('extrajudicial/busquedaSubGestion');?>";
		    var options='<option value="">Seleccione</option>';
		    $("#cmbtipoSubGestion").html(options);
			$.ajax({
				type:"POST",
				url: path,
				data:{ 	codigo : $("#cmbtipoEstado").val(),
						gestion: $("#cmbtipoGestion").val() }, 
				dataType:'json',
				success:function(response){
                    $.each(response, function(id, dato){
                        options+='<option value="'+dato.id+'">'+dato.valor+'</option>';
                    }); 
                    $("#cmbtipoSubGestion").html(options);
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

	    

        
 	});


 	$("#BtnBuscarInformes").click(function(){
    	if ($("#cmbtipoEstado").val() == null || $("#cmbtipoEstado").val() =='0'|| 
    		$("#reservation").val()== null || $("#reservation").val() =='' || 
    		$("#reservationfinal").val()== null || $("#reservationfinal").val() ==''){
    		alertify.error("Debe ingresar un filtro de búsqueda.");
    	
    	}else{
    		$.ajax({
        		type    : "POST",
        		url     : "<?php echo base_url();?>extrajudicial/getBusquedaGestion",
        		data    : { 
						codigo:$("#cmbtipoEstado").val(),
						gestion:$("#cmbtipoGestion").val(),
						subgestion:$("#cmbtipoSubGestion").val() ,
						fechainicial:$("#reservation").val() , 
						fechafinal:$("#reservationfinal").val()
				},

        		success : function (data){
        			console.log(data);
        			$("#Resultadobusqueda").html(data);

        		}

        	})

        	.fail(function() {
    		alert( "error" );
  			});
    	}
 	});
 </script>