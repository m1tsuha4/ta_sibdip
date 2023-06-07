<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
//
//use chriskacerguis\RestServer\RestController;
//
//class PesertaListAll extends RestController {
//
//    function __construct()
//    {
//        // Construct the parent class
//        parent::__construct();
//        $this->load->model('m_peserta');
//    }
//
//    public function index_get()
//    {
//        $peserta = new m_peserta;
//        $result_peserta = $peserta->getDataPeserta();
//		var_dump($result_peserta);
//        //mendapatkan semua data
//        if ($result_peserta) {
//            $this->response([
//                'status' => 200,
//                'error' => false,
//                'message' => 'Berhasil Mendapatkan Data',
//                'totaldata' => count($result_peserta),
//                'data' => $result_peserta
//            ], RestController::HTTP_OK);
//        }
//        //data tidak ditemukan
//        else {
//            $this->response([
//                'status' => 404,
//                'error' => true,
//                'message' => 'Data Tidak Ditemukan',
//                'data' => NULL
//            ], RestController::HTTP_NOT_FOUND);
//        }
//    }
//
//}

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PesertaListAll extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('m_peserta');
	}

	public function index_get($id)
	{
		$peserta = new m_peserta;
		$result_peserta = $peserta->getDataPeserta($id);

		//mendapatkan semua data
		if ($result_peserta) {
			$this->response([
				'status' => 200,
				'error' => false,
				'message' => 'Berhasil Mendapatkan Data',
				'totaldata' => count($result_peserta),
				'data' => $result_peserta
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
