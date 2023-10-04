<?php

use chriskacerguis\RestServer\RestController;

class Profile extends RestController
{
	private $key;

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_users');
		$this->load->model('m_auth', 'auth');
		$this->key = '1234567890';
	}

	public function index_post($id)
	{
		$table_pegawai = 'tb_pegawai';
		$table_student = 'tb_student';

		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$confirmPassword = $this->input->post('confirm_password');
		$encrypt_current = hash('sha512', $confirmPassword.$this->key);

		$usernameCount = $this->m_users->countusername($username,$table_pegawai);
		$usernameCountStudent = $this->m_users->countusername($username,$table_student);
		$emailCount = $this->m_users->countEmail($email,$table_pegawai);
		$emailCountStudent = $this->m_users->countEmail($email,$table_student);


		if ($usernameCount > 0 || $usernameCountStudent > 0) {
			$this->response([
				'status' => false,
				'message' => 'Username sudah ada',
			], RestController::HTTP_NOT_ACCEPTABLE);

		} elseif ($emailCount > 0 || $emailCountStudent > 0){
			$this->response([
				'status' => false,
				'message' => 'Email sudah ada',
			], RestController::HTTP_NOT_ACCEPTABLE);
		}
		else {
			$success = $this->m_users->changeProfile($id,$encrypt_current, $username, $email);
			if ($success > 0) {
				$this->response([
					'status' => 200,
					'error' => null,
					'message' => 'Profile changed successfully.'
				], RestController::HTTP_OK);
			} else {
				$this->response([
					'status' => false,
					'message' => 'The password you entered is incorrect.'
				], RestController::HTTP_BAD_REQUEST);
			}
		}
	}
}
