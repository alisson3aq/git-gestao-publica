	
	<div class="row">
	
		<div class="panel panel-default">
		
		</div>
		
		<div class="panel panel-default">
			<div class="panel-body">
			
				<div class="panel panel-default" style="padding: 0 0 0 1%;">
						<h4><strong>Protocolos </strong> <small class="hidden-xs hidden-sm"> - Listagem de Protocolos simplificada</small></h4>
				</div>
			
			
				<?php 

					if(!$listagem){
					echo '<div class="panel panel-default text-center" style="padding: 2%;">Nenhum protocolo encontrado.</div>';
					}else{
						
				?>
				
				<?php //echo var_dump($listagem); ?>
				
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
   					<thead>
				    	<tr>
				          <th width="15%">Número</th>
				          <th width="23%">Origem</th>
				          <th width="23%">Destino</th>
				          <th width="23%">Criado por</th>
				          <th width="16%" class="text-center">Ações</th>
				        </tr>
					</thead>
					<tbody>
				        <?php foreach($listagem as $lista){?>
				        <tr>
				          <td><?php echo separaCodigo($lista->numero_processo) . "\n";
				          
							if ($lista->situacao_processo == '1') {
				        		
				        		echo '<span class="label label-default"> Protocolado </span>';
												        			
				        	} elseif ($lista->situacao_processo == '2') {
				        			
				        		echo '<span class="label label-success"> Tramitando </span>';
				        	
				        	} elseif ($lista->situacao_processo == '3') {
				        			
				        		echo '<span class="label label-warning"> Em Análise </span>';
				        	
				        	} elseif ($lista->situacao_processo == '4') {
				        			
				        		echo '<span class="label label-danger">&nbsp Arquivado &nbsp</span>';
				        	
				        	}
				          
				          ?>
				          </td>
				          <td><?php echo $this->listagem->listar_setor($lista->unidade_origem); ?></td>
				          <td><?php echo $this->listagem->listar_setor($lista->unidade_destino); ?></td>
				          <td>
				          <?php echo $this->listagem->listar_usuario($lista->criadopor); ?><br>
				          <small><?php echo datasemtempo_final($lista->data_cadastro); ?> às 
				          <?php echo datacomtempo($lista->data_cadastro); ?></small>
				          </td>
				          <td>
				          		<div class="visible-xs visible-sm visible-md">
					          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/visualizar/<?php echo $lista->id_protocolo; ?>" class="col-xs-6 col-md-6 col-lg-6 btn btn-primary btn-xs" title="Visualizar Protocolo" data-toggle="tooltip" data-placement="top"><i class="fa fa-search" aria-hidden="true"></i> </a>
					          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/capa/<?php echo $lista->id_protocolo; ?>" class="col-xs-5 col-md-5 col-lg-5 btn btn-default btn-xs" title="Impressão Capa do Processo" data-toggle="tooltip" data-placement="top" style="margin-left: 1%;" target="new"><i class="fa fa-file-text-o" aria-hidden="true"></i> </a>
					          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/comprovante/<?php echo $lista->id_protocolo; ?>" class="col-xs-11 col-md-11 col-lg-11 btn btn-default btn-xs" title="Impressão Protocolo de Saída" data-toggle="tooltip" data-placement="bottom" style="margin-top: 1.5%;"  target="new"><i class="fa fa-print" aria-hidden="true"></i> </a>
				          		</div>
				          		<div class="visible-lg">
					          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/visualizar/<?php echo $lista->id_protocolo; ?>" class="col-xs-6 col-md-6 col-lg-6 btn btn-primary btn-xs" title="Visualizar Protocolo" data-toggle="tooltip" data-placement="top"><i class="fa fa-search" aria-hidden="true"></i> Visualizar</a>
					          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/capa/<?php echo $lista->id_protocolo; ?>" class="col-xs-5 col-md-5 col-lg-5 btn btn-default btn-xs" title="Impressão Capa do Processo" data-toggle="tooltip" data-placement="top" style="margin-left: 1%;"  target="new"><i class="fa fa-file-text-o" aria-hidden="true"></i> Capa</a>
					          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/comprovante/<?php echo $lista->id_protocolo; ?>" class="col-xs-11 col-md-11 col-lg-11 btn btn-default btn-xs" title="Impressão Protocolo de Saída" data-toggle="tooltip" data-placement="bottom" style="margin-top: 1.5%;"  target="new"><i class="fa fa-print" aria-hidden="true"></i> Comprovantes</a>
				          		</div>
				          </td>
				        </tr>
				        <?php } ?>
				    </tbody>
  				</table>
  			</div>
  				<?php } ?>
  				
			</div>
		</div>
		
		<div class="well well-small text-center"><?php echo $paginacao; ?></div>
	
	
	</div>

</div>