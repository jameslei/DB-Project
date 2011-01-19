<?php require_once "template/blank.php";

    if (isset($_POST)&&isset($_GET['id'])){
        $trip = Trip::find($_GET['id']);
        $last_day = $trip->last_day();
        // echo $last_day->format("Y-m-d");
        $last_day->add(new DateInterval('P1D'));//next day;
        
        
        
        
        if ($trip->new_day()){
            header("location: trip.php?id=".$trip->id);
        }else{
            echo "error";
        }
        
        
        
    }
    mysql_close($db_server);?>