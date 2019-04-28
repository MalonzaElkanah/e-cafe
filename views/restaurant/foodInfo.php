<head>
	<style type="text/css">

		.foodImage{
			display: block;
			margin-right: auto;
			margin-left: auto;
			width: 50%; 
		}
		.foodData{
			display: block;
			margin-right: auto;
			margin-left: auto;
			width: 50%; 
		}
		.infoContent{
			background-color: #2d3035;
		}
		.foodLabel{
			color: #0066ff;
			font-size: 20px;
			text-align: right;
		}
		.restaurantName{
			font-size: 30px;
			color: white;
		}
		.labelContent{
			color: white;
			font-size: 18px;
			background: #606060;
			border: 1px solid #505050; 
			border-radius: 5px 5px 5px 5px;
			padding-left: 7px;
			padding-right: 7px;
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
</head>

<div class="row infoContent">
	<?php $i = 0; foreach($this->info_data as $food): $i++; ?>
		<div class="twelve columns" style="text-align: center; color: #0066ff; padding-bottom: 30px; padding-top: 20px; font-size: 30px;">
			<h5><?= $food['food_name']?> </h5>
		</div>

		<div class="twelve columns" style="min-height: 200px; border:0px solid black;">
			<img alt=" " src="/e-cafe/assets/<?= $food['picture_id']?>" class="foodImage" style="margin: auto;">
		</div>

		<div class="twelve columns">
			<div class="foodData" style="text-align: center; padding-top: 20px;">
				<label class="restaurantName"> <?= $food['restaurant_name']?> Restaurant </label> 
			</div>
		</div>
		<div class="twelve columns" style="padding-top: 20px;">
			<div class="foodData">
				<div class="six columns foodName"> 
					<p style="color:white; font-size: 17px;" >
						price: <span class="labelContent"> kSh <?= $food['price']?> </span>
					</p>   
				</div>
				<div class="six columns foodName"> 
					<p style="color:white; font-size: 17px;" >
						rate: <span class="labelContent"> <?= $food['rate']?>5 Stars </span>
					</p> 
				</div>	
			</div>
		</div>
		<div class="twelve columns" style="padding-top: 10px;">
			<div class="foodData">
				<p style="color:white; font-size: 17px;" >
					available quantity: <span class="labelContent"> <?= $food['quantity']?> </span>
				</p>  
			</div>
		</div>
		<div class="twelve columns" style="padding-top: 10px;">
			<div class="foodData">
				<p style="color:white; font-size: 17px;" >
					category: <span class="labelContent"> <?= $food['food_category']?> </span> | <span class="labelContent"> <?= $food['restaurant_category']?> </span>
				</p>  
			</div>
		</div>
		<div class="twelve columns" style="padding-top: 10px;">
			<div class="foodData">
				<p style="color:white; font-size: 17px;" >
					food bio: <span class="labelContent"> <?= $food['food_description']?> </span>
				</p>  
			</div>
		</div>
	<?php endforeach; ?>
</div>

