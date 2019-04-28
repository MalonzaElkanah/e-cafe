<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["deliverypersonid"])) {
		if (isset($_POST["newProfile"])) {
			require_once("../controllers/delivery/deliveryProfile.php");
			(new DeliveryProfile())->updateProfile(); 
		}else{
			require_once("../controllers/delivery/deliveryProfile.php");
			(new DeliveryProfile())->viewEdit(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
