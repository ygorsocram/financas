<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_relatorio');
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

		$variaveis['categorias'] = $this->m_relatorio->listar_categorias($data_inicio,$data_fim);
		$variaveis['categorias_valor'] = $this->m_relatorio->listar_categorias_com_valor($data_inicio,$data_fim);
		$variaveis['balancos'] = $this->m_relatorio->listar_balanco($data_inicio,$data_fim);
		$variaveis['despesas_ano'] = $this->m_relatorio->despesas_por_ano($data_inicio);
		$variaveis['transacoes'] = $this->m_relatorio->listagem($data_inicio,$data_fim);
		$variaveis['somatorio_entrada'] = $this->m_relatorio->somatorio($data_inicio,$data_fim,1)->row()->valor;
		$variaveis['somatorio_saida'] = $this->m_relatorio->somatorio($data_inicio,$data_fim,2)->row()->valor;
		$variaveis['extrato_anual'] = $this->m_relatorio->extrato_anual($data_inicio);
		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;

		$this->load->view('v_cabecalho');
		$this->load->view('v_relatorio', $variaveis);
		$this->load->view('v_rodape');
  }
}