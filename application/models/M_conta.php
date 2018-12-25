<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_conta extends CI_Model {

	public function contas(){

			return $this->db->query("SELECT id_conta,
																			nome,
																			vlr_saldo,
																			vlr_pendente,
																			vlr_saldo + vlr_pendente as vlr_restante
																FROM contas c");
	}

	public function atualiza_saldo($id_conta){
		$qvalor_entrada = $this->db->query("SELECT sum(valor) as valor_entrada
																			 FROM transacoes
																			 WHERE id_categoria in (SELECT id_categoria
					   																									FROM categorias
					   																									WHERE id_tipo = 1)
																			 AND id_conta = $id_conta
																			 AND pago = 'S'");
		$qvalor_saida = $this->db->query("SELECT sum(valor) as valor_saida
																		 FROM transacoes
																		 WHERE id_categoria in (SELECT id_categoria
																							   						FROM categorias
																							   						WHERE id_tipo = 2
																							   						AND id_fatura_cartao is null)
																		 AND id_conta = $id_conta
																		 AND pago = 'S'");
		$qvalor_pagamento = $this->db->query("SELECT sum(valor) as valor_pagamento
																				FROM transacoes
																				WHERE id_categoria in (SELECT id_categoria
																				FROM categorias
																				WHERE id_tipo = 3)
																				AND id_conta = $id_conta
");

//verifica se tem linhas senão coloca 0
		if ($qvalor_entrada->rowCount = 0) $valor_entrada = 0;
																else $valor_entrada = $qvalor_entrada->row()->valor_entrada;

		if ($qvalor_saida->rowCount = 0) $valor_saida = 0;
																else $valor_saida = $qvalor_saida->row()->valor_saida;

		if ($qvalor_pagamento->rowCount = 0) $valor_pagamento = 0;
																else $valor_pagamento = $qvalor_pagamento->row()->valor_pagamento;

		$total = $valor_entrada - $valor_saida - $valor_pagamento;

		$data= array(
			'vlr_saldo' => $total
			);

			$this->db->where('id_conta', $id_conta);
			$this->db->update('contas',$data);
}

	public function atualiza_pendente($id_conta,$data_inicio,$data_fim){
		$qvalor_entrada = $this->db->query("SELECT sum(valor) as valor_entrada
																			 FROM transacoes
																			 WHERE id_categoria in (SELECT id_categoria
					   																									FROM categorias
					   																									WHERE id_tipo = 1)
																			 AND id_conta = $id_conta
																			 AND data_cadastro BETWEEN '$data_inicio' and '$data_fim'
																			 AND pago = 'N'");

		$qvalor_saida = $this->db->query("SELECT sum(valor) as valor_saida
																		 FROM transacoes
																		 WHERE id_categoria in (SELECT id_categoria
																							   						FROM categorias
																							   						WHERE id_tipo = 2
																							   						AND id_fatura_cartao is null)
																		 AND id_conta = $id_conta
																			 AND data_cadastro BETWEEN '$data_inicio' and '$data_fim'
																		 AND pago = 'N'");

		$qvalor_cartao = $this->db->query("SELECT sum(vlr_fatura_aberto) as valor_cartao
                                       FROM faturas
                                       WHERE id_cartao in (SELECT id_cartao
																			 										 FROM cartoes
                                                           WHERE id_conta = $id_conta)
																			 AND dt_vencimento BETWEEN $data_inicio and $data_fim
");

//verifica se tem linhas senão coloca 0
		if ($qvalor_entrada->rowCount = 0) $valor_entrada = 0;
																else $valor_entrada = $qvalor_entrada->row()->valor_entrada;

		if ($qvalor_saida->rowCount = 0) $valor_saida = 0;
																else $valor_saida = $qvalor_saida->row()->valor_saida;

		if ($qvalor_cartao->rowCount = 0) $valor_cartao = 0;
																else $valor_cartao = $qvalor_cartao->row()->valor_cartao;

		$total = $valor_entrada - $valor_saida - $valor_cartao;

		$data= array(
			'vlr_pendente' => $total
			);

			$this->db->where('id_conta', $id_conta);
			$this->db->update('contas',$data);
}

	public function cadastrar_transferencia($data)
	{
			$this->db->insert('transacoes', $data);

			return $this->db->insert_id();
	}

	public function cadastrar($data,$table)
	{
			$this->db->insert($table, $data);
	}

	public function atualizar($data,$id)
	{

			$this->db->where('id_transacao', $id);
			$this->db->update('transacoes',$data);
	}

	public function excluir($id,$table,$campo)
	{
			$this->db->where($campo, $id);
			$this->db->delete($table);
	}

	public function transacao($id_transacao){
				return $this->db->query("SELECT *
                                 FROM   transacoes t left join faturas f on t.id_fatura_cartao = f.id_fatura
																 WHERE  id_transacao = $id_transacao");
	}

	public function transferencia($id_transacao,$id_tipo){
				if ($id_tipo==1) {
									return $this->db->query("SELECT id_saida,id_transferencia
					                                 FROM   transferencia_transacao
																					 WHERE  id_entrada = $id_transacao");
				} else {
									return $this->db->query("SELECT id_entrada,id_transferenc
					                                 FROM   transferencia_transacao
																					 WHERE  id_saida = $id_transacao");
				}
	}
}
