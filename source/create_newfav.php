<?php require_once "template/blank.php"; 
	if (isset($_POST)&&isset($_GET['id'])){
	   $day = Day::find($_GET['id']);
	   $name = $_POST['name'];
	   $time = $_POST['time'];
	   $time = explode(':', $time);
	   $datetime = new DateTime($day->date);
	   $datetime->setTime($time[0],$time[1]);
	   $datetime = $datetime->format('Y-m-d H:i:s');
	   $lid = $_POST['location'];
	   $description = $_POST['description'];
       $type = $_POST['radio'];
    
       $fav = new Favorite($name, $time, $type, $description, $lid);
	   if ($fav->save()){
			header("location: day.php?id=$day->id");
		}
	    // if($day->new_schedule($datetime, $lid, $description, $day->id)){
	        // header("location: day.php?id=".$day->id);
	    // }else{
	        // echo "error";
	    // }
    
    
   
	}



	mysql_close($db_server);?>