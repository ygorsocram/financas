<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_relatorio extends CI_Model {

		public function listar_categorias($data_inicio,$data_fim){
				return $this->db->query("SELECT c.id_categoria,
																		    c.nome,
                                        CASE WHEN t.valor>0 THEN t.valor
																									ELSE 0
                                        END as valor,
                                        CASE WHEN c.vlr_orcamento>0 THEN c.vlr_orcamento
																									ELSE 0
                                        END as valor_orcamento
																	FROM categorias c left join (SELECT id_categoria,
																															 sum(valor) as valor
																								               FROM transacoes
																															 WHERE data_cadastro between '$data_inicio' and '$data_fim'
																								 							 GROUP BY id_categoria) t
																		 on c.id_categoria = t.id_categoria
																	WHERE c.id_tipo = 2
																	AND c.vlr_orcamento is not null
																	ORDER BY c.nome");
		}

		public function listar_categorias_com_valor($data_inicio,$data_fim){
				return $this->db->query("SELECT c.id_categoria,
																		    c.nome,
                                        CASE WHEN t.valor>0 THEN t.valor
																									ELSE 0
                                        END as valor,
																				cor
																	FROM categorias c,
																			 (SELECT id_categoria,
																							 sum(valor) as valor
																				FROM transacoes
																				WHERE data_cadastro between '$data_inicio' and '$data_fim'
																				GROUP BY id_categoria) t
																	WHERE c.id_categoria = t.id_categoria
																	AND c.id_tipo = 2
																	AND c.vlr_orcamento is not null
																	ORDER BY c.nome");
		}

		public function listar_balanco($data_inicio,$data_fim){
				return $this->db->query("SELECT data_cadastro,
																				CASE WHEN valor_receita>0 THEN valor_receita
																													        ELSE 0
				                                     END as valor_receita,
				                                     CASE WHEN valor_despesa>0 THEN valor_despesa
																																			 ELSE 0
				                                        	END as valor_despesa
																 FROM (SELECT receitas.data_cadastro,
																							valor_receita,
																							valor_despesa
																       FROM (SELECT t.data_cadastro,
																										sum(valor) as valor_receita
																             FROM transacoes t,
																	 								categorias c
																						WHERE t.id_categoria = c.id_categoria
																						AND id_tipo =1
																						AND t.data_cadastro between '2$data_inicio' and '$data_fim'
																			 			GROUP BY t.data_cadastro) receitas LEFT JOIN
																						(SELECT t.data_cadastro,
																										sum(valor) as valor_despesa
																						 FROM transacoes t,
																	 								categorias c
																			 			 WHERE t.id_categoria = c.id_categoria
																			 			 AND id_tipo =2
																			 			 AND t.data_cadastro between '$data_inicio' and '$data_fim'
																			 			 group by t.data_cadastro) despesas
																						 on receitas.data_cadastro = despesas.data_cadastro
																				UNION
																				SELECT despesas.data_cadastro,
																							 valor_receita,
																							 valor_despesa
																				FROM (SELECT t.data_cadastro,
																										 sum(valor) as valor_receita
																							FROM transacoes t,
																					 				 categorias c
																							WHERE t.id_categoria = c.id_categoria
																							AND id_tipo =1
																							AND t.data_cadastro between '$data_inicio' and '$data_fim'
																							group by t.data_cadastro) receitas RIGHT JOIN
																						(SELECT t.data_cadastro, sum(valor) as valor_despesa
																						 FROM transacoes t,
																					 				categorias c
																						 WHERE t.id_categoria = c.id_categoria
																						 AND id_tipo =2
																						 AND t.data_cadastro between '$data_inicio' and '$data_fim'
																						 group by t.data_cadastro) despesas
																						 on receitas.data_cadastro = despesas.data_cadastro) a
																						 ORDER BY data_cadastro DESC");
		}

		public function despesas_por_ano($data_inicio){
			return $this->db->query("SELECT CASE WHEN substr(data_cadastro,6,2) = 01 THEN 'Janeiro'
																					 WHEN substr(data_cadastro,6,2) = 02 THEN 'Fevereiro'
																					 WHEN substr(data_cadastro,6,2) = 03 THEN 'Março'
																					 WHEN substr(data_cadastro,6,2) = 04 THEN 'Abril'
																					 WHEN substr(data_cadastro,6,2) = 05 THEN 'Maio'
																					 WHEN substr(data_cadastro,6,2) = 06 THEN 'Junho'
																					 WHEN substr(data_cadastro,6,2) = 07 THEN 'Julho'
																					 WHEN substr(data_cadastro,6,2) = 08 THEN 'Agosto'
																					 WHEN substr(data_cadastro,6,2) = 09 THEN 'Setembro'
																					 WHEN substr(data_cadastro,6,2) = 10 THEN 'Outubro'
																					 WHEN substr(data_cadastro,6,2) = 11 THEN 'Novembro'
																					 WHEN substr(data_cadastro,6,2) = 12 THEN 'Dezembro'
																				END as data,
						 substr(data_cadastro,1,4) as ano,
						 sum(valor) as valor
			FROM transacoes t,
					 categorias c
			WHERE t.id_categoria = c.id_categoria
			AND id_tipo =2
			AND substr(data_cadastro,1,4) = substr('$data_inicio',1,4)
			GROUP BY substr(data_cadastro,6,2)
			ORDER BY substr(data_cadastro,6,2)");
	}

	public function listagem($data_inicio,$data_fim){
											return $this->db->query("SELECT t.id_transacao,
							                                        t.data_cadastro,
							                                        t.nome,
							                                        t.valor,
							                                        c.nome as categoria,
																											co.nome as conta,
																											c.id_tipo,
																											t.pago
							                                 FROM   transacoes t, categorias c, contas co
																							 WHERE  t.id_categoria = c.id_categoria
																							 AND    t.id_conta = co.id_conta
																							 and		c.id_tipo in (1,2)
																							 AND    data_cadastro between '$data_inicio' and '$data_fim'
							                                 ORDER BY t.data_cadastro");
				}

	public function somatorio($data_inicio,$data_fim,$id_tipo){
											return $this->db->query("SELECT sum(t.valor) as valor
							                                 FROM   transacoes t, categorias c
																							 WHERE  t.id_categoria = c.id_categoria
																							 and		c.id_tipo = $id_tipo
																							 AND    data_cadastro between '$data_inicio' and '$data_fim'
							                                 ORDER BY t.data_cadastro");
				}
}
