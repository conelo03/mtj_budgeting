<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectGroup extends CI_Controller {

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
    $data['title']		= 'Data Project Group';
		$this->load->view('projectGroup/data', $data);
	}

	function get_data() {
		$list = $this->M_projectGroup->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->projectGroupName;
			$row[] = $i->description;
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->projectGroupId.'"><i class="fa fa-edit"></i>  Edit</a>
							<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->projectGroupId.'"><i class="fa fa-trash"></i>  Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_projectGroup->count_all(),
			"recordsFiltered" => $this->M_projectGroup->count_filtered(),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_data_by_id(){
		$projectGroupId = $this->input->get('id');
		$data = $this->M_projectGroup->get_by_id($projectGroupId);
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
					'projectGroupName' => $this->input->post('projectGroupName', true),
					'description' => $this->input->post('description', true)
				];
	
				$q = $this->M_projectGroup->insert($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit($projectGroupId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectGroupId' => $projectGroupId,
					'projectGroupName' => $this->input->post('projectGroupName', true),
					'description' => $this->input->post('description', true)
				];
	
				$q = $this->M_projectGroup->update($data);
				
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Edit!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete($projectGroupId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$projectGroupId = $this->input->post('projectGroupId', true);
			$q = $this->M_projectGroup->delete($projectGroupId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation()
	{
		$this->form_validation->set_rules('projectGroupName', 'Name', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}
}
