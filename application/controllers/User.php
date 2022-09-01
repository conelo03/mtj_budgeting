<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('login') != TRUE)
		{
			set_pesan('Silahkan login terlebih dahulu', false);
			redirect('');
		}
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library('upload');
	}

	public function index()
	{
    $data['title']		= 'Data User';
		$this->load->view('user/data', $data);
	}

	function get_data() {
		$list = $this->M_user->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->userName;
			$row[] = $i->userEmail;
			$row[] = $i->userRole;
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->userId.'"><i class="fa fa-edit"></i>  Edit</a>
							<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->userId.'"><i class="fa fa-trash"></i>  Hapus</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_user->count_all(),
			"recordsFiltered" => $this->M_user->count_filtered(),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_data_by_id(){
		$userId = $this->input->get('id');
		$data = $this->M_user->get_by_id($userId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add(){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'userName' => $this->input->post('userName', true),
					'userEmail' => $this->input->post('userEmail', true),
					'userPassword' => password_hash($this->input->post('userPassword', true), PASSWORD_DEFAULT),
					'userRole' => 'all'
				];
	
				$q = $this->M_user->insert($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit($userId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$data = $this->M_user->get_by_id($userId);
			$this->validation($data['userEmail']);
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'userId' => $userId,
					'userName' => $this->input->post('userName', true),
					'userEmail' => $this->input->post('userEmail', true),
				];
	
				$q = $this->M_user->update($data);
				
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Edit!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete($userId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$userId = $this->input->post('userId', true);
			$q = $this->M_user->delete($userId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation($email = null)
	{
		$this->form_validation->set_rules('userName', 'Name', 'required|trim');
		$newEmail 	= $this->input->post('userEmail', true);
		if($email == null){
			$this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email|is_unique[user.userEmail]', ['is_unique'	=> 'Email Sudah Terdaftar']);
			$this->form_validation->set_rules('userPassword', 'Password', 'required|trim');
			$this->form_validation->set_rules('userPasswordConfirm', 'Konfirmasi Password', 'required|matches[userPassword]', ['matches'	=> 'Konfirmasi Password Salah']);
		}else{
			if($email == $newEmail){
				$this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email');	
			} else {
				$this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email|is_unique[user.userEmail]', ['is_unique'	=> 'Email Sudah Terdaftar']);
			}
		}
	}
}
