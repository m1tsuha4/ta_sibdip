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
//		//datanya 1
//        if (count($mergedData) > 1) {
//            $this->response([
//                'status' => 200,
//                'error' => "false",
//                'message' => 'Id or Nama Avalaible',
//                'totaldata' => count($mergedData),
//                'data' => $mergedData
//            ], RestController::HTTP_OK);
//        }
//        //kalau nilainya lebih dari 1
//        elseif (count($mergedData) === 1) {
//            $this->response([
//                'status' => 200,
//                'error' => "false",
//                'message' => 'Id tersedia',
//                'totaldata' => count($mergedData),
//                'data' => $mergedData
//            ], RestController::HTTP_OK);
//        }
//        //kalau nilainya tidak ada
//        else {
//            $this->response([
//                'status' => 404,
//                'error' => "true",
//                'message' => 'Maaf data ' . $cari . ' tidak ditemukan',
//            ], RestController::HTTP_BAD_REQUEST);
//        }
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
//			$mergedData = array();
//			foreach ($result as $row) {
//				$assessmentId = $row['assessment_id'];
////				var_dump($assessmentId);
//
//				if (array_key_exists($assessmentId, $resultInstructor)) {
//					$instructorData = $resultInstructor[$assessmentId];
//					$mergedRow = array_merge($row,$instructorData);
//					$mergedData[$assessmentId] = $mergedRow;
//				}
//			}
			$committee = $result[0]->assessment_id;
			$instructor = $resultInstructor[0]->assessment_id;
			if ($committee == $instructor){
				$this->response([
					'status' => 200,
					'error' => false,
					'message' => 'Data dari penggabungan panitia dan instructor',
					'totaldata' => count($result),
					'data' => $result
				], RestController::HTTP_OK);
			} else{
				$mergedRow = array_merge($result,$resultInstructor);
				$this->response([
					'status' => 200,
					'error' => false,
					'message' => 'Data dari penggabungan panitia dan instructor',
					'totaldata' => count($mergedRow),
					'data' => $mergedRow
				], RestController::HTTP_OK);
			}
//			$mergedRow = array_merge($result,$resultInstructor);
//			var_dump($mergedRow);
//			$mergedData = array_values($mergedData);
//			$this->response([
//				'status' => 200,
//				'error' => false,
//				'message' => 'Data dari penggabungan panitia dan instructor',
//				'totaldata' => count($mergedData),
//				'data' => $mergedData
//			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => 404,
				'error' => true,
				'message' => 'Maaf, data ' . $cari . ' tidak ditemukan',
			], RestController::HTTP_BAD_REQUEST);
		}
    }

}
