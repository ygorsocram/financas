<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_categoria extends CI_Model {

	public function listar_categorias($id_tipo) {
				return $this->db->query("SELECT *
																	FROM categorias c
																	WHERE id_tipo = $id_tipo");
	}

	public function listar_categoria($id_categoria) {
				return $this->db->query("SELECT *
																	FROM categorias c
																	WHERE id_categoria = $id_categoria");
	}

	public function cadastrar($data)
	{
			$this->db->insert('categorias', $data);
	}

	public function atualizar($data,$id)
	{

			$this->db->where('id_categoria', $id);
			$this->db->update('categorias',$data);
	}

	public function excluir($id)
	{
			$this->db->where('id_categoria', $id);
			$this->db->delete('categorias');
	}
}
