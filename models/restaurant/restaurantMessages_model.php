<?php
class RestaurantMessages_Model extends Base_Model{
	public function __construct(){
		parent::__construct();
	}
	public function checkMessageIndex($r_id){
		$stmt = $this->db->query("SELECT message_index FROM restaurants WHERE restaurant_id = $r_id");
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$hasData = $stmt->rowCount();
		$k =0;
		//$data['message_index'];
		if (is_null($data['message_index'])) {
			$status = "RESTAURANT";
			$columns = 'STATUS';
			$values =' \''.$status.'\'';
			$stmnt = $this->db->prepare("INSERT INTO message_controller($columns) VALUES($values);");
			$stmnt->execute();
			$newIndex = $this->db->lastInsertId();
			$stm = $this->db->prepare("UPDATE restaurants SET message_index = $newIndex WHERE restaurant_id = $r_id");
			$stm->execute();

			$message_index = $this->db->query("SELECT message_index FROM restaurants WHERE restaurant_id = $r_id")->fetchAll(PDO::FETCH_ASSOC);
			foreach ($message_index as $m_index) {
				return $m_index;
			}
		}else {
			return $data['message_index'];
		}	
	}
	public function loadAllMessages($_id){

		return $this->db->query("SELECT distinct message_from, message_to FROM messages WHERE message_from = $_id OR message_to = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadDistinctMessages($messageView, $m_index){
		$_id = $messageView;
		$st = $this->db->prepare("SELECT * FROM all_messages_view WHERE message_from = :n_id AND message_to = :r_index OR message_to = :n_id AND message_from = :r_index order by message_id desc LIMIT 1");
		$st->execute(array(
		':n_id' => $_id,
		':r_index' => $m_index
		));
		$data = $st->fetch(PDO::FETCH_ASSOC);
		$hasData = $st->rowCount();
		if($hasData ==1){
			return $data;
		}else{
			return null;
		}
	}
	public function loadProfile($_id){

		return $this->db->query("SELECT * FROM restaurants WHERE restaurant_id = $_id")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function loadChat($m_index, $m_index2){

		return $this->db->query("SELECT * FROM all_messages_view WHERE message_from = $m_index AND message_to = $m_index2 OR message_to = $m_index AND message_from = $m_index2")->fetchAll(PDO::FETCH_ASSOC);
	}
	public function sendMyMessage($message, $recipient_id, $sender_id){
		$my_message_id = $sender_id;
		$status = "UNREAD";
		$columns = 'message_from, message_to, message, timestamp, time, date, STATUS';
		$values = $my_message_id.', '.$recipient_id.', \''.$message.'\', NOW(), CURTIME(), CURDATE(), \''.$status.'\'';

		echo $columns+"..."+$values;
		$stmnt = $this->db->prepare("INSERT INTO messages($columns) VALUES($values);");
		$stmnt->execute();
		$newIndex = $this->db->lastInsertId();
		return $newIndex;
	}
}

?>
