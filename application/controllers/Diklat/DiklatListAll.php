<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class DiklatListAll extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_diklat');
    }

    public function index_get()
    {
        $diklat = new m_diklat;
        $result_diklat = $diklat->getDataDiklat();

        //mendapatkan semua data
        if ($result_diklat) {
            $this->response([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil Mendapatkan Data',
                'totaldata' => count($result_diklat),
                'data' => $result_diklat
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