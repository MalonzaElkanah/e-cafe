<?php
class Menu_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function addStudent($student){
		ksort($student);
		$columns = implode(',', array_keys($student));
		$values = ':' . implode(', :', array_keys($student));
		$stmt = $this->db->prepare("INSERT INTO students
		($columns) VALUES($values);");
		foreach($student as $key=>$value){
			$stmt->bindValue(":$key", $value);
		}
		$stmt->execute();
		return $this->db->lastInsertId();
	}
	//ADDD
	public function getMenu(){
		return $this->db->query("SELECT * FROM food_menu;")->fetchAll(PDO::FETCH_ASSOC);
	}
}