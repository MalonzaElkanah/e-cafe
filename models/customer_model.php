<?php
class Customer_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function addCustomer($customer){
		//Check User Existance
		$st = $this->db->prepare("SELECT account_id FROM user_accounts WHERE
		user_name = :u_name");
		$st->execute(array(
		':u_name' => '\''.$customer['user_name'].'\''
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData >=1){
			return "User Already Exists";
		}else{
			//add to user_account table
			$account_columns = 'user_name , password, user_role';
			$pwd = 'SHA1(\''.$customer['password'].'\')';
			$account_values = '\''.$customer['user_name'].'\', '.$pwd.', \'customer\'';
			$stmt = $this->db->prepare("INSERT INTO user_accounts($account_columns) VALUES($account_values);");
			$stmt->execute();
			$account_id = $this->db->lastInsertId();
			//add to customer table 
			if ($account_id>0) {
				$columns = 'first_name, second_name, id_number, email, phone_number, user_account_id';
			
				$values = '\''.$customer['first_name'].'\', \''.$customer['second_name'].'\', \''.$customer['id_number'].'\', \''.$customer['email'].'\', '.$customer['phone_number'].', '.$account_id.'';
				
				$stmt = $this->db->prepare("INSERT INTO customer($columns) VALUES($values);");
				$stmt->execute();
				return $this->db->lastInsertId();
			}
		}



		
		
	}
}

?>
