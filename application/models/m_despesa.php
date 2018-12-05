<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_despesa extends CI_Model {

	public function listagem(){
				return $this->db->query("SELECT t.id_transacao,
                                        t.data_cadastro,
                                        t.nome,
                                        t.valor,
                                        c.nome as categoria
                                 FROM   transacoes t, categorias c
																 WHERE  t.id_categoria = c.id_categoria
                                 AND    c.id_tipo = 2
                                 ORDER BY t.data_cadastro");
		}

	public function categorias(){
			return $this->db->query("SELECT id_categoria,
																			 nome
																FROM categorias");
	}

	public function contas(){
			return $this->db->query("SELECT id_conta,
																			 nome
																FROM contas");
	}

	}
