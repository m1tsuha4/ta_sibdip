<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class JadwalUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_jadwal');
    }

    //Mengupdate Data
    public function JadwalUpdated_post($id)
    {
        $jadwal = new m_jadwal;

        $data = [
			'assessment_id'               => $this->post('assessment_id'),
			'material_parent_id'          => $this->post('material_parent_id'),
			'instructor_id'               => $this->post('instructor_id'),
			'material_date'               => $this->post('material_date'),
			'material_time'               => $this->post('material_time'),
			'material_detail'             => $this->post('material_detail'),
			'material_name'               => $this->post('material_name'),
			'material_jpl'                => $this->post('material_jpl'),
			'assistant_jpl'               => $this->post('assistant_jpl'),
			'eval_instructor'             => $this->post('eval_instructor'),
//			'survey_token'                => $this->post('survey_token'),
        ];

        $result_update = $jadwal->updatedJadwal($id, $data);

        if ($result_update > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Jadwal ' . $data['material_name'] . ' telah Berhasil di Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed To Updated Jadwal'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }


}
