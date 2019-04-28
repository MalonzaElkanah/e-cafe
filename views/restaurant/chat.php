<style type="text/css">
	#chatHeader{
		background-color: #e7e7e7;
		color: maroon;
		border: 1px solid #d7d7d7;
		text-align: center;
		height: 50px;
	}
	#chatMessages{
		background-color: white;
		color: black;
		height: 400px;
		border: 1px solid #e7e7e7;
		overflow-y: scroll; 
	}
	#backToMessages{
		height: 40px;
		width: 40px;
	}
	#chat_row{
		background-color: white;
	}
	.profilePicture{
		padding-top: 3px;
		padding-left: 10px;
	}
	.chatProfileImage{
		padding:3px;
		height: 50px;
		width: 50px; 
		border: 2px solid cyan; 
		background-color: #f3f3f3;
		border-radius: 50%;
		border: 1px solid #e7e7e7
	}
	.chat{
		text-align: left;
		padding-top: 10px;
	}
	.chatPadding{
		width: 20%;
		float: left;
	}
	.chatMessage{
		max-width: 80%;
		min-width: 10%;
		float: left;
		border-radius: 20px;
		border: 0px solid black;
		background-color: #f3f3f3;
	}
	.chatMessage p{
		padding-top: 10px;
		padding-left: 10px;
		padding-right: 10px;
	}
	#replyDiv{
		height: 100px;
		background-color: #f3f3f3;
		color: black;
		border: 1px solid #e7e7e7;
	}
	#replyTextbox{
		width:100%; 
		background: white; 
		border-radius:30px; 
		height: auto !important; 
		min-height: 40px;
		padding-left: 20px;
	}
</style>

<div class="row">
	<div class="row" id="chatHeader">
		<div class="one column" style="padding-top: 5px;">
			<a href="#" id="backToAllMessages">
				<img alt="close" src="/e-cafe/assets/images/backIcon.png" class="closeIcon" id="backToMessages">
			</a>	
		</div>
		<div class="eleven columns" style="padding-top: 5px;">
			<h5><?php echo $this->chat_name; ?></h5>
		</div>
	</div>
	
	<div class="row" id="chatMessages" >
		<?php 
			$i=0;
			foreach($this->chat_messages as $chat):
			$senderName = "";
			$senderPic = "";
			$senderID = "";
			$restaurant = false;
			if($chat['sender_status']=="CUSTOMER"){
				$senderName = $chat['c_first_name']." ".$chat['c_second_name'];
				$senderPic = $chat['c_profile_picture'];
				$senderID = $chat['c_message_index'];
			}else if($chat['sender_status']=="DELIVERY_PERSON"){
				$senderName = $chat['d_first_name']." ".$message['d_second_name'];
				$senderPic = $chat['d_profile_picture'];
				$senderID = $chat['d_message_index'];
			}else if($chat['sender_status']=="RESTAURANT"){
				$restaurant = true;
			}
			$i++;
		?>
			<?php if($restaurant == false):?>
				<div class="row chat_row" id="chat<?= $i?>" value="<?= $senderID?>"> 
					<div class="one column profilePicture"> 
						<img  src="<?= $senderPic?>" class="chatProfileImage">
					</div>
					<div class="eleven columns chat">
						<div class="row">
							<div class="chatMessage">
								<p style="font-size: 17px;"><?= $chat['message']?></p>
							</div>
							<div class="chatPadding">
								<p> </p>
							</div>
						</div>	
					</div>
				</div>
			<?php elseif($restaurant == true):?>
				<div class="row chat_row" id="chat<?= $i?>" value="<?= $senderID?>"> 
					<div class="twelve columns chat">
						<div class="row">
							<div class="chatMessage" style="float: right; background-color: #3399ff; color: white;">
								<p style="font-size: 17px;"><?= $chat['message']?></p>
							</div>
							<div class="chatPadding" style="float: right;">
								<p> </p>
							</div>
						</div>	
					</div>
				</div>
			<?php endif;?>
		<?php endforeach;?>
	</div>
	<div class="row" id="replyDiv">
		<div class="two columns"><h4> </h4> </div>
		<div class="seven columns">
			<div style="padding-left: 10px; padding-top: 20px;">
				<textarea rows="1" id="replyTextbox" placeholder="REPLY"></textarea> 
			</div>
			
		</div>
		<div class="three columns">
			<div style="padding-top: 20px;">
				<a id="replyButton" href="#">
					<img src="/e-cafe/assets/images/send.png" style="width: 40px; height: 40px;">
				</a> 
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$("#replyButton").click(function(event){
			event.preventDefault();
			var message = $("#replyTextbox").val().trim();
			if (message=="") {
				alert("Blank Message Box");
			}else{
				var id=$("#chat1").attr("value");
				$.post("messages.php",
			    {
			        MESSAGE: message,
			        Reciever: id
			    },
			    function(data, status){
			        alert("Message Send");
			        $("#replyTextbox").val("");
			    });	
			}	
		});

		$("#backToAllMessages").click(function(event){
			event.preventDefault();
			window.location.href = "messages.php";	
		});
	});
</script>