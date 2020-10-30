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

	public function get_votos(){

		$this->db->select('e1.documento AS documento_votante, p1.nombre AS nombre_votante, p1.apellido AS apellido_votante, e2.documento AS documento_postulante, p2.nombre AS nombre_postulante, p2.apellido AS apellido_postulante, voto.fecha, voto.id');
		$this->db->join( 'entidad e1', 'voto.id_entidad_votante = e1.id' );
		$this->db->join( 'entidad e2', 'voto.id_entidad_postulante = e2.id' );
		$this->db->join( 'perfil p1', 'e1.id_perfil = p1.id' );
		$this->db->join( 'perfil p2', 'e2.id_perfil = p2.id' );
		$this->db->order_by('voto.fecha', 'DESC');
		$this->db->order_by('voto.id', 'DESC');
		$query = $this->db->get('voto');

		return $query;
	}

	public function get_data_voto( $id ){

		$this->db->select('e1.documento AS documento_votante, p1.nombre AS nombre_votante, p1.apellido AS apellido_votante, p1.direccion AS direccion_votante, p1.telefono AS telefono_votante, p1.dob AS dob_votante, p1.sexo AS sexo_votante, e1.documento AS documento_votante, e1.es_postulante AS es_postulante_votante, e2.documento AS documento_postulante, p2.nombre AS nombre_postulante, p2.apellido AS apellido_postulante, voto.fecha, voto.id');
		$this->db->join( 'entidad e1', 'voto.id_entidad_votante = e1.id' );
		$this->db->join( 'entidad e2', 'voto.id_entidad_postulante = e2.id' );
		$this->db->join( 'perfil p1', 'e1.id_perfil = p1.id' );
		$this->db->join( 'perfil p2', 'e2.id_perfil = p2.id' );
		$this->db->where( 'voto.id', $id );
		$this->db->order_by('voto.fecha', 'DESC');
		$this->db->order_by('voto.id', 'DESC');
		$query = $this->db->get('voto');

		return $query;
	}
	
}