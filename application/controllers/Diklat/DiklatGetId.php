<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class DiklatGetId extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_diklat');
    }

    //mendapatkan id
    public function DiklatGetById_get($cari = NULL)
    {
        $diklat = new m_diklat;
        $result = $diklat->GetByIdDiklat($cari);
		$resultInstructor = $diklat->GetByIdInstructor($cari);
		$dateStart = $this->input->post('assessment_date_start');
		$dateEnd = $this->input->post('assessment_date_finish');
		$this->session->set_userdata('assessment_date_start', $dateStart);
		if (!empty($result) && empty($resultInstructor)) {
			$this->response([
				'status' => 200,
				'error' => false,
				'message' => 'Data dari user panitia',
				'totaldata' => count($result),
				'data' => $result
			], RestController::HTTP_OK);
		} elseif (empty($result) && !empty($resultInstructor)) {
			$this->response([
				'status' => 200,
				'error' => false,
				'message' => 'Data dari user instructor',
				'totaldata' => count($resultInstructor),
				'data' => $resultInstructor
			], RestController::HTTP_OK);
		} elseif (!empty($result) && !empty($resultInstructor)) {
			$mergedRow = array_merge($result,$resultInstructor);
//			$unique = array_unique($mergedRow);
			$string = array_map('json_encode', $mergedRow);
			$uniqueStrings = array_unique($string);
			$unique = array_map('json_decode', $uniqueStrings, array_fill(0, count($uniqueStrings), true));
			$this->response([
				'status' => 200,
				'error' => false,
				'message' => 'Data dari penggabungan panitia dan instructor',
				'totaldata' => count($unique),
				'data' => $unique
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => 404,
				'error' => true,
				'message' => 'Maaf, data diklat tidak ditemukan',
			], RestController::HTTP_BAD_REQUEST);
		}
    }

}
