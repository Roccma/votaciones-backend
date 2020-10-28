<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function get_all()
	{
		$this->load->database();

		$query = $this->db->query("SELECT * FROM perfil");

		$response = array(
			"total" => $query->num_rows(),
			"perfiles" => $query->result()
		);

		echo json_encode( $response );
	}
}
