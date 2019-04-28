<?php
class RestaurantNotifications_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function loadAllNotifications($_id){

		return $this->db->query("SELECT * FROM restaurant_notifications WHERE restaurant_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadDistinctMessages($m_index){
		$myMessoData = [];
		$num = 0;
		foreach ($m_index as $message_id) {
			$_id = $message_id[$num];
			
			$status = $this->db->query("SELECT STATUS FROM message_controller WHERE message_index = $_id")->fetchAll(PDO::FETCH_ASSOC);
			if ($status['STATUS']=='RESTAURANT') {
				$myMessoData[$num] = $this->db->query("SELECT * FROM restaurants WHERE message_index = $_id")->fetchAll(PDO::FETCH_ASSOC);
			}else if ($status['STATUS']=='CUSTOMER') {
				$myMessoData[$num] = $this->db->query("SELECT * FROM customer WHERE message_index = $_id")->fetchAll(PDO::FETCH_ASSOC);;
			}else if ($status['STATUS']=='DELIVERY_PERSON') {
				$myMessoData[$num] = $this->db->query("SELECT * FROM delivery_people WHERE message_index = $_id")->fetchAll(PDO::FETCH_ASSOC);
			}
			$num++;
		}
		return $myMessoData;
	}
	public function loadDistinctMessageView($messageView, $m_index){
		$myMesso = [];
		$num = 0;
		foreach ($messageView as $message_id) {
			$_id = $message_id[$num];
			$myMesso[$num] = $this->db->query("SELECT TOP 1 * FROM messages WHERE message_from = $_id AND message_to = $m_index OR message_to = $_id AND message_from = $m_index order by message_id desc")->fetchAll(PDO::FETCH_ASSOC);
			$num++;
		}
		return $myMesso;
	}
	public function loadProfile($_id){

		return $this->db->query("SELECT * FROM restaurants WHERE restaurant_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function currentDeliveries($restaurant){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE restaurant_id = $restaurant")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function menuView($restaurant){
		return $this->db->query("SELECT * FROM menu_view WHERE restaurant_id = $restaurant")->fetchAll(PDO::FETCH_ASSOC);	
	}
	public function prevDeliveries($restaurant){
		return $this->db->query("SELECT * FROM delivery_order_view WHERE restaurant_id = $restaurant")->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
