<?php
class RestaurantHome_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function loadRestaurant($_id){
		return $this->db->query("SELECT * FROM restaurants WHERE restaurant_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function addFood($food){
		$imageName = '';

		$target_dir = "../assets/uploads/foodImages/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["addFoodButton"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        //echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		        $imageName = $target_file;
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

		$columns = 'food_name, price, quantity, food_category, food_description, picture_id, restaurant_id';
		$values = '\''.$food['food_name'].'\', '.$food['price'].', '.$food['quantity'].', \''.$food['food_category'].'\', \''.$food['food_description'].'\', \''.$imageName.'\', '.$_SESSION["restaurantid"];
		
		$this->db->prepare("INSERT INTO food_menu($columns) VALUES($values);")->execute();
		unset($_POST['addFoodButton']);
		$_POST['addFoodButton'] = array();
		return $this->db->lastInsertId();
	}
	public function currentDeliveries($restaurant){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE restaurant_id = $restaurant AND STATUS = 'ORDERED' AND delivery_status = 'ORDER_DISPATCHED'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function scheduledDeliveries($restaurant){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE restaurant_id = $restaurant AND STATUS = 'ORDERED' AND delivery_status = 'SCHEDULED_DELIVERY' OR delivery_status = 'AT_RESTAURANT'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function menuView($restaurant){
		return $this->db->query("SELECT * FROM menu_view WHERE restaurant_id = $restaurant")->fetchAll(PDO::FETCH_ASSOC);	
	}
	public function prevDeliveries($restaurant){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE restaurant_id = $restaurant AND STATUS = 'PREV_DELIVERY'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function createPreDispatch($odr_id){
		return $this->db->prepare("UPDATE delivery_order SET STATUS = 'PRE_DISPATCH' WHERE order_id = $odr_id")->execute();
	}
	public function selectPreDispatch($restaurant){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE restaurant_id = $restaurant AND  STATUS = 'PRE_DISPATCH'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function verifyDeliveryID($id_num, $del_id){
		
		$st = $this->db->prepare("SELECT delivery_person_id FROM delivery_people WHERE id_number = :i_id AND delivery_person_id = :d_id");
		$st->execute(array(
		':i_id' => $id_num,
		':d_id' => $del_id
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData ==1){
			return $data['delivery_person_id'];
		}else{
			return 0;
		}
	}
	public function dispatch($restaurant){
		return $this->db->prepare("UPDATE delivery_order SET delivery_status = 'ORDER_DISPATCHED', STATUS = 'ORDERED' WHERE STATUS = 'PRE_DISPATCH' AND restaurant_id = $restaurant")->execute();
	}
	public function unSelectPreDispatch($restaurant){
		return $this->db->prepare("UPDATE delivery_order SET STATUS = 'ORDERED' WHERE STATUS = 'PRE_DISPATCH' AND restaurant_id = $restaurant")->execute();
	}
	public function deliveryPositionLatitude($id_pos){
		$st = $this->db->prepare("SELECT latitude_cood FROM delivery_person_geolocation WHERE pos_id = :i_id");
		$st->execute(array(
		':i_id' => $id_pos
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData ==1){
			return $data['latitude_cood'];
		}else{
			return 0;
		}
	}
	public function deliveryPositionLongitude($id_pos){
		$st = $this->db->prepare("SELECT longitude_cood FROM delivery_person_geolocation WHERE pos_id = :i_id");
		$st->execute(array(
		':i_id' => $id_pos
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData ==1){
			return $data['longitude_cood'];
		}else{
			return 0;
		}	
	}
	public function selectEditedFood($r_id, $foodId){
		return $this->db->query("SELECT * FROM food_menu WHERE restaurant_id = $r_id AND food_id = $foodId")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function updateFoodMenu($food_id, $foodName, $price, $quantity, $category, $description){
		return $this->db->prepare("UPDATE food_menu SET food_name = $foodName, price = $price, quantity = $quantity, food_category = $category, food_description = $description WHERE food_id = $food_id")->execute();
	}
	public function selectFood($r_id, $foodId){
		return $this->db->query("SELECT * FROM menu_view WHERE restaurant_id = $r_id AND food_id = $foodId")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function notifyCustomer($Noti_title, $Noti_content, $noti_status, $noti_image, $cust_id){
		$columns = 'notification_title, notification_content, notification_status, notification_image, customer_id';
		$values = '\''.$Noti_title.'\', \''.$Noti_content.'\', \''.$noti_status.'\', \''.$noti_image.'\', '.$cust_id.'';
		$update = $this->db->prepare("INSERT INTO customer_notifications ($columns) VALUES($values);")->execute();
		if ($update==1) {
			return true;
		}else if ($update==0) {
			return false;
		}else{
			return null;
		}
	}
	public function getAccountID($_rest_id){
		$stmt = $this->db->query("SELECT user_account_id FROM restaurants WHERE restaurant_id = $_rest_id")->fetchAll(PDO::FETCH_ASSOC);
		return $stmt;
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
	public function newNotifications($_rest_id){
		return $this->db->query("SELECT notification_content, notification_id FROM restaurant_notifications WHERE restaurant_id = $_rest_id AND notification_status = 'NOT_VIEWED'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function makeNotificationsReadStatus($noti_id){
		return $this->db->prepare("UPDATE restaurant_notifications SET notification_status = 'VIEWED' WHERE notification_id = $noti_id")->execute();
	}
}

?>
