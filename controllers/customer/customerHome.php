<?php

class CustomerHome extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("customer/customerHome");
		
	}
	public function get($id=null){
		$this->view->home_customer_data = $this->model->loadCustomer($_SESSION["customerid"]);
		$this->view->menu_data = $this->model->getMenu();
		$this->view->last_food_index = $this->model->getLastFoodIndex();
		$this->view->innerRender('customer/customerHome');
		$this->updateMyUserActiviy();
	}
	public function addToCart(){
		if(isset($_POST['food_id'])){
			$id = $_POST['food_id'];
			unset($_POST['food_id']);
			$this->view->id = $this->model->addToCart($id, $_SESSION["customerid"]);
		}
		$this->updateMyUserActiviy();
	}
	public function getFoodInfo(){
		$this->view->info_data = $this->model->loadFoodInfo($_GET['FoodID']);
		$this->view->innerRenderView('customer/foodInfo');
		$this->updateMyUserActiviy();
	}
	public function getRestaurantInfo(){
		if(isset($_GET['RestaurantID'])){
			$r_id = $_GET['RestaurantID'];
			$this->view->restaurant_profile_data = $this->model->loadRestaurantProfile($r_id);
			$this->view->restaurant_menu_data = $this->model->restaurantMenu($r_id);
			$this->view->home_data = false;
			$this->view->innerRenderView('customer/restaurantInfo');
		}
	}
	public function getCart(){
		$this->model->unSelectPreOrders($_SESSION["customerid"]); 
		$this->view->cart_data = $this->model->loadCart($_SESSION["customerid"]);
		$this->view->innerRender('customer/customerHome');
		$this->updateMyUserActiviy();
	}
	public function selectOrder(){
		if(isset($_POST['foodOrder_id'])){
			$id = $_POST['foodOrder_id'];
			$qnty = $_POST['foodQnty'];
			unset($_POST['foodOrder_id']);
			$this->view->id = $this->model->selectOrder($id, $qnty);
		}else{
			$this->view->innerRender('restaurant/restaurantHome');
		}
		$this->updateMyUserActiviy();
	}
	public function displaySelectedOrder(){
		$this->view->selected_data= $this->model->displaySelectedOrder();
		$this->model->unselectOrder();
		$this->view->date_time_data = $this->model->getCurrentTime();
		$this->view->geo_data= $this->model->getSavedLocation();
		$this->view->delivery_person_data = $this->model->getDeliveryPerson();
		$this->view->deliveryPeople_locations = $this->model->getDeliveryPersonLocation();
		$this->view->innerRenderView('customer/selectedOrders');
		$this->updateMyUserActiviy();
	}
	public function deleteFoodCart(){
		if(isset($_POST['foodDelete_id'])){
			$id = $_POST['foodDelete_id'];
			unset($_POST['foodDelete_id']);
			$this->view->delete_data= $this->model->deleteFromCart($id);
			echo($this->view->delete_data);
		}else{
			echo "0";
		}
		$this->updateMyUserActiviy();
	}
	public function deleteSavedLocation(){
		if (isset($_POST['delete_loc_id'])) {
			$delete_status= $this->model->deleteLocation($_POST['delete_loc_id']);
			echo $delete_status;
		}
		$this->updateMyUserActiviy();
	}
	public function newCustomerPosition(){
		if (isset($_GET['PosName'])) {

			$this->view->pos_id = $this->model->saveLocation($_GET['PosName'], $_GET['LatiCood'], $_GET['LongiCood'], $_GET['PosAccy'], $_SESSION["customerid"]);

			if ($this->view->pos_id===true) {
				$this->view->new_pos_id = $this->model->getLastPositionIndex($_SESSION["customerid"]);
				echo $this->view->new_pos_id;
			}else if ($this->view->pos_id==false) {
				$this->view->new_pos_id = $this->model->getLastPositionIndex($_SESSION["customerid"]);
				echo $this->view->new_pos_id;
			}else if ($this->view->pos_id>0) {
				echo $this->view->pos_id;
			}
		}else{
			echo "0";
		}
		$this->updateMyUserActiviy();
	}
	public function preOrder(){
		if (isset($_POST['food_order_id'])) {
			$id = $_POST['food_order_id'];
			$qnty = $_POST['food_qnty'];
			$time = $_POST['food_delivery_time'];
			$date = $_POST['food_delivery_date'];
			$posId = $_POST['position_id'];
			$dryPersonId = $_POST['delivery_person_id'];
			$dPrice = $_POST['delivery_price'];
			$dPriceKM = $_POST['price_per_km'];
			$dDistance = $_POST['delivery_distance'];
			$f_status = $_POST['food_status'];
			
			unset($_POST['food_order_id']);
			$this->view->id = $this->model->preOrder($id, $qnty, $time, $date, $posId, $dryPersonId, $dPrice, $dDistance, $dPriceKM, $f_status);
			var_dump($this->view->id);
			echo"... ".$id.",". $qnty.", ".$time.", ".$dPrice.", ". $dDistance.", ".$dPriceKM.";";
		}else{
			echo "preorder not set";
		}
		$this->updateMyUserActiviy();
	}
	public function loadPreOrders(){
		$this->view->preOrder_data = $this->model->selectPreOrders($_SESSION["customerid"]);
		
		//$amount = $amount+$deliveryPrice;
		//$this->view->mpesaFields_data = $this->model->setMpesaSTKPushFields();
		//$fields = $this->view->mpesaFields_data;
		//$this->view->generated_hash = $this->model->generateMpesaSTKPushHash($fields);
		$this->view->innerRenderView('customer/deliverySummary');
		//$this->updateMyUserActiviy();
	}
	public function mPesaPayment(){
		
		$this->model->setMpesaSTKPushFields();
		//$fields = $this->view->mpesaFields_data;
		//$this->view->generated_hash = $this->model->generateMpesaSTKPushHash($fields);
		var_dump($this->model->setMpesaSTKPushFields());
	}
	public function orderFood(){
		$preOrder_data = $this->model->selectPreOrders($_SESSION["customerid"]);
		$this->view->order = $this->model->orderFood($_SESSION["customerid"]);
		//echo $this->view->order;
		if ($this->view->order==1) {
			foreach ($preOrder_data as $notifyData) {
				$resNoti_title = "NEW FOOD ORDER";
				$resNoti_content = $notifyData['customer_first_name']." ".$notifyData['customer_second_name']." ORDERED ".$notifyData['food_quantity']." ".$notifyData['food_name'].". To be delivered NOW. PICKED BY:- ".$notifyData['delivery_person_first_name'].' '.$notifyData['delivery_person_second_name'].".";
				$rest_id = $notifyData['restaurant_id'];

				$noti_status ="NOT_VIEWED";
				$noti_image = $notifyData['picture_id'];
				$this->model->notifyRestaurantNewOrder($resNoti_title, $resNoti_content, $noti_status, $noti_image, $rest_id);
				//notification restaurant
				$delNoti_title = "NEW DELIVERY ORDER";
				$delNoti_content = "PICK ".$notifyData['food_quantity']." ".$notifyData['food_name']." FROM ".$notifyData['restaurant_name'].", LOCATED AT ".$notifyData['r_pos_name']." AND DELIVER IT TO ".$notifyData['c_pos_name'].". ORDERED BY: ".$notifyData['customer_first_name']." ".$notifyData['customer_second_name'].".";
				$del_id = $notifyData['delivery_person_id'];
				$this->model->notifyDeliveryPersonNewOrder($delNoti_title, $delNoti_content, $noti_status, $noti_image, $del_id);
			}
			echo ''. BASE_URL. 'customer/orders.php';
		}else{
			//echo "".$this->view->order;
		}
		$this->updateMyUserActiviy();
	}
	public function getOrders(){
		$this->view->my_orders = $this->model->myOrders($_SESSION["customerid"]);
		$this->view->innerRender('customer/myOrders');
		$this->updateMyUserActiviy();
	}
	public function getPrevOrders(){
		$this->view->my_prev_orders = $this->model->myPrevOrders($_SESSION["customerid"]);
		$this->view->innerRender('customer/prevOrders');
		$this->updateMyUserActiviy();
	}
	public function foodFeedback(){
		if (isset($_POST['F_Feedback'])) {
			$comment;
			$rate;
			$odr = $_POST['Odr_id'];	//
			$value;
			$columns;
			if (isset($_POST['F_Rate'])) {
				if (isset($_POST['F_Comment'])) {
					$rate = $_POST['F_Rate'];
					$comment = $_POST['F_Comment'];
					$value = $rate.', \''.$comment.'\', '.$odr;
					$columns = 'rate_value, comment, order_id';
				}else{
					$rate = $_POST['F_Rate'];
					$value = $rate.', '.$odr;
					$columns = 'rate_value, order_id';
				}
			}else{
				$comment = $_POST['F_Comment'];
				$value = '\''.$comment.'\', '.$odr;
				$columns = 'comment, order_id';
			}
		}
		$update_id = $this->model->foodFeedback($value, $columns);
		echo $update_id;
	}
	public function deliveryFeedback(){
		if (isset($_POST['D_Feedback'])) {
			$comment;
			$rate;
			$value;
			$columns;
			$odr = $_POST['Odr_id'];	
			if (isset($_POST['D_Rate'])) {
				if (isset($_POST['D_Comment'])) {
					$rate = $_POST['D_Rate'];
					$comment = $_POST['D_Comment'];
					$value = $rate.', \''.$comment.'\', '.$odr;
					$columns = 'rate_value, comment, order_id';
				}else{
					$rate = $_POST['D_Rate'];
					$value = $rate.', '.$odr;
					$columns = 'rate_value, order_id';
				}
			}else{
				$comment = $_POST['D_Comment'];
				$value = '\''.$comment.'\', '.$odr;
				$columns = 'comment, order_id';
			}
		}
		$update_id = $this->model->deliveryFeedback($value, $columns);
		echo $update_id;
	}

	public function updateMyUserActiviy(){
		$acc_id = $this->model->getAccountID($_SESSION["customerid"]);
		foreach ($acc_id as $id) {
			if ($id["user_account_id"]>0) {
				$a_id = $id["user_account_id"];
				$u_status = 'ONLINE';
				$time = 'NOW()';
				$this->view->update_status = $this->model->updateActivity($a_id, $u_status, $time);
				//var_dump($this->view->update_status);
			}
		}
	}
	public function checkUserActivity(){
		$acc_id = $this->model->getAccountID($_SESSION["customerid"]);

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
	}
	public function checkNotification(){
		$_notifications = $this->model->newNotifications($_SESSION["customerid"]);
		$i = 0;
		foreach ($_notifications as $notify) {
			$i++;
			if ($notify['notification_title']=="FOOD ORDER DELIVERED") {
				$this->view->order_data = $this->model->selectNotificationOrder($notify['order_id']);
				$this->view->innerRenderView('customer/rateAndDeliveryFeedback');
				$this->model->makeNotificationsReadStatus($notify['notification_id']);
			}else{
				$this->model->makeNotificationsReadStatus($notify['notification_id']);
				echo $notify['notification_content'];
			}
			
		}
		if ($i==0) {
			echo 0;
		}
	}
	public function checkFoodDeliveryNotification(){
		$_notifications = $this->model->DeliveryNotification($_SESSION["customerid"]);
	}
}

?>

