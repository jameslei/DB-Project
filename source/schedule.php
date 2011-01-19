<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$schedule = Schedule::find($id);
	// print_r($schedule);
	// echo $schedule;
	//$id, $time, $next, $place, $description, $did
	$next = Schedule::find($schedule->next);
	// print_r($next);
	$date = Day::find($schedule->did)->date;
?>
<!-- <h1 align="center"><?php echo $schedule->place ; ?></h1> -->
<div id="dashboard">
        <table>
			<tr>
				<th colspan = "2"><?php echo $schedule->place ; ?></th>
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
				<td><?php echo $schedule->place;?></td>
			</tr>
			<tr>
				<td>內容</td>
				<td><?php echo $schedule->description;?></td>
			</tr>
			<tr>
				<td>下一筆</td>
				<td><a href="schedule.php?id=<?php echo $next->id?>"><?php echo $next->place?></td>
			</tr>

        </table>
    </div>

<?php require_once "template/footer.php"; ?>