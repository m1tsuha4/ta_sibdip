<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Jadwal extends CI_Model
{
    protected $user_tabel = 'tb_material';


    //id terurut
    public function idterurut($total)
    {
        if ($total == 0) {
            return 1;
        } else {
            $count = $this->db->select_max('material_id')->get('tb_material')->row()->material_id;
            $count += 1;
            return $count;
        }
    }
    
    //all data
    public function getDataJadwal()
    {
        $query = $this->db->get('tb_material');
        return $query->result_array();
        
    }

    //by id
    public function GetByIdJadwal($id)
    {

       $sql = "SELECT m.material_id,  a.assessment_name AS Diklat, m.material_parent_id, p.nama AS Nama_Pegawai, 
       m.material_date, m.material_time, m.material_detail, m.material_name, m.material_jpl, m.assistant_jpl, 
       m.instructor_honor_check, m.instructor_honor_jpl, m.eval_instructor, m.survey_token 
       FROM tb_material m 
       JOIN tb_assessment a ON a.assessment_id = m.assessment_id
       JOIN tb_pegawai p ON m.instructor_id = p.pegawai_id 
       WHERE m.material_id = '$id'";    
        $this->db->or_like('material_id',  $id);
        $query = $this->db->query($sql)->result_array();
            
        return $query;
    }

    //tambah data
    public function insertJadwal($data)
    {
        $this->db->insert($this->user_tabel, $data);
        return $this->db->affected_rows();
    }
    
    //deleted Data
    public function deletedJadwal($id)
    {
        $this->db->delete($this->user_tabel, ['material_id' => $id]);
        return $this->db->affected_rows();
    }

     
     //updated Data
    public function updatedJadwal($id, $data)
    {
        $this->db->update('tb_material', $data, ['material_id' => $id]);
        return $this->db->affected_rows();
    }


     //updated Data
    public function updatedAssistant($id, $data)
    {
        $this->db->update($this->user_tabel, $data, ['pegawai_id' => $id]);
        return $this->db->affected_rows();
    }

    
}


    