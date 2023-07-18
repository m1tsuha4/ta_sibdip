<?php 

class M_Auth extends CI_Model
{

    private $_user = 'tb_pegawai';

    public function doLogin($username, $password)
    {
        $query = $this->db->get_where($this->_user, 
        ['username' => $username, 'password' => $password]);

        if ($query->num_rows() == 1) {
            # code...
            return $query->result();
        }
        else 
        {
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
	public function confirmPassword($password){
		$this->db->get_where($this->_user,['password'=>$password]);
	}

}
