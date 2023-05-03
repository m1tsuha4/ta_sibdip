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
    public function JadwalUpdated_put($id)
    {
        $jadwal = new m_jadwal;

        $data = [
            'material_id'                 => $this->put('material_id'),
            'assessment_id'               => $this->put('assessment_id'),
            'material_parent_id'          => $this->put('material_parent_id'),
            'instructor_id'               => $this->put('instructor_id'),
            'material_date'               => $this->put('material_date'),
            'material_time'               => $this->put('material_time'),
            'material_detail'             => $this->put('material_detail'),
            'material_name'               => $this->put('material_name'),
            'material_jpl'                => $this->put('material_jpl'),
            'assistant_jpl'               => $this->put('assistant_jpl'),
            'eval_instructor'             => $this->put('eval_instructor'),
            'survey_token'                => $this->put('survey_token'),
        ];

        $result_update = $jadwal->updatedJadwal($id, $data);

        if ($result_update > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Id ' . $id . ' telah Berhasil di Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed To Updated Jadwal'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }


}