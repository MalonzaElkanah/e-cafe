<?php
	if (isset($this->profile_data)) {
		require_once("profile.html");
	}else if (isset($this->profile_data1)) {
		require_once("editProfile.html");
	}else{
		require_once("profile.html");
	}
?>