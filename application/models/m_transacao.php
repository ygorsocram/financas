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
