<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Usuarios extends Rest_Controller {

	public function __construct(){
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		$this->load->database();
		$this->load->model('Usuario_model');
	}

	public function login_post() {

		$data = $this->post();

		$usuario = $this->Usuario_model->do_login( $data['email'], $data['clave'] );

		$response = array( "usuario" => $usuario );

		if( empty( $usuario ) ){
			$response['usuario'] = null;
			$this->response( $response, Rest_Controller::HTTP_NOT_FOUND );
		}
		else{
			$this->response( $response );
		}
	}
}
