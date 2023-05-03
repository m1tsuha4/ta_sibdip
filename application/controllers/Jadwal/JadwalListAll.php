<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class JadwalListAll extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_jadwal');
    }

    public function index_get()
    {
        $jadwal = new m_jadwal;
        $result_jadwal = $jadwal->getDataJadwal();

        //mendapatkan semua data
        if ($result_jadwal) {
            $this->response([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil Mendapatkan Data',
                'totaldata' => count($result_jadwal),
                'data' => $result_jadwal
            ], RestController::HTTP_OK);
        }
        //data tidak ditemukan
        else {
            $this->response([
                'status' => 404,
                'error' => true,
                'message' => 'Data Tidak Ditemukan',
                'data' => NULL
            ], RestController::HTTP_NOT_FOUND);
        }
    } 

}