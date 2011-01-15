<?php require_once 'template/blank.php'; ?>
<?php Account::logout();
      header("Location: login.php?logout=1");

?>
<?php mysql_close($db_server);?>