<?php require_once "template/blank.php"; 

      if (isset($_GET['tid'])){
          $id = $_GET['tid'];
          $query = "DELETE FROM `Travel Journal`.`TRIP` WHERE `TRIP`.`tid`= $id;";
          $result = mysql_query($query);
          if (!$result){
              echo "error!";
          }else{
              header("location: index.php");
          }
      }
?>
<?php mysql_close($db_server);?>