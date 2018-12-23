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

	public function manusear_transferencia()
	{
		$id = $_GET['id'];

		$variaveis['id_transacao'] = $id;

		if ($id == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor'] = 0;
			$variaveis['conta_entrada'] = '';
			$variaveis['conta_saida'] = '';
		} else {
			$transacao = $this->m_conta->transacao($id);

			$variaveis['nome'] = $transacao->row()->nome;
			$variaveis['valor'] = $transacao->row()->valor;
			$variaveis['data_cadastro'] = $transacao->row()->data_cadastro;
			$variaveis['categoria'] = $transacao->row()->id_categoria;
			$variaveis['observacao'] = $transacao->row()->observacao;
			$variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($transacao->row()->id_fatura)->row()->id_cartao;
			$variaveis['id_fatura'] = $transacao->row()->id_fatura;
		 	$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
			}


		$variaveis['contas_entrada'] = $this->m_conta->contas();
		$variaveis['contas_saida'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('cadastros/v_manuseia_transferencia', $variaveis);
		$this->load->view('v_rodape');
	}

	public function gravar()
	{
		$id_transacao = $_GET['id'];

		if (isset($_POST['data_inicio'])) {
				$data_inicio = $this->input->post('data_inicio');
				$data_fim = $this->input->post('data_fim');
		}else {
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");
		}

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

		if ($id_transacao ==0) {
						$this->m_conta->cadastrar($data1);
						$this->m_conta->cadastrar($data2);
		} else {
						$this->m_conta->atualizar($data1,$id_transacao);
						$this->m_conta->atualizar($data2,$id_transacao);
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
