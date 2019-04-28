<?php
class Login_Model extends Base_Model{

	public function __construct(){
	parent::__construct();
	}
	public function login($username, $password){
		//$_GET['messo'] = "checkpoint:LOGIN";
		$st = $this->db->prepare("SELECT account_id, user_role FROM user_accounts WHERE
		user_name = :username AND password = :password");
		$st->execute(array(
		':username' => $username,
		':password' => SHA1($password)
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData >0 && isset($data['user_role'])){
			if ($data['user_role']=="restaurant") {
				$stmt = $this->db->prepare("SELECT restaurant_name, restaurant_id, profile_picture FROM restaurants WHERE
					user_account_id = :account_id");
				$stmt->execute(array(':account_id' => $data['account_id']));
				$restaurantData = $stmt->fetch(PDO::FETCH_ASSOC);
				$hasData = $stmt->rowCount();
				if($hasData >0){
					session_start();
					$_SESSION["loggedin"]=true;
					$_SESSION["restaurant_name"]="".$restaurantData['restaurant_name'];
					$_SESSION["restaurantid"]="".$restaurantData['restaurant_id'];
					$_SESSION["username"]="".$username;
					if ($restaurantData['profile_picture']==null) {
						$_SESSION["profile_pic"]="/e-cafe/assets/profilePictures/default.png";
					}else{
						$_SESSION["profile_pic"]="".$restaurantData['profile_picture'];
					}

					return $restaurantData['restaurant_id'];
				}else{
					return null;
				}
			}elseif ($data['user_role']=="customer") {
				$stmt = $this->db->prepare("SELECT first_name, second_name, customer_id FROM customer WHERE
					user_account_id = :account_id");
				$stmt->execute(array(':account_id' => $data['account_id']));
				$customerData = $stmt->fetch(PDO::FETCH_ASSOC);
				$hasData = $stmt->rowCount();
				if($hasData >0){
					session_start();
					$_SESSION["loggedin"]=true;
					$_SESSION["customer_name"]="".$customerData['first_name']." ".$customerData['second_name'];
					$_SESSION["customerid"]="".$customerData['customer_id'];
					$_SESSION["username"]="".$username;
					return $customerData['customer_id'];
				}else{
					return null;
				}
			}elseif ($data['user_role']=="delivery_person") {
				$stmt = $this->db->prepare("SELECT first_name, second_name, delivery_person_id FROM delivery_people WHERE
					user_account_id = :account_id");
				$stmt->execute(array(':account_id' => $data['account_id']));
				$deliveryPersonData = $stmt->fetch(PDO::FETCH_ASSOC);
				$hasData = $stmt->rowCount();
				if($hasData >0){
					session_start();
					$_SESSION["loggedin"]=true;
					$_SESSION["delivery_person_name"]="".$deliveryPersonData['first_name']." ".$deliveryPersonData['second_name'];
					$_SESSION["deliverypersonid"]= $deliveryPersonData['delivery_person_id'];
					$_SESSION["username"]="".$username;
					return $deliveryPersonData['delivery_person_id'];
				}else{
					return null;
				}
			}elseif($data['user_role']=="administretor"){
				return null;
			}else{
				return null;
			}
			
		}
		else{
			return null;
		}
	}
}