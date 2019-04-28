<?php
class Base_View{
		public function __construct(){
	}
	public function render($name){
		//require_once("views/layout/header.php");
		require_once("views/$name.php");
		require_once("views/layout/footer.php");
	}
	public function innerRender($name){
		require_once("../views/$name.php");
		require_once("../views/layout/footer.php");
	}
	public function innerRenderView($name){
		require_once("../views/$name.php");
	}
	public function renderView($name){
		//require_once("views/layout/header.php");
		require_once("views/$name.php");
	}
}

?>