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

		foreach($schools as $school) {
			$simce = $this->School->getSimceById($school['School']['mineduc_id']);
			
			$simce_x = array_keys($simce);
			$simce_y = array_values($simce);

			$simce_function = linear_regression($simce_x, $simce_y);


			$psu = $this->School->getPSUById($school['School']['mineduc_id']);

			$psu_x = array_keys($psu);
			$psu_y = array_values($psu);

			$psu_function = linear_regression($psu_x, $psu_y);


			$list_school_prices = $this->School->SchoolPrices->find(
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

			
			$school['School']['psu_function'] = $psu_function;
			$school['School']['simce_function'] = $simce_function;
			$school['School']['price_function'] = $school_prices_function;
		}

		$colleges = $this->College->find(
			"all",
			array(
				"conditions" => array(
					"active" => 1
				)
			)
		);

		foreach($colleges as $college) {

			$list_college_prices = $this->College->CollegePrices->find(
				"all",
				array(
					"conditions" => array(
						"college_id" => $school['College']['id'],
					)
				)
			);

			$college_prices = array();

			foreach($list_college_prices as $price) {
				$college_prices[$price['CollegePrices']['year']] = $price['CollegePrices']['price'];
			}

			$college_prices_x = array_keys($college_prices);
			$college_prices_y = array_values($college_prices);

			$college_prices_function = linear_regression($college_prices_x, $college_prices_y);

			$school['College']['price_function'] = $college_prices_function;

		}
	}
}
