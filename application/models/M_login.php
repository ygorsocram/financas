<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function valida($email, $senha) {

		$query = $this->db->query("SELECT * FROM usuarios WHERE nome = '{$email}' AND senha = '{$senha}'");

		if($query->num_rows() == 1) {
			return 1;
		}else{
			return 0;
		}

	}
}
