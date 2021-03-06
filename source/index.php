<?php require_once "template/header.php"; ?>

<?php $user = Account::find($_SESSION['aid']); ?>

<p class="welcome">你好! <?php echo $user->traveller->name; ?>, 你可以按此<a href="logout.php">登出</a>.</p>

<div id="dashboard">
    <div id="trip" class="forty-five left">
        <h1>旅程</h1>
        <?php 
        $traveller = $user->traveller;
        $uid = ($traveller->id);
        $trip_array = Traveller::getTrip($uid);
        $t_id=$user->traveller->id; 
        if($trip_array!=NULL){
            echo "<table>";
	        echo "<tr>";
	        echo "<th>開始日期</th>";
	        echo "<th>旅程名稱</th>";
	        echo "</tr>";
            foreach ($trip_array as $trip_list){
	            echo "<tr>";
		        echo "<td>$trip_list->time</td>";
		        echo "<td>";
		        echo "<a href = trip.php?id=$trip_list->id>";
		        echo "$trip_list->name";
	            echo "</a>";
	            echo "&nbsp;<a href=\"edittrip.php?id=$trip_list->id\" style=\"float:right; padding: 0 5px;\">E</a>";
	            echo "&nbsp;<a href=\"delete.php?tid=$trip_list->id\" style=\"float:right;\">X</a>";
		        echo "</td>";
		        echo "</tr>";
            }
	        echo "</table>";
        }else{
            echo "<table><tr><td>尚無資料</td></tr></table>";
        }
        ?>      
        <ul>
            <li><a href = "<?php echo "newtrip.php?id=$t_id&belongs_to=traveller"?>">新增</a></li>
        </ul>
    </div>

    <div id="group" class="forty-five right">
        <h1>群組</h1>
        <?php
        $group_array = Traveller::getGroup($uid);
        if($group_array!=NULL){
            echo "<table>";
	        echo "<tr>";
            echo "<th>群組名稱</th>";
	        echo "<th>描述</th>";
	        echo "<th>人數</th>";
	        echo "</tr>";
            foreach ($group_array as $group_list){
	            $gid = $group_list->id;
	            $count = GROUP::getCount($gid);
		        echo "<tr>";
				echo "<td>";
				echo "<a href = group.php?id=$gid > ";
		        echo "$group_list->name";
				echo "</a>";
				echo "</td>";
		        echo "<td>";	        
		        echo "$group_list->description";	            
		        echo "</td>";
		        echo "<td>$count</td>";
		        echo "</tr>";
            }
	        echo "</table>";
        }else{
            echo "<table><tr><td>尚無資料</td></tr></table>";
        }
        ?>
        <ul>
        <li><a href = "<?php echo "newgroup.php"?>">開團</a></li>
        </ul>
    </div>

    <div id="city" class="forty-five left">
        <h1>城市</h1>
        <?php
        $city_array = Traveller::getCity($uid);		
        if($city_array!=NULL){
            echo "<table>";
            foreach ($city_array as $city_list){
		        echo "<tr>";
		        echo "<td>$city_list->name</td>";
		        echo "</tr>";
            }
	        echo "</table>";
        }else{
            echo "<table><tr><td>尚無資料</td></tr></table>";
        }
        ?>
    </div>

    <div id="favorite" class="forty-five right">
        <h1>♥</h1>
        <?php
        $favor_array = Traveller::getFavor($uid);
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
            echo "<table><tr><td>尚無資料</td></tr></table>";
        }
        ?>
        <ul>
            <!-- <li><a href="newfave.php">新增</a></li> -->
            <li><a href=<?php echo "fav.php?uid=$uid"?>>更多</a></li>
        </ul> 
    </div>

</div>

<?php require_once "template/footer.php"; ?>