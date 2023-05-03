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

     //all users
     public function getDataPeserta()
    {
        $sql = $this->db->select('student_id, a.assessment_name, nik, fullname, gender, birthplace, birthday, religion, 
        marital_status, address, pr.provinsi, kb.kabupaten, kc.kecamatan, kl.kelurahan, phone, email, 
        education, department, diploma_year, c.company_name, avatar, signature, student_year')
        ->from('tb_student s')
        ->join('tb_assessment a', 'a.assessment_id = s.assessment_id', 'inner')
        ->join('tb_provinsi pr','pr.id_provinsi = s.id_provinsi')
        ->join('tb_kabupaten kb', 'kb.id_kabupaten = s.id_kabupaten')
        ->join('tb_kecamatan kc', 'kc.id_kecamatan = s.id_kecamatan')
        ->join('tb_kelurahan kl', 'kl.id_kelurahan = s.id_kelurahan')
        ->join('tb_company c', 'c.company_id = s.company_id')
        ->get()
        ->result_array();
        return $sql;
    }

    //GetById
    public function GetByIdPeserta($id)
    {
        $sql = "SELECT student_id, a.assessment_name, `nik`, `fullname`, `gender`, `birthplace`, 
        `birthday`, `religion`, `marital_status`, `address`, pr.provinsi, kb.kabupaten, kc.kecamatan, 
        kl.kelurahan, `phone`, `email`, `education`, `department`, `diploma_year`, c.company_name, `avatar`, 
        `signature`, `student_year` 
        FROM tb_student s 
        INNER JOIN tb_assessment a ON a.assessment_id = s.assessment_id 
        JOIN tb_provinsi pr ON pr.id_provinsi = s.id_provinsi 
        JOIN tb_kabupaten kb ON kb.id_kabupaten = s.id_kabupaten 
        JOIN tb_kecamatan kc ON kc.id_kecamatan = s.id_kecamatan 
        JOIN tb_kelurahan kl ON kl.id_kelurahan = s.id_kelurahan
        JOIN tb_company c ON c.company_id = s.company_id; WHERE student_id = '$id'";    
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