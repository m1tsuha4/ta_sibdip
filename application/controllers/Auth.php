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

		if($datauser) {
			$id =  $datauser[0]->pegawai_id;
			$isCommitee = $this->auth->isCommitee($id);
			$isInstructor = $this->auth->isInstructor($id);
			$payload = [
				'pegawai_id' => $datauser[0]->pegawai_id,
				'nama' => $datauser[0]->nama,
				'username' => $datauser[0]->username,
				'iat' => $date->getTimestamp(), //waktu token digenerate
				'exp' => $date->getTimestamp() + (60 * 10) //token berlaku 3 menit
			];
			if ($datauser[0]->level == 'admin') {
				if ($isCommitee == 1 || $isInstructor == 1) {
					$token = JWT::encode($payload, $this->key, 'HS256');
					$this->response([
						'status' => true,
						'message' => 'Login Sukses, tetapi Hak Akses Anda Sebagai Admin akan diabaikan',
						'result' => [
							'pegawai_id' => $datauser[0]->pegawai_id,
							'nama' => $datauser[0]->nama,
							'username' => $datauser[0]->username,
						],
						'token' => $token
					], RestController::HTTP_OK);
				} else {
					$this->response([
						'status' => false,
						'message' => 'Maaf, Mohon Gunakan Aplikasi Admin',
					], RestController::HTTP_FORBIDDEN);
				}
			}else if ($datauser[0]->level != 'admin'){
				$token = JWT::encode($payload, $this->key, 'HS256');
				$this->response([
					'status' => true,
					'message' => 'login berhasil',
					'result' => [
						'pegawai_id' => $datauser[0]->pegawai_id,
						'nama' => $datauser[0]->nama,
						'username' => $datauser[0]->username,
					],
					'token' => $token
				], RestController::HTTP_OK);
			}
		}
		else {
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
