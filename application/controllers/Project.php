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
			// $row[] = $userTeamDetail;
			$row[] = $i->projectGroupName;
			$row[] = $i->projectName;
			$row[] = $i->name;
			$row[] = $i->description;
			$row[] = (is_project_manager() || is_finance()) ? currency($i->value) : '-';
			$row[] = badge_status($i->approved);
			$row[] = badge_status($i->status);
			// add html for action

			if($i->approved == 'PENDING'){
				if (is_finance() && is_project_manager()) {
					$row[] = '<a href="#" class="btn btn-success" id="btnApprove" data="'.$i->projectId.'"><i class="fa fa-check"></i> Approve</a>
								<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->projectId.'"><i class="fa fa-edit"></i> Edit</a>
								<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->projectId.'"><i class="fa fa-trash"></i> Delete</a>';
				} elseif (is_project_manager()) {
					$row[] = '<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->projectId.'"><i class="fa fa-edit"></i> Edit</a>
								<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->projectId.'"><i class="fa fa-trash"></i> Delete</a>';
				} elseif (is_finance()) {
					$row[] = '<a href="#" class="btn btn-success" id="btnApprove" data="'.$i->projectId.'"><i class="fa fa-check"></i> Approve</a>';
				} else {
					$row[] = '';
				}
			} else {
				if (is_project_manager()) {
					$row[] = '<a href="'.base_url('detail-project/'.$i->projectId).'" class="btn btn-light"><i class="fa fa-list"></i> Detail</a>
							<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->projectId.'"><i class="fa fa-edit"></i> Edit</a>';
				} else {
					$row[] = '<a href="'.base_url('detail-project/'.$i->projectId).'" class="btn btn-light"><i class="fa fa-list"></i> Detail</a>';
				}
			}

			// if (is_project_manager() || is_finance()) {
			// 	$row[] = '<a href="'.base_url('detail-project/'.$i->projectId).'" class="btn btn-light"><i class="fa fa-list"></i> Detail</a>
			// 				<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->projectId.'"><i class="fa fa-edit"></i> Edit</a>
			// 				<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->projectId.'"><i class="fa fa-trash"></i> Delete</a>';
			// } else {
			// 	$row[] = '<a href="'.base_url('detail-project/'.$i->projectId).'" class="btn btn-light"><i class="fa fa-list"></i> Detail</a>';
			// }
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

		$team = $this->db->get_where('team_member', ['projectId' => $projectId])->result_array();
		$arr_team = [];
		foreach ($team as $key) {
			array_push($arr_team, $key['userId']);
		}

		$res = [
			'data' => $data,
			'arr_team' => $arr_team,
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
					'userId' => $this->session->userdata('userId'),
					'clientId' => $this->input->post('clientId', true),
					'projectGroupId' => empty($this->input->post('projectGroupId', true)) ? null : $this->input->post('projectGroupId', true),
					'projectName' => $this->input->post('projectName', true),
					'description' => $this->input->post('description', true),
					'value' => $this->input->post('value', true),
					'approved' => 'PENDING',
					'status' => 'PENDING'
				];
	
				$q = $this->M_project->insert($data);

				$projectId = $this->db->insert_id();
				$team = $this->input->post('userId', true);
				//$group = $this->input->post('groupId', true);
				$arr_team = [];
				foreach ($team as $i) {
					$x = [
						'projectId' => $projectId,
						'userId' => $i,
					];
					array_push($arr_team, $x);
				}

				
				$this->db->insert_batch('team_member', $arr_team);
	
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
			$this->validation($projectId);
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$value = $this->input->post('value', true);
				$project = $this->M_project->get_by_id($projectId);
				if($project['approved'] != 'PENDING'){
					$value = $project['value'];
				}
				$data = [
					'projectId' => $projectId,
					'clientId' => $this->input->post('clientId', true),
					'projectGroupId' => empty($this->input->post('projectGroupId', true)) ? null : $this->input->post('projectGroupId', true),
					'projectName' => $this->input->post('projectName', true),
					'description' => $this->input->post('description', true),
					'value' => $value,
					'status' => $this->input->post('status', true),
				];
	
				$q = $this->M_project->update($data);

				$team = $this->input->post('userId', true);
				//$group = $this->input->post('groupId', true);
				$arr_team = [];
				foreach ($team as $i) {
					$x = [
						'projectId' => $projectId,
						'userId' => $i,
					];
					array_push($arr_team, $x);
				}

				
				$this->db->delete('team_member', ['projectId' => $projectId]);
				
				$this->db->insert_batch('team_member', $arr_team);
				
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

	function approve($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$projectId = $this->input->post('projectId', true);
			$data = [
				'projectId' => $projectId,
				'approved' => 'APPROVED',
				'approvedBy' => $this->session->userdata('userId'),
			];

			$q = $this->M_project->update($data);

			$project = $this->M_project->get_by_id($projectId);

			if($q){
				$data = [
					'projectId' => $projectId,
					'orderNo' => '-',
					'budget' => $project['value'],
					'description' => 'Initial Budget',
					'createdAt' => date('Y-m-d H:i:s'),
					'approved' => 'APPROVED',
					'approvedBy' => $this->session->userdata('userId'),
				];
	
				$q = $this->M_project->insert_budget($data);
			}

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Approved Successfully!' : 'Data Failed to Approve!'
			];
			echo json_encode($res);
		}
	}

	private function validation($projectId = null)
	{
		$project = $this->M_project->get_by_id($projectId);
		if($project['approved'] == 'PENDING'){
			$this->form_validation->set_rules('value', 'Value', 'required|trim');
		}else{
			$this->form_validation->set_rules('value', 'Value', 'trim');
		}
		$this->form_validation->set_rules('clientId', 'Client', 'required|trim');
		$this->form_validation->set_rules('userId[]', 'Team', 'required|trim');
		$this->form_validation->set_rules('projectName', 'Project Name', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
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
		$html .= "<option value='' >SET EMPTY</option>";
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
		
		$html = "<option value='' disabled selected>-- Select Proposed Cost --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['proposedCostId']."'>".$data['proposedCostName']." - ".currency($data['proposedValue'])."</option>"; // Tambahkan tag option ke variabel $html
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
			$html .= "<option value='".$data['budgetId']."'>".$data['orderNo']." - ".currency($data['budget'])."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_budget'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_real_budget($projectId)
	{
		$pg = $this->db->get_where('real_budget', ['projectId' => $projectId])->result_array();
		
		$html = "<option value='' disabled selected>-- Select Real Budget --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['realBudgetId']."'>".currency($data['realBudgetValue'])." - ".$data['description']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_rb'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_user($projectId)
	{
		$team = $this->M_user->get_team_member($projectId)->result_array();
		
		$html = "<option value='' disabled selected>-- Select Holder --</option>";
		foreach($team as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['userId']."'>".$data['userName']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_user'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_team()
	{
		$team = $this->M_user->get_pengawas_lapangan()->result_array();
		
		$html = "<option value='' disabled>-- Select Team --</option>";
		foreach($team as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['userId']."'>".$data['userName']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_team'	=> $callback

		]; 
		echo json_encode($response);
	}

	public function get_distribution_cost($projectId)
	{
		$pg = $this->db->get_where('distribution_cost', ['projectId' => $projectId])->result_array();
		
		$html = "<option value='' disabled selected>-- Select Distribution Cost --</option>";
		foreach($pg as $data){ // Ambil semua data dari hasil eksekusi $sql
			$html .= "<option value='".$data['distributionCostId']."'>".currency($data['value'])." - ".$data['description']."</option>"; // Tambahkan tag option ke variabel $html
		}
		$callback = array('data'=>$html); // Masukan variabel html tadi ke dalam array $callback dengan index array : data_kota
		$response = [
			'response' => true,
			'data_dc'	=> $callback

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
			$row[] = currency($i->quoteValue);
			$row[] = currency($i->estCost);
			$row[] = $i->detailDescription;
			$row[] = $i->isFinal == 0 ? 'No' : 'Yes';
			// add html for action

			if (is_administrator() || is_project_manager()) {
				$row[] = '<a href="#" class="btn btn-info" id="btnQuotationEdit" data="'.$i->projectQuotationId.'"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" class="btn btn-danger" id="btnQuotationDelete" data="'.$i->projectQuotationId.'"><i class="fa fa-trash"></i> Delete</a>';
			} else {
				$row[] = '';
			}
			
			
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
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
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
			$row[] = currency($i->budget);
			$row[] = $i->createdAt;
			$row[] = $i->lastUpdate;
			$row[] = badge_status($i->approved);
			// add html for action

			if($i->approved == 'PENDING'){
				if (is_finance() && is_project_manager()) {
					$row[] = '<a href="#" class="btn btn-success" id="btnBudgetApprove" data="'.$i->budgetId.'"><i class="fa fa-check"></i> Approve</a>
								<a href="#" class="btn btn-info" id="btnBudgetEdit" data="'.$i->budgetId.'"><i class="fa fa-edit"></i> Edit</a>
								<a href="#" class="btn btn-danger" id="btnBudgetDelete" data="'.$i->budgetId.'"><i class="fa fa-trash"></i> Delete</a>';
				} elseif (is_project_manager()) {
					$row[] = '<a href="#" class="btn btn-info" id="btnBudgetEdit" data="'.$i->budgetId.'"><i class="fa fa-edit"></i> Edit</a>
								<a href="#" class="btn btn-danger" id="btnBudgetDelete" data="'.$i->budgetId.'"><i class="fa fa-trash"></i> Delete</a>';
				} elseif (is_finance()) {
					$row[] = '<a href="#" class="btn btn-success" id="btnBudgetApprove" data="'.$i->budgetId.'"><i class="fa fa-check"></i> Approve</a>';
				} else {
					$row[] = '';
				}
			} else {
				if (is_project_manager()) {
					$row[] = '<a href="#" class="btn btn-info" id="btnBudgetEdit" data="'.$i->budgetId.'"><i class="fa fa-edit"></i> Edit</a>';
				} else {
					$row[] = '';
				}
			}
			
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
					'orderNo' => $this->input->post('orderNo', true),
					'budget' => $this->input->post('budget', true),
					'description' => $this->input->post('description', true),
					'createdAt' => date('Y-m-d H:i:s'),
					'approved' => 'PENDING'
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
			$this->validation_budget($budgetId);
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$budget = $this->input->post('budget', true);
				$b = $this->M_project->get_budget_by_id($budgetId);
				if($b['approved'] != 'PENDING'){
					$budget = $b['budget'];
				}
				$data = [
					'budgetId' => $budgetId,
					'orderNo' => $this->input->post('orderNo', true),
					'budget' => $budget,
					'description' => $this->input->post('description', true),
				];
	
				$q = $this->M_project->update_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
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

	function approve_budget($budgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$budgetId = $this->input->post('budgetId', true);
			$data = [
				'budgetId' => $budgetId,
				'approved' => 'APPROVED',
				'approvedBy' => $this->session->userdata('userId'),
			];

			$q = $this->M_project->update_budget($data);

			if($q){
				$b = $this->M_project->get_budget_by_id($budgetId);

				$this->db->select_sum('budget');
				$this->db->from('budget');
				$this->db->where('projectId', $b['projectId']);
				$value = $this->db->get()->row_array();

				$data = [
					'projectId' => $b['projectId'],
					'value' => $value['budget'],
				];
	
				$q = $this->M_project->update($data);

			}

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Approved Successfully!' : 'Data Failed to Approve!'
			];
			echo json_encode($res);
		}
	}

	private function validation_budget($budgetId = null)
	{
		$b = $this->M_project->get_budget_by_id($budgetId);
		if($b['approved'] == 'PENDING'){
			$this->form_validation->set_rules('budget', 'Budget', 'required|trim');
		}else{
			$this->form_validation->set_rules('budget', 'Budget', 'trim');
		}
		$this->form_validation->set_rules('orderNo', 'Order No', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}

	//PROPOSED COST
	function get_proposed_cost_data($projectId) {
		$list = $this->M_project->get_proposed_cost_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$userReject = $this->db->get_where('user', ['userId' => $i->rejectedBy])->row_array();
			$userApprove = $this->db->get_where('user', ['userId' => $i->approvedBy])->row_array();
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->proposedCostName;
			$row[] = $i->proposedDate;
			$row[] = $i->userName;
			$row[] = currency($i->proposedValue);
			$row[] = $i->detailDescription;
			$row[] = badge_status($i->approved);
			$row[] = $i->approvedDate;
			$row[] = $userApprove['userName'];
			$row[] = currency($i->approvedValue);
			$row[] = $i->approvedDescription;
			$row[] = $userReject['userName'];
			$row[] = $i->rejectedDate;
			$row[] = $i->rejectedDescription;
			// add html for action

			if($i->approved == 'PENDING'){
				if (is_pengawas_lapangan() && is_project_manager()) {
					$row[] = '<a href="#" class="btn btn-success" id="btnProposedCostApprove" data="'.$i->proposedCostId.'"><i class="fa fa-check"></i> Approve</a>
							<a href="#" class="btn btn-info" id="btnProposedCostEdit" data="'.$i->proposedCostId.'"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" class="btn btn-danger" id="btnProposedCostDelete" data="'.$i->proposedCostId.'"><i class="fa fa-trash"></i> Delete</a>';
				} elseif (is_pengawas_lapangan()) {
					$row[] = '<a href="#" class="btn btn-info" id="btnProposedCostEdit" data="'.$i->proposedCostId.'"><i class="fa fa-edit"></i> Edit</a>
							<a href="#" class="btn btn-danger" id="btnProposedCostDelete" data="'.$i->proposedCostId.'"><i class="fa fa-trash"></i> Delete</a>';
				} elseif (is_project_manager()) {
					$row[] = '<a href="#" class="btn btn-success" id="btnProposedCostApprove" data="'.$i->proposedCostId.'"><i class="fa fa-check"></i> Approve</a>';
				} else {
					$row[] = '';
				}
			} elseif($i->approved == 'APPROVED') {
				if (is_finance()) {
					$row[] = '<a href="#" class="btn btn-danger" id="btnProposedCostReject" data="'.$i->proposedCostId.'"><i class="fa fa-times"></i> Reject</a>';
				} else {
					$row[] = '';
				}
			} else {
				$row[] = '';
			}
			
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
					'approved' => 'PENDING',
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
					'proposedBy' => $this->session->userdata('userId'),
					'proposedCostName' => $this->input->post('proposedCostName', true),
					'proposedValue' => $this->input->post('proposedValue', true),
					'detailDescription' => $this->input->post('detailDescription', true),
				];
	
				$q = $this->M_project->update_proposed_cost($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
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

	function approve_proposed_cost($proposedCostId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_cost_approve();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'proposedCostId' => $proposedCostId,
					'budgetId' => $this->input->post('budgetId', true),
					'approved' => 'APPROVED',
					'approvedDate' => date('Y-m-d'),
					'approvedBy' => $this->session->userdata('userId'),
					'approvedDescription' => $this->input->post('approvedDescription', true),
					'approvedValue' => $this->input->post('approvedValue', true),
				];
	
				$q = $this->M_project->update_proposed_cost($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Updated Successfully!' : 'Data Failed to Update!'
				];
			}
			echo json_encode($res);
		}
	}

	private function validation_proposed_cost_approve()
	{
		$this->form_validation->set_rules('budgetId', 'Budget', 'required|trim');
		$this->form_validation->set_rules('approvedDescription', 'Description', 'required|trim');
		$this->form_validation->set_rules('approvedValue', 'Value', 'required|trim');
	}

	function reject_proposed_cost($proposedCostId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_proposed_cost_reject();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'proposedCostId' => $proposedCostId,
					'rejectedDate' => date('Y-m-d'),
					'rejectedDescription' => $this->input->post('rejectedDescription', true),
					'rejectedBy' => $this->session->userdata('userId'),
					'approved' => 'REJECTED'
				];
	
				$q = $this->M_project->update_proposed_cost($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Updated Successfully!' : 'Data Failed to Update!'
				];
			}
			echo json_encode($res);
		}
	}

	private function validation_proposed_cost_reject()
	{
		$this->form_validation->set_rules('rejectedDescription', 'Description', 'required|trim');
	}

	// //PROPOSED BUDGET
	// function get_proposed_budget_data($projectId) {
	// 	$list = $this->M_project->get_proposed_budget_datatables($projectId);
	// 	$data = array();
	// 	$no = @$_POST['start'];
	// 	foreach ($list as $i) {
	// 		$userBudget = $this->db->get_where('user', ['userId' => $i->proposedBudgetBy])->row_array();
	// 		$userApprove = $this->db->get_where('user', ['userId' => $i->approvedBy])->row_array();
	// 		$no++;
	// 		$row = array();
	// 		$row[] = $no.".";
	// 		$row[] = $i->orderNo;
	// 		$row[] = currency($i->budget);
	// 		$row[] = $i->proposedDate;
	// 		$row[] = $i->proposedCostName;
	// 		$row[] = currency($i->proposedValue);
	// 		$row[] = $i->proposedBudgetDate;
	// 		$row[] = $i->proposedBudgetDescription;
	// 		$row[] = $userBudget['userName'];
	// 		$row[] = currency($i->proposedBudgetValue);
	// 		$row[] = $i->approvedDate;
	// 		$row[] = $i->approvedDescription;
	// 		$row[] = $userApprove['userName'];
	// 		$row[] = currency($i->approvedValue);
	// 		$row[] = $i->rejectedDate;
	// 		$row[] = $i->rejectedDescription;
	// 		$row[] = $i->isFinal == 0 ? 'No' : 'Yes';
	// 		// add html for action

	// 		if (is_project_manager()) {
	// 			$row[] = '<a href="#" class="btn btn-info" id="btnProposedBudgetEdit" data="'.$i->proposedBudgetId.'"><i class="fa fa-edit"></i> Edit</a>
	// 			<a href="#" class="btn btn-danger" id="btnProposedBudgetDelete" data="'.$i->proposedBudgetId.'"><i class="fa fa-trash"></i> Delete</a>';
	// 		} elseif (is_administrator()) {
	// 			$row[] = '<a href="#" class="btn btn-success" id="btnProposedBudgetApprove" data="'.$i->proposedBudgetId.'"><i class="fa fa-check"></i> Approve</a>';
	// 		} elseif (is_finance()) {
	// 			$row[] = '<a href="#" class="btn btn-danger" id="btnProposedBudgetReject" data="'.$i->proposedBudgetId.'"><i class="fa fa-times"></i> Reject</a>';
	// 		} else {
	// 			$row[] = '';
	// 		}
			
			
	// 		$data[] = $row;
	// 	}
	// 	$output = [
	// 		"draw" => @$_POST['draw'],
	// 		"recordsTotal" => $this->M_project->count_proposed_budget_all($projectId),
	// 		"recordsFiltered" => $this->M_project->count_proposed_budget_filtered($projectId),
	// 		"data" => $data,
	// 	];
	// 	// output to json format
	// 	echo json_encode($output);
	// }

	// function get_proposed_budget_data_by_id(){
	// 	$proposedBudgetId = $this->input->get('id');
	// 	$data = $this->M_project->get_proposed_budget_by_id($proposedBudgetId);
	// 	$res = [
	// 		'data' => $data,
	// 		'response' => $data ? true : false,
	// 	];

	// 	echo json_encode($res);
	// }

	// function add_proposed_budget($projectId){
	// 	$res = [];
	// 	if($this->input->is_ajax_request() == true){
	// 		$this->validation_proposed_budget();
	// 		if (!$this->form_validation->run()) {
	// 			$res = [
	// 				'error' => validation_errors()
	// 			];
	// 		}else{
	// 			$data = [
	// 				'projectId' => $projectId,
	// 				'budgetId' => empty($this->input->post('budgetId', true)) ? null : $this->input->post('budgetId', true),
	// 				'proposedCostId' => empty($this->input->post('proposedCostId', true)) ? null : $this->input->post('proposedCostId', true),
	// 				'proposedBudgetDate' => date('Y-m-d'),
	// 				'proposedBudgetBy' => $this->session->userdata('userId'),
	// 				'proposedBudgetDescription' => $this->input->post('proposedBudgetDescription', true),
	// 				'proposedBudgetValue' => $this->input->post('proposedBudgetValue', true),
	// 			];
	
	// 			$q = $this->M_project->insert_proposed_budget($data);
	
	// 			$res = [
	// 				'data' => $data,
	// 				'response' => $q,
	// 				'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
	// 			];
	// 		}
	// 		echo json_encode($res);
	// 	}
	// }

	// function edit_proposed_budget($proposedBudgetId){
	// 	$res = [];
	// 	if($this->input->is_ajax_request() == true){
	// 		$this->validation_proposed_budget();
	// 		if (!$this->form_validation->run()) {
	// 			$res = [
	// 				'error' => validation_errors()
	// 			];
	// 		}else{
	// 			$data = [
	// 				'proposedBudgetId' => $proposedBudgetId,
	// 				'budgetId' => empty($this->input->post('budgetId', true)) ? null : $this->input->post('budgetId', true),
	// 				'proposedCostId' => empty($this->input->post('proposedCostId', true)) ? null : $this->input->post('proposedCostId', true),
	// 				'proposedBudgetDate' => date('Y-m-d'),
	// 				'proposedBudgetBy' => $this->session->userdata('userId'),
	// 				'proposedBudgetDescription' => $this->input->post('proposedBudgetDescription', true),
	// 				'proposedBudgetValue' => $this->input->post('proposedBudgetValue', true),
	// 			];
	
	// 			$q = $this->M_project->update_proposed_budget($data);
	
	// 			$res = [
	// 				'data' => $data,
	// 				'response' => $q,
	// 				'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
	// 			];
	// 		}
	// 		echo json_encode($res);
	// 	}
	// }

	// function delete_proposed_budget($proposedBudgetId){
	// 	$res = [];
	// 	if($this->input->is_ajax_request() == true){
	// 		$proposedBudgetId = $this->input->post('proposedBudgetId', true);
	// 		$q = $this->M_project->delete_proposed_budget($proposedBudgetId);

	// 		$res = [
	// 			'response' => $q,
	// 			'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
	// 		];
	// 		echo json_encode($res);
	// 	}
	// }

	// private function validation_proposed_budget()
	// {
	// 	$this->form_validation->set_rules('proposedCostId', 'Proposed Cost', 'required|trim');
	// 	$this->form_validation->set_rules('budgetId', 'Budget', 'required|trim');
	// 	$this->form_validation->set_rules('proposedBudgetDescription', 'Proposed Budget Name', 'required|trim');
	// 	$this->form_validation->set_rules('proposedBudgetValue', 'Value', 'required|trim');
	// }

	// function approve_proposed_budget($proposedBudgetId){
	// 	$res = [];
	// 	if($this->input->is_ajax_request() == true){
	// 		$this->validation_proposed_budget_approve();
	// 		if (!$this->form_validation->run()) {
	// 			$res = [
	// 				'error' => validation_errors()
	// 			];
	// 		}else{
	// 			$data = [
	// 				'proposedBudgetId' => $proposedBudgetId,
	// 				'approvedDate' => date('Y-m-d'),
	// 				'approvedBy' => $this->session->userdata('userId'),
	// 				'approvedDescription' => $this->input->post('approvedDescription', true),
	// 				'approvedValue' => $this->input->post('approvedValue', true),
	// 			];
	
	// 			$q = $this->M_project->update_proposed_budget($data);
	
	// 			$res = [
	// 				'data' => $data,
	// 				'response' => $q,
	// 				'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
	// 			];
	// 		}
	// 		echo json_encode($res);
	// 	}
	// }

	// private function validation_proposed_budget_approve()
	// {
	// 	$this->form_validation->set_rules('approvedDescription', 'Description', 'required|trim');
	// 	$this->form_validation->set_rules('approvedValue', 'Value', 'required|trim');
	// }

	// function reject_proposed_budget($proposedBudgetId){
	// 	$res = [];
	// 	if($this->input->is_ajax_request() == true){
	// 		$this->validation_proposed_budget_reject();
	// 		if (!$this->form_validation->run()) {
	// 			$res = [
	// 				'error' => validation_errors()
	// 			];
	// 		}else{
	// 			$data = [
	// 				'proposedBudgetId' => $proposedBudgetId,
	// 				'rejectedDate' => date('Y-m-d'),
	// 				'rejectedDescription' => $this->input->post('rejectedDescription', true),
	// 				'isFinal' => $this->input->post('isFinal', true),
	// 			];
	
	// 			$q = $this->M_project->update_proposed_budget($data);
	
	// 			$res = [
	// 				'data' => $data,
	// 				'response' => $q,
	// 				'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
	// 			];
	// 		}
	// 		echo json_encode($res);
	// 	}
	// }

	// private function validation_proposed_budget_reject()
	// {
	// 	$this->form_validation->set_rules('rejectedDescription', 'Description', 'required|trim');
	// 	$this->form_validation->set_rules('isFinal', 'Final', 'required|trim');
	// }

	//DISTRIBUTION COST
	function get_distribution_cost_data($projectId) {
		$list = $this->M_project->get_distribution_cost_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$user = $this->db->get_where('user', ['userId' => $i->holder])->row_array();
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->proposedCostName;
			$row[] = $i->proposedDate;
			$row[] = $i->userName;
			$row[] = $user['userName'];
			$row[] = currency($i->value);
			$row[] = $i->description;
			// add html for action

			if (is_finance()) {
				$row[] = '<a href="#" class="btn btn-info" id="btnDistributionCostEdit" data="'.$i->distributionCostId.'"><i class="fa fa-edit"></i> Edit</a>
			<a href="#" class="btn btn-danger" id="btnDistributionCostDelete" data="'.$i->distributionCostId.'"><i class="fa fa-trash"></i> Delete</a>';
			} else {
				$row[] = '';
			}
			
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_distribution_cost_all($projectId),
			"recordsFiltered" => $this->M_project->count_distribution_cost_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_distribution_cost_data_by_id(){
		$distributionCostId = $this->input->get('id');
		$data = $this->M_project->get_distribution_cost_by_id($distributionCostId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_distribution_cost($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_distribution_cost();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$proposedCostId = $this->input->post('proposedCostId', true);
				$value = $this->input->post('value', true);

				$this->db->select_sum('approvedValue');
				$this->db->from('proposed_cost');
				$this->db->where('proposedCostId', $proposedCostId);
				$app = $this->db->get()->row_array();

				if($value > $app['approvedValue']){
					$res = [
						'error' => 'Value distribution exceeds the Approval Value<br>',
					];
				} else {
					$data = [
						'projectId' => $projectId,
						'proposedCostId' => $this->input->post('proposedCostId', true),
						'userId' => $this->session->userdata('userId'),
						'holder' => $this->input->post('holder', true),
						'value' => $this->input->post('value', true),
						'description' => $this->input->post('description', true),
					];
		
					$q = $this->M_project->insert_distribution_cost($data);
		
					$res = [
						'data' => $data,
						'response' => $q,
						'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
					];
				}

				
			}
			echo json_encode($res);
		}
	}

	function edit_distribution_cost($distributionCostId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_distribution_cost();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$proposedCostId = $this->input->post('proposedCostId', true);
				$value = $this->input->post('value', true);

				$this->db->select_sum('approvedValue');
				$this->db->from('proposed_cost');
				$this->db->where('proposedCostId', $proposedCostId);
				$app = $this->db->get()->row_array();

				if($value > $app['approvedValue']){
					$res = [
						'error' => 'Value distribution exceeds the Approval Value<br>',
					];
				} else {
					$data = [
						'distributionCostId' => $distributionCostId,
						'proposedCostId' => $this->input->post('proposedCostId', true),
						'userId' => $this->session->userdata('userId'),
						'holder' => $this->input->post('holder', true),
						'value' => $this->input->post('value', true),
						'description' => $this->input->post('description', true),
					];
		
					$q = $this->M_project->update_distribution_cost($data);
		
					$res = [
						'data' => $data,
						'response' => $q,
						'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
					];
				}
				
			}
			echo json_encode($res);
		}
	}

	function delete_distribution_cost($distributionCostId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$distributionCostId = $this->input->post('distributionCostId', true);
			$q = $this->M_project->delete_distribution_cost($distributionCostId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_distribution_cost()
	{
		$this->form_validation->set_rules('proposedCostId', 'Proposed', 'required|trim');
		$this->form_validation->set_rules('holder', 'Holder', 'required|trim');
		$this->form_validation->set_rules('value', 'Value', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}

	//REAL BUDGET
	function get_real_budget_data($projectId) {
		$list = $this->M_project->get_real_budget_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$user = $this->db->get_where('user', ['userId' => $i->holder])->row_array();
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $user['userName'];
			$row[] = currency($i->value);
			$row[] = $i->userName;
			$row[] = $i->reportDate;
			$row[] = currency($i->realBudgetValue);
			$row[] = $i->description;
			$row[] = $i->orderNo == null ? '-' : $i->orderNo;
			$row[] = $i->budget == null ? '-' : currency($i->budget);
			// add html for action

			if (is_pengawas_lapangan()) {
				$row[] = '<a href="#" class="btn btn-info" id="btnRealBudgetEdit" data="'.$i->realBudgetId.'"><i class="fa fa-edit"></i> Edit</a>
				<a href="#" class="btn btn-danger" id="btnRealBudgetDelete" data="'.$i->realBudgetId.'"><i class="fa fa-trash"></i> Delete</a>';
			} elseif (is_project_manager()) {
				$row[] = '<a href="#" class="btn btn-success" id="btnRealBudgetSelectBudget" data="'.$i->realBudgetId.'"><i class="fa fa-edit"></i> Select Budget</a>';
			} else {
				$row[] = '';
			}
			
			
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_real_budget_all($projectId),
			"recordsFiltered" => $this->M_project->count_real_budget_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_real_budget_data_by_id(){
		$realBudgetId = $this->input->get('id');
		$data = $this->M_project->get_real_budget_by_id($realBudgetId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_real_budget($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_real_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectId' => $projectId,
					'distributionCostId' => $this->input->post('distributionCostId', true),
					'reportBy' => $this->session->userdata('userId'),
					'reportDate' => date('Y-m-d'),
					'realBudgetValue' => $this->input->post('realBudgetValue', true),
					'description' => $this->input->post('description', true),
				];
	
				$q = $this->M_project->insert_real_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_real_budget($realBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_real_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'realBudgetId' => $realBudgetId,
					'distributionCostId' => $this->input->post('distributionCostId', true),
					'reportBy' => $this->session->userdata('userId'),
					'reportDate' => date('Y-m-d'),
					'realBudgetValue' => $this->input->post('realBudgetValue', true),
					'description' => $this->input->post('description', true),
				];
	
				$q = $this->M_project->update_real_budget($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function select_budget_real_budget($realBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$data = [
				'realBudgetId' => $realBudgetId,
				'budgetId' => empty($this->input->post('budgetId', true)) ? null : $this->input->post('budgetId', true),
			];

			$q = $this->M_project->update_real_budget($data);

			$res = [
				'data' => $data,
				'response' => $q,
				'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
			];
			echo json_encode($res);
		}
	}

	function delete_real_budget($realBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$realBudgetId = $this->input->post('realBudgetId', true);
			$q = $this->M_project->delete_real_budget($realBudgetId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_real_budget()
	{
		$this->form_validation->set_rules('distributionCostId', 'Distribution Cost', 'required|trim');
		$this->form_validation->set_rules('realBudgetValue', 'Value', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}

	function get_report_budget_data($projectId) {
		$list = $this->M_project->get_report_budget_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = currency($i->reportBudgetValue);
			$row[] = $i->description;
			$row[] = '<a href="#" class="btn btn-light" id="btnReportBudgetDetail" data="'.$i->reportBudgetId.'"><i class="fa fa-eye"></i> </a> '.$i->fileName;
			// add html for action

			if (is_pengawas_lapangan()) {
				$row[] = '<a href="#" class="btn btn-info" id="btnReportBudgetEdit" data="'.$i->reportBudgetId.'"><i class="fa fa-edit"></i> Edit</a>
				<a href="#" class="btn btn-danger" id="btnReportBudgetDelete" data="'.$i->reportBudgetId.'"><i class="fa fa-trash"></i> Delete</a>';
			} else {
				$row[] = '';
			}
			
			
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_report_budget_all($projectId),
			"recordsFiltered" => $this->M_project->count_report_budget_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_report_budget_data_by_id(){
		$reportBudgetId = $this->input->get('id');
		$data = $this->M_project->get_report_budget_by_id($reportBudgetId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_report_budget($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_report_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$config['upload_path'] = './assets/upload/report-budget'; 
				$config['allowed_types'] = 'png|jpg|jpeg|PNG|JPG|JPEG';
				$config['max_size'] = 10000;

				$this->upload->initialize($config);
				$this->load->library('upload', $config); 

				$image = '';
				if($this->upload->do_upload('fileName')){
					$uploadData = $this->upload->data();
					$image =  $uploadData['file_name'];
				}

				if($image == ''){
					$res = [
						'error' => $this->upload->display_errors('<p>', '</p>'),
					];
				} else {
					$data = [
						'realBudgetId' => $this->input->post('realBudgetId', true),
						'reportBudgetValue' => $this->input->post('reportBudgetValue', true),
						'description' => $this->input->post('description', true),
						'fileName' => $image
					];
		
					$q = $this->M_project->insert_report_budget($data);
					
					$res = [
						'data' => $data,
						'response' => $q,
						'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
					];
				}
			}
			echo json_encode($res);
		}
	}

	function edit_report_budget($reportBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_report_budget();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$rb = $this->M_project->get_report_budget_by_id($reportBudgetId);
				if (!empty($_FILES['fileName']['name'])) {
					$config['upload_path'] = './assets/upload/report-budget'; 
					$config['allowed_types'] = 'png|jpg|jpeg|PNG|JPG|JPEG';
					$config['max_size'] = 10000;

					$this->upload->initialize($config);
					$this->load->library('upload', $config); 

					$image = '';
					if($this->upload->do_upload('fileName')){
						$uploadData = $this->upload->data();
						$image =  $uploadData['file_name'];
					}

					if($image == ''){
						$res = [
							'error' => $this->upload->display_errors('<p>', '</p>'),
						];
					} else {
						$data = [
							'reportBudgetId' => $reportBudgetId,
							'realBudgetId' => $this->input->post('realBudgetId', true),
							'reportBudgetValue' => $this->input->post('reportBudgetValue', true),
							'description' => $this->input->post('description', true),
							'fileName' => $image
						];
			
						$q = $this->M_project->update_report_budget($data);
						if($q == true){
							unlink('./assets/upload/report-budget/'.$rb['fileName']);
						}
						
						$res = [
							'data' => $data,
							'response' => $q,
							'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
						];
					}
				}else{
					$data = [
						'reportBudgetId' => $reportBudgetId,
						'realBudgetId' => $this->input->post('realBudgetId', true),
						'reportBudgetValue' => $this->input->post('reportBudgetValue', true),
						'description' => $this->input->post('description', true)
					];
		
					$q = $this->M_project->update_report_budget($data);
					
					$res = [
						'data' => $data,
						'response' => $q,
						'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
					];
				}
				
			}
			echo json_encode($res);
		}
	}

	function delete_report_budget($reportBudgetId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$reportBudgetId = $this->input->post('reportBudgetId', true);
			$rb = $this->M_project->get_report_budget_by_id($reportBudgetId);
			$q = $this->M_project->delete_report_budget($reportBudgetId);
			if($q == true){
				unlink('./assets/upload/report-budget/'.$rb['fileName']);
			}
			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_report_budget()
	{
		$this->form_validation->set_rules('realBudgetId', 'Budget', 'required|trim');
		$this->form_validation->set_rules('reportBudgetValue', 'Value', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}

	function get_notes_data($projectId) {
		$list = $this->M_project->get_notes_datatables($projectId);
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->notesType;
			$row[] = $i->notes;
			$row[] = $i->userName;
			$row[] = $i->timestamp;
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnNotesEdit" data="'.$i->notesId.'"><i class="fa fa-edit"></i> Edit</a>
			<a href="#" class="btn btn-danger" id="btnNotesDelete" data="'.$i->notesId.'"><i class="fa fa-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_project->count_notes_all($projectId),
			"recordsFiltered" => $this->M_project->count_notes_filtered($projectId),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_notes_data_by_id(){
		$notesId = $this->input->get('id');
		$data = $this->M_project->get_notes_by_id($notesId);
		$res = [
			'data' => $data,
			'response' => $data ? true : false,
		];

		echo json_encode($res);
	}

	function add_notes($projectId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_notes();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'projectId' => $projectId,
					'userId' => $this->session->userdata('userId'),
					'notesType' => $this->input->post('notesType', true),
					'notes' => $this->input->post('notes', true),
				];
	
				$q = $this->M_project->insert_notes($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit_notes($notesId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation_notes();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'notesId' => $notesId,
					'userId' => $this->session->userdata('userId'),
					'notesType' => $this->input->post('notesType', true),
					'notes' => $this->input->post('notes', true),
				];
	
				$q = $this->M_project->update_notes($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete_notes($notesId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$notesId = $this->input->post('notesId', true);
			$q = $this->M_project->delete_notes($notesId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation_notes()
	{
		$this->form_validation->set_rules('notesType', 'Type', 'required|trim');
		$this->form_validation->set_rules('notes', 'Notes', 'required|trim');
	}
}
