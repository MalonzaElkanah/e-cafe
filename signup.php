<?php
	if(isset($_POST['customer'])){
		require_once("config.php");
		function __autoload($class) {
			require LIBRARY . $class .".php";
		}
		//var_dump($_POST['customer']);
		require_once("controllers/customer.php");
		(new Customer())->add();		
	}else{
		require_once("views/signup/signup.html");
	}
	
?>