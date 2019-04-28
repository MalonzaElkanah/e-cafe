<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["customerid"])) {
		if(isset($_GET['CHAT_ID'])){
			require_once("../controllers/customer/customerMessages.php");
			(new CustomerMessages())->myChat();  
		}elseif (isset($_POST['send_message'])) {
			require_once("../controllers/customer/customerMessages.php");
			(new CustomerMessages())->sendCustomerMessage(); 
		}elseif (isset($_POST['MESSAGE'])) {
			require_once("../controllers/customer/customerMessages.php");
			(new CustomerMessages())->sendMessage(); 
		}else{
			require_once("../controllers/customer/customerMessages.php");
			(new CustomerMessages())->allMessages(); 
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>