<!DOCTYPE html>
<html lang="en">
  	<head>
  	
	    <meta charset="utf-8">
	    <title><?php echo TITULO_SISTEMA; ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="refresh" content="4; <?php echo base_url('painel'); ?>">
	
		<!-- Folha de Estilo Principal -->
		<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
	
	    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<style type="text/css">
			
			body {
		        padding-top: 1%;
		        padding-bottom: 1%;
		        background-color: #f5f5f5;
	      	}
		
		</style>
		
		
	</head>
	
	
	
  <body>


<div class="container-fluid">

	<div class="row" style="margin-top: 5%">
  		<div class="col-md-4 col-md-offset-4">
				<div class="form-group">
				    <div class="input-group">
				      <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
				      <input type="text" class="form-control" id="exampleInputAmount" placeholder="<?php echo $this->session->userdata('nome'); ?>" readonly>
				    </div>
				</div>
   	
			<div class="progress">
				<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
				    Carregando...
				</div>
			</div>
				
		</div>
	</div>
	
</div>