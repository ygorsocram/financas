<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorio extends MY_Controller {

	function __construct(){
			parent::__construct();
	$this->load->model('m_relatorio');
	}

	public function index()
	{
		$variaveis['categorias'] = $this->m_relatorio->listar_categorias();

		$this->load->view('v_cabecalho');
		$this->load->view('v_relatorio', $variaveis);
		$this->load->view('v_rodape');
  }
}
