

<div class="container">

			<div class="panel panel-primary">
				<div class="panel-heading">Selecione a Aplicação</div>
					<div class="panel-body">
					
						<div class="row">
						
							<?php 
								
							$access = explode(',', $this->session->userdata('app_access'));

							?>
		    			
		    			
		    			
		    				<?php
		    				if (in_array(1, $access)) {
			    					echo '<a class="btn btn-default button_painel" href="'. base_url('protocolo') .'">
						  				     <center><span class="fa-stack fa-lg"><i class="fa fa-calendar-check-o fa-stack-2x "></i></span><h6>Protocolo</h6></center></a>'; 
		    				}else{
		    					echo '<a class="btn btn-default button_painel" disabled="disabled" href="" title="Sem permissões de acesso">
						  				     <center><span class="fa-stack fa-lg"><i class="fa fa-calendar-check-o fa-stack-2x "></i></span><h6>Protocolo</h6></center></a>';
		    				}
						  	?>
						  	
						  	<?php
		    				if (in_array(2, $access)) {
								  	echo '<a class="btn btn-default button_painel" href="' . base_url('patrimonio') . '">
											<center><span class="fa-stack fa-lg"><i class="fa fa-university  fa-stack-2x "></i></span><h6>Patrimônio</h6></center></a>';
		    				}else{
		    					echo '<a class="btn btn-default button_painel" disabled="disabled" href="" title="Sem permissões de acesso">
											<center><span class="fa-stack fa-lg"><i class="fa fa-university  fa-stack-2x "></i></span><h6>Patrimônio</h6></center></a>';
		    				}
			    			?>
			    			
			    			<?php 
		    				if (in_array(3, $access)) {
					    			echo '<a class="btn btn-default button_painel" href="'. base_url('almoxarifado') .'">
								  			<center><span class="fa-stack fa-lg"><i class="fa fa-dropbox fa-stack-2x "></i></span><h6>Almoxarifado</h6></center></a>';
		    				}else{
		    					echo '<a class="btn btn-default button_painel" disabled="disabled" href="" title="Sem permissões de acesso">
								  			<center><span class="fa-stack fa-lg"><i class="fa fa-dropbox fa-stack-2x "></i></span><h6>Almoxarifado</h6></center></a>';
		    				}  	
		    				?>		
		  				
						</div>
						
					</div>
					
			</div><!-- FINAL DO PAINEL -->
			
</div>