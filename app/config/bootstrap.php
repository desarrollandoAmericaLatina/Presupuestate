<?php
//$array_x = array(1, 2, 3, 4);
//$array_y = array(1.5, 1.6, 2.1, 3.0);

function linear_regression($array_x = array(), $array_y = array()) {
	
	if(empty($array_x) || empty($array_y) || count($array_x) != count($array_y)) {
		return 0;
	}

	//first of all we must do the sumatories
	$sum_x	= 0;
	$sum_y	= 0;
	$sum_xy	= 0;
	$sum_x2	= 0;

	foreach($array_x as $k => $v) {
		$x = $array_x[$k];
		$y = $array_y[$k];

		$sum_x += $x;
		$sum_y += $y;
		$sum_xy += $x * $y;
		$sum_x2 += $x * $x;
	}

	$n = count($array_x);

	$m = (($n * ($sum_xy)) - ($sum_x * $sum_y)) / (($n * $sum_x2) - pow($sum_x, 2));
	
	$b = ($sum_y - ($m * $sum_x)) / $n;

	$function = $m . " * x + " . $b;
	
	return $function;
}
