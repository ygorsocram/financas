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

	public function transferir()
	{
		$variaveis['contas_entrada'] = $this->m_conta->contas();
		$variaveis['contas_saida'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('cadastros/v_manuseia_transferencia', $variaveis);
		$this->load->view('v_rodape');
	}

	public function gravar()
	{
		$nome = $this->input->post('nome');
		$valor = $this->input->post('valor');
		$conta_entrada = $this->input->post('conta_entrada');
		$conta_saida = $this->input->post('conta_saida');

	$data1= array(
		'nome' => strtoupper($nome),
		'valor' => $valor,
		'id_categoria' => 28,
		'data_cadastro' => date("Y-m-d"),
		'data_efetivada' => date("Y-m-d"),
		'pago' => 'S',
		'id_conta' => $conta_entrada,
		);

	$data2= array(
		'nome' => strtoupper($nome),
		'valor' => $valor,
		'id_categoria' => 29,
		'data_cadastro' => date("Y-m-d"),
		'data_efetivada' => date("Y-m-d"),
		'pago' => 'S',
		'id_conta' => $conta_saida,
		);

		$this->m_conta->cadastrar($data1,$conta_entrada);
		$this->m_conta->cadastrar($data2,$conta_saida);

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
