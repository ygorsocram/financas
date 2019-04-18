<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transacao extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_transacao');
	}

	public function index($id_tipo,$data_inicio,$data_fim,$categoria)
	{
		if ($categoria == 0) {
			if (isset($_POST['categoria'])) {
				$data_inicio = $this->input->post('data_inicio');
				$data_fim = $this->input->post('data_fim');
				$categoria = $this->input->post('categoria');
			}else {
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");
				$categoria = 0;
			}
		}

		if($categoria == 0){
			$valor_transacao_total = $this->m_transacao->somatorio_transacao($data_inicio,$data_fim,$id_tipo)->row()->valor;
			$valor_transacao_pago = $this->m_transacao->somatorio_transacao_paga($data_inicio,$data_fim,$id_tipo)->row()->valor;
} else {
			$valor_transacao_total = $this->m_transacao->somatorio_transacao_categoria($data_inicio,$data_fim,$id_tipo,$categoria)->row()->valor;
			$valor_transacao_pago = $this->m_transacao->somatorio_transacao_paga_categoria($data_inicio,$data_fim,$id_tipo,$categoria)->row()->valor;
}
		$variaveis['valor_transacao_total'] = $valor_transacao_total;
		if($valor_transacao_pago>0) {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total - $valor_transacao_pago;
			$variaveis['valor_transacao_pago'] = $valor_transacao_pago;
 		} else {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total;
			$variaveis['valor_transacao_pago'] = 0;
 		}

		if ($categoria == 0) $variaveis['transacoes'] = $this->m_transacao->listagem($data_inicio,$data_fim,$id_tipo);
									 else $variaveis['transacoes'] = $this->m_transacao->listagem_com_categoria($data_inicio,$data_fim,$id_tipo,$categoria);

		$variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		$variaveis['id_tipo'] = $id_tipo;
		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['categorias'] = $this->m_transacao->categorias($id_tipo);
		$variaveis['categoria'] = $categoria;


		$this->load->view('v_cabecalho');
		$this->load->view('v_transacao', $variaveis);
		$this->load->view('v_rodape');
	}


	public function manusear($id_tipo,$id,$data_inicio,$data_fim,$categoria)
	{
		$variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		$variaveis['id_transacao'] = $id;
		$variaveis['categorias'] = $this->m_transacao->categorias($id_tipo);
		$variaveis['contas'] = $this->m_transacao->contas();
		$variaveis['tags'] = $this->m_transacao->tags();
		$variaveis['id_tipo'] = $id_tipo;
		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;

		if ($id == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor'] = '';
			$variaveis['pago'] = '';
			$variaveis['data_cadastro'] = date("Y-m-d");
			$variaveis['categoria'] = $categoria;
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

	public function gravar($id_tipo,$id_transacao,$data_inicio,$data_fim,$categoria)
	{
		if (!isset($data_inicio)) {
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");
				$categoria = 0;
		}

		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['categorias'] = $this->m_transacao->categorias($id_tipo);

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

		$valor_transacao_total = $this->m_transacao->somatorio_transacao($data_inicio,$data_fim,$id_tipo)->row()->valor;
		$valor_transacao_pago = $this->m_transacao->somatorio_transacao_paga($data_inicio,$data_fim,$id_tipo)->row()->valor;
		$variaveis['valor_transacao_total'] = $valor_transacao_total;
		if($valor_transacao_pago>0) {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total - $valor_transacao_pago;
			$variaveis['valor_transacao_pago'] = $valor_transacao_pago;
 		} else {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total;
			$variaveis['valor_transacao_pago'] = 0;
 		}

		  $variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		if ($categoria == 0) $variaveis['transacoes'] = $this->m_transacao->listagem($data_inicio,$data_fim,$id_tipo);
		else $variaveis['transacoes'] = $this->m_transacao->listagem_com_categoria($data_inicio,$data_fim,$id_tipo,$categoria);
			$variaveis['id_tipo'] = $id_tipo;
			$variaveis['categoria'] = $categoria;
			$this->load->view('v_cabecalho');
			$this->load->view('v_transacao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function excluir($id_tipo,$transacao,$data_inicio,$data_fim,$categoria)
	{
		$this->m_transacao->excluir($transacao);

		redirect("transacao/index/$id_tipo/$data_inicio/$data_fim/$categoria");
	}

	public function pagar($id_tipo,$transacao,$data_inicio,$data_fim,$categoria)
	{
		if (!isset($categoria)) {
			if (isset($_POST['categoria'])) {
				$data_inicio = $this->input->post('data_inicio');
				$data_fim = $this->input->post('data_fim');
				$categoria = $this->input->post('categoria');
			}else {
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");
				$categoria = 0;
			}
		}

		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['categorias'] = $this->m_transacao->categorias($id_tipo);
		$variaveis['categoria'] = $categoria;

		$this->m_transacao->pagar($transacao);

		$valor_transacao_total = $this->m_transacao->somatorio_transacao($data_inicio,$data_fim,$id_tipo)->row()->valor;
		$valor_transacao_pago = $this->m_transacao->somatorio_transacao_paga($data_inicio,$data_fim,$id_tipo)->row()->valor;
		$variaveis['valor_transacao_total'] = $valor_transacao_total;
		if($valor_transacao_pago>0) {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total - $valor_transacao_pago;
			$variaveis['valor_transacao_pago'] = $valor_transacao_pago;
 		} else {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total;
			$variaveis['valor_transacao_pago'] = 0;
 		}

		 $variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		if ($categoria == 0) $variaveis['transacoes'] = $this->m_transacao->listagem($data_inicio,$data_fim,$id_tipo);
									 else $variaveis['transacoes'] = $this->m_transacao->listagem_com_categoria($data_inicio,$data_fim,$id_tipo,$categoria);
			$variaveis['id_tipo'] = $id_tipo;
			$this->load->view('v_cabecalho');
			$this->load->view('v_transacao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function cancelar_pagamento($transacao,$id_tipo,$data_inicio,$data_fim,$categoria)
	{
		if (!isset($categoria)) {
			if (isset($_POST['categoria'])) {
				$data_inicio = $this->input->post('data_inicio');
				$data_fim = $this->input->post('data_fim');
				$categoria = $this->input->post('categoria');
		}else {
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");
				$categoria = 0;
			}
		}
		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['categorias'] = $this->m_transacao->categorias($id_tipo);
		$variaveis['categoria'] = $categoria;

		$this->m_transacao->cancelar_pagamento($transacao);

		$valor_transacao_total = $this->m_transacao->somatorio_transacao($data_inicio,$data_fim,$id_tipo)->row()->valor;
		$valor_transacao_pago = $this->m_transacao->somatorio_transacao_paga($data_inicio,$data_fim,$id_tipo)->row()->valor;
		$variaveis['valor_transacao_total'] = $valor_transacao_total;
		if($valor_transacao_pago>0) {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total - $valor_transacao_pago;
			$variaveis['valor_transacao_pago'] = $valor_transacao_pago;
 		} else {
 			$variaveis['valor_transacao_restante'] = $valor_transacao_total;
			$variaveis['valor_transacao_pago'] = 0;
 		}

		  $variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		if ($categoria == 0) $variaveis['transacoes'] = $this->m_transacao->listagem($data_inicio,$data_fim,$id_tipo);
									 else $variaveis['transacoes'] = $this->m_transacao->listagem_com_categoria($data_inicio,$data_fim,$id_tipo,$categoria);
			$variaveis['id_tipo'] = $id_tipo;
			$this->load->view('v_cabecalho');
			$this->load->view('v_transacao', $variaveis);
			$this->load->view('v_rodape');
	}
}
