<?php
class BudgetController extends AppController {

	var $name = 'Budget';
	var $uses = array('School', 'College', 'Degree', 'Location');

	function result() {
		$schoolData = $this->Session->read('schoolData');
		$collegeData = $this->Session->read('collegeData');
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
		$this->set('college', $collegeData);
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
		$collegeData = $this->degreeProcess(1,500000,2024);
		$this->Session->write('schoolData', $schoolData);
		$this->Session->write('collegeData', $collegeData);
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
				
				$average_year = ($year - $actual_year) / 2;

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

	function degreeProcess($degree_id, $monthly_income, $year_join) {
		$degree = $this->Degree->find(
			"first", 
			array(
				"conditions" => array(
					"Degree.active" => 1,
					"Degree.id" => $degree_id
				)
			)
		);

		$last_entered_projection = $this->Degree->last_entered_projection($degree_id, $year_join);

		$degree_total_price_projected = $degree['Degree']['duration'] * $this->Degree->price_projection($degree_id, ($year_join + ($degree['Degree']['duration']-1) /2));

		$months_to_save = floor((strtotime($year_join . "/03/01") - time()) / (60 * 60 * 24 * 31));

		$monthly_save = round($degree_total_price_projected / $months_to_save,0);
		
		$degree_final_year_price_projected = $this->Degree->price_projection($degree_id, ($year_join + $degree['Degree']['duration'] -1));

		$degree_prices = $this->Degree->DegreesHistory->find(
			"all", 
			array(
				"conditions" => array(
					"degree_id" => $degree_id
				), 
				"order" => array(
					"year ASC" 
				)
			)
		);
		
		$first_year = $degree_prices[0]['DegreesHistory']['year'];
		$first_price = $degree_prices[0]['DegreesHistory']['price'];

		$chart = array();
		
		$year_factor = 100 / ($year_join - $first_year + $degree['Degree']['duration'] -1);
		$money_factor = 100 / ($degree_final_year_price_projected - $first_price);
//pr($degree_prices);
		foreach($degree_prices as $dp) {
			$chart['x'][] = ($dp['DegreesHistory']['year'] - $first_year) * $year_factor;
			$chart['y'][] = ($dp['DegreesHistory']['price'] - $first_price) * $money_factor;
		}
		
		$chart['x'][] = $chart['x'][0];
		$chart['y'][] = $chart['y'][0];

		$chart['x'][] = ($year_join + $degree['Degree']['duration'] -1 - $first_year) * $year_factor;
		$chart['y'][] = $degree_final_year_price_projected;


		$last_year = 0;
		for($i = $first_year; $i < ($year_join + $degree['Degree']['duration'] -1); $i = $i+2) {
			$chart['labelX'][] = $i;
			$last_year = $i;
		}
		$chart['labelX'][] = $last_year +2;

		$diff = floor(($degree_final_year_price_projected - $first_price) / 5);

		for($i = $first_price; $i <= $degree_final_year_price_projected; $i += $diff) {
			$chart['labelY'][] = "\$".number_format($i, 0, ",", ".");
		}

		$chart_img = "https://chart.googleapis.com/chart?cht=s&chd=t:".implode(",", $chart['x'])."|".implode(",", $chart['y'])."&chxt=x,y&chxl=0:|".implode("|", $chart['labelX'])."|1:|".implode("|", $chart['labelY'])."&chs=500x125&chm=o,0000FF,0,-1,0,0|o,f9b103,0,0:".(count($chart['x'])-3).":,5,0.1|D,999999,1,".(count($chart['x'])-2).":,1,1";
		
		$result = compact(array("degree", "last_entered_projection","year_join","degree_total_price_projected","months_to_save","monthly_save","degree_final_year_price_projected","first_year","first_price","chart","chart_img"));
		
		return $result;
	}
	
}
?>
