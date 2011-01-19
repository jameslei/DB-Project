<?php require_once "template/blank.php";
	  $user = Account::find($_SESSION['aid']); 
	  // print_r($user);
	  $uid = $user->traveller->id;
      $day = Day::find($_GET['id']);
      $cid = $_POST['location'];
      $name = $_POST['name'];
	  $city = City::find($cid);
	  $user_city = mysql_query("SELECT * FROM `TRAVELLER_CITY` WHERE `cid`=$cid AND `uid`=$uid;");
	  if (! $city_is_visited=mysql_fetch_row($user_city)){
    	  $query = "INSERT INTO `TRAVELLER_CITY` (`cid`, `uid`) VALUES ($cid, $uid);";
    	  $result = mysql_query($query);
      }
      if ($day->add_location($name, $day, $cid)){
          header("location: day.php?id=".$_GET['id']);
      }else{
          echo "error";
      }
      mysql_close($db_server);?>