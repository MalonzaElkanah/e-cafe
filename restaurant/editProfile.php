<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["restaurantid"])) {
		if (isset($_POST["newProfile"])) {
			require_once("../controllers/restaurant/restaurantProfile.php");
			(new RestaurantProfile())->updateProfile(); 
		}else{
			require_once("../controllers/restaurant/restaurantProfile.php");
			(new RestaurantProfile())->viewEdit(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
