<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PesertaGetId extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_peserta');
    }

    //mendapatkan id
    public function PesertaGetById_get($cari = NULL)
    {
        $peserta = new m_peserta;
        $result = $peserta->GetByIdPeserta($cari);
    
        //datanya 1
        if (count($result) > 1) {
            $this->response([
                'status' => 200,
                'error' => "false",
                'message' => 'Peserta Available',
                'totaldata' => count($result),
                'data' => $result
            ], RestController::HTTP_OK);
        }
        //kalau nilainya lebih dari 1
        elseif (count($result) === 1) {
            $this->response([
                'status' => 200,
                'error' => "false",
                'message' => 'Peserta Available',
                'totaldata' => count($result),
                'data' => $result
            ], RestController::HTTP_OK);
        }
        //kalau nilainya tidak ada
        else {
            $this->response([
                'status' => 404,
                'error' => "true",
                'message' => 'Maaf data peserta tidak ditemukan',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

}
