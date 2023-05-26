<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ExternalUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_panitia');
    }

//Mengupdate Data
public function ExternalUpdated_post($id)
{

    $panitia = new m_panitia;

    $data_panitia = $this->m_panitia->GetByIdPanitia($id);

     //Upload Gambar
     $file = $_FILES['avatar'];
        
     $path = "uploads/external/"; //direktori

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
            @unlink($data_asisten[0]['avatar']);
             //mendapatkan file yang berhasil diupload
             $uploadData = $this->upload->data();
             $path_file = './'. $path . $uploadData['file_name'];
             $data['avatar'] = $path_file;
         }
     }
    
//        $data['sort_id']                = $this->input->post('sort_id', TRUE);
//        $data['assistant']              = $this->input->post('assistant', TRUE);
//        $data['nik']                    = $this->input->post('nik', TRUE);
//        $data['nip']                    = $this->input->post('nip', TRUE);
//        $data['gelar_depan']            = $this->input->post('gelar_depan', TRUE);
//        $data['nama']                   = $this->input->post('nama', TRUE);
//        $data['gelar_belakang']         = $this->input->post('gelar_belakang', TRUE);
//        $data['jenis_kelamin']          = $this->input->post('jenis_kelamin', TRUE);
//        $data['tempat_lahir']           = $this->input->post('tempat_lahir', TRUE);
//        $data['tanggal_lahir']          = $this->input->post('tanggal_lahir', TRUE);
//        $data['alamat']                 = $this->input->post('alamat', TRUE);
//        $data['id_provinsi']            = $this->input->post('id_provinsi', TRUE);
//        $data['id_kabupaten']           = $this->input->post('id_kabupaten', TRUE);
//        $data['id_kecamatan']           = $this->input->post('id_kecamatan', TRUE);
//        $data['id_kelurahan']           = $this->input->post('id_kelurahan', TRUE);
//        $data['telepon']                = $this->input->post('telepon', TRUE);
//        $data['email']                  = $this->input->post('email', TRUE);
//        $data['agama']                  = $this->input->post('agama', TRUE);
//        $data['status_perkawinan']      = $this->input->post('status_perkawinan', TRUE);
//        $data['pendidikan']             = $this->input->post('pendidikan', TRUE);
//        $data['jurusan']                = $this->input->post('jurusan', TRUE);
//        $data['tahun_tamat']            = $this->input->post('tahun_tamat', TRUE);
//        $data['jabatan']                = $this->input->post('jabatan', TRUE);
//        $data['pangkat']                = $this->input->post('pangkat', TRUE);
//        $data['golongan']               = $this->input->post('golongan', TRUE);
//        $data['npwp']                   = $this->input->post('npwp', TRUE);
//        $data['no_npwp']                = $this->input->post('no_npwp', TRUE);
//        $data['username']               = $this->input->post('username', TRUE);
//        $data['password']               = $this->input->post('password', TRUE);
//        $data['level']                  = $this->input->post('level', TRUE);
//        $data['role']                   = $this->input->post('role', TRUE);
//        $data['avatar_slug']            = $this->input->post('avatar_slug', TRUE);
//        $data['ava']                    = $this->input->post('ava', TRUE);
//        $data['signature']              = $this->input->post('signature', TRUE);
//        $data['blocked']                = $this->input->post('blocked', TRUE);
//        $data['activated']              = $this->input->post('activated', TRUE);
//        $data['token']                  = $this->input->post('token', TRUE);
//        $data['status_token']           = $this->input->post('status_token', TRUE);
//        $data['date_token']             = $this->input->post('date_token', TRUE);
//        $data['end_token']              = $this->input->post('end_token', TRUE);
//        $data['date_updated_employee']  = date('Y-m-d H:i:s', time());
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
		'jurusan'                   => $this->post('jurusan', TRUE),
		'tahun_tamat'               => $this->post('tahun_tamat', TRUE),
		'jabatan'                   => $this->post('jabatan', TRUE),
		'pangkat'                   => $this->post('pangkat', TRUE),
		'golongan'                  => $this->post('golongan', TRUE),
		'npwp'                      => $this->post('npwp', TRUE),
		'no_npwp'                   => $this->post('no_npwp', TRUE),
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
		'date_updated_employee'     => date('Y-m-d H:i:s', time()),
	];
    $result_update = $panitia->updatedPanitia($id, $update_data);

    if ($result_update > 0) {
        $this->response([
            'status'                => 200,
            'error' => null,
            'message' => 'Id ' . $id . ' telah Berhasil di Updated'
        ], RestController::HTTP_OK);
    } else {
        $this->response([
            'status' => false,
            'message' => 'Failed To Updated Panitia External'
        ], RestController::HTTP_BAD_REQUEST);
    }
}


}

/* ini kalau ingin makai form validation di metode input->post */
    //$this->form_validation->set_data($this->input->post());
