<?php
	if (isset($this->menu_data)) {
		require_once("home.html");
	}elseif (isset($this->cart_data)) {
		require_once("cart.html");
	}else{
		require_once("home.html");
	}
	
?>