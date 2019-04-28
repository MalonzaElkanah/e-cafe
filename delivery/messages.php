<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["deliverypersonid"])) {
		if(isset($_GET['CHAT_ID'])){
			require_once("../controllers/delivery/deliveryMessages.php");
			(new DeliveryMessages())->myChat();  
		}elseif (isset($_POST['send_message'])) {
			require_once("../controllers/delivery/deliveryMessages.php");
			(new DeliveryMessages())->sendMessage(); 
		}elseif (isset($_POST['MESSAGE'])) {
			require_once("../controllers/delivery/deliveryMessages.php");
			(new DeliveryMessages())->sendMessage(); 
		}else{
			require_once("../controllers/delivery/deliveryMessages.php");
			(new DeliveryMessages())->allMessages(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>