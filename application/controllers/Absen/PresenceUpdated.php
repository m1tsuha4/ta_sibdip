<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PresenceUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_absen');
    }

    //Mengupdate Data
    public function PresenceUpdated_post($id)
    {
        $absen = new m_absen;

        $data = [
//                    'assessment_id'                 => $this->put('assessment_id'),
//                    'fullname'                      => $this->put('fullname'),
//                    'address'                       => $this->put('address'),
//                    'present'                       => $this->put('present'),
//                    'total_present'                 => $this->put('total_present'),
//                    'signature'                     => $this->put('signature'),
//			'assessment_id'                 => $this->post('assessment_id'),
//			'fullname'                      => $this->post('fullname'),
//			'address'                       => $this->post('address'),
//			'present'                       => $this->post('present'),
//			'total_present'                 => $this->post('total_present'),
//			'signature'                     => $this->post('signature')
			'present_status' =>$this->post('present_status'),
			'present_ket' =>$this->post('present_ket')
        ];

        $update_result = $absen->updateAbsen($id, $data);

        if ($update_result > 0) {
            $this->response([
                'status' => true,
                'message' => 'NEW Absen Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO Updated Absen'
            ], RestController::HTTP_BAD_REQUEST);
        }
     
        
    
    }


}
