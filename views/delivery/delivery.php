<head>
	<style type="text/css">
		.pic_div{
			padding-left: 10px;
			padding-top: 10px;
			min-height: 100px;
		}
		.pic_tag{
			height: 100px;
			width: 100px;
			border-radius: 50%;
			border: 1px solid white;
		}
		.delPic_tag{
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.food_tags{
			text-align: left;
		}
		.id_tags{
			color: maroon;
		}
		.count{
			padding-left: 10px;
		}
		#verifyDeliveryButtons{
			background-color: #f3f3f3;
			min-height: 100px;
		}
		#cancelDelivery, #orderDelivery{
			float: right;
		    font-size: 14px;
		    color: #fff;
		    font-weight: 600;
		    padding: 0px 45px;
		    background: maroon;
		    outline: none;
    		border: none;
    		cursor: pointer;
		}
		#orderDelivery{
			opacity: 0.65;
		}
		/*.enabled{ 
			border-radius: 0px;
			background-color: maroon;
			color: white;
		}*/
		.disable{
			border-radius: 0px;
			background-color: #494949;
			color: white;
		}
		#deliveryError{
			color: red;
			font-style: italic;
			font-size: 12px;
			padding-left: 50px;
		}
	</style>
</head>

<?php 
	$all_total_price = 0;
?>
<form action="foodCart.php" method="post" novalidate="novalidate">
	<div id="LOCALE" style="text-align: center; background-color: #f3f3f3;">
			<div class="row" style="min-height: 50px; padding-top: 20px;">
				<div class="twelve columns" id="paymentDetails">
					<div class="row orderHeader"><h3>ORDERS TO DISPATCH</h3></div>
					<div class ="row" style=" border: 0px solid black;">
						<div class="row" style="padding-top: 10px;">

							<?php 
								$i = 0; 
								foreach($this->preDelivery_data as $order): 
								$i++;
								$f_qnty = $order['food_quantity'];
								$f_price = $order['food_price'];
								$f_total_price = $f_price * $f_qnty;
								$all_total_price = $all_total_price + $f_total_price;
							?>

								<div class="six columns" style="padding-bottom: 30px;">
									<div class="row" style="border:1px solid #d4d4d4; background-color: #e7e7e7; min-height: 120px;">
										<div class="three columns pic_div">
											<img class="pic_tag" src="/e-cafe/assets/<?= $order['picture_id']?>">
										</div>
										<div class="nine columns food_tags" style="border: 0px solid black; min-height: 100px; ">
											<LABEL><span class="id_tags">FOOD NAME:</span> <?= $order['food_name']?></LABEL>
											<LABEL><span class="id_tags">RESTAURANT:</span> <?= $order['restaurant_name']?> </LABEL>
											<LABEL><span class="id_tags">F QUANTITY: </span> <?= $order['food_quantity']?></LABEL>
											<LABEL><span class="id_tags">TOTAL PRICE:</span> kSH <?= $f_total_price?> </LABEL>
										</div>
									</div>
								</div>
								
							<?php 
								endforeach; 
							?>
						</div>
						<div class="row" style="padding-top: 20px; padding-right: 20px; border-bottom: 1px solid #c4c4c4;">
							<input type="text" name="foodPrice" value="kSH <?= $all_total_price ?>" placeholder="kSH <?= $all_total_price ?>" style="float:right;" readonly>
							<label style="float:right; padding-right: 10px; color: maroon;">Total Food Price: </label>
						</div>
					</div>
						
					<div class="row orderHeader" style="padding-top: 30px;"><h3>CUSTOMER</h3></div>

						<?php 
							$i = 0; 
							$totalDeliveryPrice = 0;
							foreach($this->preDelivery_data as $customer_data): 
							$i++;
						?>

							<?php if($i==1): 
								$totalDeliveryPrice = $customer_data['delivery_price'];	
							?>
									<div class="row" style="border:1px solid #d4d4d4; min-height: 175px; background-color: #e7e7e7;">
										<div class="three columns" style=" min-height: 100px; ">
											<div class="three columns pic_div" style="width: 150px; height: 150px; ">
												<img class="delPic_tag" src="/e-cafe/assets/<?= $customer_data['customer_profile_picture']?>">
											</div>	
										</div>
										<div class="nine columns" style="border: 0px solid black; min-height: 90px; text-align: left; padding-top: 20px; ">
											<div class="six columns">
												<LABEL>
													<span class="id_tags">
														NAME:
													</span> 
													<?= $customer_data['customer_first_name']?> <?= $customer_data['customer_second_name']?>
												</LABEL>
												<LABEL>
													<span class="id_tags">TO:</span> <?= $customer_data['c_pos_name']?> 
												</LABEL>
												<LABEL>
													<span class="id_tags">FROM:</span> <?= $customer_data['r_pos_name']?>
												</LABEL>
											</div>
											<div class="six columns">
												<h5 style="text-align: center; font-size: 17px; color: maroon; font-weight: bold; text-decoration: underline;">
													VERIFY
												</h5> 
												
												<span>
													<label>
														ID number: 
														<input type="text" id="idNoInput" >
														<span style="padding-left: 20px;">
															<button class="disable" id="verify">verify</button> 
														</span>
													</label>
													<p id="deliveryError" value="<?= $customer_data['customer_id']?>"> </p>
												</span>
											</div>
										</div>
									</div>
							<?php endif; ?> 
						<?php endforeach; ?>

					<div class="row" style="padding-top: 50px; padding-right: 20px;">
					</div>

				</div>	
			</div>
			<div id="verifyDeliveryButtons" style="padding-top: 30px;">
				<div class="two columns" style="padding-left: 40px; ">
					<button href="#" class="button" id="cancelDelivery" class=" "> CANCEL </button>
				</div>
				<div class="eight columns">
					<p> </p>
				</div>
				<div class="two columns" style="padding-right: 50px; ">
					<button id="orderDelivery" class="button" disabled="disabled">DISPATCH</button>
				</div>  	
			</div>
	</div>		
</form>
<script type="text/javascript">

	$(function(){
		$("#deliveryError").text(" ");
		//ID NUMBER INPUT CHANGE
		$("#idNoInput").change(function(){
			$("#deliveryError").text(" ");
			$("#orderDelivery").attr("disabled", "disabled");
        	$("#orderDelivery").prop("disabled", true);
        	$("#orderDelivery").css("opacity","0.65");
		});
		//VERIFY DISPATCH
		$("#verify").click(function(event){
			event.preventDefault();
			var id_num = $("#idNoInput").val().trim();
			var cus_id = $("#deliveryError").attr("value");
			if (id_num=="") {
				$("#deliveryError").text("please enter delivery person ID number!!");
				$("#deliveryError").css("color", "red");
				$("#orderDelivery").attr("disabled", "disabled");
	        	$("#orderDelivery").prop("disabled", true);
	        	$("#orderDelivery").css("opacity","0.65");
			}else{
				
				$.post("index.php",
			    {
			        ID_NUM: id_num,
			        CUST_ID: cus_id
			    },
			    function(data, status){
			        if(data==0){
			        	$("#deliveryError").text("Invalid ID number!!");
			        	$("#deliveryError").css("color", "red");

			        	$("#orderDelivery").attr("disabled", "disabled");
			        	$("#orderDelivery").prop("disabled", true);
			        	$("#orderDelivery").css("opacity","0.65");
			        }else{
			        	$("#deliveryError").text("ID number verified");
			        	$("#deliveryError").css("color", "green");
			        	$("#orderDelivery").removeAttr("disabled");
			        	$("#orderDelivery").prop("disabled", false);
			        	$("#orderDelivery").css("opacity","1");
			        }
			    });
			}
		});
		//DISPATCH BUTTON
		$("#orderDelivery").click(function(event){
			event.preventDefault();

			$.post("index.php",
		    {
		        DELIVERY_ORDER: true
		    },
		    function(data, status){
		        if(data==1){
		        	alert("ORDER DELIVERY WAS SUCCESSFUL");
		        	window.location.href = "index.php";
		        }else if (data==0){
		        	alert("ORDER NOT DELIVERED");
		        }
		    });
		});

		//CANCEL DISPATCH BUTTON
		$("#cancelDelivery").click(function(event){
			event.preventDefault();
			$("#currentDeliveries").css("display", "block");
			$("#scheduleDeliveries").css("display", "none");
			$("#prevDeliveries").css("display", "none");
			$("#deliveryOrderBlock").css("display", "none");
		});
	});
</script>