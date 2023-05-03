<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class DiklatAdd extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_diklat');
        $this->load->library('form_validation');
    }

//menambahkan data
    public function AddDiklat_post()
    {
    
        $diklat = new m_diklat;

        $i = $this->db->count_all('tb_assessment');
        
        //set rule validasi
        if ($this->_validationCheck() === FALSE) {
            $this->response([
                'status' => 404,
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors("Tolong Perhatikan ")
            ], RestController::HTTP_NOT_FOUND);
        } else {
    
            //load Data 
            $insert_data = [
            'assessment_id'                         => $diklat->idterurut($i),
            'assessment_to'                         => $this->post('assessment_to'),
            'scheme_id'                             => $this->post('scheme_id'),
            'assessment_name'                       => $this->post('assessment_name'),
            'assessment_date_start'                 => $this->post('assessment_date_start'),
            'assessment_date_finish'                => $this->post('assessment_date_finish'),
            'assessment_type'                       => $this->post('assessment_type'),
            'assessment_location'                   => $this->post('assessment_location'),
            'assessment_address'                    => $this->post('assessment_address'),
            'assessment_origin'                     => $this->post('assessment_origin'),
            'assessment_city'                       => $this->post('assessment_city'),
            'assessment_person_in_charge'           => $this->post('assessment_person_in_charge'),
            'assessment_participant'                => $this->post('assessment_participant'),
            'assessment_date'                       => $this->post('assessment_date'),
            'assessment_tgl_sk'                     => $this->post('assessment_tgl_sk'),
            'assessment_no_sk_penyelenggara'        => $this->post('assessment_no_sk_penyelenggara'),
            'assessment_no_sk_peserta'              => $this->post('assessment_no_sk_peserta'),
            'assessment_no_sk_asesor'               => $this->post('assessment_no_sk_asesor'),
            'assessment_no_sk_evaluasi'             => $this->post('assessment_no_sk_evaluasi'),
            'assessment_tgl_sk_evaluasi'            => $this->post('assessment_tgl_sk_evaluasi'),
            'assessment_meeting_date'               => $this->post('assessment_meeting_date'),
            'assessment_year'                       => $this->post('assessment_year'),
            'assessment_code_keg'                   => $this->post('assessment_code_keg'),
            'assessment_instructor'                 => $this->post('assessment_instructor'),
            'assessment_finish'                     => $this->post('assessment_finish'),
            'pegawai_id'                            => $this->post('pegawai_id'),
            'assessment_delay'                      => $this->post('assessment_delay'),
            'assessment_filter'                     => $this->post('assessment_filter'),
            'assessment_date_added'                 => date('Y-m-d H:i:s', time()),
            'assessment_date_updated'               => date('Y-m-d H:i:s', time()),
            'accepted'                              => $this->post('accepted'),
            'token'                                 => $this->post('token'),
            'photo_open'                            => $this->post('photo_open'),
            'photo_middle'                          => $this->post('photo_middle'),
            'photo_close'                           => $this->post('photo_close'),
            ];
    
            //Memasukkan Data 
            $result = $diklat->insertDiklat($insert_data);
    
            if ($result > 0 and !empty($result)) {
                //sukses
                $this->response([
                    'status' => 201,
                    'error' => false,
                    'message' => 'New assessment Created',
                ], RestController::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => 404,
                    'error' => true,
                    'message' => 'failed to Create assessment'
                ], RestController::HTTP_BAD_REQUEST);
            }
    
            }
    }

    private function _validationCheck()
    {
        $this->form_validation->set_rules( 'assessment_name', 'Nama diklat', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'assessment_date_start', 'Tanggal Mulai Diklat', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'assessment_date_finish', 'Tanggal Berakhir Diklat', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'assessment_location', 'Kab/Kota Pelaksana', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'assessment_address', 'Alamat Pelaksanaan', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'assessment_participant', 'Asal Peserta', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'assessment_person_in_charge', 'Mitra PenanggungJawab', 'required',
        array('required' => '{field} wajib diisi')
        );
        return $this->form_validation->run();
    }
}