<?php
class BudgetController extends AppController {

	var $name = 'Budget';
	var $uses = array('School', 'College', 'Degree');

	function result() {
	
	}
	
	function home() {
		$college = $this->College->getAll();	
		$this->set('college',$college);
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
