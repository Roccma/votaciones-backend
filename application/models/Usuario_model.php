<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public $id;
	public $documento;
	public $email;
	public $clave;
	public $nombre;
	public $apellido;
	public $direccion;
	public $telefono;
	public $dob;
	public $sexo;

	public function do_login( $email, $clave ){

		$this->db->select('perfil.nombre, perfil.apellido, perfil.direccion, perfil.telefono, perfil.dob, perfil.sexo, usuario.id, usuario.documento, usuario.email');
		$this->db->join('perfil', 'usuario.id_perfil = perfil.id');
		$this->db->where('usuario.email', $email);
		$this->db->where('usuario.clave', $clave);
		$query = $this->db->get( 'usuario' );

		$row = $query->custom_row_object( 0, 'Usuario_model' );

		return $row;
	}
	
	public function change_password( $id, $clave ){

		$this->db->where( "id",  $id );

		if( $this->db->update( "usuario", array( "clave" => $clave ) ) ){
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
}