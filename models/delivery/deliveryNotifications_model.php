<?php
class DeliveryNotifications_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function loadAllNotifications($_id){

		return $this->db->query("SELECT * FROM delivery_person_notifications WHERE delivery_person_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadProfile($_id){

		return $this->db->query("SELECT * FROM delivery_people WHERE delivery_person_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
