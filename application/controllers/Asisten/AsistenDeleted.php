<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class AsistenDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_asisten');
    }
    //menghapus
    public function AssistantDeleted_delete($id = null)
    {
        $asisten = new m_asisten;
        
        //menghapus avatar
        $data_asisten = $this->m_asisten->GetByIdAssistant($id);
        @unlink($data_asisten[0]['avatar']);
        $cekData = $asisten->deletedAssistant($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Assistant Deleted'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Maaf ID ' . $id . ' tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}