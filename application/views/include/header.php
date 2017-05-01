<!DOCTYPE html>
<html lang="en">
  	<head>
  	
	    <meta charset="utf-8">
	    <title><?php echo TITULO_SISTEMA; ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="robots" content="noindex, nofollow" />
	
		<!-- Folha de Estilo Principal -->
		<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="<?php echo base_url('assets/js') ?>/codigo.js" type="text/javascript"></script>
		<style type="text/css">
			
			body {
		        padding-top: 1%;
		        padding-bottom: 1%;
		        background-color: #f5f5f5;
	      	}
	      	
		</style>
		
	</head>
	
  <body>
  
  <div class="container">

		<div class="row" style="margin-bottom: 1%;">
  			
	  			<div class="col-xs-9 col-sm-8 col-md-8">
	  			
	  				<img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo.png" />
	  			
	  			</div>

	  			<div class="col-xs-3 col-sm-3 col-md-3 visible-xs visible-sm" style="margin-top: 2%;">
			  	
			  		<a class="btn btn-danger btn-xs col-sm-8" href="<?php echo base_url() ?>/login/saida">
				  			<i class="fa fa-sign-out fa-lg"></i> Logoff</a>
			  		
			  	</div>
	  			
			  	<div class="ccol-xs-4 col-sm-3 col-md-4 hidden-xs hidden-sm">
			  		
			  		<div class="pull-right">
			  			<a class="btn btn-default button_menu" href="<?php echo base_url('painel'); ?>">
				  			<center><span class="fa-stack fa-lg"><i class="fa fa-home fa-2x"></i></span><h6>Principal</h6></center></a>
			  		
				  		<?php if($this->session->userdata('tipo_usuario') == '1'){ ?>

				  			<a class="btn btn-default button_menu" href="<?php echo base_url('sistema'); ?>">
				  				<center><span class="fa-stack fa-lg"><i class="fa fa-cogs fa-2x"></i></span><h6>Configurações</h6></center></a>

				  		<?php } ?>
				  			
				  		<a class="btn btn-danger button_menu" href="<?php echo base_url() ?>/login/saida">
				  			<center><span class="fa-stack fa-lg"><i class="fa fa-sign-out fa-2x"></i></span><h6>Logoff</h6></center></a>
			  		</div>
			  		
			  		
		  		</div>
			  	
	  	</div>
	  	
	  	<div class="row">
	  	
	  		<div class="form-group">
				    <div class="input-group">
				      <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
				      <input type="text" class="form-control" placeholder="<?php echo $this->session->userdata('nome'); ?> - <?php echo $this->listagem->listar_setor($this->session->userdata('setor_lotacao')); ?> " readonly><span class="input-group-addon hidden-xs hidden-sm">Último login: <?php echo dataetempo($this->session->userdata('logado')); ?></span>
				    </div>
			</div>
	  		
	  	</div>
		  	
</div>