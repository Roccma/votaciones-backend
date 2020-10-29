<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Entidad_model extends CI_Model {

	public $id;
	public $documento;
	public $es_postulante;
	public $id_perfil;

	public function get_entidad( $documento ){
		
		$this->db->where('documento', $documento);
		$query = $this->db->get( 'entidad' );

		$row = $query->custom_row_object( 0, 'Entidad_model' );

		return $row;
	}
	
}