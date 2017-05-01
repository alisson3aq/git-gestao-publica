<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setores extends CI_Controller {
	
	
	public function __construct(){
		
		parent::__construct();
		
		
			if(!$this->session->userdata('log_in'))
			{
			
				redirect(base_url(), 'refresh');
	    		
			}
			
	}
	
	
	public function index()
	{
	
		$this->load->model('setores_model', 'setores');
			
		$data['setores'] = $this->setores->listar_ultimas(10);
		
		$data['tipo_pagina'] = '| Departamentos/Setores';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('setores/index');
		$this->load->view('include/footer');
		

	}
	
	
			
	//------------------ FUNCOES DOS SETORES ----------------------------//
			
				
			public function setoresControle(){
					
				$this->load->model('protocolo_model', 'protocolo');
				$this->load->model('setores_model', 'setores');
					
				$maximo = 20;
					
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
					
				$config['base_url'] = site_url() . 'setores/setoresControle/';
				$config['per_page'] = $maximo;
				$config['total_rows'] = $this->setores->contaRegistros();
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
					
				$data['setores'] = $this->setores->retornaLista($maximo, $inicio);
					
				$data['tipo_pagina'] = '| Departamentos/Setores | Listagem';
					
				$this->load->view('include/header');
				$this->load->view('include/menu', $data);
				$this->load->view('setores/controle');
				$this->load->view('include/footer');
					
			}
			
			public function setoresCadastro(){
					
				$data['tipo_pagina'] = '| Departamentos/Setores | Cadastro';
					
				$this->load->view('include/header');
				$this->load->view('include/menu', $data);
				$this->load->view('setores/cadastro');
				$this->load->view('include/footer');
					
					
			}
				
			public function setoresCadastrar(){
					
				$this->form_validation->set_rules('setor', 'SETOR', 'required');
				$this->form_validation->set_rules('descricao', 'DESCRIÇÃO DO SETOR', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('sigla', 'SIGLA', 'required|trim|min_length[2]');
				$this->form_validation->set_rules('status', 'STATUS DO SETOR', 'required');
				$this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email');
					
				$this->form_validation->set_message('required', 'O Campo %s é obrigatório.');
				$this->form_validation->set_message('min_length', 'O Campo %s deve conter no mínimo %s caracteres.');
					
				$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
					
				if ($this->form_validation->run() == FALSE)
				{
						
					$data['tipo_pagina'] = '| Departamentos/Setores | Cadastro';
			
					$this->load->view('include/header');
					$this->load->view('include/menu', $data);
					$this->load->view('setores/cadastro');
					$this->load->view('include/footer');
						
				}
				else
				{
			
					$data = array(
							'tipo'		 		=> $this->input->post('setor'),
							'descricao' 		=> $this->input->post('descricao'),
							'sigla' 			=> $this->input->post('sigla'),
							'cpfcnpj'			=> $this->input->post('cpfcnpj'),
							'endereco'			=> $this->input->post('endereco'),
							'bairro'			=> $this->input->post('bairro'),
							'cep'				=> $this->input->post('cep'),
							'contato'			=> $this->input->post('telefone'),
							'email'				=> $this->input->post('email'),
							'status'			=> $this->input->post('status')
					);
						
					$this->load->model('setores_model', 'setores');
						
					$query = $this->setores->cadastrar($data);
						
					if($query === FALSE){
							
						$msg['erro'] = "Não foi possível inserir os dados.";
						
						$data['tipo_pagina'] = '| Departamentos/Setores | Erro na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu', $data);
						$this->load->view('include/erro', $msg);
						$this->load->view('include/footer');
							
					}else{
							
						$data['tipo_pagina'] = '| Departamentos/Setores | Sucesso na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu', $data);
						$this->load->view('include/sucesso');
						$this->load->view('include/footer');
							
					}
			
				}
					
			}
			
			public function setoresEditar($id){
					
				$this->load->model('setores_model', 'setores');
					
				$data['tipo_pagina'] = '| Departamentos/Setores | Editar';
				
				$data['listagem'] 	= $this->setores->listar_unidade($id);
					
				$this->load->view('include/header');
				$this->load->view('include/menu', $data);
				$this->load->view('setores/editar', $data);
				$this->load->view('include/footer');
					
					
			}
			
			public function setoresEditado($id){
					
					
				$data = array(
						'tipo'		 		=> $this->input->post('setor'),
						'descricao' 		=> $this->input->post('descricao'),
						'sigla' 			=> $this->input->post('sigla'),
						'cpfcnpj'			=> $this->input->post('cpfcnpj'),
						'endereco'			=> $this->input->post('endereco'),
						'bairro'			=> $this->input->post('bairro'),
						'cep'				=> $this->input->post('cep'),
						'contato'			=> $this->input->post('telefone'),
						'email'				=> $this->input->post('email'),
						'status'			=> $this->input->post('status')
				);
					
				$this->load->model('setores_model', 'setores');
					
				$query = $this->setores->alterar($data, $id);
					
				if($query === FALSE){
						
					$data['tipo_pagina'] = '| Departamentos/Setores | Sucesso na operação';
			
					$this->load->view('include/header');
					$this->load->view('include/menu', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
						
				}else{
						
					$data['tipo_pagina'] = '| Departamentos/Setores | Sucesso na operação';
			
					$this->load->view('include/header');
					$this->load->view('include/menu', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
						
				}
					
					
			}
			
			
			public function setoresExcluir($id)
			{
					
				$this->load->model('protocolo_model', 'protocolo');
				$this->load->model('setores_model', 'setores');
			
				$verifica = $this->protocolo->verifica_setor($id);
			
				if(!$verifica){
						
					$query = $this->setores->excluir($id);
			
					if($query){
							
						$data['tipo_pagina'] = '| Departamentos/Setores | Sucesso na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu', $data);
						$this->load->view('include/sucesso');
						$this->load->view('include/footer');
							
							
					}else{
							
						$msg['erro'] = "Não foi possível inserir os dados.";
						
						$data['tipo_pagina'] = '| Departamentos/Setores | Erro na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu', $data);
						$this->load->view('include/erro', $msg);
						$this->load->view('include/footer');
							
					}
						
				}else{
			
					$msg['erro'] = "Não foi possível excluir. Existem processos cadastrados nesse setor.";
					$data['tipo_pagina'] = '| Departamentos/Setores | Erro na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu', $data);
					$this->load->view('include/erro', $msg);
					$this->load->view('include/footer');
			
			
				}
					
					
			}
			
			
	//------------------ FUNCOES DOS SETORES EXTERNOS ----------------------------//
	
	
	
	
}