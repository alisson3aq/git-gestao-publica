

	<div class="row">
	
		<div class="panel panel-default">
		
			<div class="panel-heading">Ações</div>
				<div class="panel-body">
					
						<a href="<?php echo base_url() . $this->uri->segment(1); ?>" class="btn btn-default"> <i class="fa fa-reply-all" aria-hidden="true"></i> Voltar</a>

				</div>
				
		</div>
		
		<div class="panel panel-default">
			<div class="panel-body">
				
					 <div class="well" style="text-align: center;">
				    	<h3><i class="fa fa-exclamation-triangle fa-lg"></i> Ops! Ocorreu um erro...</h3>
						<h4><?php echo $erro; ?></h4>
						
						<h5><a href='javascript:history.back(-1)' class="btn btn-primary">Voltar à tela anterior</a></h5>
					</div>
	
			</div>
		</div>


</div>