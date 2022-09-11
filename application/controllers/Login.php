<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'login');
	}

	public function index()
	{
		$data['title']	= 'Login';
		$this->load->view('login', $data);
	}

	public function proses()
	{
		$email = htmlspecialchars($this->input->post('email', true));
		$password = htmlspecialchars($this->input->post('password', true));
		
		$user = $this->login->get_user($email);
		if($user->num_rows() > 0)
		{
			$get_user = $user->row_array();
			if(password_verify($password, $get_user['userPassword']))
			{
				$this->session->set_userdata('login', TRUE);
				$this->session->set_userdata('userId', $get_user['userId']);
				$this->session->set_userdata('userName', $get_user['userName']);
				$this->session->set_userdata('userEmail', $get_user['userEmail']);
				$this->db->select('*');
				$this->db->from('user_access');
				$this->db->join('access_right', 'access_right.accessRightId=user_access.accessRightId');
				$this->db->where('user_access.userId', $get_user['userId']);
				$access = $this->db->get()->result_array();
				$arr_access = [];
				foreach ($access as $key) {
					array_push($arr_access, $key['accessName']);
				}
				$this->session->set_userdata('userAccess', $arr_access);
				redirect('dashboard');
			}
			else 
			{
				set_pesan('Wrong Email or Password', false);
				redirect('');
			}
		} 
		else 
		{
			set_pesan('Email not Registered', false);
			redirect('');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('userId');
		$this->session->unset_userdata('userName');
		$this->session->unset_userdata('userEmail');
		$this->session->unset_userdata('userAccess');
		set_pesan('You have successfully logged out', true);
		redirect('');
	}
}
