	
	<div class="row">
	
		<div class="panel panel-default">
		
		<?php foreach($tramite as $tra){ 
			
			$contagem = count($tramite);
			
		}
		
		?>
		
		<?php foreach($movimento as $mov){ 
		
			$movimento1 = $mov->id;
			
		}
		
		?>
		
		<?php foreach($acesso as $acc){
			
			$permissao1 = $acc->destino;
			
		} ?>
		
		<?php foreach($cancelar as $can){
			
			$cancelar1 = $can->origem;
			
		} ?>
		
		
		<?php foreach($situacao as $sit){
			
			$situacao1 = $sit->situacao;
			
		} ?>
		
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
		
			<div class="panel-body">
			
			<?php if(verifica_situacao('1', $situacao1, $permissao1)){ //REGISTRAR O RECEBIMENTO DO PROCESSO ?>
			
						<a class="btn btn-default btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" href="<?php echo base_url() . $this->uri->segment(1); ?>/atualiza/<?php echo $lista->id_protocolo; ?>" role="button"><i class="fa fa-refresh" aria-hidden="true"></i> Atualizar Processo</a>
						<a class="btn btn-primary btn-sm" role="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-clock-o" aria-hidden="true"></i> Registrar Recebimento</a>
						<a class="btn btn-success btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button" id="encaminhar"><i class="fa fa-sign-out" aria-hidden="true"></i> Encaminhar Protocolo</a>
						<a class="btn btn-warning btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button" style="background: #999; border-color: #999;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar Encaminhamento</a>
						<a class="btn btn-warning btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button"><i class="fa fa-tags" aria-hidden="true"></i> Concluir Protocolo</a>
						<a class="btn btn-danger btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancelar Protocolo</a>
						<a href="<?php echo base_url() . $this->uri->segment(1); ?>/imprimir/<?php echo $lista->id_protocolo; ?>" class="btn btn-info btn-sm" role="button" target="new"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
			
			<?php }else{ ?>
			
					<?php if(permissao($permissao1)){ //ENCAMINHAR PROCESSO OU CONCLUIR/CANCELAR PROCESSO ?>
						<a class="btn btn-default btn-sm" href="<?php echo base_url() . $this->uri->segment(1); ?>/atualiza/<?php echo $lista->id_protocolo; ?>" role="button"><i class="fa fa-refresh" aria-hidden="true"></i> Atualizar Processo</a>
						<a class="btn btn-primary btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button"><i class="fa fa-clock-o" aria-hidden="true"></i> Registrar Recebimento</a>
						<a class="btn btn-success btn-sm" role="button" id="encaminhar" href="<?php echo base_url() . $this->uri->segment(1); ?>/encaminha/<?php echo $lista->id_protocolo; ?>" ><i class="fa fa-sign-out" aria-hidden="true"></i> Encaminhar Protocolo</a>
						<a class="btn btn-warning btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button" style="background: #999; border-color: #999;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar Encaminhamento</a>
						<a class="btn btn-warning btn-sm" role="button" data-toggle="modal" data-target="#ConcluiProcesso"><i class="fa fa-tags" aria-hidden="true"></i> Concluir Protocolo</a>
						<a class="btn btn-danger btn-sm" role="button" data-toggle="modal" data-target="#CancelaProcesso"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancelar Protocolo</a>
						<a href="<?php echo base_url() . $this->uri->segment(1); ?>/imprimir/<?php echo $lista->id_protocolo; ?>" class="btn btn-info btn-sm" role="button" target="new"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
						
					<?php }else{ ?>	
					
						<a class="btn btn-default btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" href="<?php echo base_url() . $this->uri->segment(1); ?>/atualiza/<?php echo $lista->id_protocolo; ?>" role="button"><i class="fa fa-refresh" aria-hidden="true"></i> Atualizar Processo</a>
						<a class="btn btn-primary btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button"><i class="fa fa-clock-o" aria-hidden="true"></i> Registrar Recebimento</a>
						<a class="btn btn-success btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button" id="encaminhar"><i class="fa fa-sign-out" aria-hidden="true"></i> Encaminhar Protocolo</a>

						<?php if($contagem > '1'){ //VERIFICA SE É O PRIMEIRO TRAMITE DO PROCESSO, SE NÃO FOR, ELE ABRE 
												   //O BOTÃO CANCELAR ENCAMINHAMENTO, CASO CONTRÁRIO, FICA BLOQUEADO E 
												   //DEIXA ABERTO SOMENTE OS BOTÕES  CONCLUIR/CANCELAR PROCESSO
						
								if(permissao_cancelar($cancelar1, $tra->recebido)){ ?>
									<a class="btn btn-warning btn-sm" role="button" style="background: #999; border-color: #999;" data-toggle="modal" data-target="#cancelEncaminha"><i class="fa fa-times" aria-hidden="true"></i> Cancelar Encaminhamento</a>
								<?php }else{ ?>
									<a class="btn btn-warning btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button" style="background: #999; border-color: #999;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar Encaminhamento</a>
								<?php } ?>
						
						<?php }else{ ?>
								<a class="btn btn-warning btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button" style="background: #999; border-color: #999;"><i class="fa fa-times" aria-hidden="true"></i> Cancelar Encaminhamento</a>
							<?php } ?>
						
							<?php if(permissao_encerrado($tra->situacao, $tra->situacao)){ ?>
								<a class="btn btn-warning btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button"><i class="fa fa-tags" aria-hidden="true"></i> Concluir Protocolo</a>
							<?php }else{ ?>
								<a class="btn btn-warning btn-sm" role="button" data-toggle="modal" data-target="#ConcluiProcesso"><i class="fa fa-tags" aria-hidden="true"></i> Concluir Protocolo</a>
							<?php } ?>
							
							<?php if(permissao_encerrado($tra->situacao, $tra->situacao)){ ?>
								<a class="btn btn-danger btn-sm disabled" style="background: #999; border-color: #999; color: #DDD;" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancelar Protocolo</a>
							<?php }else{ ?>
								<a class="btn btn-danger btn-sm" role="button" data-toggle="modal" data-target="#CancelaProcesso"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancelar Protocolo</a>
							<?php } ?>

							<a href="<?php echo base_url() . $this->uri->segment(1); ?>/imprimir/<?php echo $lista->id_protocolo; ?>" class="btn btn-info btn-sm" role="button" target="new"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</a>
							
					<?php } ?>
					
			
			<?php  } // FINAL VERIFICA SITUACAO ?>
				
			</div>
		
		  <?php } // FINAL FOREACH LISTAGEM ?>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-body">
			
		<fieldset class="form-group">
  			
  			<legend><strong> <i class="fa fa-info-circle" aria-hidden="true"></i> Informações Gerais</strong></legend>	
		
			 <?php foreach($listagem as $lista){ ?>
			 
		<div class="table-responsive"  style="margin: -1% 0 1% 0;">
			
			<table class="table table-hover">
				<tr>
		            <td width="15%"><strong>Tipo do Processo</strong></td>
		            <td width="35%"><?php echo $this->listagem->listar_documento($lista->tipo_documento); ?></td>
					<td width="15%"><strong>Situação</strong></td>
		            <td width="35%">
		            
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
			        <tr>
		            <td><strong>Assunto</strong></td>
		            <td colspan="4"><?php echo $lista->assunto_processo; ?></td>
		        </tr>
		        <tr>
		            <td width="15%"><strong>Origem</strong></td>
		            <td width="35%"><?php echo $this->listagem->listar_setor($lista->unidade_origem); ?></td>
					<td width="15%"><strong>Destino</strong></td>
		            <td width="35%"><?php echo $this->listagem->listar_setor($lista->unidade_destino); ?></td>
		        </tr>
		        <tr>
					<td width="15%"><strong>Núm. Documento</strong></td>
		            <td width="35%"><?php echo $lista->numero_documento; ?></td>
		            <td width="15%"><strong>Cód. Rastreamento</strong></td>
		            <td width="35%"><?php echo $lista->codigo_rastreamento; ?></td>
		        </tr>
		        
		        <tr>
					<td width="15%"><strong>Volumes</strong></td>
		            <td width="35%"><?php echo $lista->volumes; ?></td>
		            <td width="15%"><strong>Páginas</strong></td>
		            <td width="35%"><?php echo $lista->paginas; ?></td>
		        </tr>
		       
		        <tr>
		            <td><strong>Observações</strong></td>
		            <td colspan="4"><?php echo $lista->observacoes; ?></td>
		        </tr>
		    </table>
		    
		    <?php } ?>
		    
		  </div>
		  
		 </fieldset>
			
  			<fieldset class="form-group">
  			
  			<legend><strong> <i class="fa fa-bars" aria-hidden="true"></i> Trâmites/Movimentações</strong></legend>
  			
			<div class="table-responsive">
			
				<table class="table table-condensed table-bordered">
				
					<tr class="active">
							<th width="3%"><small>#</small></th>
					    	<th width="10%"><small>Origem</small></th>
					    	<th width="6%"><small>Enviado em</small></th>
					    	<th width="7%"><small>Enviado por</small></th>
					    	<th width="22%"><small>Despacho de envio</small></th>
							<th width="10%"><small>Destino</small></th>
					    	<th width="6%"><small>Recebido em</small></th>
					    	<th width="7%"><small>Recebido por</small></th>
					    	<th width="20%"><small>Despacho de recebimento</small></th>
							<th width="9%"><small>Situação</small></th>
					</tr>
					
					<tr>
					<?php
					 $i = 1;
					 foreach($tramite as $tra){ ?>
					
						<td>	
							<?php 	
								echo "<small><strong>" . $i ."</strong></small>";
    							$i++;
							?>				
						</td>
						<td><small><?php echo $this->listagem->listar_setor($tra->origem); ?></small></td>
						<td><small><?php echo dataetempo($tra->origem_data); ?></small></td>
						<td><small><div title="<?php echo $this->listagem->listar_usuario($tra->origem_enviado); ?>" data-toggle="tooltip" data-placement="top"><?php echo $this->listagem->listar_apelido($tra->origem_enviado); ?></div></small></td>
						<td><small><?php echo $tra->origem_despacho; ?></small></td>
						<td><small><?php echo $this->listagem->listar_setor($tra->destino); ?></small></td>
						<td><small>
						
							<?php if($tra->destino_data == "0000-00-00 00:00:00") { 
								
								echo " ";
							
							}else{
								
								echo dataetempo($tra->destino_data);
							}
							?>
						
						</small></td>
						<td><small><div title="<?php echo $this->listagem->listar_usuario($tra->destino_recebido); ?>" data-toggle="tooltip" data-placement="top"><?php echo $this->listagem->listar_apelido($tra->destino_recebido); ?></div></small></td>
						<td><small><?php echo $tra->destino_despacho; ?></small></td>
						<td class="text-center"><small>
						
							<?php if($tra->situacao == "1") { 
								
								echo '<span class="label label-default">Pendente</span>';
							
							}elseif($tra->situacao == "2"){
								
								echo '<span class="label label-info">Recebido</span>';
								
							}elseif($tra->situacao == "3"){
								
								echo '<span class="label label-primary">Aguardando recebimento</span>';
								
							}elseif($tra->situacao == "5"){
								
								echo '<span class="label label-danger">Cancelado</span>';
								
							}elseif($tra->situacao == "6"){
								
								echo '<span class="label label-warning">Concluído</span>';
							}
							?>
						
						</small></td>
					</tr>
				<?php  } ?>
				</table>
			
			</div>
			
  			</fieldset>	
			</div>
		</div>
	
	
	</div>
	
<!-- MODAL DESPACHO RECEBIMENTO -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-clock-o" aria-hidden="true"></i> Registrar Recebimento</h4>
      </div>
      <div class="modal-body">
      		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/receber/<?php echo $lista->id_protocolo; ?>" method="post" enctype="multipart/form-data">
      			
      		
      					<input type="hidden" name="movimento" value="<?php echo $movimento1; ?>" />
      		
      					<div class="form-group">
    						<label for="inputObs" class="titulo_modal">Despacho</label>
							<textarea name="despacho" class="form-control" rows="4"></textarea>
  						</div>
  						
  						<div class="text-right">
				         	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	      					<input type="submit" value="Confirmar" class="btn btn-info">
			         	</div>
      		</form>
      
      
      </div>
    </div>
  </div>
</div>
<!-- MODAL DESPACHO RECEBIMENTO -->

<!-- MODAL CANCELAMENTO -->
<div class="modal fade" id="cancelEncaminha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-times" aria-hidden="true"></i> Cancelar Encaminhamento</h4>
      </div>
      <div class="modal-body">
      		
      		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/cancelFoward/<?php echo $lista->id_protocolo; ?>" method="post" enctype="multipart/form-data">
      			
      		
      					<input type="hidden" name="movimento" value="<?php echo $movimento1; ?>" />
      		
  						<div class="text-right">
				         	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	      					<input type="submit" value="Confirmar" class="btn btn-info">
			         	</div>
      		</form>
      
      
      </div>
    </div>
  </div>
</div>
<!-- MODAL DESPACHO RECEBIMENTO -->


<!-- MODAL CONCLUIR PROCESSO -->
<div class="modal fade" id="ConcluiProcesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tags" aria-hidden="true"></i> Concluir Protocolo</h4>
      </div>
      <div class="modal-body">
      		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/concluiProcesso/<?php echo $lista->id_protocolo; ?>" method="post" enctype="multipart/form-data">
      			
				      	<input type="hidden" name="id_origem" class="form-control inputIDOrigem" value="<?php echo $this->session->userdata('setor_lotacao')?>" readonly="readonly">
      		
      					<div class="form-group">
    						<label for="inputObs" class="titulo_modal">Despacho</label>
							<textarea name="despacho_origem" class="form-control" rows="4"></textarea>
  						</div>
  						
  						<div class="text-right">
				         	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	      					<input type="submit" value="Confirmar" class="btn btn-info">
			         	</div>
      		</form>
      
      
      </div>
    </div>
  </div>
</div>
<!-- MODAL CONCLUIR PROCESSO -->

<!-- MODAL CANCELAR PROCESSO -->
<div class="modal fade" id="CancelaProcesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancelar Protocolo</h4>
      </div>
      <div class="modal-body">
      		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/cancelaProcesso/<?php echo $lista->id_protocolo; ?>" method="post" enctype="multipart/form-data">
      			
				      	<input type="hidden" name="id_origem" class="form-control inputIDOrigem" value="<?php echo $this->session->userdata('setor_lotacao')?>" readonly="readonly">
      		
      					<div class="form-group">
    						<label for="inputObs" class="titulo_modal">Despacho</label>
							<textarea name="despacho_origem" class="form-control" rows="4"></textarea>
  						</div>
  						
  						<div class="text-right">
				         	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	      					<input type="submit" value="Confirmar" class="btn btn-info">
			         	</div>
      		</form>
      
      
      </div>
    </div>
  </div>
</div>
<!-- MODAL CANCELAR PROCESSO -->


</div>
