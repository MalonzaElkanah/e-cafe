<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["customerid"])) {
		if (isset($_POST['food_order_id'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->preOrder(); 
		}else if (isset($_GET['loadPreOrders'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->loadPreOrders(); 
		}else{
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->displaySelectedOrder(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
