<?php
	require_once("config.php");
	function __autoload($class) {
		//var_dump($class);
		require LIBRARY . $class .".php";
	}
	$app = new Bootstrap("restaurant/get");

	//require_once("views/restaurant/restaurant.html");
?>