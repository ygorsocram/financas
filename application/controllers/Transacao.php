<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transacao extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_transacao');
	$this->load->library('main');
	}

	public function index($id_tipo)
	{
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");

		$this->carrega_lista($id_tipo,$data_inicio,$data_fim);
	}

	public function decrementa_relatorios($id_tipo,$data_inicio,$data_fim){
		$data_retorno = $this->main->altera_data($data_inicio,'sub');

		$data_inicio = $data_retorno["data_inicio"];
		$data_fim = $data_retorno["data_fim"];

		$this->carrega_lista($id_tipo,$data_inicio,$data_fim);
	}

	public function incrementa_relatorios($id_tipo,$data_inicio,$data_fim){
		$data_retorno = $this->main->altera_data($data_inicio,'add');

		$data_inicio = $data_retorno["data_inicio"];
		$data_fim = $data_retorno["data_fim"];

		$this->carrega_lista($id_tipo,$data_inicio,$data_fim);
	}

	public function carrega_lista($id_tipo,$data_inicio,$data_fim) {
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

		$variaveis['transacoes'] = $this->m_transacao->listagem($data_inicio,$data_fim,$id_tipo);

		//--inicio nome do mes --//
		$mes = substr($data_inicio,5,2);
		$mes_nome = $this->main->mes_nome($mes);
		$variaveis['mes_nome'] = $mes_nome;
		//--fim nome do mes --//

		$variaveis['nome_tipo'] = $this->m_transacao->nome_tipo($id_tipo)->row()->nome;
		$variaveis['id_tipo'] = $id_tipo;
		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['categorias'] = $this->m_transacao->categorias($id_tipo);


		$this->load->view('v_cabecalho');
		$this->load->view('v_transacao', $variaveis);
		$this->load->view('v_rodape');
	}

	public function manusear($id_tipo,$id,$data_inicio,$data_fim)
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

	public function gravar($id_tipo,$id_transacao)
	{
		$nome = $this->input->post('nome');
		$valor = $this->input->post('valor');
		$pago = $this->input->post('pago');
		$data = $this->input->post('data');
		$categoria = $this->input->post('categoria');
		$conta = $this->input->post('conta');
		$observacao = $this->input->post('observacao');

		if ($pago) $pago = 'S';
				  else $pago = 'N';

		$dados_insere= array(
			'nome' => $nome,
			'valor' => $valor,
			'pago' => $pago,
			'data_cadastro' => $data,
			'id_categoria' => $categoria,
			'id_conta' => $conta,
			'observacao' => $observacao
			);

		if ($id_transacao ==0) {
				$this->m_transacao->cadastrar($dados_insere);
		} else {
				$this->m_transacao->atualizar($dados_insere,$id_transacao);
		}

		$data_retorno = $this->main->altera_data($data,NULL);

		$data_inicio = $data_retorno["data_inicio"];
		$data_fim = $data_retorno["data_fim"];

		redirect("transacao/carrega_lista/$id_tipo/$data_inicio/$data_fim");
	}

	public function excluir($id_tipo,$transacao,$data_inicio,$data_fim)
	{
		$this->m_transacao->excluir($transacao);

		redirect("transacao/carrega_lista/$id_tipo/$data_inicio/$data_fim");
	}

	public function pagar($id_tipo,$transacao,$data_inicio,$data_fim)
	{
		$this->m_transacao->pagar($transacao);

		redirect("transacao/carrega_lista/$id_tipo/$data_inicio/$data_fim");
	}

	public function cancelar_pagamento($id_tipo,$transacao,$data_inicio,$data_fim)
	{

		$this->m_transacao->cancelar_pagamento($transacao);

		redirect("transacao/carrega_lista/$id_tipo/$data_inicio/$data_fim");
	}
}
