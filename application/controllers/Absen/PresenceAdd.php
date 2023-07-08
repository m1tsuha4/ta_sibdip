<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PresenceAdd extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_absen');
        $this->load->library('form_validation');
    }

//menambahkan data
    public function AddPresence_post()
    {
        $absen = new m_absen;

        $i = $this->db->count_all('tb_present');

		$insert_data = [
			'present_id'					=> $absen->idterurut($i),
			'student_id'                    => $this->post('student_id'),
			'assessment_id'                 => $this->post('assessment_id'),
			'present_date'					=> date('Y-m-d H:i:s', time()),
			'present_status'				=> $this->post('present_status'),
			'present_ket'					=> $this->post('present_ket')
		];

        //Memasukkan Data 
        $result = $absen->insertAbsen($insert_data);

        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status' => 201,
                'error' => false,
                'message' => 'NEW absen Created',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => 404,
                'error' => true,
                'message' => 'FAILDE TO CREATE absen'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
