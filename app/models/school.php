<?php
class School extends AppModel {
	var $name = 'School';

	var $displayField = 'name';
	
	function getSimceById($a) { 
		$data = $this->getDataMineduc('rbd', $a);
		$json_data = json_decode($data, true);	
		$process = array();
		foreach($json_data['d'] as $jd) {
			$average = ($jd['simce_leng'] + $jd['simce_mate'] + $jd['simce_comp']) / 3; 
			$process[$jd['agno']] = round($average, 0);
		}
		return $process;
	}

	function getDataMineduc($field, $value, $encoding = 'json') {
		$url = 'http://data.mineduc.cl/odata/Establecimiento_Simce4Basico/?';
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
