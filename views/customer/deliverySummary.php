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
		.food_tags{
			text-align: left;
		}
		.id_tags{
			color: maroon;
		}
		.count{
			padding-left: 10px;
		}
	</style>
</head>

<?php 
	$all_total_price = 0;
?>
<form action="foodCart.php" method="post" novalidate="novalidate">
	<div id="LOCALE" style="padding-top: 30px; text-align: center;">
		<div class="row" style="border-bottom: 1px solid #c2c2c2; padding-top: 0px;"><h4> PAYMENT INFOMATION</h4></div>

		
			<div class="row" id="payment" style="min-height: 50px; border: 0px solid grey;">
				<div class="nine columns" id="paymentDetails">
					<div class="row orderHeader"><h3>YOUR ORDERS</h3></div>
					<div class ="row" style=" border: 0px solid black;">
						<div class="row" style="padding-top: 10px;">

							<?php 
								$i = 0; 
								foreach($this->preOrder_data as $order): 
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
											<LABEL><span class="id_tags">NAME:</span> <?= $order['food_name']?></LABEL>
											<LABEL><span class="id_tags">RESTAURANT:</span> <?= $order['restaurant_name']?> </LABEL>
											<LABEL><span class="id_tags">QUANTITY:</span> <?= $order['food_quantity']?></LABEL>
											<LABEL><span class="id_tags">TOTAL PRICE:</span> <?= $f_total_price?> </LABEL>
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
						
					<div class="row orderHeader" style="padding-top: 30px;"><h3>DELIVERY</h3></div>

						<?php 
							$i = 0; 
							$totalDeliveryPrice = 0;
							foreach($this->preOrder_data as $delivery_data): 
							$i++;
						?>

							<?php if($i==1): 
								$totalDeliveryPrice = $delivery_data['delivery_price'];	
							?>
									<div class="row" style="border:1px solid #d4d4d4; min-height: 120px; background-color: #e7e7e7;">
										<div class="three columns" style=" min-height: 100px; ">
											<div class="three columns pic_div" style="width: 110px; height: 110px; ">
												<img class="pic_tag" src="/e-cafe/assets/<?= $delivery_data['delivery_person_profile_picture']?>">
											</div>	
										</div>
										<div class="nine columns" style="border: 0px solid black; min-height: 90px; text-align: left; padding-top: 20px; ">
											<div class="six columns">
												<LABEL>
													<span class="id_tags">
														NAME:
													</span> 
													<?= $delivery_data['delivery_person_first_name']?> <?= $delivery_data['delivery_person_second_name']?>
												</LABEL>
												<LABEL>
													<span class="id_tags">TO:</span> <?= $delivery_data['c_pos_name']?> 
												</LABEL>
												<LABEL>
													<span class="id_tags">FROM:</span> <?= $delivery_data['r_pos_name']?>
												</LABEL>
											</div>
											<div class="six columns">
												<LABEL>
													<span class="id_tags">TOTAL DISTANCE:</span> <?= $delivery_data['delivery_distance']?>
												</LABEL>
												<LABEL>
													<span class="id_tags">PRICE PER KM:</span> <?= $delivery_data['price_per_km']?>
												</LABEL>
												<LABEL>
													<span class="id_tags">TOTAL PRICE:</span> <?= $delivery_data['delivery_price']?>
												</LABEL>
											</div>
										</div>
									</div>
							<?php endif; ?> 
						<?php endforeach; ?>

					<div class="row" style="padding-top: 20px; padding-right: 20px; border-bottom: 1px solid #c4c4c4;">
						<input type="text" name="" placeholder="kSH XXXX.XX" value="Ksh <?=$totalDeliveryPrice ?>" style="float:right;" readonly>
						<label style="float:right; padding-right: 10px; color: maroon;">Total Delivery Price: </label>
					</div>
					<div class="row orderHeader" style="padding-top: 30px;"><h3>PAYMENT OPTION</h3></div>
					<div class="row">
						<div class="two columns"> </div>
						<div class="three columns">
							<input type="radio" name="paymentOption" value="1" style="float: left;">
							<label style="float: left; padding-left: 10px;">Cash On Delivery</label>
						</div>
					</div>
				</div>
				<div class="three columns" id="orderSummary">
					<div class="row orderHeader"><h3>SUMMARY</h3></div>
					<div class="row" style="min-height: 500px; border: 1px solid #c4c4c4; background-color: white;">
						<div class="twelve columns" style="background-color: #e7e7e7; border-bottom: 1px solid #c4c4c4;">
							<h6 style="padding-top: 15px;">FOOD</h6>
						</div>
						<div class="twelve columns">
							<table>
								<tr>
									<th> </th>
									<th>food name</th>
									<th>QNTY</th>
									<th>price</th>
								</tr>
								<?php  
									$j = 0;
									$all_total_price =0;
									foreach($this->preOrder_data as $order): 
									$j++;
									$f_qnty = $order['food_quantity'];
									$f_price = $order['food_price'];
									$f_total_price = $f_price * $f_qnty;
									$all_total_price = $all_total_price + $f_total_price;
								?>
									<tr>
										<td style="padding-left: 10px;">	<?= $j ?> </td>
										<td id="">	<?= $order['food_name']?>	</td>
										<td id="">	<?= $order['food_quantity']?></td>
										<td id="">  <?= $f_total_price ?>		</td>
									</tr>
								<?php endforeach; ?>
								<tr>
									<tfoot>
										<td class="count" colspan="3">
											<label style="padding-left: 15px;"> TOTAL FOOD PRICE</label>
										</td>
										<td style="color: maroon;">Ksh <?= $all_total_price ?> </td>
									</tr>
									</tfoot>
								</tr>
							</table>
						</div>
						<div class="twelve columns" style="background-color: #e7e7e7; border-top: 1px solid #c4c4c4; border-bottom: 1px solid #c4c4c4;">
							<h6 style="padding-top: 15px;">DELIVERY</h6>
						</div>
						<div class="twelve columns">
							<table>
								<tr>
									<th>DISTANCE</th>
									<th>price/km</th>
									<th>Total price</th>
								</tr>
								<?php  
									$j = 0;
									$deliveryPrice =0;
									foreach($this->preOrder_data as $delivery_data): 
									$j++;
									$deliveryPrice = $delivery_data['delivery_price'];
								?>
									<?php if($j==1): ?>
										<tr>
											<td style="padding-left: 10px;">	<?= $delivery_data['delivery_distance']?>	</td>
											<td id="">	<?= $delivery_data['price_per_km']?>		</td>
											<td id="">  <?= $delivery_data['delivery_price'] ?>		</td>
										</tr>
									<?php endif; ?> 
								<?php endforeach; ?>
							</table>
						</div>
						<div>
							<?php 
								$priceToPay = $deliveryPrice+$all_total_price;
							?>
							<label>TOTAL PRICE TO PAY:</label> 
							<span style="color: maroon;">Ksh <?= $priceToPay?></span>
						</div>
					</div>
				</div>
			</div>
		
	</div>
	
	<div id="tableButtons" style="padding-top: 30px;">
			<div class="two columns" style="padding-left: 40px; ">
				<button href="#" class="button" id="prev3" class=" "> PREV </button>
			</div>
			<div class="eight columns">
				<p> </p>
			</div>
			<div class="two columns" style="padding-right: 50px; ">
				<button id="next3" name="RedirectOrder" class="button" >ORDER</button>
			</div>  	
	</div>
</form>
<script type="text/javascript">

	$(function(){
		$("#next3").click(function(event){
			event.preventDefault();
			
			if ($("input[name='paymentOption']:checked").length>0) {
				var payment = $("input[name='paymentOption']:checked").val();
				if (payment==1) {
					$.post("foodCart.php",
				    {
				        FoodOrder: true
				    },
				    function(data, status){
				        //alert("Data: " + data + "\nStatus: " + status);
				        alert("FOOD ORDERED SUCESSFULLY");
				        // Simulate a mouse click:
						window.location.href = "orders.php";
						// Simulate an HTTP redirect:
						//window.location.replace(""+data+"");
				    });
					//$("#next3").unbind('submit').submit();
				}else{
					alert("NO PAYMENT METHOD SELECTED");
				}
			}else{
				alert("PLEASE SELECT A PAYMENT METHOD!!");
			}
		});
		$("#prev3").click(function(event){
			event.preventDefault();
			$("#DeliveryPerson").css("display", "block");
			$("#payment").css("display", "none");
		});
	});
</script>