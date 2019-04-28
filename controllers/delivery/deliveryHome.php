<?php

class DeliveryHome extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("delivery/deliveryHome");	
	}
	public function get($id=null){
		$this->view->schedule_delivery_data = $this->model->loadScheduleDelivery($_SESSION["deliverypersonid"]);
		$this->view->current_delivery_data = $this->model->loadCurrentDelivery($_SESSION["deliverypersonid"]);
		$this->view->prev_delivery_data = $this->model->loadPrevDeliveries($_SESSION["deliverypersonid"]);
		$this->view->profile_data = $this->model->loadDeliveryPerson($_SESSION["deliverypersonid"]);
		$this->view->innerRender('delivery/deliveryHome');
		$this->updateMyUserActiviy();
	}
	public function navigation(){
		$this->view->map_nav_data = $this->model->loadMapNavigation($_SESSION["deliverypersonid"]);
		$this->view->schedule_delivery_data = $this->model->loadScheduleDelivery($_SESSION["deliverypersonid"]);
		$this->view->current_delivery_data = $this->model->loadCurrentDelivery($_SESSION["deliverypersonid"]);
		$this->view->innerRender('delivery/navigation');
		$this->updateMyUserActiviy();
	}
	public function preDelivered(){
		if (isset($_POST['pre_delivered'])) {
			$this->view->create_id = $this->model->createPreDelivery($_POST['pre_delivered']);
			var_dump($this->view->create_id);	
		}
	}
	public function selectPreDelivery(){
		$this->view->preDelivery_data = $this->model->selectPreDelivery($_SESSION["deliverypersonid"]);
		$this->view->innerRenderView('delivery/delivery');
	}
	public function verifyIDNumDelivery(){
		if (isset($_POST['ID_NUM'])) {
			$v_id = $this->model->verifyDeliveryID($_POST['ID_NUM'], $_POST['CUST_ID']);
			echo $v_id;
		}
	}
	public function delivery(){
		if (isset($_POST['DELIVERY_ORDER'])) {
			$preDelivery_data = $this->model->selectPreDelivery($_SESSION["deliverypersonid"]);
			$delivery_id = $this->model->deliver($_SESSION["deliverypersonid"]);
			if ($delivery_id==true) {
				echo 1;
				foreach ($preDelivery_data as $notifyData) {
					$Noti_title = "FOOD ORDER DELIVERED"; 
					$Noti_content = $notifyData['food_name']." has been DELIVERED from ".$notifyData['restaurant_name'].". PLEASE provide feedback and rate the service. THANK YOU FOR CHOOSING e-cafe"; 
					$noti_status = "NOT_VIEWED";
					$noti_image = $notifyData['picture_id']; 
					$cust_id = $notifyData['customer_id'];
					$odr_id = $notifyData['order_id'];
					$this->model->notifyCustomer($Noti_title, $Noti_content, $noti_status, $noti_image, $cust_id, $odr_id);
				}	
			}else{
				echo 0;
			}
		}
	}
	public function updateMyUserActiviy(){
		$acc_id = $this->model->getAccountID($_SESSION["deliverypersonid"]);
		foreach ($acc_id as $id) {
			if ($id["user_account_id"]>0) {
				$a_id = $id["user_account_id"];
				$u_status = 'ONLINE';
				$time = 'NOW()';
				$this->view->update_status = $this->model->updateActivity($a_id, $u_status, $time);
				var_dump($this->view->update_status);
			}
		}
	}
	public function checkUserActivity(){
		$acc_id = $this->model->getAccountID($_SESSION["deliverypersonid"]);
		$this->updateMyUserActiviy();
		foreach ($acc_id as $id) {
            $activity_status = $this->model->getActivityStatus($id["user_account_id"]);
            foreach ($activity_status as $Data) {
		        $status = $Data['activity_status'];
		        $timeDiff = $Data['T_DIFFERENCE'];
		        $time = $Data['last_update'];
		        if ($status=='ONLINE') {
		        	if ($timeDiff>5) {
		        		$u_status = 'OFFLINE';
		        		$_status = $this->model->updateActivity($id["user_account_id"], $u_status, $time);
		        		var_dump($_status);
		        	}else{
		        		echo "No need of update";
		        	}
		        }else{
		        	echo "Iam offline";
		        }
		    }
        }
		//$activity_status = $this->model->getActivityStatus($acc_id);    
	}
	public function checkNotification(){
		$_notifications = $this->model->newNotifications($_SESSION["deliverypersonid"]);
		$i = 0;
		foreach ($_notifications as $notify) {
			$i++;
			$this->model->makeNotificationsReadStatus($notify['notification_id']);
			echo $notify['notification_content'];
		}
		if ($i==0) {
			echo 0;
		}
	}
	public function updateCurrentLocation(){
		if (isset($_POST['update_lati_pos'])) {
			$_updateLocation = $this->model->updateLocation($_SESSION["deliverypersonid"], $_POST['update_lati_pos'], $_POST['update_longi_pos']);
			echo $_updateLocation;
		}
	}
}

?>

