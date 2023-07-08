<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Nilai extends CI_Model
{
    protected $user_tabel = 'tb_student';
	protected $score_tabel = 'tb_score';

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

public function getDataNilai($id)
{
	$sql = "SELECT n.score_id, n.assessment_id, n.material_id, n.student_id, s.fullname, s.address, n.pretest, n.posttest 
	FROM tb_score n INNER JOIN tb_student s ON n.student_id = s.student_id WHERE n.material_id = '$id'";
	return $this->db->query($sql)->result_array();
}

public function GetByIdNilai($id)
{
	$sql = "SELECT n.score_id, n.assessment_id, n.material_id, n.student_id, s.fullname, s.address, n.pretest, n.posttest 
	FROM tb_score n INNER JOIN tb_student s ON n.student_id = s.student_id WHERE n.material_id = '$id'";
    return $this->db->query($sql)->result_array();
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
    $this->db->update($this->score_tabel, $data, ['score_id' => $id]);
	if ($this->db->affected_rows() >= 0) {
		return 1;
	} else {
		return 0;
	}
}


//deleted Data
public function deletedNilai($id)
{
    $this->db->delete($this->user_tabel, ['student_id' => $id]);
    return $this->db->affected_rows();
}
    
}
