<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentos_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	
	
	//------------------------ FUNCOES DE CADASTRO ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('cad_documento', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id_documento', $id);
			$this->db->update('cad_documento', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
	
	//------------------------ FUNCOES DE CADASTRO ----------------------------- //
	
		
	//------------------ FUNCOES DOS TIPO PROCESSOS ----------------------------//
		
		
		public function processos_cadastrar($data){
		
			$this->db->insert('cad_processo', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function processos_alterar($dados, $id){
		
			$this->db->where('id_processo', $id);
			$this->db->update('cad_processo', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		
		public function processos_listar_ultimas($quantidade)
		{
		
			$this->db->order_by('status', 'DESC');
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($quantidade);
		
			$query = $this->db->get('cad_processo');
		
			return $query->result();
		
		}
		
		public function processos_contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('cad_processo');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function processos_retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('cad_processo');
			$this->db->order_by('status', 'DESC');
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function processos_listar_unidade($id){
		
			$this->db->where('id_processo', $id);
			$query = $this->db->get('cad_processo');
		
			return $query->result();
		
		
		}
		
		public function processos_excluir($id){
		
			$this->db->where('id_processo', $id);
			$this->db->delete('cad_processo');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}
		
		
	//------------------ FUNCOES DOS TIPO PROCESSOS ----------------------------//
	
		
	
		
	//------------------ FUNCOES DOS TIPO DOCUMENTOS ----------------------------//
	
		
		public function documentos_cadastrar($data){
		
			$this->db->insert('cad_documento', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function documentos_alterar($dados, $id){
		
			$this->db->where('id_documento', $id);
			$this->db->update('cad_documento', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function documentos_listagem()
		{
		
			$this->db->where('status', '1');
			$this->db->order_by('nome', 'ASC');
		
			$query = $this->db->get('cad_documento');
		
			return $query->result();
		
		}
		
		public function documentos_listar_ultimas($quantidade)
		{
		
			$this->db->order_by('status', 'DESC');
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($quantidade);
		
			$query = $this->db->get('cad_documento');
		
			return $query->result();
		
		}
		
		public function documentos_contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('cad_documento');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function documentos_retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('cad_documento');
			$this->db->order_by('status', 'DESC');
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function documentos_listar_unidade($id){
		
			$this->db->where('id_documento', $id);
			$query = $this->db->get('cad_documento');
		
			return $query->result();
		
		
		}
		
		public function documentos_excluir($id){
		
			$this->db->where('id_documento', $id);
			$this->db->delete('cad_documento');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}
		
		
	//------------------ FUNCOES DOS TIPO DOCUMENTOS ----------------------------//
	
		
	//------------------------ FUNCOES DE LISTAGEM -----------------------------//
	
	
		public function listar_cliente($id)
		{
		
			$this->db->where('cliente', $id);
			$this->db->order_by('instancia', 'ASC');
			$this->db->order_by('id', 'DESC');
		
			$query = $this->db->get('cad_documento');
		
			return $query->result();
		
		}
		
		public function verifica_setor($id)
		{
		
			$this->db->where('unidade_origem', $id);
			$this->db->or_where('unidade_destino', $id);
		
			$query = $this->db->get('cad_protocolo');
		
			return $query->result();
		
		}
		
		public function listar_unidade($id){
		
			$this->db->where('id_documento', $id);
			$query = $this->db->get('cad_documento');
		
			return $query->result();
		
		
		}
		
		public function contaRegistros()
		{
			$this->db->select("*");
			$this->db->from('cad_documento');
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function retornaLista($maximo, $inicio)
		{
			$this->db->select("*");
			$this->db->from('cad_documento');
			$this->db->order_by('status', 'DESC');
			$this->db->order_by('nome', 'ASC');
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function contaRegistros_filtro($id)
		{
			$this->db->select("*");
			$this->db->from('cad_documento');
			$this->db->order_by('id_documento', 'DESC');
			$this->db->where('cliente', $id);
			$query = $this->db->get();
		
			return count($query->result());
		}
		
		public function retornaLista_filtro($maximo, $inicio, $id)
		{
			$this->db->select("*");
			$this->db->from('cad_documento');
			$this->db->order_by('id_documento', 'DESC');
			$this->db->where('cliente', $id);
			$this->db->limit($maximo, $inicio);
			$query = $this->db->get();
			return $query->result();
		}
		
	
	//------------------------ FUNCOES DE LISTAGEM -----------------------------//
	
		
	//------------------------ FUNCOES DE EXCLUSAO -----------------------------//
	
		
		public function excluir($id){
		
			$this->db->where('id_documento', $id);
			$this->db->delete('cad_documento');
		
			$query = $this->db->affected_rows();
		
			if($query)//se retornar algum resultado
				return TRUE;
			else
				return FALSE;
		
		}
		
		public function excluir_arquivo($id){
		
			$this->db->where('id_documento', $id);
			$query = $this->db->get('cad_documento');
		
			return $query->result();
		
		}
		
		
	//------------------------ FUNCOES DE EXCLUSAO -----------------------------//
	
	
}