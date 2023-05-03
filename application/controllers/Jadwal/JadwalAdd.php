<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class JadwalAdd extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_jadwal');
        $this->load->library('form_validation');
    }

//menambahkan data
    public function AddJadwal_post()
    {
    
        $jadwal = new m_jadwal;

        $i = $this->db->count_all('tb_material');

        $insert_data = [
            'material_id '                => $jadwal->idterurut($i),
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
            'survey_token'                => $this->post('survey_token'),
        ];

        $result = $jadwal->insertJadwal($insert_data);

        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status' => 201,
                'error' => false,
                'message' => 'New jadwal Created',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => 404,
                'error' => true,
                'message' => 'Failed to Create Jadwal'
            ], RestController::HTTP_BAD_REQUEST);
        }
        }
    

  
}