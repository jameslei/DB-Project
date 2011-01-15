<?php require_once "template/header.php"; ?>

<?php

    $user = Account::find($_SESSION['aid']);

?>

<?php require_once "template/footer.php"; ?>