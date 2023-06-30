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
    public function NilaiUpdated_post($id)
    {
        $Nilai = new m_nilai;
        $data = [
            'pretest'                       => $this->post('pretest'),
            'posttest'                      => $this->post('posttest'),
        ];

        $update_result = $Nilai->updateNilai($id, $data);

        if ($update_result > 0) {
            $this->response([
                'status' => true,
                'message' => 'NEW Nilai Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO Updated Nilai'
            ], RestController::HTTP_BAD_REQUEST);
        }
    
    }


}
