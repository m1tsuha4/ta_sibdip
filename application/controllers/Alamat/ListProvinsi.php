<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ListProvinsi extends RestController {

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('m_alamat');
	}

	public function index_get()
	{
		$alamat = new m_alamat;
		$result_alamat = $alamat->listProvinsi();

		//mendapatkan semua data
		if ($result_alamat) {
			$this->response([
				'status' => 200,
				'error' => false,
				'message' => 'Berhasil Mendapatkan Data',
				'totaldata' => count($result_alamat),
				'data' => $result_alamat
			], RestController::HTTP_OK);
		}
		//data tidak ditemukan
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
