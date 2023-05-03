<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class DiklatUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_diklat');
    }

    //Mengupdate Data
    public function DiklatUpdated_put($id)
    {
        $diklat = new m_diklat;

        $data = [
            'assessment_to'                         => $this->put('assessment_to'),
            'scheme_id'                             => $this->put('scheme_id'),
            'assessment_name'                       => $this->put('assessment_name'),
            'assessment_date_start'                 => $this->put('assessment_date_start'),
            'assessment_date_finish'                => $this->put('assessment_date_finish'),
            'assessment_type'                       => $this->put('assessment_type'),
            'assessment_location'                   => $this->put('assessment_location'),
            'assessment_address'                    => $this->put('assessment_address'),
            'assessment_origin'                     => $this->put('assessment_origin'),
            'assessment_city'                       => $this->put('assessment_city'),
            'assessment_person_in_charge'           => $this->put('assessment_person_in_charge'),
            'assessment_participant'                => $this->put('assessment_participant'),
            'assessment_date'                       => $this->put('assessment_date'),
            'assessment_tgl_sk'                     => $this->put('assessment_tgl_sk'),
            'assessment_no_sk_penyelenggara'        => $this->put('assessment_no_sk_penyelenggara'),
            'assessment_no_sk_peserta'              => $this->put('assessment_no_sk_peserta'),
            'assessment_no_sk_asesor'               => $this->put('assessment_no_sk_asesor'),
            'assessment_no_sk_evaluasi'             => $this->put('assessment_no_sk_evaluasi'),
            'assessment_tgl_sk_evaluasi'            => $this->put('assessment_tgl_sk_evaluasi'),
            'assessment_meeting_date'               => $this->put('assessment_meeting_date'),
            'assessment_year'                       => $this->put('assessment_year'),
            'assessment_code_keg'                   => $this->put('assessment_code_keg'),
            'assessment_instructor'                 => $this->put('assessment_instructor'),
            'assessment_finish'                     => $this->put('assessment_finish'),
            'pegawai_id'                            => $this->put('pegawai_id'),
            'assessment_delay'                      => $this->put('assessment_delay'),
            'assessment_filter'                     => $this->put('assessment_filter'),
            'assessment_date_added'                 => date('Y-m-d H:i:s', time()),
            'assessment_date_updated'               => date('Y-m-d H:i:s', time()),
            'accepted'                              => $this->put('accepted'),
            'token'                                 => $this->put('token'),
            'photo_open'                            => $this->put('photo_open'),
            'photo_middle'                          => $this->put('photo_middle'),
            'photo_close'                           => $this->put('photo_close'),
        ];
        
        $update_result = $diklat->updateDiklat($id, $data);

        if ($update_result > 0) {
            $this->response([
                'status' => true,
                'message' => 'NEW assessment Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed TO Updated assessment'
            ], RestController::HTTP_BAD_REQUEST);
        }
    
    }


}