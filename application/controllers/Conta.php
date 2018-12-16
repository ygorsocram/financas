<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_conta');
	}

	public function index()
	{
		$variaveis['contas'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('v_conta', $variaveis);
		$this->load->view('v_rodape');
  }
}
