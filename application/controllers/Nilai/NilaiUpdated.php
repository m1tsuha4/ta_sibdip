<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class NilaiUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_nilai');
    }

    //Mengupdate Data
    public function NilaiUpdated_put($id)
    {
        $Nilai = new m_nilai;

        $data = [
            
            'assessment_id'                 => $this->post('assessment_id'),
            'fullname'                      => $this->post('fullname'),
            'address'                       => $this->post('address'),
            'company_id'                    => $this->post('company_id'),
            'pretest'                       => $this->post('pretest'),
            'posttest'                      => $this->post('posttest'),
        ];

        $update_result = $Nilai->updateNilai($id, $data);

        if ($update_result > 0) {
            $this->response([
                'status' => true,
                'message' => 'NEW Nilai Updated'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'FAILDE TO Updated Nilai'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    
    }


}