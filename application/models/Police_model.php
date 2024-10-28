<?php

class Police_model extends CI_Model
{
	function __construct()
	{
	}

	function getTotalAccident()
	{
		$this->db->select('a.*');
		$this->db->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->db->join(TABLE_VEHICLEDETAILS . ' as v', 'a.id = v.accidentId');
		$this->db->group_by('a.id');
		return $this->db->get()->num_rows();
	}

	function getTodaysAccident()
	{
		$this->db->select('a.*');
		$this->db->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->db->join(TABLE_VEHICLEDETAILS . ' as v', 'a.id = v.accidentId');
		$this->db->where('accidentDate', date('Y-m-d'));
		$this->db->group_by('a.id');
		return $this->db->get()->num_rows();
	}

	function saveAccidentDetail($arr)
	{
		$this->db->insert(TABLE_ACCIDENTDETAILS, $arr);
	}

	function saveVehicleDetail($arr)
	{
		$this->db->insert(TABLE_VEHICLEDETAILS, $arr);
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


	function getAccidentDetailsById($id)
	{
		$this->db->select('a.*, u.name as police');
		$this->db->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->db->join(TABLE_USERS . ' as u', 'a.policeId = u.id', 'left');
		$this->db->where('a.id', $id);
		return $this->db->get()->row();
	}

	function getVehicleDetailsByAccidentId($id)
	{
		$this->db->select('v.*, u1.name as insurer');
		$this->db->from(TABLE_VEHICLEDETAILS . ' as v');
		$this->db->join(TABLE_USERS . ' as u1', 'v.insurerId = u1.id', 'left');
		$this->db->where('v.accidentId', $id);
		return $this->db->get()->result();
	}

	function updateAccidentDetail($arr, $id)
	{
		$this->db->update(TABLE_ACCIDENTDETAILS, $arr, array('id' => $id));
	}

	function updateVehicleDetail($arr, $id)
	{
		$this->db->update(TABLE_VEHICLEDETAILS, $arr, array('id' => $id));
	}

	function deleteAccidentDetail($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_ACCIDENTDETAILS);
	}

	function deleteVehicleDetail($id)
	{
		$this->db->where('id', $id);
		$this->db->delete(TABLE_VEHICLEDETAILS);
	}

}
