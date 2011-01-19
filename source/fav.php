<?php require_once "template/header.php"; 

      $account = Account::find($_SESSION['aid']);
      $traveller = $account->traveller;
      if (isset($_GET['id'])){//all DAYs
          $trip = Trip::find($_GET['id']);
          $days = $trip->get_days();
      }
      if (isset($_GET['did'])){//specfic DAY
          $day = Day::find($_GET['did']);
          $location = Location::find();
      }
      
?>



<?php require_once "template/footer.php"; ?>
