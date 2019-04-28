<?php
	require_once("../config.php");
	function __autoload($class) {
		require "../".LIBRARY . $class .".php";
	}
	
	if (isset($_SESSION["customerid"])) {
		if (isset($_POST["newProfile"])) {
			require_once("../controllers/customer/profileHome.php");
			(new ProfileHome())->updateProfile();
		}else{
			require_once("../controllers/customer/profileHome.php");
			(new ProfileHome())->viewEdit();
		}
	}else{
		header('Location:'. BASE_URL.'login.php?message='.urlencode('please login first'));
	}
	
?>
