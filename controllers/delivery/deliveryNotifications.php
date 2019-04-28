<?php

class DeliveryNotifications extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("delivery/deliveryNotifications");
		
	}
	public function allNotifications(){
		$this->view->profile_data = $this->model->loadProfile($_SESSION["deliverypersonid"]);
		$this->view->notification_data = $this->model->loadAllNotifications($_SESSION["deliverypersonid"]);
		$this->view->innerRenderView('delivery/notifications');
	}
}

?>

