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

    public function getDataAbsen($id)
    {
//		$this->db->select('n.present_id, `n.assessment_id`, `n.student_id`,`n.present_date`, `n.present_status`,
//		`n.present_ket`, s.fullname, s.address');
//		$this->db->from('tb_present n');
//		$this->db->join('tb_student s', 's.student_id = n.student_id');
//		$query = $this->db->get_where('tb_present',['n.assessment_id'=> $id,'n.present_date' => $date]);
////		$this->db->where('n.present_date', $date);
////        $query = $this->db->get_where('tb_present',['assessment_id'=>$id]);
//        return $query->result_array();
		$sql = "SELECT n.present_id, n.assessment_id, a.assessment_name, n.student_id,n.present_date, n.present_status,
		n.present_ket, n.present_date_updated, s.fullname, s.address FROM tb_present n 
		INNER JOIN tb_student s ON s.student_id = n.student_id 
		INNER JOIN tb_assessment a ON n.assessment_id = a.assessment_id 
		WHERE n.student_id = '$id'";
		$query = $this->db->query($sql)->result_array();
		return $query;
    }

    public function GetByIdAbsen($id,$date)
    {
		$sql = "SELECT n.present_id, n.assessment_id, a.assessment_name, n.student_id,n.present_date, n.present_status,
		n.present_ket, n.present_date_updated, s.fullname, s.address FROM tb_present n 
		INNER JOIN tb_student s ON s.student_id = n.student_id 
		INNER JOIN tb_assessment a ON n.assessment_id = a.assessment_id 
		WHERE n.assessment_id = '$id' AND n.present_date='$date'";
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

    public function getAbsenReport($assessmentId){
        $sql = "SELECT 
        tb_student.student_id, 
        tb_student.fullname, 
        (
            SELECT IF(tb_present.present_date_updated = '0000-00-00 00:00:00' or tb_present.present_date_updated is null, ' ', tb_present.present_status)
        ) as status_kehadiran 
        FROM tb_present 
        JOIN tb_student ON tb_present.student_id = tb_student.student_id 
        WHERE tb_present.assessment_id = '$assessmentId'";
        $result = $this->db->query($sql)->result_array();

        $mapByName = [];

        foreach($result as $element){
            $mapByName[$element['fullname']][] = $element['status_kehadiran'];
        };  

     
        $keys = array_keys($mapByName, true);

        $returnVal = [];
        foreach($keys as $nama){
            $returnVal[] = ["fullname" => $nama, "list_absen" => $mapByName[$nama]];
        }
    
        return $returnVal;
    }

    //deleted Data
    public function deletedAbsen($id)
    {
        $this->db->delete($this->user_tabel, ['present_id' => $id]);
        return $this->db->affected_rows();
    }
}
