<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ListCompany extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('m_company');
	}

	public function index_get()
	{
		$company = new m_company;
		$result_company = $company->listCompany();

		//mendapatkan semua data
		if ($result_company) {
			$this->response([
				'status' => 200,
				'error' => false,
				'message' => 'Berhasil Mendapatkan Data',
				'totaldata' => count($result_company),
				'data' => $result_company
			], RestController::HTTP_OK);
		} //data tidak ditemukan
		else {
			$this->response([
				'status' => 404,
				'error' => true,
				'message' => 'Data Tidak Ditemukan',
				'data' => NULL
			], RestController::HTTP_NOT_FOUND);
		}
	}

}
