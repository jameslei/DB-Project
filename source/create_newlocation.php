<?php require_once "template/blank.php";

      $day = Day::find($_GET['id']);
      $cid = $_POST['location'];
      $name = $_POST['name'];
      if ($day->add_location($name, $day, $cid)){
          header("location: day.php?id=".$_GET['id']);
      }else{
          echo "error";
      }




      mysql_close($db_server);?>