<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Users extends CI_Model
{
    protected $user_tabel = 'tb_pegawai';
	protected $student_tabel = 'tb_student';
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
    public function getDataUsers()
    {
        $sql = $this->db->select('p.pegawai_id, p.uid, p.sort_id, d.division, p.superior_id, p.sort_number, 
        p.nik, p.nip, p.gelar_depan, p.nama, p.gelar_belakang, p.jenis_kelamin, p.tempat_lahir, p.tanggal_lahir, 
        p.alamat, pr.provinsi, kb.kabupaten, kc.kecamatan, kl.kelurahan, p.telepon, p.email, p.agama, p.status_perkawinan, 
        p.golongan_darah, p.pendidikan, p.jurusan, p.tahun_tamat, p.status, p.jabatan, p.jabatan_ext, p.pangkat, 
        p.golongan, p.profil_singkat, p.latar_pendidikan, p.no_bpjs, p.faskes_kesehatan, p.alamat_faskes_kesehatan, 
        p.faskes_gigi, p.alamat_faskes_gigi, p.no_npwp, p.no_efin, p.pejabat, p.penanggungjawab, p.username, p.password, 
        p.level, p.role, p.avatar, p.avatar_slug, p.ava, p.signature, p.blocked, p.activated, p.att, p.org_publish, p.token, 
        p.status_token, p.date_token, p.end_token, p.date_added_employee, p.date_updated_employee')
        ->from('tb_pegawai p')
        ->join('tb_division d', 'd.division_id = p.division_id', 'inner')
        ->join('tb_provinsi pr','p.id_provinsi = pr.id_provinsi', 'inner')
        ->join('tb_kabupaten kb', 'p.id_kabupaten = kb.id_kabupaten', 'inner')
        ->join('tb_kecamatan kc', 'p.id_kecamatan = kc.id_kecamatan', 'inner')
        ->join('tb_kelurahan kl', 'p.id_kelurahan = kl.id_kelurahan', 'inner')
        ->get()
        ->result_array();
        return $sql;
    }

    //GetById
    public function GetByIdUsers($id)
    {
        $sql = "SELECT p.pegawai_id, p.uid, p.sort_id, d.division, p.superior_id, p.sort_number, 
        p.nik, p.nip, p.gelar_depan, p.nama, p.gelar_belakang, p.jenis_kelamin, p.tempat_lahir, p.tanggal_lahir, 
        p.alamat, pr.provinsi, kb.kabupaten, kc.kecamatan, kl.kelurahan, p.telepon, p.email, p.agama, p.status_perkawinan, 
        p.golongan_darah, p.pendidikan, p.jurusan, p.tahun_tamat, p.status, p.jabatan, p.jabatan_ext, p.pangkat, 
        p.golongan, p.profil_singkat, p.latar_pendidikan, p.no_bpjs, p.faskes_kesehatan, p.alamat_faskes_kesehatan, 
        p.faskes_gigi, p.alamat_faskes_gigi, p.no_npwp, p.no_efin, p.pejabat, p.penanggungjawab, p.username, p.password, 
        p.level, p.role, p.avatar, p.avatar_slug, p.ava, p.signature, p.blocked, p.activated, p.att, p.org_publish, p.token, 
        p.status_token, p.date_token, p.end_token, p.date_added_employee, p.date_updated_employee
        FROM tb_pegawai p 
        INNER JOIN tb_division d ON d.division_id = p.division_id
        INNER JOIN tb_provinsi pr ON p.id_provinsi = pr.id_provinsi
        INNER JOIN tb_kabupaten kb ON p.id_kabupaten = kb.id_kabupaten
        INNER JOIN tb_kecamatan kc ON p.id_kecamatan = kc.id_kecamatan
        INNER JOIN tb_kelurahan kl ON p.id_kelurahan = kl.id_kelurahan WHERE p.pegawai_id = '$id'";    
        $this->db->or_like('pegawai_id',  $id);
        $query = $this->db->query($sql)->result_array();
            
        return $query;
    }

    //insert data
    public function insertUsers($data)
    {
        $this->db->insert($this->user_tabel, $data);
        return $this->db->affected_rows();
    }

	public function checkPassword($id,$password){
		$user = $this->db->get_where($this->user_tabel,['pegawai_id' => $id])->row();
		if($user){
			if($password === $user->password){
				return true;
			}
		}
		return false;
	}
    //updated Data
    public function updatedUsers($id, $data)
    {
        $this->db->update($this->user_tabel, $data, ['pegawai_id' => $id]);
        return $this->db->affected_rows();
    }
	public function changePassword($id, $encrypt_current, $encrypt_new) {
		$this->db->where('pegawai_id', $id);
		$this->db->where('password', $encrypt_current);
		$this->db->update($this->user_tabel, ['password' => $encrypt_new]);

		// Check if update was successful
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function changePasswordStudent($id, $encrypt_current, $encrypt_new) {
		$this->db->where('student_id', $id);
		$this->db->where('password', $encrypt_current);
		$this->db->update($this->student_tabel, ['password' => $encrypt_new]);

		// Check if update was successful
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function countUsername($username,$table){
		$query = $this->db->query("SELECT COUNT(*) AS username_count FROM $table WHERE username = '$username'");
		$result = $query->row();
		$usernameCount = $result->username_count;
		return $usernameCount;
	}
	public function countEmail($email,$table){
		$query = $this->db->query("SELECT COUNT(*) AS email_count FROM $table WHERE email = '$email'");
		$result = $query->row();
		$emailCount = $result->email_count;
		return $emailCount;
	}
	public function changeProfile($id,$encrypt_current,$username,$email){
		$this->db->where('pegawai_id', $id);
		$this->db->where('password', $encrypt_current);
		$this->db->update($this->user_tabel, ['username' => $username,'email'=> $email]);

		// Check if update was successful
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function changeProfileStudent($id,$encrypt_current,$username,$email){
		$this->db->where('student_id', $id);
		$this->db->where('password', $encrypt_current);
		$this->db->update($this->student_tabel, ['username' => $username,'email'=> $email]);

		// Check if update was successful
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function isCommitee($pegawaiId,$id){
		$sql = "SELECT EXISTS(SELECT pegawai_id FROM tb_committee WHERE pegawai_id = $pegawaiId AND assessment_id = $id) AS is_committee;";
		$query = $this->db->query($sql)->result_array();
		$isCommittee = $query[0]['is_committee'];
		return $isCommittee;
	}
	public function isInstructor($pegawaiId,$id){
		$sql = "SELECT EXISTS(SELECT pegawai_id FROM tb_assessment WHERE pegawai_id = $pegawaiId AND assessment_id = $id) AS is_instructor;";
		$query = $this->db->query($sql)->result_array();
		$isInstructor = $query[0]['is_instructor'];
		return $isInstructor;
	}
	public function isAdmin($pegawaiId){
		$sql = "SELECT EXISTS(
			SELECT pegawai_id FROM tb_pegawai 
			WHERE pegawai_id = $pegawaiId AND (level = 'admin' OR level = 'adminpd')
		) AS is_admin;
		";
		$query = $this->db->query($sql)->result_array();
		$isAdmin = $query[0]['is_admin'];
		return $isAdmin;
	}

    //deleted Data
    public function deletedUsers($id)
    {
        $this->db->delete($this->user_tabel, ['pegawai_id' => $id]);
        return $this->db->affected_rows();
    }

    
   

}
