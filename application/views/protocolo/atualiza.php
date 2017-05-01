

	<div class="row">
	
		<div class="panel panel-default">
			<div class="panel-body">
			
			<?php foreach($listagem as $lista){ ?>
				
				<form action="<?php echo base_url() . $this->uri->segment(1); ?>/atualizar/<?php echo $lista->id_protocolo; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

						<?php echo validation_errors(); ?>
				
						<div class="form-group form-group-lg">
    						<label for="inputNome" class="col-sm-2 control-label">Número Protocolo</label>
							    <div class="col-sm-5">
							     <input type="text" name="numero" class="form-control" id="inputNome" value="<?php echo separaCodigo($lista->numero_processo); ?>" placeholder="Número Processo" readonly>
							      <span id="helpBlock" class="help-block">Número de Protocolo gerado automaticamente.</span>
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputDoc" class="col-sm-2 control-label">Documento</label>
    							 <div class="col-sm-4">
									<select name="tipo" class="form-control">
											<option selected="selected">Selecione uma opção</option>
												<?php foreach($documentos as $doc) {?>									
												 	<option value="<?php echo $doc->id_documento; ?>" <?php echo ($lista->tipo_documento == $doc->id_documento) ? 'selected="selected"' : ''; ?>><?php echo $doc->nome; ?></option>
												<?php } ?>
									</select>
								</div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputAssunto" class="col-sm-2 control-label">Descrição</label>
							    <div class="col-sm-9">
							      <input type="text" name="assunto_processo" class="form-control" id="inputAssunto" 
							      		placeholder="Descrição do Processo" value="<?php echo $lista->assunto_processo; ?>">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputNatureza" class="col-sm-2 control-label">Situação</label>
							    <div class="col-sm-3">
							    	<?php 
        	
								        	if ($lista->situacao_processo == '1') {
								        		
								        		echo '<h4> PROTOCOLADO </h4>';
																        			
								        	} elseif ($lista->situacao_processo == '2') {
								        			
								        		echo '<h4> TRAMITANDO </h4>';
								        	
								        	} elseif ($lista->situacao_processo == '3') {
								        			
								        		echo '<h4> EM &nbsp ANÁLISE </h4>';
								        	
								        	} elseif ($lista->situacao_processo == '4') {
								        			
								        		echo '<h4>&nbsp A R Q U I V A D O &nbsp</h4>';
								        	
								        	} 
				        	
				        			?>
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputDataCadastro" class="col-sm-2 control-label">Data do Cadastro</label>
							    <div class="col-sm-3">
							      <input type="text" name="data_cadastro" class="form-control" readonly="readonly"
							      id="inputDataCadastro" value="<?php echo dataetempo($lista->data_cadastro); ?>" placeholder="DD-MM-AA HH:MM:SS">
							      <span id="helpBlock" class="help-block">Data gerada pelo servidor.</span>
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputOrigem" class="col-sm-2 control-label">Rementente</label>
    							<div class="col-sm-1">
							      <input type="text" name="id_origem" id="inputIDOrigem" value="<?php echo $lista->unidade_origem; ?>" class="form-control" readonly="readonly">
							     </div>
							    <div class="col-sm-7">
							      <input type="text" name="origem" class="form-control" id="inputOrigem" value="<?php echo $this->listagem->listar_setor($lista->unidade_origem); ?>" placeholder="Unidade de Origem" readonly="readonly">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputDestino" class="col-sm-2 control-label">Destinatário</label>
								 <div class="col-sm-1">
							      <input type="text" name="id_destino" id="inputIDDestino" class="form-control" readonly="readonly" value="<?php echo $lista->unidade_destino; ?>">
							     </div>
    						    <div class="col-sm-7">
							      <input type="text" name="destino" class="form-control" id="inputDestino" placeholder="Unidade de Destino" value="<?php echo $this->listagem->listar_setor($lista->unidade_destino); ?>" readonly="readonly">
							    </div>
  						</div>
  						
  						
  						<?php if($lista->origem_processo == '1'){ 
  						
  							echo "";
  							
  						}else{ ?>
  						
  						<div class="form-group form-group-lg" id="CodigoRastreamento2">
    						<label for="inputCodigoRastreamento" id="inputCodigoRastreamento" class="col-sm-2 control-label">Código Rastreamento</label>
							    <div class="col-sm-3">
							      <input type="text" name="codigo_rastreamento" class="form-control" id="inputCodigoRastreamento" value="<?php echo $lista->codigo_rastreamento; ?>">
							    </div>
  						</div>
  						
  						<?php } ?>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputNumDoc" class="col-sm-2 control-label">Núm. Documento</label>
							    <div class="col-sm-4">
							      <input type="text" name="numero_documento" class="form-control" id="inputNumDoc" placeholder="Número do documento" value="<?php echo $lista->numero_documento; ?>">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="datepicker" class="col-sm-2 control-label">Data Emissão</label>
							    <div class="col-sm-3">
							      <input type="text" name="data_documento" class="form-control" id="datepicker" placeholder="<?php echo date("d/m/Y"); ?>" value="<?php echo converterBR($lista->data_documento_emissao); ?>">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputVolumes" class="col-sm-2 control-label">Volumes</label>
							    <div class="col-sm-2">
							      <input type="text" name="volumes" class="form-control" id="inputVolumes" placeholder="Volumes" value="<?php echo $lista->volumes; ?>">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputPaginas" class="col-sm-2 control-label">Páginas</label>
							    <div class="col-sm-2">
							      <input type="text" name="paginas" class="form-control" id="inputPaginas" placeholder="Páginas" value="<?php echo $lista->paginas; ?>">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputObs" class="col-sm-2 control-label">Observações/<br>Descrição Geral</label>
							    <div class="col-sm-8">
							      <textarea name="observacoes" class="form-control" rows="5"><?php echo $lista->observacoes; ?></textarea>
							    </div>
  						</div>
  						
  						
  						<div class="well well-sm">
							<input type="submit" value="Atualizar" class="btn btn-primary">
							<a href='javascript:history.back(-1)' class="btn btn-default"> Cancelar </a>
						</div>
  						
				</form>
  		<?php } ?>
			</div>
		</div>
	
	
	</div>


</div>