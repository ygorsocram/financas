<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cartao extends CI_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_transacao');
	}

	public function index()
	{
		$variaveis['cartoes'] = $this->m_transacao->cartoes();
		$variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		$this->load->view('v_cabecalho');
		$this->load->view('v_cartao', $variaveis);
		$this->load->view('v_rodape');
  }

}
