<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

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
    $data['title']		= 'Data Project';
		$this->load->view('project/data', $data);
	}

	function get_data() {
		$list = $this->M_project->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->generateId;
			$row[] = $i->groupName;
			$row[] = $i->projectGroupName;
			$row[] = $i->projectName;
			$row[] = $i->name;
			$row[] = $i->description;
			$row[] = $i->value;
			$row[] = $i->isFinal == 0 ? 'No' : 'Yes';
			$row[] = $i->isAddWork == 0 ? 'No' : 'Yes';
			// add html for action
			$row[] = '<a href="'.base_url('detail-project/'.$i->projectId).'" class="btn btn-light"><i class="fa fa-list"></i> Detail</a>
							<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->projectId.'"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->projectId.'"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_all(),
			"recordsFiltered" => $this->M_project->count_filtered(),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_data_by_id(){
		$projectId = $this->input->get('id');
		$data = $this->M_project->get_by_id($projectId);
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
				$generateId = $this->generateId();
				$data = [
					'generateId' => $generateId,
					'groupId' => $this->input->post('groupId', true),
					'clientId' => $this->input->post('clientId', true),
					'projectGroupId' => empty($this->input->post('projectGroupId', true)) ? null : $this->input->post('projectGroupId', true),
					'projectName' => $this->input->post('projectName', true),
					'description' => $this->input->post('description', true),
					'value' => $this->input->post('value', true),
				];
	
				$q = $this->M_project->insert($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectId' => $projectId,
					'groupId' => $this->input->post('groupId', true),
					'clientId' => $this->input->post('clientId', true),
					'projectGroupId' => empty($this->input->post('projectGroupId', true)) ? null : $this->input->post('projectGroupId', true),
					'projectName' => $this->input->post('projectName', true),
					'description' => $this->input->post('description', true),
					'value' => $this->input->post('value', true),
					'isFinal' => $this->input->post('isFinal', true),
					'isAddwork' => $this->input->post('isAddwork', true),
				];
	
				$q = $this->M_project->update($data);
				
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Edit!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$projectId = $this->input->post('projectId', true);
			$q = $this->M_project->delete($projectId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation()
	{
		$this->form_validation->set_rules('clientId', 'Client', 'required|trim');
		$this->form_validation->set_rules('groupId', 'Group', 'required|trim');
		$this->form_validation->set_rules('projectName', 'Project Name', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		$this->form_validation->set_rules('value', 'Value', 'required|trim');
	}

	public function get_client()
	{
		$client = $this->M_client->get_data()->result_array();
		
		$html = "<option disabled selected>-- Select Client --</option>";
		foreach($client as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['clientId']."'>".$data['name']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_client'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_group_project()
	{
		$pg = $this->db->get('project_group')->result_array();
		
		$html = "<option value='' disabled>-- Select Group --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['projectGroupId']."'>".$data['projectGroupName']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_group_project'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_group()
	{
		$userId = $this->session->userdata('userId');
		$this->db->select('*');
		$this->db->from('user_group');
		$this->db->join('group', 'group.groupId=user_group.groupId');
		$this->db->where('user_group.userId', $userId);
		$pg = $this->db->get()->result_array();
		
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

	public function get_quotation_header()
	{
		$pg = $this->M_quotationHeader->get_data()->result_array();
		
		$html = "<option value='' disabled>-- Select Quotation Header --</option>";
		$html .= "<option value=''>SET EMPTY</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['quotationHeaderId']."'>".$data['orderNo']." - ".$data['pdName']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_quotation_header'	=> $callback

		]; 
		echo json_encode($response);
	}

	function generateId(){
		$p = $this->M_project->get_data()->num_rows();
		$p = $p + 1;
		$char = strlen($p);
		$x;
		switch ($char) {
			case 1:
				$x = '00'.$p;
				break;
			case 2:
				$x = '0'.$p;
				break;
			case 3:
				$x = $p;
				break;
			default:
				$x = $p;
				break;
		}

		$id = date('ym').$x;

		return $id;
	}

	//Detail Project
	public function detail($projectId)
	{
    $data['title']		= 'Data Project';
		$data['project'] = $this->M_project->get_by_id($projectId);
		$this->load->view('project/detail', $data);
	}

	function get_quotation_data($projectId) {
		$list = $this->M_project->get_quotation_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->orderNo;
			$row[] = $i->projectQuotationName;
			$row[] = $i->description;
			$row[] = $i->quoteValue;
			$row[] = $i->estCost;
			$row[] = $i->detailDescription;
			$row[] = $i->isFinal == 0 ? 'No' : 'Yes';
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnQuotationEdit" data="'.$i->projectQuotationId.'"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" class="btn btn-danger" id="btnQuotationDelete" data="'.$i->projectQuotationId.'"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_quotation_all($projectId),
			"recordsFiltered" => $this->M_project->count_quotation_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_quotation_data_by_id(){
		$projectQuotationId = $this->input->get('id');
		$data = $this->M_project->get_project_quotation_by_id($projectQuotationId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_project_quotation($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_project_quotation();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectId' => $projectId,
					'quotationHeaderId' => empty($this->input->post('quotationHeaderId', true)) ? null : $this->input->post('quotationHeaderId', true),
					'orderNo' => $this->input->post('orderNo', true),
					'projectQuotationName' => $this->input->post('projectQuotationName', true),
					'quoteValue' => $this->input->post('quoteValue', true),
					'estCost' => $this->input->post('estCost', true),
					'description' => $this->input->post('description', true),
					'detailDescription' => $this->input->post('detailDescription', true),
				];
	
				$q = $this->M_project->insert_project_quotation($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_project_quotation($projectQuotationId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_project_quotation();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectQuotationId' => $projectQuotationId,
					'quotationHeaderId' => empty($this->input->post('quotationHeaderId', true)) ? null : $this->input->post('quotationHeaderId', true),
					'orderNo' => $this->input->post('orderNo', true),
					'projectQuotationName' => $this->input->post('projectQuotationName', true),
					'quoteValue' => $this->input->post('quoteValue', true),
					'estCost' => $this->input->post('estCost', true),
					'description' => $this->input->post('description', true),
					'detailDescription' => $this->input->post('detailDescription', true),
					'isFinal' => $this->input->post('isFinal', true),
				];
	
				$q = $this->M_project->update_project_quotation($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete_project_quotation($projectQuotationId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$projectQuotationId = $this->input->post('projectQuotationId', true);
			$q = $this->M_project->delete_project_quotation($projectQuotationId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_project_quotation()
	{
		$this->form_validation->set_rules('orderNo', 'Order No', 'required|trim');
		$this->form_validation->set_rules('projectQuotationName', 'Project Quotaion Name', 'required|trim');
		$this->form_validation->set_rules('estCost', 'Cost', 'required|trim');
		$this->form_validation->set_rules('quoteValue', 'Value', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		$this->form_validation->set_rules('detailDescription', 'Detail Description', 'required|trim');
	}
}
