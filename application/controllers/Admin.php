<?php

/**
 * @property Admin_model $admin
 */
class Admin extends MY_Controller
{
	public $path = '/admin';

	function __construct()
	{
		parent::__construct();
		$this->ifNotLogin();
		$this->ifNotAdmin();
		$this->load->model('Admin_model', 'admin');
	}


	function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->data['totalUser'] = $this->admin->totalUser();
		$this->makeView('/index');
	}

	function users()
	{
		$this->data['title'] = 'Users';
		$this->makeView('/users');
	}

	function fetch_email()
	{
		$email = $this->input->post('email');
		if ($email) {
			if ($this->admin->fetch_email($email) == true) {
				echo true;
			} else {
				echo false;
			}
		}
	}

	function fetch_phone()
	{
		$phone = $this->input->post('phone');
		if ($phone) {
			if ($this->admin->fetch_phone($phone) == true) {
				echo true;
			} else {
				echo false;
			}
		}
	}

	function fetch_customerName()
	{
		$name = $this->input->post('customerName');
		if ($name) {
			if ($this->admin->fetch_customerName($name) == true) {
				echo true;
			} else {
				echo false;
			}
		}
	}

	function saveUser()
	{
		$arr['name'] = $this->input->post('name');
		$arr['type'] = $this->input->post('type');
		$arr['username'] = $this->input->post('username');
		$arr['password'] = md5($this->input->post('password'));
		$this->admin->saveUser($arr);
		$this->session->set_flashdata('success', 'User Added Successfully.');
		redirect('admin/users');
	}

	function getUsers()
	{
		$action = '<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editUser/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="deleteUser/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
		$this->datatables->select('id, name, type, username, createAt');
		$this->datatables->from(TABLE_USERS);
		$this->datatables->where(array('type !=' => 'Admin', 'deleted' => 0));
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function editUser($id)
	{
		$this->data['data'] = $this->admin->getUserById($id);
		$this->popupView('/editUser');
	}

	function updateUser($id)
	{
		$arr['name'] = $this->input->post('name');
		if ($this->input->post('username')) {
			$arr['username'] = $this->input->post('username');
		}
		if ($this->input->post('type')) {
			$arr['type'] = $this->input->post('type');
		}
		if ($this->input->post('password')) {
			$arr['password'] = md5($this->input->post('password'));
		}
		$this->admin->updateUser($arr, $id);
//			$this->session->set_flashdata('danger', 'Not Permitted!!');
		$this->session->set_flashdata('success', 'User Updated Successfully.');
		redirect('admin/users');
	}

	function deleteUser($id)
	{
//		$this->admin->deleteUser($id);
//			$this->session->set_flashdata('danger', 'Not Permitted!!');
		$arr['deleted'] = 1;
		$this->admin->updateUser($arr, $id);
		$this->session->set_flashdata('success', 'User Successfully Removed..');
		redirect('admin/users');
	}

	function add()
	{
		$this->data['title'] = 'Add Vehicle';
		$this->makeView('/add');
	}

	function getPoliceSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getPoliceSearch($searchTerm);
		echo json_encode($response);
	}

	function getInsurerSearch()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response = $this->admin->getInsurerSearch($searchTerm);
		echo json_encode($response);
	}

	function save()
	{
//		return dnp($_POST);
		$arr['accidentDate'] = date('Y-m-d', strtotime($this->input->post('accidentDate')));
		$arr['accidentTime'] = $this->input->post('accidentTime');
		$arr['vehicleLicPlate'] = $this->input->post('vehicleLicPlate');
		$arr['chassisNo'] = $this->input->post('chassisNo');
		$arr['licensePlateClass'] = $this->input->post('licensePlateClass');
		$arr['locationOfAccident'] = $this->input->post('locationOfAccident');
		$arr['policeId'] = $this->input->post('policeId');
		$arr['roadCondition'] = $this->input->post('roadCondition');
		$arr['vehicleOwner'] = $this->input->post('vehicleOwner');
		$arr['driverName'] = $this->input->post('driverName');
		$arr['driverOccupation'] = $this->input->post('driverOccupation');
		$arr['annualPremium'] = $this->input->post('annualPremium');
		$arr['deductible'] = $this->input->post('deductible');
		$arr['insurerId'] = $this->input->post('insurerId');
		$arr['annualPremiumInsurer'] = $this->input->post('annualPremiumInsurer');
		$arr['accidentDetails'] = $this->input->post('accidentDetails');
		$arr['ownDamageDetails'] = $this->input->post('ownDamageDetails');
		$arr['damageDiagram'] = $this->input->post('damageDiagram');
		$arr['partialDamage'] = $this->input->post('partialDamage');
		$arr['acceptLiability'] = $this->input->post('acceptLiability');
		$arr['policeOpinion'] = $this->input->post('policeOpinion');
		$arr['conviction'] = $this->input->post('conviction');
		$arr['ownDamagePayout'] = $this->input->post('ownDamagePayout');
		$arr['thirdPartyPayout'] = $this->input->post('thirdPartyPayout');
		$arr['thirdPartyBodilyPayout'] = $this->input->post('thirdPartyBodilyPayout');
		$arr['thirdPartyDeathPayout'] = $this->input->post('thirdPartyDeathPayout');
		$arr['totalThirdPartyPayout'] = $this->input->post('totalThirdPartyPayout');
		$arr['total'] = $this->input->post('total');
		$arr['userId'] = getSession()->id;
		$this->admin->saveDetail($arr);
		$id = $this->db->insert_id();
		$config['upload_path'] = './images/' . $id;
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['overwrite'] = true;

		if (!is_dir('images')) {
			mkdir('./images', 0777, true);
		}
		if (!is_dir('images/' . $id)) {
			mkdir('./images/' . $id, 0777, true);
		}
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		$this->upload->do_upload('ownerId');
		$profile = $this->upload->data('file_name');

		if (!empty($_FILES['ownerId']['name'])) {
			$ar['ownerId'] = $profile;
			$this->admin->updateDetail($ar, $id);
		}
		$this->session->set_flashdata('success', 'Accident Details Added Successfully.');
		redirect('admin/details');
	}

	function details()
	{
		$this->data['title'] = 'Accident Details';
		$this->makeView('/details');
	}

	function getDetails()
	{
		$action = '<a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editDetail/$1') . '\')" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
            <a href="deleteDetail/$1' . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></a>';
		$this->datatables->select('a.id as id, a.accidentDate, a.accidentTime, a.vehicleLicPlate, a.chassisNo, a.licensePlateClass, a.locationOfAccident, u.name as police, 
		a.roadCondition, a.vehicleOwner, a.driverName, a.driverOccupation, a.annualPremium, a.deductible, u1.name as insurer, a.annualPremiumInsurer, a.accidentDetails, a.ownDamageDetails, 
		a.damageDiagram, a.partialDamage, a.acceptLiability, a.policeOpinion, a.conviction, a.ownDamagePayout, a.thirdPartyPayout, a.thirdPartyBodilyPayout, a.thirdPartyDeathPayout, 
		a.totalThirdPartyPayout, a.total, u2.name as addedBy, a.createAt, a.updateAt');
		$this->datatables->from(TABLE_ACCIDENTDETAILS . ' as a');
		$this->datatables->join(TABLE_USERS . ' as u', 'a.policeId = u.id', 'left');
		$this->datatables->join(TABLE_USERS . ' as u1', 'a.insurerId = u1.id', 'left');
		$this->datatables->join(TABLE_USERS . ' as u2', 'a.userId = u2.id', 'left');
		$this->datatables->addColumn('actions', $action, 'id');
		$this->datatables->generate();
	}

	function editDetail($id)
	{
		$this->data['data'] = $this->admin->getDetailrById($id);
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
		$arr['policeId'] = $this->input->post('policeId');
		$arr['roadCondition'] = $this->input->post('roadCondition');
		$arr['vehicleOwner'] = $this->input->post('vehicleOwner');
		$arr['driverName'] = $this->input->post('driverName');
		$arr['driverOccupation'] = $this->input->post('driverOccupation');
		$arr['annualPremium'] = $this->input->post('annualPremium');
		$arr['deductible'] = $this->input->post('deductible');
		$arr['insurerId'] = $this->input->post('insurerId');
		$arr['annualPremiumInsurer'] = $this->input->post('annualPremiumInsurer');
		$arr['accidentDetails'] = $this->input->post('accidentDetails');
		$arr['ownDamageDetails'] = $this->input->post('ownDamageDetails');
		$arr['damageDiagram'] = $this->input->post('damageDiagram');
		$arr['partialDamage'] = $this->input->post('partialDamage');
		$arr['acceptLiability'] = $this->input->post('acceptLiability');
		$arr['policeOpinion'] = $this->input->post('policeOpinion');
		$arr['conviction'] = $this->input->post('conviction');
		$arr['ownDamagePayout'] = $this->input->post('ownDamagePayout');
		$arr['thirdPartyPayout'] = $this->input->post('thirdPartyPayout');
		$arr['thirdPartyBodilyPayout'] = $this->input->post('thirdPartyBodilyPayout');
		$arr['thirdPartyDeathPayout'] = $this->input->post('thirdPartyDeathPayout');
		$arr['totalThirdPartyPayout'] = $this->input->post('totalThirdPartyPayout');
		$arr['total'] = $this->input->post('total');
		$arr['updateAt'] = date('Y-m-d H:i:s');
		$this->admin->updateDetail($arr, $id);
		$config['upload_path'] = './images/' . $id;
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['overwrite'] = true;

		if (!is_dir('images')) {
			mkdir('./images', 0777, true);
		}
		if (!is_dir('images/' . $id)) {
			mkdir('./images/' . $id, 0777, true);
		}
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		$this->upload->do_upload('ownerId');
		$profile = $this->upload->data('file_name');

		if (!empty($_FILES['ownerId']['name'])) {
			$ar['ownerId'] = $profile;
			$this->admin->updateDetail($ar, $id);
		}
		$this->session->set_flashdata('success', 'Accident Detail Updated Successfully.');
		redirect('admin/details');
	}

	function deleteDetail($id)
	{
		$this->admin->deleteDetail($id);
		$this->session->set_flashdata('success', 'Accident Detail Successfully Removed..');
		redirect('admin/details');
	}


	function getDaileSale()
	{
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$query = $this->admin->getDailySale();
//        return dnp($query->result());
		$data = [];

		foreach ($query->result() as $r) {
			$action = '<div class="dropdown">
			<button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions
			<span class="caret"></span></button>
			<ul class="dropdown-menu">
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/viewCustomerHistory/') . $r->customerId . '\')">Client History</a></li>
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/addAppointment/') . $r->customerId . '\')">Add Appointment</a></li>
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/addDailySale/') . $r->customerId . '\')">Add Sale</a></li>
			  <li><a href="javascript:void(0);" onclick="loadPopup(\'' . base_url('admin/editDailySale/') . $r->id . '\')">Edit</a></li>
			<li><a href="deleteDailySale/' . $r->id . '" onclick="return confirm(\'Are you sure?\')">Delete</a></li>
			</ul>
		  </div>';

			$data[] = array(
				$r->customerName,
				$r->phone,
				$action,
				$r->email,
				$r->doctorName,
				$r->serviceName,
				$r->note,
				$r->cashPaid,
				$r->visaPaid,
				$r->remainPaid,
				$r->town,
				$r->referral,
				$r->name,
				$r->createAt,
				$r->leaveStatus,
				$r->id);
		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}


	function getDaileSaleClientSearchByDate()
	{
		$startDate = date('Y-m-d', strtotime($this->input->post("start_date")));
		$endDate = date('Y-m-d', strtotime($this->input->post("end_date")));

		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$query = $this->admin->getDaileSaleClientSearchByDate($startDate, $endDate);
//        return dnp($query->result());
		$data = [];

		foreach ($query->result() as $r) {
			$data[] = array(
				$r->date,
				$r->customerName,
				$r->phone,
				$r->doctorName,
				$r->serviceName,
				$r->note,
				$r->cashPaid,
				$r->visaPaid,
				$r->remainPaid,
				$r->town,
				$r->referral,
				$r->name,
				$r->createAt,
				$r->cDeleted,
				$r->doDeleted,
				$r->sDeleted,
				$r->uDeleted);
		}

		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);

		echo json_encode($result);
		exit();
	}

}
