<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		
		$this->load->view('login');
	}
	
	public function verifica()
	{
		
		date_default_timezone_set('America/Sao_Paulo');
	
		if(!$this->input->post('login') OR !$this->input->post('senha'))
		{
	
			$data['error'] = "- Todos os campos devem ser preenchimento!";
			$this->load->view('login', $data);
				
		}
		else
		{
			$login = $this->input->post('login');
			$senha = $this->input->post('senha');
				
			$this->load->model('login_model', 'login');
	
			$query = $this->login->verifica($login, $senha);
	
			if ($query) {
	
				$this->load->model('login_model', 'login');
				$query = $this->login->lista($login);
	
				foreach($query as $valor){
	
					$data = array(
							'id' 				=> $valor->id_cad_usuario,
							'nome' 				=> $valor->nome,
							'apelido' 			=> $valor->apelido,
							'documento'			=> $valor->documento,
							'tipo_usuario'		=> $valor->tipo_usuario,
							'setor_lotacao'		=> $valor->setor_lotacao,
							'id_instituicao'	=> $valor->id_instituicao,
							'app_access'		=> $valor->app_access,
							'status'			=> $valor->status,
							'logado' 			=> $valor->logoff,
							'log_in' 			=> TRUE
					);
	
				}
	
				$this->session->set_userdata($data);
				redirect('autenticacao');
	
			} else {
	
				$data['error'] = "- Dados não conferem.";
				$this->load->view('login', $data);
	
			}
	
		}
	
	
	}
	
	
	public function saida()
	{
	
		date_default_timezone_set('America/Sao_Paulo');
	
		$this->load->model('login_model', 'login');
		$query = $this->login->update_login($this->session->userdata('documento'));
	
	
		$this->session->sess_destroy();
		redirect('/');
	
	}
	
}
