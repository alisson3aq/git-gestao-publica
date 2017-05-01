

	<div class="row">
	
		<div class="panel panel-default">
			<div class="panel-body">
				
				<form action="<?php echo base_url() . $this->uri->segment(1); ?>/setoresCadastrar/" method="post" enctype="multipart/form-data" class="form-horizontal">

						<?php echo validation_errors(); ?>
						
						<div class="form-group form-group-lg">
							<label for="inputSetor" class="col-sm-2 control-label">Setor</label>
								<div class="col-sm-10">
									<label class="checkbox-inline">
										<input type="radio" name="setor" checked="checked" id="inlineRadio1" value="1" <? echo set_radio('setor', '1')?> Interno
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="setor" id="inlineRadio2" value="2" <? echo set_radio('setor', '2')?> Externo
									</label>
								</div>
						</div>
				
  						<div class="form-group form-group-lg">
    						<label for="descricao" class="col-sm-2 control-label">Nome</label>
							    <div class="col-sm-9">
							      <input type="text" required="required" name="descricao" class="form-control" id="descricao" value="<?php echo set_value('descricao'); ?>" placeholder="Descrição do setor">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="sigla" class="col-sm-2 control-label">SIGLA</label>
							    <div class="col-sm-2">
							      <input type="text" required="required" name="sigla" class="form-control" id="sigla" value="<?php echo set_value('sigla'); ?>" placeholder="SIGLA">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="cpfcnpj" class="col-sm-2 control-label">CPF/CNPJ</label>
							    <div class="col-sm-3">
							      <input type="text" name="cpfcnpj" class="form-control" id="cpfcnpj" value="<?php echo set_value('cpfcnpj'); ?>" placeholder="CPF/CNPJ">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="endereco" class="col-sm-2 control-label">Endereço</label>
							    <div class="col-sm-9">
							      <input type="text" name="endereco" class="form-control" id="endereco" value="<?php echo set_value('endereco'); ?>" placeholder="Digite o endereço completo">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="bairro" class="col-sm-2 control-label">Bairro</label>
							    <div class="col-sm-5">
							      <input type="text" name="bairro" class="form-control" id="bairro" value="<?php echo set_value('bairro'); ?>" placeholder="Bairro">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="cep" class="col-sm-2 control-label">CEP</label>
							    <div class="col-sm-2">
							      <input type="text" name="cep" class="form-control" id="cep" value="<?php echo set_value('cep'); ?>" placeholder="CEP">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="telefone" class="col-sm-2 control-label">Telefone</label>
							    <div class="col-sm-4">
							      <input type="text" name="telefone" class="form-control" id="telefone" value="<?php echo set_value('telefone'); ?>" placeholder="Telefone">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="email" class="col-sm-2 control-label">E-mail</label>
							    <div class="col-sm-8">
							      <input type="email" required="required" name="email" class="form-control" id="email" value="<?php echo set_value('email'); ?>" placeholder="E-mail">
							    </div>
  						</div>
  						
						<div class="form-group form-group-lg">
							<label for="inputNome" class="col-sm-2 control-label">Status</label>
								<div class="col-sm-10">
									<label class="checkbox-inline">
										<input type="radio" name="status" checked="checked" id="inlineRadio1" value="1"> Ativo
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="status" id="inlineRadio2" value="0"> Inativo
									</label>
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