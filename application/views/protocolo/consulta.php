

	<div class="row">
	
		<div class="panel panel-default">
			<div class="panel-body">
			
<fieldset>

	<legend>Pesquisar</legend>
				
	<form action="<?php echo base_url() . $this->uri->segment(1); ?>/consultar/" method="post" enctype="multipart/form-data" class="form-inline">
	
		<div class="row">
			  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><label for="numero" class="control-label">Número:</label></div>
			  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><label for="datepicker" class="control-label">Data de Criação:</label></div>
			  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><label for="situacao" class="control-label">Situação:</label></div>
		</div>
		
		<div class="row">
			  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			  
			  	<input id="numero" name="numero" class="form-control" 
		            		placeholder="Ex.: 0000002.9.3001.2017" type="text" 
		            				value="<?php echo set_value('numero'); ?>" />
			  
			  
			  </div>
			  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			  
			  
			  		<div class="form-group">
					    <div class="input-group">
					      <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i> </div>
					      <input type="text" class="form-control" name="dataentrada" id="datepicker" placeholder="<?php echo date("d/m/Y"); ?>">
					    </div>
					  </div>
			  
			  
			  </div>
			  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			  
			  		<select class="form-control" id="situacao" name="situacao">
			  			<option value="">:: Selecione ::</option>
						<option value="1">PROTOCOLADO</option>
						<option value="2">TRAMITANDO</option>
						<option value="3">EM ANÁLISE</option>
						<option value="4">ARQUIVADO</option>
					</select>
			  
			  </div>
			  
		</div>
		
		<div class="row" style="margin-top: 2%;">
		
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><label for="descricao" class="control-label">Descrição do Processo:</label></div>
	
           
           	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           	
           		<input id="descricao" class="form-control" name="descricao" placeholder="Descrição do Processo" 
           				value="<?php echo set_value('descricao'); ?>" type="text" style="width: 83%;"/>
           	
           	</div>
			
		</div>
		
			<br> 
		
			<button type="submit" class="btn btn-primary">Consultar</button>
			<button type="reset" class="form-control btn-default">Limpar</button>
		
  						
	</form>
</fieldset>
  				
			</div>
		</div>
	
	
	</div>


</div>