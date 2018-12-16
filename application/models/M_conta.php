<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_conta extends CI_Model {

	public function contas(){

			return $this->db->query("SELECT *
																FROM contas c");
	}
}
