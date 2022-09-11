<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

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
    $data['title']		= 'Data Client';
		$this->load->view('client/data', $data);
	}

	function get_data() {
		$list = $this->M_client->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->name;
			$row[] = $i->description;
			// add html for action
			if(is_manager_leader()){
				$row[] = '<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->clientId.'"><i class="fa fa-edit"></i>  Edit</a>
							<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->clientId.'"><i class="fa fa-trash"></i>  Delete</a>';
			}else{
				$row[] = '';
			}
			
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_client->count_all(),
			"recordsFiltered" => $this->M_client->count_filtered(),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_data_by_id(){
		$clientId = $this->input->get('id');
		$data = $this->M_client->get_by_id($clientId);
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
					'name' => $this->input->post('name', true),
					'description' => $this->input->post('description', true)
				];
	
				$q = $this->M_client->insert($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit($clientId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'clientId' => $clientId,
					'name' => $this->input->post('name', true),
					'description' => $this->input->post('description', true)
				];
	
				$q = $this->M_client->update($data);
				
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Edit!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete($clientId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$clientId = $this->input->post('clientId', true);
			$q = $this->M_client->delete($clientId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}
}
