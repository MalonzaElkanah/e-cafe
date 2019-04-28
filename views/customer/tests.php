<?php if(isset($this->init)): ?>
		
	<?php 
	$ijk = 0;
	//foreach($this->init as $num): 
	for ($i=0; $i < $this->init; $i++):
		?>	

		<table id="restaurantTable">
			<tr>
				<th> profile picture </th>
				<th>First NAME</th>
				<th>second Name</th>
				<th>Phonee</th>
				<th>description </th>
				<th>email </th>
			</tr>

			<?php 
			$loc_data = 'loc_data_'.$ijk;
			if(isset($this->$loc_data)): ?>

				<?php 
				$i = 0; 
				foreach($this->$loc_data as $loc): 
				$i++;
				?>
					<tr id="row<?= $i?>">
						<td>
							<a href="" >
								<img alt=" " src="/e-cafe/assets/<?= $loc['profile_picture']?>" class="foodImage" style="width: 50px; height:50px; padding-left: 30px;">
							</a> 
						</td>
						<td ><?= $loc['pos_name']?>	</td>
						<td >	<?= $loc['Date']?></td>
						<td ><?= $loc['latitude_cood']?>	</td>
						<td >	<?= $loc['description']?></td>
						<td>
								<?= $loc['longitude_cood']?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>	
		</table>
	<?php 
	$ijk++;
	endfor; ?>
<?php else: ?>
	<h1>INIT NOT SET</h1><p><? echo $this->init; ?></p>
	<div id="tableButtons" style="padding-top: 30px;">
		<div class="two columns" style="padding-left: 40px; ">
			<button href="#" class="button" id="prev3" class=" "> PREV </button>
		</div>
		<div class="eight columns">
			<p> </p>
		</div>
		<div class="two columns" style="padding-right: 50px; ">
			<button href="#" class="button" id="next3">NEXT</button>
		</div>  	
	</div>	
<?php endif; ?>	










<!-- ss-->
