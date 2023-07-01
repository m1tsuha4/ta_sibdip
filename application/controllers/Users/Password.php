<?php

use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Password extends RestController
{
	private $key;

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_users');
		$this->key = '1234567890';
	}

	public function index_post($id)
	{
		$currentPassword = $this->input->post('current_password');
		$newPassword = $this->input->post('new_password');
		$confirmPassword = $this->input->post('confirm_password');
		$encrypt_current = hash('sha512', $currentPassword.$this->key);

		// Validasi password baru dan konfirmasi password
		if ($newPassword !== $confirmPassword) {
			$this->response([
				'status' => false,
				'message' => 'New password and confirm password do not match.'
			], RestController::HTTP_BAD_REQUEST);
		}

		$encrypt_new = hash('sha512', $newPassword.$this->key);
		$success = $this->m_users->changePassword($id, $encrypt_current, $encrypt_new);

		if ($success > 0) {
			$this->response([
				'status'               	=> 200,
				'error' => null,
				'message' => 'Password changed successfully.'
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'The password you entered is incorrect.'
			], RestController::HTTP_BAD_REQUEST);
		}
	}
}
