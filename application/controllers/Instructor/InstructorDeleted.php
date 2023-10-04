<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class InstructorDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_instructor');
    }
    //menghapus
    public function InstructorDeleted_delete($id = null)
    {
        $instructor = new m_instructor;

        $cekData = $instructor->deletedInstructor($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'instructor Deleted'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Maaf instructor tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
