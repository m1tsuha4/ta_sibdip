<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class PesertaUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_peserta');
    }

    //Mengupdate Data
    public function PesertaUpdated_post($id)
    {
        $peserta = new m_peserta;

        $data_peserta = $this->m_peserta->GetByIdPeserta($id);
		@unlink($data_peserta[0]['avatar']);
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
                 $data['avatar'] = $path_file;
             }
         }

		$update_data = [
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
//			'company_name'                  => $this->post('company_name'),
			'avatar'                        => $path_file,
			'signature'                     => $this->post('signature'),
			'student_year'                  => $this->post('student_year')
		];

        $result_update = $peserta->updatedPeserta($id, $update_data);
    
        if ($result_update > 0) {
            $this->response([
                'status' => 200,
                'error' => null,
                'message' => 'Id ' . $id . ' telah Berhasil di Updated'
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed To Updated Peserta'
            ], RestController::HTTP_BAD_REQUEST);
        }
    
    
    }


}
