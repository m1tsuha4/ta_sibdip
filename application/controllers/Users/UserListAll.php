<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserListAll extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_users');
    }

    public function index_get()
    {
        $users = new m_users;
        $result_users = $users->getDataUsers();

        //mendapatkan semua data
        if ($result_users) {
            $this->response([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil Mendapatkan Data',
                'totaldata' => count($result_users),
                'data' => $result_users
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