<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
Modelo model_usuario - Efetua a busca dos dados no banco
*/

class Model_perfil extends CI_Model{

	public function buscaPerfil($perfil=null,$status=null){
		$this->db->select('*');
		$this->db->from('perfil');
		if ($perfil != null){
			//se $perfil=null, busca todos;
			$perfil = ucwords(strtolower($perfil));
			$this->db->where('descricao', $perfil);
		}
		if ($status !=null){
			//1=ativo;0=inativo;null=todos;
			$this->db->where('status',$status);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function buscaPerfilCadastro(){
		$idPerfil = $_SESSION['logged_in']['idUsuario'];
		$this->db->select('*');
		$this->db->from('perfil');
		if ($idPerfil == '2'){
			//Administrador
			$this->db->where('id >=', $idPerfil);
		} else{
			if ($idPerfil >= '3'){
			//Diretor
				$this->db->where('id >', $idPerfil);
			}
		}		
		$query = $this->db->get();
		return $query->result();		
	}

}