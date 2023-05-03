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
        
        $data_instructor = $this->m_instructor->GetByIdInstructor($id);
        @unlink($data_instructor[0]['avatar']);
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
                'message' => 'Maaf ID ' . $id . ' tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}