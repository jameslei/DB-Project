<?php require_once "template/blank.php"; 

    if (isset($_GET["id"])){
        $trip=Trip::find($_GET["id"]);
        $trip->name = $_POST["title"];
        $trip->type = $_POST['type'];
        $trip->time = $_POST['start_date'];
        $trip->status = $_POST['radio'];
        if ($trip->save()){
            header("location: trip.php?id=$trip->id");
        }else{
            echo "error";
        }
    }

?>



<?php mysql_close($db_server);?>