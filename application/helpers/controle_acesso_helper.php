<?php

function controleAcessoMenuUsuarios(){
	/*
	 *Verifica quais sáo os perfis que podem acessar o menu "Usuarios"
	 */
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');

	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1 ||
		   $dadosSession['idPerfilUsuario'] == 2 || 
		   $dadosSession['idPerfilUsuario'] == 3 || 
		   $dadosSession['idPerfilUsuario'] == 4
		){
			return true;
		}
	}
	return false;

}
function controleAcessoMenuProfile(){
	/*
	 *Verifica se quem deseja chamar o profile é o próprio usuário
	 */
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');

	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1 ||
		   $dadosSession['idPerfilUsuario'] == 2 || 
		   $dadosSession['idPerfilUsuario'] == 3 || 
		   $dadosSession['idPerfilUsuario'] == 4 ||
		   $dadosSession['idPerfilUsuario'] == 5 ||
		   $dadosSession['idPerfilUsuario'] == 6
		){
			return true;
		}
	}
	return false;

}


function permissaoLiberada(){
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');
	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1){//Super Administrador
			return true;
		}
	}
	return false;
}

function controleAcessoMenuClientes(){
	/*
	 *Verifica quais sáo os perfis que podem acessar o menu "Clientes"
	 */
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');

	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1 ||
		   $dadosSession['idPerfilUsuario'] == 2 || 
		   $dadosSession['idPerfilUsuario'] == 3 || 
		   $dadosSession['idPerfilUsuario'] == 4
		){
			return true;
		}
	}
	return false;
}

function controleAcessoMenuProdutos(){
	/*
	 *Verifica quais sáo os perfis que podem acessar o menu "Produtos"
	 */
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');

	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1 ||
		   $dadosSession['idPerfilUsuario'] == 2 || 
		   $dadosSession['idPerfilUsuario'] == 3 || 
		   $dadosSession['idPerfilUsuario'] == 4 ||
		   $dadosSession['idPerfilUsuario'] == 5 ||
		   $dadosSession['idPerfilUsuario'] == 6
		){
			return true;
		}
	}
	return false;
}

function controleAcessoMenuPedidos(){
	/*
	 *Verifica quais sáo os perfis que podem acessar o menu "Produtos"
	 */
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');

	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1 ||
		   $dadosSession['idPerfilUsuario'] == 2 || 
		   $dadosSession['idPerfilUsuario'] == 3 || 
		   $dadosSession['idPerfilUsuario'] == 4 ||
		   $dadosSession['idPerfilUsuario'] == 5 ||
		   $dadosSession['idPerfilUsuario'] == 6
		){
			return true;
		}
	}
	return false;
}

function controleAcessoMenuRelatorios(){
	/*
	 *Verifica quais sáo os perfis que podem acessar o menu "Produtos"
	 */
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');

	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1 ||
		   $dadosSession['idPerfilUsuario'] == 2 || 
		   $dadosSession['idPerfilUsuario'] == 3 || 
		   $dadosSession['idPerfilUsuario'] == 4 

		){
			return true;
		}
	}
	return false;
}

function controleAcessoMenuAgenda(){
	/*
	 *Verifica quais sáo os perfis que podem acessar o menu "Produtos"
	 */
	$CI =& get_instance();
	$dadosSession = $CI->session->userdata('logged_in');

	if ($dadosSession){//valida usuario logado
		if($dadosSession['idPerfilUsuario'] == 1 ||
		   $dadosSession['idPerfilUsuario'] == 2 || 
		   $dadosSession['idPerfilUsuario'] == 3 || 
		   $dadosSession['idPerfilUsuario'] == 4 ||
		   $dadosSession['idPerfilUsuario'] == 5

		){
			return true;
		}
	}
	return false;
}