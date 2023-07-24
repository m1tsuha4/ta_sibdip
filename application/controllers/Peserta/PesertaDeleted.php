<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PesertaDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_peserta');
    }
    //menghapus
    public function PesertaDeleted_delete($id = null)
    {
        $peserta = new m_peserta;
        
        //menghapus avatar
        $data_peserta = $this->m_peserta->GetByIdPeserta($id);
		$nama = $data_peserta[0]['fullname'];
        @unlink($data_peserta[0]['avatar']);
        $cekData = $peserta->deletedPeserta($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Peserta '.$nama. ' Deleted'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Maaf peserta tidak ada'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
