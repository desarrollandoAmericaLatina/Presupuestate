<?php
class BudgetController extends AppController {

	var $name = 'Budget';
	var $uses = array('School', 'College', 'Degree', 'Location');

	function result() {
		$a = microtime(true);

		$ubication = array(
			"Ubication" => array(
				"id" => 1,
				"latitude" => 12.12121212,
				"longitude" => 12.12121212
			)
		);

		$this->data = array(
			"monthly_income"	=> 1231230,
			"family"			=> 8,
			"ubication"			=> 9,
			"college"			=> 1,
			"degree"			=> 1,
			"join_year"			=> 2024
		);

		$weights = array(
			"price" => 2,
			"ubication" => 4,
			"simce" => 8,
			"psu" => 10,
		);

		$this->College = ClassRegistry::init("College");
		$this->School = ClassRegistry::init("School");

		if(empty($this->data)) {
			$this->redirect("/");
		}


		$recommends = array();
		
		//Analizamos los colegios que tienen promedio de PSU > ultimo ingresado

		$actual_year = date("Y");
		$year = $this->data['join_year'];

		$last_entered_projection = $this->College->Degree->last_entered_projection($this->data['degree'], $year); 

		$schools = $this->School->find(
			"all",
			array(
				"conditions" => array(
					"active" => 1
				)
			)
		);
		foreach($schools as $school) {
			$school_id = $school['School']['id'];
			echo "entrando a $school_id, tiempo de ejecucion: ".(microtime(true) - $a)."s.<br />";

			$psu_average_projection = $this->School->psu_average_projection($school_id, $year);

			if($psu_average_projection >= $last_entered_projection) {
				$index = 0;
				
				$average_year = ($year - $actual_year) / 2;

				$average_price = $this->School->price_projection($school_id, $average_year);

				$distance = $this->School->calculate_distance($school_id, $ubication['Ubication']['latitude'], $ubication['Ubication']['longitude']);

				$simce_average_projection = $this->School->simce_average_projection($school_id, $year);

				$index =	(100 / $average_price)*$weights['price'] + 
							(100 * $distance) * $weights['ubication'] + 
							$simce_average_projection * $weights['simce'] + 
							$psu_average_projection * $weights['psu'];

				$indexes[$school['School']['id']] = $index;
			}
		}

		asort($indexes);


		pr($indexes);




	}
	
	function home() {
		$college = $this->College->getAll();	
		$locations = $this->Location->getLocation();
		$this->set('college',$college);
		$this->set('location',$locations);
	}
	
	function getDegree($id) {
		$degree = $this->Degree->getByCollegeId($id);
		echo json_encode($degree);
		die;
	}
	
	function dataProcess() {
		pr($this->data);
		die;
	}
}
?>
