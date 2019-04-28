<?php
class Delivery_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function addDeliveryPersonel($person){
		//add to user_account table
		$account_columns = 'user_name , password, user_role';
		$pwd = 'SHA1(\''.$person['password'].'\')';
		$account_values = '\''.$person['user_name'].'\', '.$pwd.', \'delivery_person\'';
		$stmt = $this->db->prepare("INSERT INTO user_accounts($account_columns) VALUES($account_values);");
		$stmt->execute();
		$account_id = $this->db->lastInsertId();
		//add to customer table 
		if ($account_id>0) {
			$columns = 'first_name, second_name, id_number, e_mail, phone_number, delivery_means, county, town, user_account_id';
		
			$values = '\''.$person['first_name'].'\', \''.$person['second_name'].'\', \''.$person['id_number'].'\', \''.$person['email'].'\', '.$person['phone_number'].', \''.$person['delivery_means'].'\', \''.$person['county'].'\', \''.$person['town'].'\', '.$account_id.'';
			
			$stmt = $this->db->prepare("INSERT INTO delivery_people($columns) VALUES($values);");
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
