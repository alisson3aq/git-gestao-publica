<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	public function verifica($login, $senha)
	{
		/*
		 * 
		 * Verificação do Status do Usuario
		 * 1 = ATIVO
		 * 2 = INATIVO
		 * 
		 */
		
		$this->db->where('documento', $login);
		$this->db->where('senha', md5($senha));
		$this->db->where('status', '1'); // Verifica o status do usuário
		
		$query = $this->db->get('cad_usuario');
		
		return $query->num_rows();
		
	}
	
	public function lista($login)
	{
		
		/*
		 * 
		 * LISTA O USUARIO DE ACORDO COM O LOGIN
		 * INFORMADO DENTRO DO FORMULARIO DE LOGIN
		 * 
		 */
		
		$this->db->where('documento', $login);
		$this->db->where('status', '1'); // Verifica o status do usuário
		
		$query = $this->db->get('cad_usuario');
		
		return $query->result();
		
		
	}
	
	public function update_login($dado){
	
		$data['logoff'] = date('Y-m-d H:i:s');
	
		$this->db->where('documento', $dado);
		$this->db->update('cad_usuario', $data);
	
	}
	
	
	public function listar_setor_interno($id){
		
		$this->db->where('id_setor_interno', $id);
		$query = $this->db->get('setor_interno');
		
		return $query->result();
		
	}
	
	
	
	
}