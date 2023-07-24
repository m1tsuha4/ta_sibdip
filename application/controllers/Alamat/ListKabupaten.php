<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ListKabupaten extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_alamat');
    }

//mendapatkan id
public function ListKabupaten_get($cari = NULL)
{
	$alamat = new m_alamat;
	$result = $alamat->listKabupaten($cari);

    //datanya 1
    if (count($result) > 1) {
        $this->response([
            'status' => 200,
            'error' => "false",
            'message' => 'Data Kabupaten Available',
            'totaldata' => count($result),
            'data' => $result
        ], RestController::HTTP_OK);
    }
    //kalau nilainya lebih dari 1
    elseif (count($result) === 1) {
        $this->response([
            'status' => 200,
            'error' => "false",
            'message' => 'Data Kabupaten Available',
            'totaldata' => count($result),
            'data' => $result
        ], RestController::HTTP_OK);
    }
    //kalau nilainya tidak ada
    else {
        $this->response([
            'status' => 404,
            'error' => "true",
            'message' => 'Maaf data kabupaten tidak ditemukan',
        ], RestController::HTTP_BAD_REQUEST);
    }

}

}
