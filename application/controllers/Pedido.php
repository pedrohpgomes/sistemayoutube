<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pedido extends CI_Controller {

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

	public function cadastra_pedido(){
		if (controleAcessoMenuPedidos()){
		
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

}