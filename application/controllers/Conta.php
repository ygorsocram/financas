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
				$this->m_conta->atualiza_pendente($contas->id_conta,$data_inicio,$data_fim);
		}

		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['contas'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('v_conta', $variaveis);
		$this->load->view('v_rodape');
  }

	public function manusear_transferencia($id,$id_tipo)
	{
		$variaveis['id_transacao'] = $id;
		$variaveis['id_tipo'] = $id_tipo;

		if ($id == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor'] = 0;
			$variaveis['conta_entrada'] = '';
			$variaveis['conta_saida'] = '';
		} else {
			if ($id_tipo==1) {
			$transacao_entrada = $this->m_conta->transacao($id);
			$transacao_saida = $this->m_conta->transacao($this->m_conta->transferencia($id,$id_tipo)->row()->id_saida);

			$variaveis['nome'] = $transacao_entrada->row()->nome;
			$variaveis['valor'] = $transacao_entrada->row()->valor;
			$variaveis['conta_entrada'] = $transacao_entrada->row()->id_conta;
			$variaveis['conta_saida'] = $transacao_saida->row()->id_conta;
			} else {
			$transacao_entrada = $this->m_conta->transacao($this->m_conta->transferencia($id,$id_tipo)->row()->id_entrada);
			$transacao_saida = $this->m_conta->transacao($id);

			$variaveis['nome'] = $transacao_saida->row()->nome;
			$variaveis['valor'] = $transacao_saida->row()->valor;
			$variaveis['conta_entrada'] = $transacao_entrada->row()->id_conta;
			$variaveis['conta_saida'] = $transacao_saida->row()->id_conta;
			}
			}


		$variaveis['contas_entrada'] = $this->m_conta->contas();
		$variaveis['contas_saida'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('cadastros/v_manuseia_transferencia', $variaveis);
		$this->load->view('v_rodape');
	}

	public function gravar($id_transacao,$id_tipo)
	{
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

		if ($id_transacao == 0) {
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


						$id_entrada =$this->m_conta->cadastrar_transferencia($data1);
						$id_saida = $this->m_conta->cadastrar_transferencia($data2);

					$data3= array(
						'id_entrada' => $id_entrada,
						'id_saida' => $id_saida,
						);

						$this->m_conta->cadastrar($data3,'transferencia_transacao');
		} else {
			if ($id_tipo==1) {
						$transacao_entrada = $this->m_conta->transacao($id_transacao);
						$transacao_saida = $this->m_conta->transacao($this->m_conta->transferencia($id_transacao,$id_tipo)->row()->id_saida);
			} else {
						$transacao_entrada = $this->m_conta->transacao($this->m_conta->transferencia($id_transacao,$id_tipo)->row()->id_entrada);
						$transacao_saida = $this->m_conta->transacao($id_transacao);
			}
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

						$this->m_conta->atualizar($data1,$transacao_entrada->row()->id_transacao);
						$this->m_conta->atualizar($data2,$transacao_saida->row()->id_transacao);
		}

		$contas = $this->m_conta->contas();
		foreach ($contas -> result() as $contas) {
				$this->m_conta->atualiza_saldo($contas->id_conta);
				$this->m_conta->atualiza_pendente($contas->id_conta,$data_inicio, $data_fim);
		}

		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['contas'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('v_conta', $variaveis);
		$this->load->view('v_rodape');
	}

	public function excluir($id_transacao,$id_tipo,$data_inicio,$data_fim,$categoria)
	{
			if !(isset($data_inicio) {
				$data_inicio = date("Y-m-01");
				$data_fim = date("Y-m-t");
				$categoria = 0;
		}
		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;

			if ($id_tipo==1) {
						$transacao_entrada = $this->m_conta->transacao($id_transacao);
						$transacao_saida = $this->m_conta->transacao($this->m_conta->transferencia($id_transacao,$id_tipo)->row()->id_saida);
			} else {
						$transacao_entrada = $this->m_conta->transacao($this->m_conta->transferencia($id_transacao,$id_tipo)->row()->id_entrada);
						$transacao_saida = $this->m_conta->transacao($id_transacao);
			}

		$id_transferencia = $this->m_conta->transferencia($id_transacao,$id_tipo)->row()->id_transferencia;

		$this->m_conta->excluir($id_transferencia,'transferencia_transacao','id_transferencia');
		$this->m_conta->excluir($transacao_entrada->row()->id_transacao,'transacoes','id_transacao');
		$this->m_conta->excluir($transacao_saida->row()->id_transacao,'transacoes','id_transacao');

		$variaveis['contas'] = $this->m_conta->contas();

		$this->load->view('v_cabecalho');
		$this->load->view('v_conta', $variaveis);
		$this->load->view('v_rodape');
		}
}
