<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Peserta extends CI_Model
{
    protected $user_tabel = 'tb_student';
    

     //mengurutkan id
     public function idterurut($total)
     {
         if ($total == 0) {
             return 1;
         } else {
 
             $count = $this->db->select_max('student_id')->get('tb_student')->row()->student_id;
             $count += 1;
             return $count;
         }
     }

//     all users
	public function getDataPeserta()
	{
		$sql = $this->db->select('s.student_id, a.assessment_name, s.nik, s.fullname, s.gender, s.birthplace, s.birthday, s.religion,
		s.marital_status, s.address, pr.provinsi, kb.kabupaten, kc.kecamatan, kl.kelurahan, s.phone, s.email,
		s.education, s.department, s.diploma_year, c.company_name, s.avatar, s.signature, s.student_year')
		->from('tb_student s')
		->join('tb_assessment a', 's.assessment_id = a.assessment_id', 'inner')
		->join('tb_provinsi pr', 's.id_provinsi = pr.id_provinsi', 'inner')
		->join('tb_kabupaten kb', 's.id_kabupaten = kb.id_kabupaten', 'inner')
		->join('tb_kecamatan kc', 's.id_kecamatan = kc.id_kecamatan', 'inner')
		->join('tb_kelurahan kl', 's.id_kelurahan = kl.id_kelurahan', 'inner')
		->join('tb_company c', 's.company_id = c.company_id', 'inner')
		->get()
		->result_array();
		return $sql;

	}

    //GetById
    public function GetByIdPeserta($id)
    {
        $sql = "SELECT s.student_id, a.assessment_name, s.nik, s.fullname, s.gender, s.birthplace, 
        s.birthday, s.religion, s.marital_status, s.address, pr.provinsi, kb.kabupaten, kc.kecamatan, 
        kl.kelurahan, s.phone, s.email, s.education, s.department, s.diploma_year, c.company_name, s.avatar, 
        s.signature, s.student_year 
        FROM tb_student s 
        INNER JOIN tb_assessment a ON a.assessment_id = s.assessment_id 
        INNER JOIN tb_provinsi pr ON pr.id_provinsi = s.id_provinsi 
        INNER JOIN tb_kabupaten kb ON kb.id_kabupaten = s.id_kabupaten 
        INNER JOIN tb_kecamatan kc ON kc.id_kecamatan = s.id_kecamatan 
        INNER JOIN tb_kelurahan kl ON kl.id_kelurahan = s.id_kelurahan
        INNER JOIN tb_company c ON c.company_id = s.company_id WHERE s.student_id = $id";
        $this->db->or_like('student_id',  $id);
        $query = $this->db->query($sql)->result_array();
            
        return $query;
    }

    //insert data
    public function insertPeserta($data)
    {
        $this->db->insert($this->user_tabel, $data);
        return $this->db->affected_rows();
    }

     //updated Data
     public function updatedPeserta($id, $data)
     {
         $this->db->update($this->user_tabel, $data, ['student_id' => $id]);
         return $this->db->affected_rows();
     }

     //deleted Data
     public function deletedPeserta($id)
     {
         $this->db->delete($this->user_tabel, ['student_id' => $id]);
         return $this->db->affected_rows();
     }
}
