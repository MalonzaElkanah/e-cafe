<head>
	<style type="text/css">
		
		.infoContent{
			background-color: #2d3035;
		}
		.pic_div{
			padding-left: 10px;
			padding-top: 10px;
			min-height: 100px;
		}
		.pic_tag{
			height: 100px;
			width: 100px;
			border-radius: 50%, 50%, 50%, 50%;
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
		#rateButton1 {
			border-radius: 0px;
			background-color: maroon;
			color: white;
		}

		#rateButton2{
			border-radius: 0px;
			background-color: #494949;
			color: white;
		}
	</style>
</head>

<div class="row infoContent">
	<?php 
		$i = 0; 
		foreach($this->order_data as $order): 
		$i++;
		$f_qnty = $order['food_quantity'];
		$f_price = $order['food_price'];
		$f_total_price = $f_price * $f_qnty;
		
	?>
		<div class="twelve columns" style="padding-bottom: 30px;">
			<div class="row" style="border:1px solid #d4d4d4; background-color: #e7e7e7; min-height: 120px;">
				<div class="three columns pic_div">
					<img class="pic_tag" src="/e-cafe/assets/<?= $order['picture_id']?>">
				</div>
				<div class="nine columns food_tags" style="border: 0px solid black; min-height: 100px; ">
					<LABEL id="ordrID" value="<?= $order['order_id']?>">
						<span class="id_tags">NAME:</span> <?= $order['food_name']?>
					</LABEL>
					<LABEL><span class="id_tags">RESTAURANT:</span> <?= $order['restaurant_name']?> </LABEL>
					<LABEL><span class="id_tags">QUANTITY:</span> <?= $order['food_quantity']?></LABEL>
					<LABEL><span class="id_tags">TOTAL PRICE:</span> <?= $f_total_price?> </LABEL>
				</div>
			</div>
			<div class="row" style="border:1px solid #d4d4d4; background-color: #e7e7e7; min-height: 120px;">
				<div class="four columns pic_div">
					<div class="row"><h5 style="font-size: 17px;">Rate food</h5></div>
					<div class="row">
						<input type="radio" name="rateFoodOption" value="5" style="float: left;">
						<LABEL>Excellent</LABEL>
					</div>
					<div class="row">
						<input type="radio" name="rateFoodOption" value="4" style="float: left;">
						<LABEL>Good</LABEL>
					</div>
					<div class="row">
						<input type="radio" name="rateFoodOption" value="3" style="float: left;">
						<LABEL>Average</LABEL>
					</div>
					<div class="row">
						<input type="radio" name="rateFoodOption" value="2" style="float: left;">
						<LABEL>Below Average</LABEL>
					</div>
					<div class="row">
						<input type="radio" name="rateFoodOption" value="1" style="float: left;">
						<LABEL>Dissatified</LABEL>
					</div>
				</div>
				<div class="eight columns food_tags" style="border: 0px solid black; min-height: 100px; ">
					<div class="row">
						<LABEL>Feedback</LABEL>
					</div> 
					<div class="row" style="padding-top: 10px;">
						<textarea id="foodComments" style="width: 90%; height: 70%;" ></textarea>
					</div>
				</div>
			</div>
		</div>	
	<?php endforeach; ?>

	<?php 
		$i = 0; 
		foreach($this->order_data as $delivery): 
		$i++;
	?>
		<?php if($i==1): ?>	
			<div class="twelve columns" style="padding-bottom: 30px;">
				<div class="row" style="border:1px solid #d4d4d4; background-color: #e7e7e7; min-height: 120px;">
					<div class="three columns pic_div">
						<img class="pic_tag" src="/e-cafe/assets/<?= $delivery['delivery_person_profile_picture']?>">
					</div>
					<div class="nine columns food_tags" style="border: 0px solid black; min-height: 100px; ">
						<LABEL>
							<span class="id_tags">NAME:</span> 
							<?= $delivery['delivery_person_first_name']?> 
							<?= $delivery['delivery_person_second_name']?>
						</LABEL>
						<LABEL><span class="id_tags">TO:</span> <?= $delivery['restaurant_name']?> </LABEL>
						<LABEL><span class="id_tags">FROM:</span> <?= $delivery['food_quantity']?></LABEL>
						<LABEL><span class="id_tags">TOTAL PRICE:</span> <?= $delivery['delivery_price']?> </LABEL>
					</div>
				</div>
				<div class="row" style="border:1px solid #d4d4d4; background-color: #e7e7e7; min-height: 120px;">
					<div class="four columns pic_div">
						<div class="row"><h5 style="font-size: 17px;">Rate food</h5></div>
						<div class="row">
							<input type="radio" name="rateDeliveryOption" value="5" style="float: left;">
							<LABEL>Excellent</LABEL>
						</div>
						<div class="row">
							<input type="radio" name="rateDeliveryOption" value="4" style="float: left;">
							<LABEL>Good</LABEL>
						</div>
						<div class="row">
							<input type="radio" name="rateDeliveryOption" value="3" style="float: left;">
							<LABEL>Average</LABEL>
						</div>
						<div class="row">
							<input type="radio" name="rateDeliveryOption" value="2" style="float: left;">
							<LABEL>Below Average</LABEL>
						</div>
						<div class="row">
							<input type="radio" name="rateDeliveryOption" value="1" style="float: left;">
							<LABEL>Dissatified</LABEL>
						</div>
					</div>
					<div class="eight columns food_tags" style="border: 0px solid black; min-height: 100px; ">
						<div class="row">
							<LABEL>Feedback</LABEL>
						</div> 
						<div class="row" style="padding-top: 10px;">
							<textarea id="deliveryComments" style="width: 90%; height: 70%;" ></textarea>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?> 	
	<?php endforeach; ?>

	<div class="twelve columns" style="padding-bottom: 20px;">
		<div class="row" style="border:1px solid #d4d4d4; background-color: #e7e7e7; min-height: 100px;">
			<div class="four columns" style="padding-left: 40px; padding-top: 20px; ">
				<button href="#" class="button" id="rateButton2" class=" ">CANCEL</button>
			</div>
			<div class="four columns">
				<p> </p>
			</div>
			<div class="four columns" style="padding-right: 50px; padding-top: 20px; ">
				<button class="button" id="rateButton1" >FEEDBACK</button>
			</div> 		
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		//feed back button
		$("#rateButton1").click(function(event){
			event.preventDefault();
			var or_id = $("#ordrID").attr("value");
			alert(or_id);
			//food feedback
			var check1 = 0;
			var f_rate; 
			if ($("input[name='rateFoodOption']:checked").length>0) {
				f_rate = $("input[name='rateFoodOption']:checked").val();
				check1 = check1+1;
			}
			var f_comment = $("#foodComments").val().trim();
			if (f_comment=="") {
				if (check1==0) {
					alert("no food feedback");
				}else{
					$.post("index.php",
				    {
				        F_Feedback: true,
				        F_Rate: f_rate,
				        Odr_id: or_id
				    },
				    function(data, status){
				        //alert("Data: " + data + "\nStatus: " + status);
				        alert(data+"..."+status);
				    });
				}
			}else if (check1==0) {
				$.post("index.php",
			    {
			        F_Feedback: true,
			        F_Comment: f_comment,
				    Odr_id: or_id
			    },
			    function(data, status){
			        //alert("Data: " + data + "\nStatus: " + status);
			        alert(data+"..."+status);
			    });
			}else{
				$.post("index.php",
			    {
			        F_Feedback: true,
			        F_Comment: f_comment,
			        F_Rate: f_rate,
				    Odr_id: or_id
			    },
			    function(data, status){
			        //alert("Data: " + data + "\nStatus: " + status);
			        alert(data+"..."+status);
			    });
			}

			//deliveryFeedback
			var check2 = 0;
			var d_rate; 
			if ($("input[name='rateDeliveryOption']:checked").length>0) {////rateFoodOption
				d_rate = $("input[name='rateDeliveryOption']:checked").val();
				check2 = check2+1; 
			}
			var d_comment = $("#deliveryComments").val().trim();
			if (d_comment=="") {
				if (check2==0) {
					alert("no del feedback");
				}else{
					$.post("index.php",
				    {
				        D_Feedback: true,
				        D_Rate: d_rate,
				        Odr_id: or_id
				    },
				    function(data, status){
				        //alert("Data: " + data + "\nStatus: " + status);
				        alert(data+"..."+status);
				    });
				}
			}else if (check2==0) {
				$.post("index.php",
			    {
			        D_Feedback: true,
			        D_Comment: d_comment,
			        Odr_id: or_id
			    },
			    function(data, status){
			        //alert("Data: " + data + "\nStatus: " + status);
			        alert(data+"..."+status);
			    });
			}else{
				$.post("index.php",
			    {
			        D_Feedback: true,
			        D_Comment: d_comment,
			        D_Rate: d_rate,
				    Odr_id: or_id
			    },
			    function(data, status){
			        //alert("Data: " + data + "\nStatus: " + status);
			        alert(data+"..."+status);
			    });
			}
			

		});
		//CANCEL
		$("#rateButton2").click(function(event){
			event.preventDefault();
			//alert("icon22");
		});
	});
</script>
