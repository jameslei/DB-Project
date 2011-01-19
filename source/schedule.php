<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$schedule = Schedule::find($id);
	// print_r($schedule);
	// echo $schedule;
	//$id, $time, $next, $place, $description, $did
	$next = $schedule->next();
	$date = Day::find($schedule->did)->date;
	$location = Location::find($schedule->lid);
?>
<!-- <h1 align="center"><?php echo $schedule->place ; ?></h1> -->
<div>
        <table>
			<tr>
				<th colspan ="2" class="head"><?php echo $location->name ; ?></th>
			</tr>
        	<tr>
        		<td>日期</td>
        		<td><?php echo $date; ?></td>
        	</tr>
			<tr>
				<td>時間</td>
				<td><?php echo $schedule->time;?></td>
			</tr>
			<tr>
				<td>地點</td>
				<td><?php echo $location->name;?></td>
			</tr>
			<tr>
				<td>內容</td>
				<td><?php echo $schedule->description;?></td>
			</tr>
			<tr>
				<td>下一筆</td>
				<td><a href="schedule.php?id=<?php echo $next->id?>"><?php echo $next->description?></td>
			</tr>

        </table>
    </div>

<?php require_once "template/footer.php"; ?>