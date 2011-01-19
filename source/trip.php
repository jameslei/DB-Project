<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$trip = Trip::find($id);
	// find all the days of the trip
	$day = $trip->first_day(); // $days contains all the days of the trip
?>
<h1 align="center"><?php echo $trip->name ; ?></h1>
<div id="dashboard">
    <div id="day" class="sixty left">
        <table>
        	<tr>
        		<th>日期</th>
        		<th>目的地</th>
        		<th></th>
        	</tr>
            <!-- display the days of the trip -->
            <?php while($day!=NULL){?>
            <tr>
                <td><a href="day.php?id=<?php echo $day->id;?>"><?php echo $day->date; ?></a></td>
                <td></td>
                <td></td>
            </tr>
            <?php $day = $day->next;} ?>
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
            <li><a href="create_day.php?id=<?php echo $trip->id?>">新增下一天</a></li>
        <ul>
    </div>
    <div class="thirty right">
        <h1>成員</h1>
        <table>
			<?php if ($trip->belongs_to=="traveller"){
				     echo "<tr><td>".Traveller::find($trip->owner_id)->name."</td></tr>";
			      }else{
					 $group = Group::find($trip->owner_id);
					 $member_list = $group->members();
					 foreach($member_list as $item){
					 	$traveller = Traveller::find($item->id);
  						$name = $traveller->name;
  						echo "<tr><td>".$name."</td></tr>";
					 }
					 
				  }?>
        </table>
        <ul>
            <li><a href="#">更多...</a></li>
        </ul>
    </div>
    <div class="thirty right">
        <h1>♥</h1>
        <?php
        $favor_array = Trip::getFavor($id);
        if($favor_array!=NULL){
            echo "<table>";
	        echo "<tr>";
            echo "<th>名字</th>";
	        echo "<th>時間</th>";
	        echo "<th>地點</th>";
	        echo "<th>備註</th>";
	        echo "</tr>";
            foreach ($favor_array as $favor_list){
		        echo "<tr>";
                echo "<td>$favor_list->name</td>";
		        echo "<td>$favor_list->time</td>";
				$lid = $favor_list->location_id;
				$location=Location::find($lid);
                echo "<td>$location->name</td>";
		        echo "<td>$favor_list->note</td>";
		        echo "</tr>";
            }
	        echo "</table>";
        }else{
            echo "尚無資料";
        }
        ?>
        <ul>
            <li><a href="#">新增</a></li>
            <li><a href=<?php echo "fav.php?uid=$uid"?>>更多</a></li>
        </ul> 
    </div>

</div>
<?php require_once "template/footer.php"; ?>