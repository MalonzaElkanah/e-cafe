<?php

class RestaurantHome extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("restaurant/restaurantHome");
		
	}
	public function get($id=null){
		$this->model->unSelectPreDispatch($_SESSION["restaurantid"]);
		$this->view->home_restaurant_data = $this->model->loadRestaurant($_SESSION["restaurantid"]);
		$this->view->current_delivery_data = $this->model->currentDeliveries($_SESSION["restaurantid"]);
		$this->view->schedule_delivery_data = $this->model->scheduledDeliveries($_SESSION["restaurantid"]);
		$this->view->menu_data = $this->model->menuView($_SESSION["restaurantid"]);
		$this->view->prev_deliveries_data = $this->model->prevDeliveries($_SESSION["restaurantid"]);
		
		$this->view->innerRender('restaurant/restaurantHome');
		$this->updateMyUserActiviy();
	}
	public function addFood(){
		if(isset($_POST['addFoodButton'])){
			unset($_POST['addFoodButton']);
			$this->view->id = $this->model->addFood($_POST);
			header('Location:'. BASE_URL. 'restaurant/index.php');
			//$this->get();
			//$this->view->innerRender('restaurant/restaurantHome');
		}else{
			$this->view->innerRender('restaurant/restaurantHome');
		}
		$this->updateMyUserActiviy();
	}
	public function preDispatch(){
		if (isset($_POST['pre_dispatch'])) {
			$this->view->create_id = $this->model->createPreDispatch($_POST['pre_dispatch']);
			var_dump($this->view->create_id);	
		}
	}
	public function selectPreDispatch(){
		$this->view->preDispatched_data = $this->model->selectPreDispatch($_SESSION["restaurantid"]);
		$this->view->innerRenderView('restaurant/dispatch');
	}
	public function verifyIDNumDispatch(){
		if (isset($_POST['ID_NUM'])) {
			$v_id = $this->model->verifyDeliveryID($_POST['ID_NUM'], $_POST['DEL_ID']);
			echo $v_id;
		}
	}
	public function dispatchOrder(){
		if (isset($_POST['DISPATCH_ORDER'])) {
			$preDispatch_data = $this->model->selectPreDispatch($_SESSION["restaurantid"]);
			$dispatch_id = $this->model->dispatch($_SESSION["restaurantid"]);
			if ($dispatch_id==true) {
				echo 1;
				foreach ($preDispatch_data as $notifyData) {
					$Noti_title = "FOOD ORDER DISPATCHED"; 
					$Noti_content = $notifyData['food_name']." has been DISPATCHED from ".$notifyData['restaurant_name'].". It currently being delivered by: ".$notifyData['delivery_person_first_name']." ".$notifyData['delivery_person_second_name']; 
					$noti_status = "NOT_VIEWED";
					$noti_image = $notifyData['picture_id']; 
					$cust_id = $notifyData['customer_id'];
					$this->model->notifyCustomer($Noti_title, $Noti_content, $noti_status, $noti_image, $cust_id);
				}	
			}else{
				echo 0;
			}
		}
	}
	public function removePreDispatch(){
		if (isset($_POST['remove_dispatch'])) {
			$this->model->unSelectPreDispatch($_SESSION["restaurantid"]);
		}
	}
	public function getFoodLatitudeCood(){
		if (isset($_POST['del_lati_pos'])) {
			$lati_cood = $this->model->deliveryPositionLatitude($_POST['del_lati_pos']);
			echo $lati_cood;
		}
	}
	public function getFoodLongitudeCood(){
		if (isset($_POST['del_longi_pos'])) {
			$longi_cood = $this->model->deliveryPositionLongitude($_POST['del_longi_pos']);
			echo $longi_cood;
		}
	}
	public function editFoodView(){
		if (isset($_GET['FoodID'])) {
			$foodId = $_GET['FoodID'];
			$this->view->editedFood_data = $this->model->selectEditedFood($_SESSION["restaurantid"], $foodId);
			$this->view->innerRenderView('restaurant/editFood');
		}
	}
	public function editFood(){
		if (isset($_POST['Food_ID'])) {
			$foodId = $_POST['FNAME'];
			$foodName = $_POST['Food_ID']; 
			$price = $_POST['FPRICE']; 
			$quantity = $_POST['FQNTY'];
			$category = $_POST['FCGRY']; 
			$description = $_POST['FDES'];
		
		    $editedFood = $this->model->updateFoodMenu($foodId, $foodName, $price, $quantity, $category, $description);
			echo($editedFood);
		}
	}
	public function FoodInfoView(){
		if (isset($_GET['FoodInfo'])) {
			$foodId = $_GET['FoodInfo'];
			$this->view->info_data = $this->model->selectFood($_SESSION["restaurantid"], $foodId);
			$this->view->innerRenderView('restaurant/foodInfo');
		}
	}
	public function updateMyUserActiviy(){
		$acc_id = $this->model->getAccountID($_SESSION["restaurantid"]);
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
		$acc_id = $this->model->getAccountID($_SESSION["restaurantid"]);
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
		$_notifications = $this->model->newNotifications($_SESSION["restaurantid"]);
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
}

?>

