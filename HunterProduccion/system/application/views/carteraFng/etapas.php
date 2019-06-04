
<div class="col-md-2">&nbsp;</div>
<div class="col-md-8">

	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	
		<?php 
			$i = 0;
			$j = 0;
			foreach ($Etapas as $key) {
				
				if($j < 3){
					if($i==0){
						echo '<div class="row">';
					}
		?>
					<div class="col-md-3">
		            	<a onclick="javascript: getDatosWizard(<?php echo $key->G725_ConsInte__b; ?>, '<?php echo utf8_encode($key->Etapa); ?>');">
		            		<img alt="<?php echo $key->Etapa; ?>" src="<?php echo base_url();?>assets/imagenes/etapas/<?php echo $key->Campo_Imagen; ?>" style="width: 150; height: auto;">
		            	</a>
		        	</div>
				<?php
					$i++;
					if($i == 3){
						echo '</div>';
						echo '</br>';
						$i = 0;	
						$j++;
					}
				}else{
					if($i==0){
						echo '<div class="row">';
					}
				?>
					<div class="col-md-3">
		            	<a onclick="javascript: getDatosWizard(<?php echo $key->G725_ConsInte__b; ?>, '<?php echo utf8_encode($key->Etapa); ?>');">
		            		<img alt="<?php echo $key->Etapa; ?>" src="<?php echo base_url();?>assets/imagenes/etapas/<?php echo $key->Campo_Imagen; ?>" style="width: 150; height: auto;">
		            	</a>
		        	</div>
				<?php
					$i++;
					if($i == 4){
						echo '</div>';
						echo '</br>';
						$i = 0;	
						$j++;
					}
				}
				
			} 
		?>
  	</div>		
</div>
