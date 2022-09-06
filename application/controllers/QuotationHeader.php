<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuotationHeader extends CI_Controller {

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
    $data['title']		= 'Data Quotation Header';
		$this->load->view('quotation-header/data', $data);
	}

	function get_data() {
		$list = $this->M_quotationHeader->get_datatables();
		$data = array();
		$no = @$_POST['start'];
		foreach ($list as $i) {
			$no++;
			$row = array();
			$row[] = $no.".";
			$row[] = $i->orderNo;
			$row[] = $i->pdName;
			$row[] = $i->description;
			// add html for action
			$row[] = '<a href="#" class="btn btn-info" id="btnEdit" data="'.$i->quotationHeaderId.'"><i class="fa fa-edit"></i>  Edit</a>
							<a href="#" class="btn btn-danger" id="btnDelete" data="'.$i->quotationHeaderId.'"><i class="fa fa-trash"></i>  Delete</a>';
			$data[] = $row;
		}
		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_quotationHeader->count_all(),
			"recordsFiltered" => $this->M_quotationHeader->count_filtered(),
			"data" => $data,
		];
		// output to json format
		echo json_encode($output);
	}

	function get_data_by_id(){
		$quotationHeaderId = $this->input->get('id');
		$data = $this->M_quotationHeader->get_by_id($quotationHeaderId);
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
					'orderNo' => $this->input->post('orderNo', true),
					'pdName' => $this->input->post('pdName', true),
					'description' => $this->input->post('description', true)
				];
	
				$q = $this->M_quotationHeader->insert($data);
	
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Saved Successfully!' : 'Data Failed to Save!'
				];
			}
			echo json_encode($res);
		}
	}

	function edit($quotationHeaderId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$this->validation();
			if (!$this->form_validation->run()) {
				$res = [
					'error' => validation_errors()
				];
			}else{
				$data = [
					'quotationHeaderId' => $quotationHeaderId,
					'orderNo' => $this->input->post('orderNo', true),
					'pdName' => $this->input->post('pdName', true),
					'description' => $this->input->post('description', true)
				];
	
				$q = $this->M_quotationHeader->update($data);
				
				$res = [
					'data' => $data,
					'response' => $q,
					'message' => $q ? 'Data Edited Successfully!' : 'Data Failed to Edit!'
				];
			}
			echo json_encode($res);
		}
	}

	function delete($quotationHeaderId){
		$res = [];
		if($this->input->is_ajax_request() == true){
			$quotationHeaderId = $this->input->post('quotationHeaderId', true);
			$q = $this->M_quotationHeader->delete($quotationHeaderId);

			$res = [
				'response' => $q,
				'message' => $q ? 'Data Deleted Successfully!' : 'Data Failed to Delete!'
			];
			echo json_encode($res);
		}
	}

	private function validation()
	{
		$this->form_validation->set_rules('orderNo', 'Order No', 'required|trim');
		$this->form_validation->set_rules('pdName', 'PD Name', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
	}
}
