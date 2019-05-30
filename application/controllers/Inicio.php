<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {
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

		$this->relatorios_inicio($data_inicio,$data_fim);
	}

	public function relatorios_inicio($data_inicio,$data_fim){
		$mes = substr($data_inicio,5,2);

		switch ($mes) {
			case '01':
				$mes_nome = 'Janeiro';
				break;
			case '02':
				$mes_nome = 'Fevereiro';
				break;
			case '03':
				$mes_nome = 'Março';
				break;
			case '04':
				$mes_nome = 'Abril';
				break;
			case '05':
				$mes_nome = 'Maio';
				break;
			case '06':
				$mes_nome = 'Junho';
				break;
			case '07':
				$mes_nome = 'Julho';
				break;
			case '08':
				$mes_nome = 'Agosto';
				break;
			case '09':
				$mes_nome = 'Setembro';
				break;
			case '10':
				$mes_nome = 'Outubro';
				break;
			case '11':
				$mes_nome = 'Novembro';
				break;
			case '12':
				$mes_nome = 'Dezembro';
				break;
			default :
				$mes_nome = $mes;
				break;
		}

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
		// Data de ínicio 
		$date = (new DateTime($data_inicio));

		// Adiciona 1 meses a data
		$newDate = $date->sub(new DateInterval('P1M')); 

		// Altera a nova data para o último dia do mês
		$data_inicio = $newDate->modify('first day of this month')->format('Y-m-d');
		$data_fim = $newDate->modify('last day of this month')->format('Y-m-d');

		$this->relatorios_inicio($data_inicio,$data_fim);
	}

	public function incrementa_relatorios($data_inicio,$data_fim){
		// Data de ínicio 
		$date = (new DateTime($data_inicio));

		// Adiciona 1 meses a data
		$newDate = $date->add(new DateInterval('P1M')); 

		// Altera a nova data para o último dia do mês
		$data_inicio = $newDate->modify('first day of this month')->format('Y-m-d');
		$data_fim = $newDate->modify('last day of this month')->format('Y-m-d');

		$this->relatorios_inicio($data_inicio,$data_fim);
	}
}
