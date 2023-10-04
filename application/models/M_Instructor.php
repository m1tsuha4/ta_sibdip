<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Instructor extends CI_Model
{
    protected $user_tabel = 'tb_training_instructor';

    //mengurutkan id
        public function idterurut($total)
        {
            if ($total == 0) {
                return 1;
            } else {
    
                $count = $this->db->select_max('pegawai_id')->get('tb_pegawai')->row()->pegawai_id;
                $count += 1;
                return $count;
            }
        }

    //all users
    public function getDataInstructor()
    {
		$sql = "SELECT p.nip, p.nama FROM tb_training_instructor t
				INNER JOIN tb_pegawai p ON p.pegawai_id = t.instructor_id";
		$query = $this->db->query($sql)->result_array();
		return $query;
    }



    //GetById
    public function GetByIdInstructor($id)
    {
		$sql = "SELECT p.nip, p.nama FROM tb_training_instructor t
				INNER JOIN tb_pegawai p ON p.pegawai_id = t.instructor_id WHERE t.assessment_id = '$id'";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    //insert data
    public function insertInstructor($data)
    {
        $this->db->insert($this->user_tabel, $data);
        return $this->db->affected_rows();
    }

    //updated Data
    public function updatedInstructor($id, $data)
    {
        $this->db->update($this->user_tabel, $data, ['pegawai_id' => $id]);
        return $this->db->affected_rows();
    }

    //deleted Data
    public function deletedInstructor($id)
    {
        $this->db->delete($this->user_tabel, ['training_instructor_id' => $id]);
        return $this->db->affected_rows();
    }

    
   

}
