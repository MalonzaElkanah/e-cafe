<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["customerid"])) {
		require_once("../controllers/customer/customerHome.php");
		(new CustomerHome())->loadPreOrders(); 
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
