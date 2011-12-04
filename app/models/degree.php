<?php
class Degree extends AppModel {
	var $name = 'Degree';
	var $displayField = 'name';
	var $belongsTo = array(
		"College"
	);

	var $hasMany = array(
		"DegreesHistory"
	);

	function last_entered_projection($degree_id, $year) {
		$this->id = $degree_id;

		$function = $this->field("last_entered_function");
		$math = '$result = '.str_replace("x", $year, $function).';';
		pr($math);
		eval($math);

		return $result;	
	}

	function getByCollegeId($id) {
		$data = $this->find('list',
			array(
				'conditions' => array('Degree.active' => 1, 'Degree.college_id' => $id),
				'fields' => array('Degree.id', 'Degree.name')
			)
		);
		return $data;
	}
}
?>
