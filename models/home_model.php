<?php
class Home_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function getMenu(){
		return $this->db->query("SELECT * FROM menu_view;")->fetchAll(PDO::FETCH_ASSOC);
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
}