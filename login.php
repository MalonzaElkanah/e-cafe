<?php
	
	require_once("config.php");
	function __autoload($class) {
		require LIBRARY . $class .".php";
	}
	if (isset($_SESSION["loggedin"])) {
		if ($_GET['exitId'] ==0) {
			$_GET['exitId']=1;
			unset($_GET['exitId']);
			include_once("controllers/login.php");
			(new Login())->runLogout();	
		}
	}else{
		if(isset($_POST['loginButton'])){
			include_once("controllers/login.php");
			(new Login())->runLogin();		
		}else{
			include_once("controllers/login.php");
			(new Login())->index();	
		}
	}

	
?>