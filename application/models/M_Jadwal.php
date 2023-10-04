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
    public function getDataJadwal($id)
    {
//        $query = $this->db->get('tb_material');
//        return $query->result_array();
//
		$sql = "SELECT m.material_id, a.assessment_name, a.assessment_id,p.nama, m.material_date, m.material_time, m.material_name,
       	m.material_detail, m.material_jpl, m.assistant_jpl
		FROM tb_material m
		JOIN tb_assessment a ON a.assessment_id = m.assessment_id
		JOIN tb_pegawai p ON m.instructor_id = p.pegawai_id
		JOIN tb_score s ON m.material_id = s.material_id
		WHERE s.student_id = '$id'";
		$query = $this->db->query($sql)->result_array();
		return $query;
    }

    //by id
    public function GetByIdJadwal($id)
    {

		$sql = "SELECT m.material_id, m.material_parent_id, 
        (SELECT material_name from tb_material WHERE material_id = m.material_parent_id) as material_parent_name,
        a.assessment_name, a.assessment_id,p.nama, m.material_date, m.material_time, m.material_name,
       	m.material_detail, m.material_jpl, m.assistant_jpl
		FROM tb_material m
		JOIN tb_assessment a ON a.assessment_id = m.assessment_id
		JOIN tb_pegawai p ON m.instructor_id = p.pegawai_id
		WHERE a.assessment_id = '$id'";
        $this->db->or_like('assessment_id',  $id);
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

    public function getDiklatName($materialId){
        $sql = "SELECT a.assessment_name, a.assessment_id
        FROM tb_assessment a
        WHERE a.assessment_id = (SELECT assessment_id
        FROM tb_material m
        WHERE m.material_id = '$materialId')";
        $query = $this->db->query($sql)->result_array();
        return $query;
    }

	public function getAssessmentPeserta($assessment_id){
		$sql = "SELECT student_id FROM tb_student WHERE assessment_id ='$assessment_id'";
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
		$this->db->where('material_id', $id);
		$query = $this->db->get($this->user_tabel);

		if ($query->num_rows() > 0) {
			$this->db->trans_start();

			$this->db->query("DELETE FROM tb_material WHERE material_id = '$id'");
			$this->db->query("DELETE FROM tb_score WHERE material_id = '$id'");

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE) {
				return 0;
			} else {
				return 1;
			}
		} else {
			return 0;
		}
	}


	//updated Data
    public function updatedJadwal($id, $data)
    {
		$this->db->update($this->user_tabel, $data, ['material_id'=>$id]);
        return $this->db->affected_rows();
    }


     //updated Data
    public function updatedAssistant($id, $data)
    {
        $this->db->update($this->user_tabel, $data, ['pegawai_id' => $id]);
        return $this->db->affected_rows();
    }

    
}


