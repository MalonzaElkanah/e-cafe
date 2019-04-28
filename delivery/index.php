<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["deliverypersonid"])) {
		if (isset($_POST['check_user_activity'])) {
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->checkUserActivity(); 
		}else if (isset($_POST['notification_activity'])) {
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->checkNotification(); 
		}else if (isset($_POST['pre_delivered'])) {
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->preDelivered(); 
		}else if (isset($_GET['select_preDelivery'])) {
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->selectPreDelivery();
		}else if (isset($_POST['ID_NUM'])) {
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->verifyIDNumDelivery();
		}else if (isset($_POST['DELIVERY_ORDER'])) {
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->delivery();
		}else if (isset($_POST['update_lati_pos'])) {
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->updateCurrentLocation();
		} else{
			require_once("../controllers/delivery/deliveryHome.php");
			(new DeliveryHome())->get(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
