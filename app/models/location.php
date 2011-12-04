<?php
class Location extends AppModel {
	var $name = 'Location';
	var $displayField = 'name';
	
	function getLocation() {
		$locations = $this->find('list', 
			array(
				'conditions' 	=> array('Location.active' => 1),
				'fields' 		=> array('Location.id', 'Location.name')
			)
		);
		return $locations;
	}
}
?>