	
	<style type="text/css">
	#content{
		background-color: white;
		border: 0px solid #e7e7e7;
		height: 100%;
	}
	#homecontent{
		border: 0px solid #e7e7e7;
		height: 100%;	
	}
	
	#homeHeader{
		height: 30px;
		/*padding-top: 20px;
		padding-bottom: 20px;
		border: 0px solid #e7e7e7;
    	background-color: #f3f3f3;
		text-align: center;*/
	}
	#profilePicture{
		height: 220px;
		width: 220px; 
		/*border: 2px solid #e7e7e7; 
		/*float: none;
		margin: auto;
		float: left;*/
		text-align: center;
		background-color: #f3f3f3;
		border-radius: 50%;
		/*box-shadow: 0 0 50PX rgba(0,0,0,.5);*/
	}
	#profileImage{
		height: 220px;
		width: 220px; 
		border: 2px solid white; 
		text-align: center;
		background-color: #f3f3f3;
		border-radius: 50%;
	}
	#restaurantName{
		font-weight: bold; 
		font-size: 30px;
		color: maroon;
	}
	#editProfDiv{
		padding-top: 30px;
	}
	#editProfileButton{
		border: 1px solid cyan;
		color: cyan;
	}
	#myMenu{
		padding-top: 50px;
	}
	#menuTitle{
		text-align: center;
		font-size: 30px;
		padding-bottom: 25px;
		color: maroon;

	}
	#foodImage{
			padding-left: 10px;
			padding-top: 20px;
	}
	#foodDetails{

	}
	#foodName{
		padding-top: 5px;
		font-weight: bold;
		font-size: 20px;
		text-align: center;
		color: maroon; 
	}
	#restaurantName1{
		font-weight: bold;
		color: maroon; 

	}
	#foodPrice{
		font-weight: bold;
		color: maroon; 
	}
	.foodAction{
		padding-top: 10px;
	}
	#cartImage{
		padding-left: 10px;
	}
	.addToCart{
		background-color:maroon ;
		color:white ;
		font-size: 15px;
	}
	#likeImage, #infoImage{
		padding-right: 10px;
	}
	.lobibox.lobibox-window .lobibox-body {
	    overflow: auto;
	    display: block;
	    font-size: 14px;
	    padding: 0px;
	    /* background-color: #f5f8fd; */
	}
	.lobibox.lobibox-window .lobibox-header {
	    background-color: #17191c;
	    color: #eee;
	    font-size: 18px;
	    text-align: center;
	}
	.lobibox.lobibox-window {
		border: 0px solid #17191c;
		border-radius: 6px;
	}	
	</style>
	<div class="container">
		<div class="row" id="content">
		<?php foreach($this->restaurant_profile_data as $profile): 
			$profilePic = null;
			$coverPic = null;
			if($profile['profile_picture']==null){
				$profilePic = "/e-cafe/assets/profilePictures/default.png";
			}else{
				if ($this->home_data == true) {
					$profilePic = "assets/".$profile['profile_picture'];
				}else{
					$profilePic = $profile['profile_picture'];
				}
			}

			if($profile['cover_photo']==null){
				$coverPic = "/e-cafe/assets/coverPhotos/default.png";
			}else{
				if ($this->home_data == true) {
					$coverPic = "assets/".$profile['cover_photo'];
				}else{
					$coverPic = $profile['cover_photo'];
				}
			}
		?>
		
			<div class="twelve columns" id="homecontent">
				<!-- Profile and Cover area Begins &nbsp; -->
				<div class="row" style=" height: 220px; border: 1px solid #e7e7e7; 
					background-image:url('<?= $coverPic?>'); ">


					<div class="twelve columns" style=" height: 110px; border: 0px solid #e7e7e7; background: transparent;">
						
					</div>
					<div class="twelve columns" style=" border: 0px solid #e7e7e7;">
						<div class="one column"> </div>
						<div class="three columns" id="profilePicture"  >
							<img  src="<?= $profilePic?>" id="profileImage" style="">
						</div>
					</div>
				</div>
				<!-- Profile and Cover area ends &nbsp; -->	

				<!-- Profile Detail area Begins &nbsp; -->
				<div class="row" style="">
					<div class="one column">
						
					</div>
					<div class="three columns" style="text-align: center;">
						<div class="twelve columns" id="restaurantName" >
							<?= $profile['restaurant_name']?>
						</div>
						<div class="twelve columns" style="font-weight: ; font-size: 20px;">
							<?= $profile['restaurant_category']?> Restaurant
						</div>
					</div>
				</div>

				<div class="row" style=" padding-top: 50px;">
					<div class="one column">
						
					</div>
					<div class="eleven columns">
						<div class="twelve columns" style=""> 
							<label style=" float: left;"><?= $profile['restaurant_description']?></label>
						</div>
						
						<div class="twelve columns" style="font-weight: bold; padding-top: 15px; color: maroon;">
							<img src="/e-cafe/assets/images/location.png" style="float: left; height:20px; width:20px;">
							<label style="float: left;"><?= $profile['county']?> , <?= $profile['town']?></label>
						</div>
						<div class="twelve columns" style="font-weight: bold; padding-top: 15px; color: maroon;">
							<img src="/e-cafe/assets/images/phone.png" style="float: left; height: 20px; width: 20px; ">
							<label style="float: left;">+254<?= $profile['restaurant_phone_number']?> </label>
						</div>
						<div class="twelve columns" style="font-weight: bold; padding-top: 15px; color: maroon;">
							<img src="/e-cafe/assets/images/email.png" style=" float: left; height: 20px; width:20px;">
							<label style="float: left;"><?= $profile['restaurant_email']?> </label>
						</div>
					</div>
				</div>
				<!--Profile Detail area Ends -->

				<!--Message Restaurant area Bigins-->
				<div class="row" style="min-height: 50px; padding-top: 20px;">
					<div class="one column"> </div>
					<div class="five columns">
						
						<textarea rows="1" style="width:100%; border: none; border-bottom: 1px solid black;background: transparent; border-bottom-right-radius: none; height: auto !important; min-height: 40px;" placeholder="SEND MESSAGE" id="messageTextArea"></textarea>
					</div>
					<div class="six columns" style="">
						<button id="messageButton" style="color: white; background-color: maroon;" name="<?= $profile['message_index']?>">SEND</button>
					</div>
				</div>
				<!--Message Restaurant area Ends --> 

				<!--My Menu area Bigins-->
				<div class="row" id="myMenu">

					<div class="row" id="menuTitle">
						<h3><?= $profile['restaurant_name']?>'S MENU</h3>
					</div>
					<div id="row">
					<?php 
					$i = 0;
					foreach($this->restaurant_menu_data as $food): ?>

						<div class="four columns" style=" border: 1px solid #e7e7e7;" > 
							<div class="twelve columns">
								<img alt=" " src="/e-cafe/assets/<?= $food['picture_id']?>" title=" " id="foodImage" style="width: 270px; height:270px;">
							</div>
							<div class="twelve columns" id="foodDetails">
								<p id="foodName"><?= $food['food_name']?></p>
								<p>
									<span id="restaurantName1">restaurant: </span>
									<?= $food['restaurant_name']?>
									<br>
									<span id="foodPrice"> price: </span> 
									KSH <?= $food['price']?>
								</p>	
							</div>
							<div class="twelve columns" style=" border: 1px solid #e7e7e7; height: 40px;">
								<div class="eight columns addToCart" id="a<?= $i?>" style=" border: 1px solid #e7e7e7; height: 40px;" 
								value="<?= $food['restaurant_id']?>">
									<div class="three columns">
										<img src="/e-cafe/assets/images/cart.png" title="add to cart" id="cartImage" class="foodAction" style="width: 20px; height:20px;">
									</div>
									<div class="nine columns"><p class="foodAction">ADD TO CART</p></div>
								</div>

								<div class="two columns" style=" border-right: 1px solid #e7e7e7; height: 40px; text-align: center;">
									<img src="/e-cafe/assets/images/like.png" title="edit" id="likeImage" class="foodAction" style="width: 20px; height:20px;">
								</div>

								<div class="two columns" style=" border: 0px solid #e7e7e7; height: 40px; text-align: center;">
									<img src="/e-cafe/assets/images/info.png" title="more info" id="infoImage" class="foodAction" style="width: 20px; height:20px;">
								</div>

							</div>
						</div>
						<iframe src="" style="display: none;" class="a<?= $i?>" name="<?= $food['food_id']?>"></iframe>
					<?php 
					$i++;
					endforeach; ?>
					</div>
				</div>
				<!--My Menu area Ends --> 	
			</div>
			<?php endforeach; ?>
		</div>
		
	</div>
	<script type="text/javascript">
		$( function(){
			$("#messageButton").click(function(event){
				event.preventDefault();
				var message = $("#messageTextArea").val().trim();
				var name = $("#messageButton").attr("name");
				if (message=="") {
					alert("Message not send: blank message box");
				}else{
					$.post("messages.php",
				    {
				        send_message: message,
				        recipient_id: name
				    },
				    function(data, status){
				        alert("Data: " + data + "\nStatus: " + status);
				    });
				}
				
			});
		});
	</script>