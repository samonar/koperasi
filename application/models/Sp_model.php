<?php
defined("BASEPATH") or exit ("Error 404");

class Sp_model extends CI_Model
{
	private $table = 'sp';

	public function getAll()
	{
		return $this->db->get($this->table)->result();
	}

	public function getOne($id_sp)
	{
		return $this->db->get_where($this->table, ['id_sp' => $id_sp])->row();
	}

	public function getOne_angsuran($id_ssp)
	{
		return $this->db->get_where('skema_sp', ['id_ssp' => $id_ssp])->row();
	}

	public function save($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($data)
	{
		$this->db->where(['id_sp' => $data['id_sp']]);
		return $this->db->update($this->table, $data);
	}

	public function delete($id_sp)
	{
		return $this->db->delete($this->table, ['id_sp' => $id_sp]);
	}

	//munir
	function get_sp_byId($id){
		$this->db->where('id_anggota',$id);
		return $this->db->get($this->table);
	}

}
?>