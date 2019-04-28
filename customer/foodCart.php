<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["customerid"])) {

		if(isset($_POST['foodOrder_id'])){
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->selectOrder(); 
		}else if (isset($_POST['selected'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->displaySelectedOrder(); 
		}elseif (isset($_GET['selected'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->displaySelectedOrder(); 
		}else if (isset($_POST['foodDelete_id'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->deleteFoodCart(); 
		}else if (isset($_POST['FoodOrder'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->orderFood(); 
		}else if (isset($_GET['PosName'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->newCustomerPosition(); 
		}elseif (isset($_GET['RestaurantID'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->getNearestDeliveryPerson(); 
		}elseif (isset($_POST['delete_loc_id'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->deleteSavedLocation(); 
		}elseif (isset($_POST['mPesaPayment'])) {
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->mPesaPayment(); 
		} else{
			require_once("../controllers/customer/customerHome.php");
			(new CustomerHome())->getCart(); 
		}
		
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
