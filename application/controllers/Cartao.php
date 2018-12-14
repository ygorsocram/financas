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

	public function acessar_faturas()
	{
		$id_cartao = $_GET['id_cartao'];

		$variaveis['faturas'] = $this->m_cartao->lista_fatura($id_cartao);
		$variaveis['nome_fatura'] = $this->m_cartao->nome_fatura($id_cartao)->row()->nome_fatura;
		$variaveis['pagina'] = 'Faturas';

		$this->load->view('v_cabecalho');
		$this->load->view('cartao/v_fatura', $variaveis);
		$this->load->view('v_rodape');
  }

	public function acessar_lancamento()
	{
		$id_fatura = $_GET['id_fatura'];

		$variaveis['lancamentos'] = $this->m_cartao->listagem($id_fatura);
		$variaveis['dt_vencimento'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->dt_vencimento;
		$variaveis['nome_fatura'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->nome;
		$variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($id_fatura)->row()->id_cartao;
		$variaveis['pagina'] = 'Lançamentos';
		$this->load->view('v_cabecalho');
		$this->load->view('cartao/v_lancamento', $variaveis);
		$this->load->view('v_rodape');
	}

	public function manusear()
	{
		$id = $_GET['id'];
		$id_cartao = $_GET['id_cartao'];

		$variaveis['id_transacao'] = $id;
		$variaveis['categorias'] = $this->m_cartao->listar_categorias();
		$variaveis['cartoes'] = $this->m_cartao->listar_cartoes();
		$variaveis['data'] = date("Y-m-d");

		if ($id == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor'] = '';
			$variaveis['data_cadastro'] = date("Y-m-d");
			$variaveis['categoria'] = '';
			$variaveis['cartao'] = $id_cartao;
			$variaveis['fatura'] = '';
			$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
			$variaveis['observacao'] = '';
		} else {
			$transacao = $this->m_cartao->transacao($id);

			$variaveis['nome'] = $transacao->row()->nome;
			$variaveis['valor'] = $transacao->row()->valor;
			$variaveis['data_cadastro'] = $transacao->row()->data_cadastro;
			$variaveis['categoria'] = $transacao->row()->id_categoria;
			$variaveis['observacao'] = $transacao->row()->observacao;
			$variaveis['cartao'] = $this->m_cartao->fatura_id_cartao($transacao->row()->id_fatura)->row()->id_cartao;
			$variaveis['fatura'] = $transacao->row()->id_fatura;
		 	$variaveis['faturas'] = $this->m_cartao->faturas($id_cartao);
			}

			$variaveis['id_cartao'] = $id_cartao;
			$this->load->view('v_cabecalho');
			$this->load->view('cadastros/v_manuseia_cartao', $variaveis);
			$this->load->view('v_rodape');
	}

	public function gravar()
	{
		$id_transacao = $_GET['id'];
		$id_cartao = $_GET['id_cartao'];

		$nome = $this->input->post('nome');
		$valor = $this->input->post('valor');
		$data = $this->input->post('data');
		$categoria = $this->input->post('categoria');
		$fatura = $this->input->post('fatura');
		$observacao = $this->input->post('observacao');
		$conta = $this->m_cartao->conta_cartao($this->m_cartao->fatura_id_cartao($fatura)->row()->id_cartao)->row()->id_conta;

		$data= array(
			'nome' => $nome,
			'valor' => $valor,
			'data_cadastro' => $data,
			'id_categoria' => $categoria,
			'id_conta' => $conta,
			'id_fatura_cartao' => $fatura,
			'observacao' => $observacao
			);

		if ($id_transacao ==0) {
				$this->m_cartao->cadastrar($data);
		} else {
				$this->m_cartao->atualizar($data,$id_transacao);
		}

      $this->m_cartao->valor_fatura($fatura);
      $this->m_cartao->valor_aberto_cartao($this->m_cartao->fatura_id_cartao($fatura)->row()->id_cartao);

			$variaveis['lancamentos'] = $this->m_cartao->listagem($fatura);
		  $variaveis['pagina'] = 'Lançamentos';
		  $variaveis['nome_fatura'] = $this->m_cartao->fatura_id_cartao($fatura)->row()->nome;
		  $variaveis['dt_vencimento'] = $this->m_cartao->fatura_id_cartao($fatura)->row()->dt_vencimento;
		  $variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($fatura)->row()->id_cartao;
			$this->load->view('v_cabecalho');
			$this->load->view('cartao/v_lancamento', $variaveis);
			$this->load->view('v_rodape');
	}

	public function excluir()
	{
		$transacao = $_GET['id'];
		$fatura = $_GET['id_fatura'];
		$id_cartao = $_GET['id_cartao'];

		  $this->m_cartao->excluir($transacao);
      $this->m_cartao->valor_fatura($fatura);
      $this->m_cartao->valor_aberto_cartao($this->m_cartao->fatura_id_cartao($fatura)->row()->id_cartao);

			$variaveis['lancamentos'] = $this->m_cartao->listagem($fatura);
		  $variaveis['pagina'] = 'Lançamentos';
		  $variaveis['nome_fatura'] = $this->m_cartao->fatura_id_cartao($fatura)->row()->nome;
		  $variaveis['dt_vencimento'] = $this->m_cartao->fatura_id_cartao($fatura)->row()->dt_vencimento;
		  $variaveis['id_cartao'] = $this->m_cartao->fatura_id_cartao($fatura)->row()->id_cartao;
			$this->load->view('v_cabecalho');
			$this->load->view('cartao/v_lancamento', $variaveis);
			$this->load->view('v_rodape');
	}
}
