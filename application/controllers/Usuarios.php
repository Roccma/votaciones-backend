<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Usuarios extends Rest_Controller {

	public function __construct(){
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			header("HTTP/1.1 200 ");
			exit;
		}

		$this->load->database();
		$this->load->model('Usuario_model');
	}

	public function login_post() {

		$data = count( $this->post() ) == 1 ? (array) json_decode( $this->post()[0] ) : $this->post();

		$usuario = $this->Usuario_model->do_login( $data['email'], $data['clave'] );

		$response = array( "usuario" => $usuario );

		if( empty( $usuario ) )
			$response['usuario'] = null;
		
		$this->response( $response );
	}

	public function clave_put(){

		$data = count( $this->put() ) == 1 ? (array) json_decode( $this->put()[0] ) : $this->put();

		$this->response( $this->Usuario_model->change_password( $data['id'], $data['clave'] ) );

	}
}
