<?php

class RestaurantMessages extends Base_Controller{
	public function __construct(){
		parent::__construct();
		$this->loadInnerModel("restaurant/restaurantMessages");
		
	}
	public function allMessages(){
		$message_index = $this->model->checkMessageIndex($_SESSION["restaurantid"]);
		$num = 0;
		$messageView = [];
		$messageData = [];
		$this->view->profile_data = $this->model->loadProfile($_SESSION["restaurantid"]);
		$all_messages = $this->model->loadAllMessages($message_index);
		$m_index = $message_index;
		foreach ($all_messages as $messo_id) {
			$n =0;
			$send = $messo_id['message_to'];
			$recieved = $messo_id['message_from'];
			if ($send!=$message_index ) {
				for ($i=0; $i < $num; $i++) { 
					if ($i==0) {
						$messageView[$num] = $send;
						$messageData[$num] = $this->model->loadDistinctMessages($send, $m_index);
						$num++;
					}else{
						if ($messageView[$i]==$send) {
							$n++;
						}
					}
				}
				if ($n==0) {
					$messageView[$num] = $send;
					$messageData[$num] = $this->model->loadDistinctMessages($send, $m_index);
					$num++;
				}
			}elseif ($recieved !=$message_index) {
				//var_dump($recieved);
				for ($i=0; $i < $num; $i++) { 
					if ($i==0) {
						$messageView[$num] = $recieved;
						$messageData[$num] = $this->model->loadDistinctMessages($recieved, $m_index);
						$num++;
					}else{
						if ($messageView[$i]==$recieved) {
							$n++;
						}
					}
				}
				if ($n==0) {
					$messageView[$num] = $recieved;
					$messageData[$num] = $this->model->loadDistinctMessages($recieved, $m_index);
					$num++;
				}
			}
		}
		$this->view->messageIndex_data = $messageView;
		//var_dump($messageData);
		$this->view->message_view_data = $messageData;//$this->model->loadDistinctMessageView($messageView, $message_index);
		$this->view->innerRenderView('restaurant/restaurantMessages');
	}
	public function myChat(){
		if(isset($_GET['CHAT_ID'])){
			$message_index = $this->model->checkMessageIndex($_SESSION["restaurantid"]);
			$message_index2 = $_GET['CHAT_ID'];
			$this->view->chat_name = $_GET['CHAT_NAME'];
			$this->view->chat_messages = $this->model->loadChat($message_index, $message_index2);
			//var_dump($this->view->chat_messages);
			$this->view->innerRenderView('restaurant/chat');
		}
	}
	public function sendMessage(){
		if (isset($_POST['MESSAGE'])) {
			$message = $_POST['MESSAGE'];
			$recipient_id = $_POST['Reciever'];
			$message_index = $this->model->checkMessageIndex($_SESSION["restaurantid"]);
			$messageStatus = $this->model->sendMyMessage($message, $recipient_id, $message_index) ;
			echo "last insert id: ".$messageStatus;
		}
	}
}

?>

