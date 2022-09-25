<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('login') != TRUE)
		{
			set_pesan('Silahkan login terlebih dahulu', false);
			redirect('administrator');
		}
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index()
	{
		$data['title']	= 'Dashboard';
		$this->load->view('dashboard', $data);
	}

	public function get_data()
	{
		$pendingProject = $this->db->get_where('project', ['status' => 'PENDING'])->num_rows();
		$onGoingProject = $this->db->get_where('project', ['status' => 'ON GOING'])->num_rows();
		$completedProject = $this->db->get_where('project', ['status' => 'COMPLETED'])->num_rows();
		$totalProject = $this->db->get('project')->num_rows();

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_access', 'user_access.userId=user.userId');
		$this->db->join('access_right', 'access_right.accessRightId=user_access.accessRightId');
		$this->db->where('access_right.accessName', 'Administrator');
		$admin = $this->db->get()->num_rows();

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_access', 'user_access.userId=user.userId');
		$this->db->join('access_right', 'access_right.accessRightId=user_access.accessRightId');
		$this->db->where('access_right.accessName', 'Finance');
		$finance = $this->db->get()->num_rows();

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_access', 'user_access.userId=user.userId');
		$this->db->join('access_right', 'access_right.accessRightId=user_access.accessRightId');
		$this->db->where('access_right.accessName', 'Project Manager');
		$pm = $this->db->get()->num_rows();

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_access', 'user_access.userId=user.userId');
		$this->db->join('access_right', 'access_right.accessRightId=user_access.accessRightId');
		$this->db->where('access_right.accessName', 'Pengawas Lapangan');
		$waspang = $this->db->get()->num_rows();

		$response = [
			'response' => true,
			'pendingProject'	=> $pendingProject,
			'onGoingProject'	=> $onGoingProject,
			'completedProject'	=> $completedProject,
			'totalProject'	=> $totalProject,
			'admin'	=> $admin,
			'finance'	=> $finance,
			'pm'	=> $pm,
			'waspang'	=> $waspang,

		]; 
		echo json_encode($response);
	}
}
