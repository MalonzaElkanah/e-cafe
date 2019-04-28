<?php
class Restaurant_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function addRestaurant($restaurant){
		//add to user_account table
		$account_columns = 'user_name , password, user_role';
		$pwd = 'SHA1(\''.$restaurant['password'].'\')';
		$account_values = '\''.$restaurant['user_name'].'\', '.$pwd.', \'restaurant\'';
		$stmt = $this->db->prepare("INSERT INTO user_accounts($account_columns) VALUES($account_values);");
		$stmt->execute();
		$account_id = $this->db->lastInsertId();
		//add to restaurants table 
		if ($account_id>0) {
			$columns = 'restaurant_name, owner_name, owner_id_number, restaurant_email, restaurant_phone_number, county, town, location_description, user_account_id';
		
			$values = '\''.$restaurant['restaurant_name'].'\', \''.$restaurant['owner_name'].'\', \''.$restaurant['owner_id_number'].'\', \''.$restaurant['restaurant_email'].'\', '.$restaurant['restaurant_phone_number'].', \''.$restaurant['county'].'\', \''.$restaurant['town'].'\', \''.$restaurant['location_description'].'\', '.$account_id.'';
			
			$stmt = $this->db->prepare("INSERT INTO restaurants($columns) VALUES($values);");
			$stmt->execute();
			return $this->db->lastInsertId();
		}
		
	}
	//ADDD
	public function getRestaurant(){
		return $this->db->query("SELECT restaurant_name, restaurant_category, county, town FROM restaurants;")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadRestaurant(){
		return $this->db->query("SELECT restaurant_name, restaurant_category, county, town FROM restaurants;")->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>
