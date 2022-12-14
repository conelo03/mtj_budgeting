<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_projectGroup extends CI_Model {

	public $table	= 'project_group';

	// start datatables
	var $column_order = array('projectGroupName', 'description'); //set column field database for datatable orderable
	var $column_search = array('projectGroupName', 'description'); //set column field database for datatable searchable
	var $order = array('projectGroupId' => 'asc'); // default order 

	private function _get_datatables_query() {
		$this->db->select('*');
		$this->db->from($this->table);
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
		$this->db->from('project_group');
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

	public function get_by_id($projectGroupId)
	{
		return $this->db->get_where($this->table, ['projectGroupId' => $projectGroupId])->row_array();
	}

	public function update($data)
	{
		$this->db->where('projectGroupId', $data['projectGroupId']);
		return $this->db->update($this->table, $data);
	}

	public function delete($projectGroupId)
	{
		return $this->db->delete($this->table, ['projectGroupId' => $projectGroupId]);
	}
}
