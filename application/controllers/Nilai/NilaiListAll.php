<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class NilaiListAll extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_nilai');
    }

    public function index_get()
    {
        $nilai = new m_nilai;
        $result_nilai = $nilai->getDataNilai();

        //mendapatkan semua data
        if ($result_nilai) {
            $this->response([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil Mendapatkan Data',
                'totaldata' => count($result_nilai),
                'data' => $result_nilai
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