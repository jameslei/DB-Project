<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$trip = Trip::find($id);
	// find all the days of the trip
	$days = $trip->get_days(); // $days contains all the days of the trip
	$count = 0;
	// $all_days = [];
	while($row = mysql_fetch_row($days)){
		$all_days[] = new Day($row[1], $row[2], $row[3]);
		$all_days[$count++]->id = $row[0];
	}
	
	
?>
<div align="center">
		<h1><?php echo $trip->name ; ?></h1>
</div>
<table>
	
	<tr>
		<th>Date</th>
		<th>Location</th>
		<th></th>
	</tr>
	
	<?php
		for($i=0; $i<$count; $i++){
			$day = $all_days[$i];
			// print_r($day);
			$location = $day->get_location();
			$did = $day->id;
			echo "<tr><td>$day->date</td>";
			if (sizeof($location)==1){
				// print_r($location[0]);
				echo"<td>".$location[0]."</td>";
			}else{
				echo"<td>";
				foreach($location as $item){
					echo"$item/";
				}
				
			}
			echo"</td><td><a href=\"day.php?id=$did\">view more</a></td></tr>";
		}
		
	?>
<!-- display the days of the trip -->
</table>
<div align="center">
<a href="index.php">Index</a>  <a href="add_day.php?id=<?php echo $trip->id?>">Add a day</a></div>
<?php require_once "template/footer.php"; ?>