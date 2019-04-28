<?php
use iPay\Cashier;
class CustomerHome_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function loadCustomer($_id){
		$st = $this->db->prepare("SELECT first_name, second_name, customer_id FROM customer WHERE
		customer_id = :cust_id");
		$st->execute(array(
		':cust_id' => $_id
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData ==1){
			return $data['first_name']." ".$data['second_name'];
		}else{
			return null;
		}
	}
	public function getMenu(){
		return $this->db->query("SELECT * FROM menu_view;")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getLastFoodIndex(){
		return $this->db->query("SELECT food_id FROM menu_view ORDER BY food_id DESC LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function addToCart($id, $c_id){
		$stmt = $this->db->query("SELECT order_id FROM delivery_order WHERE food_id = $id AND customer_id = $c_id AND STATUS = 'CART'")->fetchAll(PDO::FETCH_ASSOC);
		if ($stmt==null) {
			$st = $this->db->prepare("SELECT * FROM menu_view WHERE
			food_id = :f_id");
			$st->execute(array(
			':f_id' => $id
			));
			$data = $st->fetch(PDO::FETCH_ASSOC);
			$hasData = $st->rowCount();
			if($hasData ==1){
				$status = "CART";
				$qnty = 1;
				$columns = 'food_id, food_name, food_price, food_quantity, picture_id, customer_id, restaurant_id, STATUS';
				$values = $data['food_id'].', \''.$data['food_name'].'\', '.$data['price'].', '.$qnty.', \''.$data['picture_id'].'\', '.$_SESSION["customerid"].', '.$data['restaurant_id'].', \''.$status.'\'';
				
				$stmt = $this->db->prepare("INSERT INTO delivery_order($columns) VALUES($values);");
				$stmt->execute();
				echo "".$data['food_name']." ADDED TO FOOD CART";
				return $this->db->lastInsertId();
			}else{
				echo "ERROR: ".$data['food_name']."NOT ADDED TO FOOD CART";
				return 0;
			}
		}else{
			echo "THE FOOD ALREADY EXIST IN THE CART";
			return 0;
		}

	}
	public function loadFoodInfo($f_id){
		return $this->db->query("SELECT * FROM menu_view WHERE food_id = $f_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	////
	public function loadRestaurantProfile($_id){

		return $this->db->query("SELECT * FROM restaurants WHERE restaurant_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function restaurantMenu($restaurant){
		return $this->db->query("SELECT * FROM menu_view WHERE restaurant_id = $restaurant")->fetchAll(PDO::FETCH_ASSOC);	
	}
	public function loadCart($customer){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE customer_id = $customer AND STATUS = 'CART'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function selectOrder($id, $qnty){
		$status = "SELECTED";
		$value1 = '\''.$status.'\'';
		$value2 = $qnty;
		$stmt = $this->db->prepare("UPDATE delivery_order SET STATUS = $value1, food_quantity = $value2 WHERE order_id = $id");
		$stmt->execute();
		echo $id." food selected ".$this->db->lastInsertId();
		return $this->db->lastInsertId();
	}
	public function displaySelectedOrder(){
		$customer = $_SESSION["customerid"];
		$status = '\'SELECTED\'';
		return $this->db->query("SELECT * FROM delivery_order_view WHERE customer_id = $customer AND STATUS = $status")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getDeliveryPersonLocation(){
		return $this->db->query("SELECT * FROM delivery_person_geolocation")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function unselectOrder(){
		$status = "CART";
		$initStatus = "SELECTED";
		$parameter = '\''.$initStatus.'\'';
		$values = '\''.$status.'\'';
		$value2 = 1;
		$stmt = $this->db->prepare("UPDATE delivery_order SET STATUS = $values, food_quantity = $value2 WHERE STATUS = $parameter");
		$stmt->execute();
		return $this->db->lastInsertId();
	}
	public function getCurrentTime(){
		return $this->db->query("SELECT 
			DAY(CURRENT_DATE()) AS DAY, 
			MONTH(CURRENT_DATE()) AS MONTH, 
			YEAR(CURRENT_DATE()) AS YEAR, 
			HOUR(CURRENT_TIME()) AS HOUR, 
			MINUTE(CURRENT_TIME()) AS MINUTE, 
			SECOND(CURRENT_TIME()) AS SECOND")->fetchAll(PDO::FETCH_ASSOC);
		
	}
	public function deleteLocation($cust_loc_id){
		return $this->db->prepare("DELETE FROM customer_geolocation WHERE pos_id = $cust_loc_id")->execute();
	}
	public function saveLocation($p_Name, $p_Lati, $p_longi, $pos_accy, $c_id){
		$checkExistance = 0;
		$p_Name1 = '\''.$p_Name.'\'';
		$pos_accy = 1.0;
		$stmt = $this->db->query("SELECT * FROM customer_geolocation WHERE customer_id = $c_id AND pos_name = $p_Name1 AND latitude_cood = $p_Lati AND longitude_cood = $p_longi");

		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$hasData = $stmt->rowCount();


		if ($hasData==0) {
			$columns = 'pos_name, latitude_cood, longitude_cood, accuracy, Date, Time, customer_id';
			$values = '\''.$p_Name.'\', '.$p_Lati.', '.$p_longi.', '.$pos_accy.', CURRENT_DATE(), CURRENT_TIME(), '.$c_id.'';
			$update = $this->db->prepare("INSERT INTO customer_geolocation ($columns) VALUES($values);")->execute();
			if ($update==1) {
				return true;
			}else if ($update==0) {
				return false;
			}else{
				return null;
			}
		}else{
			return $data['pos_id'];
		}
	}
	public function getLastPositionIndex($c_id){
		$stmt = $this->db->query("SELECT pos_id FROM customer_geolocation WHERE customer_id = $c_id ORDER BY pos_id DESC LIMIT 1");
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$hasData = $stmt->rowCount();
		if ($hasData==1) {
			return $data['pos_id'];
		}
	}
	public function getSavedLocation(){
		$customer = $_SESSION["customerid"];
		return $this->db->query("SELECT * FROM customer_geolocation WHERE customer_id = $customer")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getDeliveryPerson(){
		return $this->db->query("SELECT * FROM delivery_people")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function deleteFromCart($_id){
		return $this->db->prepare("DELETE FROM delivery_order WHERE order_id = $_id")->execute();
	}
	public function preOrder($id, $qnty, $time, $date, $posId, $dryPersonId, $dPrice, $dDistance, $dPriceKM, $f_status){
		$preOrder = "PREORDER";
		$quantity = $qnty;
		$delivery_time = '\''.$time.'\'';
		$delivery_date = '\''.$date.'\'';
		$pos_id = $posId;
		$delivery_person_id = $dryPersonId;
		
		$set = 'STATUS = \''.$preOrder.'\', food_quantity = '.$qnty.', deliver_time = \''.$time.'\', delivery_date = \''.$date.'\', customer_pos_id = '.$posId.', delivery_person_id = '.$dryPersonId.', order_date = CURRENT_DATE(), order_time = CURRENT_TIME(), delivery_price = '.$dPrice.', delivery_distance = '.$dDistance.', price_per_km = '.$dPriceKM.', delivery_status = \''.$f_status.'\'';
		
		return $this->db->prepare("UPDATE delivery_order SET ".$set." WHERE order_id = ".$id."")->execute();
		
	}
	public function selectPreOrders($_cust_d){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE customer_id = $_cust_d AND STATUS = 'PREORDER'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function unSelectPreOrders($_cust_d){
		return $this->db->prepare("UPDATE delivery_order SET STATUS = 'CART', delivery_status = 'CART' WHERE STATUS = 'PREORDER' AND customer_id = $_cust_d")->execute();
	}
	public function selectDeliveryData($delivery_id){
		return $this->db->query("SELECT * FROM delivery_people WHERE delivery_person_id = $delivery_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function selectLocationData($pos_id){
		return $this->db->query("SELECT * FROM customer_geolocation WHERE pos_id = $pos_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function setMpesaSTKPushFields(){
		

		//require "../customer/autoload.php";

		$cashier = new Cashier();

		$transactChannels = [
		    Cashier::CHANNEL_MPESA
		];

		$response = $cashier
		    ->usingChannels($transactChannels)
		    ->usingVendorId('savekakitu', 'Sa54KA458hgds5479TU')
		    ->withCallback('http://yourcallback.com')
		    ->withCustomer('07i8306114', 'elkanahmalonza@gmail.com', false)
		    ->transact(10, 'otggljm', '123456');

		echo $response;
		return $response;
	}
	public function generateMpesaSTKPushHash(){
		
	}
	public function orderFood($_cust_d){
		return $this->db->prepare("UPDATE delivery_order SET STATUS = 'ORDERED' WHERE customer_id = $_cust_d AND STATUS = 'PREORDER'")->execute();
	}
	public function notifyRestaurantNewOrder($resNoti_title, $resNoti_content, $noti_status, $noti_image, $rest_id){
		$columns = 'notification_title, notification_content, notification_status, notification_image, restaurant_id';
		$values = '\''.$resNoti_title.'\', \''.$resNoti_content.'\', \''.$noti_status.'\', \''.$noti_image.'\', '.$rest_id.'';
		$update = $this->db->prepare("INSERT INTO restaurant_notifications ($columns) VALUES($values);")->execute();
		if ($update==1) {
			return true;
		}else if ($update==0) {
			return false;
		}else{
			return null;
		}
	}
	public function notifyDeliveryPersonNewOrder($delNoti_title, $delNoti_content, $noti_status, $noti_image, $del_id){
		$columns = 'notification_title, notification_content, notification_status, notification_image, delivery_person_id';
		$values = '\''.$delNoti_title.'\', \''.$delNoti_content.'\', \''.$noti_status.'\', \''.$noti_image.'\', '.$del_id.'';
		$update = $this->db->prepare("INSERT INTO delivery_person_notifications ($columns) VALUES($values);")->execute();
		if ($update==1) {
			return true;
		}else if ($update==0) {
			return false;
		}else{
			return null;
		}
	}
	public function myOrders($_cust_d){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE STATUS = 'ORDERED' AND customer_id = $_cust_d")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function myPrevOrders($_cust_d){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE STATUS = 'PREV_DELIVERY' AND customer_id = $_cust_d")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function getAccountID($_cust_d){
		$stmt = $this->db->query("SELECT user_account_id FROM customer WHERE customer_id = $_cust_d")->fetchAll(PDO::FETCH_ASSOC);
		return $stmt;
	}
	public function foodFeedback($value, $columns){
		$update = $this->db->prepare("INSERT INTO food_feedback ($columns) VALUES($value);")->execute();
	}
	public function deliveryFeedback($value, $columns){
		$update = $this->db->prepare("INSERT INTO delivery_feedback ($columns) VALUES($value);")->execute();
	}
	public function updateActivity($acc_id, $status, $time){
		$acvty_status = "'".$status."'";
		if ($time=='NOW()') {
			$time=='NOW()';
		}else{
			$time = "'".$time."'";
		}
		return $this->db->prepare("UPDATE user_accounts SET activity_status = $acvty_status, last_update = $time WHERE account_id = $acc_id")->execute();
	}
	public function getActivityStatus($acc_id){
		$stmt = $this->db->query("SELECT activity_status, last_update, (NOW()-last_update)/100 AS T_DIFFERENCE FROM user_accounts WHERE account_id = $acc_id")->fetchAll(PDO::FETCH_ASSOC);
		return $stmt;
	}
	public function newNotifications($_id){
		return $this->db->query("SELECT notification_content, notification_id, notification_title, order_id FROM customer_notifications WHERE customer_id = $_id AND notification_status = 'NOT_VIEWED'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function makeNotificationsReadStatus($noti_id){
		return $this->db->prepare("UPDATE customer_notifications SET notification_status = 'VIEWED' WHERE notification_id = $noti_id")->execute();
	}
	public function selectNotificationOrder($odr_id){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE order_id = $odr_id")->fetchAll(PDO::FETCH_ASSOC);	
	}
}

?>
