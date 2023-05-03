<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class JadwalDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_jadwal');
    }
    //menghapus
    public function JadwalDeleted_delete($id = null)
    {
        $jadwal = new m_jadwal;
    
        $cekData = $jadwal->deletedJadwal($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Jadwal Deleted'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Maaf ID ' . $id . ' tidak ditemukan'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}