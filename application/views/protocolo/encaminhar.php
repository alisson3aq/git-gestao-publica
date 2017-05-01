

	<div class="row">
	
	
	
		<div class="panel panel-default">
		
			 <?php foreach($listagem as $lista){ ?>
		  
		  <div class="table-responsive">
		  	<table class="table">
				<tr>
					<td width="90%">
					
						<h2 style="margin: 0;">
						<strong><span id="id_protocolo">Protocolo: <?php echo separaCodigo($lista->numero_processo); ?></span> - 
						<small><?php echo datasemtempo_final($lista->data_cadastro); ?> - <?php echo datacomtempo($lista->data_cadastro); ?></small>
						</strong></h2>
					
					</td>
					
					<td width="10%">
					<?php 
					
					
				        	if ($lista->situacao_processo == '1') {
				        		
				        		echo '<span class="label label-default"> P R O T O C O L A D O </span>';
												        			
				        	} elseif ($lista->situacao_processo == '2') {
				        			
				        		echo '<span class="label label-success"> T R A M I T A N D O </span>';
				        	
				        	} elseif ($lista->situacao_processo == '3') {
				        			
				        		echo '<span class="label label-warning"> E M  &nbsp &nbsp A N Á L I S E </span>';
				        	
				        	} elseif ($lista->situacao_processo == '4') {
				        			
				        		echo '<span class="label label-danger">&nbsp A R Q U I V A D O &nbsp</span>';
				        	
				        	} 
        	
        			?>
        			</td>
				</tr>
			
			</table>
			</div>
			
			<?php } ?>
		
		
			<div class="panel-body">
			
				<?php foreach($listagem as $lista){ ?>
				
				<form action="<?php echo base_url() . $this->uri->segment(1); ?>/encaminhar/<?php echo $lista->id_protocolo; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				
						<?php echo validation_errors(); ?>
						
						<input type="hidden" name="movimento" value="<?php echo $lista->id_protocolo; ?>" />
						
						<div class="form-group form-group-lg">
    						<label for="inputAssunto" class="col-sm-2 control-label">Descrição</label>
							    <div class="col-sm-9">
							      <input type="text" name="assunto_processo" class="form-control" id="inputAssunto" 
							      		placeholder="Descrição do Processo" value="<?php echo $lista->assunto_processo; ?>" readonly="readonly">
							    </div>
  						</div>
				
  						<div class="form-group form-group-lg">
    						<label for="inputOrigem" class="col-sm-2 control-label">Rementente</label>
    							<div class="col-sm-1">
							      <input type="text" name="id_origem" class="form-control inputIDOrigem" value="<?php echo $this->session->userdata('setor_lotacao')?>" readonly="readonly">
							     </div>
							    <div class="col-sm-7">
							      <input type="text" name="origem" class="form-control inputOrigem" value="<?php echo $this->listagem->listar_setor($this->session->userdata('setor_lotacao')); ?>" placeholder="Unidade de Origem" readonly="readonly">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputDestino" class="col-sm-2 control-label">Destinatário</label>
								 <div class="col-sm-1">
							      <input type="text" name="id_destino" class="inputIDDestino form-control" readonly="readonly">
							     </div>
    						    <div class="col-sm-7">
							      <input type="text" name="destino" class="form-control inputDestino" placeholder="Unidade de Destino" onblur="buscarDestinatario()">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputObs" class="col-sm-2 control-label">Despacho de envio</label>
							    <div class="col-sm-8">
							      <textarea name="despacho_origem" class="form-control" rows="5"></textarea>
							    </div>
  						</div>
  						
  						
  						<div class="well well-sm text-right">
							<input type="submit" value="Encaminhar" class="btn btn-primary">
							<a <a href='javascript:history.back(-1)' class="btn btn-default"> Cancelar </a>
						</div>
  						
				</form>
  				<?php } ?>
			</div>
		</div>
	
	
	</div>


</div>