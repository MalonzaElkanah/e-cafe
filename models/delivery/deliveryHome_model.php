<?php
class DeliveryHome_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function loadDeliveryPerson($_id){
		$st = $this->db->prepare("SELECT * FROM delivery_people WHERE
		delivery_person_id = :per_id");
		$st->execute(array(
		':per_id' => $_id
		));
		return $st->fetch(PDO::FETCH_ASSOC);
	}
	public function loadScheduleDelivery($_id){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE STATUS = 'ORDERED' AND delivery_status = 'AT_RESTAURANT' OR delivery_status = 'SCHEDULED_DELIVERY' AND delivery_person_id = $_id;")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadCurrentDelivery($_id){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE delivery_status = 'ORDER_DISPATCHED' AND STATUS = 'ORDERED' AND delivery_person_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadPrevDeliveries($_id){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE delivery_status = 'ORDER_DELIVERED' AND delivery_person_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadMapNavigation($_id){
		return $this->db->query("SELECT * FROM delivery_person_geolocation WHERE delivery_person_id = $_id;")->fetchAll(PDO::FETCH_ASSOC);
	}

	public function createPreDelivery($odr_id){
		return $this->db->prepare("UPDATE delivery_order SET delivery_status = 'PRE_DELIVERY' WHERE order_id = $odr_id")->execute();
	}
	public function selectPreDelivery($_id){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE delivery_person_id = $_id AND  delivery_status = 'PRE_DELIVERY'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function verifyDeliveryID($id_num, $_id){
		
		$st = $this->db->prepare("SELECT customer_id FROM customer WHERE id_number = :i_id AND customer_id = :d_id");
		$st->execute(array(
		':i_id' => $id_num,
		':d_id' => $_id
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData ==1){
			return $data['customer_id'];
		}else{
			return 0;
		}
	}
	public function deliver($_id){
		return $this->db->prepare("UPDATE delivery_order SET delivery_status = 'ORDER_DELIVERED', STATUS = 'PREV_DELIVERY' WHERE delivery_status = 'PRE_DELIVERY' AND delivery_person_id = $_id")->execute();
	}
	public function notifyCustomer($Noti_title, $Noti_content, $noti_status, $noti_image, $cust_id, $odr_id){
		$columns = 'notification_title, notification_content, notification_status, notification_image, customer_id, order_id';
		$values = '\''.$Noti_title.'\', \''.$Noti_content.'\', \''.$noti_status.'\', \''.$noti_image.'\', '.$cust_id.', '.$odr_id.'';
		$update = $this->db->prepare("INSERT INTO customer_notifications ($columns) VALUES($values);")->execute();
		if ($update==1) {
			return true;
		}else if ($update==0) {
			return false;
		}else{
			return null;
		}
	}

	public function getAccountID($_id){
		$stmt = $this->db->query("SELECT user_account_id FROM delivery_people WHERE delivery_person_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
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
	public function newNotifications($_id){
		return $this->db->query("SELECT notification_content, notification_id FROM delivery_person_notifications WHERE delivery_person_id = $_id AND notification_status = 'NOT_VIEWED'")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function makeNotificationsReadStatus($noti_id){
		return $this->db->prepare("UPDATE delivery_person_notifications SET notification_status = 'VIEWED' WHERE notification_id = $noti_id")->execute();
	}
	public function updateLocation($_id, $lati_cood, $longi_cood){
		return $this->db->prepare("UPDATE delivery_person_geolocation SET latitude_cood = $lati_cood, longitude_cood = $longi_cood WHERE delivery_person_id = $_id")->execute();
	}
}

?>
