<?php
class Degree extends AppModel {
	var $name = 'Degree';
	var $displayField = 'name';
	var $belongsTo = array(
		"College"
	);

	var $hasMany = array(
		"DegreesPrice"
	);
	
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
