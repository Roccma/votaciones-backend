<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Voto_model extends CI_Model {

	public $id;
	public $id_entidad_postulante;
	public $id_entidad_votante;
	public $fecha;

	public function get_voto_por_documento( $documento ){

		$this->db->join('entidad', 'voto.id_entidad_votante = entidad.id');
		$this->db->where('entidad.documento', $documento);
		$query = $this->db->get( 'voto' );

		$row = $query->custom_row_object( 0, 'Voto_model' );

		return $row;
	}

	public function set_data( $data ){
		foreach ($data as $field => $value) {
			if( property_exists("Voto_model", $field) )
				$this->$field = $value;
		}

		$this->fecha = date('Y-m-d');

		return $this;
	}

	public function votar(){
		if( $this->db->insert( 'voto', $this ) ){
			return array(
				"code" => Rest_Controller::HTTP_OK,
				"response" => array( "id" => $this->db->insert_id() )
			);
		}
		else{
			
			return array(
				"code" => Rest_Controller::HTTP_INTERNAL_SERVER_ERROR,
				"response" => array( "error" => $this->db->_error_message(),
									"error_number" => $this->db->_error_number() )
			);
		}
	}
	
}