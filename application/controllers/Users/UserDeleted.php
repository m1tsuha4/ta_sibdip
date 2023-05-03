<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_users');
    }
    //menghapus
    public function UsersDeleted_delete($id = null)
    {
        $users = new m_users;

        //menghapus avatar
        $data_user = $this->m_users->GetByIdUsers($id);
        @unlink($data_asisten[0]['avatar']);
        $cekData = $users->deletedUsers($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'User DELETED'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID User Not Found'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}