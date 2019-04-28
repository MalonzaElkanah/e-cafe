<?php 
	require_once("get.html");
?>

<div id="getMenu">
	<table>
		<tr>
			<th>restaurant Id</th>
			<th>Food Name</th>
			<th>price</th>
		</tr>
		<?php foreach($this->menu_data as $food): ?>
		<tr>
			<td><?= $food['restaurant_id']?></td>
			<td><?= $food['food_name']?></td>
			<td><?= $food['price']?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>