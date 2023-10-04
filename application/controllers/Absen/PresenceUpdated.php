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
			'present_status' => $this->post('present_status'),
			'present_ket' => $this->post('present_ket'),
            'present_date_updated' => date('Y-m-d H:i:s', time())
        ];

        $update_result = $absen->updateAbsen($id,$data);

        if ($update_result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Absen Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO Updated Absen'
            ], RestController::HTTP_BAD_REQUEST);
        }

    }


}
