<?php
class School extends AppModel {
	var $name = 'School';

	var $displayField = 'name';

	var $hasMany = array(
		"SchoolPrice"
	);
	
	function getSimceById($a) { 
		$data4to = json_decode($this->getDataMineduc('rbd', $a, 'Establecimiento_Simce4Basico'), true);
		$data8vo = json_decode($this->getDataMineduc('rbd', $a, 'Establecimiento_Simce8Basico'), true);
		$data1ero = json_decode($this->getDataMineduc('rbd', $a, 'Establecimiento_SimceIIMedio'), true);

		$process = array();
		$average = array();
		
		foreach($data4to['d'] as $jd) {
			$process[$jd['agno']][] = $jd['simce_leng'];
			$process[$jd['agno']][] = $jd['simce_mate'];
		}
		
		foreach($data8vo['d'] as $jd) {
			$process[$jd['agno']][] = $jd['simce_leng'];
			$process[$jd['agno']][] = $jd['simce_mate'];
		}
		
		foreach($data1ero['d'] as $jd) {
			$process[$jd['agno']][] = $jd['simce_leng'];
			$process[$jd['agno']][] = $jd['simce_mate'];
		}

		foreach($process as $k => $v) {
			$sum = 0;
			$i = 0;
			foreach($v as $p) {
				$sum += $p;
				$i++;
			}
			$average[$k] = round(($sum/$i), 0);
		}

		return $average;
	}

	function getPsuById($a) {
		$psuData = json_decode($this->getDataMineduc('rbd', $a, 'Establecimiento_PSU'), true);
		$process = array();
		foreach($psuData['d'] as $jd) {
			$mat = $jd['psu_matematica'] * 0.5;
			$len = $jd['psu_lenguaje'] * 0.2;
			$nem = $jd['psu_nem'] * 0.3;
			$ponderado = $mat + $len + $nem;
			$process[$jd['agno']] = $ponderado;
		}
		return $process;
	}

	function getDataMineduc($field, $value, $data ,$encoding = 'json') {
		$url = 'http://data.mineduc.cl/odata/' . $data . '/?';
		$url_data = $url . '$filter=' . $field . '%20eq%20' . $value . '&';
		$url_data = $url_data . '$format=' . $encoding;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_data);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}

	function price_projection($school_id, $year) {
		$this->id = $school_id;

		$function = $this->field("price_function");
		$math = '$result = '.str_replace("x", $year, $function).';';
		eval($math);

		return $result;	
	}

	function calculate_distance($school_id, $latitude, $longitude) {
		$this->id = $school_id;

		$latitude_school = $this->field("latitude");
		$longitude_school = $this->field("longitude");

		$distance = sqrt(pow(abs($latitude_school - $latitude), 2) + pow(abs($longitude_school - $longitude), 2));

		return $distance;
	}

	function simce_average_projection($school_id, $year) {
		$this->id = $school_id;

		$function = $this->field("simce_function");
		$math = '$result = '.str_replace("x", $year, $function).';';
		eval($math);

		return $result;	
	}


	function psu_average_projection($school_id, $year) {
		$this->id = $school_id;

		$function = $this->field("psu_function");
		$math = '$result = '.str_replace("x", $year, $function).';';
		eval($math);

		return $result;	
	}


}
?>
