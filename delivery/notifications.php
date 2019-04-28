<?php  
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["deliverypersonid"])) {
		require_once("../controllers/delivery/deliveryNotifications.php");
		(new DeliveryNotifications())->allNotifications(); 
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
?>