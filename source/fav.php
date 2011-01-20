<?php require_once "template/header.php"; 

      $account = Account::find($_SESSION['aid']);
      $traveller = $account->traveller;
	  $uid = ($traveller->id);
      if (isset($_GET['uid'])){//all DAYs
        //echo "<div id="favorite" class="forty-five right">";      
        $favor_array = Traveller::getFavor($_GET['uid']);
       //echo "</div>"; 
       //$trip = Trip::find($_GET['id']);
       //$days = $trip->get_days();
      }
      if (isset($_GET['tid'])){//specfic DAY  
          //$day = Day::find($_GET['did']);
          //$location = Location::find();     
        $favor_array = Trip::getFavor($_GET['tid']);
      }
	  if (isset($_GET['lid'])){//specfic LOCATION  
        $favor_array = Location::getFavor($_GET['lid']);
	  }
	  if (isset($_GET['did'])){//specfic LOCATION  
        $favor_array = Day::getFavor($_GET['did']);
	  }?>
	  <div class="sixty">
	      <div id="dashboard">
              <h1>♥</h1>
	  <?php
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
                  <li><a href = "<?php echo "newfav.php"?>">新增</a></li>
              </ul>
        </div>
    </div>
<?php require_once "template/footer.php"; ?>
