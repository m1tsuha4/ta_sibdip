<?php


// require_once APPPATH . 'controllers/Auth.php'; //tambah ini untuk logi

//Auth //ganti extends menjadi auth login

//$this->cektoken(); //tambah ini untuk login

use chriskacerguis\RestServer\RestController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends RestController
{
    private $key;

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth', 'auth');
        $this->key = '1234567890';
    }

    public function index_post()
    {
        $date = new DateTime();
        $username = $this->post('username');
        $password = $this->post('password');
        $encrypt_pass = hash('sha512', $password.$this->key);
        $datauser = $this->auth->doLogin($username,  $encrypt_pass);

		if(isset($datauser[0]->_student)){
			$id = $datauser[0]->student_id;
			//$isEmployee = $this->auth->isEmployee($id);
			//$isStudent = $this->auth->isStudent($id);
			$payload= [
				'id' => $datauser[0]->student_id,
				'nama' => $datauser[0]->fullname,
				'username' => $datauser[0]->username,
				'is_employee' => false,//$isEmployee
				'is_student' => true,//$isStudent
				'is_admin' => false,
				'iat' => $date->getTimestamp(), //waktu token digenerate
				'exp' => $date->getTimestamp() + (60 * 10) //token berlaku 3 menit
			];
			$token = JWT::encode($payload, $this->key, 'HS256');
			$this->response([
				'status' => true,
				'message' => 'Login Sukses',
				'result' => [
					'id' => $datauser[0]->student_id,
					'nama' => $datauser[0]->fullname,
					'username' => $datauser[0]->username,
					'is_employee' => false,
					'is_student' => true,
					'is_admin' => false
				],
				'token' => $token
			], RestController::HTTP_OK);
		}
		elseif(isset($datauser[0]->_user)) {
			$id =  $datauser[0]->pegawai_id;
			$isCommitee = $this->auth->isCommitee($id);
			$isInstructor = $this->auth->isInstructor($id);
			//$isEmployee = $this->auth->isEmployee($id);
			//$isStudent = $this->auth->isStudent($id);
			$payload = [
				'id' => $datauser[0]->pegawai_id,
				'nama' => $datauser[0]->nama,
				'username' => $datauser[0]->username,
				'iat' => $date->getTimestamp(), //waktu token digenerate
				'exp' => $date->getTimestamp() + (60 * 10) //token berlaku 3 menit
			];

			if ($datauser[0]->level == 'admin' || $datauser[0]->level == 'adminpd') {
					$token = JWT::encode($payload, $this->key, 'HS256');
					$this->response([
						'status' => true,
						'message' => 'Login Sukses',
						'result' => [
							'id' => $datauser[0]->pegawai_id,
							'nama' => $datauser[0]->nama,
							'username' => $datauser[0]->username,
							'is_employee' => false,
							'is_student' => false,
							'is_admin'=> true,
						],
						'token' => $token
					], RestController::HTTP_OK);

			}else if ($datauser[0]->level != 'admin' || $datauser[0]->level == 'adminpd'){
				if ($isCommitee == 1 || $isInstructor == 1) {
					$token = JWT::encode($payload, $this->key, 'HS256');
					$this->response([
						'status' => true,
						'message' => 'login berhasil',
						'result' => [
							'id' => $datauser[0]->pegawai_id,
							'nama' => $datauser[0]->nama,
							'username' => $datauser[0]->username,
							'is_employee' => true,
							'is_student' => false,
							'is_admin'=> false,
						],
						'token' => $token
					], RestController::HTTP_OK);
				}
				}
		} else {
				$this->response([
					'status' => false,
					'message' => 'username dan password Salah',
				], RestController::HTTP_FORBIDDEN);
		}
    }

    protected function cektoken()
    {
        $jwt = $this->input->get_request_header('Authorization');
        try {
            //code...
            JWT::decode($jwt, new Key($this->key, 'HS256'));
        } catch (Exception $e) {
            //throw $e;
            $this->response([
                'status' => false,
                'message' => 'invalid Token!',
            ], RestController::HTTP_UNAUTHORIZED);
        }

    }
}
