<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main {

    function __construct(){
    }
    
	public function mes_nome($mes_entrada){
		switch ($mes_entrada) {
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
	return $mes_nome;
	}

	public function altera_data($data_inicio,$atributo){
		// Data de ínicio 
		$date = (new DateTime($data_inicio));

		// Adiciona 1 meses a data
		$newDate = isset($atributo)? $date->$atributo(new DateInterval('P1M')) : $date;

		// Altera a nova data para o último dia do mês
		$data_inicio = $newDate->modify('first day of this month')->format('Y-m-d');
		$data_fim = $newDate->modify('last day of this month')->format('Y-m-d');

		return ["data_inicio" => $data_inicio,
				"data_fim" => $data_fim,
			];
	}
}