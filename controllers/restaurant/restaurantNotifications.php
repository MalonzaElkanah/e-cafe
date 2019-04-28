<?php

class RestaurantNotifications extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("restaurant/restaurantNotifications");
		
	}
	public function allNotifications(){
		$this->view->profile_data = $this->model->loadProfile($_SESSION["restaurantid"]);
		$this->view->notification_data = $this->model->loadAllNotifications($_SESSION["restaurantid"]);
		$this->view->innerRenderView('restaurant/notifications');
	}
	public function viewEdit(){
		$this->view->profile_data = $this->model->loadProfile($_SESSION["restaurantid"]);
		$_GET['edit']=2;
		$this->view->innerRender('restaurant/restaurantMessages');
	}
	public function updateProfile(){
		if(isset($_POST["newProfile"])){
			unset($_POST["newProfile"]);
			$this->view->id = $this->model->newProfile($_POST);
			header('Location:'. BASE_URL. 'restaurant/profile.php');
		}else{
			$this->view->innerRender('restaurant/restaurantProfile');
		}
	}
}

?>

