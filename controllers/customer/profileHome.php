<?php

class ProfileHome extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("customer/profileHome");
		
	}
	public function view(){
		$this->view->profile_data = $this->model->loadCustomer($_SESSION["customerid"]);
		$this->view->innerRender('customer/profileHome');
	}
	public function viewEdit(){
		$this->view->profile_data1 = $this->model->loadCustomer($_SESSION["customerid"]);
		$_GET['edit']=2;
		$this->view->innerRender('customer/profileHome');
	}
	public function updateProfile(){
		if(isset($_POST["newProfile"])){
			unset($_POST["newProfile"]);
			$this->view->id = $this->model->newProfile($_POST);
			header('Location:'. BASE_URL. 'customer/profile.php');
		}else{
			$this->view();
		}
	}
}

?>

