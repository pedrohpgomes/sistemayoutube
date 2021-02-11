<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Relatorio extends CI_Controller {

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

}