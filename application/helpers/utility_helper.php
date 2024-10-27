<?php

function getSession()
{
	return $_SESSION['user'];
}

function isAdmin()
{
	return $_SESSION['user']->type === 'Admin' ? true : false;
}

function isPolice()
{
	return $_SESSION['user']->type === 'Police' ? true : false;
}

function isInsurers() {
	return $_SESSION['user']->type === 'Insurers' ? true : false;
}

function isTraffic() {
	return $_SESSION['user']->type === 'Traffic Court' ? true : false;
}

function dnd($var)
{
	echo '<pre style="border-top: 2px solid red; border-bottom: 2px solid green; margin: 5px 0">';
	var_dump($var);
	echo '</pre>';
}

function login_url($url = '')
{
	return base_url('site/' . $url);
}

function admin_url($url = '')
{
	return base_url('admin/' . $url);
}

function police_url($url = '')
{
	return base_url('police/' . $url);
}

function insurer_url($url = '')
{
	return base_url('insurers/' . $url);
}

function traffic_url($url = '')
{
	return base_url('traffic/' . $url);
}

function dnp($var)
{
	echo '<pre style="border-top: 2px solid red; border-bottom: 2px solid green; margin: 5px 0">';
	print_r($var);
	echo '</pre>';
}

function sendJson($data)
{
	header('Content-Type: application/json');
	echo json_encode($data);
}

function currentUserType()
{
	return $_SESSION["user"]->type;
}

