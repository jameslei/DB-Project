<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$trip = Trip::find($id);
	// find all the days of the trip
	$days = $trip->get_days; // $days contains all the days of the trip
	$temp = 0;
	while(mysql_fetch_row($days)){
		
	}
	
	
?>
<table>
	<tr>
		<th><?php echo $trip->name ; ?></th>
	</tr>
<!-- display the days of the trip -->
</table>
<div align="center">
<a href="index.php">Index</a>  <a href="add_day.php">Add a day</a></div>
<?php require_once "template/footer.php"; ?>