<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Votos extends Rest_Controller {

	public function __construct(){
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		$this->load->database();
		$this->load->model('Voto_model');
	}

	public function documento_get() {

		$documento = $this->uri->segment(3);

		$voto = $this->Voto_model->get_voto_por_documento( $documento );

		$response = array( "voto" => $voto );

		if( empty( $voto ) )
			$response['voto'] = null;
		
		$this->response( $response );
	}

	public function votar_post(){

		$data = $this->post();

		$data = (array) json_decode( $data[0] );

		$this->load->model('Entidad_model');

		$entidad = $this->Entidad_model->get_entidad( $data['documento_votante'] );

		$data['id_entidad_votante'] = $entidad->id;

		$this->Voto_model->set_data( $data );
		$this->response( $this->Voto_model->votar() );

	}
}
