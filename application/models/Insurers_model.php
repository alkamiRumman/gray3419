<?php

class Insurers_model extends CI_Model
{
	function __construct()
	{
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
}
