<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conta extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_conta');
	}

	public function index()
	{
		if (isset($_POST['data_inicio'])) {
				$data_inicio = $this->input->post('data_inicio');
				$data_fim = $this->input->post('data_fim');
		}else {
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");
		}

		$contas = $this->m_conta->contas();
		foreach ($contas -> result() as $contas) {
				$this->m_conta->atualiza_saldo($contas->id_conta);
				$this->m_conta->atualiza_pendente($contas->id_conta);
		}

		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['contas'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('v_conta', $variaveis);
		$this->load->view('v_rodape');
  }
}
