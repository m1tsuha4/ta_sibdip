<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class AsistenListAll extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_asistent');
    }

    public function index_get()
    {
        $asisten = new m_asistent;
        $result_asisten = $asisten->getDataAssistant();

        //mendapatkan semua data
        if ($result_asisten) {
            $this->response([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil Mendapatkan Data',
                'totaldata' => count($result_asisten),
                'data' => $result_asisten
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