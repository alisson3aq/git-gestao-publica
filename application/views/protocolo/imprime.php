<!DOCTYPE html>
<html lang="en">
  	<head>
  	
	    <meta charset="utf-8">
	    <title><?php echo TITULO_SISTEMA; ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="robots" content="noindex, nofollow" />
	
		<!-- Folha de Estilo Principal -->
		<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
	
	    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="<?php echo base_url('assets/js') ?>/codigo.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			window.onload = function(){

				window.print();
				
			}
		</script>
		
	</head>
	
<body>
  	
<div class="container">

	<div class="row" style="min-height: 130px; overflow: visible">
		
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		
			<img alt="" src="<?php echo base_url(); ?>assets/images/brasao.jpg" width="90%" class="img-responsive">
		
		</div>
	
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="margin-top: -1.9%;">
			<address>
			
			<?php foreach($orgao as $ong){?>
			
				  <h3 style="margin-bottom: 0.5%;"><storng><?php echo $ong->nome; ?></storng></h3>
				  <?php echo $ong->endereco; ?><br>
				  <?php echo $ong->cidade; ?>/<?php echo $ong->uf; ?>, CEP <?php echo $ong->cep; ?><br>
				  <abbr>Tel(s):</abbr> <?php echo $ong->contato1; ?> : <?php echo $ong->contato2; ?> - <?php echo $ong->url; ?><br>
				  <?php echo $ong->email; ?>
				  
			<?php } ?>
			</address>
		</div>
	
	
	</div>


	<div class="row">
	
		<div class="panel panel-default">
		
		<?php foreach($tramite as $tra){ 
			
			$contagem = count($tramite);
			
		}
		
		?>
		
		<?php foreach($movimento as $mov){ 
		
			$movimento1 = $mov->id;
			
		}
		
		?>
		
		<?php foreach($acesso as $acc){
			
			$permissao1 = $acc->destino;
			
		} ?>
		
		<?php foreach($cancelar as $can){
			
			$cancelar1 = $can->origem;
			
		} ?>
		
		
		<?php foreach($situacao as $sit){
			
			$situacao1 = $sit->situacao;
			
		} ?>
		
		  <?php foreach($listagem as $lista){ ?>
	
		  
		  <div class="table-responsive">
		  	<table class="table">
				<tr>
					<td width="90%">
					
						<h2 style="margin: 0;">
						<strong><span id="id_protocolo">Protocolo: <?php echo separaCodigo($lista->numero_processo); ?></span> - 
						<small><?php echo datasemtempo_final($lista->data_cadastro); ?> - <?php echo datacomtempo($lista->data_cadastro); ?></small>
						</strong></h2>
					
					</td>
					
					<td width="10%">
					<?php 
					
					
				        	if ($lista->situacao_processo == '1') {
				        		
				        		echo '<span class="label label-default"> P R O T O C O L A D O </span>';
												        			
				        	} elseif ($lista->situacao_processo == '2') {
				        			
				        		echo '<span class="label label-success"> T R A M I T A N D O </span>';
				        	
				        	} elseif ($lista->situacao_processo == '3') {
				        			
				        		echo '<span class="label label-warning"> E M  &nbsp &nbsp A N Á L I S E </span>';
				        	
				        	} elseif ($lista->situacao_processo == '4') {
				        			
				        		echo '<span class="label label-danger">&nbsp A R Q U I V A D O &nbsp</span>';
				        	
				        	} 
        	
        			?>
        			</td>
				</tr>
			
			</table>
			</div>
		
		  <?php } // FINAL FOREACH LISTAGEM ?>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-body">
			
		<fieldset class="form-group">
  			
  			<legend><strong> <i class="fa fa-info-circle" aria-hidden="true"></i> Informações Gerais</strong></legend>	
		
			 <?php foreach($listagem as $lista){ ?>
			 
		<div class="table-responsive"  style="margin: -1% 0 1% 0;">
			
			<table class="table table-hover">
				<tr>
		            <td width="15%"><strong>Tipo do Processo</strong></td>
		            <td width="35%"><?php echo $this->listagem->listar_documento($lista->tipo_documento); ?></td>
					<td width="15%"><strong>Situação</strong></td>
		            <td width="35%">
		            
		            <?php 
					
					
				        	if ($lista->situacao_processo == '1') {
				        		
				        		echo '<span class="label label-default"> P R O T O C O L A D O </span>';
												        			
				        	} elseif ($lista->situacao_processo == '2') {
				        			
				        		echo '<span class="label label-success"> T R A M I T A N D O </span>';
				        	
				        	} elseif ($lista->situacao_processo == '3') {
				        			
				        		echo '<span class="label label-warning"> E M  &nbsp &nbsp A N Á L I S E </span>';
				        	
				        	} elseif ($lista->situacao_processo == '4') {
				        			
				        		echo '<span class="label label-danger">&nbsp A R Q U I V A D O &nbsp</span>';
				        	
				        	} 
        	
        			?>
		            
		            </td>
		        </tr>
			        <tr>
		            <td><strong>Assunto</strong></td>
		            <td colspan="4"><?php echo $lista->assunto_processo; ?></td>
		        </tr>
		        <tr>
		            <td width="15%"><strong>Origem</strong></td>
		            <td width="35%"><?php echo $this->listagem->listar_setor($lista->unidade_origem); ?></td>
					<td width="15%"><strong>Destino</strong></td>
		            <td width="35%"><?php echo $this->listagem->listar_setor($lista->unidade_destino); ?></td>
		        </tr>
		        <tr>
					<td width="15%"><strong>Núm. Documento</strong></td>
		            <td width="35%"><?php echo $lista->numero_documento; ?></td>
		            <td width="15%"><strong>Cód. Rastreamento</strong></td>
		            <td width="35%"><?php echo $lista->codigo_rastreamento; ?></td>
		        </tr>
		        
		        <tr>
					<td width="15%"><strong>Volumes</strong></td>
		            <td width="35%"><?php echo $lista->volumes; ?></td>
		            <td width="15%"><strong>Páginas</strong></td>
		            <td width="35%"><?php echo $lista->paginas; ?></td>
		        </tr>
		       
		        <tr>
		            <td><strong>Observações</strong></td>
		            <td colspan="4"><?php echo $lista->observacoes; ?></td>
		        </tr>
		    </table>
		    
		    <?php } ?>
		    
		  </div>
		  
		 </fieldset>
			
  			<fieldset class="form-group">
  			
  			<legend><strong> <i class="fa fa-bars" aria-hidden="true"></i> Trâmites/Movimentações</strong></legend>
  			
			<div class="table-responsive">
			
				<table class="table table-condensed table-bordered">
				
					<thead>
				
					<tr class="active">
							<th width="3%"><small>#</small></th>
					    	<th width="10%"><small>Origem</small></th>
					    	<th width="6%"><small>Enviado em</small></th>
					    	<th width="7%"><small>Enviado por</small></th>
					    	<th width="22%"><small>Despacho de envio</small></th>
							<th width="10%"><small>Destino</small></th>
					    	<th width="6%"><small>Recebido em</small></th>
					    	<th width="7%"><small>Recebido por</small></th>
					    	<th width="20%"><small>Despacho de recebimento</small></th>
							<th width="9%"><small>Situação</small></th>
					</tr>
					
					</thead>
					
					<tbody>
					
					<tr>
					<?php
					 $i = 1;
					 foreach($tramite as $tra){ ?>
					
						<td>	
							<?php 	
								echo "<small><strong>" . $i ."</strong></small>";
    							$i++;
							?>				
						</td>
						<td><small><?php echo $this->listagem->listar_setor($tra->origem); ?></small></td>
						<td><small><?php echo dataetempo($tra->origem_data); ?></small></td>
						<td><small><div title="<?php echo $this->listagem->listar_usuario($tra->origem_enviado); ?>" data-toggle="tooltip" data-placement="top"><?php echo $this->listagem->listar_apelido($tra->origem_enviado); ?></div></small></td>
						<td><small><?php echo $tra->origem_despacho; ?></small></td>
						<td><small><?php echo $this->listagem->listar_setor($tra->destino); ?></small></td>
						<td><small>
						
							<?php if($tra->destino_data == "0000-00-00 00:00:00") { 
								
								echo " ";
							
							}else{
								
								echo dataetempo($tra->destino_data);
							}
							?>
						
						</small></td>
						<td><small><div title="<?php echo $this->listagem->listar_usuario($tra->destino_recebido); ?>" data-toggle="tooltip" data-placement="top"><?php echo $this->listagem->listar_apelido($tra->destino_recebido); ?></div></small></td>
						<td><small><?php echo $tra->destino_despacho; ?></small></td>
						<td class="text-center"><small>
						
							<?php if($tra->situacao == "1") { 
								
								echo '<span class="label label-default">Pendente</span>';
							
							}elseif($tra->situacao == "2"){
								
								echo '<span class="label label-info">Recebido</span>';
								
							}elseif($tra->situacao == "3"){
								
								echo '<span class="label label-primary">Aguardando recebimento</span>';
								
							}elseif($tra->situacao == "5"){
								
								echo '<span class="label label-danger">Cancelado</span>';
								
							}elseif($tra->situacao == "6"){
								
								echo '<span class="label label-warning">Concluído</span>';
							}
							?>
						
						</small></td>
						
						</tbody>
						
					</tr>
				<?php  } ?>
				
				</table>
			
			</div>
			
  			</fieldset>	
			</div>
		</div>
	
	</div>
	
	<table style="width: 100%">
		<tr>
	    	<td width="50%" class="text-left">
	        	<samp><strong><?php echo TITULO_SISTEMA; ?></strong></samp>
    		</td>
    		<td width="50%" class="text-right">
	        	<samp>Fim do relatório - Gerado em: <?php echo date('d/m/Y \à\s H:i');?></samp>
	        </td>
    	</tr>
	</table>
	
</body>
</html>
