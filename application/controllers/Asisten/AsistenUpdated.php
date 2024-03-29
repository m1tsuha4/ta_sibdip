<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class AsistenUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_asistent');
    }

//Mengupdate Data
public function AssistantUpdated_post($id)
{

    $asisten = new m_asistent;

    $data_asisten = $this->m_asistent->GetByIdAssistant($id);

	@unlink($data_asisten[0]['avatar']);
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
            @unlink($data_asisten[0]['avatar']);
             //mendapatkan file yang berhasil diupload
             $uploadData = $this->upload->data();
             $path_file = './'. $path . $uploadData['file_name'];
             $data['avatar'] = $path_file;
         }
     }

		$data['avatar']					= $path_file;
        $data['nik']                    = $this->input->post('nik', TRUE);
        $data['nip']                    = $this->input->post('nip', TRUE);
        $data['gelar_depan']            = $this->input->post('gelar_depan', TRUE);
        $data['nama']                   = $this->input->post('nama', TRUE);
        $data['gelar_belakang']         = $this->input->post('gelar_belakang', TRUE);
        $data['tempat_lahir']           = $this->input->post('tempat_lahir', TRUE);
        $data['tanggal_lahir']          = $this->input->post('tanggal_lahir', TRUE);
        $data['alamat']                 = $this->input->post('alamat', TRUE);
        $data['id_provinsi']            = $this->input->post('id_provinsi', TRUE);
        $data['id_kabupaten']           = $this->input->post('id_kabupaten', TRUE);
        $data['id_kecamatan']           = $this->input->post('id_kecamatan', TRUE);
        $data['id_kelurahan']           = $this->input->post('id_kelurahan', TRUE);
        $data['telepon']                = $this->input->post('telepon', TRUE);
        $data['pendidikan']             = $this->input->post('pendidikan', TRUE);
        $data['jabatan']                = $this->input->post('jabatan', TRUE);
        $data['pangkat']                = $this->input->post('pangkat', TRUE);
        $data['golongan']               = $this->input->post('golongan', TRUE);
        $data['office']                 = $this->input->post('office', TRUE);
        $data['office_phone']           = $this->input->post('office_phone', TRUE);
        $data['training']               = $this->input->post('training', TRUE);
        $data['work_exp']               = $this->input->post('work_exp', TRUE);
        $data['teach_exp']              = $this->input->post('teach_exp', TRUE);
        $data['scientific_work']        = $this->input->post('scientific_work', TRUE);
        $data['special_sub']            = $this->input->post('special_sub', TRUE);
        $data['npwp']                   = $this->input->post('npwp', TRUE);
        $data['no_npwp']                = $this->input->post('no_npwp', TRUE);
	$data['jenis_kelamin']          = $this->input->post('jenis_kelamin', TRUE);
        $data['date_updated_employee']  = date('Y-m-d H:i:s', time());     
  
    
    $result_update = $asisten->updatedAssistant($id, $data);

    if ($result_update > 0) {
        $this->response([
            'status'                => 200,
            'error' => null,
            'message' => 'Asisstant ' .$data['nama'] . ' telah Berhasil di Updated'
        ], RestController::HTTP_OK);
    } else {
        $this->response([
            'status' => false,
            'message' => 'Failed To Updated Assistant'
        ], RestController::HTTP_BAD_REQUEST);
    }
}


}

/* ini kalau ingin makai form validation di metode input->post */
    //$this->form_validation->set_data($this->input->post());