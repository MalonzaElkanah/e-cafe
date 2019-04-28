<?php

class RestaurantProfile extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("restaurant/restaurantProfile");
		
	}
	public function view($id=null){

		$this->view->profile_data = $this->model->loadProfile($_SESSION["restaurantid"]);
		$this->view->menu_data = $this->model->menuView($_SESSION["restaurantid"]);

		$this->view->innerRender('restaurant/restaurantProfile');
	}
	public function viewEdit(){
		$this->view->profile_data = $this->model->loadProfile($_SESSION["restaurantid"]);
		$_GET['edit']=2;
		$this->view->innerRender('restaurant/restaurantProfile');
	}
	public function updateProfile(){
		if(isset($_POST["newProfile"])){
			unset($_POST["newProfile"]);
			$this->view->id = $this->model->newProfile($_POST);
			var_dump($this->view->id);
			header('Location:'. BASE_URL. 'restaurant/profile.php');
		}else{
			$this->view->innerRender('restaurant/restaurantProfile');
		}
	}
}

?>

