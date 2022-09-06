<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_project extends CI_Model {

	public $table	= 'project';

	// start datatables
	var $column_order = array('project.generateId', 'group.groupName', 'project_group.projectGroupName', 'project.projectName', 'client.name', 'project.description', 'project.value', 'project.isFinal', 'project.isAddWork'); //set column field database for datatable orderable
	var $column_search = array('project.generateId', 'group.groupName', 'project_group.projectGroupName', 'project.projectName', 'client.name', 'project.description', 'project.value', 'project.isFinal', 'project.isAddWork'); //set column field database for datatable searchable
	var $order = array('project.projectId' => 'asc'); // default order 

	private function _get_datatables_query() {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('group', 'group.groupId=project.groupId');
		$this->db->join('client', 'client.clientId=project.clientId');
		$this->db->join('project_group', 'project_group.projectGroupId = project.projectGroupId', 'left');
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

	// PROJECT QUOTATION
	// start datatables
	var $column_quotation_order = array('orderNo', 'projectQuotationName', 'project_quotation.description', 'quoteValue', 'estCost', 'detailDescription', 'isFinal'); //set column field database for datatable orderable
	var $column_quotation_search = array('orderNo', 'projectQuotationName', 'project_quotation.description', 'quoteValue', 'estCost', 'detailDescription', 'isFinal'); //set column field database for datatable searchable
	var $order_quotation = array('projectQuotationId' => 'asc'); // default order 

	private function _get_datatables_quotation_query($projectId) {
		$this->db->select('*, project_quotation.description, project_quotation.isFinal');
		$this->db->from('project_quotation');
		$this->db->join('project', 'project.projectId=project_quotation.projectId');
		$this->db->where('project_quotation.projectId', $projectId);
		$i = 0;
		foreach ($this->column_quotation_search as $i) { // loop column 
			if(@$_POST['search']['value']) { // if datatable send POST for search
				if($i===0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($i, $_POST['search']['value']);
				} else {
					$this->db->or_like($i, $_POST['search']['value']);
				}
				if(count($this->column_quotation_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
				
		if(isset($_POST['order'])) { // here order processing
			$this->db->order_by($this->column_quotation_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order_quotation)) {
			$order = $this->order_quotation;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_quotation_datatables($projectId) {
		$this->_get_datatables_quotation_query($projectId);
		if(@$_POST['length'] != -1)
		$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_quotation_filtered($projectId) {
		$this->_get_datatables_quotation_query($projectId);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function count_quotation_all($projectId) {
		$this->db->from('project_quotation');
		$this->db->where('projectId', $projectId);
		return $this->db->count_all_results();
	}
	// end datatables

	public function insert_project_quotation($data)
	{
		return $this->db->insert('project_quotation', $data);
	}

	public function get_project_quotation_by_id($projectQuotationId)
	{
		return $this->db->get_where('project_quotation', ['projectQuotationId' => $projectQuotationId])->row_array();
	}

	public function update_project_quotation($data)
	{
		$this->db->where('projectQuotationId', $data['projectQuotationId']);
		return $this->db->update('project_quotation', $data);
	}

	public function delete_project_quotation($projectQuotationId)
	{
		return $this->db->delete('project_quotation', ['projectQuotationId' => $projectQuotationId]);
	}
}
