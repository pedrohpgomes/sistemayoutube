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

	public function novo_pedido(){
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

					$pedido['descricao'] = $this->input->post('descricaoProduto');
					$pedido['unidade'] = $this->input->post('unidade');
					$pedido['precocusto'] = $this->input->post('precoCusto');
					$pedido['precovenda'] = $this->input->post('precoVenda');
					
					$produto['datacadastro'] = date("Y-m-d h:i:s");
					//status = 1 por default;

					$this->load->model('model_pedido');
					$resultado = $this->model_pedido->cadastraPedido($pedido);
					if($resultado){
						//$dados['tela'] = 'view_dashboard';
						$dados['msg'] = "Pedido cadastrado com sucesso";
						$dados['msg_tipo'] = 'sucesso';
						$dados['tela'] = 'pedidos/view_listapedido';
					}else{
						$dados['msg'] = "Erro ao cadastrar pedido!";
						$dados['msg_tipo'] = 'erro';
						$dados['tela'] = 'produtos/view_listapedido';
					}					
				}
			} else {
				$this->load->model("model_produto");
				$resultadoProdutos = $this->model_produto->buscaProdutos();
				$dados['resultadoProdutos'] = $resultadoProdutos;
			}
			
			$dados['tela'] = 'pedidos/view_cadastropedido';
			$dados['telaAtiva'] = 'pedidos';
			
		} else {
			$dados['msg'] = "Você não tem permissão para executar esta ação.";
			$dados['msg_tipo'] = 'erro';
		}
		$this->load->view('view_home', $dados);
	}

}