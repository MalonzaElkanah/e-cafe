<?php
	require_once("config.php");
	function __autoload($class) {
		//var_dump($class);
		require LIBRARY . $class .".php";
	}
	if(isset($_POST['submit'])){
		require_once("controllers/restaurant.php");
		(new Restaurant())->add();		
	}else{
		
		$app = new Bootstrap("restaurant/add");
	}
	
?>