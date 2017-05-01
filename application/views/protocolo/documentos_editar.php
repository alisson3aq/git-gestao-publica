

	<div class="row">
	
		<div class="panel panel-default">
			<div class="panel-body">
			
			<?php foreach($listagem as $lista){ ?>
				
				<form action="<?php echo base_url() . $this->uri->segment(1); ?>/documentosEditado/<?php echo $lista->id_documento; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

						<?php echo validation_errors(); ?>
				
  						<div class="form-group form-group-lg">
    						<label for="inputCpf" class="col-sm-1 control-label">Nome</label>
							    <div class="col-sm-10">
							      <input type="text" name="nome_documento" class="form-control" id="nome_documento" value="<?php echo $lista->nome; ?>" placeholder="Nome Documento">
							    </div>
  						</div>
  						
						<div class="form-group form-group-lg">
							<label for="inputNome" class="col-sm-1 control-label">Status</label>
								<div class="col-sm-10">
								
								<?php if($lista->status == '1'){?>
								
									<label class="checkbox-inline">
										<input type="radio" name="status" id="inlineRadio1" value="1" checked> Ativo
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="status" id="inlineRadio2" value="0"> Inativo
									</label>
									
								<?php }else{ ?>
								
									<label class="checkbox-inline">
										<input type="radio" name="status" id="inlineRadio1" value="1" > Ativo
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="status" id="inlineRadio2" value="0" checked> Inativo
									</label>
									
								<?php } ?>
								</div>
						</div>
  						
  						<div class="well well-sm">
							<input type="submit" value="Cadastrar" class="btn btn-primary">
							<a href="<?php echo base_url() . $this->uri->segment(1); ?>/documentos" class="btn btn-default"> Cancelar </a>
						</div>
  						
				</form>
				
				<?php } ?>
  				
			</div>
		</div>
	
	
	</div>


</div>