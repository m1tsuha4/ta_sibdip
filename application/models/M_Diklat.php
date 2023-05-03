<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Diklat extends CI_Model
{
    protected $user_tabel = 'tb_assessment';

    //mengurutkan id
    public function idterurut($total)
    {
        if ($total == 0) {
            return 1;
        } else {

            $count = $this->db->select_max('assessment_id')->get('tb_assessment')->row()->assessment_id;
            $count += 1;
            return $count;
        }
    }

//all users
public function getDataDiklat()
{
    $sql = $this->db->select('assessment_id, `assessment_to`, s.scheme_name, `assessment_name`, `assessment_date_start`, 
    `assessment_date_finish`, `assessment_type`, `assessment_location`, `assessment_address`, `assessment_origin`, `assessment_city`, 
    `assessment_person_in_charge`, `assessment_participant`, `assessment_total_bk`, `assessment_date`, `assessment_tgl_sk`, 
    `assessment_no_sk_penyelenggara`, `assessment_no_sk_peserta`, `assessment_no_sk_asesor`, `assessment_no_sk_evaluasi`, 
    `assessment_tgl_sk_evaluasi`, `assessment_meeting_date`, `assessment_year`, `assessment_code_keg`, `assessment_instructor`, 
    `assessment_finish`, p.nama, `assessment_delay`, `assessment_filter`, `assessment_date_added`, `assessment_date_updated`, 
    `accepted`, a.token, `photo_open`, `photo_middle`, photo_close')
    ->from('tb_assessment a')
    ->join('tb_pegawai p', 'p.pegawai_id = a.pegawai_id')
    ->join('tb_scheme s','s.scheme_id = a.scheme_id')
    ->get()
    ->result_array();
    return $sql;
}

//GetById
public function GetByIdDiklat($id)
{
    $sql = "SELECT assessment_id, `assessment_to`, s.scheme_name, `assessment_name`, `assessment_date_start`,
     `assessment_date_finish`, `assessment_type`, `assessment_location`, `assessment_address`, `assessment_origin`, 
     `assessment_city`, `assessment_person_in_charge`, `assessment_participant`, `assessment_total_bk`, `assessment_date`, 
     `assessment_tgl_sk`, `assessment_no_sk_penyelenggara`, `assessment_no_sk_peserta`, `assessment_no_sk_asesor`, 
     `assessment_no_sk_evaluasi`, `assessment_tgl_sk_evaluasi`, `assessment_meeting_date`, `assessment_year`, 
     `assessment_code_keg`, `assessment_instructor`, `assessment_finish`, p.nama, `assessment_delay`, `assessment_filter`, 
     `assessment_date_added`, `assessment_date_updated`, `accepted`, a.token, `photo_open`, `photo_middle`, `photo_close` 
    FROM tb_assessment a 
    JOIN tb_pegawai p ON p.pegawai_id = a.pegawai_id
    JOIN tb_scheme s ON s.scheme_id = a.scheme_id WHERE assessment_id = '$id'";    
    $this->db->or_like('assessment_id',  $id);
    $query = $this->db->query($sql)->result_array();
        
    return $query;
}

//insert data
public function insertDiklat($data)
{
    $this->db->insert($this->user_tabel, $data);
    return $this->db->affected_rows();
}

//updated Data
public function updateDiklat($id, $data)
{
    $this->db->update($this->user_tabel, $data, ['assessment_id' => $id]);
    return $this->db->affected_rows();
}

//deleted Data
public function deletedDiklat($id)
{
    $this->db->delete($this->user_tabel, ['assessment_id' => $id]);
    return $this->db->affected_rows();
}
    
}