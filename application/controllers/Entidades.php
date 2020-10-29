<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Entidades extends Rest_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->model('Entidad_model');
	}

	public function entidad_get() {

		$documento = $this->uri->segment(3);

		$entidad = $this->Entidad_model->get_entidad( $documento );

		$response = array( "entidad" => $entidad );

		if( empty( $entidad ) ){
			$response['entidad'] = null;
			$this->response( $response, Rest_Controller::HTTP_NOT_FOUND );
		}
		else{
			$this->response( $response );
		}

		//echo json_encode( $response, JSON_UNESCAPED_UNICODE );
	}
}
