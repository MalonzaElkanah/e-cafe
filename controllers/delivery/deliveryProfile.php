<?php

class DeliveryProfile extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("delivery/deliveryProfile");	
	}
	public function get($id=null){
		$this->view->profile_data = $this->model->loadProfile($_SESSION["deliverypersonid"]);
		$this->view->innerRender('delivery/deliveryProfile');
	}
	public function viewEdit(){
		$this->view->profile_data = $this->model->loadProfile($_SESSION["deliverypersonid"]);
		$_GET['edit']=2;
		$this->view->innerRender('delivery/deliveryProfile');
	}
	public function updateProfile(){
		if(isset($_POST["newProfile"])){
			unset($_POST["newProfile"]);
			$this->view->id = $this->model->newProfile($_POST);
			header('Location:'. BASE_URL. 'delivery/profile.php');
		}else{
			$this->view->innerRender('restaurant/restaurantProfile');
		}
	}
}

?>

