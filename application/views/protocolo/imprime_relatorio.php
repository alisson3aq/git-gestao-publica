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

		<h4 style="text-align:center"><strong><?php echo $tipo_pagina; ?></strong></h4>
	
		<div class="panel panel-default">
		
		  	<?php 

					if(!$listagem){
					echo '<div class="panel panel-default" style="padding: 1%;"><center>Nenhum protocolo cadastrado.</center></div>';
					}else{
						
				?>

			<div class="table-responsive">
				<table class="table table-striped table-bordered">
   					<thead>
				    	<tr>
				          <th width="20%">Número</th>
				          <th width="27%">Origem</th>
				          <th width="27%">Destino</th>
				          <th width="26%">Criado por</th>
				        </tr>
					</thead>
					<tbody>
				        <?php foreach($listagem as $lista){?>
				        <tr>
				          <td><?php echo separaCodigo($lista->numero_processo) . "<br>";
				          
							if ($lista->situacao_processo == '1') {
				        		
				        		echo '<small> Protocolado </small>';
												        			
				        	} elseif ($lista->situacao_processo == '2') {
				        			
				        		echo '<small> Tramitando </small>';
				        	
				        	} elseif ($lista->situacao_processo == '3') {
				        			
				        		echo '<small> Em Análise </small>';
				        	
				        	} elseif ($lista->situacao_processo == '4') {
				        			
				        		echo '<small> Arquivado </small>';
				        	
				        	}
				          
				          ?>
				          </td>
				          <td><?php echo $this->listagem->listar_setor($lista->unidade_origem); ?></td>
				          <td><?php echo $this->listagem->listar_setor($lista->unidade_destino); ?></td>
				          <td>
				          <small><?php echo $this->listagem->listar_usuario($lista->criadopor); ?><br>
				          <?php echo datasemtempo_final($lista->data_cadastro); ?> às 
				          <?php echo datacomtempo($lista->data_cadastro); ?></small>
				          </td>
				        </tr>
				        <?php } ?>
				    </tbody>
  				</table>
  			</div>
  				<?php } ?>
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
