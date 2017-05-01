<?php


function tipo_documento($tipo){

	switch($tipo){
		case 1:
			$out = "Decreto do Executivo";
			break;
		case 2:
			$out = "Decreto do Legislativo";
			break;
		case 3:
			$out = "Ata";
			break;
		case 4:
			$out = "Emenda";
			break;
		case 5:
			$out = "Emenda à Lei Orgânica";
			break;
		case 6:
			$out = "Lei Complementar";
			break;
		case 7:
			$out = "Lei Ordinária";
			break;
		case 8:
			$out = "Lei Orgânica do Município";
			break;
		case 9:
			$out = "Lei Promulgada";
			break;
		case 10:
			$out = "Projeto de Lei";
			break;
		case 11:
			$out = "Resolução";
			break;
		case 12:
			$out = "Requerimento";
			break;
		case 13:
			$out = "Portaria";
			break;
		case 14:
			$out = "Indicação";
			break;
		case 15:
			$out = "Projeto de Decreto Legislativo";
			break;
		case 16:
			$out = "Projeto de Resolução";
			break;
	}
	return $out;
}



