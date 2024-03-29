<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class AsistenAdd extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_asistent');
        $this->load->library('form_validation');
		$this->key = '1234567890';
    }
//oke
//menambahkan data
public function AssistantAdd_post()
{
    $asistent = new m_asistent;

    $i = $this->db->count_all('tb_pegawai');
	$password = '12345';
	$encrypt_pass = hash('sha512', $password. $this->key);
    //set rule validasi
    if ($this->_validationCheck() === FALSE) {
        $this->response([
            'status' => 404,
            'error' => $this->form_validation->error_array(),
            'message' => validation_errors("Tolong Perhatikan ")
        ], RestController::HTTP_NOT_FOUND);
    } else {

        //Upload Gambar
        $file = $_FILES['avatar'];

        $path = "uploads/assistant/"; //direktori

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
                //mendapatkan file yang berhasil diupload
                $uploadData = $this->upload->data();
                $path_file = './'.$path.$uploadData['file_name'];
            }
        }
        //load Data
        $insert_data = [
            'pegawai_id'                => $asistent->idterurut($i),
            'sort_id'                   => 0,
            'assistant'                 => 'Y',
            'sort_number'               => 0,
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
            'pendidikan'                => $this->post('pendidikan', TRUE),
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
            'username'                  => $asistent->idterurut($i),
            'password'                  => $encrypt_pass,
			'level'						=> 'assistant',
            'avatar'                    => $path_file,
            'date_added_employee'       => date('Y-m-d H:i:s', time()),
            'date_updated_employee'     => date('Y-m-d H:i:s', time()),
        ];

        //Memasukkan Data
        $result = $asistent->insertAssistant($insert_data);

        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status' => 201,
                'error' => false,
                'message' => 'Asistent Created',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => 404,
                'error' => true,
                'message' => 'Failed to Create Asistent'
            ], RestController::HTTP_BAD_REQUEST);
        }

        }

    }

    private function _validationCheck()
    {
        $this->form_validation->set_rules( 'nik', 'Nomor Induk Keluarga', 'required|numeric|is_unique[tb_pegawai.nik]',
            array('required' => '{field} wajib diisi',
            'is_unique' => '{field} ini sudah ada',
            'numeric' => '{field} harus angka')
        );
        $this->form_validation->set_rules( 'nama', 'Nama Lengkap', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'jenis_kelamin', 'Jenis Kelamin', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'tempat_lahir', 'Tempat lahir', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'tanggal_lahir', 'Tanggal lahir', 'required',
        array('required' => '{field} wajib diisi')
        );
/*        $this->form_validation->set_rules( 'agama', 'Agama Anda', 'required',
        array('required' => '{field} wajib diisi')
        );

        $this->form_validation->set_rules( 'status_perkawinan', 'Status Perkawinan Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
*/

        $this->form_validation->set_rules( 'alamat', 'Alamat Rumah', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'telepon', 'Nomor Telepon Anda', 'required|numeric',
        array('required' => '{field} wajib diisi',
        'numeric' => '{field} harus angka')
        );
/*
        $this->form_validation->set_rules( 'email', 'Email Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
*/
        $this->form_validation->set_rules( 'pendidikan', 'Pendidikan Terakhir Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        /*
        $this->form_validation->set_rules( 'no_npwp', 'Nomor Pokok Wajib Pajak', 'numeric',
        array('numeric' => '{field} harus angka')
        );
        */
        // no_npwp

        return $this->form_validation->run();
    }


}
//	public function AssistantAdd_post(){
//		$asistent = new m_asistent;
//		$i = $this->db->count_all('tb_assistant_instructor');
//		$insert_data = [
//			'assistant_instructor_id'=>$asistent->idurut($i),
//			'assessment_id' =>$this->post('assessment_id' ,TRUE),
//			'instructor_id'	=>$this->post('instructor_id', TRUE),
//			'pegawai_id'	=>$this->post('pegawai_id', TRUE)
//		];
//	var_dump($insert_data);
//		$result = $asistent->insertAssistant($insert_data);
//
//        if ($result > 0 and !empty($result)) {
//            //sukses
//            $this->response([
//                'status' => 201,
//                'error' => false,
//                'message' => 'New Asistent Created',
//            ], RestController::HTTP_CREATED);
//        } else {
//            $this->response([
//                'status' => 404,
//                'error' => true,
//                'message' => 'Failed to Create Asistent'
//            ], RestController::HTTP_BAD_REQUEST);
//        }
//
//	}
//
//}