<?php require_once "template/blank.php"; 

if (isset($_POST['city'])&&($_POST['city']!='')){
    $city = new City($_POST['city'], $_POST['country_id']);
    if ($city->save()){
        header("Location: add_day.php");
    }else{
        header("Location: newcity.php?error=fail");
    }
}else{
   header("Location: newcity.php?error=empty");
}

?>



<?php mysql_close($db_server);?>