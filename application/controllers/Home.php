<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller {

	/*
	 * Index Page for this controller.
	 */

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		date_default_timezone_set('America/Bahia');

	}

	public function index(){
		if ($this->session->userdata('logged_in')){//valida usuario logado
			$this->load->view('view_home');
		} else{
			redirect('login','refresh');
		}
	}

	public function dashboard(){
		if ($this->session->userdata('logged_in')){//valida usuario logado
			$this->load->view('view_home');
		} else{
			redirect('home','refresh');
		}
	
	}
	
	public function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login','refresh');
	}

	public function requisicaoajax(){
		if ($this->session->userdata('logged_in')){//valida usuario logado
			$this->load->model('model_perfil');
			$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfil(null,'1');//$perfil=null;$status=1
			$dados['tela'] = 'view_requisicaoajax';
			$this->load->view('view_home', $dados);
		} else{
			redirect('login','refresh');
		}
	}

	/*
	 *AUXILIARES AJAX
	 */
	public function busca_usuario_perfil(){
		if ($this->session->userdata('logged_in')){//valida usuario logado		
			$option='';
	        //$option = "<option value ='' selected>Selecione...</option>";
			if($this->input->post('idPerfil')){
				$idPerfil = $this->input->post('idPerfil');
				$this->load->model('model_usuario');
	        	$resultadoUsuarioPerfil = $this->model_usuario->buscarUsuarioPerfil($idPerfil);
	        	if ($resultadoUsuarioPerfil != null){
	        		foreach($resultadoUsuarioPerfil as $usuario){
	        			//$option .="<option value='{$usuario->id}'>$usuario->descricao</option>";
	        			$option .= $usuario->nome."<br />";
	        		}
	        	} else {
	        		$option = "Nenhum perfil encontrado.";
	        	}
			}
			echo $option;
		}else{
			redirect('login','refresh');
		}
	}

	/*
	 *USUARIOS
	 */
	public function cadastra_usuario(){
		if (controleAcessoMenuUsuarios()){
		
			$this->load->library('form_validation');
			$this->form_validation->set_message('required','Campo %s obrigatório');
			$this->form_validation->set_message('valid_email','informe um %s válido');
			$this->form_validation->set_message('is_unique',' %s já cadastrado');
			$this->form_validation->set_rules('nome', 'nome', 'required');
			$this->form_validation->set_rules('login', 'login', 'trim|required|is_unique[usuarios.login]');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[usuarios.email]');
			$this->form_validation->set_rules('idPerfil', 'perfil de usuário', 'trim|required');
			$this->form_validation->set_rules('password', 'senha', 'trim|required|callback_check_password');
			
			if($this->input->post()){
				if ($this->form_validation->run() == TRUE){
					$usuario['nome'] = $this->input->post('nome');
					$usuario['login'] = $this->input->post('login');
					$usuario['email'] = $this->input->post('email');
					$usuario['senha'] = $this->input->post('password');
					$usuario['datacadastro'] = date("Y-m-d h:i:s");
					$usuario['perfilid'] = $this->input->post('idPerfil');
					//status = 1 por default;

					$this->load->model('model_usuario');
					$resultado = $this->model_usuario->cadastraUsuario($usuario);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Usuário cadastrado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
					}else{
						$dados['msg'] = "Erro ao cadastrar usuário!";
						$dados['msg_tipo'] = 'erro';
					}					
				}
			}
			$this->load->model('model_perfil');
			$dados['telaAtiva'] = 'usuarios';
			$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfilCadastro();
			$dados['tela'] = 'usuarios/view_cadastrousuario';
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

	public function lista_usuario($dados = null){
		if (controleAcessoMenuUsuarios()){//valida o usuario logado e verifica se tem permissão
			//$this->load->model('model_perfil');
			//$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfil();
			$this->load->model('model_usuario');
			$dados['resultadoUsuarios'] = $this->model_usuario->buscaUsuarios();

			$dados['telaAtiva'] = 'usuarios';
			$dados['tela'] = 'usuarios/view_listausuario';
			$this->load->view('view_home', $dados);

		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);
		}

	}

	public function consulta_usuario(){
		if (controleAcessoMenuUsuarios()){//valida o usuario logado e verifica se tem permissão
			if($this->input->post()){
				$this->form_validation->set_rules('id', 'id', 'trim');
				$this->form_validation->set_rules('nome', 'nome', 'trim');
				$this->form_validation->set_rules('login', 'login', 'trim');
				$this->form_validation->set_rules('email', 'email', 'trim');

				$usuario['id'] = $this->input->post('id');
				$usuario['nome'] = $this->input->post('nome');
				$usuario['login'] = $this->input->post('login');
				$usuario['email'] = $this->input->post('email');
				if (!empty($usuario['id']) ||!empty($usuario['nome']) || !empty($usuario['login']) || !empty($usuario['email'])){

					$this->load->model('model_usuario');
					$resultado = $this->model_usuario->consultaUsuario($usuario);
					if($resultado){
						$dados['telaAtiva'] = 'usuarios';
						$dados['resultadoUsuarios'] = $resultado;//mesmo campo da funcao lista_usuario
						$dados['tela'] = 'usuarios/view_listausuario';
					}else{
						$dados['msg'] = "Nenhum usuário localizado!";
						$dados['msg_tipo'] = 'erro';
						$dados['telaAtiva'] = 'usuarios';
						$dados['tela'] = 'usuarios/view_formconsultausuario';
					}
					//$this->load->view('view_home', $dados);
				}else {
					$dados['msg'] = "É necessário preencher pelo menos um dos campos para prosseguir na consulta!";
					$dados['msg_tipo'] = 'aviso';
					$dados['telaAtiva'] = 'usuarios';
					$dados['tela'] = 'usuarios/view_formconsultausuario';
					//$this->load->view('view_home', $dados);
				}
			}else if($this->input->get()){
				$id = $this->input->get('id');
				if (!empty($id)){
					$this->load->model('model_usuario');
					$resultado = $this->model_usuario->consultaUsuarioById($id);
					if($resultado){
						$this->load->model('model_perfil');
						$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfilCadastro();
						$dados['dadosUsuario'] = $resultado;
						$dados['telaAtiva'] = 'usuarios';
						$dados['tela'] = 'usuarios/view_formalterausuario';
					}else{
						$dados['msg'] = "Usuario não localizado!";
						$dados['msg_tipo'] = 'erro';
						$this->lista_usuario($dados);
					}
				} 

			} else {

			$dados['tela'] = 'usuarios/view_formconsultausuario';
			$dados['telaAtiva'] = 'usuarios';
			//$this->load->view('view_home', $dados);
			}
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			//$this->load->view('view_home', $dados);
		}
		$this->load->view('view_home', $dados);
	}

	public function atualiza_usuario(){
		if (controleAcessoMenuUsuarios()){
		
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
					$usuario['id'] = $this->input->post('id');
					$usuario['nome'] = $this->input->post('nome');
					$usuario['login'] = $this->input->post('login');
					$usuario['email'] = $this->input->post('email');
					$usuario['senha'] = $this->input->post('password');
					$usuario['perfilid'] = $this->input->post('idPerfil');
					//status = 1 por default;

					$this->load->model('model_usuario');
					$resultado = $this->model_usuario->atualizaUsuario($usuario);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Usuário atualizado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
					}else{
						$dados['msg'] = "Erro ao atualizar usuário!";
						$dados['msg_tipo'] = 'erro';
					}
					$this->lista_usuario($dados);
					
				/*}
				else{
				 $this->load->model('model_perfil');
					$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfilCadastro();
					$dados['tela'] = 'usuarios/view_cadastrousuario';
					$this->load->view('view_home', $dados);
				}
				*/
			}else {
				$dados['msg'] = "Erro ao atualizar usuário!";
				$dados['msg_tipo'] = 'erro';
				$this->load->view('view_home', $dados);
			}
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);

		}
	}

	public function profile(){
		if (controleAcessoMenuProfile()){
		
			$this->load->library('form_validation');
			$this->form_validation->set_message('required','Campo %s obrigatório');
			$this->form_validation->set_message('valid_email','informe um %s válido');
			$this->form_validation->set_message('is_unique',' %s já cadastrado');
			$this->form_validation->set_rules('nome', 'nome', 'required');
			$this->form_validation->set_rules('login', 'login', 'trim|required|is_unique[usuarios.login]');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[usuarios.email]');
			$this->form_validation->set_rules('idPerfil', 'perfil de usuário', 'trim|required');
			$this->form_validation->set_rules('password', 'senha', 'trim|required|callback_check_password');
			
			if($this->input->post()){
				if ($this->form_validation->run() == TRUE){
					$usuario['nome'] = $this->input->post('nome');
					$usuario['login'] = $this->input->post('login');
					$usuario['email'] = $this->input->post('email');
					$usuario['senha'] = $this->input->post('password');
					$usuario['datacadastro'] = date("Y-m-d h:i:s");
					$usuario['perfilid'] = $this->input->post('idPerfil');
					//status = 1 por default;

					$this->load->model('model_usuario');
					$resultado = $this->model_usuario->cadastraUsuario($usuario);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Usuário cadastrado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
					}else{
						$dados['msg'] = "Erro ao cadastrar usuário!";
						$dados['msg_tipo'] = 'erro';
					}					
				}
			}
			$this->load->model('model_perfil');
			$dados['telaAtiva'] = 'usuarios';
			$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfilCadastro();
			$dados['tela'] = 'usuarios/view_cadastrousuario';
			$this->load->view('view_home', $dados);
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);

		}
	}




}
