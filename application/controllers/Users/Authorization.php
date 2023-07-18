<?php

use chriskacerguis\RestServer\RestController;

class Authorization extends RestController
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth', 'auth');
	}

	public function index_get($id)
	{
		$isCommitee = $this->auth->isCommitee($id);
		$isInstructor = $this->auth->isInstructor($id);
		$this->response([
			'status' => true,
			'message' => 'Data Berhasil di Dapatkan',
			'result' => [
				'id_pegawai' => $id,
				'is_committee' => $isCommitee,
				'is_instructor' => $isInstructor,
			],
		]);

	}
}
