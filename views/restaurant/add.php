<?php
	if(isset($this->id)) {
	?>
	<script type="text/javascript">
		alert("New Restaurant has been successfully added");
	</script>
	<?php
	}

	require_once("addRestaurant.html");
?>