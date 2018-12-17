<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_Controller {
	public function index()
	{
		$this->load->view('v_cabecalho');
		$this->load->view('inicio');
		$this->load->view('v_rodape');
	}
}
