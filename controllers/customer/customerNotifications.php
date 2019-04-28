<?php

class CustomerNotifications extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("customer/customerNotifications");
		
	}
	public function allNotifications(){
		$this->view->profile_data = $this->model->loadProfile($_SESSION["customerid"]);
		$this->view->notification_data = $this->model->loadAllNotifications($_SESSION["customerid"]);
		$this->view->innerRenderView('customer/notifications');
	}
}

?>

