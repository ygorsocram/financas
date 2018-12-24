<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_categoria');
	}

	public function index()
	{
		$variaveis['categorias_entrada'] = $this->m_categoria->listar_categorias(1);
		$variaveis['categorias_saida'] = $this->m_categoria->listar_categorias(2);

		$this->load->view('v_cabecalho');
		$this->load->view('v_categoria', $variaveis);
		$this->load->view('v_rodape');
	}

	public function manusear()
	{
		$id_categoria = $_GET['id_categoria'];
		$id_tipo = $_GET['id_tipo'];

		if ($id_categoria == 0) {
			$variaveis['nome'] = '';
			$variaveis['valor_orcamento'] = '';
			$variaveis['cor'] = '';
		} else {
			$categoria = $this->m_categoria->listar_categoria($id_categoria);

			$variaveis['nome'] = $categoria->row()->nome;
			$variaveis['valor_orcamento'] = $categoria->row()->vlr_orcamento;
			$variaveis['cor'] = $categoria->row()->cor;
		}

			$variaveis['id_categoria'] = $id_categoria;
			$variaveis['id_tipo'] = $id_tipo;

			$this->load->view('v_cabecalho');
			$this->load->view('cadastros/v_manuseia_categoria', $variaveis);
			$this->load->view('v_rodape');
	}

	public function gravar()
	{
		$id_categoria = $_GET['id'];
		$id_tipo = $_GET['id_tipo'];

		$nome = $this->input->post('nome');
		$valor_orcamento = $this->input->post('valor_orcamento');
		$cor = $this->input->post('cor');

		if ($valor_orcamento>0)  $valor_orcamento;
												else $valor_orcamento = null;

		$data= array(
			'id_tipo' => $id_tipo,
			'nome' => strtoupper($nome),
			'vlr_orcamento' => $valor_orcamento,
			'cor' => $cor,
			);

		if ($id_categoria == 0) {
				$this->m_categoria->cadastrar($data);
		} else {
				$this->m_categoria->atualizar($data,$id_categoria);
		}

		$variaveis['categorias_entrada'] = $this->m_categoria->listar_categorias(1);
		$variaveis['categorias_saida'] = $this->m_categoria->listar_categorias(2);

		$this->load->view('v_cabecalho');
		$this->load->view('v_categoria', $variaveis);
		$this->load->view('v_rodape');
	}

	public function excluir()
	{
		$id_categoria = $_GET['id'];

		  $this->m_categoria->excluir($id_categoria);

		$variaveis['categorias_entrada'] = $this->m_categoria->listar_categorias(1);
		$variaveis['categorias_saida'] = $this->m_categoria->listar_categorias(2);

		$this->load->view('v_cabecalho');
		$this->load->view('v_categoria', $variaveis);
		$this->load->view('v_rodape');
	}
}
