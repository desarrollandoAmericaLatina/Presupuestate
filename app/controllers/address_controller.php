<?php

if (!defined('RBD_REQUEST_URL')) {
	define('RBD_REQUEST_URL', 'http://infoescuela.mineduc.cl/FichaEstablecimiento/FichaEstablecimiento');
}

class AddressController extends AppController {

	var $name = 'Address';
	var $uses = array();
	
	function index() {

		
	}
	
	function get_school_info_by_rbd($rbd = null) {

		if (empty($rbd)) {
			return array();
		}

		App::import('Core', 'HttpSocket');
		$socket = new HttpSocket();
		$result = $socket->post(RBD_REQUEST_URL, array(
				'rbd' => $rbd
			)
		);
		$result = str_replace('xmlns="" ', '', $result);
		$result = str_replace('xmlns="http://www.w3.org/1999/xhtml" ', '', $result);
		$result = explode("\n", $result);
		$results = array();
		$current_key = '';
		foreach ($result as $line) {
			if (!empty($current_key)) {
			    $document = new DOMDocument();
				$document->loadHTML($line);
				$results[$current_key] = $document->getElementsByTagName('td')->item(0)->nodeValue;
				$current_key = '';
				continue;
			}
			if (preg_match("/RBD:/", $line)) {
				$current_key = 'RBD';
			}
			if (preg_match("/Direcci/", $line)) {
				$current_key = 'direccion';
			}
			if (preg_match("/Comuna:/", $line)) {
				$current_key = 'comuna';
			}
		/*	if (preg_match("/Tel.fono:/", $line)) {
				$current_key = 'telefono';
		} */
			if (preg_match("/E-mail contacto:/", $line)) {
				$current_key = 'email';
			}
	
			if (preg_match("/Dependencia/", $line)) {
				$current_key = 'dependencia';
			}
			if (preg_match("/Pago matr/", $line)) {
				$current_key = 'costo_matricula';
			}
			if (preg_match("/cula total de alumnos/", $line)) {
				$current_key = 'matricula_total_alumnos';
			}
			if (preg_match("/Promedio alumnos por curso/", $line)) {
				$current_key = 'promedio_alumnos_curso';
			}
			if (preg_match("/Pago mensual por alumno/", $line)) {
				$current_key = 'pago_mensual';
			}
			/*if (preg_match('height=.18. width=.557.', $line)) {
				$results['nombre'] = $line;
			}*/
			
		}
		echo json_encode($results);
		exit;

	}

}
?>
