<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orgao_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES EMPRESA ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('cad_setores', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('cad_setores', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function listar_unidade(){
		
			$query = $this->db->get('cad_orgao');
		
			return $query->result();
		
		}
	
		public function listar_ultimas($quantidade)
		{
		
			$this->db->order_by('id', 'DESC');
			$this->db->limit($quantidade);
		
			$query = $this->db->get('cad_setores');
		
			return $query->result();
		
		}
		
	
	
	//------------------------ FUNCOES EMPRESA ----------------------------- //
	
	
	
		
}