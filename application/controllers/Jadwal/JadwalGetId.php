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
    }

    //mendapatkan id
    public function JadwalGetById_get($cari = NULL)
    {
    $jadwal = new m_jadwal;
    $diklat = new m_diklat;
    $result = $jadwal->GetByIdJadwal($cari);

    $diklatNames = $diklat->getDiklatName($cari);

    if(!empty($diklatNames)){
        //datanya 1
        $judulDiklat = $diklatNames[0]['assessment_name'];
        if (count($result) > 1) {
            $this->response([
                'status' => 200,
                'error' => "false",
                'message' => 'Jadwal Available',
                'totaldata' => count($result),
                'data' => $result
            ], RestController::HTTP_OK);
        }
        //kalau nilainya lebih dari 1
        elseif (count($result) === 1) {
            $this->response([
                'status' => 200,
                'error' => "false",
                'message' => 'Jadwal Available',
                'totaldata' => count($result),
                'data' => $result
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
