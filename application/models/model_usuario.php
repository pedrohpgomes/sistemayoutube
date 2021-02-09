<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Modelo model_usuario - Efetua a busca dos dados no banco
*/

class Model_usuario extends CI_Model{

	public function login($login, $senha){
		$this->db->select('id, nome, login, email, datacadastro, dataultimoacesso,perfilid');
		$this->db->from('usuarios');
		//$this->db->where('senha',$senha);
		//$this->db->where('email', $login);
		//$this->db->or_where('login', $login);
		//$this->db->where('status','1');		
		$where = "(email = '{$login}' OR login = '{$login}') AND senha = '{$senha}' AND status = '1' ";
		$this->db->where($where);
		$this->db->limit(1);

		$query = $this->db->get();

			return $query->result();
		//} else {
		//	return FALSE;
		//}
		
	}

	public function gravarDataUltimoAcesso($idUsuario){
		$this->db->set('dataultimoacesso',date('Y-m-d H:i:s'));
		$this->db->where('id',$idUsuario);
		$this->db->update('usuarios');
	}

	public function buscarUsuarioPerfil($idPerfil){
		$this->db->select('id,nome,login');
		$this->db->from('usuarios');
		$this->db->where('perfilid',$idPerfil);
		$this->db->where('status','1');
		$query = $this->db->get();
		return $query->result();

	}

	public function cadastraUsuario($dadosUsuario = null){
		if ($dadosUsuario != null){
			$this->db->insert('usuarios', $dadosUsuario);
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	public function buscaUsuarios($status='1'){
		$this->db->select('*');
		$this->db->from('usuarios');
		if($status == '1' || $status == '0'){
			$this->db->where('status',$status);
		}
		$query = $this->db->get();
		if ($query->num_rows() >= 1){
			return $query->result();
		} 
		return false;
	}

	public function consultaUsuario($dados = null){
		if ($dados != null){
			extract($dados);
			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->where('1=1',null);

			if(!empty($dados['id'])){
				$this->db->like('id',$dados['id']);
			}
			if(!empty($dados['nome'])){
				$this->db->like('nome',$dados['nome']);
			}
			if(!empty($dados['login'])){
				$this->db->where('login',$dados['login']);
			}			
			if(!empty($dados['email'])){
				$this->db->where('email',$dados['email']);
			}
			$query = $this->db->get();
			if ($query->num_rows() >= 1){
				return $query->result();
			}
		}
		return false;
	}

	public function consultaUsuarioById($id = null){
	if ($id != null){
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if ($query->num_rows() === 1){
			return $query->row();
		}
	}
	return false;
	}

	public function atualizaUsuario($dadosUsuario = null){

		if ($dadosUsuario != null){
			$dadosAtualiza = array();
			$usuario_bd = $this->consultaUsuarioById($dadosUsuario['id']);
			if ($dadosUsuario['nome'] != $usuario_bd->nome && $dadosUsuario['nome'] != null){
				$dadosAtualiza['nome'] = $dadosUsuario['nome'];
				//$this->db->set('nome',$dadosUsuario['nome']);
			}
			if ($dadosUsuario['login'] != $usuario_bd->login && $dadosUsuario['login'] != null){
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

	//////////FAZER DEPOIS /////////////////////
	public function verificaUsuarioUnique($dados = null,$id=null){
		//verifica se os campos da tabela usuarios são únicos,excluindo o ID atual da verificacao
		//campos de login, e email

		$query = "select * from {$tabela} where";
		$this->db->select('*');
		$this->db->from($tabela);
		$this->db->except;
	}



}