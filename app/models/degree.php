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
}
?>
