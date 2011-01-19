<?php require_once "template/header.php"; ?>

<?php
	$id = $_GET["id"];
	$schedule = Schedule::find($id);
	//$id, $time, $next, $place, $description, $did
	$next = Schedule::find($next);
	$date = Day::find($did)->date;
?>
<h1 align="center"><?php echo $schedule->name ; ?></h1>
<div id="dashboard">
    <div id="day" class="sixty left">
        <table>
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
				<td><a href="schedule.php?id=<?php echo $next->id?>"><?php echo $next->name?></td>
			</tr>

        </table>
    </div>

<?php require_once "template/footer.php"; ?>