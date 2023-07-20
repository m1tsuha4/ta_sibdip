<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class NilaiGetId extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_nilai');
		$this->load->model('m_users');
    }

    //mendapatkan id
    public function NilaiGetById_get($pegawaiId,$cari)
    {
        $nilai = new m_nilai;
        $result = $nilai->GetByIdNilai($cari);
		if(!empty($result)){
			$id = $result[0]["assessment_id"];
			$isCommitee = $this->m_users->isCommitee($pegawaiId, $id);
			$isInstructor = $this->m_users->isInstructor($pegawaiId, $id);
			if($isCommitee==1){
				//datanya 1
				if (count($result) > 1) {
					$this->response([
						'status' => 200,
						'error' => "false",
						'message' => 'Id or Nama Avalaible',
						'totaldata' => count($result),
						'data' => $result,
						'action_as' => 'Committee'
					], RestController::HTTP_OK);
				}
				//kalau nilainya lebih dari 1
				elseif (count($result) === 1) {
					$this->response([
						'status' => 200,
						'error' => "false",
						'message' => 'Id tersedia',
						'totaldata' => count($result),
						'data' => $result,
						'action_as' => 'Committee'
					], RestController::HTTP_OK);
				}
				//kalau nilainya tidak ada
				else {
					$this->response([
						'status' => 404,
						'error' => "true",
						'message' => 'Maaf data ' . $cari . ' tidak ditemukan',
					], RestController::HTTP_BAD_REQUEST);
				}
			} else if ($isInstructor == 1) {
					//datanya 1
					if (count($result) > 1) {
						$this->response([
							'status' => 200,
							'error' => "false",
							'message' => 'Id or Nama Avalaible',
							'totaldata' => count($result),
							'data' => $result,
							'action_as' => 'Instructor'
						], RestController::HTTP_OK);
					} //kalau nilainya lebih dari 1
					elseif (count($result) === 1) {
						$this->response([
							'status' => 200,
							'error' => "false",
							'message' => 'Id tersedia',
							'totaldata' => count($result),
							'data' => $result,
							'action_as' => 'Instructor'
						], RestController::HTTP_OK);
					} //kalau nilainya tidak ada
					else {
						$this->response([
							'status' => 404,
							'error' => "true",
							'message' => 'Maaf data ' . $cari . ' tidak ditemukan',
						], RestController::HTTP_BAD_REQUEST);
					}
				}
			else{
				$this->response([
					'status' => 404,
					'error' => "true",
					'message' => 'Maaf data tidak ditemukan',
				], RestController::HTTP_BAD_REQUEST);
			}

		}else{
			$this->response([
				'status' => 404,
				'error' => "true",
				'message' => 'Maaf data tidak ditemukan',
			], RestController::HTTP_BAD_REQUEST);
		}

	}
		
}
