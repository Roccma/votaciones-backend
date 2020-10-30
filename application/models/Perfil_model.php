<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {

	public $id;
	public $documento;
	public $es_postulante;
	public $nombre;
	public $apellido;
	public $direccion;
	public $telefono;
	public $dob;
	public $sexo;

	public function get_postulantes(){

		$this->db->join('entidad', 'perfil.id = entidad.id_perfil');
		$this->db->where('entidad.es_postulante', true);
		$this->db->order_by('perfil.nombre', 'ASC');
		$query = $this->db->get( 'perfil' );

		return $query;
	}

	public function set_data( $data ){
		foreach ($data as $field => $value) {
			if( property_exists("Perfil_model", $field) )
				$this->$field = $value;
		}

		return $this;
	}

	public function insert(){
		if( $this->db->insert( 'perfil', array( "nombre" => $this->nombre,
												"apellido" => $this->apellido,
												"direccion" => $this->direccion,
												"telefono" => $this->telefono,
												"dob" => $this->dob,
												"sexo" => $this->sexo ) ) ){
			$this->id_perfil = $this->db->insert_id();
			$this->db->reset_query();
			
			if( $this->db->insert( 'entidad', array( "documento" => $this->documento,
													"es_postulante" => $this->es_postulante,
													"id_perfil" => $this->id_perfil ) ) ){
				return array(
					"code" => Rest_Controller::HTTP_OK
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
		else{
			return array(
				"code" => Rest_Controller::HTTP_INTERNAL_SERVER_ERROR,
				"response" => array( "error" => $this->db->_error_message(),
									"error_number" => $this->db->_error_number() )
			);
		}
	}
	
}