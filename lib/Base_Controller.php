<?php
abstract class Base_Controller{
	public function __construct(){
		$this->view = new Base_View();
	}
	public function loadModel($name) {
		$path = 'models/'.$name.'_model.php';
		if (file_exists($path)) {
			//require_once("models/$name_model.php");
			require_once("models/".$name."_model.php");
			$modelName = ucfirst($name)."_Model";
			$this->model = new $modelName();
		}
	}
	public function loadInnerModel($name){
		$path = '../models/'.$name.'_model.php';
		if (file_exists($path)) {
			//require_once("models/$name_model.php");
			require_once("../models/".$name."_model.php");
			$name = explode("/",$name);
			$modelName = ucfirst($name[1])."_Model";
			$this->model = new $modelName();
		}
	}
}

?>