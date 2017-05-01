

<div class="container">


	<div class="row">
	
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">
		        <i class="fa fa-cogs"></i> &nbspConfigurações <?php echo $tipo_pagina?>
		      </a>
		    </div>
		  </div>
		</nav>
	
	</div>
	
	
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="menu" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="menu">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url(); ?>sistema"><i class="fa fa-home" aria-hidden="true"></i>  &nbspInício</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>sistema/configuracao"><i class="fa fa-cog" aria-hidden="true"></i>  &nbspConfigurações</a></li>
            <li><a href="<?php echo base_url(); ?>sistema/usuarios"><i class="fa fa-users" aria-hidden="true"></i>  &nbspUsuários</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sistema/setores"><i class="fa fa-folder-open-o" aria-hidden="true"></i>  &nbspDepartamentos/Setores </a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>