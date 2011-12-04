<?php
class College extends AppModel {
	var $name = 'College';
	var $displayField = 'name';
	var $hasMany = array(
		"Degree"
	);

	function getAll() {
		$data = $this->find('list',
			array(
				'conditions' => array('College.active' => 1),
				'fields' => array('College.id', 'College.name')
			)
		);
		return $data;
	}
}
?>
