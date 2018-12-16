<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_relatorio extends CI_Model {

		public function listar_categorias(){
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
																								 							 GROUP BY id_categoria) t
																		 on c.id_categoria = t.id_categoria
																	WHERE c.id_tipo = 2
																	AND c.vlr_orcamento is not null
																	ORDER BY c.nome");
		}
}
