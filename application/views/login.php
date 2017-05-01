<!DOCTYPE html>
<html lang="en">
  	<head>
  	
	    <meta charset="utf-8">
	    <title><?php echo TITULO_SISTEMA; ?> - Autenticação</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<!-- Folha de Estilo Principal -->
		<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
	
	    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<style type="text/css">
			
			body {
		        padding-top: 40px;
		        padding-bottom: 40px;
		        background-color: #f5f5f5;
	      	}
		
		</style>
		
		
	</head>
	
	
	
  <body>

    <div class="container">
    
      <form class="form-signin" method="POST" action="<?php echo base_url()?>login/verifica">
        <h2 class="titulo"><img src="<?php echo base_url(); ?>assets/images/cadeado.jpg"> <strong>Autenticação</strong></h2>
        <input type="text" name="login" class="form-control input" placeholder="Login">
        <input type="password" name="senha" class="form-control input" placeholder="Senha">
        <button class="btn btn-primary btn-lg btn-block" type="submit"><i class="fa fa-lock" aria-hidden="true"></i> Entrar</button>
      </form>

    </div> <!-- /container -->
    
    <pre class="alinhamento" ><strong><?php echo TITULO_SISTEMA; ?></strong><br>Todos dos Direitos Reservados.</pre>
		
		<?php if (!empty($error)){ ?>
			<div class="alert alert-danger" role="alert">
				<?php echo validation_errors(); ?>
				<?php echo $error; ?>
			</div>
		<?php } ?>
			
  </body>
</html>