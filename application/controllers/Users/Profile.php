<?php

use chriskacerguis\RestServer\RestController;

class Profile extends RestController
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
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$confirmPassword = $this->input->post('confirm_password');
		$encrypt_current = hash('sha512', $confirmPassword.$this->key);
		$usernameCount = $this->m_users->countusername($username);
		$emailCount = $this->m_users->countEmail($email);
		var_dump($emailCount);
		var_dump($usernameCount);
		if ($usernameCount > 0) {
			$this->response([
				'status' => false,
				'message' => 'Username sudah ada',
			], RestController::HTTP_NOT_ACCEPTABLE);

		} elseif ($emailCount > 0){
			$this->response([
				'status' => false,
				'message' => 'Email sudah ada',
			], RestController::HTTP_NOT_ACCEPTABLE);
		}
		else {
			$success = $this->m_users->changeProfile($id,$encrypt_current, $username, $email);
			var_dump($success);
			if ($success > 0) {
				$this->response([
					'status'               	=> 200,
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
