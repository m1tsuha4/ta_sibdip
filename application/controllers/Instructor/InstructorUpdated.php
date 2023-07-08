<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class InstructorUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_instructor');
    }

//Mengupdate Data
public function InstructorUpdated_post($id)
{

    $instructor = new m_instructor;

    $data_instructor = $this->m_instructor->GetByIdInstructor($id);
	@unlink($data_instructor[0]['avatar']);
     //Upload Gambar
     $file = $_FILES['avatar'];
        
     $path = "uploads/instructor/"; //direktori

     //mengecek folder sudah ada atau belum
     if(!is_dir($path))
     {
         mkdir($path, 0777, true);
     }

     $path_file = "";
     //pengecekkan file yang diupload
     if(!empty($file['name'])) {
         $config['upload_path'] = './' . $path;
         $config['allowed_types'] = "jpg|jpeg|png|gif";
         $config['file_name'] = time();
         $config['max_size'] = 1024;
         $this->upload->initialize($config);

         if($this->upload->do_upload('avatar')){
            @unlink($data_instructor[0]['avatar']);
             //mendapatkan file yang berhasil diupload
             $uploadData = $this->upload->data();
             $path_file = './'. $path . $uploadData['file_name'];
             $data['avatar'] = $path_file;
         }
     }

	$update_data = [
		'sort_id'                   => $this->post('sort_id', TRUE),
		'assistant'                 => $this->post('assistant', TRUE),
		'nik'                       => $this->post('nik', TRUE),
		'nip'                       => $this->post('nip', TRUE),
		'gelar_depan'               => $this->post('gelar_depan', TRUE),
		'nama'                      => $this->post('nama', TRUE),
		'gelar_belakang'            => $this->post('gelar_belakang', TRUE),
		'jenis_kelamin'             => $this->post('jenis_kelamin', TRUE),
		'tempat_lahir'              => $this->post('tempat_lahir', TRUE),
		'tanggal_lahir'             => $this->post('tanggal_lahir', TRUE),
		'alamat'                    => $this->post('alamat', TRUE),
		'id_provinsi'               => $this->post('id_provinsi', TRUE),
		'id_kabupaten'              => $this->post('id_kabupaten', TRUE),
		'id_kecamatan'              => $this->post('id_kecamatan', TRUE),
		'id_kelurahan'              => $this->post('id_kelurahan', TRUE),
		'telepon'                   => $this->post('telepon', TRUE),
		'email'                     => $this->post('email', TRUE),
		'agama'                     => $this->post('agama', TRUE),
		'status_perkawinan'         => $this->post('status_perkawinan', TRUE),
		'pendidikan'                => $this->post('pendidikan', TRUE),
		'jabatan'                   => $this->post('jabatan', TRUE),
		'jabatan_ext'               => $this->post('jabatan_ext', TRUE),
		'tahun_tamat'               => $this->post('tahun_tamat', TRUE),
		'jabatan'                   => $this->post('jabatan', TRUE),
		'pangkat'                   => $this->post('pangkat', TRUE),
		'golongan'                  => $this->post('golongan', TRUE),
		'office'                    => $this->post('office', TRUE),
		'office_phone'              => $this->post('office_phone', TRUE),
		'training'                  => $this->post('training', TRUE),
		'work_exp'                  => $this->post('work_exp', TRUE),
		'teach_exp'                 => $this->post('teach_exp', TRUE),
		'scientific_work'           => $this->post('scientific_work', TRUE),
		'special_sub'               => $this->post('special_sub', TRUE),
		'npwp'                      => $this->post('npwp', TRUE),
		'no_npwp'                   => $this->post('no_npwp', TRUE),
		'type_status'               => $this->post('type_status', TRUE),
		'username'                  => $this->post('username', TRUE),
		'password'                  => $this->post('password', TRUE),
		'level'                     => $this->post('level', TRUE),
		'role'                      => $this->post('role', TRUE),
		'avatar'                    => $path_file,
		'avatar_slug'               => $this->post('avatar_slug', TRUE),
		'ava'                       => $this->post('ava', TRUE),
		'signature'                 => $this->post('signature', TRUE),
		'blocked'                   => $this->post('blocked', TRUE),
		'activated'                 => $this->post('activated', TRUE),
		'token'                     => $this->post('token', TRUE),
		'status_token'              => $this->post('status_token', TRUE),
		'date_token'                => $this->post('date_token', TRUE),
		'end_token'                 => $this->post('end_token', TRUE),
		'date_added_employee'       => date('Y-m-d H:i:s', time()),
		'date_updated_employee'     => date('Y-m-d H:i:s', time()),
	];
//    var_dump($update_data);
    $result_update = $instructor->updatedInstructor($id, $update_data);

    if ($result_update > 0) {
        $this->response([
            'status'                => 200,
            'error' => null,
            'message' => 'Id ' . $id . ' telah Berhasil di Updated'
        ], RestController::HTTP_OK);
    } else {
        $this->response([
            'status' => false,
            'message' => 'Failed To Updated instructor'
        ], RestController::HTTP_BAD_REQUEST);
    }
}


}

/* ini kalau ingin makai form validation di metode input->post */
    //$this->form_validation->set_data($this->input->post());
