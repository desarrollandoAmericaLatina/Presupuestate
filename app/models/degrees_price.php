<?php
class DegreesPrice extends AppModel {
	var $name = 'DegreesPrice';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Degree' => array(
			'className' => 'Degree',
			'foreignKey' => 'degree_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>