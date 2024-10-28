<?php

class Police_model extends CI_Model
{
	function __construct()
	{
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

	function getDetails()
	{
		// Select all relevant fields from both tables
		$this->db->select('a.id as accidentId, a.accidentDate, a.accidentTime, 
                       a.locationOfAccident, a.roadCondition, 
                       a.accidentDetails, a.policeOpinion, 
                       u2.name as addedBy, a.createAt, a.updateAt,
                       v.vehicleLicPlate, v.chassisNo, v.licensePlateClass, 
                       v.vehicleOwner, v.driverName, v.driverOccupation');

		$this->db->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->db->join(TABLE_VEHICLEDETAILS . ' as v', 'a.id = v.accidentId', 'left');
		$this->db->join(TABLE_USERS . ' as u2', 'a.userId = u2.id', 'left');
		$this->db->where('a.policeId', getSession()->id);

		$query = $this->db->get();
		$results = $query->result();

		// Initialize an array to hold accidents with their vehicles
		$accidents = [];

		// Loop through the results and structure them
		foreach ($results as $row) {
			$accidentId = $row->accidentId;

			// If the accident ID is not already in the array, add it
			if (!isset($accidents[$accidentId])) {
				$accidents[$accidentId] = [
					'accidentDate' => $row->accidentDate,
					'accidentTime' => $row->accidentTime,
					'locationOfAccident' => $row->locationOfAccident,
					'roadCondition' => $row->roadCondition,
					'accidentDetails' => $row->accidentDetails,
					'policeOpinion' => $row->policeOpinion,
					'addedBy' => $row->addedBy,
					'createAt' => $row->createAt,
					'updateAt' => $row->updateAt,
					'vehicles' => [] // Initialize vehicles array
				];
			}

			// Add vehicle information if it exists
			if (!empty($row->vehicleLicPlate)) {
				$accidents[$accidentId]['vehicles'][] = [
					'vehicleLicPlate' => $row->vehicleLicPlate,
					'chassisNo' => $row->chassisNo,
					'licensePlateClass' => $row->licensePlateClass,
					'vehicleOwner' => $row->vehicleOwner,
					'driverName' => $row->driverName,
					'driverOccupation' => $row->driverOccupation,
				];
			}
		}

		// Return the structured data
		return array_values($accidents); // Return as a numerically indexed array
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
