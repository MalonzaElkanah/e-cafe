<?php

class Delivery extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadModel("Delivery");
	}
	public function index(){
		$this->view->render('/delivery/signup');
	}
	public function add(){
		if(isset($_POST['submit'])){
			unset($_POST['submit']);
			$this->view->id = $this->model->addDeliveryPersonel($_POST);
			echo $this->view->id;
		}else{
			$this->view->render('/delivery/signup');
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
