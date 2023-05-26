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
        
//            $data['student_id']             = $this->input->post('student_id', TRUE);
//            $data['assessment_id']          = $this->input->post('assessment_id', TRUE);
//            $data['nik']                    = $this->input->post('nik', TRUE);
//            $data['fullname']               = $this->input->post('fullname', TRUE);
//            $data['gender']                 = $this->input->post('gender', TRUE);
//            $data['birthplace']             = $this->input->post('birthplace', TRUE);
//            $data['birthday']               = $this->input->post('birthday', TRUE);
//            $data['religion']               = $this->input->post('religion', TRUE);
//            $data['marital_status']         = $this->input->post('marital_status', TRUE);
//            $data['address']                = $this->input->post('address', TRUE);
//            $data['id_provinsi']            = $this->input->post('id_provinsi', TRUE);
//            $data['id_kabupaten']           = $this->input->post('id_kabupaten', TRUE);
//            $data['id_kecamatan']           = $this->input->post('id_kecamatan', TRUE);
//            $data['id_kelurahan']           = $this->input->post('id_kelurahan', TRUE);
//            $data['phone']                  = $this->input->post('phone', TRUE);
//            $data['email']                  = $this->input->post('email', TRUE);
//            $data['education']              = $this->input->post('education', TRUE);
//            $data['department']             = $this->input->post('department', TRUE);
//            $data['diploma_year']           = $this->input->post('diploma_year', TRUE);
//            $data['company_id']             = $this->input->post('company_id', TRUE);
//            $data['resign']                 = $this->input->post('resign', TRUE);
//            $data['graduated']              = $this->input->post('graduated', TRUE);
//            $data['company_name']           = $this->input->post('company_name', TRUE);
//            $data['company_name']           = $this->input->post('company_name', TRUE);
//            $data['student_year']           = $this->input->post('student_year', TRUE);
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
			'company_name'                  => $this->post('company_name'),
			'avatar'                        => $path_file,
			'signature'                     => $this->post('signature'),
			'student_year'                  => $this->post('student_year')
		];
      
        var_dump($update_data);
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
