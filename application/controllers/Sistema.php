<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller {
	
	
	function __construct()
	{
		
		parent::__construct();
		
		date_default_timezone_set('America/Sao_Paulo');
		
		if(!$this->session->userdata('log_in'))
		{
				
			redirect(base_url(), 'refresh');
				
		}

		if($this->session->userdata('tipo_usuario') != "1"){

			redirect('painel');

		}
		
	}
	
	
	public function index(){
		
		date_default_timezone_set('America/Sao_Paulo');

		$this->load->model('usuarios_model', 'usuarios');
			
		$data['listagem'] = $this->usuarios->listar_ultimas(5);

		$data['tipo_pagina'] = "";
		
		$this->load->view('include/header');
		$this->load->view('include/menu_sistema', $data);
		$this->load->view('sistema/index');
		$this->load->view('include/footer');
		
	}

	public function usuarios(){

		$this->load->model('usuarios_model', 'usuarios');
			
		$data['listagem'] = $this->usuarios->listar_ultimas(20);

		$data['tipo_pagina'] = "| Usuários do sistema";

		$this->load->view('include/header');
		$this->load->view('include/menu_sistema', $data);
		$this->load->view('sistema/usuarios', $data);
		$this->load->view('include/footer');

	}

	public function usuariosCadastro(){

		$this->load->model('setores_model', 'setores');
			
		$data['listagem'] = $this->setores->listagem();

		$data['tipo_pagina'] = "| Usuários do sistema | Cadastro";

		$this->load->view('include/header');
		$this->load->view('include/menu_sistema', $data);
		$this->load->view('sistema/usuarios_cadastro', $data);
		$this->load->view('include/footer');


	}

	public function usuariosCadastrar(){


		 	$this->form_validation->set_rules('documento', 'Documento', 'callback_check_documento');

		 	$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');

            if ($this->form_validation->run() == FALSE)
            {
                    $this->load->model('setores_model', 'setores');
			
					$data['listagem'] = $this->setores->listagem();

					$data['tipo_pagina'] = "| Usuários do sistema | Cadastro";

					$this->load->view('include/header');
					$this->load->view('include/menu_sistema', $data);
					$this->load->view('sistema/usuarios_cadastro', $data);
					$this->load->view('include/footer');

            }
            else
            {

				$modulos = implode(',', $this->input->post('modulos'));

				$data = array(
						'documento'		 	=> $this->input->post('documento'),
						'senha' 			=> md5($this->input->post('senha')),
						'nome' 				=> $this->input->post('nome'),
						'apelido'			=> $this->input->post('tratamento'),
						'endereco'			=> $this->input->post('endereco'),
						'bairro'			=> $this->input->post('bairro'),
						'cidade'			=> $this->input->post('cidade'),
						'uf'				=> $this->input->post('uf'),
						'cep'				=> $this->input->post('cep'),
						'contato'			=> $this->input->post('telefone'),
						'email'				=> $this->input->post('email'),
						'tipo_usuario'		=> $this->input->post('tipo'),
						'setor_lotacao'		=> $this->input->post('lotacao'),
						'app_access'		=> $modulos,
						'status'			=> $this->input->post('status')
				);
					
				$this->load->model('usuarios_model', 'usuarios');
					
				$query = $this->usuarios->cadastrar($data);
					
				if($query === FALSE){
						
					$msg['erro'] = "Não foi possível inserir os dados.";
					
					$data['tipo_pagina'] = '| Usuários do sistema | Erro na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_sistema', $data);
					$this->load->view('include/erro', $msg);  
					$this->load->view('include/footer');
						
				}else{
						
					$data['tipo_pagina'] = '| Usuários do sistema | Sucesso na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_sistema', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
						
				}

			} //fim do else - form validator
	

	}

	function check_documento($documento)
	{
		//$username is passed automatically to this function which is the value entered by the User.
		$this->load->model('usuarios_model', 'usuarios');
		
		//This function checks the availability of the username in Database.
		$return_value = $this->usuarios->verificaUsuario($documento);

		if ($return_value)
		{
			//set Error message.
			$this->form_validation->set_message('check_documento', 'O campo <strong>DOCUMENTO</strong> informado, já está cadastrado!');
			return FALSE;
		}
		else
		{
			//after satisfying our conditions return TRUE to the origin with no errors.
			return TRUE;
		}
	}

	public function usuariosControle(){

		$this->load->model('usuarios_model', 'usuarios');
			
		$maximo = 2;
			
		if ($this->uri->segment(3) == "")
		{
			$inicio = 0;
		}
		else
		{
			$inicio = $this->uri->segment(3);
		}
			
		/*PAGINACAO*/
		$this->load->library('pagination');
			
		$config['base_url'] = site_url() . 'sistema/usuariosControle/';
		$config['per_page'] = $maximo;
		$config['total_rows'] = $this->usuarios->contaRegistros();
		$config['uri_segment'] = 3;
		$config['num_links'] = 10;
			
		$config['prev_link'] = false; // Como nao quero que exiba o prev_link, inicio ele como false.
		$config['next_link'] = false; // Como nao quero que exiba o next_link, inicio ele como false.
		$config['last_link'] = '<span class="btn"> Último ';
		$config['first_link'] = '<span class="btn"> Primeiro';
			
		$config['cur_tag_open'] = '<span class="btn btn-primary"> ';
		$config['cur_tag_close'] = ' </span>';
			
		$config['num_tag_open'] = '<span class="btn"> ';
		$config['num_tag_close'] = ' </span>';
			
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open'] = '<span class="btn">';
		$config['prev_tag_close'] = '</span>';
			
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open'] = '<span class="btn">';
		$config['next_tag_close'] = '</span>';
			
		$config['full_tag_open'] = '<div class="paginacao pagination-centered">'; // Tag que vai ficar em volta da Pagina��o toda.
		$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
			
		$this->pagination->initialize($config);
		$data['paginacao'] = $this->pagination->create_links();
			
		$data['listagem'] = $this->usuarios->retornaLista($maximo, $inicio);
			
		$data['tipo_pagina'] = '| Usuários do sistema | Listagem';
			
		$this->load->view('include/header');
		$this->load->view('include/menu_sistema', $data);
		$this->load->view('sistema/controle');
		$this->load->view('include/footer');
			
	}

	public function usuariosEditar($id){

		$this->load->model('usuarios_model', 'usuarios');
		$this->load->model('setores_model', 'setores');
			
		$data['listagem'] = $this->setores->listagem();

		$data['usuario'] = $this->usuarios->listar_unidade($id);

		$data['tipo_pagina'] = '| Usuários do sistema | Editando';

		$this->load->view('include/header');
		$this->load->view('include/menu_sistema', $data);
		$this->load->view('sistema/usuarios_editar', $data);
		$this->load->view('include/footer');

	}

	public function usuariosExcluir($id){

		$this->load->model('usuarios_model', 'usuarios');
	
		$verificaProtocolo = $this->usuarios->verificaProtocoloProcesso($id);
		$verificaTramite = $this->usuarios->verificaProtocoloTramite($id);
	
		echo $this->session->userdata('documento') . '<br>';
		echo $id;


		if($this->session->userdata('documento') != $id){

				if((!$verificaProtocolo) AND (!$verificaTramite)){
						
					$query = $this->usuarios->excluir($id);

					if($query){
							
						$data['tipo_pagina'] = '| Usuários do sistema | Sucesso na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu_sistema', $data);
						$this->load->view('include/sucesso');
						$this->load->view('include/footer');
							
							
					}else{
							
						$msg['erro'] = "Não foi possível inserir os dados.";
						
						$data['tipo_pagina'] = '| Usuários do sistema | Erro na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu_sistema', $data);
						$this->load->view('include/erro', $msg);
						$this->load->view('include/footer');
							
					}
						
				}else{
			
					$msg['erro'] = "Não foi possível excluir. Existem processos cadastrados com esse usuário.";
					$data['tipo_pagina'] = '| Usuários do sistema | Erro na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_sistema', $data);
					$this->load->view('include/erro', $msg);
					$this->load->view('include/footer');
			
			
				}

		}else{
			
			$msg['erro'] = "Não é possível excluir o próprio usuário.";
			$data['tipo_pagina'] = '| Usuários do sistema | Erro na operação';
				
			$this->load->view('include/header');
			$this->load->view('include/menu_sistema', $data);
			$this->load->view('include/erro', $msg);
			$this->load->view('include/footer');
			
		}
			
				

	}

	public function setores(){
		
		$this->load->model('setores_model', 'setores');
			
		$data['setores'] = $this->setores->listar_ultimas(10);
		
		$data['tipo_pagina'] = '| Departamentos/Setores';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_sistema', $data);
		$this->load->view('setores/index');
		$this->load->view('include/footer');
		
		
	}
	
	
	
	
	
	
}