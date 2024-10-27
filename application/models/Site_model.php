<?php

	class Site_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		function getUser($username) {
			$this->db->select('*');
			$this->db->from(TABLE_USERS);
			$this->db->where(array('username' => $username));
			$query = $this->db->get();
			if ($query->num_rows()) {
				return $query->row();
			}
			return false;
		}

		function fetch_doctor($surgeryId) {
			$this->db->select('*');
			$this->db->where('surgeryId', $surgeryId);
			$this->db->order_by('name', 'ASC');
			$query = $this->db->get(TABLE_DOCTOR);
			$output = '<option value="">Please Select</option>';
			foreach ($query->result() as $row) {
				$output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
			}
			return $output;
		}

		function fetch_email($email) {
			$this->db->select('email');
			$this->db->where('email', $email);
			$query = $this->db->get(TABLE_USERS);
			if ($query->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}

		function getCouncil() {
			$this->db->select('*');
			$this->db->from(TABLE_COUNCIL);
			return $this->db->get()->result();
		}

		function getSurgery() {
			$this->db->select('*');
			$this->db->from(TABLE_SURGERY);
			return $this->db->get()->result();
		}

		function getSchool() {
			$this->db->select('*');
			$this->db->from(TABLE_SCHOOL);
			return $this->db->get()->result();
		}

		function saveUser($arr) {
			$this->db->insert(TABLE_USERS, $arr);
		}

		function saveChaperone($arr) {
			$this->db->insert(TABLE_CHAPERONE, $arr);
		}

		function saveMember($arr) {
			$this->db->insert(TABLE_MEMBER, $arr);
		}

		function update($arr, $id){
			$this->db->update(TABLE_USERS, $arr, array('id' => $id));
		}
	}
