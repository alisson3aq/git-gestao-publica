<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Protocolo_model extends CI_Model {
	
	
	public function __construct()
	{
	
		parent::__construct();
	
	}
	
	
	
	//------------------------ FUNCOES BASICAS ----------------------------- //
	
		public function protocolo_contaRegistros($numero)
		{
			$this->db->select("*");
			$this->db->from('protocolo_processo');
			$this->db->like('numero_processo', $numero, 'both');
			$query = $this->db->get();
			
			return count($query->result());
		}
		
		public function protocolo_contagem()
		{
			$this->db->select("*");
			$this->db->from('protocolo_processo');
			$this->db->where('visible', 'S');
			$query = $this->db->get();
				
			return count($query->result());
		}
	
	
	//------------------------ FUNCOES BASICAS ----------------------------- //
	
	
	
	
	//------------------------ FUNCOES DO PROTOCOLO ----------------------------- //
	
		public function cadastrar($data){
		
			$this->db->insert('protocolo_processo', $data);
		
			$query = $this->db->affected_rows();
		
			if($query){		//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function alterar($dados, $id){
		
			$this->db->where('id_protocolo', $id);
			$this->db->update('protocolo_processo', $dados);
		
			$query = $this->db->affected_rows();
		
			if($query){//se retornar algum resultado
				return TRUE;
			}else{
				return FALSE;
			}
		
		}
		
		public function protocolo_unidade($id){
		
			$this->db->where('id_protocolo', $id);
			$query = $this->db->get('protocolo_processo');
		
			return $query->result();
		
		
		}
		
		public function resumo_protocolo($quantidade)
		{
		
			$this->db->order_by('data_cadastro', 'DESC');
			$this->db->limit($quantidade);
		
			$query = $this->db->get('protocolo_processo');
		
			return $query->result();
		
		}
		
		public function listagem_id_protocolo($dado1){
			
			$this->db->select('*');
			$this->db->from('protocolo_processo');
			$this->db->join('protocolo_tramite', 'protocolo_tramite.id_protocolo = protocolo_processo.id_protocolo');
			
			$this->db->or_where('protocolo_tramite.origem', $dado1);
			$this->db->or_where('protocolo_tramite.destino', $dado1);

			$this->db->group_by('protocolo_processo.id_protocolo');
			$this->db->order_by('protocolo_processo.data_cadastro', 'DESC');
			$this->db->limit(10);
			
			$query = $this->db->get();
			
			return $query->result();
			
		}
		
		public function pesquisar($numero, $maximo, $inicio){
				
			//$this->db->select('numero_processo');
			$this->db->like('numero_processo', $numero, 'both');
			$this->db->order_by('data_cadastro', 'DESC');
			$this->db->limit($maximo, $inicio);
			
			$query = $this->db->get('protocolo_processo');
			
			return $query->result();
				
				
		}

		public function listagem_geral(){
			
			$this->db->order_by('data_cadastro', 'DESC');
			
			$query = $this->db->get('protocolo_processo');
			
			return $query->result();
			
		}
		
		public function listagem($maximo, $inicio){
			
			$this->db->order_by('data_cadastro', 'DESC');
			$this->db->limit($maximo, $inicio);
			
			$query = $this->db->get('protocolo_processo');
			
			return $query->result();
			
		}

		public function listagem_tipo($tipo){
		
			$this->db->where("situacao_processo", $tipo);	
			$this->db->order_by('data_cadastro', 'DESC');
			
			$query = $this->db->get('protocolo_processo');
			
			return $query->result();
			
		}
		
		public function pesquisar_filtro($numero, $dataentrada, $situacao, $descricao, $maximo, $inicio){
		
			
			/* $sql = "SELECT * FROM protocolo_processo WHERE numero_processo 
					LIKE '%" . $numero . "%' ESCAPE '!' OR data_cadastro = '" . $dataentrada . "' 
						OR situacao_processo = '" . $situacao . "' 
							OR assunto_processo LIKE '%" . $descricao . "%' 
								ESCAPE '!' ORDER BY data_cadastro DESC";
			*/
			
			if($numero != 0){
				$this->db->like('numero_processo', $numero, 'both');
			}
			if($dataentrada != 0){
				$this->db->like('data_cadastro', $dataentrada, 'both');
			}
			if($situacao != 0){
				$this->db->where('situacao_processo', $situacao);
			}
			if($descricao != 0){
				$this->db->like('assunto_processo', $descricao);
			}
			$this->db->order_by('data_cadastro', 'DESC');
			$this->db->limit($maximo, $inicio);
				
			$query = $this->db->get('protocolo_processo');
			
			return $query->result();
		
		
		}
	
	//------------------------ FUNCOES DO PROTOCOLO ----------------------------- //
	
		
		
		
		
		
	//------------------------ FUNCOES DOS TRÂMITES ----------------------------- //
	
		
		public function protocolo_tramite($id){
		
			$this->db->where('id_protocolo', $id);
			$query = $this->db->get('protocolo_tramite');
		
			return $query->result();
		
		
		}
		
		public function tramite_permissao_geral($id){
			
			$this->db->select('destino');
			$this->db->where('id_protocolo', $id);
			$this->db->order_by('id', 'DESC');
			$this->db->limit(1);
			$query = $this->db->get('protocolo_tramite');
			
			
			return $query->result();
			
			
		}
		
		public function tramite_permissao_cancelar($id){
				
			$this->db->select('origem');
			$this->db->where('id_protocolo', $id);
			$this->db->order_by('id', 'DESC');
			$this->db->limit(1);
			$query = $this->db->get('protocolo_tramite');
				
				
			return $query->result();
				
				
		}
		
		public function tramite_permissao_situacao($id){
		
			$this->db->select('situacao');
			$this->db->where('id_protocolo', $id);
			$this->db->order_by('id', 'DESC');
			$this->db->limit(1);
			$query = $this->db->get('protocolo_tramite');
		
		
			return $query->result();
		
		
		}
		
		
	//------------------------ FUNCOES DOS TRÂMITES ----------------------------- //		
		
	
		
		
		
		
		
		
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
		
			$query = $this->db->get('protocolo_processo');
		
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