<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Alamat extends CI_Model
{

	public function listAll(){
		$sql = "SELECT p.id_provinsi,p.provinsi,kb.id_kabupaten,kb.kabupaten,kc.id_kecamatan,kc.kecamatan,kl.id_kelurahan,kl.kelurahan FROM tb_provinsi p 
		INNER JOIN tb_kabupaten kb ON p.id_provinsi = kb.id_provinsi
		INNER JOIN tb_kecamatan kc ON kb.id_kabupaten = kc.id_kabupaten
		INNER JOIN tb_kelurahan kl ON kc.id_kecamatan = kl.id_kecamatan;";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	public function listProvinsi()
	{
		$sql = "SELECT id_provinsi,provinsi FROM tb_provinsi";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	public function listKabupaten($id)
	{
		$sql = "SELECT id_provinsi,id_kabupaten,kabupaten FROM `tb_kabupaten` WHERE id_provinsi='$id'";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	public function listKecamatan($id)
	{
		$sql = "SELECT id_kabupaten,id_kecamatan,kecamatan FROM `tb_kecamatan` WHERE id_kabupaten='$id'";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
	public function listKelurahan($id)
	{
		$sql = "SELECT id_kecamatan,id_kelurahan,kelurahan FROM `tb_kelurahan` WHERE id_kecamatan='$id'";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
}
