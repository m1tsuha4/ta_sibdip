<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class InstructorAdd extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_instructor');
    }

//menambahkan data
public function AddInstructor_post()
{
    $instructor = new m_instructor;

	//load Data
	$insert_data = [
		'assessment_id'							=> $this->post('assessment_id',TRUE),
		'instructor_id'							=> $this->post('instructor_id', TRUE),
		'instructor_gol'						=> $this->post('instructor_gol', TRUE),
		'instructor_npwp'						=> $this->post('instructor_npwp', TRUE),
		'instructor_pph'						=> $this->post('instructor_pph', TRUE),
		'honor_nol'								=> $this->post('honor_nol', TRUE),
		'honor_paid'							=> $this->post('honor_paid', TRUE),
		'training_instructor_date_added'     	=> date('Y-m-d H:i:s', time()),
	];

	//Memasukkan Data
	$result = $instructor->insertInstructor($insert_data);

	if ($result > 0 and !empty($result)) {
		//sukses
		$this->response([
			'status' => 201,
			'error' => false,
			'message' => 'Instructor Created',
		], RestController::HTTP_CREATED);
	} else {
		$this->response([
			'status' => 404,
			'error' => true,
			'message' => 'Failed to Create Instructor'
		], RestController::HTTP_BAD_REQUEST);
	}

    }
    
//    private function _validationCheck()
//    {
//        $this->form_validation->set_rules( 'nik', 'Nomor Induk Keluarga', 'required|numeric|is_unique[tb_pegawai.nik]',
//            array('required' => '{field} wajib diisi',
//            'is_unique' => '{field} ini sudah ada',
//            'numeric' => '{field} harus angka')
//        );
//        $this->form_validation->set_rules( 'nama', 'Nama Lengkap', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'jenis_kelamin', 'Jenis Kelamin', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'tempat_lahir', 'Tempat lahir', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'tanggal_lahir', 'Tanggal lahir', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'agama', 'Agama Anda', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'status_perkawinan', 'Status Perkawinan Anda', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'alamat', 'Alamat Rumah', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'telepon', 'Nomor Telepon Anda', 'required|numeric',
//        array('required' => '{field} wajib diisi',
//        'numeric' => '{field} harus angka')
//        );
//        $this->form_validation->set_rules( 'email', 'Email Anda', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'pendidikan', 'Pendidikan Terakhir Anda', 'required',
//        array('required' => '{field} wajib diisi')
//        );
//        $this->form_validation->set_rules( 'no_npwp', 'Nomor Pokok Wajib Pajak', 'numeric',
//        array('numeric' => '{field} harus angka')
//        );
//
//        return $this->form_validation->run();
//    }


}
