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
		

}