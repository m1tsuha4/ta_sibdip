<?php 

class M_Auth extends CI_Model
{

    private $_user = 'tb_pegawai';
	private $_student = 'tb_student';
    public function doLogin($username, $password)
    {
        $query = $this->db->get_where($this->_user, ['username' => $username, 'password' => $password]);
		$user_result = $query->result();

		$query_student = $this->db->get_where($this->_student, ['username' => $username, 'password' => $password]);
		$student_result = $query_student->result();

		if (!empty($user_result)) {
			$user_result[0]->_user = true;
			return $user_result;
		} elseif (!empty($student_result)) {
			$student_result[0]->_student = true;
			return $student_result;
		} else {
			return false;
		}
    }

	public function isCommitee($id){
		$sql = "SELECT EXISTS(SELECT pegawai_id FROM tb_committee WHERE pegawai_id = $id) AS is_committee;";
		$query = $this->db->query($sql)->result_array();
		$isCommittee = $query[0]['is_committee'];
		return $isCommittee;
	}
	public function isInstructor($id){
		$sql = "SELECT EXISTS(SELECT pegawai_id FROM tb_assessment WHERE pegawai_id = $id) AS is_instructor;";
		$query = $this->db->query($sql)->result_array();
		$isInstructor = $query[0]['is_instructor'];
		return $isInstructor;
	}
	public function isEmployee($id){
		$sql = "SELECT EXISTS(SELECT pegawai_id FROM tb_pegawai WHERE pegawai_id = $id) AS is_employee;";
		$query = $this->db->query($sql)->result_array();
		$isEmployee = $query[0]['is_employee'];
		return $isEmployee;
	}
	public function isStudent($id){
		$sql = "SELECT EXISTS(SELECT student_id FROM tb_student WHERE student_id = $id) AS is_student;";
		$query = $this->db->query($sql)->result_array();
		$isStudent = $query[0]['is_student'];
		return $isStudent;
	}
	public function confirmPassword($password){
		$this->db->get_where($this->_user,['password'=>$password]);
	}

}
