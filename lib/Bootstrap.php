<?php
class Bootstrap{
	public function __construct($url1){
		if (empty($_GET['url'])&&empty($url1)) {
			$url ='home';
		}else if (empty($_GET['url'])&&!empty($url1)) {
			$url=$url1;
			empty($url1);
		}else{
			$url = $_GET['url'];
		}	
		$url = explode("/",$url);
		//should be logged
		//if a controller is not mentioned
		if(empty($url[0])){
			//require_once("index.html");
			require_once("controllers/home.php");
			(new Home())->get();
			return false;
		}
		$file_name = "controllers/".$url[0].".php";
		//should be logged
		if(!file_exists($file_name)){
			//replace the message
			//redirect the user to a custom 404 page
			echo "File does not exist: ".$file_name;
			return false;
		}
		require_once($file_name);
		$ct_name = ucfirst($url[0]);
		$controller = new $ct_name;
		if(empty($url[1])){
			$controller->get();
			return false;
		}
		$action_name = isset($url[1]) ? $url[1]:NULL;
		if($action_name && method_exists($controller, $action_name)){
			if(empty($url[2])){
				$controller->{$url[1]}();
			} else{
				$controller->{$url[1]}($url[2]);
			}
		}else{
			//should be logged
			//replace the message
			//redirect the user to a custom 404 page
			echo "Action does not exist";
		}
	}
}
/*

$url = 'default'; // set default value (you need to have also existing file controllers/default.php)
// check if `url` exists in $_GET
// check if it is string
// check if it match proper pattern (here it has to be built from letters a-z, A-Z and/or _ characters - you can change it to match your requirements)
// check if file exists 
if (isset($_GET['url']) && is_string($_GET['url']) && preg_match('/^[a-z_]+$/i',$_GET['url']) && file_exists('controllers/'.$_GET['url'].'.php')) {
   $url = $_GET['url']; // name in $_GET['url'] is ok, so you can set it
}
require('controllers/'.$url.'.php');

*/
?>