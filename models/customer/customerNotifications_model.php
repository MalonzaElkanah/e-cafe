<?php
class CustomerNotifications_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function loadAllNotifications($_id){

		return $this->db->query("SELECT * FROM customer_notifications WHERE customer_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadProfile($_id){

		return $this->db->query("SELECT * FROM customer WHERE customer_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
