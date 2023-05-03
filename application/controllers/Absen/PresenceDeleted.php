<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PresenceDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_absen');
    }
    //menghapus
    public function PresenceDeleted_delete($id = null)
    {
        $absen = new m_absen;

        $cekData = $absen->deletedAbsen($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Absen DELETED'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID Absen Not Found'
            ], RestController::HTTP_BAD_REQUEST);
        }
        
    }
}