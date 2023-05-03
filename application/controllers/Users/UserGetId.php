<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserGetId extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_users');
    }

//mendapatkan id
public function UsersGetById_get($cari = NULL)
{
    $users = new m_users;
    $result = $users->GetByIdUsers($cari);

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
            'message' => 'Id tersedia',
            'totaldata' => count($result),
            'data' => $result
        ], RestController::HTTP_OK);
    }
    //kalau nilainya tidak ada
    else {
        $this->response([
            'status' => 404,
            'error' => "true",
            'message' => 'Maaf data ' . $cari . ' tidak ditemukan',
        ], RestController::HTTP_BAD_REQUEST);
    }

}

}