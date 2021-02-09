<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Produto extends CI_Controller {

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

	public function cadastra_produto(){
		if (controleAcessoMenuProdutos()){
		
			$this->load->library('form_validation');
			$this->form_validation->set_message('required','Campo %s obrigatório');
			$this->form_validation->set_message('valid_email','informe um %s válido');
			$this->form_validation->set_message('is_unique',' %s já cadastrado');
			$this->form_validation->set_rules('descricaoProduto', 'descrição', 'required|is_unique[produto.descricao]');
			$this->form_validation->set_rules('unidade', 'unidade', 'required');
			$this->form_validation->set_rules('precoCusto', 'preço de custo', 'required');
			$this->form_validation->set_rules('precoVenda', 'preço de venda', 'required');
			
			if($this->input->post()){
				
				if ($this->form_validation->run() == TRUE){

					$produto['descricao'] = $this->input->post('descricaoProduto');
					$produto['unidade'] = $this->input->post('unidade');
					$produto['precocusto'] = $this->input->post('precoCusto');
					$produto['precovenda'] = $this->input->post('precoVenda');
					$produto['qtdestoque'] = $this->input->post('qtdEstoque');
					$produto['descontopermitido'] = $this->input->post('descontoPermitido');
					$produto['alertaestoque'] = $this->input->post('alertaEstoque');
					$produto['qtdvendaminima'] = $this->input->post('qtdVendaMinima');
					$produto['qtdvalorminimo'] = $this->input->post('qtdValorMinimo');
					$produto['datacadastro'] = date("Y-m-d h:i:s");
					//status = 1 por default;

					$this->load->model('model_produto');
					$resultado = $this->model_produto->cadastraProduto($produto);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Produto cadastrado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
						$dados['tela'] = 'produtos/view_listaproduto';
					}else{
						$dados['msg'] = "Erro ao cadastrar produto!";
						$dados['msg_tipo'] = 'erro';
						$dados['tela'] = 'produtos/view_listaproduto';
					}					
				}
			} else {

			}
			$this->load->model('model_produto');
			$dados['unidade'] = $this->model_produto->buscaUnidade();
			$dados['tela'] = 'produtos/view_cadastroproduto';
			$dados['telaAtiva'] = 'produtos';
			
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
		}
		$this->load->view('view_home', $dados);
	}

	public function lista_produto($dados = null){
		if (controleAcessoMenuProdutos()){//valida o usuario logado e verifica se tem permissão
			//$this->load->model('model_perfil');
			//$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfil();
			$this->load->model('model_produto');
			$dados['resultadoProdutos'] = $this->model_produto->buscaProdutos();

			$dados['telaAtiva'] = 'produtos';
			$dados['tela'] = 'produtos/view_listaproduto';
			$this->load->view('view_home', $dados);

		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);
		}

	}

	public function consulta_produto(){
		if (controleAcessoMenuProdutos()){//valida o usuario logado e verifica se tem permissão
			if($this->input->post()){
				$this->form_validation->set_rules('id', 'id', 'trim');
				$this->form_validation->set_rules('descricao', 'descricao', 'trim');

				$produto['id'] = $this->input->post('id');
				$produto['descricao'] = $this->input->post('descricao');
				$produto['unidade'] = $this->input->post('unidade');
				if (!empty($produto['id']) ||!empty($produto['descricao']) || !empty($produto['unidade'])){

					$this->load->model('model_produto');
					$resultado = $this->model_produto->consultaProduto($produto);
					if($resultado){
						$dados['telaAtiva'] = 'produtos';
						$dados['resultadoProdutos'] = $resultado;//mesmo campo da funcao lista_usuario
						$dados['tela'] = 'produtos/view_listaproduto';
					}else{
						$dados['msg'] = "Nenhum produto localizado!";
						$dados['msg_tipo'] = 'erro';
						$dados['telaAtiva'] = 'produtos';
						$dados['tela'] = 'produtos/view_formconsultaproduto';
					}
					//$this->load->view('view_home', $dados);
				}else {
					$dados['msg'] = "É necessário preencher pelo menos um dos campos para prosseguir na consulta!";
					$dados['msg_tipo'] = 'aviso';
					$dados['telaAtiva'] = 'produtos';
					$dados['tela'] = 'produtos/view_formconsultaproduto';
					//$this->load->view('view_home', $dados);
				}
			}else if($this->input->get()){
				$id = $this->input->get('id');
				if (!empty($id)){
					$this->load->model('model_produto');
					$resultado = $this->model_produto->consultaprodutoById($id);
					if($resultado){
						$this->load->model('model_produto');
						$dados['unidade'] = $this->model_produto->buscaUnidade();
						$dados['dadosProduto'] = $resultado;
						$dados['telaAtiva'] = 'produtos';
						$dados['tela'] = 'produtos/view_formalteraproduto';
					}else{
						$dados['msg'] = "Produto não localizado!";
						$dados['msg_tipo'] = 'erro';
						$this->lista_produto($dados);
					}
				} 

			} else {
			$this->load->model('model_produto');
			$dados['unidade'] = $this->model_produto->buscaUnidade();
			$dados['tela'] = 'produtos/view_formconsultaproduto';
			$dados['telaAtiva'] = 'produtos';
			//$this->load->view('view_home', $dados);
			}
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			//$this->load->view('view_home', $dados);
		}
		$this->load->view('view_home', $dados);
	}


	public function atualiza_produto(){
		if (controleAcessoMenuProdutos()){
		
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
					$produto['id'] = $this->input->post('id');
					$produto['descricao'] = $this->input->post('descricaoProduto');
					$produto['unidade'] = $this->input->post('unidade');
					$produto['precocusto'] = $this->input->post('precoCusto');
					$produto['precovenda'] = $this->input->post('precoVenda');
					$produto['qtdestoque'] = $this->input->post('qtdEstoque');
					$produto['descontopermitido'] = $this->input->post('descontoPermitido');
					$produto['alertaestoque'] = $this->input->post('alertaEstoque');
					$produto['qtdvendaminima'] = $this->input->post('qtdVendaMinima');
					$produto['qtdvalorminimo'] = $this->input->post('qtdValorMinimo');
					//status = 1 por default;

					$this->load->model('model_produto');
					$resultado = $this->model_produto->atualizaProduto($produto);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Produto atualizado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
					}else{
						$dados['msg'] = "Erro ao atualizar produto";
						$dados['msg_tipo'] = 'erro';
					}
					$this->lista_produto($dados);
					
				/*}
				else{
				 $this->load->model('model_perfil');
					$dados['resultadoPerfil'] = $this->model_perfil->buscaPerfilCadastro();
					$dados['tela'] = 'usuarios/view_cadastrousuario';
					$this->load->view('view_home', $dados);
				}
				*/
			}else {
				$dados['msg'] = "Erro ao atualizar produto!";
				$dados['msg_tipo'] = 'erro';
				$this->load->view('view_home', $dados);
			}
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
			$this->load->view('view_home', $dados);

		}
	}






}