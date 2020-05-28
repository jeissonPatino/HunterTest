<section class="content-header">
    <h1>
        CARTERA FNG - MIS CLIENTES VIGENTES
    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>cartera_fng">Cartera Fng</a></li>
        <li class="active">Cartera Fng - Mis clientes vigentes</li>
    </ol>
</section>


<section class="content">
	<a href="<?php echo base_url();?>Extrajudicial" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>
	<div class="box">
		<div class="box-header">
			
			<div class="box-tools">
				
			</div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			
			
			<table class="table table-hover" id="tablaJudicial">
				<thead>
					<tr>
						<th style="text-align:center;" class="col-md-4">Nombre</th>
						<th style="text-align:center;">Identificación</th>
						<th style="text-align:center;">No. Liquidación</th>
						<th style="text-align:center;">Fecha de pago de la garantia</th>
						<th style="text-align:center;" class="col-md-2">Valor pagado</th>
					
					</tr>
				</thead>
				<tbody>
					<?php

						/*foreach ($clientes as $key) {
							echo '	<tr  style="cursor:pointer;">
										<td  identificacion ="'.$key->identificacion.'"><b>'.utf8_encode($key->deudor).'</b></td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->identificacion.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->contrato.'</td>
										<td  identificacion ="'.$key->identificacion.'">$ '.number_format($key->valor, 0, ',','.').'</td>

										
									</tr>';
						}*/
					?>
				</tbody>
			</table>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</section><!-- /.content -->

 <!-- DataTables -->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(function(){
		/*jQuery.fn.dataTableExt.oSort["myNumeric-desc"] = function(x, y) {
		  	var myX = $(x).text().replace(/[^0-9.-]/g, ""),
		    myY = $(y).text().replace(/[^0-9.-]/g, "");
		  	if (!myX) myX = -9999999999999;
		  	if (!myY) myY = -9999999999999;
		  	return myX - myY;
		};

		jQuery.fn.dataTableExt.oSort["myNumeric-asc"] = function(x, y) {
		  	return jQuery.fn.dataTableExt.oSort["myNumeric-desc"](y, x);
		}*/


		$("#tablaJudicial").DataTable({
				"aaData": <?php echo $clientes; ?>,
				"aoColumns": [
					
					{ mData: "deudor" },
					{ mData: "identificacion" },
					{ mData: "contrato"},
					{ mData: "garantia"},
					{ mData: "valor"}
					
				],
				"aoColumnDefs": [ {"aTargets":[0], "sType": "html"} ],

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
					var id = aData.identificacion;
					$(nRow).attr("dato",id);
					$(nRow).attr("class",'trobligacion');
					return nRow;
				   
				},
				"fnDrawCallback": function (oSettings, json) {
				   //Aqui va el comando para activar los otros botones
				   $(".trobligacion").dblclick(function(){
						var garantia = $(this).attr('dato').replace(' ', '');
						window.location.href = "<?php echo base_url();?>extrajudicial/gestionar/"+garantia+"/6";
				   });
				},
				"	bJQueryUI": true,
				"bProcessing": true,
				"bSort": true,
				"bSortClasses": false,
				"bDeferRender": true,
				"sPaginationType": "simple",
	            "iDisplayLength": 20,
	            "aaSorting":[[0,"asc"]],
	            "aLengthMenu": [[20, 40, 60, 100], [20, 40, 60, 100]]
	    });


     	

	});


</script>