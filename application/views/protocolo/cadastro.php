

	<div class="row">
	
		<div class="panel panel-default">
			<div class="panel-body">
				
				<form action="<?php echo base_url() . $this->uri->segment(1); ?>/cadastrar/" method="post" enctype="multipart/form-data" class="form-horizontal">

						<?php echo validation_errors(); ?>
				
						<div class="form-group form-group-lg">
							<label for="inlineRadio" class="col-sm-2 control-label">Tipo Procedimento</label>
								<div class="col-sm-8">
									<label class="checkbox-inline">
										<input type="radio" name="procedimento" id="inputTipoRecebido" value="1"> Recebido
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="procedimento" id="inputTipoExpedido" value="2"> Expedido
									</label>
								</div>
						</div>
				
						<div class="form-group form-group-lg">
    						<label for="inputNome" class="col-sm-2 control-label">Número Protocolo</label>
							    <div class="col-sm-5">
							      <input type="text" name="numero" class="form-control" id="inputNome" value="<?php echo geraCodigo(); ?>" placeholder="Número Processo" readonly>
							      <span id="helpBlock" class="help-block">Número de Protocolo gerado automaticamente.</span>
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputDoc" class="col-sm-2 control-label">Tipo de Processo</label>
    							 <div class="col-sm-4">
									<select name="tipo" class="form-control">
											<option selected="selected">Selecione uma opção</option>
												<?php foreach($documentos as $doc) {?>									
												 	<option value="<?php echo $doc->id_documento; ?>"><?php echo $doc->nome; ?></option>
												<?php } ?>
									</select>
								</div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputAssunto" class="col-sm-2 control-label">Descrição</label>
							    <div class="col-sm-9">
							      <input type="text" name="assunto_processo" class="form-control" id="inputAssunto" 
							      		placeholder="Descrição do Processo" value="<?php echo set_value('assunto_processo'); ?>">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputNatureza" class="col-sm-2 control-label">Situação</label>
							    <div class="col-sm-3">
							    	<select name="situacao_processo" class="form-control">
											<option value="1" selected="selected">Protocolado</option>
									</select>
							    
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputDataCadastro" class="col-sm-2 control-label">Data do Cadastro</label>
							    <div class="col-sm-3">
							      <input type="text" name="data_cadastro" class="form-control" readonly="readonly"
							      id="inputDataCadastro" value="<?php echo date("d/m/Y H:s:i"); ?>" placeholder="DD-MM-AA HH:MM:SS" value="<?php echo set_value('data_cadastro'); ?>>
							      <span id="helpBlock" class="help-block">Data gerada pelo servidor.</span>
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
  						
  						<div class="form-group form-group-lg" id="CodigoRastreamento">
    						<label for="inputCodigoRastreamento" id="inputCodigoRastreamento" class="col-sm-2 control-label">Código Rastreamento</label>
							    <div class="col-sm-3">
							      <input type="text" name="codigo_rastreamento" class="form-control" id="inputCodigoRastreamento" value="<?php echo set_value('codigo_rastreamento'); ?>" >
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputNumDoc" class="col-sm-2 control-label">Núm. Documento</label>
							    <div class="col-sm-4">
							      <input type="text" name="numero_documento" class="form-control" id="inputNumDoc" placeholder="Número do documento" value="<?php echo set_value('numero_documento'); ?>" >
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="datepicker" class="col-sm-2 control-label">Data Emissão</label>
							    <div class="col-sm-3">
							      <input type="text" name="data_documento" class="form-control" id="datepicker" placeholder="<?php echo date("d/m/Y"); ?>" value="<?php echo set_value('data_documento'); ?>" >
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputVolumes" class="col-sm-2 control-label">Volumes</label>
							    <div class="col-sm-2">
							      <input type="text" name="volumes" class="form-control" id="inputVolumes" placeholder="Volumes" value="<?php echo set_value('volumes'); ?>" >
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputPaginas" class="col-sm-2 control-label">Páginas</label>
							    <div class="col-sm-2">
							      <input type="text" name="paginas" class="form-control" id="inputPaginas" placeholder="Páginas" value="<?php echo set_value('paginas'); ?>" >
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="inputObs" class="col-sm-2 control-label">Observações/<br>Descrição Geral</label>
							    <div class="col-sm-8">
							      <textarea name="observacoes" class="form-control" rows="5"></textarea>
							    </div>
  						</div>
  						
  						
  						<div class="well well-sm">
							<input type="submit" value="Cadastrar" class="btn btn-primary">
							<a href="<?php echo base_url() . $this->uri->segment(1); ?>" class="btn btn-default"> Cancelar </a>
						</div>
  						
				</form>
  				
			</div>
		</div>
	
	
	</div>


</div>