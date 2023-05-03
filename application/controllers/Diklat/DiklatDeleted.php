<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class DiklatDeleted extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_diklat');
    }
    //menghapus
    public function DiklatDeleted_delete($id = null)
    {
        $diklat = new m_diklat;

        $cekData = $diklat->deletedDiklat($id);

        if ($cekData > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Diklat DELETED'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID Diklat Not Found'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}