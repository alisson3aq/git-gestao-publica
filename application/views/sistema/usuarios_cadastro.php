

	<div class="row">
	
		<div class="panel panel-default">
			<div class="panel-body">
				
				<form action="<?php echo base_url() . $this->uri->segment(1); ?>/usuariosCadastrar/" method="post" enctype="multipart/form-data" class="form-horizontal">

						<?php echo validation_errors(); ?>

						<div class="form-group form-group-lg">
    						<label for="documento" class="col-sm-2 control-label">Documento</label>
							    <div class="col-sm-3">
							      <input type="text" name="documento" class="form-control" id="documento" value="<?php echo set_value('documento'); ?>" required="required" placeholder="somente números" pattern="[0-9]+$" />
							    </div>
  						</div>
				
  						<div class="form-group form-group-lg">
    						<label for="nome" class="col-sm-2 control-label">Nome</label>
							    <div class="col-sm-9">
							      <input type="text" name="nome" class="form-control" id="nome" value="<?php echo set_value('nome'); ?>" required="required" placeholder="Nome Completo">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="senha" class="col-sm-2 control-label">Senha</label>
							    <div class="col-sm-2">
							      <input type="password" name="senha" class="form-control" id="senha" value="<?php echo set_value('senha'); ?>" required="required" placeholder="Senha">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="tratamento" class="col-sm-2 control-label">Nome Tratamento</label>
							    <div class="col-sm-4">
							      <input type="text" name="tratamento" class="form-control" id="tratamento" value="<?php echo set_value('tratamento'); ?>" required="required" placeholder="Como quer ser chamado">
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
    						<label for="cidade" class="col-sm-2 control-label">Cidade</label>
							    <div class="col-sm-5">
							      <input type="text" name="cidade" class="form-control" id="cidade" value="<?php echo set_value('cidade'); ?>" placeholder="Cidade">
							    </div>
  						</div>

  						<div class="form-group form-group-lg">
    						<label for="uf" class="col-sm-2 control-label">Estado</label>
							    <div class="col-sm-1">
							      <input type="text" name="uf" class="form-control" id="uf" value="<?php echo set_value('uf'); ?>" placeholder="UF">
							    </div>
  						</div>

  						<div class="form-group form-group-lg">
    						<label for="cep" class="col-sm-2 control-label">CEP</label>
							    <div class="col-sm-2">
							      <input type="text" name="cep" class="form-control" id="cep" value="<?php echo set_value('cep'); ?>" placeholder="59900000" pattern="[0-9]+$">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="telefone" class="col-sm-2 control-label">Telefone</label>
							    <div class="col-sm-4">
							      <input type="text" name="telefone" required="required" class="form-control" id="telefone" value="<?php echo set_value('telefone'); ?>" placeholder="Telefone">
							    </div>
  						</div>
  						
  						<div class="form-group form-group-lg">
    						<label for="email" class="col-sm-2 control-label">E-mail</label>
							    <div class="col-sm-8">
							      <input type="email" name="email" required="required" class="form-control" id="email" value="<?php echo set_value('email'); ?>" placeholder="E-mail">
							    </div>
  						</div>

  						<div class="form-group form-group-lg">
							<label for="inputSetor" class="col-sm-2 control-label">Tipo Usuário</label>
								<div class="col-sm-10">
									<label class="checkbox-inline">
										<input type="radio" name="tipo" id="inlineRadio1" value="1" <?php echo set_radio('tipo', '1'); ?>> Administrador
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="tipo" id="inlineRadio2" value="2" checked="checked" <?php echo set_radio('tipo', '2'); ?>> Usuário
									</label>
								</div>
						</div>

						<div class="form-group form-group-lg">
    						<label for="lotacao" class="col-sm-2 control-label">Setor Lotação</label>
    							 <div class="col-sm-4">
									<select name="lotacao" id="lotacao" class="form-control">
											<?php foreach($listagem as $cat) {      	
											echo '<option value ="' . $cat->id . '">' . $cat->descricao . '</option>';
								      	} ?>
									</select>
								</div>
						</div>

						<div class="form-group form-group-lg">
    						<label for="inputOrigem" class="col-sm-2 control-label">Acesso Módulos</label>
    							<div class="col-sm-9">
									  	<select multiple="multiple" class="form-control" required="required" name="modulos[]" >
									  	
									  	<?php 
								
										$access = explode(',', $this->session->userdata('app_access'));

										?>
									  	<?php
						    				if (in_array(1, $access)) {

							    					echo '<option value ="1">Protocolo</option>'; 

						    				}
						    				if (in_array(2, $access)) {

						    						echo '<option value ="2">Patrimônio</option>';  

						    				}
						    				if (in_array(3, $access)) {

						    						echo '<option value ="3">Almoxarifado</option>'; 

						    				}
								      	?>

										</select>
								</div>
						</div>
  						
						<div class="form-group form-group-lg">
							<label for="status" class="col-sm-2 control-label">Status</label>
								<div class="col-sm-10">
									<label class="checkbox-inline">
										<input type="radio" name="status" id="inlineRadio1" value="1"> Ativo
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="status" checked="checked" id="inlineRadio2" value="0"> Inativo
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