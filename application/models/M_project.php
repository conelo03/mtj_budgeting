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
}