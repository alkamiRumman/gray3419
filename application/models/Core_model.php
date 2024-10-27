<?php

class Core_model extends CI_Model
{
	function __construct()
	{
		$this->titlesTable = 'titles';
		$this->itemsTable = 'items';
	}

	function getDailySale()
	{
		$date = date('Y-m-d', strtotime('-30 days'));
		$this->db->select('*');
		$this->db->from(TABLE_DAILYSALE);
		$this->db->where(array('date' => $date));
		return $this->db->get()->result();
	}

	function checkDailySale($customerId)
	{
		$this->db->select('*');
		$this->db->from(TABLE_REMINDER);
		$this->db->where(array('customerId' => $customerId, 'date' => date('Y-m-d')));
		return $this->db->get()->num_rows();
	}

	function saveReminder($arr)
	{
		$this->db->insert(TABLE_REMINDER, $arr);
	}
}
