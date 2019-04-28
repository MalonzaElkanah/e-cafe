<?php
	
	require_once("config.php");
	function __autoload($class) {
		require LIBRARY . $class .".php";
	}

	if(isset($_POST['submit'])){
		include_once("controllers/delivery.php");
		(new Delivery())->add();	
	}else{
		include_once("controllers/delivery.php");
		(new Delivery())->index();
	}
	
	
?>