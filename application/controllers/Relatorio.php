<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_relatorio');
	$this->load->library('main');
	}

	public function index()
	{
		$data_inicio = date("Y-m-01");
		$data_fim = date("Y-m-t");

		$this->carrega_lista($data_inicio,$data_fim);
  }

	public function decrementa_relatorios($data_inicio,$data_fim){
		$data_retorno = $this->main->altera_data($data_inicio,'sub');

		$data_inicio = $data_retorno["data_inicio"];
		$data_fim = $data_retorno["data_fim"];

		$this->carrega_lista($data_inicio,$data_fim);
	}

	public function incrementa_relatorios($data_inicio,$data_fim){
		$data_retorno = $this->main->altera_data($data_inicio,'add');

		$data_inicio = $data_retorno["data_inicio"];
		$data_fim = $data_retorno["data_fim"];

		$this->carrega_lista($data_inicio,$data_fim);
	}

  	public function carrega_lista($data_inicio,$data_fim){
		$variaveis['categorias_valor'] = $this->m_relatorio->listar_categorias_com_valor($data_inicio,$data_fim);
		$variaveis['balancos'] = $this->m_relatorio->listar_balanco($data_inicio,$data_fim);
		$variaveis['despesas_ano'] = $this->m_relatorio->despesas_por_ano($data_inicio);
		$variaveis['somatorio_entrada'] = $this->m_relatorio->somatorio($data_inicio,$data_fim,1)->row()->valor;
		$variaveis['somatorio_saida'] = $this->m_relatorio->somatorio($data_inicio,$data_fim,2)->row()->valor;
		$variaveis['extrato_anual'] = $this->m_relatorio->extrato_anual($data_inicio);
		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;

		//--inicio nome do mes --//
		$mes = substr($data_inicio,5,2);
		$mes_nome = $this->main->mes_nome($mes);
		$variaveis['mes_nome'] = $mes_nome;
		//--fim nome do mes --//

		$this->load->view('v_cabecalho');
		$this->load->view('v_relatorio', $variaveis);
		$this->load->view('v_rodape');
  	}
}
