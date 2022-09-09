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

	public function get_project_quotation($projectId)
	{
		$pg = $this->db->get_where('project_quotation', ['projectId' => $projectId])->result_array();
		
		$html = "<option value='' disabled>-- Select Project Quotation --</option>";
		$html .= "<option value=''>SET EMPTY</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['projectQuotationId']."'>".$data['orderNo']." - ".$data['projectQuotationName']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_pq'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_proposed_cost($projectId)
	{
		$pg = $this->db->get_where('proposed_cost', ['projectId' => $projectId])->result_array();
		
		$html = "<option value='' disabled>-- Select Proposed Cost --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['proposedCostId']."'>".$data['proposedCostName']." - ".$data['proposedValue']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_pc'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_budget($projectId)
	{
		$pg = $this->db->get_where('budget', ['projectId' => $projectId])->result_array();
		
		$html = "<option value='' disabled>-- Select Budget --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['budgetId']."'>".$data['orderNo']." - ".$data['budget']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_budget'	=> $callback

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

	//PROJECT BUDGET
	function get_budget_data($projectId) {
		$list = $this->M_project->get_budget_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->orderNo;
			$row[] = $i->description;
			$row[] = $i->budget;
			$row[] = $i->createdAt;
			$row[] = $i->lastUpdate;
			$row[] = $i->isFinal == 0 ? 'No' : 'Yes';
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnBudgetEdit" data="'.$i->budgetId.'"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" class="btn btn-danger" id="btnBudgetDelete" data="'.$i->budgetId.'"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_budget_all($projectId),
			"recordsFiltered" => $this->M_project->count_budget_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_budget_data_by_id(){
		$budgetId = $this->input->get('id');
		$data = $this->M_project->get_budget_by_id($budgetId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_budget($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectId' => $projectId,
					'projectQuotationId' => empty($this->input->post('projectQuotationId', true)) ? null : $this->input->post('projectQuotationId', true),
					'orderNo' => $this->input->post('orderNo', true),
					'budget' => $this->input->post('budget', true),
					'description' => $this->input->post('description', true),
					'createdAt' => date('Y-m-d H:i:s'),
				];
	
				$q = $this->M_project->insert_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_budget($budgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'budgetId' => $budgetId,
					'projectQuotationId' => empty($this->input->post('projectQuotationId', true)) ? null : $this->input->post('projectQuotationId', true),
					'orderNo' => $this->input->post('orderNo', true),
					'budget' => $this->input->post('budget', true),
					'description' => $this->input->post('description', true),
					'isFinal' => $this->input->post('isFinal', true),
				];
	
				$q = $this->M_project->update_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete_budget($budgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$budgetId = $this->input->post('budgetId', true);
			$q = $this->M_project->delete_budget($budgetId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_budget()
	{
		$this->form_validation->set_rules('orderNo', 'Order No', 'required|trim');
		$this->form_validation->set_rules('budget', 'Budget', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}

	//PROPOSED COST
	function get_proposed_cost_data($projectId) {
		$list = $this->M_project->get_proposed_cost_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->proposedCostName;
			$row[] = $i->proposedDate;
			$row[] = $i->userName;
			$row[] = $i->proposedValue;
			$row[] = $i->detailDescription;
			$row[] = $i->isFinal == 0 ? 'No' : 'Yes';
			$row[] = $i->distributionDate == null ? '-' : $i->distributionDate;
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnProposedCostEdit" data="'.$i->proposedCostId.'"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" class="btn btn-danger" id="btnProposedCostDelete" data="'.$i->proposedCostId.'"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_proposed_cost_all($projectId),
			"recordsFiltered" => $this->M_project->count_proposed_cost_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_proposed_cost_data_by_id(){
		$proposedCostId = $this->input->get('id');
		$data = $this->M_project->get_proposed_cost_by_id($proposedCostId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_proposed_cost($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_cost();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectId' => $projectId,
					'proposedDate' => date('Y-m-d'),
					'proposedBy' => $this->session->userdata('userId'),
					'proposedCostName' => $this->input->post('proposedCostName', true),
					'proposedValue' => $this->input->post('proposedValue', true),
					'detailDescription' => $this->input->post('detailDescription', true),
				];
	
				$q = $this->M_project->insert_proposed_cost($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_proposed_cost($proposedCostId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_cost();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'proposedCostId' => $proposedCostId,
					'proposedCostName' => $this->input->post('proposedCostName', true),
					'proposedValue' => $this->input->post('proposedValue', true),
					'detailDescription' => $this->input->post('detailDescription', true),
					'distributionDate' => empty($this->input->post('distributionDate', true)) ? null : $this->input->post('distributionDate', true),
					'isFinal' => $this->input->post('isFinal', true),
				];
	
				$q = $this->M_project->update_proposed_cost($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete_proposed_cost($proposedCostId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$proposedCostId = $this->input->post('proposedCostId', true);
			$q = $this->M_project->delete_proposed_cost($proposedCostId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_proposed_cost()
	{
		$this->form_validation->set_rules('proposedCostName', 'Proposed Cost Name', 'required|trim');
		$this->form_validation->set_rules('proposedValue', 'Value', 'required|trim');
		$this->form_validation->set_rules('detailDescription', 'Description', 'required|trim');
	}

	//PROPOSED BUDGET
	function get_proposed_budget_data($projectId) {
		$list = $this->M_project->get_proposed_budget_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$userBudget = $this->db->get_where('user', ['userId' => $i->proposedBudgetBy])->row_array();
			$userApprove = $this->db->get_where('user', ['userId' => $i->approvedBy])->row_array();
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->orderNo;
			$row[] = $i->budget;
			$row[] = $i->proposedDate;
			$row[] = $i->proposedCostName;
			$row[] = $i->proposedValue;
			$row[] = $i->proposedBudgetDate;
			$row[] = $i->proposedBudgetDescription;
			$row[] = $userBudget['userName'];
			$row[] = $i->proposedBudgetValue;
			$row[] = $i->approvedDate;
			$row[] = $i->approvedDescription;
			$row[] = $userApprove['userName'];
			$row[] = $i->approvedValue;
			$row[] = $i->rejectedDate;
			$row[] = $i->rejectedDescription;
			$row[] = $i->isFinal == 0 ? 'No' : 'Yes';
			// add html for action
			$row[] = '<a href="#" class="btn btn-success" id="btnProposedBudgetApprove" data="'.$i->proposedBudgetId.'"><i class="fa fa-check"></i> Approve</a>
			<a href="#" class="btn btn-danger" id="btnProposedBudgetReject" data="'.$i->proposedBudgetId.'"><i class="fa fa-times"></i> Reject</a>
			<a href="#" class="btn btn-info" id="btnProposedBudgetEdit" data="'.$i->proposedBudgetId.'"><i class="fa fa-edit"></i> Edit</a>
			<a href="#" class="btn btn-danger" id="btnProposedBudgetDelete" data="'.$i->proposedBudgetId.'"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_proposed_budget_all($projectId),
			"recordsFiltered" => $this->M_project->count_proposed_budget_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_proposed_budget_data_by_id(){
		$proposedBudgetId = $this->input->get('id');
		$data = $this->M_project->get_proposed_budget_by_id($proposedBudgetId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_proposed_budget($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectId' => $projectId,
					'budgetId' => empty($this->input->post('budgetId', true)) ? null : $this->input->post('budgetId', true),
					'proposedCostId' => empty($this->input->post('proposedCostId', true)) ? null : $this->input->post('proposedCostId', true),
					'proposedBudgetDate' => date('Y-m-d'),
					'proposedBudgetBy' => $this->session->userdata('userId'),
					'proposedBudgetDescription' => $this->input->post('proposedBudgetDescription', true),
					'proposedBudgetValue' => $this->input->post('proposedBudgetValue', true),
				];
	
				$q = $this->M_project->insert_proposed_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_proposed_budget($proposedBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'proposedBudgetId' => $proposedBudgetId,
					'budgetId' => empty($this->input->post('budgetId', true)) ? null : $this->input->post('budgetId', true),
					'proposedCostId' => empty($this->input->post('proposedCostId', true)) ? null : $this->input->post('proposedCostId', true),
					'proposedBudgetDescription' => $this->input->post('proposedBudgetDescription', true),
					'proposedBudgetValue' => $this->input->post('proposedBudgetValue', true),
				];
	
				$q = $this->M_project->update_proposed_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete_proposed_budget($proposedBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$proposedBudgetId = $this->input->post('proposedBudgetId', true);
			$q = $this->M_project->delete_proposed_budget($proposedBudgetId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_proposed_budget()
	{
		$this->form_validation->set_rules('proposedCostId', 'Proposed Cost', 'required|trim');
		$this->form_validation->set_rules('budgetId', 'Budget', 'required|trim');
		$this->form_validation->set_rules('proposedBudgetDescription', 'Proposed Budget Name', 'required|trim');
		$this->form_validation->set_rules('proposedBudgetValue', 'Value', 'required|trim');
	}

	function approve_proposed_budget($proposedBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_budget_approve();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'proposedBudgetId' => $proposedBudgetId,
					'approvedDate' => date('Y-m-d'),
					'approvedBy' => $this->session->userdata('userId'),
					'approvedDescription' => $this->input->post('approvedDescription', true),
					'approvedValue' => $this->input->post('approvedValue', true),
				];
	
				$q = $this->M_project->update_proposed_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	private function validation_proposed_budget_approve()
	{
		$this->form_validation->set_rules('approvedDescription', 'Description', 'required|trim');
		$this->form_validation->set_rules('approvedValue', 'Value', 'required|trim');
	}

	function reject_proposed_budget($proposedBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_budget_reject();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'proposedBudgetId' => $proposedBudgetId,
					'rejectedDate' => date('Y-m-d'),
					'rejectedDescription' => $this->input->post('rejectedDescription', true),
					'isFinal' => $this->input->post('isFinal', true),
				];
	
				$q = $this->M_project->update_proposed_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	private function validation_proposed_budget_reject()
	{
		$this->form_validation->set_rules('rejectedDescription', 'Description', 'required|trim');
		$this->form_validation->set_rules('isFinal', 'Final', 'required|trim');
	}
}
