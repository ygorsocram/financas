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
																		 AND id_conta = $id_conta");

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

	public function atualiza_pendente($id_conta){
		$qvalor_entrada = $this->db->query("SELECT sum(valor) as valor_entrada
																			 FROM transacoes
																			 WHERE id_categoria in (SELECT id_categoria
					   																									FROM categorias
					   																									WHERE id_tipo = 1)
																			 AND id_conta = $id_conta
																			 AND pago = 'N'");

		$qvalor_saida = $this->db->query("SELECT sum(valor) as valor_saida
																		 FROM transacoes
																		 WHERE id_categoria in (SELECT id_categoria
																							   						FROM categorias
																							   						WHERE id_tipo = 2
																							   						AND id_fatura_cartao is null)
																		 AND id_conta = $id_conta
																		 AND pago = 'N'");

		$qvalor_cartao = $this->db->query("SELECT sum(vlr_cartao_aberto) as valor_cartao
				    													 FROM cartoes
                    									 WHERE id_conta = $id_conta");

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
}
