<?php

class Restaurant extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadModel("Restaurant");
	}
	public function add(){
		if(isset($_POST['submit'])){
			unset($_POST['submit']);
			$this->view->id = $this->model->addRestaurant($_POST);
			echo $this->view->id;
		}else{
			$this->view->render('/restaurant/add');
		}
		
	}
	public function get($id=null){
		$this->view->restaurant_data = $this->model->getRestaurant();
		$this->view->render('/restaurant/get');
	}
	public function home($id=null){
		$this->view->home_restaurant_data = $this->model->loadRestaurant();
		$this->view->render('/restaurant/restaurantHome');
	}
}
?>
