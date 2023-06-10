<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserUpdated extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->model('m_users');
		$this->load->model('m_auth');
		$this->key = '1234567890';
	}

//Mengupdate Data
public function UsersUpdated_post($id)
{
    $users = new m_users;
//	$id = $this->db->count_all('tb_pegawai');
    $data_users = $this->m_users->GetByIdUsers($id);
	$password = $this->post('password');
	$encrypt_pass = hash('sha512', $password.$this->key);

    //Upload Gambar
    $file = $_FILES['avatar'];
//
    $path = "uploads/user/"; //direktori

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
           @unlink($data_users[0]['avatar']);
            //mendapatkan file yang berhasil diupload
            $uploadData = $this->upload->data();
            $path_file = './'. $path . $uploadData['file_name'];
        }
    }
	$data = [
//		'uid' 				=> $this->post('uid', TRUE),
//		'sort_id' 			=> $this->post('sort_id', TRUE),
//		'division_id' 		=> $this->post('division_id', TRUE),
//		'superior_id' 		=> $this->post('superior_id', TRUE),
//		'assistant' 		=> $this->post('assistant', TRUE),
//		'sort_number' 		=> $this->post('sort_number', TRUE),
		'avatar' 					=> $path_file,
		'nik' 				=> $this->post('nik', TRUE),
		'nip' 				=> $this->post('nip', TRUE),
		'gelar_depan' 		=> $this->post('gelar_depan', TRUE),
		'nama' 				=> $this->post('nama', TRUE),
		'gelar_belakang' 	=> $this->post('gelar_belakang', TRUE),
		'jenis_kelamin' 	=> $this->post('jenis_kelamin', TRUE),
		'tempat_lahir' 		=> $this->post('tempat_lahir', TRUE),
		'tanggal_lahir' 	=> $this->post('tanggal_lahir', TRUE),
		'agama' 			=> $this->post('agama', TRUE),
		'status_perkawinan' => $this->post('status_perkawinan', TRUE),
		'alamat' 			=> $this->post('alamat', TRUE),
		'id_provinsi' 		=> $this->post('id_provinsi', TRUE),
		'id_kabupaten' 		=> $this->post('id_kabupaten', TRUE),
		'id_kecamatan' 		=> $this->post('id_kecamatan', TRUE),
		'id_kelurahan' 		=> $this->post('id_kelurahan', TRUE),
		'telepon' 			=> $this->post('telepon', TRUE),
		'no_npwp' 					=> $this->post('no_npwp', TRUE),
		'pendidikan' 		=> $this->post('pendidikan', TRUE),
		'tahun_tamat'	 	=> $this->post('tahun_tamat', TRUE),
		'jurusan' 			=> $this->post('jurusan', TRUE),
		'email' 			=> $this->post('email', TRUE),
//		'password'                  => $encrypt_pass,
//		'golongan_darah' 	=> $this->post('golongan_darah', TRUE),
//
//
//		'status' 			=> $this->post('status', TRUE),
//		'jabatan' 			=> $this->post('jabatan', TRUE),
//		'jabatan_ext' 		=> $this->post('jabatan_ext', TRUE),
//		'pangkat' 			=> $this->post('pangkat', TRUE),
//		'golongan' 			=> $this->post('golongan', TRUE),
//		'profil_singkat' 	=> $this->post('profil_singkat', TRUE),
//		'latar_pendidikan' 	=> $this->post('latar_pendidikan', TRUE),
//		'no_bpjs' 			=> $this->post('no_bpjs', TRUE),
//		'faskes_kesehatan' 	=> $this->post('faskes_kesehatan', TRUE),
//		'alamat_faskes_kesehatan' 	=> $this->post('alamat_faskes_kesehatan', TRUE),
//		'faskes_gigi' 				=> $this->post('faskes_gigi', TRUE),
//		'alamat_faskes_gigi' 		=> $this->post('alamat_faskes_gigi', TRUE),
//
//		'no_efin' 					=> $this->post('no_efin', TRUE),
//		'pejabat' 					=> $this->post('pejabat', TRUE),
//		'penanggungjawab' 			=> $this->post('penanggungjawab', TRUE),
//
//		'password' 					=> $this->post('password', TRUE),
//		'level' 					=> $this->post('level', TRUE),
//		'role' 						=> $this->post('role', TRUE),

//		'avatar_slug' 				=> $this->post('avatar_slug', TRUE),
//		'ava' 						=> $this->post('ava', TRUE),
//		'signature' 				=> $this->post('signature', TRUE),
//		'blocked' 					=> $this->post('blocked', TRUE),
//		'activated' 				=> $this->post('activated', TRUE),
//		'att' 						=> $this->post('att', TRUE),
//		'org_publish' 				=> $this->post('org_publish', TRUE),
//		'token' 					=> $this->post('token', TRUE),
//		'status_token' 				=> $this->post('status_token', TRUE),
//		'date_token' 				=> $this->post('date_token', TRUE),
//		'end_token' 				=> $this->post('end_token', TRUE),
//		'date_added_employee' 		=> date('Y-m-d H:i:s', time()),
		'date_updated_employee' 	=> date('Y-m-d H:i:s', time()),
	];
    $result_update = $users->updatedUsers($id, $data,$encrypt_pass);

    if ($result_update > 0) {
        $this->response([
            'status' => 200,
            'error' => null,
            'message' => 'Id ' . $id . ' Telah Berhasil Updated'
        ], RestController::HTTP_OK);
    } else {
        $this->response([
            'status' => false,
            'message' => 'Failed To Updated Pegawai'
        ], RestController::HTTP_BAD_REQUEST);
    }
}
}






