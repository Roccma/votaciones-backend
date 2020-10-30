<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Perfiles extends Rest_Controller {

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
		$this->load->model('Perfil_model');
	}

	public function postulantes_get()
	{
		$postulantes = $this->Perfil_model->get_postulantes();

		$response = array();

		foreach ($postulantes->result('array') as $postulante) {
			unset($postulante['id_perfil']);
			$response[] = $postulante;
		}

		$this->response( array( "postulantes" => $response ) );
	}

	public function nuevo_post(){

		$data = count( $this->post() ) == 1 ? (array) json_decode( $this->post()[0] ) : $this->post();

		$this->Perfil_model->set_data( $data );

		$this->response( $this->Perfil_model->insert() );
	}
}
