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
			$cliente_bd = $this->consultaUsuarioById($dadosUsuario['id']);
			if(isset($dadosCliente['cpf'])){
				if ($dadosCliente['cpf'] != $cliente_bd->cpf && $dadosCliente['cpf'] != null){
					$dadosAtualiza['cpf'] = $dadosCliente['cpf'];
				}
				if ($dadosCliente['nome'] != $cliente_bd->nome && $dadosCliente['nome'] != null){
					$dadosAtualiza['nome'] = $dadosCliente['nome'];
				}
			}
			
			
			if ($dadosCliente['login'] != $usuario_bd->login && $dadosUsuario['login'] != null){
				$dadosAtualiza['login'] = $dadosUsuario['login'];
				//$this->db->set('login',$dadosUsuario['login']);
			}
			if ($dadosUsuario['email'] != $usuario_bd->email && $dadosUsuario['email'] != null){
				$dadosAtualiza['email'] = $dadosUsuario['email'];
				//$this->db->set('email',$dadosUsuario['email']);
			}
			if ($dadosUsuario['senha'] != $usuario_bd->senha && $dadosUsuario['senha'] != null){
				$dadosAtualiza['senha'] = $dadosUsuario['senha'];
				//$this->db->set('senha',$dadosUsuario['senha']);
			}
			if ($dadosUsuario['perfilid'] != $usuario_bd->perfilid && $dadosUsuario['perfilid'] != null){
				$dadosAtualiza['perfilid'] = $dadosUsuario['perfilid'];
				//$this->db->set('perfilid',$dadosUsuario['perfilid']);
			}
			if(!empty($dadosAtualiza)){
				$this->db->where('id',$dadosUsuario['id']);
				$this->db->update('usuarios',$dadosAtualiza);
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