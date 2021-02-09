<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cliente extends CI_Controller {

	/*
	 * Index Page for this controller.
	 */

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		date_default_timezone_set('America/Bahia');

	}

	/*public function index(){
		if ($this->session->userdata('logged_in')){//valida usuario logado
			$this->load->view('view_home');
		} else{
			redirect('login','refresh');
		}
	}*/

	public function cadastra_cliente(){
		if (controleAcessoMenuClientes()){
		
			$this->load->library('form_validation');
			$this->form_validation->set_message('required','Campo %s obrigatório');
			$this->form_validation->set_message('valid_email','informe um %s válido');
			$this->form_validation->set_message('is_unique',' %s já cadastrado');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[cliente.email]');
			$this->form_validation->set_rules('cnpj', 'cnpj', 'trim|is_unique[cliente.cnpj]');
			$this->form_validation->set_rules('cpf', 'cpf', 'trim|is_unique[cliente.cpf]');
			
			if($this->input->post()){
				if ($this->form_validation->run() == TRUE){
					$cliente['razaoSocial'] = $this->input->post('razaoSocial');
					$cliente['nomeFantasia'] = $this->input->post('nomeFantasia');
					$cliente['cnpj'] = $this->input->post('cnpj');
					$cliente['cpf'] = $this->input->post('cpf');
					$cliente['telefone'] = $this->input->post('telefone');
					$cliente['celular'] = $this->input->post('celular');
					$cliente['email'] = $this->input->post('email');
					$cliente['cep'] = $this->input->post('cep');
					$cliente['rua'] = $this->input->post('rua');
					$cliente['numero'] = $this->input->post('numero');
					$cliente['complemento'] = $this->input->post('complemento');
					$cliente['bairro'] = $this->input->post('bairro');
					$cliente['cidade'] = $this->input->post('cidade');
					$cliente['uf'] = $this->input->post('uf');
					$cliente['datacadastro'] = date("Y-m-d h:i:s");
					//status = 1 por default;

					$this->load->model('model_cliente');
					$resultado = $this->model_cliente->cadastraCliente($cliente);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Cliente cadastrado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
					}else{
						$dados['msg'] = "Erro ao cadastrar cliente!";
						$dados['msg_tipo'] = 'erro';
					}					
				}
			}
			$dados['telaAtiva'] = 'clientes';
			$dados['tela'] = 'clientes/view_cadastrocliente';
			$this->load->view('view_home', $dados);
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);
		}
	}

	public function check_password($password){
		if (strlen($password) < 6 || strlen($password) >10){
			$this->form_validation->set_message('check_password',"A senha deve conter entre 6 a 10 caracteres");
			return false;
		} else{
			return true;
		}
	}
}