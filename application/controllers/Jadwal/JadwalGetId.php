<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class JadwalGetId extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_jadwal');
        $this->load->model('m_diklat');
        $this->load->model('m_users');
    }

    //mendapatkan id
    public function JadwalGetById_get($userId, $assessmentId)
    {
    $jadwal = new m_jadwal;
    $diklat = new m_diklat;
    $result = $jadwal->GetByIdJadwal($assessmentId);

    $listDiklatNameAndTime = $diklat->getDiklatNameAndTime($assessmentId);

    if(!empty($listDiklatNameAndTime)){
        //datanya 1
        $users = new m_users;
        $isAdmin = $users->isAdmin($userId) === "1";
        $judulDiklat = $listDiklatNameAndTime[0]['assessment_name'];
        if (count($result) > 1) {
            $this->response([
                'status' => 200,
                'error' => "false",
                'message' => 'Jadwal Available',
                'totaldata' => count($result),
                'data' => $result,
                'is_admin' => $isAdmin
            ], RestController::HTTP_OK);
        }
        //kalau nilainya lebih dari 1
        elseif (count($result) === 1) {
            $this->response([
                'status' => 200,
                'error' => "false",
                'message' => 'Jadwal Available',
                'totaldata' => count($result),
                'data' => $result,
                'is_admin' => $isAdmin
            ], RestController::HTTP_OK);
        }else {
            $this->response([
                'status' => 404,
                'error' => "true",
                'message' => 'Maaf data jadwal/materi di ' .$judulDiklat. ' belum ada',  
            ], RestController::HTTP_BAD_REQUEST);
        }
    }//kalau nilainya tidak ada
    else {
        $this->response([
            'status' => 404,
            'error' => "true",
            'message' => 'Maaf data jadwal/materi tidak ditemukan',
        ], RestController::HTTP_BAD_REQUEST);
        }
    }

}