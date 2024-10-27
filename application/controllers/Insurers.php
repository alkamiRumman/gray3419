<?php

/**
 * @property Insurers_model $insurers
 */
class Insurers extends MY_Controller
{
	public $path = '/insurers';

	function __construct()
	{
		parent::__construct();
		$this->ifNotLogin();
		$this->ifNotInsurers();
		$this->load->model('Insurers_model', 'insurers');
	}

	function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->makeView('/index');
	}

	function details()
	{
		$this->data['title'] = 'Accident Details';
		$this->makeView('/details');
	}

	function getDetails()
	{
		$action = '<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('insurers/editDetail/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>';
		$this->datatables->select('a.id as id, a.accidentDate, a.accidentTime, a.vehicleLicPlate, a.chassisNo, a.licensePlateClass, a.locationOfAccident,
		a.roadCondition, a.vehicleOwner, a.driverName, a.driverOccupation, a.annualPremium, a.deductible, u1.name as insurer, a.annualPremiumInsurer, a.accidentDetails, a.ownDamageDetails, 
		a.damageDiagram, a.partialDamage, a.acceptLiability, a.policeOpinion, a.conviction, a.ownDamagePayout, a.thirdPartyPayout, a.thirdPartyBodilyPayout, a.thirdPartyDeathPayout, 
		a.totalThirdPartyPayout, a.total, u2.name as addedBy, a.createAt, a.updateAt');
		$this->datatables->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->datatables->join(TABLE_USERS . ' as u1', 'a.insurerId = u1.id', 'left');
		$this->datatables->join(TABLE_USERS . ' as u2', 'a.userId = u2.id', 'left');
		$this->datatables->where(array('insurerId' => getSession()->id));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function editDetail($id)
	{
		$this->data['data'] = $this->insurers->getDetailrById($id);
		$this->popupView('/editDetail');
	}

	function updateDetail($id)
	{
//		return dnp($_FILES);
		$arr['driverOccupation'] = $this->input->post('driverOccupation');
		$arr['annualPremium'] = $this->input->post('annualPremium');
		$arr['deductible'] = $this->input->post('deductible');
		$arr['annualPremiumInsurer'] = $this->input->post('annualPremiumInsurer');
		$arr['ownDamageDetails'] = $this->input->post('ownDamageDetails');
		$arr['damageDiagram'] = $this->input->post('damageDiagram');
		$arr['partialDamage'] = $this->input->post('partialDamage');
		$arr['conviction'] = $this->input->post('conviction');
		$arr['ownDamagePayout'] = $this->input->post('ownDamagePayout');
		$arr['thirdPartyPayout'] = $this->input->post('thirdPartyPayout');
		$arr['thirdPartyBodilyPayout'] = $this->input->post('thirdPartyBodilyPayout');
		$arr['thirdPartyDeathPayout'] = $this->input->post('thirdPartyDeathPayout');
		$arr['totalThirdPartyPayout'] = $this->input->post('totalThirdPartyPayout');
		$arr['total'] = $this->input->post('total');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->insurers->updateDetail($arr, $id);
		$this->session->set_flashdata('success', 'Accident Detail Updated Successfully.');
		redirect('insurers/details');
	}

}
