<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cartao extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_cartao');
	}

	public function index()
	{
		$variaveis['cartoes'] = $this->m_cartao->cartoes();
		$variaveis['pagina'] = 'Cartões de Crédito';
		$this->load->view('v_cabecalho');
		$this->load->view('cartao/v_cartao', $variaveis);
		$this->load->view('v_rodape');
  }

  	public function manuseia_dados_cartao($id_cartao)
	{
		$cartoes = $this->m_cartao->lista_cartao($id_cartao);

		$variaveis['id_cartao'] = $id_cartao;
		$variaveis['nome'] = $cartoes->row()->nome;
		$variaveis['dia_fechamento'] = $cartoes->row()->dia_fechamento;
		$variaveis['dia_pagamento'] = $cartoes->row()->dia_pagamento;
		$variaveis['valor_limite'] = $cartoes->row()->vlr_limite;
		$variaveis['bandeira'] = $cartoes->row()->id_bandeira;
		$variaveis['conta'] = $cartoes->row()->id_conta;
		$variaveis['bandeiras'] = $this->m_cartao->bandeiras();
		$variaveis['contas'] = $this->m_cartao->contas() ;

		$this->load->view('v_cabecalho');
		$this->load->view('cadastros/v_manuseia_cadastro_cartao', $variaveis);
		$this->load->view('v_rodape');
  }

  	public function gravar_dados_cartao($id_cartao)
	{
		$nome = $this->input->post('nome');
		$dia_fechamento = $this->input->post('dia_fechamento');
		$dia_pagamento = $this->input->post('dia_pagamento');
		$valor_limite = $this->input->post('valor_limite');
		$bandeira = $this->input->post('bandeira');
		$conta = $this->input->post('conta');
		
		$dados= array(
			'nome' => $nome,
			'vlr_limite' => $valor_limite,
			'dia_fechamento' => $dia_fechamento,
			'dia_pagamento' => $dia_pagamento,
			'id_bandeira' => $bandeira,
			'id_conta' => $conta
			);

		if ($id_cartao == 0) {
				$id_nova_transacao = $this->m_cartao->cadastrar($dados,'cartoes');
			} else {
				$this->m_cartao->atualizar($dados,'id_cartao',$id_cartao,'cartoes');
			}

		redirect('cartao');
	}

	public function acessar_faturas($id_cartao)
	{
		$variaveis['faturas'] = $this->m_cartao->lista_fatura($id_cartao);
		$variaveis['nome_fatura'] = $this->m_cartao->nome_fatura($id_cartao)->row()->nome_fatura;
		$variaveis['pagina'] = 'Faturas';
		$variaveis['id_cartao'] = $id_cartao;

		$this->load->view('v_cabecalho');
		$this->load->view('cartao/v_fatura', $variaveis);
		$this->load->view('v_rodape');
  }

  public function acessar_fatura_atual($id_cartao)
  {
	$arr = explode("-", date("Y-m-01"));
	$mes = $arr[1]+ 1;
	$data_inicio = "$arr[0]-$mes/01";
	$data_fim = "$arr[0]-$mes/28";
	$fatura_atual = $this->m_cartao->fatura_atual($id_cartao,$data_inicio,$data_fim)->row()->id_fatura;

	redirect("cartao/acessar_lancamento/{$fatura_atual}");
}

  	public function decrementa_fatura($id_cartao,$id_fatura)
  	{
		$contador = $id_fatura;
		
		while ($contador<>0) {
			$contador--;
			$decremento_fatura = $this->m_cartao->recupera_id_fatura($id_cartao,$contador);
  
			if ($decremento_fatura->num_rows()<>0) {
				$id_decremento_fatura = $decremento_fatura->row()->id_fatura;
				redirect("cartao/acessar_lancamento/{$id_decremento_fatura}");
			}
		}
  
		redirect("cartao/acessar_lancamento/{$id_fatura}");
	}

	public function incrementa_fatura($id_cartao,$id_fatura)
	{
	  $contador = $id_fatura;
	  $fim = $this->m_cartao->recupera_ultimo_id_fatura($id_cartao)->row()->id_fatura;
	  
	  while ($contador<>$fim) {
		  $contador++;
		  $incremento_fatura = $this->m_cartao->recupera_id_fatura($id_cartao,$contador);

		  if ($incremento_fatura->num_rows()<>0) {
			  $id_incremento_fatura = $incremento_fatura->row()->id_fatura;
			  redirect("cartao/acessar_lancamento/{$id_incremento_fatura}");
		  }
	  }

	  redirect("cartao/acessar_lancamento/{$id_fatura}");
  }

	public function acessar_lancamento($id_fatura)
	{
		$variaveis['lancamentos'] = $this->m_cartao->listagem($id_fatura);
		$variaveis['dt_vencimento'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->dt_vencimento;
		$variaveis['nome_fatura'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->nome;
		$variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->id_cartao;
		$variaveis['pagina'] = 'Lançamentos';
		$variaveis['id_fatura'] = $id_fatura;
		$variaveis['valor_fatura'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->vlr_fatura;
		$variaveis['valor_fatura_aberto'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->vlr_fatura_aberto;

		$this->load->view('v_cabecalho');
		$this->load->view('cartao/v_lancamento', $variaveis);
		$this->load->view('v_rodape');
	}

	public function manusear_cartao($id,$id_cartao,$id_fatura)
	{
		$variaveis['id_transacao'] = $id;
		$variaveis['categorias'] = $this->m_cartao->listar_categorias('2');
		$variaveis['cartoes'] = $this->m_cartao->listar_cartoes();
		$variaveis['data'] = date("Y-m-d");

		if ($id == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor'] = '';
			$variaveis['parcela'] = '1';
			$variaveis['data_cadastro'] = date("Y-m-d");
			$variaveis['categoria'] = '';
			$variaveis['id_cartao'] = $id_cartao;
			$variaveis['id_fatura'] = $id_fatura;
			$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
			$variaveis['observacao'] = '';
		} else {
			$transacao = $this->m_cartao->transacao($id);

			$variaveis['nome'] = $transacao->row()->nome;
			$variaveis['valor'] = $transacao->row()->valor;
			$variaveis['parcela'] = $this->m_cartao->lista_parcela_transacao($transacao->row()->id_parcela_transacao)->row()->parcelas;
			$variaveis['data_cadastro'] = $transacao->row()->data_cadastro;
			$variaveis['categoria'] = $transacao->row()->id_categoria;
			$variaveis['observacao'] = $transacao->row()->observacao;
			$variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($transacao->row()->id_fatura)->row()->id_cartao;
			$variaveis['id_fatura'] = $transacao->row()->id_fatura;
		 	$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
			}

			$this->load->view('v_cabecalho');
			$this->load->view('cadastros/v_manuseia_cartao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function gravar($id_transacao)
	{
		$id_cartao = $this->input->post('cartao');
		$nome = $this->input->post('nome');
		$valor = $this->input->post('valor');
		$parcela = $this->input->post('parcela');
		$data = $this->input->post('data');
		$categoria = $this->input->post('categoria');
		$id_fatura = $this->input->post('fatura');
		$observacao = $this->input->post('observacao');
		$conta = $this->m_cartao->conta_cartao($id_cartao)->row()->id_conta;

		if ($parcela == '') {
				$parcela = 1;
		}

		$div = round($valor/$parcela,2);

//dar inicio a divisão da fatura
		$valor_inicial = $div + ($valor-($div*$parcela));
		$valor_arredondado = $div;
			
		if ($parcela!=1) $nome_alt = strtoupper($nome)." 1/".$parcela;
						  else $nome_alt = strtoupper($nome);
//inserir primeira parcela
		$dados= array(
			'nome' => $nome_alt,
			'valor' => $valor_inicial,
			'data_cadastro' => $data,
			'id_categoria' => $categoria,
			'id_conta' => $conta,
			'id_fatura_cartao' => $id_fatura,
			'observacao' => strtoupper($observacao)
			);

		if ($id_transacao ==0) {
				$id_nova_transacao = $this->m_cartao->cadastrar($dados,'transacoes');

				//if ($parcela>1) {
					$dados2 = array(
					'parcelas' => $parcela
					);
					$id_parcela_transacao = $this->m_cartao->cadastrar($dados2,'parcela_transacao');


					$dados3 = array(
						'id_parcela_transacao' => $id_parcela_transacao
					);
					$this->m_cartao->atualizar($dados3,'id_transacao',$id_nova_transacao,'transacoes');
				//}
		} else {
				$this->m_cartao->atualizar($dados,'id_transacao',$id_transacao,'transacoes');
		}

		$this->m_cartao->valor_fatura($id_fatura);
    	$this->m_cartao->valor_fatura_aberto($id_fatura);

//inserir outras parcelas
		if ($parcela>1) {
			$parcela_contador = $parcela;
			$contador = 1;
			$faturas = $this->m_cartao->faturas($id_cartao);
			$data_contador = $data;

			foreach($faturas -> result() as $faturas){
				if ($id_fatura<$faturas->id_fatura) {
					if ($parcela_contador>1) {
								$parcela_contador = $parcela_contador-1;
								$contador = $contador+1;
								$data_contador = new DateTime($data_contador);
								$data_contador->add(new DateInterval('P'.'1'.'M'));
								$data_contador = $data_contador->format('Y-m-d');

								$dados= array(
								'nome' => strtoupper($nome)." ".$contador."/".$parcela,
								'valor' => $valor_arredondado,
								'data_cadastro' => $data_contador,
								'id_categoria' => $categoria,
								'id_conta' => $conta,
								'id_fatura_cartao' => $faturas->id_fatura,
								'observacao' => strtoupper($observacao),
								'id_parcela_transacao' => $id_parcela_transacao
								);

								if ($id_transacao ==0) {
										$this->m_cartao->cadastrar($dados,'transacoes');
								}

								$this->m_cartao->valor_fatura($faturas->id_fatura);
      							$this->m_cartao->valor_fatura_aberto($faturas->id_fatura);
					}
				}
			}
		}

      $this->m_cartao->valor_cartao_aberto($id_cartao);

			$variaveis['lancamentos'] = $this->m_cartao->listagem($id_fatura);
		  $variaveis['pagina'] = 'Lançamentos';
		  $variaveis['nome_fatura'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->nome;
		  $variaveis['dt_vencimento'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->dt_vencimento;
		  $variaveis['id_cartao'] = $id_cartao;
			$variaveis['id_fatura'] = $id_fatura;
			$variaveis['valor_fatura'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->vlr_fatura;
	  	$variaveis['valor_fatura_aberto'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->vlr_fatura_aberto;

			$this->load->view('v_cabecalho');
			$this->load->view('cartao/v_lancamento', $variaveis);
			$this->load->view('v_rodape');
	}

	public function excluir($transacao,$id_fatura,$id_cartao)
	{
		$lista_transacao = $this->m_cartao->transacao($transacao);
		$id_parcela_transacao = $lista_transacao->row()->id_parcela_transacao;
		$id_fatura_cartao = $lista_transacao->row()->id_fatura_cartao;
		
		if($id_parcela_transacao != '') {
			$transacoes = $this->m_cartao->lista_transacoes_parcela_transacao($id_parcela_transacao);
			foreach($transacoes -> result() as $transacoes){
				$this->m_cartao->excluir($transacoes->id_transacao);
				$this->m_cartao->valor_fatura($transacoes->id_fatura_cartao);
      			$this->m_cartao->valor_fatura_aberto($transacoes->id_fatura_cartao);
			}
		} else {
			$this->m_cartao->excluir($transacao);
			$this->m_cartao->valor_fatura($id_fatura_cartao);
      		$this->m_cartao->valor_fatura_aberto($id_fatura_cartao);
		}
		
      $this->m_cartao->valor_cartao_aberto($id_cartao);

			$variaveis['lancamentos'] = $this->m_cartao->listagem($id_fatura);
		  $variaveis['pagina'] = 'Lançamentos';
		  $variaveis['nome_fatura'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->nome;
		  $variaveis['dt_vencimento'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->dt_vencimento;
		  $variaveis['id_cartao'] = $id_cartao;
			$variaveis['id_fatura'] = $id_fatura;
			$variaveis['valor_fatura'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->vlr_fatura;
		  $variaveis['valor_fatura_aberto'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->vlr_fatura_aberto;

			$this->load->view('v_cabecalho');
			$this->load->view('cartao/v_lancamento', $variaveis);
			$this->load->view('v_rodape');
	}

	public function manusear_estorno($id,$id_cartao,$id_fatura)
	{
		$variaveis['id_transacao'] = $id;
		$variaveis['cartoes'] = $this->m_cartao->listar_cartoes();
		$variaveis['data'] = date("Y-m-d");
		$variaveis['nome_tela'] = "Estorno";

		if ($id == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor'] = '';
			$variaveis['data_cadastro'] = date("Y-m-d");
			$variaveis['categoria'] = 19;
			$variaveis['id_cartao'] = $id_cartao;
			$variaveis['id_fatura'] = $id_fatura;
			$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
			$variaveis['observacao'] = '';
		} else {
			$transacao = $this->m_cartao->transacao($id);

			$variaveis['nome'] = $transacao->row()->nome;
			$variaveis['valor'] = $transacao->row()->valor;
			$variaveis['data_cadastro'] = $transacao->row()->data_cadastro;
			$variaveis['categoria'] = $transacao->row()->id_categoria;
			$variaveis['observacao'] = $transacao->row()->observacao;
			$variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($transacao->row()->id_fatura)->row()->id_cartao;
			$variaveis['id_fatura'] = $transacao->row()->id_fatura;
		 	$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
			}

			$this->load->view('v_cabecalho');
			$this->load->view('cadastros/v_manuseia_entrada_cartao', $variaveis);
			$this->load->view('v_rodape');
	}

public function manusear_pagar_fatura($id,$id_cartao,$id_fatura)
{
	$variaveis['id_transacao'] = $id;
	$variaveis['cartoes'] = $this->m_cartao->listar_cartoes();
	$variaveis['data'] = date("Y-m-d");
	$variaveis['categorias'] = $this->m_cartao->listar_categorias('3');
	$variaveis['nome_tela'] = "Pagamento de Fatura";

	if ($id == 0) {
		$dados_fatura = $this->m_cartao->fatura_id_cartao($id_fatura);

		$variaveis['nome'] = 'PAGAMENTO DE FATURA';
		$variaveis['valor'] = $dados_fatura->row()->vlr_fatura_aberto;
		$variaveis['data_cadastro'] = date("Y-m-d");
		$variaveis['categoria'] = '';
		$variaveis['id_cartao'] = $id_cartao;
		$variaveis['id_fatura'] = $id_fatura;
		$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
		$variaveis['observacao'] = "REFERENTE À FATURA {$dados_fatura->row()->nome} COM VENCIMENTO {$dados_fatura->row()->dt_vencimento}";
	} else {
		$transacao = $this->m_cartao->transacao($id);

		$variaveis['nome'] = $transacao->row()->nome;
		$variaveis['valor'] = $transacao->row()->valor;
		$variaveis['data_cadastro'] = $transacao->row()->data_cadastro;
		$variaveis['categoria'] = $transacao->row()->id_categoria;
		$variaveis['observacao'] = $transacao->row()->observacao;
		$variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($transacao->row()->id_fatura)->row()->id_cartao;
		$variaveis['id_fatura'] = $transacao->row()->id_fatura;
		$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
		}

		$this->load->view('v_cabecalho');
		$this->load->view('cadastros/v_manuseia_entrada_cartao', $variaveis);
		$this->load->view('v_rodape');
}
}
