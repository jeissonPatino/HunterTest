<section class="content-header">
    <h1>
        
		CARTERA FNG - MIS PROCESOS VIGENTES

    </h1>
    <ol class="breadcrumb">
    	<li><a href="<?php echo base_url();?>home">Inicio</a></li>
    	<li><a href="<?php echo base_url();?>cartera_fng">Cartera Fng</a></li>
        <li class="active">Cartera Fng - Procesos Vigentes</li>
    </ol>
</section>

<?php //echo $this->session->userdata('codigo_abogado');?>
<section class="content">
	<a href="<?php echo base_url();?>cartera_fng" class="btn btn-primary"> &nbsp; Volver &nbsp;</a>
	<div class="box">
		<div class="box-header">
			
			<div class="box-tools">
				
			</div>
		</div><!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
			
			
			
			<table class="table table-hover" id="tablaJudicial">
				<thead>
					<tr>
						
						<th class="col-md-3" style="text-align:center;">Nombre</th>	
						<th class="col-md-1" style="text-align:center;">Tipo Identificacion</th>
						<th class="col-md-3" style="text-align:center;">No. Identificación</th>
						
						<th class="col-md-1" style="text-align:center;">N° Proceso SAP</th>
						<th class="col-md-2" style="text-align:center;">Intermediario Financiero</th>
						<th class="col-md-3" style="text-align:center;">Juzgado</th>
						<th style="text-align:center;">N° Radicado</th>
						<th style="text-align:center;">Ciudad de despacho</th>
						<th style="text-align:center;">Abogado</th>
					</tr>
				</thead>
				<tbody>
					<?php

						/*foreach ($clientes as $key) {
							echo '	<tr  style="cursor:pointer;">
										<td  identificacion ="'.$key->identificacion.'">'.utf8_encode($key->cliente).'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->identificacion.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->SAP.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->banco.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.utf8_encode($key->jusgado).'</td>
										<td  identificacion ="'.$key->identificacion.'">'.$key->radicado.'</td>
										<td  identificacion ="'.$key->identificacion.'">'.utf8_encode($key->ciudad).'</td>
										<td  identificacion ="'.$key->identificacion.'">'.utf8_encode($key->abogado).'</td>
										<td>
											<a href="'.base_url().'cartera_fng/datosJudiciales/'.$key->identificacion.'"  title="información" class="btn btn-sm btn-info">
												<i class="fa fa-info-circle"></i>
											</a>
										</td>
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
<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/alertify.js"></script>


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
	$(function(){
	
		$("#tablaJudicial").DataTable({
				"aaData": <?php echo $clientes; ?>,
				"aoColumns": [
					
					{ mData: "cliente" },
					{ mData: "tipo_identificacion" },
					{ mData: "identificacion" },
					
					{ mData: "SAP" },
					{ mData: "banco" },
					{ mData: "jusgado" },
					{ mData: "radicado" },
					{ mData: "ciudad" },
					{ mData: "abogado" },
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
	              filename: 'Mis procesos vigentes',
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
					var id = aData.identificacion;
					$(nRow).attr("dato",id);
					$(nRow).attr("class",'trobligacion');
					return nRow;
				   
				},
				"fnDrawCallback": function (oSettings, json) {
				   //Aqui va el comando para activar los otros botones
				   $(".trobligacion").dblclick(function(){
						var garantia = $(this).attr("dato").replace(' ', '');
						window.location.href = "<?php echo base_url();?>cartera_fng/datosJudiciales/"+garantia+'/1';
				   });
				}
	    });


		/*$("#tablaJudicial td").dblclick(function(){
	    	var dato = $(this).attr('identificacion').replace(' ', '');
	    	window.location.href = "<?php echo base_url();?>cartera_fng/datosJudiciales/"+dato;
	    });*/
	});


</script>