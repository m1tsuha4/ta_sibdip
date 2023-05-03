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

        $i = $this->db->count_all('tb_student');

        $insert_data = [
                    'student_id'                    => $absen->idterurut($i),
                    'assessment_id'                 => $this->post('assessment_id'),
                    'fullname'                      => $this->post('fullname'),
                    'address'                       => $this->post('address'),
                    'present'                       => $this->post('present'),
                    'total_present'                 => $this->post('total_present'),
                    'signature'                     => $this->post('signature'),
        ];

        //Memasukkan Data 
        $result = $absen->insertNilai($insert_data);

        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status' => 201,
                'error' => false,
                'message' => 'NEW absen Created',
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => 404,
                'error' => true,
                'message' => 'FAILDE TO CREATE absen'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}