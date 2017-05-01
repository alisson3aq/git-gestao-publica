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
		<script src="<?php echo base_url('assets/js') ?>/bytescoutbarcode128.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			window.onload = function(){

				window.print();
				updateBarcode();
				
			}
		</script>
		
	</head>
	
<body>
  	
<div class="container" style="width: 90%;">
<?php foreach($listagem as $lista){ ?>

	<div class="row" style="margin-top: 4%; min-height: 100px; overflow: visible">
		
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		
			<img alt="" src="<?php echo base_url(); ?>assets/images/brasao.jpg" width="95%" class="img-responsive" style="margin-top: -4%;">
		
		</div>
	
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="margin-top: -1.4%;">
			<address>
			<?php foreach($orgao as $ong){?>
				  <h5><strong><?php echo $ong->nome; ?></strong></h5>
				  <h3><strong>CAPA DO PROCESSO </strong></h3>
			<?php } ?>
			</address>
			
		</div>
		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center" style="margin-top: -1.4%;">
		
				<input id="barcodeValue" type="hidden" name="value" value="<?php echo $lista->numero_processo; ?>" />
				<img id="barcodeImage"/>
		</div>
	
<?php } ?>
	
	</div>
	
	<div class="table-responsive">
		  	<table class="table">
				<tr>
					<td width="90%">
					
						<h2 style="margin: 0;">
						<strong><span id="id_protocolo">Protocolo: <?php echo separaCodigo($lista->numero_processo); ?></span> - 
						<small><?php echo datasemtempo_final($lista->data_cadastro); ?></small>
						</strong></h2>
					
					</td>
					
				</tr>
			
			</table>
			</div>

	<div class="row">
	
		<div class="panel panel-default">
		
		  <?php foreach($listagem as $lista){ ?>
		  
		  <?php } // FINAL FOREACH LISTAGEM ?>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-body">
			
		<fieldset class="form-group">
  			
		
			 <?php foreach($listagem as $lista){ ?>
			 
		<div class="table-responsive"  style="margin: -1.5% 0 0 0;">
			
			<table class="table table-hover">
		        <tr>
		            <td><strong>Assunto</strong></td>
		            <td colspan="4"><?php echo $lista->assunto_processo; ?></td>
		        </tr>
				<tr>
		            <td width="15%"><strong>Tipo do Processo</strong></td>
		            <td width="35%" colspan="3"><?php echo $this->listagem->listar_documento($lista->tipo_documento); ?></td>
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
		            <td><strong>Informações</strong></td>
		            <td colspan="4"><?php echo $lista->observacoes; ?></td>
		        </tr>
		    </table>
		    
		    <?php } ?>
		    
		  </div>
		  
		 </fieldset>
			
		  <div class="table-responsive">
		    <table style="width: 100%">
		       
		        <tr>
		        
		        	<td class="text-center">______ / ______ / ______ </td>
		        	<td class="text-center"></td>
		        	<td class="text-center">______________________________________</td>
		        
		        </tr>
		        
		        <tr>
		        
		        	<td class="text-center">Data</td>
		        	<td class="text-center"></td>
		        	<td class="text-center">Setor de Protocolo - Responsável</td>
		        
		        </tr>
		        
		     </table>
		     
		 </div>
		 
</div>

 <script type="text/javascript">
        	function updateBarcode() 
			{
				var barcode = new bytescoutbarcode128();
        		var value = document.getElementById("barcodeValue").value;

        		barcode.valueSet(value);
        		barcode.setMargins(5, 5, 5, 5);
        		barcode.setBarWidth(2);

        		var width = barcode.getMinWidth();

        		barcode.setSize(width, 100);

        		var barcodeImage = document.getElementById('barcodeImage');
        		barcodeImage.src = barcode.exportToBase64(width, 100, 0);
        	}
        </script>

</body>
</html>
