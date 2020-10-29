<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Perfiles extends Rest_Controller {

	public function __construct(){
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

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
}
