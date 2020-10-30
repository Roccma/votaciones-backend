<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Entidades extends Rest_Controller {

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
		$this->load->model('Entidad_model');
	}

	public function entidad_get() {

		$documento = $this->uri->segment(3);

		$entidad = $this->Entidad_model->get_entidad( $documento );

		$response = array( "entidad" => $entidad );

		if( empty( $entidad ) )
			$response['entidad'] = null;

		$this->response( $response );
	}

	public function ranking_get() {
		$ranking = $this->Entidad_model->get_ranking();
		$postulantes = array();
		foreach ($ranking->result() as $postulante) {
			$postulantes[] = $postulante;
		}

		$this->response( array( "postulantes" => $postulantes ) );
	}

}
