<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function get_user($email)
	{
        return $this->db->select('*')->from('user')->where('userEmail', $email)->get();
	}
}
