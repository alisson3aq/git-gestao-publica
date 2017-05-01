

<div class="container">


	<div class="row">
	
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">
		        <i class="fa fa-calendar-check-o"></i> &nbspProtocolo <?php echo $tipo_pagina?>
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
        <li><a href="<?php echo base_url(); ?>protocolo"><i class="fa fa-home fa-fw" aria-hidden="true"></i>  &nbspInício</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Protocolos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>protocolo/cadastro"><i class="fa fa-plus-square fa-fw" aria-hidden="true"></i>  &nbspNovo Protocolo</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>protocolo/listagem"><i class="fa fa-sort-amount-desc fa-fw" aria-hidden="true"></i>  &nbspListagem</a></li>
            <li><a href="<?php echo base_url(); ?>protocolo/consulta"><i class="fa fa-search-plus fa-fw" aria-hidden="true"></i>  &nbspConsultar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>protocolo/documentos"><i class="fa fa-file-excel-o fa-fw" aria-hidden="true"></i> &nbspTipo Documentos</a></li>
            <li><a href="<?php echo base_url(); ?>protocolo/processos"><i class="fa fa-file-powerpoint-o fa-fw" aria-hidden="true"></i>  &nbspTipo Processos</a></li>
            
            <?php if($this->session->userdata('tipo_usuario') == '1'){ ?>
            
                <li role="separator" class="divider"></li>

                <li><a href="<?php echo base_url(); ?>protocolo/setores"><i class="fa fa-folder-open-o fa-fw" aria-hidden="true"></i>  &nbspDepartamentos/Setores </a></li>

            <?php } ?>

          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatórios <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>protocolo/relatorio/1" target="_blank"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> &nbspListagem Geral</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>protocolo/relatorio/2" target="_blank"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> &nbspListagem - Protocolado</a></li>
            <li><a href="<?php echo base_url(); ?>protocolo/relatorio/3" target="_blank"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> &nbspListagem - Tramitando</a></li>
            <li><a href="<?php echo base_url(); ?>protocolo/relatorio/4" target="_blank"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> &nbspListagem - Em análise</a></li>
            <li><a href="<?php echo base_url(); ?>protocolo/relatorio/5" target="_blank"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> &nbspListagem - Arquivado</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>protocolo/relatorioc"><i class="fa fa-file-code-o sfa-fw" aria-hidden="true"></i> &nbspPersonalizado</a></li>

          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <form action="<?php echo base_url() . $this->uri->segment(1); ?>/pesquisar/" method="post" enctype="multipart/form-data" class="navbar-form navbar-left" role="search">
        <div class="form-group">
	         <input type="text" name="numero" class="form-control" placeholder="Pesquisar Protocolo">
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>