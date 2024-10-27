<?php

/**
 * @property Core_model $core
 */

class MY_Controller extends CI_Controller
{
	public $path;
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');
		$this->load->model('Core_model', 'core');
	}

	function redirectToUrl($url)
	{
		return redirect($url);
	}

	public function makeView($view)
	{
		$this->load->view("header", $this->data);
		$this->load->view("navbar", $this->data);
		$this->load->view($this->path . $view, $this->data);
		$this->load->view('footer', $this->data);
	}

	public function popupView($view)
	{
		$this->load->view($this->path . $view, $this->data);
	}

	function getUserData()
	{
		return isset($_SESSION["user"]) ? $_SESSION["user"] : false;
	}

	function getUserDataType()
	{
		return $this->getUserData()->type;
	}

	function ifLogin()
	{
		if ($this->getUserData()) {
			if ($this->getUserDataType() == 'Admin') {
				$url = 'admin/index';
			} else if ($this->getUserDataType() == 'Police') {
				$url = 'police/index';
			} else if ($this->getUserDataType() == 'Insurers') {
				$url = 'insurers/index';
			} else if ($this->getUserDataType() == 'Traffic Court') {
				$url = 'traffic/index';
			}
			return redirect($url);
		}
	}

	function ifNotLogin()
	{
		if (!$this->getUserData()) {
			$request_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
			$this->session->set_flashdata('danger', 'Access Protected');
			return $this->redirectToUrl(login_url('index') . "?redirect=" . $request_link, "Access Protected!<br>Please Login");
		}
	}

	function ifNotAdmin()
	{
		if ($this->getUserDataType() != 'Admin') {
			redirect();
		}
	}

	function ifNotPolice()
	{
		if ($this->getUserDataType() != 'Police') {
			redirect();
		}
	}

	function ifNotInsurers()
	{
		if ($this->getUserDataType() != 'Insurers') {
			redirect();
		}
	}

	function ifNotTraffic()
	{
		if ($this->getUserDataType() != 'Traffic Court') {
			redirect();
		}
	}

}
