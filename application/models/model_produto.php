<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Modelo model_produto - Efetua a busca dos dados no banco
*/

class Model_produto extends CI_Model{

	public function cadastraProduto($dadosProduto = null){
		if ($dadosProduto != null){
			$this->db->insert('produto', $dadosProduto);
			return TRUE;
		}
		return FALSE;
	}

	public function buscaUnidade($id=null,$descricao=null){
		$this->db->select('*');
		$this->db->from('unidade');
		if ($id != null){
			$this->db->where('id', $id);
		}
		if ($descricao !=null){
			$this->db->where('descricao',$descricao);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function consultaProduto($dados = null){
		if ($dados != null){
			extract($dados);
			$this->db->select('*');
			$this->db->from('produto');
			$this->db->where('1=1',null);

			if(!empty($dados['id'])){
				$this->db->like('id',$dados['id']);
			}
			if(!empty($dados['descricao'])){
				$this->db->like('descricao',$dados['descricao']);
			}
			if(!empty($dados['unidade'])){
				$this->db->where('unidade',$dados['unidade']);
			}			
			$query = $this->db->get();
			if ($query->num_rows() >= 1){
				return $query->result();
			}
		}
		return false;
	}

	public function buscaProdutos($status='1'){
		$this->db->select('*');
		$this->db->from('produto');
		if($status == '1' || $status == '0'){
			$this->db->where('status',$status);
		}
		$query = $this->db->get();
		if ($query->num_rows() >= 1){
			return $query->result();
		} 
		return false;
	}

	public function consultaProdutoById($id = null){
		if ($id != null){
			$this->db->select('*');
			$this->db->from('produto');
			$this->db->where('id',$id);
			$query = $this->db->get();
			if ($query->num_rows() === 1){
				return $query->row();
			}
		}
		return false;
	}

	public function atualizaProduto($dadosProduto = null){

		if ($dadosProduto != null){
			$dadosAtualiza = array();
			$produto_bd = $this->consultaProdutoById($dadosProduto['id']);
			if ($dadosProduto['descricao'] != $produto_bd->descricao && $dadosProduto['descricao'] != null){
				//$this->db->set('descricao',$dadosProduto['descricao']);
				$dadosAtualiza['descricao'] = $dadosProduto['descricao'];
			}
			if (($dadosProduto['unidade'] != $produto_bd->unidade) && $dadosProduto['unidade'] != null){
				//$this->db->set('unidade',$dadosProduto['unidade']);
				$dadosAtualiza['unidade'] = $dadosProduto['unidade'];
			}
			if ($dadosProduto['precocusto'] != $produto_bd->precocusto && $dadosProduto['precocusto'] != null){
				//$this->db->set('precocusto',$dadosProduto['precocusto']);
				$dadosAtualiza['precocusto'] = $dadosProduto['precocusto'];
			}
			if ($dadosProduto['precovenda'] != $produto_bd->precovenda && $dadosProduto['precovenda'] != null){
				//$this->db->set('precovenda',$dadosProduto['precovenda']);
				$dadosAtualiza['precovenda'] = $dadosProduto['precovenda'];
			}
			if ($dadosProduto['qtdestoque'] != $produto_bd->qtdestoque && $dadosProduto['qtdestoque'] != null){
				//$this->db->set('qtdestoque',$dadosProduto['qtdestoque']);
				$dadosAtualiza['qtdestoque'] = $dadosProduto['qtdestoque'];
			}
			if ($dadosProduto['descontopermitido'] != $produto_bd->descontopermitido && $dadosProduto['descontopermitido'] != null){
				//$this->db->set('descontopermitido',$dadosProduto['descontopermitido']);
				$dadosAtualiza['descontopermitido'] = $dadosProduto['descontopermitido'];
			}
			if ($dadosProduto['alertaestoque'] != $produto_bd->alertaestoque && $dadosProduto['alertaestoque'] != null){
				//$this->db->set('alertaestoque',$dadosProduto['alertaestoque']);
				$dadosAtualiza['alertaestoque'] = $dadosProduto['alertaestoque'];
			}
			if ($dadosProduto['qtdvendaminima'] != $produto_bd->qtdvendaminima && $dadosProduto['qtdvendaminima'] != null){
				//$this->db->set('qtdvendaminima',$dadosProduto['qtdvendaminima']);
				$dadosAtualiza['qtdvendaminima'] = $dadosProduto['qtdvendaminima'];
			}
			if ($dadosProduto['qtdvalorminimo'] != $produto_bd->qtdvalorminimo && $dadosProduto['qtdvalorminimo'] != null){
				//$this->db->set('qtdvalorminimo',$dadosProduto['qtdvalorminimo']);
				$dadosAtualiza['qtdvalorminimo'] = $dadosProduto['qtdvalorminimo'];
			}
			if(!empty($dadosAtualiza)){
				$this->db->where('id',$dadosProduto['id']);
				$this->db->update('produto',$dadosAtualiza);
				return true;
			}
		}
		return false;
	}
		

}