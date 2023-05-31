<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PesertaAdd extends RestController {

    
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_peserta');
        $this->load->library('form_validation');
    }

//menambahkan data
    public function AddPeserta_post()
    {
        $peserta = new m_peserta;

        $i = $this->db->count_all('tb_student');

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

        //load Data 
        $insert_data = [
                    'student_id'                    => $peserta->idterurut($i),
                    'assessment_id'                 => $this->post('assessment_id'),
                    'nik'                           => $this->post('nik'),
                    'fullname'                      => $this->post('fullname'),
                    'gender'                        => $this->post('gender'),
                    'birthplace'                    => $this->post('birthplace'),
                    'birthday'                      => $this->post('birthday'),
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
//                    'company_name'                  => $this->post('company_name'),
                    'avatar'                        => $path_file,
                    'signature'                     => $this->post('signature'),
                    'student_year'                  => $this->post('student_year')
        ];
		$insert_score = [
			'student_id'                    => $peserta->idterurut($i),
			'assessment_id'                 => $this->post('assessment_id'),
			'material_id'					=> $this->post('material_id')

		];
//		$this->db->trans_start(); // Memulai transaksi
//
//// Data untuk tabel pertama
//		$data1 = array(
//			'field1' => 'Nilai1',
//			'field2' => 'Nilai2',
//		);
//		$this->db->insert('nama_tabel1', $data1);
//
//// Mengambil ID yang baru saja di-generate dalam tabel pertama
//		$id1 = $this->db->insert_id();
//
//// Data untuk tabel kedua
//		$data2 = array(
//			'field3' => 'Nilai3',
//			'field4' => 'Nilai4',
//			'foreign_key' => $id1, // Menggunakan foreign key yang sama
//		);
//		$this->db->insert('nama_tabel2', $data2);
//
//		$this->db->trans_complete(); // Menyelesaikan transaksi
//
//		if ($this->db->trans_status() === FALSE) {
//			// Transaksi gagal
//			echo "Gagal menambahkan data ke dua tabel.";
//		} else {
//			// Transaksi berhasil
//			echo "Data berhasil ditambahkan ke dua tabel.";
//		}

        //Memasukkan Data 
        $result = $peserta->insertPeserta($insert_data,$insert_score);

        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status'                    => 201,
                'error'                     => false,
                'message'                   => 'New Peserta Created',
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
        $this->form_validation->set_rules( 'department', 'Jurusan Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'diploma_year', 'Tahun Ijazah Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'student_year', 'Tahun Diklat', 'required',
        array('required' => '{field} wajib diisi')
        );
       

        return $this->form_validation->run();
    }



    
}
