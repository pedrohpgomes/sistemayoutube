<?php

function formata_data($dataString){
	return date('d/m/Y', strtotime($dataString));
}

function formata_perfil_id($perfilId){
	switch($perfilId){
		case '1': return 'Super Administrador';
		case '2': return 'Administrador';
		case '3': return 'Diretor';
		case '4': return 'Gerente';
		case '5': return 'Supervisor';
		case '6': return 'Representante';
		case '7': return 'Cliente';
		case '8': return 'Visitante';
		default: return 'Perfil não reconhecido';
	}
}

function formata_status($status){
	switch($status){
		case '1': return 'Ativo';
		case '0': return 'Inativo';
		default: return 'Status não reconhecido';
	}
}

function retira_acentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç)/","/(ç)/","/(Ã)/"),explode(" ","a A e E i I o O u U n N C c A"),$string);
}

function formata_unidade($unidade_id){
	$CI =& get_instance();
	$CI->load->model('model_produto');
	$busca_bd = $CI->model_produto->buscaUnidade();
	foreach($busca_bd as $item){
		if($item->id === $unidade_id){
			$return = retira_acentos("{$item->nome} - {$item->descricao}");
			$return = strtoupper($return);
			return $return;
		}
	}
}