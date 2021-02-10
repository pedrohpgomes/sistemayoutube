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
					if($this->input->post('cnpj')){
						$cliente['cnpj'] = $this->input->post('cnpj');
						$cliente['razaoSocial'] = $this->input->post('razaoSocial');
						$cliente['nomeFantasia'] = $this->input->post('nomeFantasia');
						if($cliente['cnpj'] == 0){
							$cliente['cnpj'] = null;
						}						
					} else {
						if($this->input->post('cpf')){
							$cliente['cpf'] = $this->input->post('cpf');
							$cliente['nome'] = $this->input->post('nome');
							if($cliente['cpf'] == 0){
								$cliente['cpf'] = null;
							}
						}
					}					
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

	public function lista_cliente($dados = null){
		if (controleAcessoMenuClientes()){//valida o usuario logado e verifica se tem permissão
			$this->load->model('model_cliente');
			$dados['resultadoClientes'] = $this->model_cliente->buscaClientes();
			$dados['telaAtiva'] = 'clientes';
			$dados['tela'] = 'clientes/view_listacliente';
			$this->load->view('view_home', $dados);

		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);
		}

	}

	public function consulta_cliente(){
		$this->verificaUnique('cliente','email','pmi@itabira.gov.br');
		if (controleAcessoMenuClientes()){//valida o usuario logado e verifica se tem permissão
			if($this->input->post()){
				$this->form_validation->set_rules('id', 'id', 'trim');
				$this->form_validation->set_rules('nome', 'nome', 'trim');

				$cliente['id'] = $this->input->post('id');
				$cliente['nome'] = $this->input->post('nome');
				$cliente['cpf'] = $this->input->post('cpf');
				$cliente['razaoSocial'] = $this->input->post('razaoSocial');
				$cliente['nomeFantasia'] = $this->input->post('nomeFantasia');
				$cliente['cnpj'] = $this->input->post('cnpj');
				if (!empty($cliente['id']) ||
					!empty($cliente['nome']) ||
					!empty($cliente['cpf']) ||
					!empty($cliente['razaoSocial']) ||
					!empty($cliente['nomeFantasia']) ||
					!empty($cliente['cnpj'])
				){

					$this->load->model('model_cliente');
					$resultado = $this->model_cliente->consultaCliente($cliente);
					if($resultado){
						$dados['telaAtiva'] = 'clientes';
						$dados['resultadoClientes'] = $resultado;//mesmo campo da funcao lista_usuario
						$dados['tela'] = 'clientes/view_listacliente';
					}else{
						$dados['msg'] = "Nenhum cliente localizado!";
						$dados['msg_tipo'] = 'erro';
						$dados['telaAtiva'] = 'clientes';
						$dados['tela'] = 'clientes/view_formconsultacliente';
					}
					//$this->load->view('view_home', $dados);
				}else {
					$dados['msg'] = "É necessário preencher pelo menos um dos campos para prosseguir na consulta!";
					$dados['msg_tipo'] = 'aviso';
					$dados['telaAtiva'] = 'clientes';
					$dados['tela'] = 'clientes/view_formconsultacliente';
					//$this->load->view('view_home', $dados);
				}
			}else if($this->input->get()){
				$id = $this->input->get('id');
				if (!empty($id)){
					$this->load->model('model_cliente');
					$resultado = $this->model_cliente->consultaClienteById($id);
					if($resultado){
						$this->load->model('model_cliente');
						//$dados['unidade'] = $this->model_produto->buscaUnidade();
						$dados['dadosCliente'] = $resultado;
						$dados['telaAtiva'] = 'clientes';
						$dados['tela'] = 'clientes/view_formalteracliente';
					}else{
						$dados['msg'] = "Cliente não localizado!";
						$dados['msg_tipo'] = 'erro';
						$this->lista_cliente($dados);
					}
				} 

			} else {
			$this->load->model('model_cliente');
			//$dados['unidade'] = $this->model_produto->buscaUnidade();
			$dados['tela'] = 'clientes/view_formconsultacliente';
			$dados['telaAtiva'] = 'clientes';
			//$this->load->view('view_home', $dados);
			}
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			//$this->load->view('view_home', $dados);
		}
		$this->load->view('view_home', $dados);
	}


	public function atualiza_cliente(){
		if (controleAcessoMenuClientes()){
		
			/*$this->load->library('form_validation');
			$this->form_validation->set_message('required','Campo %s obrigatório');
			$this->form_validation->set_message('valid_email','informe um %s válido');
			$this->form_validation->set_message('is_unique',' %s já cadastrado');
			$this->form_validation->set_rules('nome', 'nome', 'required');
			$this->form_validation->set_rules('login', 'login', 'trim|required|is_unique[usuarios.login]');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[usuarios.email]');
			$this->form_validation->set_rules('idPerfil', 'perfil de usuário', 'trim|required');
			$this->form_validation->set_rules('password', 'senha', 'trim|callback_check_password');
			*/

			if($this->input->post()){
				//if ($this->form_validation->run() == TRUE){
					$cliente['cpf'] = $this->input->post('cpf');
					if (!empty($cliente['cpf']){
						$cliente['nome'] = $this->input->post('nome');
					} else {
						$cliente['cnpj'] = $this->input->post('cnpj');
						$cliente['razaoSocial'] = $this->input->post('razaoSocial');
						$cliente['nomeFantasia'] = $this->input->post('nomeFantasia');
					}
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
					//status = 1 por default;

					$this->load->model('model_cliente');
					$resultado = $this->model_cliente->atualizaCliente($cliente);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Cliente atualizado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
					}else{
						$dados['msg'] = "Erro ao atualizar cliente!";
						$dados['msg_tipo'] = 'erro';
					}
					$this->lista_cliente($dados);
					
				/*}
				else{
				 $this->load->model('model_perfil');
					$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfilCadastro();
					$dados['tela'] = 'usuarios/view_cadastrousuario';
					$this->load->view('view_home', $dados);
				}
				*/
			}else {
				$dados['msg'] = "Erro ao atualizar cliente!";
				$dados['msg_tipo'] = 'erro';
				$this->load->view('view_home', $dados);
			}
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);

		}

	}
	public function verificaUnique($tabela,$campo,$valor,$id = null){
		$this->load->model('model_cliente');
		$this->model_cliente->verificaUnique($tabela,$campo,$valor,$id = null);
	}

	
}