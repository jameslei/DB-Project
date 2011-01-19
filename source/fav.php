<?php require_once "template/header.php"; 

      $account = Account::find($_SESSION['aid']);
      $traveller = $account->traveller;
	  $uid = ($traveller->id);
      if (isset($_GET['uid'])){//all DAYs
        //echo "<div id="favorite" class="forty-five right">";
        echo "<h1>♥</h1>";       
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
            echo "尚無資料";
        }
       //echo "</div>"; 
       //$trip = Trip::find($_GET['id']);
       //$days = $trip->get_days();
      }
      if (isset($_GET['tid'])){//specfic DAY  
          //$day = Day::find($_GET['did']);
          //$location = Location::find();
		echo "<h1>?</h1>";       
        $favor_array = Trip::getFavor($tid);
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
      }
	  if (isset($_GET['lid'])){//specfic LOCATION
	    echo "<h1>?</h1>";       
        $favor_array = Location::getFavor($lid);
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

	  }
	  ?>
	  <ul>
          <li><a href = "<?php echo "newfav.php"?>">新增</a></li>
      </ul>
<?	  
      
?>



<?php require_once "template/footer.php"; ?>
