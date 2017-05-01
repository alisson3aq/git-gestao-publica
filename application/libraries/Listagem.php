<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listagem {
	
		public function __construct()
		{
			
			$this->CI =& get_instance();
			
		}
		
		function permissao_tramites($identificador){
		
			$CI =& get_instance();
		
			$CI->db->where('destino', $identificador);
			$CI->db->limit(1);
			$query = $CI->db->get('protocolo_tramite');
		
			$row = $query->row();
		
			if (isset($row))
			{
				return TRUE;
			}else{
				return FALSE;
			}
		
		
		}
	

		function listar_setor($id){
			
			$query = $this->CI->db->query("SELECT * FROM cad_setores WHERE id = '$id'");
			
			$row = $query->row();
	
				if (isset($row))
				{
				        echo $row->descricao;
				}
		
		}
		
		function listar_usuario($id){
				
			$query = $this->CI->db->query("SELECT * FROM cad_usuario WHERE documento = '$id'");
				
			$row = $query->row();
		
			if (isset($row))
			{
				echo $row->nome;
			}
		
		}
		
		function listar_apelido($id){
		
			$query = $this->CI->db->query("SELECT * FROM cad_usuario WHERE documento = '$id'");
		
			$row = $query->row();
		
			if (isset($row))
			{
				echo $row->apelido;
			}
		
		}
		
		function listar_documento($id){
		
			$query = $this->CI->db->query("SELECT * FROM cad_documento WHERE id_documento = '$id'");
		
			$row = $query->row();
		
			if (isset($row))
			{
				echo $row->nome;
			}
		
		}
		
		function barcode($numero){
			
			$fino = 3;
			$largo = 6;
			$altura = 60;
		
			$barcodes[0] = '00110';
			$barcodes[1] = '10001';
			$barcodes[2] = '01001';
			$barcodes[3] = '11000';
			$barcodes[4] = '00101';
			$barcodes[5] = '10100';
			$barcodes[6] = '01100';
			$barcodes[7] = '00011';
			$barcodes[8] = '10010';
			$barcodes[9] = '01010';
		
			for($f1 = 9; $f1 >= 0; $f1--){
		
				for($f2 = 9; $f2 >= 0; $f2--){
		
					$f = ($f1 * 10) + $f2;
					$texto = '';
					for($i = 1; $i < 6; $i++){
						$texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
					}
					$barcodes[$f] = $texto;
				}
					
			}
		
		
			echo '<img ';
		
			$texto = $numero;
		
			if((strlen($texto) % 2) <> 0){
				$texto = '0' . $texto;
			}
		
			while(strlen($texto) > 0){
					
				$i = round(substr($texto, 0, 2));
				$texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
		
				if( isset($barcodes[$i]) ){
					$f = $barcodes[$i];
				}
		
				for($i = 1; $i < 11; $i+=2){
					if(substr($f, ($i-1), 1) == '0'){
						$f1 = $fino;
					}else{
						$f1 = $largo;
					}
		
					echo 'src="' . base_url() . 'assets/images/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
					echo '<img ';
						
					if(substr($f, $i, 1) == '0'){
						$f2 = $fino;
					}else{
						$f2 = $largo;
					}
						
					echo 'src="' . base_url() . 'assets/images/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
					echo '<img ';
				}
			}
			echo 'src="' . base_url() . 'assets/images/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
			echo '<img src="' . base_url() . 'assets/images/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
			echo '<img src="' . base_url() . 'assets/images/p.gif" width="1" height="'.$altura.'" border="0" />';
		
		}
		
}


