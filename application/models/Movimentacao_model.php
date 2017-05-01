<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movimentacao_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES SETORES ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('protocolo_tramite', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('protocolo_tramite', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function listar_unidade($id){
		
			$this->db->where('id', $id);
			$query = $this->db->get('protocolo_tramite');
		
			return $query->result();
		
		}
	
		public function listar_ultimas($quantidade, $id)
		{
		
			$this->db->where('id_protocolo', $id);
			$this->db->order_by('id', 'DESC');
			$this->db->limit($quantidade);
		
			$query = $this->db->get('protocolo_tramite');
		
			return $query->result();
		
		}
		
		public function listar_ultima(){
			
			$this->db->order_by('id', 'DESC');
			$this->db->limit(1);
			
			$query = $this->db->get('protocolo_tramite');
			
			return $query->result();
			
			
			
		}
		
		public function contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('protocolo_tramite');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('protocolo_tramite');
			$this->db->order_by('tipo', 'ASC');
			$this->db->order_by('descricao', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function pesquisaNome($nome){
		
			$this->db->like('descricao', $nome);
			$this->db->or_like("sigla", $nome);
			$query = $this->db->get('protocolo_tramite');
		
			if($query->num_rows() > 0){
				foreach ($query->result_array() as $row){
					$row_set[] = stripslashes($row['descricao']); //build an array
						
					/* $new_row['id']			=	htmlentities(stripslashes($row['id_setor_externo']));
					 $new_row['descricao'] 	= 	htmlentities(stripslashes($row['descricao'])); //build an array
					$row_set[] = $new_row; */
				}
				echo json_encode($row_set); //format the array into json data
			}
		
		}
		
		public function excluir($id){
		
			$this->db->where('id', $id);
			$this->db->delete('protocolo_tramite');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}
	
	//------------------------ FUNCOES SETORES ----------------------------- //
	
	
	
		
}