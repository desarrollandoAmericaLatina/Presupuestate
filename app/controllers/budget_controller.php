<?php
class BudgetController extends AppController {

	var $name = 'Budget';
	var $uses = array('School', 'College', 'Degree', 'Location');

	function result() {
	
	}
	
	function home() {
		$college = $this->College->getAll();	
		$locations = $this->Location->getLocation();
		$this->set('college',$college);
		$this->set('location',$locations);
	}
	
	function getDegree($id) {
		$degree = $this->Degree->getByCollegeId($id);
		echo json_encode($degree);
		die;
	}
	
	function dataProcess() {
		pr($this->data);
		die;
	}
}
?>
