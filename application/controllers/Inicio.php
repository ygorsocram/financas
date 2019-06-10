<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {
	function __construct(){
			parent::__construct();
	$this->load->model('m_relatorio');
	$this->load->library('main');
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

		$this->relatorios_inicio($data_inicio,$data_fim);
	}

	public function relatorios_inicio($data_inicio,$data_fim){
		$mes = substr($data_inicio,5,2);

		$mes_nome = $this->main->mes_nome($mes);

		$variaveis['data_inicio'] = $data_inicio;
		$variaveis['data_fim'] = $data_fim;
		$variaveis['categorias'] = $this->m_relatorio->listar_categorias($data_inicio,$data_fim);
		$variaveis['transacoes'] = $this->m_relatorio->listagem($data_inicio,$data_fim);
		$variaveis['somatorio_entrada'] = $this->m_relatorio->somatorio($data_inicio,$data_fim,1)->row()->valor;
		$variaveis['somatorio_saida'] = $this->m_relatorio->somatorio($data_inicio,$data_fim,2)->row()->valor;
		$variaveis['mes_nome'] = $mes_nome;

		$this->load->view('v_cabecalho');
		$this->load->view('v_inicio',$variaveis);
		$this->load->view('v_rodape');
	}

	public function decrementa_relatorios($data_inicio,$data_fim){
		$data_retorno = $this->main->altera_data($data_inicio,'sub');

		$data_inicio = $data_retorno["data_inicio"];
		$data_fim = $data_retorno["data_fim"];

		$this->relatorios_inicio($data_inicio,$data_fim);
	}

	public function incrementa_relatorios($data_inicio,$data_fim){
		$data_retorno = $this->main->altera_data($data_inicio,'add');

		$data_inicio = $data_retorno["data_inicio"];
		$data_fim = $data_retorno["data_fim"];

		$this->relatorios_inicio($data_inicio,$data_fim);
	}
}
