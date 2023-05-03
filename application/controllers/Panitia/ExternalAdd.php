<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ExternalAdd extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_panitia');
        $this->load->library('form_validation');
    }
//oke
//menambahkan data
public function AddExternal_post()
{
    $panitia = new m_panitia;

    $i = $this->db->count_all('tb_pegawai');

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
                //mendapatkan file yang berhasil diupload
                $uploadData = $this->upload->data();
                $path_file = './'.$path.$uploadData['file_name'];
            }
        }

        //load Data 
        $insert_data = [
            'pegawai_id'                => $asistent->idterurut($i),
            'sort_id'                   => $this->post('sort_id', TRUE),
            'assistant'                 => $this->post('assistant', TRUE),
            'sort_number'               => $this->post('sort_number', TRUE),
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
            'jabatan_ext'               => $this->post('jabatan_ext', TRUE),
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
            'date_added_employee'       => date('Y-m-d H:i:s', time()),
            'date_updated_employee'     => date('Y-m-d H:i:s', time()),
        ];

        //Memasukkan Data 
        $result = $panitia->insertPanitia($insert_data);

        if ($result > 0 and !empty($result)) {
            //sukses
            $this->response([
                'status' => 201,
                'error' => false,
                'message' => 'New Panitia External Created',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => 404,
                'error' => true,
                'message' => 'Failed to Create Panitia External'
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
        $this->form_validation->set_rules( 'agama', 'Agama Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'status_perkawinan', 'Status Perkawinan Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'alamat', 'Alamat Rumah', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'telepon', 'Nomor Telepon Anda', 'required|numeric',
        array('required' => '{field} wajib diisi',
        'numeric' => '{field} harus angka')
        );
        $this->form_validation->set_rules( 'email', 'Email Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'pendidikan', 'Pendidikan Terakhir Anda', 'required',
        array('required' => '{field} wajib diisi')
        );
        $this->form_validation->set_rules( 'no_npwp', 'Nomor Pokok Wajib Pajak', 'numeric',
        array('numeric' => '{field} harus angka')
        );

        return $this->form_validation->run();
    }


}