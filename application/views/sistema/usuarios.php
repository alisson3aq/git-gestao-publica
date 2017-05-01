	
	<div class="row">
	
	<div class="panel panel-default">
		
			<div class="panel-heading">Ações</div>
				<div class="panel-body">
					
						<a href="<?php echo base_url() . $this->uri->segment(1); ?>/usuariosCadastro" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Cadastro</a> 
						
						<?php if($listagem){ ?>
						
							<a href="<?php echo base_url() . $this->uri->segment(1); ?>/usuariosControle" class="btn btn-default"> <i class="fa fa-cogs" aria-hidden="true"></i> Controle</a>

						<?php }else{ ?>
						
							<a href="<?php echo base_url() . $this->uri->segment(1); ?>/usuariosControle" class="btn btn-default disabled"> <i class="fa fa-times-circle" aria-hidden="true"></i> Controle</a>
							
						<?php } ?>
				</div>
				
		</div>
	
		<div class="panel panel-default">
			<div class="panel-body">
			
				<div class="panel panel-default" style="padding: 0 0 0 1%;">
						<h4><strong>Usuários recentes</strong> <small class="hidden-xs hidden-sm"> - Últimos usuários cadastrados</small></h4>
				</div>
			
			
				<?php 

					if(!$listagem){
					echo '<div class="panel panel-default" style="padding: 1%;"><center>Nenhum usuário cadastrado.</center></div>';
					}else{
						
				?>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
   					<thead>
				    	<tr>
				    		<th width="3%"><strong>#</strong></th>
					        <th width="15%">Nome</th>
					        <th width="20%">E-mail</th>
					        <th width="22%">Lotação</th>
					        <th width="10%">Tipo</th>
					        <th width="10%">Módulos</th>
					        <th width="10%">Status</th>
					        <th width="10%" class="text-center">Ações</th>
				        </tr>
					</thead>
					<tbody>
				        <?php 

				        $i = 1;
				        foreach($listagem as $lista){?>
				        <tr>
				        	<td><?php echo $i; ?></td>
				          	<td>
					           <?php echo $lista->apelido; ?>
					        </td>
				          	<td>
					           <?php echo $lista->email; ?>
				          	</td>
				          	<td>
				          		<?php echo $this->listagem->listar_setor($lista->setor_lotacao); ?>
				          	</td>
				          	<td>
				          		<?php 
				          		if($lista->tipo_usuario == "1"){

				          			echo '<span class="label label-primary">Administrador</span>';

				          		}else{

				          			echo '<span class="label label-default">Usuário</span>';
				          		} 
				          		?>
				          	</td>
				          	<td>
				          		
				          	<?php 
								
							$access = explode(',', $lista->app_access);

							?>
		    			
		    			
		    			
		    				<?php
		    				if (in_array(1, $access)) {

			    					echo '<span class="label label-danger"><i class="fa fa-calendar-check-o fa-fw"></i></span>&nbsp'; 

		    				}
		    				if (in_array(2, $access)) {

		    						echo '<span class="label label-success"><i class="fa fa-university fa-fw"></i></span>&nbsp'; 

		    				}
		    				if (in_array(3, $access)) {

		    						echo '<span class="label label-info"><i class="fa fa-dropbox fa-fw"></i></span>&nbsp';

		    				}
		    				?>	



				          	</td>
				          	<td class="text-center">
				          		<?php 
				          		if($lista->status == "1"){

				          			echo '<span class="label label-info">Ativo</span>';

				          		}else{

				          			echo '<span class="label label-default">Inativo</span>';
				          		} 
				          		?>
				          	</td>
				          	<td class="text-center">
				          		<a href="<?php echo base_url() . $this->uri->segment(1); ?>/usuariosEditar/<?php echo $lista->documento; ?>" class="btn btn-primary btn-xs" title="Editar dados"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
				          		<button type="button" data-toggle="modal" data-target="#btnExcluir<?php echo $lista->documento; ?>" class="btn btn-danger btn-xs" title="Excluir dados"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				          </td>
				        </tr>
				        <?php $i++; } ?>
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
<div class="modal fade" id="btnExcluir<?php echo $lista->documento; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Exclusão de dados</strong></h4>
      </div>
      <div class="modal-body">
        
      		<form action="<?php echo base_url() . $this->uri->segment(1); ?>/usuariosExcluir/<?php echo $lista->documento; ?>" method="post" enctype="multipart/form-data">

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