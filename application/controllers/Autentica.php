<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Autentica extends CI_Controller {

	/**
	 * Controller de autenticacao
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model("model_usuario");
		$this->load->helper("url");

	}
	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_message('required','Campo %s obrigatório');
		$this->form_validation->set_rules('login', 'e-mail ou usuário', 'trim|required');
		$this->form_validation->set_rules('password', 'senha', 'trim|required|callback_check_database');

		//validacao de acesso a area privada		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('view_login');
		} else {
			redirect('home/dashboard','refresh');
		}
	}

	public function check_database($senha){
		$login = $this->input->post('login');
		if (!empty($senha) && !empty($login)){
			$result = $this->model_usuario->login($login,$senha);
			if (isset($result) && !empty($result)){
				foreach($result as $usuario){
					$config_array = Array(
						'idUsuario' => $usuario->id,
						'nomeUsuario' => $usuario->nome,
						'loginUsuario' => $usuario->login,
						'emailUsuario' => $usuario->email,
						'datacadastro' => $usuario->datacadastro,
						'dataultimoacesso' => $usuario->dataultimoacesso,
						'idPerfilUsuario' => $usuario->perfilid
					);
				}
				$this->session->set_userdata('logged_in', $config_array);
				$this->model_usuario->gravarDataUltimoAcesso($config_array['idUsuario']);
				return TRUE;
			} else {
				$this->form_validation->set_message('check_database',"Usuário ou senha incorreta!");
				return FALSE;
			}

		} else {
			return TRUE;
		}
		
	}
	
}
