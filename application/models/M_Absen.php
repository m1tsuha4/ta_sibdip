<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Absen extends CI_Model
{
	protected $user_tabel = 'tb_present';

         //mengurutkan id
         public function idterurut($total)
         {
             if ($total == 0) {
                 return 1;
             } else {
     
                 $count = $this->db->select_max('present_id')->get($this->user_tabel)->row()->present_id;
                 $count += 1;
                 return $count;
             }
         }

    public function getDataAbsen($id,$date)
    {
		$this->db->select('n.present_id, `n.assessment_id`, `n.student_id`,`n.present_date`, `n.present_status`,
		`n.present_ket`, s.fullname, s.address');
		$this->db->from('tb_present n');
		$this->db->join('tb_student s', 's.student_id = n.student_id');
		$query = $this->db->get_where('tb_present',['n.assessment_id'=> $id,'n.present_date' => $date]);
//		$this->db->where('n.present_date', $date);
//        $query = $this->db->get_where('tb_present',['assessment_id'=>$id]);
        return $query->result_array();
    }

    public function GetByIdAbsen($id,$date)
    {
//		$this->db->select('n.present_id, `n.assessment_id`, `n.student_id`,`n.present_date`, `n.present_status`,
//		`n.present_ket`, s.fullname, s.address');
//		$this->db->from('tb_present n');
//		$this->db->join('tb_student s', 's.student_id = n.student_id');
//		$this->db->where('n.assessment_id', $id);
//		$this->db->where('n.present_date', $date);
//		$query = $this->db->get('tb_present');
////		$result = $query->result_array();s
//
////        $query = $this->db->get_where($this->user_tabel, [date('present_date') => $id]);
//        return $query->result_array();
//		$this->db->select('n.present_id, `n.assessment_id`, `n.student_id`,`n.present_date`, `n.present_status`,
//		`n.present_ket`, s.fullname, s.address');
//		$this->db->from('tb_present n');
//		$this->db->join('tb_student s', 's.student_id = n.student_id');
//		$query = $this->db->get_where('tb_present',['n.assessment_id'=> $id,'n.present_date' => $date]);
////		$this->db->where('n.present_date', $date);
////        $query = $this->db->get_where('tb_present',['assessment_id'=>$id]);
//		return $query->result_array();
		$sql = "SELECT n.present_id, n.assessment_id, n.student_id,n.present_date, n.present_status,
		n.present_ket, s.fullname, s.address FROM tb_present n INNER JOIN tb_student s ON s.student_id = n.student_id 
		WHERE n.assessment_id = '$id' AND n.present_date='$date'";
//		$this->db->or_like('assessment_id',  $id);
		$query = $this->db->query($sql)->result_array();
		return $query;
    }

    //insert data
    public function insertAbsen($data)
    {
        $this->db->insert($this->user_tabel, $data);
        return $this->db->affected_rows();
    }

    //updated Data
    public function updateAbsen($id,$data)
    {
		$this->db->update($this->user_tabel,$data,['present_id'=>$id]);
		if ($this->db->affected_rows() >= 0) {
			return 1;
		} else {
			return 0;
		}
	}


    //deleted Data
    public function deletedAbsen($id)
    {
        $this->db->delete($this->user_tabel, ['present_id' => $id]);
        return $this->db->affected_rows();
    }
}
