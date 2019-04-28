<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["customerid"])) {
		if (isset($_POST['food_id'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->addToCart(); 
		}else if (isset($_GET['FoodID'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->getFoodInfo(); 
		}else if (isset($_POST['check_user_activity'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->checkUserActivity(); 
		}else if (isset($_POST['notification_activity'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->checkNotification(); 
		}else if (isset($_POST['F_Feedback'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->foodFeedback(); 
		}else if (isset($_POST['D_Feedback'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->deliveryFeedback(); 
		}else if(isset($_GET['RestaurantID'])){
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->getRestaurantInfo();
		}else{
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->get(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
