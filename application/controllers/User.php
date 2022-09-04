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
			$userId = $i->userId;
			$this->db->select('*');
			$this->db->from('user_group');
			$this->db->join('group', 'group.groupId=user_group.groupId');
			$this->db->where('user_group.userId', $userId);
			$userGroup = $this->db->get()->result_array();
			$userGroupDetail = '';
			foreach ($userGroup as $key) {
				$userGroupDetail .= '- '.$key['groupName']."<br>";
			}

			$this->db->select('*');
			$this->db->from('user_access');
			$this->db->join('access_right', 'access_right.accessRightId=user_access.accessRightId');
			$this->db->where('user_access.userId', $userId);
			$userAccess = $this->db->get()->result_array();
			$userAccessDetail = '';
			foreach ($userAccess as $key) {
				$userAccessDetail .= '- '.$key['accessName']."<br>";
			}

			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->userName;
			$row[] = $i->userEmail;
			$row[] = $userGroupDetail;
			$row[] = $userAccessDetail;
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

		$group = $this->db->get_where('user_group', ['userId' => $userId])->result_array();
		$arr_group = [];
		foreach ($group as $key) {
			array_push($arr_group, $key['groupId']);
		}

		$access = $this->db->get_where('user_access', ['userId' => $userId])->result_array();
		$arr_access = [];
		foreach ($access as $key) {
			array_push($arr_access, $key['accessRightId']);
		}

		$res = [
			'data' => $data,
			'arr_access' => $arr_access,
			'arr_group' => $arr_group,
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
				];

				$q = $this->M_user->insert($data);

				$userId = $this->db->insert_id();
				$access = $this->input->post('accessRightId', true);
				$group = $this->input->post('groupId', true);
				$arr_access = [];
				foreach ($access as $i) {
					$x = [
						'userId' => $userId,
						'accessRightId' => $i
					];
					array_push($arr_access, $x);
				}

				$arr_group = [];
				foreach ($group as $i) {
					$x = [
						'userId' => $userId,
						'groupId' => $i
					];
					array_push($arr_group, $x);
				}
				$this->db->insert_batch('user_access', $arr_access);
				$this->db->insert_batch('user_group', $arr_group);

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

				$access = $this->input->post('accessRightId', true);
				$group = $this->input->post('groupId', true);
				$arr_access = [];
				foreach ($access as $i) {
					$x = [
						'userId' => $userId,
						'accessRightId' => $i
					];
					array_push($arr_access, $x);
				}

				$arr_group = [];
				foreach ($group as $i) {
					$x = [
						'userId' => $userId,
						'groupId' => $i
					];
					array_push($arr_group, $x);
				}

				$this->db->delete('user_access', ['userId' => $userId]);
				$this->db->delete('user_group', ['userId' => $userId]);

				$this->db->insert_batch('user_access', $arr_access);
				$this->db->insert_batch('user_group', $arr_group);
				
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
		$this->form_validation->set_rules('accessRightId[]', 'Access', 'required|trim');
		$this->form_validation->set_rules('groupId[]', 'Group', 'required|trim');
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

	function get_access_data() {
		$list = $this->M_accessRight->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->accessName;
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnAccessEdit" data="'.$i->accessRightId.'"><i class="fa fa-edit"></i>  Edit</a>
							<a href="#" class="btn btn-danger" id="btnAccessDelete" data="'.$i->accessRightId.'"><i class="fa fa-trash"></i>  Hapus</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_accessRight->count_all(),
			"recordsFiltered" => $this->M_accessRight->count_filtered(),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_access_data_by_id(){
		$accessRightId = $this->input->get('id');
		$data = $this->M_accessRight->get_by_id($accessRightId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_access(){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_access();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'accessName' => $this->input->post('accessName', true),
				];
	
				$q = $this->M_accessRight->insert($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_access($accessRightId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_access();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'accessRightId' => $accessRightId,
					'accessName' => $this->input->post('accessName', true),
				];
	
				$q = $this->M_accessRight->update($data);
				
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Edit!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete_access($accessRightId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$accessRightId = $this->input->post('accessRightId', true);
			$q = $this->M_accessRight->delete($accessRightId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_access()
	{
		$this->form_validation->set_rules('accessName', 'Name', 'required|trim');
	}

	function get_group_data() {
		$list = $this->M_group->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->groupName;
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnGroupEdit" data="'.$i->groupId.'"><i class="fa fa-edit"></i>  Edit</a>
							<a href="#" class="btn btn-danger" id="btnGroupDelete" data="'.$i->groupId.'"><i class="fa fa-trash"></i>  Hapus</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_group->count_all(),
			"recordsFiltered" => $this->M_group->count_filtered(),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_group_data_by_id(){
		$groupId = $this->input->get('id');
		$data = $this->M_group->get_by_id($groupId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_user_group(){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_user_group();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'groupName' => $this->input->post('groupName', true),
				];
	
				$q = $this->M_group->insert($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_user_group($groupId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_user_group();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'groupId' => $groupId,
					'groupName' => $this->input->post('groupName', true),
				];
	
				$q = $this->M_group->update($data);
				
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Edit!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete_user_group($groupId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$groupId = $this->input->post('groupId', true);
			$q = $this->M_group->delete($groupId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_user_group()
	{
		$this->form_validation->set_rules('groupName', 'Name', 'required|trim');
	}

	public function get_user_access()
	{
		$pg = $this->M_accessRight->get_data()->result_array();
		
		$html = "<option value='' disabled>-- Select Access --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['accessRightId']."'>".$data['accessName']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_access'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_user_group()
	{
		$pg = $this->M_group->get_data()->result_array();
		
		$html = "<option value='' disabled>-- Select Group --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['groupId']."'>".$data['groupName']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_group'	=> $callback

		]; 
		echo json_encode($response);
	}
}
