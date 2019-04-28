<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["deliverypersonid"])) {
		require_once("../controllers/delivery/deliveryHome.php");
		(new DeliveryHome())->navigation(); 

		/*if(isset($_POST['addFoodButton'])){
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->addFood(); 
		}else if (isset($_POST['food_id'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->addToCart(); 
		}else{
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->get(); 
		}*/
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
