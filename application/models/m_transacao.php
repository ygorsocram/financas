<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_transacao extends CI_Model {

	public function transacao($id_transacao){
				return $this->db->query("SELECT *
                                 FROM   transacoes t left join faturas f on t.id_fatura_cartao = f.id_fatura
																 WHERE  id_transacao = $id_transacao");
	}

	public function nome_tipo($id_tipo){
				return $this->db->query("SELECT nome
                                 FROM   tipos
																 WHERE  id_tipo = $id_tipo");
	}

	public function listagem($id_tipo){
				switch ($id_tipo) {
					case '1':
							return $this->db->query("SELECT t.id_transacao,
			                                        t.data_cadastro,
			                                        t.nome,
			                                        t.valor,
			                                        c.nome as categoria,
																							t.pago
			                                 FROM   transacoes t, categorias c
																			 WHERE  t.id_categoria = c.id_categoria
			                                 AND    c.id_tipo = $id_tipo
			                                 ORDER BY t.data_cadastro");
						break;
					case '2':
							return $this->db->query("SELECT t.id_transacao,
			                                        t.data_cadastro,
			                                        t.nome,
			                                        t.valor,
			                                        c.nome as categoria,
																							t.pago
			                                 FROM   transacoes t, categorias c
																			 WHERE  t.id_categoria = c.id_categoria
			                                 AND    c.id_tipo = $id_tipo
																			 AND		t.id_fatura_cartao is null
			                                 ORDER BY t.data_cadastro");
						break;
					case '3':
							return $this->db->query("SELECT t.id_transacao,
			                                        t.data_cadastro,
			                                        t.nome,
			                                        t.valor,
			                                        c.nome as categoria,
																							t.pago
			                                 FROM   transacoes t, categorias c
																			 WHERE  t.id_categoria = c.id_categoria
			                                 AND    c.id_tipo = 2
																			 AND		t.id_fatura_cartao is not null
			                                 ORDER BY t.data_cadastro");
						break;
				}
		}

	public function filtrar($id_tipo,$data_inicio,$data_fim){
				return $this->db->query("SELECT t.id_transacao,
                                        t.data_cadastro,
                                        t.nome,
                                        t.valor,
                                        c.nome as categoria,
																				t.pago
                                 FROM   transacoes t, categorias c
																 WHERE  t.id_categoria = c.id_categoria
                                 AND    c.id_tipo = $id_tipo
																 AND		t.data_cadastro between $data_inicio and $data_fim
                                 ORDER BY t.data_cadastro");
		}

	public function categorias($id_tipo){
			if ($id_tipo == 3) $id_tipo = 2;

			return $this->db->query("SELECT id_categoria,
																			 nome
																FROM categorias
																WHERE id_tipo = $id_tipo");
	}

	public function contas(){
			return $this->db->query("SELECT id_conta,
																			 nome
																FROM contas");
	}

	public function cartoes(){
			return $this->db->query("SELECT id_cartao,
																			 nome
																FROM cartoes");
	}

	public function faturas(){
			return $this->db->query("SELECT f.id_fatura,
	   																	CONCAT(c.nome,' - ',f.mes_referencia,'/',f.ano_referencia) as nome
															 FROM faturas f, cartoes c
															 WHERE f.id_cartao = c.id_cartao
															 AND   f.paga = 'N'");
	}

	public function fatura_unica($id_fatura){
			return $this->db->query("SELECT f.id_fatura,
	   																	CONCAT(f.mes_referencia,'/',f.ano_referencia) as nome
															 FROM faturas f, cartoes c
															 WHERE f.id_cartao = c.id_cartao
															 AND   f.paga = 'N'
															 AND   f.id_fatura = $id_fatura");
	}

	public function fatura_id_cartao($id_fatura){
			return $this->db->query("SELECT f.id_cartao
															 FROM faturas f
															 WHERE f.id_fatura = $id_fatura");
	}

	public function conta_cartao($id_cartao)
	{
			return $this->db->query("SELECT c.id_conta
															 FROM cartoes c
															 WHERE c.id_cartao = $id_cartao");
	}

	public function tags(){
			return $this->db->query("SELECT id_tag,
																			 nome
																FROM tags");
	}

	public function cadastrar($data)
	{
			$this->db->insert('transacoes', $data);
	}

	public function atualizar($data,$id)
	{

			$this->db->where('id_transacao', $id);
			$this->db->update('transacoes',$data);
	}

	public function excluir($id)
	{
			$this->db->where('id_transacao', $id);
			$this->db->delete('transacoes');
	}

	public function pagar($id)
	{

			$data = array(
               'pago' => 'S',
							 'data_efetivada' => date('y-m-d')
            );

			$this->db->where('id_transacao', $id);
			$this->db->update('transacoes',$data);
	}

	public function cancelar_pagamento($id)
	{

			$data = array(
               'pago' => 'N',
							 'data_efetivada' => ''
            );

			$this->db->where('id_transacao', $id);
			$this->db->update('transacoes',$data);
	}
	}
