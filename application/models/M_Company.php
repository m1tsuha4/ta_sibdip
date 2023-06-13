<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Company extends CI_Model
{
	public function listCompany()
	{
		$sql = "SELECT company_id,company_name FROM `tb_company`";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
}
