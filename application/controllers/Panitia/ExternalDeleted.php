<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ExternalDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_panitia');
    }
    //menghapus
    public function ExternalDeleted_delete($id = null)
    {
        $panitia = new m_panitia;
        
        //menghapus avatar
        $data_panitia = $this->m_panitia->GetByIdPanitia($id);
        @unlink($data_panitia[0]['avatar']);
        $cekData = $panitia->deletedPanitia($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Panitia External Deleted'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Maaf ID ' . $id . ' tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}