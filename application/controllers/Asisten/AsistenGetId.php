<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class AsistenGetId extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_asistent');
    }

//mendapatkan id
public function AsistenGetById_get($cari = NULL)
{
    $asisten = new m_asistent;
    $result = $asisten->GetByIdAssistant($cari);

    //datanya 1
    if (count($result) > 1) {
        $this->response([
            'status' => 200,
            'error' => "false",
            'message' => 'Id or Nama Avalaible',
            'totaldata' => count($result),
            'data' => $result
        ], RestController::HTTP_OK);
    }
    //kalau nilainya lebih dari 1
    elseif (count($result) === 1) {
        $this->response([
            'status' => 200,
            'error' => "false",
            'message' => 'Id or Nama Avalaible',
            'totaldata' => count($result),
            'data' => $result
        ], RestController::HTTP_OK);
    }
    //kalau nilainya tidak ada
    else {
        $this->response([
            'status' => 404,
            'error' => "true",
            'message' => 'Maaf data assistant tidak ditemukan',
        ], RestController::HTTP_BAD_REQUEST);
    }

}

}