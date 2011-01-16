<?php require_once "template/blank.php"; 
    $empty=false;
    while(list($temp, $arr) = each($_POST)){
        while(list($key,$val) = each($arr)){
            if ($val==""){
                $empty=true;
            }
        }
    }
    if ($empty){
        header("Location: signup.php?error=empty");
    }elseif ($_POST['account']['password']!=$_POST['account']['confirm_password']){
        header("Location: signup.php?error=password");
    }elseif (Account::exist($_POST['account']['name'])==true){
        header("Location: signup.php?error=name");
    }else{
        $traveller = new Traveller($_POST['traveller']['name'],
                                   $_POST['traveller']['gender'], 
                                   $_POST['traveller']['birthday'], 
                                   $_POST['traveller']['address']);
        print_r($traveller);
        if ($traveller->save()){
            $account = New Account($_POST['account']['user'], $_POST['account']['password'], $traveller->id);
            $account.save();
        }
        
    }

?>

<?php mysql_close($db_server);?>