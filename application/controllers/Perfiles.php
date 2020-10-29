<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Perfiles extends Rest_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->model('Perfil_model');
	}

	public function postulantes_get()
	{
		$postulantes = $this->Perfil_model->get_postulantes();

		$response = array();

		foreach ($postulantes->result() as $postulante) {
			$response[] = array(
				"id" => $postulante->id,
				"nombre" => $postulante->nombre,
				"apellido" => $postulante->apellido
			);
		}

		$this->response( array( "postulantes" => $response ) );
	}
}
