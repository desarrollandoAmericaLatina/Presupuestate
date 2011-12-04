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
		foreach($data4to['d'] as $jd) {
			$average = ($jd['simce_leng'] + $jd['simce_mate']) / 2; 
			$process[0][$jd['agno']] = round($average, 0);
		}
		foreach($data8vo['d'] as $jd) {
			$average = ($jd['simce_leng'] + $jd['simce_mate']) / 2; 
			$process[1][$jd['agno']] = round($average, 0);
		}
		foreach($data1ero['d'] as $jd) {
			$average = ($jd['simce_leng'] + $jd['simce_mate']) / 2; 
			$process[2][$jd['agno']] = round($average, 0);
		}
		return $process[0];
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
}
?>
