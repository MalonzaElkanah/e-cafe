<?php  
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["restaurantid"])) {//
		if(isset($_GET['CHAT_ID'])){
			require_once("../controllers/restaurant/restaurantMessages.php");
			(new RestaurantMessages())->myChat();  
		}elseif (isset($_POST['MESSAGE'])) {
			require_once("../controllers/restaurant/restaurantMessages.php");
			(new RestaurantMessages())->sendMessage(); 
		} else{
			require_once("../controllers/restaurant/restaurantMessages.php");
			(new RestaurantMessages())->allMessages();  
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
?>