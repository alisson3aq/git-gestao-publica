	
	<div class="row">
	
		<div class="panel panel-default">
		
			<div class="panel-heading">Ações</div>
				<div class="panel-body">
					
						<a href="<?php echo base_url() . $this->uri->segment(1); ?>/documentosCadastro" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Cadastro</a> 
						
						<?php if($listagem){ ?>
						
							<a href="<?php echo base_url() . $this->uri->segment(1); ?>/documentosControle" class="btn btn-default"> <i class="fa fa-cogs" aria-hidden="true"></i> Controle</a>

						<?php }else{ ?>
						
							<a href="<?php echo base_url() . $this->uri->segment(1); ?>/documentosControle" class="btn btn-default disabled"> <i class="fa fa-times-circle" aria-hidden="true"></i> Controle</a>
							
						<?php } ?>
				</div>
				
		</div>
		
		<div class="panel panel-default">
			<div class="panel-body">
			
				<?php 
				
					if(!$listagem){
					echo '<center>Nenhuma informação encontrada.</center>';
					}else{
						
				?>
			<div class="table-responsive">
				<table class="table table-striped">
   					<thead>
				    	<tr>
				          <th width="83%">Nome</th>
				          <th width="10%">Status</th>
				          <th width="7%"></th>
				        </tr>
					</thead>
					<tbody>
				        <?php foreach($listagem as $lista){?>
				        <tr>
				          <td><?php echo $lista->nome; ?></td>
				          
				          <td>
				          
				          	<?php 
        	
				        	if ($lista->status == '1') {
				        	
				        		echo '<span class="label label-success">Ativo</span>';
				        			
				        	} elseif ($lista->status == '0') {
				        			
				        		echo '<span class="label label-danger">Inativo</span>';
				        	
				        	}
        	
        					?>
				          
				          </td>
				          
				          <td>
				          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/documentosEditar/<?php echo $lista->id_documento; ?>" class="btn btn-primary btn-xs" title="Editar dados"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				          		<button type="button" data-toggle="modal" data-target="#btnExcluir<?php echo $lista->id_documento; ?>" class="btn btn-danger btn-xs" title="Excluir dados"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				          </td>
				        </tr>
				        <?php } ?>
				    </tbody>
  				</table>
  			</div>
  				<?php } ?>
  				
			</div>
		</div>
	
	
	</div>


</div>

<?php foreach($listagem as $lista){  ?>
<!-- Modal -->
<div class="modal fade" id="btnExcluir<?php echo $lista->id_documento; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Exclusão de dados</strong></h4>
      </div>
      <div class="modal-body">
        
      		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/documentosExcluir/<?php echo $lista->id_documento; ?>" method="post" enctype="multipart/form-data">

      					<h4>Deseja remover esse registro?</h4>
      			
  						<div class="text-right">
				         	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	      					<input type="submit" value="Confirmar" class="btn btn-primary">
			         	</div>
      		</form>


      </div>
    </div>
  </div>
</div>
<?php } ?>
