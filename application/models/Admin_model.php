<?php

class Admin_model extends CI_Model
{
	function __construct()
	{
		$this->detailsTable = 'details';
	}

	function totalUser()
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where('type !=', 'Admin');
		return $this->db->get()->num_rows();
	}

	function getUsers()
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where(array('id !=' => getSession()->id));
		return $this->db->get();
	}

	function fetch_email($email)
	{
		$this->db->select('username');
		// $this->db->where("username like '%" . $email . "%'");
		$this->db->where(array('username' => $email, 'deleted' => 0));
		$query = $this->db->get(TABLE_USERS);
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function saveUser($arr)
	{
		$this->db->insert(TABLE_USERS, $arr);
	}

	function getUserById($id)
	{
		$this->db->select('*');
		$this->db->from(TABLE_USERS);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	function updateUser($arr, $id)
	{
		$this->db->update(TABLE_USERS, $arr, array('id' => $id));
	}

	function deleteUser($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_USERS);
	}

	function getPoliceSearch($searchTerm = "")
	{
		$this->db->select('*, name as text');
		$this->db->from(TABLE_USERS);
		$this->db->where("name like '%" . $searchTerm . "%' or username like '%" . $searchTerm . "%'");
//		$this->db->where("name like '%" . $searchTerm . "%");
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			if ($val->deleted == 0 && $val->type == 'Police') {
				$data[] = $val;
			}
		}
		return $data;
	}

	function getInsurerSearch($searchTerm = "")
	{
		$this->db->select('*, name as text');
		$this->db->from(TABLE_USERS);
		$this->db->where("name like '%" . $searchTerm . "%' or username like '%" . $searchTerm . "%'");
//		$this->db->where("name like '%" . $searchTerm . "%");
		$value = $this->db->get()->result();
		$data = array();
		foreach ($value as $val) {
			if ($val->deleted == 0 && $val->type == 'Insurers') {
				$data[] = $val;
			}
		}
		return $data;
	}


	function saveDetail($arr)
	{
		$this->db->insert(TABLE_ACCIDENTDETAILS, $arr);
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
