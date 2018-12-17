<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_cartao extends CI_Model {

	public function listagem($id_fatura){
											return $this->db->query("SELECT t.id_transacao,
                                                      t.id_fatura_cartao,
							                                        t.data_cadastro,
							                                        t.nome,
							                                        t.valor,
							                                        c.nome as categoria,
																											t.pago
							                                 FROM   transacoes t, categorias c
																							 WHERE  t.id_categoria = c.id_categoria
																							 AND		t.id_fatura_cartao = $id_fatura
							                                 ORDER BY t.data_cadastro");
				}

	public function transacao($id_transacao){
				return $this->db->query("SELECT *
                                 FROM   transacoes t left join faturas f on t.id_fatura_cartao = f.id_fatura
																 WHERE  id_transacao = $id_transacao");
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

	public function listar_categorias($id_tipo){
			return $this->db->query("SELECT id_categoria,
																			 nome
																FROM categorias
																WHERE id_tipo = $id_tipo
																ORDER BY nome");
	}

	public function faturas($id_cartao){

			return $this->db->query("SELECT f.id_fatura,
																			f.paga,
	   																	CONCAT(c.nome,' - ',f.dt_vencimento) as nome,
																			f.dt_vencimento,
																			f.vlr_fatura,
																			f.vlr_fatura_aberto,
                                      c.id_cartao,
																			c.nome as nome_cartao,
																			c.vlr_cartao_aberto,
																			c.vlr_limite - c.vlr_cartao_aberto as vlr_limite_restante
															 FROM faturas f, cartoes c
															 WHERE f.id_cartao = c.id_cartao
															 AND   f.paga = 'N'
															 AND	 f.id_cartao = $id_cartao
															 ORDER BY f.id_fatura");
	}

	public function cartoes(){

			return $this->db->query("SELECT id_cartao,
       																nome as nome_cartao,
	   																	vlr_cartao_aberto,
       																vlr_limite - vlr_cartao_aberto as vlr_limite_restante
																FROM cartoes c");
	}

	public function lista_fatura($id_cartao){
			return $this->db->query("SELECT f.id_fatura,
																			f.paga,
	   																	CONCAT(c.nome,' - ',f.dt_vencimento) as nome,
																			f.dt_vencimento,
																			f.vlr_fatura,
																			f.vlr_fatura_aberto,
                                      c.id_cartao,
																			c.nome as nome_cartao,
																			c.vlr_cartao_aberto,
																			c.vlr_limite - c.vlr_cartao_aberto as vlr_limite_restante
															 FROM faturas f, cartoes c
															 WHERE f.id_cartao = c.id_cartao
															 AND   f.id_cartao = $id_cartao");
	}

	public function nome_fatura($id_cartao){
			return $this->db->query("SELECT
	   																	c.nome as nome_fatura
															 FROM  cartoes c
															 WHERE c.id_cartao = $id_cartao");
	}


	public function fatura_id_cartao($id_fatura){
			return $this->db->query("SELECT f.id_cartao,
                                      f.dt_vencimento,
                                      c.nome,
																			f.vlr_fatura,
																			f.vlr_fatura_aberto
															 FROM faturas f, cartoes c
															 WHERE f.id_cartao = c.id_cartao
                               AND f.id_fatura = $id_fatura");
	}

	public function fatura_unica($id_fatura){
			return $this->db->query("SELECT f.id_fatura,
	   																	CONCAT(f.mes_referencia,'/',f.ano_referencia) as nome,
                                      f.dt_vencimento
															 FROM faturas f, cartoes c
															 WHERE f.id_cartao = c.id_cartao
															 AND   f.paga = 'N'
															 AND   f.id_fatura = $id_fatura");
	}

	public function conta_cartao($id_cartao)
	{
			return $this->db->query("SELECT c.id_conta
															 FROM cartoes c
															 WHERE c.id_cartao = $id_cartao");
	}

	public function listar_cartoes(){
			return $this->db->query("SELECT id_cartao,
																			 nome,
																			 vlr_cartao_aberto,
																			 vlr_limite - vlr_cartao_aberto as vlr_limite_restante
																FROM cartoes");
	}

	public function valor_cartao_aberto($id_cartao){
			$valor_cartao_aberto = $this->db->query("SELECT sum(vlr_fatura_aberto) as vlr_cartao_aberto
																				FROM faturas
																				WHERE id_cartao = $id_cartao");

		$data= array(
			'vlr_cartao_aberto' => $valor_cartao_aberto->row()->vlr_cartao_aberto
			);

			$this->db->where('id_cartao', $id_cartao);
			$this->db->update('cartoes',$data);
	}

	public function valor_fatura($id_fatura){
			$valor_fatura = $this->db->query("SELECT CASE  WHEN valor_entrada>0
			 																							 THEN valor_saida - valor_entrada
		     																						 ELSE valor_saida
																								END as valor_fatura
																				FROM (SELECT id_fatura_cartao,
			 																							 sum(valor) as valor_saida
	  																					FROM transacoes
	  																					WHERE id_fatura_cartao = $id_fatura
      																				AND id_categoria in (SELECT id_categoria
					       																									 FROM categorias
                           																					WHERE id_tipo=2)) saida LEFT JOIN
      																				(SELECT id_fatura_cartao,
			 																								sum(valor) as valor_entrada
       																				 FROM transacoes
       																				 WHERE id_fatura_cartao = $id_fatura
       																				 AND id_categoria in (SELECT id_categoria
					        																									FROM categorias
                            																				WHERE id_tipo=4)) entrada
																				ON saida.id_fatura_cartao = entrada.id_fatura_cartao");

		$data= array(
			'vlr_fatura' => $valor_fatura->row()->valor_fatura
			);

			$this->db->where('id_fatura', $id_fatura);
			$this->db->update('faturas',$data);
	}

	public function valor_fatura_aberto($id_fatura){
			$vlr_fatura_aberto = $this->db->query("SELECT CASE  WHEN valor_pagamentos>0
			 																											THEN vlr_fatura - valor_pagamentos
		     																										ELSE vlr_fatura
																														END as vlr_fatura_aberto
																							 FROM faturas LEFT JOIN (SELECT id_fatura_cartao,
	                    																												sum(valor) as valor_pagamentos
                        																							 FROM transacoes
                        																							 WHERE id_fatura_cartao = $id_fatura
                        																							 AND id_categoria in (SELECT id_categoria
					                         																													FROM categorias
                                             																								WHERE id_tipo=3)) valor_pagamentos
																														 on faturas.id_fatura = valor_pagamentos.id_fatura_cartao
																								WHERE id_fatura = $id_fatura");

		$data= array(
			'vlr_fatura_aberto' => $vlr_fatura_aberto->row()->vlr_fatura_aberto
			);

			$this->db->where('id_fatura', $id_fatura);
			$this->db->update('faturas',$data);
	}
}
