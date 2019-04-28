<head>
	<link rel="stylesheet" href="/e-cafe/assets/arcgis_js_api/library/4.10/dijit/themes/claro/claro.css" />
    <link rel="stylesheet" href="/e-cafe/assets/arcgis_js_api/library/4.10/esri/css/main.css" />
    <script src="/e-cafe/assets/arcgis_js_api/library/4.10/"></script>
    
	<style type="text/css">
		/*<link rel="stylesheet" href="https://js.arcgis.com/4.10/esri/css/main.css">
		<script src="https://js.arcgis.com/4.10/"></script>*/
		#prev3, #prev2, #prev1, #prev0, #next0, #next1, #next2, #next3{
			float: right;
			/*padding-right: 50px;*/
		    font-size: 14px;
		    color: #fff;
		    font-weight: 600;
		    padding: 0px 45px;
		    background: maroon;
		    outline: none;
    		border: none;
    		cursor: pointer;
		}
		#deliveryTime{
			padding-top: 50px;
		}
		#nowCheckbox, #newLocationCheckbox{
			padding-top: 30px;
		}
		#deliverDate{
			padding-top: 35px;
			background-color: white;
			padding-bottom: 35px;
			display: block;
		}
		#mapLocation{
			padding-top: 35px;
			background-color: white;
			padding-bottom: 35px;
			display: none;
		}
		#deliverDate label{
			color: maroon;
		}
		#locationData{
			padding-top: 30px;
		}
		#paymentDetails{
			border: 0px solid black;
			min-height: 100px;
			padding-top: 30px;
		}
		#orderSummary{
			min-height: 100px;
			padding-top: 40px;
		}
		.orderHeader h3{
			font-size: 17px;
			color: maroon;
		}
		#viewDiv{
			height: 300px;
			width: 100%;	
		}
	</style>
</head>
<!-- Selected Orders area Bigins &nbsp; -->
	<div id="selectedOrder" style="min-height: 400px;">
		<div class="row" id="tableTitle" style="height:50px; ">
			<h4> YOU HAVE SELECTED</h4>
		</div>
		<div class="row" id="getRestaurant">
			<table id="restaurantTable">
				<tr>
					<th> </th>
					<th>FOOD NAME</th>
					<th>QUANTITY</th>
					<th>PRICE</th>
					<th>RESTAURANT NAME</th>
					<th> </th>
				</tr>
				<?php 
				$i = 0; 
				$r=0;
				foreach($this->selected_data as $order): 
				$i++;
				$r = $order['restaurant_id']; 
				?>
				<tr id="row<?= $i?>">
					<td>
						<a href="" id="imgLink<?= $i?>" value="<?= $order['order_id']?>">
							<img alt=" " src="/e-cafe/assets/<?= $order['picture_id']?>" class="foodImage" style="width: 50px; height:50px; padding-left: 30px;">
						</a> 
					</td>
					<td id="fName<?= $i?>">	<?= $order['food_name']?>	</td>
					<td id="qnty<?= $i?>">	<?= $order['food_quantity']?></td>
					<td id="fPrice<?= $i?>"><?= $order['food_price']?>	</td>
					<td id="rName<?= $i?>">	<?= $order['restaurant_name']?></td>
					<td>
						<a href="#" id="link<?= $i?>" value="<?= $i?>"> REMOVE </a>
					</td>
				</tr>
				<?php 
				
				endforeach; ?>
				<p id="selectedCount" style="display: none;"><?= $i?></p>
				<p id="rID"><?= $r?></p>
			</table>
		</div>
		<div class="row" id="deliveryTime">
			<div class="twelve columns" style=" text-align: center; color: maroon; font-size: 30px;">
				DELIVERY TIME
			</div>
			<div id="nowCheckbox" class="twelve columns" style=" text-align: center; color: black; font-size: 15px;">
				<input type="checkbox" id="deliverNow" name=""> Delivery Now
			</div>
			<div id="deliverDate" class="twelve columns">
				<?php  
				foreach($this->date_time_data as $dateTime): 
					$i = $dateTime['DAY'];
					$l = $dateTime['HOUR']+1;
					$m = $dateTime['MINUTE'];
					$j =$i+9;
				?>
				<div class="two columns"> 
					<label style="float: left;  padding-left:30px; padding-right: 20px;">Day: </label>
					<select id="daySelect" style="float: left; padding-left:10px;">
						<?php for ($k = $i; $k < $j; $k++): ?>
							<?php if($k==$i): ?>
								<?php if($k>=10): ?>
									<option value="<?=$k?>" selected><?=$k?></option>
								<?php else: ?>
									<option value="<?=$k?>" selected>0<?=$k?></option>
								<?php endif; ?>	
							<?php else: ?>	
								<?php if($k>=10): ?>
									<option value="<?=$k?>"><?=$k?></option>
								<?php else: ?>
									<option value="<?=$k?>">0<?=$k?></option>
								<?php endif; ?>
							<?php endif; ?>	
						<?php endfor; ?>
					</select>
				</div>
				<div class="two columns" >
					<label style="float: left; padding-right: 10px;">Month:</label>
				
					<select id="monthSelect" style="float: left; padding-left:10px;"> 
						<?php if($dateTime['MONTH']>=10): ?>
							<option value="<?= $dateTime['MONTH']?>"><?= $dateTime['MONTH']?></option>
						<?php else: ?>
							<option value="<?= $dateTime['MONTH']?>">0<?= $dateTime['MONTH']?></option>
						<?php endif; ?>
					</select>
				</div>
				<div class="two columns" >
					<label style="float: left; padding-right: 10px;">Year: </label>
				
					<select id="yearSelect" style="float: left; padding-left:10px;"> 
						<option value="<?= $dateTime['YEAR']?>"><?= $dateTime['YEAR']?></option>
					</select>
				</div>
				<div class="two columns"><h3> </h3> </div>

				<div class="four columns">
					<label style="float: left; padding-right: 10px;">TIME:</label>
					<select id="hourSelect" style="float: left; padding-right:5px;">
						<?php for ($k = $l; $k < 24; $k++): ?>
							<?php if($k==$l): ?>
								<?php if($k>=10): ?>
									<option value="<?=$k?>" selected><?=$k?></option>
								<?php else: ?>
									<option value="<?=$k?>" selected>0<?=$k?></option>
								<?php endif; ?>	
							<?php else: ?>	
								<?php if($k>=10): ?>
									<option value="<?=$k?>"><?=$k?></option>
								<?php else: ?>
									<option value="<?=$k?>">0<?=$k?></option>
								<?php endif; ?>
							<?php endif; ?>	
						<?php endfor; ?>

						<?php for ($k = 0; $k < $l; $k++): ?>
							<?php if($k>=10): ?>
								<option value="<?=$k?>" class="newOption" style="display: none;"><?=$k?></option>
							<?php else: ?>
								<option value="<?=$k?>" class="newOption" style="display: none;">0<?=$k?></option>
							<?php endif; ?>
						<?php endfor; ?>
					</select>
					<label style="float: left; padding-left: 5px; padding-right: 5px;"> : </label>
					<select id="minuteSelect" style="float: left; padding-right: 10px;"> 
						<?php for ($k = $m; $k < 60; $k++): ?>
							<?php if($k==$m): ?>
								<?php if($k>=10): ?>
									<option value="<?=$k?>" selected><?=$k?></option>
								<?php else: ?>
									<option value="<?=$k?>" selected>0<?=$k?></option>
								<?php endif; ?>	
							<?php else: ?>	
								<?php if($k>=10): ?>
									<option value="<?=$k?>"><?=$k?></option>
								<?php else: ?>
									<option value="<?=$k?>">0<?=$k?></option>
								<?php endif; ?>
							<?php endif; ?>	
						<?php endfor; ?>

						<?php for ($k = 0; $k < $m; $k++): ?>
							<?php if($k>=10): ?>
								<option value="<?=$k?>" class="newOptionSeconds" style="display: none;"><?=$k?></option>
							<?php else: ?>
								<option value="<?=$k?>" class="newOptionSeconds" style="display: none;">0<?=$k?></option>
							<?php endif; ?>
						<?php endfor; ?>
					</select>

					<label style="float: left; padding-left: 5px;"> Hours</label>
				</div>
				<?php endforeach; ?>
			</div>

		</div>

		<div id="tableButtons" style="padding-top: 30px;">
				<div class="two columns" style="padding-left: 40px; ">
					<button href="#" class="button" id="prev0" class=" "> PREV </button>
				</div>
				<div class="eight columns">
					<p> </p>
				</div>
				<div class="two columns" style="padding-right: 50px; ">
					<button href="#" class="button" id="next0">NEXT</button>
				</div>  	
		</div>	

	</div>
<!-- ----------------------------- Selected Orders View Ends ------------------------ -->


<!-- -------- Choose your Location area Bigins &nbsp; ------------->
	<div class="row" id="customerLocation" style="min-height: 400px; display: none;">
		<div id="LOCALE" style="padding-top: 30px; text-align: center;">
			<div class="row"><h4> CHOOSE YOUR LOCATION</h4></div>
			<div class="row" id="savedLocation">
				<h5 style="text-align: center; color: maroon;">Saved Location </h5>

				<table id="locationTable">
					<tr>
						<th> </th>
						<th>map view</th>
						<th>LOCATION</th>
						<th>DATE ADDED</th>
						<th>remove</th>
						<th>use</th>
					</tr>
					<?php 
					$i = 0; 
					foreach($this->geo_data as $location): 
					$i++;
					?>
						<tr id="position<?= $location['pos_id']?>">
							<td style ="padding-left: 10px;"><?= $i ?></td>
							<td id="viewSavedLoc<?= $i ?>" value="<?= $location['pos_id']?>">
								<a href="#map">
									<img src="/e-cafe/assets/images/map.png" style="width: 50px; height:50px; ">
								</a>
							</td>
							<td id="c_lati<?= $location['pos_id']?>" value="<?= $location['latitude_cood']?>">
								<?= $location['pos_name']?>
							</td>
							<td id="c_longi<?= $location['pos_id']?>" value="<?= $location['longitude_cood']?>">
								<?= $location['Date']?>
							</td>
							<td>
								<a href="#" id="deleteLoc<?= $i ?>" value="<?= $location['pos_id']?>">
									<img alt=" " src="/e-cafe/assets/images/delete.png" style="width: 20px; height:20px; ">
								</a>
							</td>
							<td><input type="radio" id="name<?= $i?>" name="deliveryLocation" value="<?= $location['pos_id']?>"></td>
						</tr>
					<?php endforeach; ?>
					<p id="posCount" style="display: none;"><?= $i?></p>
				</table>
				<?php if($i==0): ?>
					<p style="color: grey; font-size: 20px; ">no saved location</p>
				<?php endif;?> 
			</div>

			<div class="row" id="newLocation">
				<div id="newLocationCheckbox" class="twelve columns" style=" text-align: center; font-size: 20px;">
					<input type="checkbox" id="locationCheckBox" name=""> Choose new location
				</div>
				<div id="newLocationTable" class="twelve columns" style="display: none;">
					<h5 style="text-align: center; color: maroon;">New Location </h5>
					<table id="newPos_table">
						<tr>
							<th> </th>
							<th>NAME</th>
							<th>Latitude</th>
							<th>Longitude</th>
							<th>Accuracy</th>
							<th>use</th>
						</tr>
						
						<tr id="newLocRow">
							<td id="posCount"> </td>
							<td id="posName"> </td>
							<td id="latiName"> </td>
							<td id="longiName"> </td>
							<td id="AccyName"> </td>
							<td><input type="radio" id="newLocRadio" name="newDeliveryLocation" value=""></td>
						</tr>
					</table>
					<div style="display: none;">
						<p class="newLatiPos"> </p>
						<p class="newLongiPos"> </p>
					</div>
				</div>

				<div id="mapLocation" class="twelve columns">
					<div class="row" id="map" style="height: 500px; border: 1px solid #e7e7e7;">
				
					</div>
					<div class="row" id="locationData" style="display: none;">
						<div class="four columns"> 
							<label style="float: left;  padding-left:30px; padding-right: 20px;">Name: </label>
							<input type="text" id="pos_name" name="pos_name" style="float: left; padding-left:10px;">
						</div>
						<div class="four columns" >
							<label style="float: left; padding-right: 10px;">Lattitude:</label>
							<input type="text" name="latitude_cood" id="lati" style="float: left; padding-left:10px;">
						</div>
						<div class="four columns" >
							<label style="float: left; padding-right: 10px;">Longitude: </label>
							<input type="text" name="longitude_cood" id="longi" style="float: left; padding-left:10px;">
						</div>
					</div>
					<div class="row" id="locationData2" style="display: none;">
						<div class="four columns"> 
							<label style="float: left;  padding-left:30px; padding-right: 20px;">Accuracy: </label>
							<input type="text" id="accuracy" name="accuracy" style="float: left; padding-left:10px;">
						</div>
						<div class="four columns" >
							<label style="float: left; padding-right: 10px;">altitude:</label>
							<input type="text" name="altitude" id="alti" style="float: left; padding-left:10px;">
						</div>
						<div class="four columns" >
							<label style="float: left; padding-right: 10px;">Altitude Accuracy: </label>
							<input type="text" name="altitude_accuracy" id="alti_accy" style="float: left; padding-left:10px;">
						</div>
					</div>
				</div>
			</div>
		</div>	

		<div id="tableButtons" style="padding-top: 30px;">
				<div class="two columns" style="padding-left: 40px; ">
					<button href="#" class="button" id="prev1" class=" "> PREV </button>
				</div>
				<div class="eight columns">
					<p> </p>
				</div>
				<div class="two columns" style="padding-right: 50px; ">
					<button href="#" class="button" id="next1">NEXT</button>
				</div>  	
		</div>	

	</div>
<!----------------------------- Choose your Location area Ends --------------------------->


<!-------------------------- Nearest Delivery Personel area Bigins ------------------------>
	<div class="row" id="DeliveryPerson" style="min-height: 400px; display: none;">	
		<div id="LOCALE" style="padding-top: 30px; text-align: center;">
			<div class="row"><h4> NEAREST DELIVERY PERSON</h4></div>
			<div class="row" id="personel" style="min-height: 100px;">

				<table id="locationTable">
					<tr>
						<th style="padding-left:10px;"> profile</th>
						<th>NAME</th>
						<th>PHONE NUMBER</th>
						<th>DELIVERY MEANS</th>
						<th> price/km</th>
						<th>Distance From Restaurant</th>
						<th>Estimated Delivery Time</th>
						<th>Total Delivery Price</th>
						<th> pick</th>
					</tr>
					<?php 
					$i = 0; 
					foreach($this->delivery_person_data as $deliveryPerson): 
					$i++;
					?>
					
					<tr>
						
						<td style="padding-left:10px; ">
							<img src="<?= $deliveryPerson['profile_picture']?>" style="height: 50px; width: 50px;">
						</td>
						<td><?= $deliveryPerson['first_name']?> <?= $deliveryPerson['second_name']?></td>
						<td><?= $deliveryPerson['phone_number']?></td>
						<td><?= $deliveryPerson['delivery_means']?></td>
						<td id="km_price<?= $deliveryPerson['delivery_person_id']?>" value="<?= $deliveryPerson['delivery_price']?>">
							Ksh <?= $deliveryPerson['delivery_price']?> 
						</td>
						<td id="distance<?= $deliveryPerson['delivery_person_id']?>"> </td>
						<td id="time<?= $deliveryPerson['delivery_person_id']?>"> </td>
						<td id="t_price<?= $deliveryPerson['delivery_person_id']?>"><?= $deliveryPerson['delivery_price']?></td>
						<td>
							<input type="radio" id="DP<?= $deliveryPerson['phone_number']?>" name="selectDvryPn" value="<?= $deliveryPerson['delivery_person_id']?>">
						</td>
					</tr>
					<?php 
					
					endforeach; ?>
					<p id="count" style="display: none;"><?= $i?></p>
				</table>
				<?php if($i==0): ?>
					<p style="color: grey; font-size: 20px; ">no delivery person available</p>
				<?php endif;?>

			</div>
			 
			<div class="row" id="restaurantLocation" style="display:none;">
				<table id="restaurantLocationTable">
					<tr>
						<th> </th>
						<th>RESTAURANT NAME</th>
						<th>LOCATION NAME</th>
						<th>LATITUTE COOD</th>
						<th>LONGITUDE COOD</th>
						<th>LOC DESCRIPTION</th>
					</tr>
					<?php 
					$i = 0; 
					foreach($this->selected_data as $r_location): 
					$i++;
					?>
					<tr id="row<?= $i?>">
						<td>
							<a href="" id="posLink<?= $i?>" value="<?= $r_location['r_pos_id']?>">
								<img alt=" " src="/e-cafe/assets/<?= $r_location['restaurant_profile_picture']?>" class="foodImage" style="width: 50px; height:50px; padding-left: 30px;">
							</a> 
						</td>
						<td id="r_r_name<?= $i?>">	<?= $r_location['restaurant_name']?>	</td>
						<td id="r_name<?= $i?>">	<?= $r_location['r_pos_name']?>			</td>
						<td id="r_lati<?= $i?>">	<?= $r_location['r_latitude_cood']?>	</td>
						<td id="r_longi<?= $i?>">	<?= $r_location['r_longitude_cood']?>	</td>
						<td id="r_dptn<?= $i?>">	<?= $r_location['r_pos_description']?>	</td>
					</tr>
					<?php 
					
					endforeach; ?>
					<p id="r_loc_Count" style="display: none;"><?= $i?></p>
				</table>
			</div>


			<div class="row" id="deliveryPersonLocation" style="display:none;">
				<table id="deliveryPersonLocationTable">
					<tr>
						<th> </th>
						<th> id</th>
						<th>LOCATION NAME</th>
						<th>LATITUTE COOD</th>
						<th>LONGITUDE COOD</th>
						<th>HEADING</th>
					</tr>
					<?php 
					$i = 0; 
					foreach($this->deliveryPeople_locations as $d_location): 
					$i++;
					?>
					<tr id="row<?= $i?>">
						<td>
							<a href="" id="dPosLink<?= $i?>" value="<?= $d_location['d_pos_id']?>">
								<img alt=" " src="/e-cafe/assets/<?= $r_location['delivery_person_profile_picture']?>" class="foodImage" style="width: 50px; height:50px; padding-left: 30px;">
							</a> 
						</td>
						<td id="d_name<?= $i?>">	
							<?= $d_location['pos_id']?> 
						</td>
						<td id="d_name<?= $i?>">	<?= $d_location['pos_name']?>		</td>
						<td id="d_lati<?= $i?>">	<?= $d_location['latitude_cood']?>	</td>
						<td id="d_longi<?= $i?>">	<?= $d_location['longitude_cood']?>	</td>
						<td id="d_p_id<?= $i?>"><?= $d_location['delivery_person_id']?></td>
					</tr>
					<?php 
					
					endforeach; ?>
					<p id="d_loc_Count" style="display: none;"><?= $i?></p>
				</table>
			</div>

			<div id="viewDiv">
				
			</div>
		</div>
		<div id="tableButtons" style="padding-top: 30px;">
				<div class="two columns" style="padding-left: 40px; ">
					<button href="#" class="button" id="prev2" class=" ">PREV </button>
				</div>
				<div class="eight columns">
					<p> </p>
				</div>
				<div class="two columns" style="padding-right: 50px; ">
					<button href="#" class="button" id="next2">NEXT</button>
				</div>  	
		</div>	
	</div>
<!-------------------------- Nearest Delivery Personel area Ends ------------------------>


<!------------------------------ PRICE and Payment area Bigins ---------------------------->
	<div class="row" id="payment" style="min-height: 400px; display: none;">
						
	</div>
<!------------------------------ PRICE and Payment area Ends ---------------------------->

<div class="row" style="height: 80px;">
	<h3>  </h3>
</div>

<script src="/e-cafe/assets/arcgis_js_api/library/4.10/init.js"></script>
<script src="/e-cafe/assets/arcgis_js_api/library/4.10/dojo/dojo.js"></script>
        <!--<script src="bootstrap/dist/js/bootstrap.min.js"> -->
<script type="text/javascript">

	//SELECTED ORDER
	$(function(){
		$("#next0").click(function(event){
			event.preventDefault();
			$("#customerLocation").css("display","block");
			$("#selectedOrder").css("display","none");
		});
		$("#prev0").click(function(event){
			event.preventDefault();
			$("#restaurantsTableDiv").css("display", "block");
			$("#selectedOrder").css("display", "none");
		});
	});
	//REMOVE SELECTED ROW
		$(function(){
			var maxRow = $("#selectedCount").text();
			for (var i = maxRow; i > 0; i--) {
				var row = "link"+i;
				$("#"+row).click(function(event){
					event.preventDefault();
					var rowId = "row"+$(this).attr("value");
					var qnty = "qnty"+$(this).attr("value");
					$("#"+rowId).css("display", "none");
					$("#"+qnty).text("0");
					var status = 0;
					for (var j = maxRow; j > 0; j--) {
						var qnty2 = "#qnty"+j;
						//alert(""+rowId2);
						if($(qnty2).text()>=1) {
							status=status+1;
						}
					}
					if (status==0) {
						$("#restaurantsTableDiv").css("display", "block");
						$("#selectedOrder").css("display", "none");
					}
				});
			}
		});
		

	//CHOOSE DELIVERY TIME
	$(function(){
		$("#deliverNow").click(function(){
			if (this.checked) {
				$("#deliverDate").css("display","none");
			}else{
				$("#deliverDate").css("display", "block");
			}
		});
	});
	// Date and Time SELECT management
		$(function(){
			$("#daySelect").change(function(event){
				for (var i = 23; i >= 0; i--) {
					$(".newOption").css("display", "block");
				}
				for (var i = 59; i >= 0; i--) {
					$(".newOptionSeconds").css("display", "block");
				}
			});
			$("#hourSelect").change(function(event){
				for (var i = 59; i >= 0; i--) {
					$(".newOptionSeconds").css("display", "block");
				}
			});
		});
	//CUSTOMER LOCATION
	$(function(){
		var init = $("#posCount").text();
		for (var i = init; i > 0; i--) {
			///view saved location
			var savedLoc = "#viewSavedLoc"+i+"";
			var deleteLoc = "#deleteLoc"+i+"";
			$(savedLoc).click(function(event){
				var p_id = $(this).attr("value");
				var la_cood = $("#c_lati"+p_id).attr("value");
				var lo_cood = $("#c_longi"+p_id).attr("value");
				$("#mapLocation").css("display","block");
				savedlocation(la_cood, lo_cood);
			});	
			///DELETE SAVED LOCATION
			$(deleteLoc).click(function(event){
				var p_id = $(this).attr("value");
				//alert("LOC_ID:- "+p_id);
				$.post("foodCart.php",
			    {
			        delete_loc_id: p_id
			    },
			    function(data, status){
			        if (data==1) {
						alert("LOCATION DELETED!!!");
						$("#position"+p_id).css("display", "none");
						$("input[name='deliveryLocation']").prop("checked", false);
					}else{
						alert("DELETE LOCATION FAILED!!");
					}
			    });
			});
		}


		$("#locationCheckBox").click(function(){
			if (this.checked) {
				$("#mapLocation").css("display","block");
				$("#newLocationTable").css("display", "block");
				mylocation();
			}else{
				$("#mapLocation").css("display", "none");
				$("#newLocationTable").css("display", "none");
			}
		});
		
		$("#next1").click(function(event){
			event.preventDefault();
			var	radioChkd =0;//
			var	newRadioChkd =0;
			if ($("input[name='deliveryLocation']:checked").length>0) {
				radioChkd=radioChkd+1;
			}else if ($("input[name='newDeliveryLocation']:checked").length>0) {
				newRadioChkd=newRadioChkd+1;
			}
			if (radioChkd>0) {
				var c_loc_id;
				if ($("input[name='deliveryLocation']:checked").length>0) {
					c_loc_id = $("input[name='deliveryLocation']:checked").attr("value");
				}
				var c_latitude = $("#c_lati"+c_loc_id).attr("value");
				var c_longitude = $("#c_longi"+c_loc_id).attr("value");
				$("#DeliveryPerson").css("display","block");
				$("#customerLocation").css("display","none");
				deliveryPeoplelocation(c_latitude, c_longitude);
			}else if (newRadioChkd>0) {
				if ($("input[id='newLocRadio']:checked")) {
					var pos_name = $("#pos_name").val();
					var lati_cood = $("#lati").val();
					var longi_cood = $("#longi").val();
					var pos_accy = $("#accuracy").val();
					$.ajax({
						url: 'foodCart.php',
						method: 'GET',
						data: {
							PosName: pos_name,
							LatiCood: lati_cood,
							LongiCood: longi_cood,
							PosAccy: pos_accy
						},
						success: function(response){
							var l_coodinate1 = "c_longi"+response; 
							var l_coodinate2 = "c_lati"+response;
							$("input[id='newLocRadio']").val(response.trim());
							$(".newLongiPos").attr("value",longi_cood.trim());
							$(".newLongiPos").attr("id",l_coodinate1.trim());
							$(".newLatiPos").attr("value", ""+lati_cood);
							$(".newLatiPos").attr("id", "c_lati"+response);
							deliveryPeoplelocation(lati_cood, longi_cood);	
						},
						error: function(){
							alert("error"+url);
						}
					});
				}
				
				$("#DeliveryPerson").css("display","block");
				$("#customerLocation").css("display","none");
			}else{
				alert("No location Selected");
			}
		});
		$("#prev1").click(function(event){
			event.preventDefault();
			$("#selectedOrder").css("display", "block");
			$("#customerLocation").css("display", "none");
		});
	});
	//Location Radio Button

	//Delivery Personel
	$(function(){
		$("#next2").click(function(event){
			event.preventDefault();
			var	radioChkd =0;
			if ($("input[name='selectDvryPn']:checked").length>0) {
				radioChkd=radioChkd+1;
			}
			if (radioChkd>0) {
				var selected_order = [];
				var qnty =[];
				var cur_date = 0;
				var delivery_date;
				var delivery_time; 
				var loc_id = 0;
				var deliveryPerson_id = $("input[name='selectDvryPn']:checked").val();
				var status = "AT_RESTAURANT";
				//SELECTED FOOD
				var status = 0;
				var maxRow = $("#selectedCount").text();
				for (var i = maxRow; i > 0; i--) {
					var row = "link"+i;
					var O_id = $("#imgLink"+i).attr("value");
					var qnty1 = "#qnty"+i; 
					if($(qnty1).text()>=1) {
						selected_order[i]=O_id;
						qnty[i]= Number($(qnty1).text());
					}else {
						selected_order[i]=0;
						qnty[i]=0;
					}
				}
				//TIME  $("#deliverNow").checked $("#deliverNow") 
				if ($('#deliverNow').is(':checked')) {
					cur_date = 1;
					delivery_time = "00:00:00";
					delivery_date = "0000-00-00";
					status = "AT_RESTAURANT";
				}else{
					//daySelect/monthSelect/yearSelect//hourSelect/minuteSelect
					cur_date = 0;
					var hour = $("#hourSelect").val();
					var minute = $("#minuteSelect").val();
					var month = $("#monthSelect").val();
					var day = $("#daySelect").val();
					if (hour<10) {
						hour  = "0"+$("#hourSelect").val();
					}else{
						hour  = $("#hourSelect").val();
					}
					if (minute<10) {
						minute = "0"+ $("#minuteSelect").val();
					}else{
						minute = $("#minuteSelect").val();
					}
					if (month<10) {
						month = "0"+$("#monthSelect").val();
					}else{
						month = $("#monthSelect").val();
					}
					if (day<10) {
						day = "0"+$("#daySelect").val();
					}else{
						day = $("#daySelect").val();
					}
					
					delivery_time = hour+":"+minute+":00";
					delivery_date = $("#yearSelect").val()+"-"+month+"-"+day;
					status = "SCHEDULED_DELIVERY";
				}
				//LOCATION
				radioChkd = 0;
				if ($("input[name='deliveryLocation']:checked").length>0) {
					radioChkd=radioChkd+1;
					loc_id = $("input[name='deliveryLocation']:checked").val();
				}
				if (radioChkd==0) {
					if ($("input[id='newLocRadio']:checked")) {
						loc_id = $("input[id='newLocRadio']").val();
					}
				}
				//DELIVERY PERSON
				var d_id = deliveryPerson_id.toString();
				var delDistance = 0;
				delDistance = $("#distance"+d_id).attr("value");
				var priceKM = 0; 
				priceKM = $("#km_price"+d_id).attr("value");
				var delPrice =0;
				delPrice = $("#t_price"+d_id).attr("value");
				for (var i = selected_order.length - 1; i > 0; i--) {
					if (selected_order[i]>0) {
						$.post("selectedOrder.php",
					    {
					        food_order_id: selected_order[i],
					        food_qnty: qnty[i],
					        food_delivery_time: delivery_time,
					        food_delivery_date: delivery_date,
					        position_id: loc_id,
					        delivery_person_id: deliveryPerson_id,
					        delivery_price: delPrice,
					        delivery_distance: delDistance,
					        price_per_km: priceKM,
					        food_status: status
					    },
					    function(data, status){
					        alert("Data: " + data + "\nStatus: " + status);
					    });
					}
				}
				$.ajax({    
					url: 'preOrder.php',
					method: 'GET',
					data: loadPreOrders=true,
					success: function(response){
						//alert("res: "+response);
						$("#payment").html(response);
						$("#payment").css("display","block");
						$("#DeliveryPerson").css("display","none");
					},
					error: function(){
						alert("error"+url);
					}
				});
			}else{
				alert("No Delivery Person Selected");
			}
		});
		$("#prev2").click(function(event){
			event.preventDefault();
			$("#customerLocation").css("display", "block");
			$("#DeliveryPerson").css("display", "none");
		});
	});
	//Payment
	$(function(){
		$("#next3").click(function(event){
			event.preventDefault();
		});
		$("#prev3").click(function(event){
			event.preventDefault();
			$("#DeliveryPerson").css("display", "block");
			$("#payment").css("display", "none");
		});
	});
</script>
<script type="text/javascript" src="/e-cafe/assets/js/showCustomerLocation.js"></script>
<script type="text/javascript" src="/e-cafe/assets/js/showDeliveryPeopleLocation.js"></script>
<script type="text/javascript" src="/e-cafe/assets/js/viewSavedLocation.js"></script> 