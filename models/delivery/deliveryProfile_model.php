<?php
class DeliveryProfile_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function loadProfile($_id){

		return $this->db->query("SELECT * FROM delivery_people WHERE delivery_person_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function newProfile($newProfile){
		$coverName = null;
		$profileName = null;
		$file = $_FILES['coverToUpload']['name'];
		//$newProfile["coverToUpload"]!=null
		if (isset($file)) {
			if (!empty($file)) {
				$cover_dir = "../assets/coverPhotos/";
				$cover_file = $cover_dir.basename($_FILES["coverToUpload"]["name"]); //coverToUpload
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($cover_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["coverToUpload"]["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			    // Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["coverToUpload"]["tmp_name"], $cover_file)) {
				        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				        $coverName = $cover_file;
				    } else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
			}
		}
		$file1 = $_FILES['profileToUpload']['name'];
		if (isset($file1)) {
			if (!empty($file1)) {
				$profile_dir = "../assets/profilePictures/";
				$profile_file = $profile_dir.basename($_FILES["profileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($profile_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				$check = getimagesize($_FILES["profileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			    // Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
				    if (move_uploaded_file($_FILES["profileToUpload"]["tmp_name"], $profile_file)) {
				        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				        $profileName = $profile_file;
				    } else {
				        echo "Sorry, there was an error uploading your file.";
				    }
				}
			}
		}
		if ($newProfile["user_name"]!=null) {
			echo "string3";
		}
		$set = '';
		$parameter = $_SESSION["deliverypersonid"];

		if ($profileName!=null && $coverName!=null) {
			$set = 'first_name = \''.$newProfile['first_name'].'\', second_name = \''.$newProfile['second_name'].'\', description = \''.$newProfile['my_bio'].'\', phone_number = '.$newProfile['phone_number'].', county = \''.$newProfile['county'].'\', town = \''.$newProfile['town'].'\', profile_picture = \''.$profileName.'\', cover_photo = \''.$coverName.'\'';	
		}elseif ($profileName!=null && $coverName==null) {
			$set = 'first_name = \''.$newProfile['first_name'].'\', second_name = \''.$newProfile['second_name'].'\', description = \''.$newProfile['my_bio'].'\', phone_number = '.$newProfile['phone_number'].', county = \''.$newProfile['county'].'\', town = \''.$newProfile['town'].'\', profile_picture = \''.$profileName.'\'';
		}elseif ($profileName==null && $coverName!=null) {
			$set = 'first_name = \''.$newProfile['first_name'].'\', second_name = \''.$newProfile['second_name'].'\', description = \''.$newProfile['my_bio'].'\', phone_number = '.$newProfile['phone_number'].', county = \''.$newProfile['county'].'\', town = \''.$newProfile['town'].'\', cover_photo = \''.$coverName.'\'';
		}else{
			$set = 'first_name = \''.$newProfile['first_name'].'\', second_name = \''.$newProfile['second_name'].'\', description = \''.$newProfile['my_bio'].'\', phone_number = '.$newProfile['phone_number'].', county = \''.$newProfile['county'].'\', town = \''.$newProfile['town'].'\'';
		}
		

		//RESET PASSWORD
		if (isset($newProfile['user_name'])&&isset($newProfile['new_password'])) {
			echo "CHECK 1: reset new password";
			if ($newProfile['user_name']!=""&&$newProfile['new_password']!="") {
				echo "CHECK 1.1: !empty reset password input textbox";
				$acc_id = $this->db->query("SELECT user_account_id FROM delivery_people WHERE delivery_person_id = $parameter")->fetchAll(PDO::FETCH_ASSOC);
				$newPswd = 'SHA1(\''.$newProfile['new_password'].'\')';
				$set1 = 'password = \''.$newPswd.'\'';
				$this->db->prepare("UPDATE user_accounts SET $set1 WHERE account_id = $acc_id")->execute();
			}
		}
		//NEW RESTAURANT LOCATION
		if (isset($newProfile['pos_name'])&&isset($newProfile['latitude_cood'])&&isset($newProfile['longitude_cood'])) {
			if (!$newProfile['pos_name']==""&& !$newProfile['latitude_cood']==""&& !$newProfile['longitude_cood']=="") {
				$set2 ='';
				$values = '';
				$row = '';
				if (!$newProfile['accuracy']=="" && !$newProfile['altitude']=="" && !$newProfile['altitude_accuracy']=="") {
					$set2 ='pos_name = \''.$newProfile['pos_name'].'\', latitude_cood = '.$newProfile['latitude_cood'].', longitude_cood = '.$newProfile['longitude_cood'].', accuracy = '.$newProfile['accuracy'].', altitude = '.$newProfile['altitude'].', altitude_accuracy = '.$newProfile['altitude_accuracy'].'';

					$values = ' \''.$newProfile['pos_name'].'\', '.$newProfile['latitude_cood'].', '.$newProfile['longitude_cood'].', '.$newProfile['accuracy'].', '.$newProfile['altitude'].', '.$newProfile['altitude_accuracy'].', '.$parameter.'';
					$row = 'pos_name, latitude_cood, longitude_cood, accuracy, altitude, altitude_accuracy, delivery_person_id';
				}else if (!$newProfile['accuracy']=="" && $newProfile['altitude']=="") {
					$set2 ='pos_name = \''.$newProfile['pos_name'].'\', latitude_cood = '.$newProfile['latitude_cood'].', longitude_cood = '.$newProfile['longitude_cood'].', accuracy = '.$newProfile['accuracy'].'';

					$values = ' \''.$newProfile['pos_name'].'\', '.$newProfile['latitude_cood'].', '.$newProfile['longitude_cood'].', '.$newProfile['accuracy'].', '.$parameter.'';
					$row = 'pos_name, latitude_cood, longitude_cood, accuracy, delivery_person_id';
				}else if ($newProfile['accuracy']=="" && !$newProfile['altitude']=="") {
					$set2 ='pos_name = \''.$newProfile['pos_name'].'\', latitude_cood = '.$newProfile['latitude_cood'].', longitude_cood = '.$newProfile['longitude_cood'].', altitude = '.$newProfile['altitude'].'';

					$values = ' \''.$newProfile['pos_name'].'\', '.$newProfile['latitude_cood'].', '.$newProfile['longitude_cood'].', '.$newProfile['altitude'].', '.$parameter.'';
					$row = 'pos_name, latitude_cood, longitude_cood, altitude, delivery_person_id';
				}else {
					$set2 ='pos_name = \''.$newProfile['pos_name'].'\', latitude_cood = '.$newProfile['latitude_cood'].', longitude_cood = '.$newProfile['longitude_cood'].'';

					$values = ' \''.$newProfile['pos_name'].'\', '.$newProfile['latitude_cood'].', '.$newProfile['longitude_cood'].', '.$parameter.'';
					$row = 'pos_name, latitude_cood, longitude_cood, delivery_person_id';
				}
				$acc_id = $this->db->query("SELECT pos_id FROM delivery_person_geolocation WHERE delivery_person_id = $parameter")->fetchAll(PDO::FETCH_ASSOC);
				if ($acc_id==null) {
					$this->db->prepare("INSERT INTO delivery_person_geolocation($row) VALUES($values)")->execute();
				}else{
					$this->db->prepare("UPDATE delivery_person_geolocation SET $set2 WHERE delivery_person_id = $parameter")->execute();
				}
			}
		}


		return $this->db->prepare("UPDATE delivery_people SET $set WHERE delivery_person_id = $parameter")->execute();
	}
}

?>
