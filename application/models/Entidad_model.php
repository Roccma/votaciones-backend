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
	
	public function get_ranking(){

		$this->db->select('perfil.*, entidad.documento, COUNT(voto.id) AS votos');
		$this->db->join('perfil', 'perfil.id = entidad.id_perfil');
		$this->db->join('voto', 'voto.id_entidad_postulante = entidad.id', 'left');
		$this->db->where('entidad.es_postulante', true);
		$this->db->group_by('perfil.id');
		$this->db->order_by('votos', 'DESC');
		$this->db->order_by('perfil.nombre', 'ASC');
		$query = $this->db->get( 'entidad' );

		return $query;

	}
}