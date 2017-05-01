<?php

function geraCodigo(){

	date_default_timezone_set('America/Fortaleza');

	$CI =& get_instance();

	$CI->db->limit(1);
	$CI->db->order_by('id_protocolo', 'DESC');
	$query = $CI->db->get('protocolo_processo');

	$resultado = '0';

	foreach ($query->result() as $row ) {
		$resultado = $row->id_protocolo;

	}

	$soma = $resultado + 1;

	$gera_protocolo =  str_pad($soma, 7, '0', STR_PAD_LEFT) . '.' .  $CI->session->userdata('setor_lotacao'). '.' .date('dm.Y');

	echo $gera_protocolo;


}

function juntaCodigo($codigo){

	$parte1 = substr($codigo, 0, 7);
	$parte2 = substr($codigo, 8, 1);
	$parte3 = substr($codigo, 10, 4);
	$parte4 = substr($codigo, 15, 4);

	return "$parte1$parte2$parte3$parte4";

}

function separaCodigo($codigo){

	$parte1 = substr($codigo, 0, 7);
	$parte2 = substr($codigo, 7, 1);
	$parte3 = substr($codigo, 8, 4);
	$parte4 = substr($codigo, 12, 4);

	return "$parte1.$parte2.$parte3.$parte4";

}

function listar_setor($dados){

	$sql = "SELECT * FROM cad_setores WHERE id = '$dados'";
	$query = $mysqli->query($sql);
	
	$dados = $query->mysqli_fetch_array();
	
	return $dados['descricao'];
	
}


function permissao($identificador){
	
	$CI =& get_instance();
		
	if ($identificador === $CI->session->userdata('setor_lotacao'))
	{
		return TRUE;
	}else{
		return FALSE;
	}
		
		
}

function permissao_concluir($identificador, $recebido){

	$CI =& get_instance();

	if (($recebido === 'S') AND ($identificador === $CI->session->userdata('setor_lotacao')))
	{
		return TRUE;
	}else{
		return FALSE;
	}

}

function permissao_cancelar($identificador, $recebido){

	$CI =& get_instance();

	if(($recebido === 'N') AND ($identificador === $CI->session->userdata('setor_lotacao')))
	{
		return TRUE;
	}else{
		return FALSE;
	}


}


function verifica_situacao($status, $situacao, $identificador){
	
	$CI =& get_instance();

	if (($status === $situacao) AND ($identificador === $CI->session->userdata('setor_lotacao')))
	{
		return TRUE;
	}else{
		return FALSE;
	}

}

function permissao_encerrado($status1, $status2){

	$CI =& get_instance();

	if(($status1 === '5') OR ($status2 === '6'))
	{
		return TRUE;
	}else{
		return FALSE;
	}


}


