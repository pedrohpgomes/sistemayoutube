<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Modelo model_cliente - Efetua a busca dos dados no banco
*/

class Model_cliente extends CI_Model{

	public function cadastraCliente($dadosCliente = null){
		if ($dadosCliente != null){
			$this->db->insert('cliente', $dadosCliente);
			return TRUE;
		}
		return FALSE;
	}

	public function consultaCliente($dados = null){
		if ($dados != null){
			$this->db->select('*');
			$this->db->from('cliente');
			$this->db->where('1=1',null);

			if(!empty($dados['id'])){
				$this->db->where('id',$dados['id']);
			}
			if(!empty($dados['cpf'])){
				$this->db->where('cpf',$dados['cpf']);
			}	
			if(!empty($dados['nome'])){
				$this->db->like('nome',$dados['nome']);
			}
			if(!empty($dados['cnpj'])){
				$this->db->where('cnpj',$dados['cnpj']);
			}			
			if(!empty($dados['nomeFantasia'])){
				$this->db->like('nomeFantasia',$dados['nomeFantasia']);
			}
			if(!empty($dados['razaoSocial'])){
				$this->db->like('razaoSocial',$dados['razaoSocial']);
			}
			$query = $this->db->get();
			if ($query->num_rows() >= 1){
				return $query->result();
			}
		}
		return false;
	}

	public function buscaClientes($status='1'){
		$this->db->select('*');
		$this->db->from('cliente');
		if($status == '1' || $status == '0'){
			$this->db->where('status',$status);
		}
		$query = $this->db->get();
		if ($query->num_rows() >= 1){
			return $query->result();
		} 
		return false;
	}

	public function consultaClienteById($id = null){
	if ($id != null){
		$this->db->select('*');
		$this->db->from('cliente');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if ($query->num_rows() === 1){
			return $query->row();
		}
	}
	return false;
	}



	public function atualizaCliente($dadosCliente = null){

		if ($dadosCliente != null){
			$dadosAtualiza = array();
			$cliente_bd = $this->consultaClienteById($dadosCliente['id']);
			if(!empty($dadosCliente['cpf'])){
				$dadosAtualiza['cnpj'] = null;
				$dadosAtualiza['razaoSocial'] = null;
				$dadosAtualiza['nomeFantasia'] = null;
			}
			if(!empty($dadosCliente['cnpj'])){
				$dadosAtualiza['nome'] = null;
				$dadosAtualiza['cpf'] = null;
			}
			if ($dadosCliente['cpf'] != $cliente_bd->cpf && $dadosCliente['cpf'] != null){
				$dadosAtualiza['cpf'] = $dadosCliente['cpf'];

			}
			if ($dadosCliente['cnpj'] != $cliente_bd->cnpj && $dadosCliente['cnpj'] != null){
				$dadosAtualiza['cnpj'] = $dadosCliente['cnpj'];
			}
			if ($dadosCliente['razaoSocial'] != $cliente_bd->razaoSocial && $dadosCliente['razaoSocial'] != null){
				$dadosAtualiza['razaoSocial'] = $dadosCliente['razaoSocial'];
			}
			if ($dadosCliente['nomeFantasia'] != $cliente_bd->nomeFantasia && $dadosCliente['nomeFantasia'] != null){
				$dadosAtualiza['nomeFantasia'] = $dadosCliente['nomeFantasia'];
			}
			if ($dadosCliente['telefone'] != $cliente_bd->telefone && $dadosCliente['telefone'] != null){
				$dadosAtualiza['telefone'] = $dadosCliente['telefone'];
			}
			if ($dadosCliente['celular'] != $cliente_bd->celular && $dadosCliente['celular'] != null){
				$dadosAtualiza['celular'] = $dadosCliente['celular'];
			}
			if ($dadosCliente['email'] != $cliente_bd->email && $dadosCliente['email'] != null){
				$dadosAtualiza['email'] = $dadosCliente['email'];
			}
			if ($dadosCliente['cep'] != $cliente_bd->cep && $dadosCliente['cep'] != null){
				$dadosAtualiza['cep'] = $dadosCliente['cep'];
			}
			if ($dadosCliente['rua'] != $cliente_bd->rua && $dadosCliente['rua'] != null){
				$dadosAtualiza['rua'] = $dadosCliente['rua'];
			}
			if ($dadosCliente['numero'] != $cliente_bd->numero && $dadosCliente['numero'] != null){
				$dadosAtualiza['numero'] = $dadosCliente['numero'];
			}
			if ($dadosCliente['complemento'] != $cliente_bd->complemento && $dadosCliente['complemento'] != null){
				$dadosAtualiza['complemento'] = $dadosCliente['complemento'];
			}
			if ($dadosCliente['bairro'] != $cliente_bd->bairro && $dadosCliente['bairro'] != null){
				$dadosAtualiza['bairro'] = $dadosCliente['bairro'];
			}
			if ($dadosCliente['cidade'] != $cliente_bd->cidade && $dadosCliente['cidade'] != null){
				$dadosAtualiza['cidade'] = $dadosCliente['cidade'];
			}
			if ($dadosCliente['uf'] != $cliente_bd->uf && $dadosCliente['uf'] != null){
				$dadosAtualiza['uf'] = $dadosCliente['uf'];
			}


			if(!empty($dadosAtualiza)){
				$this->db->where('id',$dadosCliente['id']);
				$this->db->update('cliente',$dadosAtualiza);
				return true;
			}
		}
		return false;
		
	}



	public function verificaUnique($tabela,$campo,$valor,$id=null){
		//verifica se o campo na tabela é único,excluindo o ID atual da verificacao
		//campos de login, e email

		//$sql = "select * from {$tabela} where {$campo} = '{$valor}'";//sintaxe para SQLServer
		$sql = "SELECT * FROM {$tabela} WHERE {$campo} = '{$valor}'";//sintaxe para MySQL do PhpMyAdmin
		if ($id != null){
			//$sql = $sql." except select * from {$tabela} where id = {$id} ";sintaxe para SQLServer
			$sql = $sql." and id NOT IN ({$id})"; //sintaxe para MySQL do PhpMyAdmin
		}
	
		$query = $this->db->query($sql);
		if ($query->num_rows() >= 1){
			return $query->result();
			//echo "$campo -> $valor ---- não é único";
		}
		return false;
		//echo "$campo -> $valor ---- é único";		
	}
		

}