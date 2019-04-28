<?php  
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["customerid"])) {
		require_once("../controllers/customer/customerNotifications.php");
		(new CustomerNotifications())->allNotifications(); 
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
?>