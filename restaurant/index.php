<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["restaurantid"])) {
		if(isset($_POST['addFoodButton'])){
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->addFood(); 
		}else if (isset($_POST['check_user_activity'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->checkUserActivity(); 
		}else if (isset($_POST['notification_activity'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->checkNotification(); 
		}else if (isset($_POST['pre_dispatch'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->preDispatch(); 
		}else if (isset($_GET['select_preDispatch'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->selectPreDispatch();
		}else if (isset($_POST['ID_NUM'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->verifyIDNumDispatch();
		}else if (isset($_POST['DISPATCH_ORDER'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->dispatchOrder();
		}else if (isset($_POST['remove_dispatch'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->removePreDispatch();
		}else if (isset($_POST['del_lati_pos'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->getFoodLatitudeCood();
		}else if (isset($_POST['del_longi_pos'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->getFoodLongitudeCood();
		} else if (isset($_GET['FoodID'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->editFoodView();
		}elseif (isset($_POST['Food_ID'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->editFood();
		}else if (isset($_GET['FoodInfo'])) {
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->FoodInfoView();
		}else{
			require_once("../controllers/restaurant/restaurantHome.php");
			(new RestaurantHome())->get(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
