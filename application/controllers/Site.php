<?php

	/**
	 * @property Site_model $site
	 */
	class Site extends MY_Controller {
		public $path = '/site';

		function __construct() {
			parent::__construct();
			$this->load->model('Site_model', 'site');
		}

		function index() {
			$this->ifLogin();
			$this->load->view('site/login');
		}

		function draganddrop() {
			$this->load->view('site/draganddrop');
		}

		function uploadFile(){
			$filename = $_FILES['file']['name'];

			/* Getting File size */
			$filesize = $_FILES['file']['size'];

			/* Location */
			$location = "uploads/".$filename;

			$return_arr = array();

			/* Upload file */
			if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
				$src = base_url('images/noImage.png');

				// checking file is image or not
				if(is_array(getimagesize($location))){
					$src = $location;
				}
				$return_arr = array("name" => $filename,"size" => $filesize, "src"=> $src);
			}

			echo json_encode($return_arr);
		}

		function verify() {
			$username = $this->input->post("username");
			$pass = $this->input->post("password");
			if ($user = $this->site->getUser($username)) {
				if (md5($pass) == $user->password) {
					$user = (array)$user;
					unset($user["password"]);
					$this->session->set_userdata("user", (object)$user);
					$this->session->set_flashdata('success', 'Login Succeed!');
					$this->ifLogin();
				} else {
					$this->session->set_flashdata('danger', 'Wrong Username or Password..');
					redirect($this->index());
				}
			} else {
				$this->session->set_flashdata('danger', 'User not exists!');
				redirect($this->index());
			}
		}

		function profile() {
			$this->data['user'] = getSession();
			$this->popupView('/profile');
		}

		function updateProfile($id) {
//			return dnd($_POST);
			$name = $arr['name'] = $this->input->post('name');
			if ($this->input->post('password')){
				$arr['password'] = md5($this->input->post('password'));
			}
			$config['upload_path'] = './images/' . $id;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['overwrite'] = true;

			if (!is_dir('images')) {
				mkdir('./images', 0777, true);
			}
			if (!is_dir('images/' . $id)) {
				mkdir('./images/' . $id, 0777, true);
			}
			$this->upload->initialize($config);
			$this->load->library('upload', $config);
			$this->upload->do_upload('profilePicture');
			$profile = $this->upload->data('file_name');

			if (!empty($_FILES['profilePicture']['name'])) {
				$arr['profilePicture'] = $profile;
				getSession()->profilePicture = $profile;
			}
//			$this->site->update($arr, $id);
			getSession()->name = $name;
//			$this->session->set_flashdata('success', 'Profile Updated!!');
			$this->session->set_flashdata('danger', 'Not Permitted!!');
			redirect(base_url());
		}

		function logout() {
			$this->session->unset_userdata('user');
			$this->session->set_flashdata('success', 'Successfully Logged Out!!');
			redirect(base_url());
		}

	}
