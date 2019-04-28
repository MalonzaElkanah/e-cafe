<?php  
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["restaurantid"])) {
		require_once("../controllers/restaurant/restaurantNotifications.php");
		(new RestaurantNotifications())->allNotifications(); 

		/*if(isset($_POST['addFoodButton'])){
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->addFood(); 
		}else{
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->get(); 
		}*/
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
?>