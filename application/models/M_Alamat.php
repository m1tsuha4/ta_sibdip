<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Alamat extends CI_Model
{
//	protected $provinsi_tabel = 'tb_provinsi';
//	protected $kabupaten_tabel = 'tb_kabupaten';
//	protected $kecamatan_tabel = 'tb_kecamatan';
//	protected $kelurahan_tabel = 'tb_kelurahan';

	public function listAll(){
		$sql = "SELECT p.id_provinsi,p.provinsi,kb.id_kabupaten,kb.kabupaten,kc.id_kecamatan,kc.kecamatan,kl.id_kelurahan,kl.kelurahan FROM tb_provinsi p 
		INNER JOIN tb_kabupaten kb ON p.id_provinsi = kb.id_provinsi
		INNER JOIN tb_kecamatan kc ON kb.id_kabupaten = kc.id_kabupaten
		INNER JOIN tb_kelurahan kl ON kc.id_kecamatan = kl.id_kecamatan;";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}
}
