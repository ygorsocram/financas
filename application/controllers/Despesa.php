<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Despesa extends CI_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_despesa');
	}

	public function index()
	{
		$variaveis['despesas'] = $this->m_despesa->listagem();
		$this->load->view('v_cabecalho');
		$this->load->view('v_despesa', $variaveis);
		$this->load->view('v_rodape');
	}

	public function cadastrar()
	{
		$variaveis['categorias'] = $this->m_despesa->categorias();
		$variaveis['contas'] = $this->m_despesa->contas();
		$this->load->view('v_cabecalho');
		$this->load->view('cadastros/v_cadastro_despesa', $variaveis);
		$this->load->view('v_rodape');
	}
}
