<?php require_once "template/blank.php";
	  $user = Account::find($_SESSION['aid']); 
	  // print_r($user);
	  $uid = $user->traveller->id;
      $day = Day::find($_GET['id']);
      $cid = $_POST['location'];
      $name = $_POST['name'];
	  $city = City::find($cid);
	  $query = "INSERT INTO `TRAVELLER_CITY` (`cid`, `uid`) VALUES ('$cid', '$uid');";
	  $result = mysql_query($query);
	  if ($result){
      if ($day->add_location($name, $day, $cid)){
          header("location: day.php?id=".$_GET['id']);
      }else{
          echo "error";
      }
      }else{
		  echo "errrrrrrror";
	  }



      mysql_close($db_server);?>