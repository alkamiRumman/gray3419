<?php

/**
 * @property Traffic_model $traffic
 */
class Traffic extends MY_Controller
{
	public $path = '/traffic';

	function __construct()
	{
		parent::__construct();
		$this->ifNotLogin();
		$this->ifNotTraffic();
		$this->load->model('Traffic_model', 'traffic');
	}

	function index()
	{
		$this->data['title'] = 'Dashboard';
		$this->makeView('/index');
	}

}
