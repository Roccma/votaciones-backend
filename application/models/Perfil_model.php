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
		$query = $this->db->get( 'perfil' );

		return $query;
	}
	
}