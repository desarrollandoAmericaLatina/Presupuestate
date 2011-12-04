<?php
class UtilitiesShell extends Shell {
	
	function updateData() {
		$this->School = ClassRegistry::init("School");
		$this->College = ClassRegistry::init("College");

		$schools = $this->School->find(
			"all",
			array(
				"conditions" => array(
					"active" => 1
				)
			)
		);
		
		echo "Actualizando colegios\r\n\r\n";
		foreach($schools as $school) {
			echo "Actualizando ".$school['School']['name']."\r\n";
			$simce = $this->School->getSimceById($school['School']['mineduc_id']);
			
			$simce_x = array_keys($simce);
			$simce_y = array_values($simce);

			$simce_function = linear_regression($simce_x, $simce_y);
			echo "Simce function: ".$simce_function."\r\n";

			$psu = $this->School->getPsuById($school['School']['mineduc_id']);

			$psu_x = array_keys($psu);
			$psu_y = array_values($psu);

			$psu_function = linear_regression($psu_x, $psu_y);
			echo "PSU function: ".$psu_function."\r\n";
			
			$list_school_prices = $this->School->SchoolPrice->find(
				"all",
				array(
					"conditions" => array(
						"school_id" => $school['School']['id'],
					)
				)
			);

			$school_prices = array();

			foreach($list_school_prices as $price) {
				$school_prices[$price['SchoolPrices']['year']] = $price['SchoolPrices']['price'];
			}

			$school_prices_x = array_keys($school_prices);
			$school_prices_y = array_values($school_prices);

			$school_prices_function = linear_regression($school_prices_x, $school_prices_y);
			echo "Prices function: ".$school_prices_function."\r\n";
			
			$school['School']['psu_function'] = $psu_function;
			$school['School']['simce_function'] = $simce_function;
			$school['School']['price_function'] = $school_prices_function;

			$this->School->save($school);
		}

		$colleges = $this->College->find(
			"all",
			array(
				"conditions" => array(
					"active" => 1
				)
			)
		);
		
		echo "\r\n\r\nUpdating Colleges\r\n";
		foreach($colleges as $college) {
			echo "Updating college: ".$college['College']['name']."\r\n";
			
			$degrees = $this->College->Degree->find("all", array("conditions" => array("Degree.active" => 1)));

			foreach($degrees as $degree) {

				echo "Updating degree: ".$degree['Degree']['name']."\r\n";

				$list_degree_prices = $this->College->Degree->DegreesPrice->find(
					"all",
					array(
						"conditions" => array(
							"degree_id" => $degree['Degree']['id'],
						)
					)
				);
			

				$degree_prices = array();

				foreach($list_degree_prices as $price) {
					$degree_prices[$price['DegreesPrice']['year']] = $price['DegreesPrice']['price'];
				}
			
				$degree_prices_x = array_keys($degree_prices);
				$degree_prices_y = array_values($degree_prices);
	
				$degree_prices_function = linear_regression($degree_prices_x, $degree_prices_y);
				echo "Price function: ".$degree_prices_function."\r\n";

				$degree['Degree']['price_function'] = $degree_prices_function;
					
				$this->College->Degree->save($degree);
			}
		}

		echo "\r\nDone\r\n";
	}
}
