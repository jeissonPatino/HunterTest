  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/prism.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/chosen.css">


<section class="content-header">
    <h1>
        CARTERA FNG - BÚSQUEDA AVANZADA
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>cartera_fng">Cartera Fng</a></li>
        <li class="active">Cartera Fng - Búsqueda avanzada</li>
    </ol>
</section>

<?php //echo $this->session->userdata('frg');?>
<section class="content">
	<a href="<?php echo base_url();?>cartera_fng" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>
	
	<div class="box">
		<div class="box-header">
			
			<div class="box-tools">
				
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
					<div class="row-fuid">
						<div class="col-md-6">
							<div class="form-group">
								<select class="form-control  js-example-basic-single" tabindex="2" id="selFilro">
									<option value="0">Seleccione un Filtro</option>
									<?php 
										foreach ($filtros as $ke) {
											echo "<option value='".$ke->valor."' esLisop = '".$ke->esLisop."' eslista='".$ke->eslista."' campoLista='".$ke->campoLista."' tabla='".$ke->tabla."'>".$ke->nombreFiltro."</option>";
										}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<table class="table table-hover">
								<thead >
									<tr >
										<th id="dtflt">Filtro</th>
										<th id="dtflt">Valor</th>
										<th id="dtflt"></th>
									</tr>
								</thead>
								<tbody id="TbodyFiltros">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>	
		<div class="box-body table-responsive no-padding">

	
			<div class="box" style= "display: none;">
				<div class="box-header">
					<div class="box-tools">
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<div class="row-fuid">
						<div class="col-md-6">
							<div class="form-group">
								
							</div>
						</div>
						<div class="col-md-6">
							
						</div>
					</div>
				</div>
			</div>	

			<table class="table table-hover" id="tablaBusquedaAvanzada">
				<thead>
					<tr>
						
						
						<th style="text-align:center;">Nombre Deudor</th>
						<th style="text-align:center;">Tipo Identificación</th>
						<th style="text-align:center;">No. Identificación</th>
						
						<th style="text-align:center;">Ciudad Despacho</th>
						<th style="text-align:center;">Intermediario financiero</th>
						<th style="text-align:center;">No. Liquidación</th>
						<th style="text-align:center;">No. Proceso SAP</th>
						<th style="text-align:center;">Valor Pagado</th>
						<th style="text-align:center;">Rol</th>
						<th style="text-align:center; display: none" id="Fechaventa">Fecha de Venta </th>
						
					</tr>
				</thead>
				<tbody id="txtBodyBusqueda">
					<?php
					/*
						foreach ($clientes as $key) {
							echo '	<tr  style="cursor:pointer;">
										<td  identificacion ="'.$key->IDENTIFICACION.'">'.utf8_encode($key->DEUDOR).'</td>
										<td  identificacion ="'.$key->IDENTIFICACION.'">'.$key->IDENTIFICACION.'</td>
										<td  identificacion ="'.$key->IDENTIFICACION.'">'.$key->INTERMEDIARIO.'</td>
										<td  identificacion ="'.$key->IDENTIFICACION.'">'.$key->OBLIGACION.'</td>
										<td  identificacion ="'.$key->IDENTIFICACION.'">'.$key->PROCESO_SAP.'</td>
										<td  identificacion ="'.$key->IDENTIFICACION.'">'.$key->VALOR_PAGADO.'</td>
										<td  identificacion ="'.$key->IDENTIFICACION.'">'.$key->ROL.'</td>
										<td>
											<a href="'.base_url().'cartera_fng/datosJudiciales/'.$key->IDENTIFICACION.'/4"  title="información" class="btn btn-sm btn-info">
												<i class="fa fa-info-circle"></i>
											</a>
										</td>
									</tr>';
						}
					*/
					?>
				</tbody>
			</table>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mySmallModalLabel" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Valor a Buscar</h4>
		</div>
		<div class="modal-body">
			<div class="input-group input-group-sm">
	            <input class="form-control" id="txtBusqueda" type="text" onblur="this.value=this.value.toUpperCase();" placeholder="Valor a buscar">
	            <span class="input-group-btn">
	              	<button class=" btn btn-info fa fa-search" id="btnFiltrar" type="button"></button>
	            </span>
	      	</div>
		</div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mySmallModalLabelFijo" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Valor a Buscar</h4>
		</div>
		<div class="modal-body">
			<div class="input-group input-group-sm">
				<select class="form-control" id="tipoid" hidden="true">
										
				</select>
	            <input class="form-control" id="txtBusquedaFijo" type="text" onblur="this.value=this.value.toUpperCase();" placeholder="Valor a buscar">
	            <span class="input-group-btn">
	              	<button class=" btn btn-info fa fa-search" id="btnFiltrarFijo" type="button"></button>
	            </span>
	      	</div>
		</div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mySmallModalDate" aria-labelledby="mySmallModalDate">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Valor a Buscar</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-4">
					<input class="form-control datemask1" id="txtBusqueda2" type="text" onblur="this.value=this.value.toUpperCase();" placeholder="Fecha Inicial">
				</div>
				<div class="col-md-4">
					<input class="form-control datemask1" id="txtBusquedaFechaFinal" type="text" onblur="this.value=this.value.toUpperCase();" placeholder="Fecha Final">
				</div>
				<div class="col-md-4">
					<button class=" btn btn-info fa fa-search" id="btnFiltrar2" type="button"></button>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mySmallModalCombo" aria-labelledby="mySmallModalCombo">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Valor a Buscar</h4>
		</div>
		<div class="modal-body">
			<div class="input-group input-group-sm">
	            <select class="form-control" id="selectPreguntas">

	            </select>
	      	</div>
		</div>
    </div>
  </div>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mySmallModalComboValores" aria-labelledby="mySmallModalComboValores">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Valor a Buscar</h4>
		</div>
		<div class="modal-body">
			<div class="input-group input-group-sm">
	            <select class="form-control" id="selectPreguntas2">

	            </select>
	      	</div>
		</div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mySmallModalNumero" aria-labelledby="mySmallModalNumero">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Valor a Buscar</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-4">
					<input class="form-control numeros" id="txtBusquedaNumeros" type="text"  placeholder="Desde">
				</div>
				<div class="col-md-4">
					<input class="form-control numeros" id="txtBusquedaNumerosFinal" type="text" placeholder="Hasta">
				</div>
				<div class="col-md-4">
					<button class=" btn btn-info fa fa-search" id="btnFiltrar3" type="button"></button>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="mySmallModalFechaVenta" aria-labelledby="mySmallModalFechaVenta">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="gridSystemModalLabel">Valor a Buscar</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-4">
		            <label>Año venta CISA:</label>
					<select  id="selectyearCISA" class="form-control" hidden = "true">
						<option value="0">Todos los años</option>
						<?php 
							foreach ($fecha as $key) {
								echo "<option value='".$key->year."'>".$key->year."</option>";
							}
						?>
					</select>	
	      		</div>
	      		<div class="col-md-4">
	      			<label>Mes venta CISA:</label>
	            		<select multiple class="form-control" id="selectMesCISA" hidden = "true">

	            		</select>
		         </div>
				<div class="col-md-4">
					<button class="btn btn-info btn-flat" id="btnFiltrarFecha" type="button">Buscar</button>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>

 <!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css">
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css">-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.flash.js"></script>
<script src="<?php echo base_url();?>assets/bajadas/Jzip.js"></script>
<!--<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>-->
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/extensions/Buttons/js/buttons.print.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    		$('.js-example-basic-single').select2();
		});

 	var contadorfiltros = 0;
 	var array_datos = new Array();
	busqueda = {
		busquedaAvanzada : function(datos){

			$.ajax({
				url     : '<?php echo base_url();?>cartera_fng/buscar',
				type    : 'POST',
				data    : { filtros : datos},
				dataType: 'json',
				success : function(data){
					if($.fn.dataTable.isDataTable( '#tablaBusquedaAvanzada' )){
	    				$("#tablaBusquedaAvanzada").dataTable().fnDestroy();
	    			}
					
					$("#tablaBusquedaAvanzada").DataTable({
						"aaData": data,
							"aoColumns": [
								
								{ mData: "DEUDOR" },
								{ mData: "tipo_identificacion" },
								{ mData: "IDENTIFICACION" },
								
								{ mData: "CIUDAD_DOMICILIO"},
								{ mData: "INTERMEDIARIO" },
								{ mData: "OBLIGACION" },
								{ mData: "PROCESO_SAP" },
								{ mData: "VALOR_PAGADO" },
								{ mData: "ROL" }
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
			                  filename: 'Búsqueda avanzada',
			                  bom: true
			                  }],
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
							"processing": true,
						   //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
							"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.IDENTIFICACION;
								$(nRow).attr("dato",id);
								$(nRow).attr("class",'trobligacion');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacion").dblclick(function(){
									var garantia = $(this).attr('dato').replace(' ', '');
									window.location.href = "<?php echo base_url();?>cartera_fng/datosJudiciales/"+garantia+"/4";
							   });
							}
					});
					
						//console.log(data);
				}	
			});
		},

		busquedapredeterminada : function(){
			$.ajax({
				url     : '<?php echo base_url();?>cartera_fng/buscar2',
				type    : 'POST',
				dataType: "json",
				success : function(data){
					if($.fn.dataTable.isDataTable( '#tablaBusquedaAvanzada' )){
	    				$("#tablaBusquedaAvanzada").dataTable().fnDestroy();
	    			}
					
					$("#tablaBusquedaAvanzada").DataTable({
						"aaData": data,
							"aoColumns": [
								
								{ mData: "DEUDOR" },
								{ mData: "tipo_identificacion" },
								{ mData: "IDENTIFICACION" },
								
								{ mData : "CIUDAD_DOMICILIO"},
								{ mData: "INTERMEDIARIO" },
								{ mData: "OBLIGACION" },
								{ mData: "PROCESO_SAP" },
								{ mData: "VALOR_PAGADO" },
								{ mData: "ROL" }
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
			                  filename: 'Búsqueda avanzada',
			                  bom: true
			                  }],
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
							"processing": true,
						   //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
							"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.IDENTIFICACION;
								$(nRow).attr("dato",id);
								$(nRow).attr("class",'trobligacion');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacion").dblclick(function(){
									var garantia = $(this).attr('dato').replace(' ', '');
									window.location.href = "<?php echo base_url();?>cartera_fng/datosJudiciales/"+garantia+"/4";
							   });
							}
						});
					
					//console.log(data);
				}	
			});
		},

		modalFiltro: function(txtBusqueda, label){
			var filtro = $("#selFilro").val();
     		var value = txtBusqueda;

     		if(filtro == 0){

     		}else{
     			array_datos[contadorfiltros] = filtro + "$"+ value;

	     		var td = '<tr class="'+contadorfiltros+'">';
				td	+= '<td>'+$("#selFilro option:selected").text()+'</td>';
				td	+= '<td>'+label+'</td>';
				td	+= '<td>';
				td  += '<a onclick="eliminarFiltro('+contadorfiltros+');" title="Eliminar" class="btn btn-sm btn-danger">';
				td  += '<i class="fa fa-trash"></i>';
				td  += '</a>';
				td  += '</td>';
				td	+= '</tr>';

				$("#TbodyFiltros").append(td);

	   			contadorfiltros = contadorfiltros + 1;
	   			console.log(array_datos.length);
	   			busqueda.busquedaAvanzada(array_datos);

	   			$("#txtBusqueda").val(' ');
	   			$('#selFilro').prop('selectedIndex',0);
				$("#mySmallModalLabel").modal('hide');
				$("#mySmallModalCombo").modal('hide');
				$("#mySmallModalDate").modal('hide'); 
				$("#mySmallModalComboValores").modal('hide');
				$("#mySmallModalLabelFijo").modal('hide');
				$("#mySmallModalNumero").modal('hide');
				$("#mySmallModalFechaVenta").modal('hide');
				
     		}
     		

		},

		modalFiltroCOmboVAlores: function(txtBusqueda, label, year){
			var filtro = $("#selFilro").val();
     		var value = txtBusqueda;

     		if(filtro == 0){

     		}else{
     			array_datos[contadorfiltros] = filtro + "$"+ value;

	     		var td = '<tr class="'+contadorfiltros+'">';
				td	+= '<td>'+$("#selFilro option:selected").text()+'</td>';
				td	+= '<td>'+txtBusqueda+' - '+ year +'</td>';
				td	+= '<td>';
				td  += '<a onclick="eliminarFiltro('+contadorfiltros+');" title="Eliminar" class="btn btn-sm btn-danger">';
				td  += '<i class="fa fa-trash"></i>';
				td  += '</a>';
				td  += '</td>';
				td	+= '</tr>';

				$("#TbodyFiltros").append(td);

	   			contadorfiltros = contadorfiltros + 1;
	   			console.log(array_datos.length);
	   			busqueda.busquedaAvanzada(array_datos);

	   			$("#txtBusqueda").val(' ');
	   			$('#selFilro').prop('selectedIndex',0);
				$("#mySmallModalLabel").modal('hide');
				$("#mySmallModalCombo").modal('hide');
				$("#mySmallModalDate").modal('hide');
				$("#mySmallModalComboValores").modal('hide');
				$("#mySmallModalLabelFijo").modal('hide');
				$("#mySmallModalNumero").modal('hide');
				$("#mySmallModalFechaVenta").modal('hide');
     		}
     		

		},


		modalFiltroAca: function(txtBusqueda, label){
			var filtro = $("#selFilro").val();
			var filtroTxt = $("#tipoid").val();
     		var value = txtBusqueda;
     		
     		     		

     		if(filtro == 0 ){
     			

     		}else{
     			     			

	     		array_datos[contadorfiltros] = filtro + "-"+ value;

	     		var td = '<tr class="'+contadorfiltros+'">';
				td	+= '<td>'+$("#selFilro option:selected").text()+'</td>';
				td	+= '<td>'+label+'</td>';
				td	+= '<td>';
				td  += '<a onclick="eliminarFiltro('+contadorfiltros+');" title="Eliminar" class="btn btn-sm btn-danger">';
				td  += '<i class="fa fa-trash"></i>';
				td  += '</a>';
				td  += '</td>';
				td	+= '</tr>';

				if (filtroTxt != 'Seleccione' && filtroTxt != null ){
					contadorfiltros = contadorfiltros + 1;

					td  += '<tr class="'+ (contadorfiltros) +'">';
					td	+= '<td>Tipo Identificación</td>';
					td	+= '<td>'+filtroTxt+'</td>';
					td	+= '<td>';
					td  += '<a onclick="eliminarFiltro('+ (contadorfiltros ) +');" title="Eliminar" class="btn btn-sm btn-danger">';
					td  += '<i class="fa fa-trash"></i>';
					td  += '</a>';
					td  += '</td>';
					td	+= '</tr>';
					
					array_datos[contadorfiltros] = "InformacionCliente.tipo_identificacion" + "-"+ filtroTxt;
					$("#tipoid").val('');
					


				}

				$("#TbodyFiltros").append(td);

	   			contadorfiltros = contadorfiltros + 1;  			
	   			

	   			busqueda.busquedaAvanzada(array_datos);
	   			$("#txtBusqueda").val(' ');
	   			$('#selFilro').prop('selectedIndex',0);
				$("#mySmallModalLabel").modal('hide');
				$("#mySmallModalCombo").modal('hide');
				$("#mySmallModalDate").modal('hide');
				$("#mySmallModalComboValores").modal('hide');
				$("#mySmallModalLabelFijo").modal('hide');
				$("#mySmallModalNumero").modal('hide');
				$("#mySmallModalFechaVenta").modal('hide');
			}

		},

		modalFiltroBusqueda15: function(){
			var filtro = $("#selFilro").val();
     		var value = txtBusqueda;

     		if(filtro == 0){

     		}else{

	     		array_datos[contadorfiltros] = filtro + "-"+ value;

	     		var td = '<tr class="'+contadorfiltros+'">';
				td	+= '<td>'+$("#selFilro option:selected").text()+'</td>';
				td	+= '<td>NA</td>';
				td	+= '<td>';
				td  += '<a onclick="eliminarFiltro('+contadorfiltros+');" title="Eliminar" class="btn btn-sm btn-danger">';
				td  += '<i class="fa fa-trash"></i>';
				td  += '</a>';
				td  += '</td>';
				td	+= '</tr>';

				$("#TbodyFiltros").append(td);

	   			contadorfiltros = contadorfiltros + 1;
	   			console.log(array_datos.length);
	   			busqueda.busqueda15();

	   			$("#txtBusqueda").val(' ');
	   			$('#selFilro').prop('selectedIndex',0);
				$("#mySmallModalLabel").modal('hide');
				$("#mySmallModalCombo").modal('hide');
				$("#mySmallModalDate").modal('hide');
				$("#mySmallModalComboValores").modal('hide');
				$("#mySmallModalLabelFijo").modal('hide');
				$("#mySmallModalNumero").modal('hide');
				$("#mySmallModalFechaVenta").modal('hide');
			}
		},


// Modal Fecha de Venta CISA 
		modalFiltroFechaVenta: function( selectyearCISA, selectMesCISA){
			var filtro = $("#selFilro").val();
			var filtroyear = selectyearCISA;
			var filtromes = selectMesCISA;
     		var value = filtroyear;

     		if(filtro == 0){

     		}else{
     			array_datos[contadorfiltros] = filtro + "=>"+ value+"=>"+filtromes;

	     		var td = '<tr class="'+contadorfiltros+'">';
				td	+= '<td>'+$("#selFilro option:selected").text()+'</td>';
				td	+= '<td>'+ filtroyear + '-' +filtromes + '</td>';
				td	+= '<td>';
				td  += '<a onclick="eliminarFiltro('+contadorfiltros+');" title="Eliminar" class="btn btn-sm btn-danger">';
				td  += '<i class="fa fa-trash"></i>';
				td  += '</a>';
				td  += '</td>';
				td	+= '</tr>';


				$("#TbodyFiltros").append(td);

	   			contadorfiltros = contadorfiltros + 1;
	   			busqueda.FechaVenta(filtroyear,filtromes);



	   			$("#txtBusqueda").val(' ');
	   			$('#selFilro').prop('selectedIndex',0);
				$("#mySmallModalLabel").modal('hide');
				$("#mySmallModalCombo").modal('hide');
				$("#mySmallModalDate").modal('hide');
				$("#mySmallModalComboValores").modal('hide');
				$("#mySmallModalLabelFijo").modal('hide');
				$("#mySmallModalNumero").modal('hide');
				$("#mySmallModalFechaVenta").modal('hide');
			}
		},

		modalFiltroFechas: function( txtBusqueda,mFechaFin, label){
			var filtro = $("#selFilro").val();
     		var value = txtBusqueda;

     		if(filtro == 0){

     		}else{
	     		array_datos[contadorfiltros] = filtro + "=>"+ value+"=>"+mFechaFin;

	     		var td = '<tr class="'+contadorfiltros+'">';
				td	+= '<td>'+$("#selFilro option:selected").text()+'</td>';
				td	+= '<td>'+label+'</td>';
				td	+= '<td>';
				td  += '<a onclick="eliminarFiltro('+contadorfiltros+');" title="Eliminar" class="btn btn-sm btn-danger">';
				td  += '<i class="fa fa-trash"></i>';
				td  += '</a>';
				td  += '</td>';
				td	+= '</tr>';

				$("#TbodyFiltros").append(td);

	   			contadorfiltros = contadorfiltros + 1;
	   			busqueda.busquedaAvanzada(array_datos);

	   			$("#txtBusqueda").val(' ');
	   			$('#selFilro').prop('selectedIndex',0);
				$("#mySmallModalLabel").modal('hide');
				$("#mySmallModalCombo").modal('hide');
				$("#mySmallModalDate").modal('hide');
				$("#mySmallModalComboValores").modal('hide');
				$("#mySmallModalLabelFijo").modal('hide');
				$("#mySmallModalNumero").modal('hide');
				$("#mySmallModalFechaVenta").modal('hide');
			}
		},

		busqueda15 : function(){
			$.ajax({
				url     : '<?php echo base_url();?>cartera_fng/buscarPor15',
				type    : 'POST',
				dataType: "json",
				success : function(data){
					if($.fn.dataTable.isDataTable( '#tablaBusquedaAvanzada' )){
	    				$("#tablaBusquedaAvanzada").dataTable().fnDestroy();
	    			}
					
					$("#tablaBusquedaAvanzada").DataTable({
						"aaData": data,
							"aoColumns": [
								
								{ mData: "DEUDOR" },
								{ mData: "tipo_identificacion" },
								{ mData: "IDENTIFICACION" },
								{ mData : "CIUDAD_DOMICILIO"},
								{ mData: "INTERMEDIARIO" },
								{ mData: "OBLIGACION" },
								{ mData: "PROCESO_SAP" },
								{ mData: "VALOR_PAGADO" },
								{ mData: "ROL" }
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
			                  charset: 'utf-8',
			                  fieldSeparator : ';',
			                  extension: '.csv',
			                  filename: 'Búsqueda avanzada',
			                  bom: true
			                  }],
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
							"processing": true,
						   //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
							"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.IDENTIFICACION;
								$(nRow).attr("dato",id);
								$(nRow).attr("class",'trobligacion');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacion").dblclick(function(){
									var garantia = $(this).attr('dato').replace(' ', '');
									window.location.href = "<?php echo base_url();?>/cartera_fng/datosJudiciales/"+garantia+"/4";
							   });
							}
						});
					
					//console.log(data);
				}	
			});
		},

		FechaVenta : function(anioSel,mesSEL){
			
			$.ajax({
				url     : '<?php echo base_url();?>cartera_fng/FechaVentaCisa',
				type    : 'POST',
				dataType: "json",
				data    : { anio: anioSel , mes:  mesSEL},
				success : function(data){
					if($.fn.dataTable.isDataTable( '#tablaBusquedaAvanzada' )){
	    				$("#tablaBusquedaAvanzada").dataTable().fnDestroy();
	    			}
					
					$("#tablaBusquedaAvanzada").DataTable({
						 "aaData":data, 
							"aoColumns": [
								{ mData: "DEUDOR" },
								{ mData: "TipoIdentificacion" },
								{ mData: "Identificacion" },
								{ mData : "Ciudad"},
								{ mData: "IF" },
								{ mData: "Liquidacion" },
								{ mData: "ProcesoSAP" },
								{ mData: "ValorPago" },
								{ mData: "ROL" },
								{ mData: "FechaVenta" }
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
				                  charset: 'utf-8',
				                  fieldSeparator : ';',
				                  extension: '.csv',
				                  filename: 'Búsqueda avanzada',
				                  bom: true
				                  }],
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
							"processing": true,
						   //	"ajax": "<?php echo base_url();?>Cartera_fng/getDatosProcesosVigentes",
							"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
								var id = aData.IDENTIFICACION;
								$(nRow).attr("dato",id);
								$(nRow).attr("class",'trobligacion');
								return nRow;
							   
							},
							"fnDrawCallback": function (oSettings, json) {
							   //Aqui va el comando para activar los otros botones
							   $(".trobligacion").dblclick(function(){
									var garantia = $(this).attr('dato').replace(' ', '');
									window.location.href = "<?php echo base_url();?>cartera_fng/datosJudiciales/"+garantia+"/4";
							   });
							}
						});
					
					//console.log(data);
				}	
			});
		}

	}


	$(function(){

		$.ajax({
		url     : '<?php echo base_url();?>cartera_fng/rellenarDatosComboTipoid',
		type    : 'POST',
		data    : { },
		success : function(contenido){
			
			$("#tipoid").html("<option selected>Seleccione</option>" + contenido);
			
		   }	
	    });


	    $("#selectyearCISA").change(function(){
        	
        	$.ajax({
        		type    : "GET",
        		url     : "<?php echo base_url();?>cartera_fng/rellenarDatosComboFechaventaMes/"+ $(this).val(),
        		success : function (data){
        			$("#selectMesCISA").html(data);
        		}
        	});
        });


		$(".numeros").numeric();

		$.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Today",
            clear: "Clear",
            format: "dd/mm/yyyy",
            titleFormat: "dd/mm/yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

         //datemask1 dd/mm/yyyy
        $("#txtBusqueda2").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate',function(selected){
	        startDate = new Date(selected.date.valueOf());
	        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
	        $('#txtBusquedaFechaFinal').datepicker('setStartDate', startDate);
	    }); 

        $("#txtBusquedaFechaFinal").datepicker({
            language: "es",
            autoclose: true,
            todayHighlight: true
        });

        $(".close").click(function(){
        	$('#selFilro').prop('selectedIndex',0);
        });
        // Daniel Salgado Mejora, Busqueda Avanzada quitar pre carga al abrir el modulo 2017-12-19
/*
		$.ajax({
			url  :  "<?php echo base_url();?>cartera_fng/Datosbusquedavanzadad",
			type : 'POST',
			dataType : 'json',
			beforeSend : function(){
                $.blockUI({ message: '<img src="<?php echo base_url();?>assets/img/cargando/loader.gif" />' });
			},
			complete : function(){
				$.unblockUI();
			},
			success : function(data){
				$("#tablaBusquedaAvanzada").DataTable({		
					"aaData": data,
					"aoColumns": [
						
						{ mData: "DEUDOR" },
						{ mData: "IDENTIFICACION" },
						{ mData : "CIUDAD_DOMICILIO"},
						{ mData: "INTERMEDIARIO" },
						{ mData: "OBLIGACION" },
						{ mData: "PROCESO_SAP" },
						{ mData: "VALOR_PAGADO" },
						{ mData: "ROL" }
					],
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
					"processing": true,
					"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
						var id = aData.IDENTIFICACION;
						$(nRow).attr("dato",id);
						$(nRow).attr("class",'trobligacion');
						return nRow;
					   
					},
					"fnDrawCallback": function (oSettings, json) {
					   //Aqui va el comando para activar los otros botones
					   $(".trobligacion").dblclick(function(){
							var garantia = $(this).attr('dato').replace(' ', '');
							window.location.href = "<?php echo base_url();?>cartera_fng/datosJudiciales/"+garantia+"/4";
					   });
					},
					"bJQueryUI": true,
					"bProcessing": true,
					"bSort": true,
					"bSortClasses": false,
					"bDeferRender": true,
					"sPaginationType": "simple",
		            "iDisplayLength": 20,
		            "aaSorting":[[0,"asc"]],
		            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
			    });

			}
		});
*/
 		
	    
     	$("#selFilro").change(function(){
     		if($(this).val() === 'Busqueda15'){
     			busqueda.modalFiltroBusqueda15();
     		}

     		else if($(this).val() === 'Fechaventa'){
     			//busqueda.modalFiltroFechaVenta();

     			$("#Fechaventa").show();
     			$("#mySmallModalFechaVenta").modal({
											backdrop : "static" ,
											keyboard : false

										});

     		}else{
     			var sel = $('option:selected', this);
	     		if(sel.attr('eslista') == '11'){
	     			$.ajax({
						url     : '<?php echo base_url();?>cartera_fng/rellenarDatosCombo',
						type    : 'POST',
						data    : { tabla: sel.attr('tabla') , campo:  sel.attr('campoLista')},
						success : function(contenido){
							
							$("#selectPreguntas").html("<option>Seleccione</option>" + contenido);
							$("#selectPreguntas").change(function(){
								busqueda.modalFiltroAca($(this).val(), $("#selectPreguntas option:selected").text());
							});
							$("#mySmallModalCombo").modal({
								backdrop : "static" ,
								keyboard : false

							});

						}	
					});
	     		}else if(sel.attr('eslista') == '6'){
	     			
	     			$.ajax({
						url     : '<?php echo base_url();?>cartera_fng/rellenardatosComboLisop',
						type    : 'POST',
						data    : { codigo: sel.attr('esLisop')},
						success : function(contenido){
							
							$("#selectPreguntas").html("<option>Seleccione</option>" + contenido);
							$("#selectPreguntas").change(function(){
								busqueda.modalFiltro($(this).val(), $("#selectPreguntas option:selected").text());
							});
							$("#mySmallModalCombo").modal({
								backdrop : "static" ,
								keyboard : false

							});

						}	
					});
	     		}else if(sel.attr('eslista') == '12'){
	     			var codigo = 'AUX001';
	     			if($(this).val() == 'Factura.FechaFacturaSoporteCISA'){
	     				codigo = 'AUX001';
	     			}else if($(this).val() == 'Factura.ValorFacturadoSentenciaIrrecuperable'){
	     				codigo = 'AUX002' ;
	     			}
	     			$.ajax({
						url     : '<?php echo base_url();?>cartera_fng/rellenardatosComboValores',
						type    : 'POST',
						data    : { codigo: codigo },
						success : function(contenido){
							
							$("#selectPreguntas2").html("<option>Seleccione</option>" + contenido);
							$("#selectPreguntas2").change(function(){
								busqueda.modalFiltroCOmboVAlores($(this).val(),  $("#selectPreguntas option:selected").text(), $("#selectPreguntas2 option:selected").attr('year'));
							});
							$("#mySmallModalComboValores").modal({
								backdrop : "static" ,
								keyboard : false

							});

						}	
					});
	     		}else if(sel.attr('eslista') == '5'){
	     			$("#mySmallModalDate").modal({
	     				backdrop : "static" ,
						keyboard : false

	     			});
	     		}else if(sel.attr('eslista') == '13'){
	     			$("#mySmallModalNumero").modal({
	     				backdrop : "static" ,
						keyboard : false

	     			});
	     		}else if(sel.attr('eslista') == '14'){
	     			$("#mySmallModalLabelFijo").modal({
	     				backdrop : "static" ,
						keyboard : false

	     			});
	     			
	     			$("#tipoid").hide();	     			
	     			
	     			if(sel.attr('value') == 'InformacionCliente.NroIdentificacion'){
	     				$("#tipoid").show();
	     			}
	     		}else{
	     			$("#mySmallModalLabel").modal({
	     				backdrop : "static" ,
						keyboard : false
	     			});
	     		}
     		}
     	});
     	
     	$("#btnFiltrar").click(function(){
     		busqueda.modalFiltro($("#txtBusqueda").val(), $("#txtBusqueda").val());
     		$("#txtBusqueda").val('');
     	});

     	$("#txtBusqueda").keypress(function(e){
     		if(e.keyCode == 13)
		    {
		        busqueda.modalFiltro($(this).val(), $(this).val());
		        $(this).val('');
		    }
     	});


		$("#txtBusquedaFijo").keypress(function(e){
     		if(e.keyCode == 13)
		    {
		        busqueda.modalFiltroAca($(this).val(), $(this).val());
		        $(this).val('');
		    }
     	});

		 $("#btnFiltrarFijo").click(function(){
     		busqueda.modalFiltroAca($("#txtBusquedaFijo").val(), $("#txtBusquedaFijo").val());
     		$("#txtBusquedaFijo").val('');
     	});

     	$("#btnFiltrar2").click(function(){
     		busqueda.modalFiltroFechas($("#txtBusqueda2").val(), $("#txtBusquedaFechaFinal").val(), $("#txtBusqueda2").val()+' - '+$("#txtBusquedaFechaFinal").val());
     		$("#txtBusqueda2").val('');
     		$("#txtBusquedaFechaFinal").val('')
     	});

     	$("#btnFiltrarFecha").click(function(){
     		busqueda.modalFiltroFechaVenta($("#selectyearCISA").val(), $("#selectMesCISA").val());
     		$("#selectyearCISA").val('');
     		$("#selectMesCISA").val('')
     	});


     	$("#btnFiltrar3").click(function(){
     		busqueda.modalFiltroFechas($("#txtBusquedaNumeros").val(), $("#txtBusquedaNumerosFinal").val(), $("#txtBusquedaNumeros").val()+' - '+$("#txtBusquedaNumerosFinal").val());
     		$("#txtBusquedaNumeros").val('');
     		$("#txtBusquedaNumerosFinal").val('')
     	});


     	$("#txtBusquedaNumeros").keypress(function(e){
     		if(e.keyCode == 13)
		    {
		        busqueda.modalFiltro($(this).val(), $(this).val());
		        $(this).val('');
		    }
     	});

     	$("#txtBusqueda2").keypress(function(e){
     		if(e.keyCode == 13)
		    {
		        busqueda.modalFiltro($(this).val(), $(this).val());
		        $(this).val('');
		    }
     	});
	});

	function eliminarFiltro(id){
		array_datos.splice(id, 1);
		$("."+id).hide();
		//console.log(array_datos.length);
		//$("#tablaBusquedaAvanzada").dataTable().fnDestroy();
		var table = $('#tablaBusquedaAvanzada').DataTable();
		 table
    	.clear()
    	.draw();
		if(contadorfiltros > array_datos.length){
			var resta = Number(contadorfiltros) - Number(array_datos.length);
			contadorfiltros = contadorfiltros - resta;
		}
		if (array_datos.length > '0') {


			busqueda.busquedaAvanzada(array_datos);
		
		}
		
	}


</script>
<script src="<?php echo base_url();?>assets/bootstrap/js/chosen.jquery.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/init.js" charset="utf-8"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/prism.js" charset="utf-8"></script>


