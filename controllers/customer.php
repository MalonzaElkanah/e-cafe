<?php
	class Customer extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadModel("Customer");
	}
	public function add(){
		if(isset($_POST['customer'])){
			unset($_POST['customer']);
			$this->view->id = $this->model->addCustomer($_POST);
			echo $this->view->id;
		}
		//$this->view->render('signup/signup');//
		//require_once("views/signup/signup.html");
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