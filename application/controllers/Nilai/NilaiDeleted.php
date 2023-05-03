<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class NilaiDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_nilai');
    }
    //menghapus
    public function NilaiDeleted_delete($id = null)
    {
        $Nilai = new m_nilai;

        $cekData = $Nilai->deletedNilai($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Nilai DELETED'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID Nilai Not Found'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}