<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Protocolo extends CI_Controller {
	
	
	public function __construct(){
		
		parent::__construct();
		
		$access = explode(',', $this->session->userdata('app_access'));
		
			if(!$this->session->userdata('log_in'))
			{
			
				redirect(base_url(), 'refresh');
	    		
			}
			
    		if (!in_array(1, $access)) {
    			
    			redirect('painel');
    			
    		}

	}
	

	//------------------- FUNCOES DO PROTOCOLO ----------------------------------//
	
	public function index()
	{
		
		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('movimentacao_model', 'movimentacao');
		
		//$data['listagem'] = $this->protocolo->resumo_protocolo(10);
		$data['listagem'] = $this->protocolo->listagem_id_protocolo($this->session->userdata('setor_lotacao'));
	
		$data['tipo_pagina'] = '';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/index');
		$this->load->view('include/footer');

	}
	
	public function visualizar($id)
	{
	
		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('movimentacao_model', 'movimentacao');
	
		$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
		$data['tramite']	= $this->protocolo->protocolo_tramite($id);
		$data['acesso']		= $this->protocolo->tramite_permissao_geral($id);
		$data['cancelar']	= $this->protocolo->tramite_permissao_cancelar($id);
		$data['situacao']	= $this->protocolo->tramite_permissao_situacao($id);
		$data['movimento'] 	= $this->movimentacao->listar_ultimas(1, $id);
	
		$data['tipo_pagina'] = '';
	
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/visualiza', $data);
		$this->load->view('include/footer');
	
	}
	
	public function imprimir($id)
	{
	
		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('movimentacao_model', 'movimentacao');
		$this->load->model('orgao_model', 'orgao');
	
		$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
		$data['tramite']	= $this->protocolo->protocolo_tramite($id);
		$data['acesso']		= $this->protocolo->tramite_permissao_geral($id);
		$data['cancelar']	= $this->protocolo->tramite_permissao_cancelar($id);
		$data['situacao']	= $this->protocolo->tramite_permissao_situacao($id);
		$data['movimento'] 	= $this->movimentacao->listar_ultimas(1, $id);
		$data['orgao'] 		= $this->orgao->listar_unidade();
	
		$data['tipo_pagina'] = '';
	
		$this->load->view('protocolo/imprime', $data);
	
	}
	
	public function capa($id){
		
		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('movimentacao_model', 'movimentacao');
		$this->load->model('orgao_model', 'orgao');
		
		$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
		$data['orgao'] 		= $this->orgao->listar_unidade();
		
		$this->load->view('protocolo/capa', $data);
		
	}
	
	public function comprovante($id)
	{
	
		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('movimentacao_model', 'movimentacao');
		$this->load->model('orgao_model', 'orgao');
	
		$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
		$data['tramite']	= $this->protocolo->protocolo_tramite($id);
		$data['acesso']		= $this->protocolo->tramite_permissao_geral($id);
		$data['cancelar']	= $this->protocolo->tramite_permissao_cancelar($id);
		$data['situacao']	= $this->protocolo->tramite_permissao_situacao($id);
		$data['movimento'] 	= $this->movimentacao->listar_ultimas(1, $id);
		$data['orgao'] 		= $this->orgao->listar_unidade();
	
		$data['tipo_pagina'] = '';
	
		$this->load->view('protocolo/comprovante', $data);
	
	}
		
	public function cadastro(){
	
		$this->load->model('documentos_model', 'documentos');
	
		$data['documentos'] = $this->documentos->documentos_listagem();
	
		$data['tipo_pagina'] = '| Novo Protocolo';
	
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/cadastro');
		$this->load->view('include/footer');
	
	}
	
	public function cadastrar(){
		
		$this->form_validation->set_rules('observacoes', 'OBSERVAÇÕES OU DESCRIÇÃO GERAL', 'required');
			
		$this->form_validation->set_message('required', 'O Campo %s é obrigatório.');
			
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
			
		if ($this->form_validation->run() == FALSE)
		{
		
			$this->load->model('documentos_model', 'documentos');
			
			$data['documentos'] = $this->documentos->documentos_listagem();
			
			$data['tipo_pagina'] = '| Novo Protocolo';
				
			$this->load->view('include/header');
			$this->load->view('include/menu_protocolo', $data);
			$this->load->view('protocolo/cadastro');
			$this->load->view('include/footer');
		
		}
		else
		{
				
			$data = array(
					'origem_processo'			=> $this->input->post('procedimento'),
					'numero_processo' 			=> juntaCodigo($this->input->post('numero')),
					'tipo_documento' 			=> $this->input->post('tipo'),
					'assunto_processo'			=> $this->input->post('assunto_processo'),
					'situacao_processo'			=> $this->input->post('situacao_processo'),
					'data_cadastro'				=> dataetempo_inverso($this->input->post('data_cadastro')),
					'unidade_origem'			=> $this->input->post('id_origem'),
					'unidade_destino'			=> $this->input->post('id_destino'),
					'codigo_rastreamento'		=> $this->input->post('codigo_rastreamento'),
					'numero_documento'			=> $this->input->post('numero_documento'),
					'data_documento_emissao'	=> ConverterUS($this->input->post('data_documento')),
					'volumes'					=> $this->input->post('volumes'),
					'paginas'					=> $this->input->post('paginas'),
					'observacoes'				=> $this->input->post('observacoes'),
					'criadopor'					=> $this->session->userdata('documento')
			);
		
			$this->load->model('protocolo_model', 'protocolo');
			$this->load->model('movimentacao_model', 'movimentacao');
		
			$query = $this->protocolo->cadastrar($data);
		
			if($query === FALSE){
					
				$msg['erro'] = "Não foi possível inserir os dados.";
		
				$data['tipo_pagina'] = '| Novo Protocolo | Erro na operação';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('include/erro', $msg);
				$this->load->view('include/footer');
					
			}else{
				
				$ultimo_id = $this->db->insert_id();
				
				$info = array(
						'id_protocolo'				=> $ultimo_id,
						'origem'					=> $this->input->post('id_origem'),
						'origem_enviado'			=> $this->session->userdata('documento'),
						'origem_data'				=> dataetempo_inverso($this->input->post('data_cadastro')),
						'origem_despacho'			=> '***',
						'destino'					=> $this->input->post('id_destino'),
						'recebido'					=> "N"
				);
				
				$tramite = $this->movimentacao->cadastrar($info);
					
				$data['tipo_pagina'] = '| Novo Protocolo | Sucesso na operação';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('include/sucesso');
				$this->load->view('include/footer');
					
			}
				
		}
		
		
	}
	
	public function atualiza($id){
	
		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('documentos_model', 'documentos');
		
		$data['documentos'] = $this->documentos->documentos_listagem();
		$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
	
		$data['tipo_pagina'] = '| Atualizar Processo';
	
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/atualiza');
		$this->load->view('include/footer');
	
	}
	
	function atualizar($id){
			
			
		$data = array(
					'tipo_documento' 			=> $this->input->post('tipo'),
					'assunto_processo'			=> $this->input->post('assunto_processo'),
					'codigo_rastreamento'		=> $this->input->post('codigo_rastreamento'),
					'numero_documento'			=> $this->input->post('numero_documento'),
					'data_documento_emissao'	=> ConverterUS($this->input->post('data_documento')),
					'volumes'					=> $this->input->post('volumes'),
					'paginas'					=> $this->input->post('paginas'),
					'observacoes'				=> $this->input->post('observacoes')
			);
			
		$this->load->model('protocolo_model', 'protocolo');
			
		$query = $this->protocolo->alterar($data, $id);
			
		if($query === FALSE){
			
			$msg['erro'] = "Não foi possível alterar os dados.";
			
			$data['tipo_pagina'] = '| Atualizar Processo | Erro na operação';
	
			$this->load->view('include/header');
			$this->load->view('include/menu_protocolo', $data);
			$this->load->view('include/erro', $msg);
			$this->load->view('include/footer');
				
		}else{
				
			$data['tipo_pagina'] = '| Atualizar Processo | Sucesso na operação';
	
			$this->load->view('include/header');
			$this->load->view('include/menu_protocolo', $data);
			$this->load->view('include/sucesso');
			$this->load->view('include/footer');
				
		}
			
			
	}
	
	function receber($id){
			
			
		$tramite = array(
				'destino_recebido'		=> $this->session->userdata('documento'),
				'destino_data'			=> date('Y-m-d H:i:s'),
				'situacao'				=> '2',
				'recebido'				=> 'S',
				'destino_despacho'		=> $this->input->post('despacho')
		);
		
		$protocolo = array(
				'situacao_processo'		=> '2',
		);
			
		$this->load->model('movimentacao_model', 'movimentacao');
		$this->load->model('protocolo_model', 'protocolo');
			
		$query = $this->movimentacao->alterar($tramite, $this->input->post('movimento'));
			
		if($query === FALSE){
				
				$msg['erro'] = "Não foi possível alterar os dados.";
					
				$data['tipo_pagina'] = '| Atualizar Processo | Erro na operação';
		
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('include/erro', $msg);
				$this->load->view('include/footer');
	
		}else{
			
			
				$query1 = $this->protocolo->alterar($protocolo, $id);
					
				if($query === FALSE){
				
					$msg['erro'] = "Não foi possível alterar os dados.";
				
					$data['tipo_pagina'] = '| Atualizar Processo | Erro na operação';
				
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/erro', $msg);
					$this->load->view('include/footer');
				
				}else{
		
					$data['tipo_pagina'] = '| Atualizar Processo | Sucesso na operação';
					$pagina =  base_url() . 'protocolo/visualizar/' . $id;
					
					redirect($pagina, 'refresh');
					
				}
	
		}
			
			
	}
	
	public function encaminha($id){
		
		$this->load->model('protocolo_model', 'protocolo');
		
		$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
	
		$data['tipo_pagina'] = '| Encaminhar Processo';
	
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/encaminhar');
		$this->load->view('include/footer');
		
	}
	
	
	public function encaminhar($id){
	
		$this->form_validation->set_rules('despacho_origem', 'DESPACHO DE ENVIO', 'required');
			
		$this->form_validation->set_message('required', 'O Campo %s é obrigatório.');
			
		$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
			
		if ($this->form_validation->run() == FALSE)
		{
	
			$this->load->model('protocolo_model', 'protocolo');
		
			$data['listagem'] 	= $this->protocolo->protocolo_unidade($id);
		
			$data['tipo_pagina'] = '| Encaminhar Processo';
		
			$this->load->view('include/header');
			$this->load->view('include/menu_protocolo', $data);
			$this->load->view('protocolo/encaminhar');
			$this->load->view('include/footer');
	
		}
		else
		{
	
			$data = array(
						'id_protocolo'				=> $this->input->post('movimento'),
						'origem'					=> $this->input->post('id_origem'),
						'origem_enviado'			=> $this->session->userdata('documento'),
						'origem_data'				=> date('Y-m-d H:i:s'),
						'origem_despacho'			=> $this->input->post('despacho_origem'),
						'destino'					=> $this->input->post('id_destino'),
						'recebido'					=> "N"
			);
	
			$this->load->model('movimentacao_model', 'movimentacao');
	
			$query = $this->movimentacao->cadastrar($data);
	
			if($query === FALSE){
					
				$msg['erro'] = "Não foi possível inserir os dados.";
	
				$data['tipo_pagina'] = '| Encaminhar Processo | Erro na operação';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('include/erro', $msg);
				$this->load->view('include/footer');
					
			}else{
	
				$data['tipo_pagina'] = '| Encaminhar Processo | Sucesso na operação';
				$pagina =  base_url() . 'protocolo/visualizar/' . $id;
					
				redirect($pagina, 'refresh');
					
			}
	
		}
	
	
	}
	
	public function cancelFoward($id)
	{
			
		$this->load->model('movimentacao_model', 'movimentacao');
			
		$idd = $this->input->post('movimento');
		
		$query = $this->movimentacao->excluir($idd);
			
		if($query){
				
			$data['tipo_pagina'] = '| Cancelar Encaminhamento | Sucesso na operação';
			$pagina =  base_url() . 'protocolo/visualizar/' . $id;
				
			redirect($pagina, 'refresh');
				
				
		}else{
				
			$msg['erro'] = "Não foi possível inserir os dados.";
			$data['tipo_pagina'] = '| Cancelar Encaminhamento | Erro na operação';
				
			$this->load->view('include/header');
			$this->load->view('include/menu_protocolo', $data);
			$this->load->view('include/erro', $msg);
			$this->load->view('include/footer');
				
		}
			
			
	}
	
	function cancelaProcesso($id){
			
			
		$protocolo = array(
				'situacao_processo'		=> '4',
		);
	
		$data = array(
				'id_protocolo'				=> $id,
				'origem'					=> $this->input->post('id_origem'),
				'origem_enviado'			=> $this->session->userdata('documento'),
				'origem_data'				=> date('Y-m-d H:i:s'),
				'origem_despacho'			=> $this->input->post('despacho_origem'),
				'recebido'					=> "S",
				'situacao'					=> '5'
		);
	
		$this->load->model('movimentacao_model', 'movimentacao');
		$this->load->model('protocolo_model', 'protocolo');
	
		$query = $this->movimentacao->cadastrar($data);
	
		if($query === FALSE){
	
			$msg['erro'] = "Não foi possível alterar os dados.";
	
			$data['tipo_pagina'] = '| Cancelar Processo | Erro na operação';
	
			$this->load->view('include/header');
			$this->load->view('include/menu_protocolo', $data);
			$this->load->view('include/erro', $msg);
			$this->load->view('include/footer');
	
		}else{
	
			$query1 = $this->protocolo->alterar($protocolo, $id);
	
			if($query === FALSE){
	
				$msg['erro'] = "Não foi possível alterar os dados.";
	
				$data['tipo_pagina'] = '| Cancelar Processo | Erro na operação';
	
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('include/erro', $msg);
				$this->load->view('include/footer');
	
			}else{
	
				$data['tipo_pagina'] = '| Cancelar Processo | Sucesso na operação';
				$pagina =  base_url() . 'protocolo/visualizar/' . $id;
					
				redirect($pagina, 'refresh');
					
			}
	
		}
			
			
	}
	
	function concluiProcesso($id){
			
			
		$protocolo = array(
				'situacao_processo'		=> '4',
		);
		
		$data = array(
						'id_protocolo'				=> $id,
						'origem'					=> $this->input->post('id_origem'),
						'origem_enviado'			=> $this->session->userdata('documento'),
						'origem_data'				=> date('Y-m-d H:i:s'),
						'origem_despacho'			=> $this->input->post('despacho_origem'),
						'recebido'					=> "S",
						'situacao'					=> '6'
		);
	
		$this->load->model('movimentacao_model', 'movimentacao');
		$this->load->model('protocolo_model', 'protocolo');

		$query = $this->movimentacao->cadastrar($data);
	
		if($query === FALSE){
	
			$msg['erro'] = "Não foi possível alterar os dados.";
				
			$data['tipo_pagina'] = '| Concluir Processo | Erro na operação';
	
			$this->load->view('include/header');
			$this->load->view('include/menu_protocolo', $data);
			$this->load->view('include/erro', $msg);
			$this->load->view('include/footer');
	
		}else{
				
			$query1 = $this->protocolo->alterar($protocolo, $id);
				
			if($query === FALSE){
	
				$msg['erro'] = "Não foi possível alterar os dados.";
	
				$data['tipo_pagina'] = '| Concluir Processo | Erro na operação';
	
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('include/erro', $msg);
				$this->load->view('include/footer');
	
			}else{
	
				$data['tipo_pagina'] = '| Concluir Processo | Sucesso na operação';
				$pagina =  base_url() . 'protocolo/visualizar/' . $id;
					
				redirect($pagina, 'refresh');
					
			}
	
		}
			
			
	}
	
	public function pesquisar(){
		
		$this->load->model('protocolo_model', 'protocolo');
		
			$novonumero = ''; // default when no term in session or POST
			if ($this->input->post('numero'))
			{
				// use the term from POST and set it to session
				$numero = $this->input->post('numero');
				$novonumero = str_replace(".", "", $numero);
				$this->session->set_userdata('novo_numero', $novonumero);
			}
			elseif ($this->session->userdata('novo_numero'))
			{
				// if term is not in POST use existing term from session
				$novonumero = $this->session->userdata('novo_numero');
			}
		
		$maximo = 40;
		
		if ($this->uri->segment(3) == "")
		{
			$inicio = 0;
		}
		else
		{
			$inicio = $this->uri->segment(3);
		}
		
		/*PAGINAÇÃO*/
		$this->load->library('pagination');
		
		$num_rows = $this->protocolo->protocolo_contaRegistros($novonumero);
		
		$config['base_url'] = site_url() . 'protocolo/pesquisar/';
		$config['per_page'] = $maximo;
		$config['total_rows'] = $num_rows;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		$config['prev_link'] = false; // Como não quero que exiba o prev_link, inicio ele como false.
		$config['next_link'] = false; // Como não quero que exiba o next_link, inicio ele como false.
		$config['last_link'] = '<span class="btn btn-default"> Último ';
		$config['first_link'] = '<span class="btn btn-default"> Primeiro';
		
		$config['cur_tag_open'] = '<span class="btn btn-primary"> ';
		$config['cur_tag_close'] = ' </span>';
			
		$config['num_tag_open'] = '<span class="btn btn-default"> ';
		$config['num_tag_close'] = ' </span>';
		
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open'] = '<span class="btn btn-default">';
		$config['prev_tag_close'] = '</span>';
		
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open'] = '<span class="btn btn-default">';
		$config['next_tag_close'] = '</span>';
		
		$config['full_tag_open'] = '<div class="paginacao pagination-centered">'; // Tag que vai ficar em volta da Paginação toda.
		$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
		
		$this->pagination->initialize($config);
		$data['paginacao'] = $this->pagination->create_links();
			
		$data['listagem'] = $this->protocolo->pesquisar($novonumero, $maximo, $inicio);
			
		$data['tipo_pagina'] = '| Pesquisar';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/consulta_listagem', $data);
		$this->load->view('include/footer');
		
		
	}
	
	public function listagem(){
	
		$this->load->model('protocolo_model', 'protocolo');
	
		$maximo = 40;
	
		if ($this->uri->segment(3) == "")
		{
			$inicio = 0;
		}
		else
		{
			$inicio = $this->uri->segment(3);
		}
	
		/*PAGINAÇÃO*/
		$this->load->library('pagination');
	
		$num_rows = $this->protocolo->protocolo_contagem();
	
		$config['base_url'] = site_url() . 'protocolo/listagem/';
		$config['per_page'] = $maximo;
		$config['total_rows'] = $num_rows;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
	
		$config['prev_link'] = false; // Como não quero que exiba o prev_link, inicio ele como false.
		$config['next_link'] = false; // Como não quero que exiba o next_link, inicio ele como false.
		$config['last_link'] = '<span class="btn btn-default"> Último ';
		$config['first_link'] = '<span class="btn btn-default"> Primeiro';
	
		$config['cur_tag_open'] = '<span class="btn btn-primary"> ';
		$config['cur_tag_close'] = ' </span>';
			
		$config['num_tag_open'] = '<span class="btn btn-default"> ';
		$config['num_tag_close'] = ' </span>';
	
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open'] = '<span class="btn btn-default">';
		$config['prev_tag_close'] = '</span>';
	
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open'] = '<span class="btn btn-default">';
		$config['next_tag_close'] = '</span>';
	
		$config['full_tag_open'] = '<div class="paginacao pagination-centered">'; // Tag que vai ficar em volta da Paginação toda.
		$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
	
		$this->pagination->initialize($config);
		$data['paginacao'] = $this->pagination->create_links();
			
		$data['listagem'] = $this->protocolo->listagem($maximo, $inicio);
			
		$data['tipo_pagina'] = '| Listagem simplificada';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/listagem', $data);
		$this->load->view('include/footer');
	
	
	}
	
	public function consulta(){
		
		$this->session->unset_userdata('novo_numero');
		$this->session->unset_userdata('dataentrada');
		$this->session->unset_userdata('situacao');
		$this->session->unset_userdata('descricao');
		
		$data['tipo_pagina'] = '| Consultar Processos';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/consulta');
		$this->load->view('include/footer');
		
		
	}
	
	public function consultar(){
		
		$this->load->model('protocolo_model', 'protocolo');
		
			$novonumero = ''; // default when no term in session or POST
			$dataentrada = '';
			$situacao = '';
			$descricao = '';
			
			if ($this->input->post('numero'))
			{
				// use the term from POST and set it to session
				$numero = $this->input->post('numero');
				$novonumero = str_replace(".", "", $numero);
				$this->session->set_userdata('novo_numero', $novonumero);
			}
			elseif ($this->session->userdata('novo_numero'))
			{
				// if term is not in POST use existing term from session
				$novonumero = $this->session->userdata('novo_numero');
			}else{
					
				$novonumero = 0;
					
			}
		
			
				if ($this->input->post('dataentrada'))
				{
					// use the term from POST and set it to session
					$dataentrada = $this->input->post('dataentrada');
					$dataentrada = dataetempo_inverso($dataentrada);
					$this->session->set_userdata('dataentrada', $dataentrada);
				}
				elseif ($this->session->userdata('dataentrada'))
				{
					// if term is not in POST use existing term from session
					$dataentrada = $this->session->userdata('dataentrada');
				}else{
					
					$dataentrada = 0;
					
				}
				
				
					if ($this->input->post('situacao'))
					{
						// use the term from POST and set it to session
						$situacao = $this->input->post('situacao');
						$this->session->set_userdata('situacao', $situacao);
					}
					elseif ($this->session->userdata('situacao'))
					{
						// if term is not in POST use existing term from session
						$situacao = $this->session->userdata('situacao');
					}else{
						
						$situacao = 0;
						
					}
					
					
						if ($this->input->post('descricao'))
						{
							// use the term from POST and set it to session
							$descricao = $this->input->post('descricao');
							$this->session->set_userdata('descricao', $descricao);
						}
						elseif ($this->session->userdata('descricao'))
						{
							// if term is not in POST use existing term from session
							$descricao = $this->session->userdata('descricao');
						}else{
						
							$descricao = 0;
						
						}
			
			
		$maximo = 40;
		
		if ($this->uri->segment(3) == "")
		{
			$inicio = 0;
		}
		else
		{
			$inicio = $this->uri->segment(3);
		}
		
		/*PAGINAÇÃO*/
		$this->load->library('pagination');
		
		$num_rows = $this->protocolo->protocolo_contaRegistros($novonumero);
		
		$config['base_url'] = site_url() . 'protocolo/consultar/';
		$config['per_page'] = $maximo;
		$config['total_rows'] = $num_rows;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		$config['prev_link'] = false; // Como não quero que exiba o prev_link, inicio ele como false.
		$config['next_link'] = false; // Como não quero que exiba o next_link, inicio ele como false.
		$config['last_link'] = '<span class="btn btn-default"> Último ';
		$config['first_link'] = '<span class="btn btn-default"> Primeiro';
		
		$config['cur_tag_open'] = '<span class="btn btn-primary"> ';
		$config['cur_tag_close'] = ' </span>';
			
		$config['num_tag_open'] = '<span class="btn btn-default"> ';
		$config['num_tag_close'] = ' </span>';
		
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open'] = '<span class="btn btn-default">';
		$config['prev_tag_close'] = '</span>';
		
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open'] = '<span class="btn btn-default">';
		$config['next_tag_close'] = '</span>';
		
		$config['full_tag_open'] = '<div class="paginacao pagination-centered">'; // Tag que vai ficar em volta da Paginação toda.
		$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
		
		$this->pagination->initialize($config);
		$data['paginacao'] = $this->pagination->create_links();
			
		$data['listagem'] = $this->protocolo->pesquisar_filtro($novonumero, $dataentrada, $situacao, $descricao, $maximo, $inicio);
			
		$data['tipo_pagina'] = '| Pesquisar';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/consulta_listagem', $data);
		$this->load->view('include/footer');
		
	}

	public function relatorio($tipo){

		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('orgao_model', 'orgao');
	

		if($tipo == '1'){
			$data['tipo_pagina'] = '&nbsp Relatório - Listagem Geral';
			$data['listagem'] = $this->protocolo->listagem_geral();
		}elseif ($tipo == '2') { //PROTOCOLADO - 1
			$data['tipo_pagina'] = '&nbsp Relatório - Processos Protocolados';
			$data['listagem'] = $this->protocolo->listagem_tipo(1);
		}elseif ($tipo == '3') { //TRAMITANDO - 2
			$data['tipo_pagina'] = '&nbsp Relatório - Processos Tramitando';
			$data['listagem'] = $this->protocolo->listagem_tipo(2);
		}elseif ($tipo == '4') { //EM ANÁLISE - 3
			$data['tipo_pagina'] = '&nbsp Relatório - Processos em análise';
			$data['listagem'] = $this->protocolo->listagem_tipo(3);
		}elseif ($tipo == '5') { //ARQUIVADO - 4
			$data['tipo_pagina'] = '&nbsp Relatório - Processos Arquivados';
			$data['listagem'] = $this->protocolo->listagem_tipo(4);
		}

		$data['orgao'] 		= $this->orgao->listar_unidade();
		
		$this->load->view('protocolo/imprime_relatorio', $data);

	}

	public function relatorioc(){

		$this->session->unset_userdata('novo_numero');
		$this->session->unset_userdata('dataentrada');
		$this->session->unset_userdata('situacao');
		$this->session->unset_userdata('descricao');
		
		$data['tipo_pagina'] = '| Relatório Personalizado';
		
		$this->load->view('include/header');
		$this->load->view('include/menu_protocolo', $data);
		$this->load->view('protocolo/consulta_relatorio');
		$this->load->view('include/footer');

	}

	public function relatoriop(){

		$this->load->model('protocolo_model', 'protocolo');
		$this->load->model('orgao_model', 'orgao');
		
			$novonumero = ''; // default when no term in session or POST
			$dataentrada = '';
			$situacao = '';
			$descricao = '';
			
			if ($this->input->post('numero'))
			{
				// use the term from POST and set it to session
				$numero = $this->input->post('numero');
				$novonumero = str_replace(".", "", $numero);
				$this->session->set_userdata('novo_numero', $novonumero);
			}
			elseif ($this->session->userdata('novo_numero'))
			{
				// if term is not in POST use existing term from session
				$novonumero = $this->session->userdata('novo_numero');
			}else{
					
				$novonumero = 0;
					
			}
		
			
				if ($this->input->post('dataentrada'))
				{
					// use the term from POST and set it to session
					$dataentrada = $this->input->post('dataentrada');
					$dataentrada = dataetempo_inverso($dataentrada);
					$this->session->set_userdata('dataentrada', $dataentrada);
				}
				elseif ($this->session->userdata('dataentrada'))
				{
					// if term is not in POST use existing term from session
					$dataentrada = $this->session->userdata('dataentrada');
				}else{
					
					$dataentrada = 0;
					
				}
				
				
					if ($this->input->post('situacao'))
					{
						// use the term from POST and set it to session
						$situacao = $this->input->post('situacao');
						$this->session->set_userdata('situacao', $situacao);
					}
					elseif ($this->session->userdata('situacao'))
					{
						// if term is not in POST use existing term from session
						$situacao = $this->session->userdata('situacao');
					}else{
						
						$situacao = 0;
						
					}
					
					
						if ($this->input->post('descricao'))
						{
							// use the term from POST and set it to session
							$descricao = $this->input->post('descricao');
							$this->session->set_userdata('descricao', $descricao);
						}
						elseif ($this->session->userdata('descricao'))
						{
							// if term is not in POST use existing term from session
							$descricao = $this->session->userdata('descricao');
						}else{
						
							$descricao = 0;
						
						}
			
			
		$maximo = 999999;
		
		if ($this->uri->segment(3) == "")
		{
			$inicio = 0;
		}
		else
		{
			$inicio = $this->uri->segment(3);
		}
		
		/*PAGINAÇÃO*/
		$this->load->library('pagination');
		
		$num_rows = $this->protocolo->protocolo_contaRegistros($novonumero);
		
		$config['base_url'] = site_url() . 'protocolo/consultar/';
		$config['per_page'] = $maximo;
		$config['total_rows'] = $num_rows;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		$config['prev_link'] = false; // Como não quero que exiba o prev_link, inicio ele como false.
		$config['next_link'] = false; // Como não quero que exiba o next_link, inicio ele como false.
		$config['last_link'] = '<span class="btn btn-default"> Último ';
		$config['first_link'] = '<span class="btn btn-default"> Primeiro';
		
		$config['cur_tag_open'] = '<span class="btn btn-primary"> ';
		$config['cur_tag_close'] = ' </span>';
			
		$config['num_tag_open'] = '<span class="btn btn-default"> ';
		$config['num_tag_close'] = ' </span>';
		
		$config['prev_link'] = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open'] = '<span class="btn btn-default">';
		$config['prev_tag_close'] = '</span>';
		
		$config['next_link'] = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open'] = '<span class="btn btn-default">';
		$config['next_tag_close'] = '</span>';
		
		$config['full_tag_open'] = '<div class="paginacao pagination-centered">'; // Tag que vai ficar em volta da Paginação toda.
		$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
		
		$this->pagination->initialize($config);
		$data['paginacao'] = $this->pagination->create_links();
			
		$data['orgao'] 		= $this->orgao->listar_unidade();
		$data['listagem'] = $this->protocolo->pesquisar_filtro($novonumero, $dataentrada, $situacao, $descricao, $maximo, $inicio);
			
		$data['tipo_pagina'] = '&nbsp Relatório personalizado';
		
		$this->load->view('protocolo/imprime_relatorio', $data);


	}
	
	
	//------------------- FUNCOES DO PROTOCOLO ----------------------------------//
	
	
	//------------------- FUNCOES DO PROCESSO ----------------------------------//
	
			function get_externo(){
				
				$this->load->model('setores_model', 'setores');
				
				if(isset($_GET['term'])){
					$q = strtolower($_GET['term']);
					$this->setores->pesquisaNome($q);
				}
			}
			
			public function externo_informacoes($dado1){
			
				$dado1 = $this->input->post('busca');
			
				$this->db->where("descricao", $dado1);
				$this->db->or_where("sigla", $dado1);
				$verifica = $this->db->get('cad_setores');
				$verifica->result();
			
				if(count($verifica->result())>0){
			
					foreach($verifica->result() as $lista){
			
						$arr = array(
								'id_externo'		=> $lista->id,
								'descricao'			=> $lista->descricao
						);
			
						echo json_encode($arr);
			
					}
						
						
				}else{
						
					echo '1';
						
				} // fim do if $verifica
			}
	
	//------------------- FUNCOES DO PROCESSO ----------------------------------//
	
			
			
			
	//------------------ FUNCOES DOS TIPO PROCESSOS ----------------------------//
			
				
			public function processos(){
					
				$this->load->model('documentos_model', 'documentos');
					
				$data['listagem'] = $this->documentos->processos_listar_ultimas(10);
				$data['tipo_pagina'] = '| Tipo de Processos';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/processos_index');
				$this->load->view('include/footer');
					
					
			}
			
			
			public function processosControle(){
					
				$this->load->model('documentos_model', 'documentos');
					
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
					
				$config['base_url'] = site_url() . 'protocolo/processosControle/';
				$config['per_page'] = $maximo;
				$config['total_rows'] = $this->documentos->processos_contaRegistros();
				$config['uri_segment'] = 3;
				$config['num_links'] = 6;
					
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
					
				$config['full_tag_open'] = '<div class="paginacao pagination-centered">'; // Tag que vai ficar em volta da Paginação toda.
				$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
					
				$this->pagination->initialize($config);
				$data['paginacao'] = $this->pagination->create_links();
					
				$data['listagem'] = $this->documentos->processos_retornaLista($maximo, $inicio);
					
				$data['tipo_pagina'] = '| Tipo de Processos | Listagem';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/processos_controle');
				$this->load->view('include/footer');
					
			}
			
			public function processosCadastro(){
					
				$data['tipo_pagina'] = '| Tipo de Processos | Cadastro';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/processos_cadastro');
				$this->load->view('include/footer');
					
					
			}
			
			public function processosCadastrar(){
			
			
				$this->form_validation->set_rules('nome_documento', 'NOME DO DOCUMENTO', 'required|trim');
				$this->form_validation->set_rules('status', 'STATUS DO DOCUMENTO', 'required');
					
				$this->form_validation->set_message('required', 'O Campo %s é obrigatório.');
				$this->form_validation->set_message('min_length', 'O Campo %s deve conter no mínimo %s caracteres.');
					
				$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
					
				if ($this->form_validation->run() == FALSE)
				{
			
					$data['tipo_pagina'] = '| Tipo de Processos | Cadastro';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('protocolo/processos_cadastro');
					$this->load->view('include/footer');
			
				}
				else
				{
						
					$data = array(
							'nome' 				=> $this->input->post('nome_documento'),
							'status'			=> $this->input->post('status'),
					);
			
					$this->load->model('documentos_model', 'protocolo');
			
					$query = $this->protocolo->processos_cadastrar($data);
			
					if($query === FALSE){
			
						$msg['erro'] = "Não foi possível inserir os dados.";
						$data['tipo_pagina'] = '| Tipo de Processos | Erro na operação';
			
						$this->load->view('include/header');
						$this->load->view('include/menu_protocolo', $data);
						$this->load->view('include/erro', $msg);
						$this->load->view('include/footer');
			
					}else{
			
						$data['tipo_pagina'] = '| Tipo de Processos | Sucesso na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu_protocolo', $data);
						$this->load->view('include/sucesso');
						$this->load->view('include/footer');
			
					}
						
				}
					
			}
				
				
			function processosEditar($id){
					
				$this->load->model('documentos_model', 'protocolo');
					
				$data['tipo_pagina'] = '| Tipo de Processos | Editar';
				$data['listagem'] 	= $this->protocolo->processos_listar_unidade($id);
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/processos_editar', $data);
				$this->load->view('include/footer');
					
					
			}
				
			function processosEditado($id){
					
					
				$data = array(
						'nome' 				=> $this->input->post('nome_documento'),
						'status'			=> $this->input->post('status'),
				);
					
				$this->load->model('documentos_model', 'protocolo');
					
				$query = $this->protocolo->processos_alterar($data, $id);
					
				if($query === FALSE){
			
					$data['tipo_pagina'] = '| Tipo de Processos | Sucesso na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
			
				}else{
			
					$data['tipo_pagina'] = '| Tipo de Processos | Sucesso na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
			
				}
					
					
			}
				
				
			public function processosExcluir($id)
			{
					
				$this->load->model('documentos_model', 'protocolo');
					
				$query = $this->protocolo->processos_excluir($id);
					
				if($query){
						
					$data['tipo_pagina'] = '| Tipo de Processos | Sucesso na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
						
						
				}else{
						
					$msg['erro'] = "Não foi possível inserir os dados.";
					$data['tipo_pagina'] = '| Tipo de Processos | Erro na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/erro', $msg);
					$this->load->view('include/footer');
						
				}
					
					
			}
				
				
	//------------------ FUNCOES DOS TIPO PROCESSOS ----------------------------//
	
			
			
	//------------------ FUNCOES DOS TIPO DOCUMENTOS ----------------------------//
	
			
			public function documentos(){
					
				$this->load->model('documentos_model', 'protocolo');
			
				$data['listagem'] = $this->protocolo->documentos_listar_ultimas(10);
				$data['tipo_pagina'] = '| Tipo de Documentos';
			
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/documentos_index');
				$this->load->view('include/footer');
					
					
			}
				
				
			public function documentosControle(){
					
				$this->load->model('documentos_model', 'protocolo');
			
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
			
				$config['base_url'] = site_url() . 'protocolo/documentosControle/';
				$config['per_page'] = $maximo;
				$config['total_rows'] = $this->protocolo->documentos_contaRegistros();
				$config['uri_segment'] = 3;
				$config['num_links'] = 6;
			
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
			
				$config['full_tag_open'] = '<div class="paginacao pagination-centered">'; // Tag que vai ficar em volta da Paginação toda.
				$config['full_tag_close'] = '</div>'; // Fechamento da Tag.
			
				$this->pagination->initialize($config);
				$data['paginacao'] = $this->pagination->create_links();
					
				$data['listagem'] = $this->protocolo->documentos_retornaLista($maximo, $inicio);
					
				$data['tipo_pagina'] = '| Tipo de Documentos | Listagem';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/documentos_controle');
				$this->load->view('include/footer');
					
			}
				
			public function documentosCadastro(){
					
				$data['tipo_pagina'] = '| Tipo de Documentos | Cadastro';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/documentos_cadastro');
				$this->load->view('include/footer');
					
					
			}
				
			public function documentosCadastrar(){
				
				
				$this->form_validation->set_rules('nome_documento', 'NOME DO DOCUMENTO', 'required|trim');
				$this->form_validation->set_rules('status', 'STATUS DO DOCUMENTO', 'required');
					
				$this->form_validation->set_message('required', 'O Campo %s é obrigatório.');
				$this->form_validation->set_message('min_length', 'O Campo %s deve conter no mínimo %s caracteres.');
					
				$this->form_validation->set_error_delimiters('<div class="error_box">', '</div>');
					
				if ($this->form_validation->run() == FALSE)
				{
						
					$data['tipo_pagina'] = '| Tipo de Documentos | Cadastro';
					
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('protocolo/documentos_cadastro');
					$this->load->view('include/footer');
						
				}
				else
				{
					
					$data = array(
							'nome' 				=> $this->input->post('nome_documento'),
							'status'			=> $this->input->post('status'),
					);
				
					$this->load->model('documentos_model', 'protocolo');
				
					$query = $this->protocolo->documentos_cadastrar($data);
				
					if($query === FALSE){
				
						$msg['erro'] = "Não foi possível inserir os dados.";
						$data['tipo_pagina'] = '| Tipo de Documentos | Erro na operação';
				
						$this->load->view('include/header');
						$this->load->view('include/menu_protocolo', $data);
						$this->load->view('include/erro', $msg);
						$this->load->view('include/footer');
				
					}else{
				
						$data['tipo_pagina'] = '| Tipo de Documentos | Sucesso na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu_protocolo', $data);
						$this->load->view('include/sucesso');
						$this->load->view('include/footer');
				
					}
					
				}
					
			}
			
			
			function documentosEditar($id){
			
				$this->load->model('documentos_model', 'protocolo');
			
				$data['tipo_pagina'] = '| Tipo de Documentos | Editar';
				$data['listagem'] 	= $this->protocolo->documentos_listar_unidade($id);
			
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('protocolo/documentos_editar', $data);
				$this->load->view('include/footer');
			
			
			}
			
			function documentosEditado($id){
			
			
				$data = array(
							'nome' 				=> $this->input->post('nome_documento'),
							'status'			=> $this->input->post('status'),
				);
			
				$this->load->model('documentos_model', 'protocolo');
			
				$query = $this->protocolo->documentos_alterar($data, $id);
			
				if($query === FALSE){
						
					$data['tipo_pagina'] = '| Tipo de Documentos | Sucesso na operação';
							
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
						
				}else{
						
					$data['tipo_pagina'] = '| Tipo de Documentos | Sucesso na operação';
							
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
						
				}
					
			
			}
			
			
			public function documentosExcluir($id)
			{
			
				$this->load->model('documentos_model', 'protocolo');
			
				$query = $this->protocolo->documentos_excluir($id);
			
				if($query){
			
					$data['tipo_pagina'] = '| Tipo de Documentos | Sucesso na operação';
							
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/sucesso');
					$this->load->view('include/footer');
					
			
				}else{
			
					$msg['erro'] = "Não foi possível inserir os dados.";
					$data['tipo_pagina'] = '| Tipo de Documentos | Erro na operação';
			
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/erro', $msg);
					$this->load->view('include/footer');
			
				}
			
			
			}
			
			
	//------------------ FUNCOES DOS TIPO DOCUMENTOS ----------------------------//



	//------------------ FUNCOES DOS SETORES ----------------------------//


			public function setores(){
		
				$this->load->model('setores_model', 'setores');
					
				$data['setores'] = $this->setores->listar_ultimas(10);
				
				$data['tipo_pagina'] = '| Departamentos/Setores';
				
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('setores/index');
				$this->load->view('include/footer');
				
				
			}
			
				
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
				$this->load->view('include/menu_protocolo', $data);
				$this->load->view('setores/controle');
				$this->load->view('include/footer');
					
			}
			
			public function setoresCadastro(){
					
				$data['tipo_pagina'] = '| Departamentos/Setores | Cadastro';
					
				$this->load->view('include/header');
				$this->load->view('include/menu_protocolo', $data);
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
					$this->load->view('include/menu_protocolo', $data);
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
						$this->load->view('include/menu_protocolo', $data);
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
				$this->load->view('include/menu_protocolo', $data);
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
					$this->load->view('include/menu_protocolo', $data);
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
						$this->load->view('include/menu_protocolo', $data);
						$this->load->view('include/sucesso');
						$this->load->view('include/footer');
							
							
					}else{
							
						$msg['erro'] = "Não foi possível inserir os dados.";
						
						$data['tipo_pagina'] = '| Departamentos/Setores | Erro na operação';
							
						$this->load->view('include/header');
						$this->load->view('include/menu_protocolo', $data);
						$this->load->view('include/erro', $msg);
						$this->load->view('include/footer');
							
					}
						
				}else{
			
					$msg['erro'] = "Não foi possível excluir. Existem processos cadastrados nesse setor.";
					$data['tipo_pagina'] = '| Departamentos/Setores | Erro na operação';
						
					$this->load->view('include/header');
					$this->load->view('include/menu_protocolo', $data);
					$this->load->view('include/erro', $msg);
					$this->load->view('include/footer');
			
			
				}
					
					
			}
			
			
	//------------------ FUNCOES DOS SETORES EXTERNOS ----------------------------//
	
	
	
}