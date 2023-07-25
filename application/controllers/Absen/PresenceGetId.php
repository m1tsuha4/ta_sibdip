<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PresenceGetId extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_absen');
		$this->load->model('m_users','users');
		$this->load->model('m_diklat');
    }

    //mendapatkan id
    public function PresenceGetById_get($pegawaiId,$id,$date)
    {
        $absen = new m_absen;
		$diklat = new m_diklat;
        $result = $absen->GetByIdAbsen($id,$date);
		$isCommitee = $this->users->isCommitee($pegawaiId,$id);
		$isInstructor = $this->users->isInstructor($pegawaiId,$id);

		$diklatNames = $diklat->getDiklatName($id);
		if(!empty($diklatNames)){
			$judul = $diklatNames[0]['assessment_name'];
			if($isCommitee==1){
				//datanya 1
				if (count($result) > 1) {
					$this->response([
						'status' => 200,
						'error' => "false",
						'message' => 'Absen Available',
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
						'message' => 'Absen Available',
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
						'message' => 'Maaf data absen pada tanggal ' . $date . ' di diklat ' .$judul. ' tidak ada',
					], RestController::HTTP_BAD_REQUEST);
				}
			}else if ($isInstructor==1) {
				//datanya 1
				if (count($result) > 1) {
					$this->response([
						'status' => 200,
						'error' => "false",
						'message' => 'Absen Available',
						'totaldata' => count($result),
						'data' => $result,
						'action_as' => 'Instructor'
					], RestController::HTTP_OK);
				} //kalau nilainya lebih dari 1
				elseif (count($result) === 1) {
					$this->response([
						'status' => 200,
						'error' => "false",
						'message' => 'Absen Available',
						'totaldata' => count($result),
						'data' => $result,
						'action_as' => 'Instructor'
					], RestController::HTTP_OK);
				} //kalau nilainya tidak ada
				else {
					$this->response([
						'status' => 404,
						'error' => "true",
						'message' => 'Maaf data absen pada tanggal ' . $date . ' di ' .$judul. ' tidak ada',
					], RestController::HTTP_BAD_REQUEST);
				}
			}
		}else {
			$this->response([
				'status' => 404,
				'error' => "true",
				'message' => 'Maaf data tidak ditemukan',
			], RestController::HTTP_BAD_REQUEST);
		}
    }

}
