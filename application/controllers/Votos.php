<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest_Controller.php';

class Votos extends Rest_Controller {

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

		$data = count( $this->post() ) == 1 ? (array) json_decode( $this->post()[0] ) : $this->post();

		$this->load->model('Entidad_model');

		$entidad = $this->Entidad_model->get_entidad( $data['documento_votante'] );

		$data['id_entidad_votante'] = $entidad->id;

		$this->Voto_model->set_data( $data );
		$this->response( $this->Voto_model->votar() );

	}

	public function listar_get(){

		$votos = $this->Voto_model->get_votos();

		$response = array();

		foreach ($votos->result() as $voto) {
			$response[] = $voto;
		}

		$this->response( array( "votos" => $response ) );

	}

	public function detalle_get(){

		$id = $this->uri->segment(3);

		$voto = $this->Voto_model->get_data_voto( $id );

		$this->response( array( "voto" => $voto->result()[0] ) );

	}
}
