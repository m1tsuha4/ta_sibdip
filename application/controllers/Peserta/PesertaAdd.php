<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PesertaAdd extends RestController {


    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		$this->load->model('m_jadwal');
		$this->load->model('m_diklat');
        $this->load->model('m_peserta');
        $this->load->library('form_validation');
		$this->key = '1234567890';
    }

//menambahkan data
    public function AddPeserta_post()
    {
        $peserta = new m_peserta;

        $i = $this->db->count_all('tb_student');
		$id = $this->input->post('assessment_id');


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
        
        $path = "uploads/peserta/"; //direktori

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
		$nik = $this->post('nik');
		$birthday = $this->post('birthday');
		$formatted_birthday = date('dmY', strtotime($birthday));
		$password = $formatted_birthday;
		$encrypt_pass = hash('sha512', $password.$this->key);
        //load Data 
        $insert_data = [
                    'assessment_id'                 => $this->post('assessment_id'),
                    'nik'                           => $nik,
                    'fullname'                      => $this->post('fullname'),
                    'gender'                        => $this->post('gender'),
                    'birthplace'                    => $this->post('birthplace'),
                    'birthday'                      => $birthday,
                    'religion'                      => $this->post('religion'),
                    'marital_status'                => $this->post('marital_status'),
                    'address'                       => $this->post('address'),
                    'id_provinsi'                   => $this->post('id_provinsi'),
                    'id_kabupaten'                  => $this->post('id_kabupaten'),
                    'id_kecamatan'                  => $this->post('id_kecamatan'),
                    'id_kelurahan'                  => $this->post('id_kelurahan'),
                    'phone'                         => $this->post('phone'),
                    'email'                         => $this->post('email'),
                    'education'                     => $this->post('education'),
                    'department'                    => $this->post('department'),
                    'diploma_year'                  => $this->post('diploma_year'),
                    'company_id'                    => $this->post('company_id'),
                    'resign'                        => $this->post('resign'),
                    'graduated'                     => $this->post('graduated'),
                    'avatar'                        => $path_file,
                    'signature'                     => $this->post('signature'),
                    'student_year'                  => $this->post('student_year'),
					'username'						=> $nik,
					'password'						=> $encrypt_pass
        ];
        //Memasukkan Data 
        $result = $peserta->insertPeserta($insert_data);
		$last_student_id = $this->db->insert_id();

		// insert tb_score
		$score = $this->m_jadwal->GetByIdJadwal($id);

		if ($score) {
			foreach ($score as $row) {
				$assessmentId = $row['assessment_id'];
				$materialId = $row['material_id'];

				$data = array(
					'student_id' => $last_student_id,
					'assessment_id' => $assessmentId,
					'material_id' => $materialId,
				);
				$this->db->insert('tb_score', $data);
			}
		}

		// insert tb_present
		$user_data = $this->m_diklat->GetDataDate($id);

		$firstRow = $user_data[0];
		$dateStart = DateTime::createFromFormat('Y-m-d', $firstRow["assessment_date_start"]);
		$dateEnd = DateTime::createFromFormat('Y-m-d', $firstRow["assessment_date_finish"]);
		$currentDate = clone $dateStart;
		while ($currentDate <= $dateEnd) {
			$data = array(
				'student_id' => $last_student_id ,
				'assessment_id' => $this->post('assessment_id'),
				'present_date' => $currentDate->format('Y-m-d'),
			);
			$this->db->insert('tb_present', $data);

			$currentDate->modify('+1 day');
		}
        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status'                    => 201,
                'error'                     => false,
                'message'                   => 'Peserta Created',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status'                    => 404,
                'error'                     => true,
                'message'                   => 'Failed to Create Peserta'
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
        $this->form_validation->set_rules( 'fullname', 'Nama Lengkap', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'gender', 'Jenis Kelamin', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'birthplace', 'Tempat lahir', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'birthday', 'Tanggal lahir', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'religion', 'Agama Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'marital_status', 'Status Perkawinan Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'address', 'Alamat Rumah', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'phone', 'Nomor Telepon Anda', 'required|numeric',
        array('required' => '{field} wajib diisi',
        'numeric' => '{field} harus angka')
        );
        $this->form_validation->set_rules( 'email', 'Email Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'education', 'Pendidikan Terakhir Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        /*$this->form_validation->set_rules( 'department', 'Jurusan Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'diploma_year', 'Tahun Ijazah Anda', 'required',
        array('required' => '{field} wajib diisi')
        );*/
        $this->form_validation->set_rules( 'student_year', 'Tahun Diklat', 'required',
        array('required' => '{field} wajib diisi')
        );
        return $this->form_validation->run();
    }



    
}
