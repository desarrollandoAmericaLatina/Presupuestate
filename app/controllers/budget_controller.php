<?php
class BudgetController extends AppController {

	var $name = 'Budget';
	var $uses = array('School', 'College', 'Degree', 'Location');

	function result() {
		$schoolData = $this->Session->read('schoolData');
		$schools = array();
		if(!empty($schoolData)) {
			foreach($schoolData as $k => $v) {
				$schools[$k]['data'] = $this->School->find('first', array('conditions' => array('School.id' => $k)));
				$schools[$k]['price'] = $v['average_price'];
				$schools[$k]['simce_average_projection'] = $v['simce_average_projection'];
				$schools[$k]['psu_average_projection'] = $v['psu_average_projection'];
			}
		} else {
			$this->redirect('/');
		}
		$this->set('schools', $schools);
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
		//$schoolData = $this->schoolProcess($this->data['Recipe']['budget'],$this->data['Recipe']['family_nr'],$this->data['Recipe']['location'],$this->data['Recipe']['college'], $this->data['Recipe']['degree']);
		
		$schoolData = $this->schoolProcess(1231233,8,9,1,1);
		$this->Session->write('schoolData', $schoolData);
		$this->redirect(array('controller' => 'budget', 'action' => 'result'));
	}
	
	function schoolProcess($budget,$family_nr, $location, $college, $degree) {
		$a = microtime(true);
		
		$loc = $this->Location->find('first', array('conditions' => array('Location.id' => $location)));

		$ubication = array(
			"Ubication" => array(
				"id" => $loc['Location']['id'],
				"latitude" => $loc['Location']['lat'],
				"longitude" => $loc['Location']['lng']
			)
		);

		$this->data = array(
			"monthly_income"	=> $budget,
			"family"			=> $family_nr,
			"ubication"			=> $location,
			"college"			=> $college,
			"degree"			=> $degree,
			"join_year"			=> 2024
		);

		$weights = array(
			"price" => 2,
			"ubication" => 4,
			"simce" => 8,
			"psu" => 10,
		);

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
			//echo "entrando a $school_id, tiempo de ejecucion: ".(microtime(true) - $a)."s.<br />";

			$psu_average_projection = $this->School->psu_average_projection($school_id, $year);

			if($psu_average_projection >= $last_entered_projection) {
				$index = 0;
				
				$average_year = ($year + $actual_year) / 2;

				$average_price = $this->School->price_projection($school_id, $average_year);

				$distance = $this->School->calculate_distance($school_id, $ubication['Ubication']['latitude'], $ubication['Ubication']['longitude']);

				$simce_average_projection = $this->School->simce_average_projection($school_id, $year);

				$index =	(100 / $average_price)*$weights['price'] + 
							(100 * $distance) * $weights['ubication'] + 
							$simce_average_projection * $weights['simce'] + 
							$psu_average_projection * $weights['psu'];

				$indexes[$school['School']['id']]['index'] = $index;
				$indexes[$school['School']['id']]['average_price'] = round($average_price,0);
				$indexes[$school['School']['id']]['simce_average_projection'] = round($simce_average_projection,0);
				$indexes[$school['School']['id']]['psu_average_projection'] = round($psu_average_projection,0);
			}
		}

		asort($indexes);
 		return $indexes;
	}
}
?>
