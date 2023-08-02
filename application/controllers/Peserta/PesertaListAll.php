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
		$this->load->model('m_users', 'users');
		$this->load->model('m_diklat');
	}

	public function index_get($pegawaiId,$id)
	{
		$peserta = new m_peserta;
		$diklat = new m_diklat;

		$result_peserta = $peserta->getDataPeserta($id);
		$isCommitee = $this->users->isCommitee($pegawaiId,$id);
		$isInstructor = $this->users->isInstructor($pegawaiId,$id);

		$listDiklatNameAndTime = $diklat->getDiklatNameAndTime($id);
		if(!empty($listDiklatNameAndTime)){
			$judulDiklat = $listDiklatNameAndTime[0]['assessment_name'];
			$startDiklat = $listDiklatNameAndTime[0]['assessment_date_start'];
			$finishDiklat = $listDiklatNameAndTime[0]['assessment_date_finish'];
			if($isCommitee==1){
				//mendapatkan semua data
				if ($result_peserta) {
					$this->response([
						'status' => 200,
						'error' => false,
						'message' => 'Berhasil Mendapatkan Data',
						'totaldata' => count($result_peserta),
						'data' => [
							'judul_diklat' => $judulDiklat,
							'start_diklat' => $startDiklat,
							'finish_diklat' => $finishDiklat,
							'list_peserta' => $result_peserta
						],
						'action_as' => 'Committee'
					], RestController::HTTP_OK);
				} //data tidak ditemukan
				else {
					$this->response([
						'status' => 404,
						'error' => false,
						'message' => 'Maaf data peserta di ' .$judulDiklat. 'belum ada',
					], RestController::HTTP_BAD_REQUEST);
				}
			} else if($isInstructor==1){
					//mendapatkan semua data
					if ($result_peserta) {
						$this->response([
							'status' => 200,
							'error' => false,
							'message' => 'Berhasil Mendapatkan Data',
							'totaldata' => count($result_peserta),
							'data' => [
								'judul_diklat' => $judulDiklat,
								'start_diklat' => $startDiklat,
								'finish_diklat' => $finishDiklat,
								'list_peserta' => $result_peserta
							],
							'action_as' => 'Instructor'
						], RestController::HTTP_OK);
					} //data tidak ditemukan
					else {
						$this->response([
							'status' => 404,
							'error' => false,
							'message' => 'Maaf data peserta di ' .$judulDiklat. ' belum ada',
						], RestController::HTTP_BAD_REQUEST);
					}
				}

		}else {
			$this->response([
				'status' => 404,	
				'error' => true,
				'message' => 'Maaf data peserta tidak ditemukan',
			], RestController::HTTP_BAD_REQUEST);
		}

	}

}
