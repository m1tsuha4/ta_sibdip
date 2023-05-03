<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class NilaiAdd extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_nilai');
    }

//menambahkan data
    public function AddNilai_post()
    {
        $Nilai = new m_nilai;

        $i = $this->db->count_all('tb_student');

        $insert_data = [
            'student_id'                    => $Nilai->idterurut($i),
            'assessment_id'                 => $this->post('assessment_id'),
            'fullname'                      => $this->post('fullname'),
            'address'                       => $this->post('address'),
            'company_id'                    => $this->post('company_id'),
            'pretest'                       => $this->post('pretest'),
            'posttest'                      => $this->post('posttest'),
        ];

        //Memasukkan Data 
        $result = $Nilai->insertNilai($insert_data);

        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status' => 201,
                'error' => false,
                'message' => 'NEW Nilai Created',
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => 404,
                'error' => true,
                'message' => 'FAILDE TO CREATE Nilai'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    
    }
}