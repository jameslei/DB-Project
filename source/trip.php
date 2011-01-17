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
<h1><?php echo $trip->name ; ?></h1>
<div id="dashboard">
    <div id="day" class="left">
        <table>
        	<tr>
        		<th>日期</th>
        		<th>目的地</th>
        		<th></th>
        	</tr>
            <!-- display the days of the trip -->
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
        </table>
        <ul>
            <li><a href="add_day.php?id=<?php echo $trip->id?>">新增下一天</a></li>
        <ul>
    </div>
    <div class="right">
        <h1>成員</h1>
        <table>
            <tr>
                <td>李永裕</td>
            </tr>
            <tr>
                <td>史繼中</td>
            </tr>
        </table>
        <ul>
            <li><a href="#">更多...</a></li>
        </ul>
    </div>
    <div class="right">
        <h1>♥</h1>
        <table>
            <tr>
                <td>豬扒包</td>
                <td>澳門</td>
                <td>好好食!!</td>
            </tr>
            <tr>
                <td>葡撻</td>
                <td>澳門</td>
                <td>正!</td>
            </tr>
        </table>
        <ul>
            <li><a href="#">更多...</a></li>
        </ul>
    </div>
</div>
<?php require_once "template/footer.php"; ?>