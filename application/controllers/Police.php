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
		for ($i = 0; $i < count($this->input->post('vehicleLicPlate')); $i++) {
			$arr['vehicleLicPlate'] = $this->input->post('vehicleLicPlate')[$i];
			$arr['chassisNo'] = $this->input->post('chassisNo')[$i];
			$arr['licensePlateClass'] = $this->input->post('licensePlateClass')[$i];
			$arr['vehicleOwner'] = $this->input->post('vehicleOwner')[$i];
			$arr['driverName'] = $this->input->post('driverName')[$i];
			$arr['driverOccupation'] = $this->input->post('driverOccupation')[$i];
			if ($this->input->post('insurerId')[$i] != 0) {
				$arr['insurerId'] = $this->input->post('insurerId')[$i];
			}
			$arr['acceptLiability'] = $this->input->post('acceptLiability')[$i];
//			return dnp($arr);
			$this->police->saveDetail($arr);
		}
		$this->session->set_flashdata('success', 'Accident Details Added Successfully.');
		redirect('police/details');
	}

	function details()
	{
		$this->data['title'] = 'Accident Details';
		$this->makeView('/details');
	}

	function getDetails()
	{
		$action = '<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('police/editDetail/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="deleteDetail/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
		$this->datatables->select('a.id as id, a.accidentDate, a.accidentTime, a.vehicleLicPlate, a.chassisNo, a.licensePlateClass, a.locationOfAccident,
		a.roadCondition, a.vehicleOwner, a.driverName, a.driverOccupation, a.annualPremium, a.deductible, u1.name as insurer, a.annualPremiumInsurer, a.accidentDetails, a.ownDamageDetails, 
		a.damageDiagram, a.partialDamage, a.acceptLiability, a.policeOpinion, a.conviction, a.ownDamagePayout, a.thirdPartyPayout, a.thirdPartyBodilyPayout, a.thirdPartyDeathPayout, 
		a.totalThirdPartyPayout, a.total, u2.name as addedBy, a.createAt, a.updateAt');
		$this->datatables->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->datatables->join(TABLE_USERS . ' as u1', 'a.insurerId = u1.id', 'left');
		$this->datatables->join(TABLE_USERS . ' as u2', 'a.userId = u2.id', 'left');
		$this->datatables->where(array('policeId' => getSession()->id));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function editDetail($id)
	{
		$this->data['data'] = $this->police->getDetailrById($id);
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

	function deleteDetail($id)
	{
		$this->police->deleteDetail($id);
		$this->session->set_flashdata('success', 'Accident Detail Successfully Removed..');
		redirect('police/details');
	}

}
