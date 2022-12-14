<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_project extends CI_Model {

	public $table	= 'project';

	// start datatables
	var $column_order = array('project.generateId', 'project_group.projectGroupName', 'project.projectName', 'client.name', 'project.description', 'project.value', 'project.isFinal', 'project.isAddWork'); //set column field database for datatable orderable
	var $column_search = array('project.generateId', 'project_group.projectGroupName', 'project.projectName', 'client.name', 'project.description', 'project.value', 'project.isFinal', 'project.isAddWork'); //set column field database for datatable searchable
	var $order = array('project.approved' => 'desc', 'project.projectId' => 'desc'); // default order 

	private function _get_datatables_query() {
		$this->db->select('*, project.description');
		$this->db->from($this->table);
		$this->db->join('client', 'client.clientId=project.clientId');
		$this->db->join('project_group', 'project_group.projectGroupId = project.projectGroupId', 'left');
		if(is_finance()){

		} elseif(is_project_manager()) {
			$this->db->where('project.userId', $this->session->userdata('userId'));
		} elseif(is_pengawas_lapangan()) {
			$this->db->join('team_member', 'team_member.projectId=project.projectId');
			$this->db->where('team_member.userId', $this->session->userdata('userId'));
		}
		$i = 0;
		foreach ($this->column_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
			 
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables() {
		$this->_get_datatables_query();
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered() {
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_all() {
		$this->db->from('project');
		if(is_finance()){

		} elseif(is_project_manager()) {
			$this->db->where('project.userId', $this->session->userdata('userId'));
		} elseif(is_pengawas_lapangan()) {
			$this->db->join('team_member', 'team_member.projectId=project.projectId');
			$this->db->where('team_member.userId', $this->session->userdata('userId'));
		}
		return $this->db->count_all_results();
	}
	// end datatables

	public function get_data()
	{
		$this->db->select('*');
		$this->db->from($this->table);
    return $this->db->get();
	}

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function get_by_id($projectId)
	{
		return $this->db->get_where($this->table, ['projectId' => $projectId])->row_array();
	}

	public function update($data)
	{
		$this->db->where('projectId', $data['projectId']);
		return $this->db->update($this->table, $data);
	}

	public function delete($projectId)
	{
		return $this->db->delete($this->table, ['projectId' => $projectId]);
	}

	// PROJECT BUDGET
	// start datatables
	var $column_budget_order = array('orderNo', 'budgetName', 'description', 'budget', 'createdAt', 'lastUpdate', 'approved'); //set column field database for datatable orderable
	var $column_budget_search = array('orderNo', 'budgetName', 'description', 'budget', 'createdAt', 'lastUpdate', 'approved'); //set column field database for datatable searchable
	var $order_budget = array('budgetId' => 'asc'); // default order 

	private function _get_datatables_budget_query($projectId) {
		$this->db->select('*');
		$this->db->from('budget');
		$this->db->where('budget.projectId', $projectId);
		$i = 0;
		foreach ($this->column_budget_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_budget_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_budget_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_budget)) {
			$order = $this->order_budget;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_budget_datatables($projectId) {
		$this->_get_datatables_budget_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_budget_filtered($projectId) {
		$this->_get_datatables_budget_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_budget_all($projectId) {
		$this->db->from('budget');
		$this->db->where('projectId', $projectId);
		return $this->db->count_all_results();
	}
	// end datatables

	public function insert_budget($data)
	{
		return $this->db->insert('budget', $data);
	}

	public function get_budget_by_id($budgetId)
	{
		return $this->db->get_where('budget', ['budgetId' => $budgetId])->row_array();
	}

	public function update_budget($data)
	{
		$this->db->where('budgetId', $data['budgetId']);
		return $this->db->update('budget', $data);
	}

	public function delete_budget($budgetId)
	{
		return $this->db->delete('budget', ['budgetId' => $budgetId]);
	}

	// PROPOSED COST
	// start datatables
	var $column_proposed_cost_order = array('proposedCostName', 'proposedDate', 'user.userName', 'proposedValue', 'detailDescription', 'approved', 'approvedDate', 'approvedDescription', 'approvedValue', 'rejectedDate', 'rejectedDescription'); //set column field database for datatable orderable
	var $column_proposed_cost_search = array('proposedCostName', 'proposedDate', 'user.userName', 'proposedValue', 'detailDescription', 'approved', 'approvedDate', 'approvedDescription', 'approvedValue', 'rejectedDate', 'rejectedDescription'); //set column field database for datatable searchable
	var $order_proposed_cost = array('proposedCostId' => 'desc'); // default order 

	private function _get_datatables_proposed_cost_query($projectId) {
		$this->db->select('*, proposed_cost.approved, proposed_cost.approvedBy');
		$this->db->from('proposed_cost');
		$this->db->join('user', 'user.userId=proposed_cost.proposedBy');
		$this->db->where('proposed_cost.projectId', $projectId);
		if(is_pengawas_lapangan() && is_project_manager()){
		}elseif(is_pengawas_lapangan()){
			$this->db->where('proposed_cost.proposedBy', $this->session->userdata('userId'));
		}
		$i = 0;
		foreach ($this->column_proposed_cost_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_proposed_cost_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_proposed_cost_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_proposed_cost)) {
			$order = $this->order_proposed_cost;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_proposed_cost_datatables($projectId) {
		$this->_get_datatables_proposed_cost_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_proposed_cost_filtered($projectId) {
		$this->_get_datatables_proposed_cost_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_proposed_cost_all($projectId) {
		$this->db->from('proposed_cost');
		$this->db->where('projectId', $projectId);
		return $this->db->count_all_results();
	}
	// end datatables

	public function insert_proposed_cost($data)
	{
		return $this->db->insert('proposed_cost', $data);
	}

	public function get_proposed_cost_by_id($proposedCostId)
	{
		return $this->db->get_where('proposed_cost', ['proposedCostId' => $proposedCostId])->row_array();
	}

	public function update_proposed_cost($data)
	{
		$this->db->where('proposedCostId', $data['proposedCostId']);
		return $this->db->update('proposed_cost', $data);
	}

	public function delete_proposed_cost($proposedCostId)
	{
		return $this->db->delete('proposed_cost', ['proposedCostId' => $proposedCostId]);
	}

	// DISTRIBUTION COST
	// start datatables
	var $column_distribution_cost_order = array('proposedCostName', 'proposedDate', 'userName', 'holder', 'value', 'description'); //set column field database for datatable orderable
	var $column_distribution_cost_search = array('proposedCostName', 'proposedDate', 'userName', 'holder', 'value', 'description'); //set column field database for datatable searchable
	var $order_distribution_cost = array('distributionCostId' => 'asc'); // default order 

	private function _get_datatables_distribution_cost_query($projectId) {
		$this->db->select('*');
		$this->db->from('distribution_cost');
		$this->db->join('proposed_cost', 'proposed_cost.proposedCostId=distribution_cost.proposedCostId');
		$this->db->join('user', 'user.userId=distribution_cost.userId');
		$this->db->where('distribution_cost.projectId', $projectId);
		if(is_pengawas_lapangan() && is_project_manager()){
		}elseif(is_pengawas_lapangan()){
			$this->db->where('distribution_cost.holder', $this->session->userdata('userId'));
		}
		$i = 0;
		foreach ($this->column_distribution_cost_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_distribution_cost_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_distribution_cost_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_distribution_cost)) {
			$order = $this->order_distribution_cost;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_distribution_cost_datatables($projectId) {
		$this->_get_datatables_distribution_cost_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_distribution_cost_filtered($projectId) {
		$this->_get_datatables_distribution_cost_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_distribution_cost_all($projectId) {
		$this->db->from('distribution_cost');
		$this->db->where('projectId', $projectId);
		return $this->db->count_all_results();
	}
	// end datatables

	public function insert_distribution_cost($data)
	{
		return $this->db->insert('distribution_cost', $data);
	}

	public function get_distribution_cost_by_id($distributionCostId)
	{
		return $this->db->get_where('distribution_cost', ['distributionCostId' => $distributionCostId])->row_array();
	}

	public function update_distribution_cost($data)
	{
		$this->db->where('distributionCostId', $data['distributionCostId']);
		return $this->db->update('distribution_cost', $data);
	}

	public function delete_distribution_cost($distributionCostId)
	{
		return $this->db->delete('distribution_cost', ['distributionCostId' => $distributionCostId]);
	}

	// REPORT COST
	// start datatables
	var $column_report_cost_order = array('reportCostValue', 'description', 'fileName'); //set column field database for datatable orderable
	var $column_report_cost_search = array('reportCostValue', 'description', 'fileName'); //set column field database for datatable searchable
	var $order_report_cost = array('reportCostId' => 'asc'); // default order 

	private function _get_datatables_report_cost_query($projectId) {
		$this->db->select('*, report_cost.description');
		$this->db->from('report_cost');
		$this->db->join('distribution_cost', 'distribution_cost.distributionCostId=report_cost.distributionCostId');
		$this->db->where('distribution_cost.projectId', $projectId);
		if(is_pengawas_lapangan() && is_project_manager()){
		}elseif(is_pengawas_lapangan()){
			$this->db->where('distribution_cost.holder', $this->session->userdata('userId'));
		}
		$i = 0;
		foreach ($this->column_report_cost_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_report_cost_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_report_cost_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_report_cost)) {
			$order = $this->order_report_cost;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_report_cost_datatables($projectId) {
		$this->_get_datatables_report_cost_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_report_cost_filtered($projectId) {
		$this->_get_datatables_report_cost_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_report_cost_all($projectId) {
		$this->db->from('report_cost');
		$this->db->join('distribution_cost', 'distribution_cost.distributionCostId=report_cost.distributionCostId');
		$this->db->where('distribution_cost.projectId', $projectId);
		return $this->db->count_all_results();
	}
	// end datatables

	public function insert_report_cost($data)
	{
		return $this->db->insert('report_cost', $data);
	}

	public function get_report_cost_by_id($reportCostId)
	{
		return $this->db->get_where('report_cost', ['reportCostId' => $reportCostId])->row_array();
	}

	public function update_report_cost($data)
	{
		$this->db->where('reportCostId', $data['reportCostId']);
		return $this->db->update('report_cost', $data);
	}

	public function delete_report_cost($reportCostId)
	{
		return $this->db->delete('report_cost', ['reportCostId' => $reportCostId]);
	}

	// REAL COST
	// start datatables
	var $column_real_cost_order = array('user.userName', 'distribution_cost.value', 'distribution_cost.reportCostValue', 'distribution_cost.description', 'distribution_cost.fileName'); //set column field database for datatable orderable
	var $column_real_cost_search = array('user.userName', 'distribution_cost.value', 'distribution_cost.reportCostValue', 'distribution_cost.description', 'distribution_cost.fileName'); //set column field database for datatable searchable
	var $order_real_cost = array('user.userName' => 'asc'); // default order 

	private function _get_datatables_real_cost_query($projectId) {
		$this->db->select('*, report_cost.description');
		$this->db->from('distribution_cost');
		$this->db->join('report_cost', 'report_cost.distributionCostId=distribution_cost.distributionCostId', 'left');
		$this->db->join('user', 'user.userId=distribution_cost.holder');
		$this->db->where('distribution_cost.projectId', $projectId);
		if(is_pengawas_lapangan() && is_project_manager()){
		}elseif(is_pengawas_lapangan()){
			$this->db->where('distribution_cost.holder', $this->session->userdata('userId'));
		}
		$i = 0;
		foreach ($this->column_real_cost_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_report_cost_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_real_cost_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_real_cost)) {
			$order = $this->order_real_cost;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_real_cost_datatables($projectId) {
		$this->_get_datatables_real_cost_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_real_cost_filtered($projectId) {
		$this->_get_datatables_real_cost_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_real_cost_all($projectId) {
		$this->db->from('report_cost');
		$this->db->join('distribution_cost', 'distribution_cost.distributionCostId=report_cost.distributionCostId', 'left');
		$this->db->where('distribution_cost.projectId', $projectId);
		if(is_pengawas_lapangan() && is_project_manager()){
		}elseif(is_pengawas_lapangan()){
			$this->db->where('distribution_cost.holder', $this->session->userdata('userId'));
		}
		return $this->db->count_all_results();
	}
	// end datatables

		// REPORT BUDGET
	// start datatables
	var $column_report_budget_order = array('reportCostValue', 'description', 'budget.description'); //set column field database for datatable orderable
	var $column_report_budget_search = array('reportCostValue', 'description', 'budget.description'); //set column field database for datatable searchable
	var $order_report_budget = array('reportCostId' => 'asc'); // default order 

	private function _get_datatables_report_budget_query($projectId) {
		$this->db->select('*, report_cost.description, budget.description as budgetDescription');
		$this->db->from('report_cost');
		$this->db->join('distribution_cost', 'distribution_cost.distributionCostId=report_cost.distributionCostId');
		$this->db->join('budget', 'budget.budgetId=report_cost.budgetId', 'left');
		$this->db->where('distribution_cost.projectId', $projectId);
		$i = 0;
		foreach ($this->column_report_budget_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_report_budget_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_report_budget_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_report_budget)) {
			$order = $this->order_report_budget;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_report_budget_datatables($projectId) {
		$this->_get_datatables_report_budget_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_report_budget_filtered($projectId) {
		$this->_get_datatables_report_budget_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_report_budget_all($projectId) {
		$this->db->from('report_cost');
		$this->db->join('distribution_cost', 'distribution_cost.distributionCostId=report_cost.distributionCostId');
		$this->db->join('budget', 'budget.budgetId=report_cost.budgetId', 'left');
		$this->db->where('distribution_cost.projectId', $projectId);
		return $this->db->count_all_results();
	}
	// end datatables

	// NOTES
	// start datatables
	var $column_notes_order = array('notes.notesType', 'notes.notes', 'user.userName', 'notes.timestamp'); //set column field database for datatable orderable
	var $column_notes_search = array('notes.notesType', 'notes.notes', 'user.userName', 'notes.timestamp'); //set column field database for datatable searchable
	var $order_notes = array('notesId' => 'desc'); // default order 

	private function _get_datatables_notes_query($projectId) {
		$this->db->select('*');
		$this->db->from('notes');
		$this->db->join('user', 'user.userId=notes.userId');
		$this->db->where('notes.projectId', $projectId);
		$i = 0;
		foreach ($this->column_notes_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_notes_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_notes_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_notes)) {
			$order = $this->order_notes;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_notes_datatables($projectId) {
		$this->_get_datatables_notes_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_notes_filtered($projectId) {
		$this->_get_datatables_notes_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_notes_all($projectId) {
		$this->db->from('notes');
		$this->db->where('notes.projectId', $projectId);
		return $this->db->count_all_results();
	}
	// end datatables

	public function insert_notes($data)
	{
		return $this->db->insert('notes', $data);
	}

	public function get_notes_by_id($notesId)
	{
		return $this->db->get_where('notes', ['notesId' => $notesId])->row_array();
	}

	public function update_notes($data)
	{
		$this->db->where('notesId', $data['notesId']);
		return $this->db->update('notes', $data);
	}

	public function delete_notes($notesId)
	{
		return $this->db->delete('notes', ['notesId' => $notesId]);
	}
}
