<?php

/**
 * @property Police_model $police
 */
class Police extends MY_Controller
{
	public $path = '/police';

	function __construct()
	{
		parent::__construct();
		$this->ifNotLogin();
		$this->ifNotPolice();
		$this->load->model('Police_model', 'police');
	}

	function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->data['totalAccident'] = $this->police->getTotalAccident();
		$this->data['todayAccident'] = $this->police->getTodaysAccident();
		$this->makeView('/index');
	}

	function add()
	{
		$this->data['title'] = 'Add Vehicle';
		$this->makeView('/add');
	}

	function getInsurerSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->police->getInsurerSearch($searchTerm);
		echo json_encode($response);
	}

	function save()
	{
//		return dnp($_POST);
		$arr['accidentDate'] = date('Y-m-d', strtotime($this->input->post('accidentDate')));
		$arr['accidentTime'] = $this->input->post('accidentTime');
		$arr['locationOfAccident'] = $this->input->post('locationOfAccident');
		$arr['policeId'] = getSession()->id;
		$arr['roadCondition'] = $this->input->post('roadCondition');
		$arr['accidentDetails'] = $this->input->post('accidentDetails');
		$arr['policeOpinion'] = $this->input->post('policeOpinion');
		$arr['userId'] = getSession()->id;
		$this->police->saveAccidentDetail($arr);
		$accidentId = $this->db->insert_id();
		for ($i = 0; $i < count($this->input->post('vehicleLicPlate')); $i++) {
			$ar['accidentId'] = $accidentId;
			$ar['vehicleLicPlate'] = $this->input->post('vehicleLicPlate')[$i];
			$ar['chassisNo'] = $this->input->post('chassisNo')[$i];
			$ar['licensePlateClass'] = $this->input->post('licensePlateClass')[$i];
			$ar['vehicleOwner'] = $this->input->post('vehicleOwner')[$i];
			$ar['driverName'] = $this->input->post('driverName')[$i];
			$ar['driverOccupation'] = $this->input->post('driverOccupation')[$i];
			if ($this->input->post('insurerId')[$i] != 0) {
				$ar['insurerId'] = $this->input->post('insurerId')[$i];
			}
			$ar['acceptLiability'] = $this->input->post('acceptLiability')[$i];
//			return dnp($ar);
			$this->police->saveVehicleDetail($ar);
		}
		$this->session->set_flashdata('success', 'Accident Details Added Successfully.');
		redirect('police/details');
	}

	function details()
	{
		$this->data['title'] = 'Accident Details';
		$this->makeView('/details');
	}

//	function getDetails()
//	{
//		$action = '<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('police/editDetail/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
//            <a href="deleteDetail/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
//            <i class="fa fa-trash"></a>';
//		$this->datatables->select('a.id as id, a.accidentDate, a.accidentTime, v.vehicleLicPlate, v.chassisNo, v.licensePlateClass, a.locationOfAccident,
//		a.roadCondition, v.vehicleOwner, v.driverName, v.driverOccupation, v.annualPremium, v.deductible, u1.name as insurer, v.annualPremiumInsurer, a.accidentDetails, v.ownDamageDetails,
//		v.damageDiagram, v.partialDamage, v.acceptLiability, a.policeOpinion, v.conviction, v.ownDamagePayout, v.thirdPartyPayout, v.thirdPartyBodilyPayout, v.thirdPartyDeathPayout,
//		v.totalThirdPartyPayout, v.total, u2.name as addedBy, a.createAt, a.updateAt');
//		$this->datatables->from(TABLE_ACCIDENTDETAILS . ' as a');
//		$this->datatables->join(TABLE_VEHICLEDETAILS . ' as v', 'a.id = v.accidentId');
//		$this->datatables->join(TABLE_USERS . ' as u1', 'v.insurerId = u1.id', 'left');
//		$this->datatables->join(TABLE_USERS . ' as u2', 'a.userId = u2.id', 'left');
//		$this->datatables->where(array('policeId' => getSession()->id));
//		$this->datatables->addColumn('actions', $action, 'id');
//		$this->datatables->generate();
//	}

	function getVehicleDetails()
	{
		$this->datatables->select('v.id as id, a.accidentDate, a.accidentTime, a.locationOfAccident, v.vehicleLicPlate, v.chassisNo, v.licensePlateClass, v.vehicleOwner, v.driverName, 
			v.driverOccupation, u1.name, v.acceptLiability');
		$this->datatables->from(TABLE_VEHICLEDETAILS . ' as v');
		$this->datatables->join(TABLE_ACCIDENTDETAILS . ' as a', 'a.id = v.accidentId');
		$this->datatables->join(TABLE_USERS . ' as u1', 'v.insurerId = u1.id', 'left');
		$this->datatables->join(TABLE_USERS . ' as u2', 'a.userId = u2.id', 'left');
		$this->datatables->where(array('a.policeId' => getSession()->id));
		$this->datatables->generate();
	}

	function getAccidentDetails()
	{
		$action = '<div class="dropdown">
			<button class="btn btn-sm btn-info dropdown-toggle" type="button" data-toggle="dropdown">Actions
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('police/viewAccidentDetails/$1') . '\')">View</a></li>
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('police/editDetail/$1') . '\')">Edit</a></li>
			<li><a href="' . base_url('deleteDetail/$1') . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
			</ul>
		  </div>';
		$this->datatables->select('a.id as id, a.accidentDate, a.accidentTime, a.locationOfAccident,
		a.roadCondition, a.accidentDetails, a.policeOpinion, u2.name as addedBy, a.createAt, a.updateAt');
		$this->datatables->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->datatables->join(TABLE_USERS . ' as u2', 'a.userId = u2.id', 'left');
		$this->datatables->where(array('policeId' => getSession()->id));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function editDetail($id)
	{
		$this->data['data'] = $this->police->getAccidentDetailsById($id);
		$this->data['vehicleDetails'] = $this->police->getVehicleDetailsByAccidentId($id);
		$this->popupView('/editDetail');
	}

	function updateDetail($id)
	{
//		return dnp($_FILES);
		$arr['accidentDate'] = date('Y-m-d', strtotime($this->input->post('accidentDate')));
		$arr['accidentTime'] = $this->input->post('accidentTime');
		$arr['vehicleLicPlate'] = $this->input->post('vehicleLicPlate');
		$arr['chassisNo'] = $this->input->post('chassisNo');
		$arr['licensePlateClass'] = $this->input->post('licensePlateClass');
		$arr['locationOfAccident'] = $this->input->post('locationOfAccident');
		$arr['roadCondition'] = $this->input->post('roadCondition');
		$arr['vehicleOwner'] = $this->input->post('vehicleOwner');
		$arr['driverName'] = $this->input->post('driverName');
		$arr['driverOccupation'] = $this->input->post('driverOccupation');
		$arr['insurerId'] = $this->input->post('insurerId');
		$arr['accidentDetails'] = $this->input->post('accidentDetails');
		$arr['acceptLiability'] = $this->input->post('acceptLiability');
		$arr['policeOpinion'] = $this->input->post('policeOpinion');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->police->updateDetail($arr, $id);
		$this->session->set_flashdata('success', 'Accident Detail Updated Successfully.');
		redirect('police/details');
	}

	function viewAccidentDetails($id)
	{
		$this->data['accidentDetails'] = $this->police->getAccidentDetailsById($id);
		$this->data['vehicleDetails'] = $this->police->getVehicleDetailsByAccidentId($id);
		$this->popupView('/viewAccidentDetails');
	}

	function deleteDetail($id)
	{
		$this->police->deleteDetail($id);
		$this->session->set_flashdata('success', 'Accident Detail Successfully Removed..');
		redirect('police/details');
	}

}
