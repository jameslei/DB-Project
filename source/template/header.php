<?php require_once "blank.php"; ?>
<?php if (strchr($_SERVER["PHP_SELF"], "login.php")==NULL && strchr($_SERVER["PHP_SELF"], "signup.php")==NULL){login_first();} ?>
<!DOCTYPE HTML>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>Travel Journal</title>
    <link rel="stylesheet" href="stylesheet/style.css" type="text/css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="stylesheet/reset.css" type="text/css" media="screen" charset="utf-8">
</head>
<body>
    <header>
        <h1 class="title">旅行者日誌</h1>
        <p class="title">Travel Journal</p>
    </header>
<?php require_once "nav.php";?>