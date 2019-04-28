<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["restaurantid"])) {
		if(isset($_POST['editProfile'])){
			require_once("../controllers/restaurant/restaurantProfile.php");
			(new RestaurantProfile())->editProfile(); 
		}else{
			require_once("../controllers/restaurant/restaurantProfile.php");
			(new RestaurantProfile())->view(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
