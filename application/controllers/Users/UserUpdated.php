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
	}

//Mengupdate Data
//public function UsersUpdated_post($id)
//{
//    $users = new m_users;
//	$id = $this->db->count_all('tb_pegawai');
//    $data_users = $this->m_users->GetByIdUsers($id);
//
//    //Upload Gambar
//    $file = $_FILES['avatar'];
////
//    $path = "uploads/user/"; //direktori
//
//    //mengecek folder sudah ada atau belum
//    if(!is_dir($path))
//    {
//        mkdir($path, 0777, true);
//    }
//
//    $path_file = "";
//    //pengecekkan file yang diupload
//    if(!empty($file['name'])) {
//        $config['upload_path'] = './' . $path;
//        $config['allowed_types'] = "jpg|jpeg|png|gif";
//        $config['file_name'] = time();
//        $config['max_size'] = 1024;
//        $this->upload->initialize($config);
//
//        if($this->upload->do_upload('avatar')){
//           @unlink($data_users[0]['avatar']);
//            //mendapatkan file yang berhasil diupload
//            $uploadData = $this->upload->data();
//            $path_file = './'. $path . $uploadData['file_name'];
//        }
//    }
////    $data['uid']                    = $this->input->post('uid', TRUE);
////    $data['sort_id']                = $this->input->post('sort_id', TRUE);
////    $data['division_id']            = $this->input->post('division_id', TRUE);
////    $data['superior_id']            = $this->input->post('superior_id', TRUE);
////    $data['assistant']              = $this->input->post('assistant', TRUE);
////    $data['sort_number']            = $this->input->post('sort_number', TRUE);
////    $data['nik']                    = $this->input->post('nik', TRUE);
////    $data['nip']                    = $this->input->post('nip', TRUE);
////    $data['gelar_depan']            = $this->input->post('gelar_depan', TRUE);
////    $data['nama']                   = $this->input->post('nama', TRUE);
////    $data['gelar_belakang']         = $this->input->post('gelar_belakang', TRUE);
////    $data['jenis_kelamin']          = $this->input->post('jenis_kelamin', TRUE);
////    $data['tempat_lahir']           = $this->input->post('tempat_lahir', TRUE);
////    $data['tanggal_lahir']          = $this->input->post('tanggal_lahir', TRUE);
////    $data['alamat']                 = $this->input->post('alamat', TRUE);
////    $data['id_provinsi']            = $this->input->post('id_provinsi', TRUE);
////    $data['id_kabupaten']           = $this->input->post('id_kabupaten', TRUE);
////    $data['id_kecamatan']           = $this->input->post('id_kecamatan', TRUE);
////    $data['id_kelurahan']           = $this->input->post('id_kelurahan', TRUE);
////    $data['telepon']                = $this->input->post('telepon', TRUE);
////    $data['email']                  = $this->input->post('email', TRUE);
////    $data['agama']                  = $this->input->post('agama', TRUE);
////    $data['status_perkawinan']      = $this->input->post('status_perkawinan', TRUE);
////    $data['golongan_darah']         = $this->input->post('golongan_darah', TRUE);
////    $data['pendidikan']             = $this->input->post('pendidikan', TRUE);
////    $data['jurusan']                = $this->input->post('jurusan', TRUE);
////    $data['tahun_tamat']            = $this->input->post('tahun_tamat', TRUE);
////    $data['status']                 = $this->input->post('status', TRUE);
////    $data['jabatan']                = $this->input->post('jabatan', TRUE);
////    $data['jabatan_ext']            = $this->input->post('jabatan_ext', TRUE);
////    $data['pangkat']                = $this->input->post('pangkat', TRUE);
////    $data['golongan']               = $this->input->post('golongan', TRUE);
////    $data['profil_singkat']         = $this->input->post('profil_singkat', TRUE);
////    $data['latar_pendidikan']       = $this->input->post('latar_pendidikan', TRUE);
////    $data['no_bpjs']                = $this->input->post('no_bpjs', TRUE);
////    $data['faskes_kesehatan']       = $this->input->post('faskes_kesehatan', TRUE);
////    $data['alamat_faskes_kesehatan']= $this->input->post('alamat_faskes_kesehatan', TRUE);
////    $data['faskes_gigi']            = $this->input->post('faskes_gigi', TRUE);
////    $data['alamat_faskes_gigi']     = $this->input->post('alamat_faskes_gigi', TRUE);
////    $data['no_npwp']                = $this->input->post('no_npwp', TRUE);
////    $data['no_efin']                = $this->input->post('no_efin', TRUE);
////    $data['pejabat']                = $this->input->post('pejabat', TRUE);
////    $data['penanggungjawab']        = $this->input->post('penanggungjawab', TRUE);
////    $data['username']               = $this->input->post('username', TRUE);
////    $data['password']               = $this->input->post('password', TRUE);
////    $data['level']                  = $this->input->post('level', TRUE);
////    $data['role']                   = $this->input->post('role', TRUE);
////	$data['avatar']                 = $path_file;
////    $data['avatar_slug']            = $this->input->post('avatar_slug', TRUE);
////    $data['ava']                    = $this->input->post('ava', TRUE);
////    $data['signature']              = $this->input->post('signature', TRUE);
////    $data['blocked']                = $this->input->post('blocked', TRUE);
////    $data['activated']              = $this->input->post('activated', TRUE);
////    $data['att']                    = $this->input->post('att', TRUE);
////    $data['org_publish']            = $this->input->post('org_publish', TRUE);
////    $data['token']                  = $this->input->post('token', TRUE);
////    $data['status_token']           = $this->input->post('status_token', TRUE);
////    $data['date_token']             = $this->input->post('date_token', TRUE);
////    $data['end_token']              = $this->input->post('end_token', TRUE);
////    $data['date_updated_employee']  = date('Y-m-d H:i:s', time());
//	$data = [
//		'uid' 				=> $this->post('uid', TRUE),
//		'sort_id' 			=> $this->post('sort_id', TRUE),
//		'division_id' 		=> $this->post('division_id', TRUE),
//		'superior_id' 		=> $this->post('superior_id', TRUE),
//		'assistant' 		=> $this->post('assistant', TRUE),
//		'sort_number' 		=> $this->post('sort_number', TRUE),
//		'nik' 				=> $this->post('nik', TRUE),
//		'nip' 				=> $this->post('nip', TRUE),
//		'gelar_depan' 		=> $this->post('gelar_depan', TRUE),
//		'nama' 				=> $this->post('nama', TRUE),
//		'gelar_belakang' 	=> $this->post('gelar_belakang', TRUE),
//		'jenis_kelamin' 	=> $this->post('jenis_kelamin', TRUE),
//		'tempat_lahir' 		=> $this->post('tempat_lahir', TRUE),
//		'tanggal_lahir' 	=> $this->post('tanggal_lahir', TRUE),
//		'alamat' 			=> $this->post('alamat', TRUE),
//		'id_provinsi' 		=> $this->post('id_provinsi', TRUE),
//		'id_kabupaten' 		=> $this->post('id_kabupaten', TRUE),
//		'id_kecamatan' 		=> $this->post('id_kecamatan', TRUE),
//		'id_kelurahan' 		=> $this->post('id_kelurahan', TRUE),
//		'telepon' 			=> $this->post('telepon', TRUE),
//		'email' 			=> $this->post('email', TRUE),
//		'agama' 			=> $this->post('agama', TRUE),
//		'status_perkawinan' => $this->post('status_perkawinan', TRUE),
//		'golongan_darah' 	=> $this->post('golongan_darah', TRUE),
//		'pendidikan' 		=> $this->post('pendidikan', TRUE),
//		'jurusan' 			=> $this->post('jurusan', TRUE),
//		'tahun_tamat'	 	=> $this->post('tahun_tamat', TRUE),
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
//		'no_npwp' 					=> $this->post('no_npwp', TRUE),
//		'no_efin' 					=> $this->post('no_efin', TRUE),
//		'pejabat' 					=> $this->post('pejabat', TRUE),
//		'penanggungjawab' 			=> $this->post('penanggungjawab', TRUE),
//		'username' 					=> $this->post('username', TRUE),
//		'password' 					=> $this->post('password', TRUE),
//		'level' 					=> $this->post('level', TRUE),
//		'role' 						=> $this->post('role', TRUE),
//		'avatar' 					=> $path_file,
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
//		'date_updated_employee' 	=> date('Y-m-d H:i:s', time()),
//	];
//
////	var_dump($data);
//
//    $result_update = $users->updatedUsers($id, $data);
//
//    if ($result_update > 0) {
//        $this->response([
//            'status' => 200,
//            'error' => null,
//            'message' => 'Id ' . $id . ' Telah Berhasil Updated'
//        ], RestController::HTTP_OK);
//    } else {
//        $this->response([
//            'status' => false,
//            'message' => 'Failed To Updated Pegawai'
//        ], RestController::HTTP_BAD_REQUEST);
//    }
//}
//}
	public function UsersUpdated_post($id)
	{
		$users = new m_users;

		$data_users = $this->m_users->GetByIdUsers($id);

		//Upload Gambar
		$file = $_FILES['avatar'];

		$path = "uploads/user/"; //direktori

		//mengecek folder sudah ada atau belum
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}

		$path_file = "";
		//pengecekkan file yang diupload
		if (!empty($file['name'])) {
			$config['upload_path'] = './' . $path;
			$config['allowed_types'] = "jpg|jpeg|png|gif";
			$config['file_name'] = time();
			$config['max_size'] = 1024;
			$this->upload->initialize($config);

			if ($this->upload->do_upload('avatar')) {
				@unlink($data_users[0]['avatar']);
				//mendapatkan file yang berhasil diupload
				$uploadData = $this->upload->data();
				$path_file = './' . $path . $uploadData['file_name'];
				$data['avatar'] = $path_file;
			}
		}

		$data['uid'] = $this->input->post('uid', TRUE);
		$data['sort_id'] = $this->input->post('sort_id', TRUE);
		$data['division_id'] = $this->input->post('division_id', TRUE);
		$data['superior_id'] = $this->input->post('superior_id', TRUE);
		$data['assistant'] = $this->input->post('assistant', TRUE);
		$data['sort_number'] = $this->input->post('sort_number', TRUE);
		$data['nik'] = $this->input->post('nik', TRUE);
		$data['nip'] = $this->input->post('nip', TRUE);
		$data['gelar_depan'] = $this->input->post('gelar_depan', TRUE);
		$data['nama'] = $this->input->post('nama', TRUE);
		$data['gelar_belakang'] = $this->input->post('gelar_belakang', TRUE);
		$data['jenis_kelamin'] = $this->input->post('jenis_kelamin', TRUE);
		$data['tempat_lahir'] = $this->input->post('tempat_lahir', TRUE);
		$data['tanggal_lahir'] = $this->input->post('tanggal_lahir', TRUE);
		$data['alamat'] = $this->input->post('alamat', TRUE);
		$data['id_provinsi'] = $this->input->post('id_provinsi', TRUE);
		$data['id_kabupaten'] = $this->input->post('id_kabupaten', TRUE);
		$data['id_kecamatan'] = $this->input->post('id_kecamatan', TRUE);
		$data['id_kelurahan'] = $this->input->post('id_kelurahan', TRUE);
		$data['telepon'] = $this->input->post('telepon', TRUE);
		$data['email'] = $this->input->post('email', TRUE);
		$data['agama'] = $this->input->post('agama', TRUE);
		$data['status_perkawinan'] = $this->input->post('status_perkawinan', TRUE);
		$data['golongan_darah'] = $this->input->post('golongan_darah', TRUE);
		$data['pendidikan'] = $this->input->post('pendidikan', TRUE);
		$data['jurusan'] = $this->input->post('jurusan', TRUE);
		$data['tahun_tamat'] = $this->input->post('tahun_tamat', TRUE);
		$data['status'] = $this->input->post('status', TRUE);
		$data['jabatan'] = $this->input->post('jabatan', TRUE);
		$data['jabatan_ext'] = $this->input->post('jabatan_ext', TRUE);
		$data['pangkat'] = $this->input->post('pangkat', TRUE);
		$data['golongan'] = $this->input->post('golongan', TRUE);
		$data['profil_singkat'] = $this->input->post('profil_singkat', TRUE);
		$data['latar_pendidikan'] = $this->input->post('latar_pendidikan', TRUE);
		$data['no_bpjs'] = $this->input->post('no_bpjs', TRUE);
		$data['faskes_kesehatan'] = $this->input->post('faskes_kesehatan', TRUE);
		$data['alamat_faskes_kesehatan'] = $this->input->post('alamat_faskes_kesehatan', TRUE);
		$data['faskes_gigi'] = $this->input->post('faskes_gigi', TRUE);
		$data['alamat_faskes_gigi'] = $this->input->post('alamat_faskes_gigi', TRUE);
		$data['no_npwp'] = $this->input->post('no_npwp', TRUE);
		$data['no_efin'] = $this->input->post('no_efin', TRUE);
		$data['pejabat'] = $this->input->post('pejabat', TRUE);
		$data['penanggungjawab'] = $this->input->post('penanggungjawab', TRUE);
		$data['username'] = $this->input->post('username', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		$data['level'] = $this->input->post('level', TRUE);
		$data['role'] = $this->input->post('role', TRUE);
		$data['avatar_slug'] = $this->input->post('avatar_slug', TRUE);
		$data['ava'] = $this->input->post('ava', TRUE);
		$data['signature'] = $this->input->post('signature', TRUE);
		$data['blocked'] = $this->input->post('blocked', TRUE);
		$data['activated'] = $this->input->post('activated', TRUE);
		$data['att'] = $this->input->post('att', TRUE);
		$data['org_publish'] = $this->input->post('org_publish', TRUE);
		$data['token'] = $this->input->post('token', TRUE);
		$data['status_token'] = $this->input->post('status_token', TRUE);
		$data['date_token'] = $this->input->post('date_token', TRUE);
		$data['end_token'] = $this->input->post('end_token', TRUE);
		$data['date_updated_employee'] = date('Y-m-d H:i:s', time());


		$result_update = $users->updatedUsers($id, $data);

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






