<?php
class Home extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadModel("Home");
	}
	public function get($id=null){
		$this->view->menu_data = $this->model->getMenu();
		$this->view->render('home_view');
	}
	public function getFoodInfo(){
		$this->view->info_data = $this->model->loadFoodInfo($_GET['FoodID']);
		$this->view->renderView('customer/foodInfo');
	}
	public function getRestaurantInfo(){
		if(isset($_GET['RestaurantID'])){
			$r_id = $_GET['RestaurantID'];
			$this->view->restaurant_profile_data = $this->model->loadRestaurantProfile($r_id);
			$this->view->restaurant_menu_data = $this->model->restaurantMenu($r_id);
			$this->view->home_data = true;
			$this->view->renderView('customer/restaurantInfo');
		}
	}
}
