<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class AsistenDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_asistent');
    }
    //menghapus
    public function AssistantDeleted_delete($id = null)
    {
        $asisten = new m_asistent;
        //menghapus avatar
        $data_asisten = $this->m_asistent->GetByIdAssistant($id);
		$nama = $data_asisten[0]['nama'];
		@unlink($data_asisten[0]['avatar']);
        $cekData = $asisten->deletedAssistant($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Assistant ' .$nama. ' Deleted'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Maaf assistant tidak ada'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
