<?php
class College extends AppModel {
	var $name = 'College';
	var $displayField = 'name';

	var $hasMany = array(
		"Degree"
	);
}
?>
