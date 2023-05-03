<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Nilai extends CI_Model
{
    protected $user_tabel = 'tb_student';

     //mengurutkan id
     public function idterurut($total)
     {
         if ($total == 0) {
             return 1;
         } else {
 
             $count = $this->db->select_max('student_id')->get($this->user_tabel)->row()->student_id;
             $count += 1;
             return $count;
         }
     }

public function getDataNilai()
{
    $query = $this->db->get('tb_student');
    return $query->result_array();
}

public function GetByIdNilai($id)
{
    $query = $this->db->get_where('tb_student', ['student_id' => $id]);;
    return $query->result_array();
}

//insert data
public function insertNilai($data)
{
    $this->db->insert($this->user_tabel, $data);
    return $this->db->affected_rows();
}

//updated Data
public function updateNilai($id, $data)
{
    $this->db->update($this->user_tabel, $data, ['student_id' => $id]);
    return $this->db->affected_rows();
}


//deleted Data
public function deletedNilai($id)
{
    $this->db->delete($this->user_tabel, ['student_id' => $id]);
    return $this->db->affected_rows();
}
    
}