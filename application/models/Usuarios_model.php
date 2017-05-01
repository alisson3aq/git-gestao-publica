<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	//------------------------ FUNCOES USUARIOS ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('cad_usuario', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id', $id);
			$this->db->update('cad_usuario', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function listar_unidade($id){
		
			$this->db->where('documento', $id);
			$query = $this->db->get('cad_usuario');
		
			return $query->result();
		
		}
	
		public function listar_ultimas($quantidade)
		{
		
			$this->db->order_by('id_cad_usuario', 'DESC');
			$this->db->limit($quantidade);
		
			$query = $this->db->get('cad_usuario');
		
			return $query->result();
		
		}
		
		public function contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('cad_usuario');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('cad_usuario');
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function pesquisaNome($nome){
		
			$this->db->like('descricao', $nome);
			$this->db->or_like("sigla", $nome);
			$query = $this->db->get('cad_usuario');
		
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

		public function verificaUsuario($id){
			
			$this->db->where('documento', $id);

			$query = $this->db->get('cad_usuario');
		
			if($query->num_rows() > 0 ){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}

		}

		public function verificaProtocoloProcesso($id){
			
			$this->db->where('criadopor', $id);
		
			$query = $this->db->get('protocolo_processo');
		
			if($query->num_rows() > 0 ){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}

		}

		public function verificaProtocoloTramite($id){

			$this->db->where('origem_enviado', $id);
			$this->db->or_where('destino_recebido', $id);
		
			$query = $this->db->get('protocolo_tramite');
		
			if($query->num_rows() > 0 ){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}


		}
		
		public function excluir($id){
		
			$this->db->where('documento', $id);
			$this->db->delete('cad_usuario');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}
	
	//------------------------ FUNCOES USUARIOS ----------------------------- //
	
	
	
		
}