<?php
require_once("config.php");
function __autoload($class) {
	//var_dump($class);
	require LIBRARY . $class .".php";
}


if (isset($_POST['food_id'])) {
	if (isset($_SESSION["customerid"])) {
		require_once("/controllers/customer/customerHome.php");
		(new CustomerHome())->addToCart(); 
	}else{
		echo "PLEASE LOG IN FIRST";
	}
}elseif (isset($_GET['FoodID'])) {
	require_once("controllers/home.php");
	(new Home())->getFoodInfo(); 
}else if(isset($_GET['RestaurantID'])){
	require_once("controllers/home.php");
	(new Home())->getRestaurantInfo();
}else if (isset($_POST['check_user_activity'])) {
	require_once("controllers/customer/customerHome.php");
	(new CustomerHome())->checkUserActivity(); 
}else if (isset($_POST['notification_activity'])) {
	echo 0;
}elseif (isset($_POST['send_message'])) {
	if (isset($_SESSION["customerid"])) {
		require_once("controllers/customer/customerMessages.php");
		(new CustomerMessages())->sendCustomerMessage(); 
	}else{
		echo "PLEASE LOG IN FIRST";
	}
}else{
	$app = new Bootstrap("home");
}
?>