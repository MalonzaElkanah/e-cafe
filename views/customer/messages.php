<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0"/>
	<script src= /e-cafe/assets/js/jquery.js ></script>
	

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<link href="/e-cafe/assets/css/normalize.css" rel="stylesheet" type="text/css"/>
	<link href="/e-cafe/assets/css/skeleton.css" rel="stylesheet" type="text/css"/>
	<link href="/e-cafe/assets/css/style.css" rel="stylesheet" type="text/css"/>
	
	<title>My Messages</title>

	<style type="text/css">
		#navigation{
			height: 50px;
			padding-top: 20px;
			padding-bottom: 20px;
			border: 1px solid #e7e7e7;
	    	background-color: #f3f3f3;
			text-align: center;
		}
		#navigation a {
			text-decoration: none;
			color: black;

		}
		#restaurantlogo{
			font-size: 40px;
			text-align: center;
			font-family: forte;
		    color: maroon;
		}
		#restaurantlogo a{
			font-size: 40px;
			text-align: center;
			font-family: forte;
		    color: maroon;
		}
		#sidenav{
			display: block;
			border: 1px solid #b7b7b7;
			color: #6a6c70; 
			background-color: #2d3035;
			height: 1200px;
			margin-left: 0%;
		}
		#content{
			background-color: white;
			border: 0px solid #e7e7e7;
			height: 100%;
		}
		#homecontent{
			border: 0px solid #e7e7e7;
			height: 100%;	
		}
		#miniprofile{
			height: 100px;
			padding-top: 25px;
			padding-left: 25px;

		}
		#profilepic{
		    width: 60px;
	    	height: 60px;
		    border-radius: 50%;
		    overflow: hidden;
		    margin-right: 15px;
		    background: #6a6c70;
		    padding: 4px;
		    border: 3px solid #282b2f;
		}
		#proileicon{
			width: 60px;
	    	height: 60px;
		    border-radius: 50%;
		}
		#profilename{
			padding-top: 10px;
			border: 0px solid black;
			height: 60px;
			text-align: center;
			color: #6a6c70; 
		}
		#maintitle{
			
			background-color: #2d3035;
			height: 30px;
			
			font-weight: bold;
		}
		#maintitle h6{
			font-weight: 700;
		    margin-left: 20px;
		    color: #494d53;
		    font-size: 1.2rem;
		    margin-bottom: 15px
		}
		#extrastitle{
			background-color: #2d3035;
			height: 30px;
			
			font-weight: bold;
		}
		#extrastitle h6{
			font-weight: 700;
		    margin-left: 20px;
		    color: #494d53;
		    font-size: 1.2rem;
		    margin-bottom: 15px
		}
		#homenav{
			/*border-bottom: 1px solid maroon;
			/*border: 1px solid #b7b7b7;*/
			height: 50px;
		}
		#sidebaricon{
			height: 30px;
			width: 60px;
			border-right: 1px solid #6a6c70;
			padding-left: 15px;
		}
		#sidenavname{
			padding-left: 5px;
			padding-top: 5px;
		}
		#extranav{
			/*border-bottom: 1px solid maroon;
			border: 1px solid #b7b7b7;*/
			height: 50px;
		}
		#homeHeader{
			padding-top: 20px;
			padding-bottom: 20px;
			text-align: center;
			height: 30px;
			color: maroon;
			
		}
		.message_row{
			height: 100px;
			border-top: 2px solid #e7e7e7;
			background-color: #f3f3f3;
			text-align: left;
		}
		.profilePicture{
			padding-top: 3px;
			padding-left: 10px;
		}
		.profileImage{
			padding:3px;
			height: 80px;
			width: 80px; 
			border: 2px solid cyan; 
			background-color: #f3f3f3;
			border-radius: 50%;
			border: 1px solid #e7e7e7
		}
		.message{
			text-align: left;
			padding-left: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<!-- Navigation area  &nbsp; -->

		<div class="row" id="navigation">
			<div class="three columns" id="restaurantlogo">
				<div class="one column">
					<img alt="" src="/e-cafe/assets/images/sidenavicon.png" id="sidenavicon" style="width: 25px; height:25px; padding-left: 5px" >
				</div>
				<div class="ten columns">
					<a href="#" >E-CAFE</a>
				</div>
			</div>
			<div class="five columns"> <p> </p></div>
			<div class="four columns">
				<div class="two columns">
					<img alt="" src="/e-cafe/assets/images/search.png" id="search" style="width: 25px; height:25px; padding-left: px" >
				</div>
				<div class="two columns">
					<a href="notifications.php">
						<img alt="" src="/e-cafe/assets/images/notificationIcon.png" id="notificationicon" style="width: 25px; height:25px;" >
					</a>
				</div>
				<div class="two columns">
					<a href="messages.php">
						<img alt="" src="/e-cafe/assets/images/messageicon.png" id="messageicon" style="width: 25px; height:25px; " >
					</a>
				</div>
				<div class="six columns">
					<?php if(Session::get("loggedin")): ?>
						<p class="iblk log">
							<?php echo ' '.$_SESSION["username"].' | '; ?> 
							<a href=<?= BASE_URL."login.php?exitId=0"?>>Logout</a>
						</p>
					<?php endif;?> 
				</div>
			</div>
		</div>

		<!-- Navigation area ends &nbsp; -->
		<?php foreach($this->profile_data as $profile): 
			$profilePic = null;
			$coverPic = null;
			if($profile['profile_picture']==null){
				$profilePic = "/e-cafe/assets/profilePictures/default.png";
			}else{
				$profilePic = $profile['profile_picture'];
			}

			if($profile['cover_photo']==null){
				$coverPic = "/e-cafe/assets/coverPhotos/default.png";
			}else{
				$coverPic = $profile['cover_photo'];
			}
		?>
		<!-- SideBar area Bigins &nbsp; -->	

			<div class="three columns" id="sidenav">
				<div class="twelve columns" id="miniprofile">
					<div class="four columns" id="profilepic">
						<img alt="add food" src="<?= $profilePic?>" title="profile pic" id="proileicon">
					</div>
					<div class="seven columns" id="profilename">
						<div class="twelve columns" >
							<h7 style ="font-weight: bold;">
							<?php 
								echo' '.$_SESSION["customer_name"];
							?>
							
							</h7> 
						</div>
						<div class="twelve columns" ><h7>restaurant category</h7>  </div>
					</div>
				</div>	
				<div class="twelve columns" id="maintitle">
					<h6>MAIN</h6>
				</div>
				<div class="twelve columns" id="homenav">
					<a href="index.php" style="text-decoration: none;">
						<div class="two columns" id="sidebaricon">
							<img alt="add food" src="/e-cafe/assets/images/homeicon.png" title="home" id="homeicon" style="width: 30px; height:30px;">
						</div>
						<div class="eight columns" id="sidenavname"> <h8>Home</h8></div>
					</a>
				</div>
				<div class="twelve columns" id="homenav">
					<a href="profile.php" style="text-decoration: none;">
						<div class="two columns" id="sidebaricon">
							<img alt="add food" src="/e-cafe/assets/images/profileicon.png" title="profile" id="homeicon" style="width: 30px; height:30px;">
						</div>
						<div class="eight columns" id="sidenavname"> <h8>Profile</h8></div>
					</a>
				</div>	
				<div class="twelve columns" id="homenav">
					<div class="two columns" id="sidebaricon">
						<img alt="add food" src="/e-cafe/assets/images/statsicon.png" title="profile" id="homeicon" style="width: 30px; height:30px;">
					</div>
					<div class="eight columns" id="sidenavname"> <h8>Statistics</h8></div>
				</div>
				<div class="twelve columns" id="homenav"></div>	
				<div class="twelve columns" id="homenav"></div>
				<div class="twelve columns" id="extrastitle">
					<h6>EXTRAS</h6>
				</div>
				<div class="twelve columns" id="extranav">
					<div class="two columns" id="sidebaricon">
						<img alt="add food" src="/e-cafe/assets/images/settingsicon.png" title="settings" id="settingsicon" style="width: 30px; height:30px;">
					</div>
					<div class="eight columns" id="sidenavname"> <h8>Settings</h8> </div>
				</div>
				<div class="twelve columns" id="extranav"></div>	
				<div class="twelve columns" id="extranav"></div>			
			</div>
		<!-- Sidebar area ends &nbsp;  style="background-image:url('/e-cafe/assets/images/burger.png'); "-->
		<div class="nine columns" id="homecontent">
			<div class="row" id="homeHeader">
				<h3> MY MESSAGES</h3>
			</div>

			<?php 
				$i=0;
				foreach($this->message_view_data as $message):
				$senderName = "";
				$senderPic = "";
				$senderID = "";
				if($message['sender_status']=="RESTAURANT"){
					$senderName = $message['restaurant_name'];
					$senderPic = $message['r_profile_picture'];
					$senderID = $message['r_message_index'];
				}else if($message['sender_status']=="DELIVERY_PERSON"){
					$senderName = $message['d_first_name']." ".$message['d_second_name'];
					$senderPic = $message['d_profile_picture'];
					$senderID = $message['d_message_index'];
				}else if($message['sender_status']=="CUSTOMER"){
					if($message['reciever_status']=="RESTAURANT"){
						$senderName = $message['restaurant_name'];
						$senderPic = $message['r_profile_picture'];
						$senderID = $message['r_message_index'];
					}else if($message['reciever_status']=="DELIVERY_PERSON"){
						$senderName = $message['d_first_name']." ".$message['d_second_name'];
						$senderPic = $message['d_profile_picture'];
						$senderID = $message['d_message_index'];
					}
				}
				$i++;
			?>
				<div class="row message_row" id="chat<?= $i?>" value="<?= $senderID?>">
					<div class="one column profilePicture"> 
						<img  src="<?= $senderPic?>" class="profileImage" style="">
					</div>
					<div class="eleven columns message" >
						<div class="row">
							<label id="chatName<?= $senderID?>" style="font-size: 20px; color: maroon;">
								<?= $senderName ?>		
							</label>
						</div>
						<div class="row">
							<p style="font-size: 17px;"><?= $message['message']?></p>
						</div>	
					</div>
				</div>
			<?php endforeach;?>
			<p style="display: none;" id="init"><?= $i?></p>
		</div>
		<div class="nine columns" id="myChat">
				
		</div>
		<?php endforeach;?>

	</div>
	<script type="text/javascript">
		//SIDE NAV BUTTON
		$(function(){
			$("#sidenavicon").click(function(){
				if($("#sidenav").css("display")==="block"){
  					$("#sidenav").css("display", "none");
  					$("#homecontent").removeClass("nine columns").addClass("twelve columns");
  				}else if($("#sidenav").css("display")==="none"){
  					$("#homecontent").removeClass("twelve columns").addClass("nine columns"); 
  					$("#sidenav").css("display", "block");
  				}
			});
		});
		//OPEN CHAT
		$(function(){
			var chatInit = $("#init").text();
			for (var i = chatInit; i > 0; i--) {
				var chatDiv = "#chat"+i+"";
				$(chatDiv).click(function(){
					var chatID = $(this).attr("value");
					var chatTitle = "#chatName"+chatID+"";
					var chatName = $(chatTitle).text();
					$.ajax({
						url: 'messages.php',
						method: 'GET',
						data: {
							CHAT_ID: chatID,
							CHAT_NAME: chatName
						},
						success: function(response){
							alert("zxcv:- "+response);
							$("#homecontent").css("display", "none");
							$("#myChat").css("display", "block");
							$("#myChat").html(response);
						},
						error: function(){
							alert("error"+url);
						}
					});
				});
			}
		});
		//CHECK USER ACTIVITY
		$(function(){
			setInterval(function(){
				checkActivity();
			}, 300000);
		});
	</script>
	<script type="text/javascript" src="/e-cafe/assets/js/userActivity.js"></script>
</body>
</html>