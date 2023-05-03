<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class InstructorUpdated extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('m_instructor');
    }

//Mengupdate Data
public function InstructorUpdated_put($id)
{

    $instructor = new m_instructor;

    $data_instructor = $this->m_instructor->GetByIdInstructor($id);

     //Upload Gambar
     $file = $_FILES['avatar'];
        
     $path = "uploads/instructor/"; //direktori

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
            @unlink($data_instructor[0]['avatar']);
             //mendapatkan file yang berhasil diupload
             $uploadData = $this->upload->data();
             $path_file = './'. $path . $uploadData['file_name'];
             $data['avatar'] = $path_file;
         }
     }
    
        $data['uid']                    = $this->input->post('uid', TRUE);
        $data['sort_id']                = $this->input->post('sort_id', TRUE);
        $data['superior_id']            = $this->input->post('superior_id', TRUE);
        $data['assistant']              = $this->input->post('assistant', TRUE);
        $data['nik']                    = $this->input->post('nik', TRUE);
        $data['nip']                    = $this->input->post('nip', TRUE);
        $data['gelar_depan']            = $this->input->post('gelar_depan', TRUE);
        $data['nama']                   = $this->input->post('nama', TRUE);
        $data['gelar_belakang']         = $this->input->post('gelar_belakang', TRUE);
        $data['jenis_kelamin']          = $this->input->post('jenis_kelamin', TRUE);
        $data['tempat_lahir']           = $this->input->post('tempat_lahir', TRUE);
        $data['tanggal_lahir']          = $this->input->post('tanggal_lahir', TRUE);
        $data['alamat']                 = $this->input->post('alamat', TRUE);
        $data['id_provinsi']            = $this->input->post('id_provinsi', TRUE);
        $data['id_kabupaten']           = $this->input->post('id_kabupaten', TRUE);
        $data['id_kecamatan']           = $this->input->post('id_kecamatan', TRUE);
        $data['id_kelurahan']           = $this->input->post('id_kelurahan', TRUE);
        $data['telepon']                = $this->input->post('telepon', TRUE);
        $data['email']                  = $this->input->post('email', TRUE);
        $data['agama']                  = $this->input->post('agama', TRUE);
        $data['status_perkawinan']      = $this->input->post('status_perkawinan', TRUE);
        $data['pendidikan']             = $this->input->post('pendidikan', TRUE);
        $data['jurusan']                = $this->input->post('jurusan', TRUE);
        $data['tahun_tamat']            = $this->input->post('tahun_tamat', TRUE);
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
        // $data['no_efin']             = $this->input->post('no_efin', TRUE);
        $data['type_status']            = $this->input->post('type_status', TRUE);
        $data['username']               = $this->input->post('username', TRUE);
        $data['password']               = $this->input->post('password', TRUE);
        $data['level']                  = $this->input->post('level', TRUE);
        $data['role']                   = $this->input->post('role', TRUE); 
        $data['avatar_slug']            = $this->input->post('avatar_slug', TRUE);
        $data['ava']                    = $this->input->post('ava', TRUE);
        $data['signature']              = $this->input->post('signature', TRUE);
        $data['blocked']                = $this->input->post('blocked', TRUE);
        $data['activated']              = $this->input->post('activated', TRUE);
        // $data['att']                 = $this->input->post('att', TRUE);
        // $data['org_publish']         = $this->input->post('org_publish', TRUE);
        $data['token']                  = $this->input->post('token', TRUE);
        $data['status_token']           = $this->input->post('status_token', TRUE);
        $data['date_token']             = $this->input->post('date_token', TRUE);
        $data['end_token']              = $this->input->post('end_token', TRUE);
        $data['date_updated_employee']  = date('Y-m-d H:i:s', time());     
  
    
    $result_update = $instructor->updatedInstructor($id, $data);

    if ($result_update > 0) {
        $this->response([
            'status'                => 200,
            'error' => null,
            'message' => 'Id ' . $id . ' telah Berhasil di Updated'
        ], RestController::HTTP_OK);
    } else {
        $this->response([
            'status' => false,
            'message' => 'Failed To Updated instructor'
        ], RestController::HTTP_BAD_REQUEST);
    }
}


}

/* ini kalau ingin makai form validation di metode input->post */
    //$this->form_validation->set_data($this->input->post());