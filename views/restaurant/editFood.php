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
			background-color: white;
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
	<?php $i = 0; foreach($this->editedFood_data as $edited_food): $i++; ?>
		<!-- EditFood area Begins &nbsp; -->
			<div class="row" id="addFoodBlock" style="height:100%; border: 1px solid #e7e7e7; background-color: #f3f3f3; ">
				<div class="twelve columns" id="sectionTitle"> 
					<h3>EDIT FOOD</h3> 
				</div>
				<div class="twelve columns">
					<form id="addFoodForm" action="index.php" class="add_food_form" method="post" enctype="multipart/form-data">


						<fieldset id="formSection0_Edit">
							<div class="row" id="rowform">
							<!--Food Name Margin  -->
								<div class="six columns" id="columnform">
									<div class="twelve columns">
										<label id="addfoodlabel_Edit" style="float: left;"> Food Name: </label>
										<input id="foodName_Edit" class="addfoodinput" type="text" name="food_name_Edit"style="float: left;" value="<?=$edited_food['food_name']?>">
									</div>
									<div class="twelve columns">
										<em id="food_name-error_Edit" class="error">This field is required.</em>
									</div>	
								</div>

							<!--food category  -->
								<div class="six columns" id="columnform" >
									<div class="twelve columns">
										<label id="addfoodlabel_Edit" style="float: left;"> Food Category:</label>
										<input id="foodCategory_Edit" type="text" name="food_category_Edit" class="addfoodinput" placeholder=" " style="float: left;" value="<?=$edited_food['food_category']?>">
									</div>
									
									<div class="twelve columns">
										<em id="food_category-error_Edit" class="error">This field is required.</em>
									</div>
								</div>
							</div>
							<div class="row" id="rowform">
							<!--quantity  -->
								<div class="six columns" id="columnform">
									<div class="twelve columns">
										<label id="addfoodlabel_Edit" style="float: left;">Food Quantity: </label>
										<input id="quantity_Edit" type="text" name="quantity_Edit" class="addfoodinput" placeholder=" " style="float: left;" value="<?=$edited_food['quantity']?>">
									</div>
									
									<div class="twelve columns">
										<em id="quantity-error_Edit" class="error">This field is required.</em>
									</div>
								</div>

							<!--price  -->
								<div class="six columns" id="columnform">
									<div class="twelve columns" style="padding-bottom: 0px;">
										<label id="addfoodlabel_Edit" style="float: left;"> Food Price: </label>
										<input id="price_Edit" type="text" name="price_Edit" class="addfoodinput"  placeholder=" " style="float: left;" value="<?=$edited_food['price']?>">
									</div>
									<div class="twelve columns">
										<em id="price-error_Edit" class="error">This field is required.</em>
									</div>
								</div>
							</div>
							<div class="row" id="rowform">
							<!--food description  -->
								<div class="six columns" id="columnform">
									<div class="twelve columns">
										<label id="addfoodlabel_Edit" style="float: left;"> Food Description: </label>
										<textarea id="foodDescription_Edit" name="food_description_Edit" placeholder=" " class="addfoodinput" style="float: left;"value="<?=$edited_food['food_description']?>"><?=$edited_food['food_description']?></textarea>
									</div>
								</div>
							</div>

							<div class="row" id="rowform" style="min-height: 20px; text-align: center;">
								<h4>new Food Image</h4>
							</div>
							<div class="row" style="height: 200px; width: 200px; padding-left: 43%;">
								<div class="four columns">
									<h3> </h3>
								</div>
								<div class="four columns">
									<img id="newImage" src="/e-cafe/assets/<?= $edited_food['picture_id']?>" class="foodImage" style="width: 200px; min-height: 200px">
								</div>
								<div class="four columns">
									<input type="file" name="profileToUpload" id="image-upload" accept="image/*" value="<?= $edited_food['picture_id']?>">
									<label for="cover-upload" id="coverPic">
										<img src="/e-cafe/assets/images/camera.png" style="padding-left: 53px; position: relative; float: auto;">
									</label>
								</div>
							</div>
							<p id="fID" style="display:none;"><?= $edited_food['food_id']?></p>
							<!-- button  -->
								<div class="row" style="padding-right: 60px; padding-top: 60px;">
									
									<button href="#" id="updateFood_Edit" style="background: maroon; color: white; float: right; " >UPDATE &gt;</button>
								</div>

						</fieldset>	
					</form>
				</div>
			</div>

		<!--AddFood area Ends -->
	<?php endforeach; ?>
</div>
<script type="text/javascript">
	$("input[type='text']").change(function(){
			var name = $(this).attr('name');
			var errorName = "#"+name+"-error";
			if ($("input[name='"+name+"']").val().trim()==="") {
				$(""+errorName).css("display", "block");
			}else{
				$(""+errorName).css("display", "none");
			}
	});
	$("#image-upload").change(function(e){
		readURL(this);
		var imageName = e.target.files[0].name;
		var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
	    if (isGood) {
	      
	    } else {
	      alert("NOt an image");
	    }
		
	});
	function readURL(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$("#newImage").attr('src', e.target.result);
				
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	function getFileName(input){

	}
	$("#updateFood_Edit").click(function(event){
		event.preventDefault();
		alert("UPDATE FOOD CLICKED");
		//food_name_Edit/ood_category_Edit/quantity_Edit/price_Edit/food_description_Edit/profileToUpload
		var intError = 0;
		if($("input[name='food_name_Edit']").val()===""){
			//alert("kjhg");
			intError = 1;
			$("#food_name-error_Edit").css("display", "block");
		}
		if($("input[name='food_category_Edit']").val()===""){
			intError = 2;
			$("#food_category-error_Edit").css("display", "block");
		}
		if ($("input[name='quantity_Edit']").val()==="") {
			intError = 3;
			$("#quantity-error_Edit").css("display", "block");
		}
		if ($("input[name='price_Edit']").val()==="") {
			intError = 4;
			$("#price-error_Edit").css("display", "block");
		}
		//alert(in)
		if(intError===0){
			var food_id = $("#fID").text();
			$.post("index.php",
		    {
		        Food_ID: food_id,
		        FNAME: $("input[name='food_name_Edit']").val(),
		        FQNTY: $("input[name='quantity_Edit']").val(),
		        FPRICE: $("input[name='price_Edit']").val(),
		        FCGRY: $("input[name='food_category_Edit']").val(),
		        FDES: $("input[name='food_description_Edit']").text()
		    },
		    function(data, status){
		    	alert(data+"..."+status);
		    });
		}		
	});
		
	
</script>
