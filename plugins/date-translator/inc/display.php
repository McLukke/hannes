<?php
	function date_translate($str){
		global $nhndt_options;
		$day_names = array(
			/*Months*/
			"January" =>  $nhndt_options["January"],
			"February" =>  $nhndt_options["February"],
			"March" =>  $nhndt_options["March"],
			"April" =>  $nhndt_options["April"],
			"May" =>  $nhndt_options["May"],
			"June" =>  $nhndt_options["June"],
			"July" =>  $nhndt_options["July"],
			"August" =>  $nhndt_options["August"],
			"September" =>  $nhndt_options["September"],
			"October" =>  $nhndt_options["October"],
			"November" =>  $nhndt_options["November"],
			"December" =>  $nhndt_options["December"],
			/*Months (Short Forms)*/
			"Jan" =>  $nhndt_options["Jan"],
			"Feb" =>  $nhndt_options["Feb"],
			"Mar" =>  $nhndt_options["Mar"],
			"Apr" =>  $nhndt_options["Apr"],
			"May2" =>  $nhndt_options["May2"],
			"Jun" =>  $nhndt_options["Jun"],
			"Jul" =>  $nhndt_options["Jul"],
			"Aug" =>  $nhndt_options["Aug"],
			"Sep" =>  $nhndt_options["Sep"],
			"Oct" =>  $nhndt_options["Oct"],
			"Nov" =>  $nhndt_options["Nov"],
			"Dec" =>  $nhndt_options["Dec"],
			/*Day Names*/
			"Saturday" => $nhndt_options["Saturday"],
			"Sunday" => $nhndt_options["Sunday"],
			"Monday" => $nhndt_options["Monday"],
			"Tuesday" => $nhndt_options["Tuesday"],
			"Wednesday" => $nhndt_options["Wednesday"],
			"Thursday" => $nhndt_options["Thursday"],
			"Friday" => $nhndt_options["Friday"],
			/*Day Names (Short Forms)*/
			"Sat" => $nhndt_options["Sat"],
			"Sun" => $nhndt_options["Sun"],
			"Mon" => $nhndt_options["Mon"],
			"Tue" => $nhndt_options["Tue"],
			"Wed" => $nhndt_options["Wed"],
			"Thu" => $nhndt_options["Thu"],
			"Fri" => $nhndt_options["Fri"],
			/*Am and Pm*/
			"Am" => $nhndt_options["Am"],
			"Pm" => $nhndt_options["Pm"],
			/*Numbers*/
			"0" => $nhndt_options["0"],
			"1" => $nhndt_options["1"],
			"2" => $nhndt_options["2"],
			"3" => $nhndt_options["3"],
			"4" => $nhndt_options["4"],
			"5" => $nhndt_options["5"],
			"6" => $nhndt_options["6"],
			"7" => $nhndt_options["7"],
			"8" => $nhndt_options["8"],
			"9" => $nhndt_options["9"]
		);
		
		$converted = $str;
		
		foreach($day_names as $name => $value){
			if($value == ""){
				$converted = str_replace($name, $name, $converted);
			}
			else{
				$converted = str_replace($name, $value, $converted);
				$converted = str_replace(strtoupper($name), $value, $converted);
				$converted = str_replace(strtolower($name), $value, $converted);
			}
		}
		
		return $converted;
	}
	
	
	add_filter( 'date', 'date_translate' );
	add_filter( 'get_the_date', 'date_translate' );
	add_filter( 'the_date', 'date_translate' );
	add_filter( 'the_time', 'date_translate');
	add_filter( 'post_time', 'date_translate' );
	add_filter( 'the_weekday', 'date_translate' );
	add_filter( 'the_weekday_date', 'date_translate' );
	add_filter( 'get_calendar', 'date_translate' );
	add_filter( 'the_calendar', 'date_translate' );
	add_filter( 'get_comment_date', 'date_translate' );
	add_filter( 'get_comment_time', 'date_translate' );
	
?>