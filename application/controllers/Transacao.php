<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transacao extends CI_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_transacao');
	}

	public function index()
	{
		$id_tipo = $_GET['id_tipo'];

		$variaveis['transacoes'] = $this->m_transacao->listagem($id_tipo,'');
		$variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		$variaveis['id_tipo'] = $id_tipo;
		$this->load->view('v_cabecalho');
		$this->load->view('v_transacao', $variaveis);
		$this->load->view('v_rodape');
	}

	public function manusear()
	{
		$id_tipo = $_GET['id_tipo'];
		$id = $_GET['id'];

		$variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		$variaveis['id_transacao'] = $id;
		$variaveis['categorias'] = $this->m_transacao->categorias($id_tipo);
		$variaveis['contas'] = $this->m_transacao->contas();
		$variaveis['tags'] = $this->m_transacao->tags();
		$variaveis['id_tipo'] = $id_tipo;
		$variaveis['data'] = date("Y-m-d");

		if ($id == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor'] = '';
			$variaveis['pago'] = '';
			$variaveis['data_cadastro'] = date("Y-m-d");
			$variaveis['categoria'] = '';
			$variaveis['conta'] = '';
			$variaveis['observacao'] = '';
		} else {
			$transacao = $this->m_transacao->transacao($id);
			$pago = $transacao->row()->pago;

			if ($pago == 'S') $pago = 'checked';
									 else $pago = '';

			$variaveis['nome'] = $transacao->row()->nome;
			$variaveis['valor'] = $transacao->row()->valor;
			$variaveis['pago'] = $pago;
			$variaveis['data_cadastro'] = $transacao->row()->data_cadastro;
			$variaveis['categoria'] = $transacao->row()->id_categoria;
			$variaveis['conta'] = $transacao->row()->id_conta;
			$variaveis['observacao'] = $transacao->row()->observacao;
			}

			$this->load->view('v_cabecalho');
			$this->load->view('cadastros/v_manuseia_transacao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function gravar()
	{
		$id_tipo = $_GET['id_tipo'];
		$id_transacao = $_GET['id'];

		$nome = $this->input->post('nome');
		$valor = $this->input->post('valor');
		$pago = $this->input->post('pago');
		$data = $this->input->post('data');
		$categoria = $this->input->post('categoria');
		$conta = $this->input->post('conta');
		$observacao = $this->input->post('observacao');

		if ($pago) $pago = 'S';
				  else $pago = 'N';

		$data= array(
			'nome' => $nome,
			'valor' => $valor,
			'pago' => $pago,
			'data_cadastro' => $data,
			'id_categoria' => $categoria,
			'id_conta' => $conta,
			'observacao' => $observacao
			);

		if ($id_transacao ==0) {
				$this->m_transacao->cadastrar($data);
		} else {
				$this->m_transacao->atualizar($data,$id_transacao);
		}

		  $variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
			$variaveis['transacoes'] = $this->m_transacao->listagem($id_tipo,'');
			$variaveis['id_tipo'] = $id_tipo;
			$this->load->view('v_cabecalho');
			$this->load->view('v_transacao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function excluir()
	{
		$transacao = $_GET['id'];

		$this->m_transacao->excluir($transacao);

		$id_tipo = $_GET['id_tipo'];

		  $variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
			$variaveis['transacoes'] = $this->m_transacao->listagem($id_tipo,'');
			$variaveis['id_tipo'] = $id_tipo;
			$this->load->view('v_cabecalho');
			$this->load->view('v_transacao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function pagar()
	{
		$transacao = $_GET['id'];

		$this->m_transacao->pagar($transacao);

		$id_tipo = $_GET['id_tipo'];

		  $variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
			$variaveis['transacoes'] = $this->m_transacao->listagem($id_tipo,'');
			$variaveis['id_tipo'] = $id_tipo;
			$this->load->view('v_cabecalho');
			$this->load->view('v_transacao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function cancelar_pagamento()
	{
		$transacao = $_GET['id'];

		$this->m_transacao->cancelar_pagamento($transacao);

		$id_tipo = $_GET['id_tipo'];

		  $variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
			$variaveis['transacoes'] = $this->m_transacao->listagem($id_tipo,'');
			$variaveis['id_tipo'] = $id_tipo;
			$this->load->view('v_cabecalho');
			$this->load->view('v_transacao', $variaveis);
			$this->load->view('v_rodape');
	}
}
