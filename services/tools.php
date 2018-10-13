<?php

function pre($thing) {
	echo "<pre>";
	print_r($thing);
	echo "</pre>";
} 


// function writeLog($thing) {

// 	if (is_array($thing)) {
// 		$thing = print_r($thing, true);
// 	}


// 	file_put_contents('../logs/log', PHP_EOL . date('Y-m-d H:i:s') . " " . $thing, FILE_APPEND);
// }

// function cleanText($text) {
// 	$text = strip_tags($text);
// 	$text = htmlentities($text);

// 	return $text;
// }

// function myGet($key) {

// 	if ( isset($_GET[$key]) == false) {
// 		return null;
// 	}

// 	return $_GET[$key];
// }