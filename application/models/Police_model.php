<?php

class Police_model extends CI_Model
{
	function __construct()
	{
	}

	function saveDetail($arr)
	{
		$this->db->insert(TABLE_ACCIDENTDETAILS, $arr);
	}

	function getInsurerSearch($searchTerm = "")
	{
		$this->db->select('*, name as text');
		$this->db->from(TABLE_USERS);
		$this->db->where("name like '%" . $searchTerm . "%' or username like '%" . $searchTerm . "%'");
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			if ($val->deleted == 0 && $val->type == 'Insurers') {
				$data[] = $val;
			}
		}
		return $data;
	}

	function getDetailrById($id)
	{
		$this->db->select('a.*, u.name as police, u1.name as insurer');
		$this->db->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->db->join(TABLE_USERS . ' as u', 'a.policeId = u.id', 'left');
		$this->db->join(TABLE_USERS . ' as u1', 'a.insurerId = u1.id', 'left');
		$this->db->where('a.id', $id);
		return $this->db->get()->row();
	}

	function updateDetail($arr, $id)
	{
		$this->db->update(TABLE_ACCIDENTDETAILS, $arr, array('id' => $id));
	}

	function deleteDetail($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_ACCIDENTDETAILS);
	}

}
