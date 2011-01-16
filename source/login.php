<?php
    require_once "template/blank.php";
    if (isset($_POST['name'])){
        $user = Account::login($_POST['name'], $_POST['password']);
        if ($user==NULL || $user==false){
            header("Location: login.php?fail=1");
        }else{
            header("Location: index.php");
        }
    }else{
?>
<?php require_once "template/header.php"; ?>
<?php if (isset($_GET['fail'])&&$_GET['fail']==1){ ?><div class="login_fail">登入失敗</div><?php }?>
<?php if (isset($_GET['logout'])&&$_GET['logout']==1){ ?><div class="logout">你已成功登出</div><?php }?>
<div id="login">
    <form action="login.php" method="post" accept-charset="utf-8">
        <table>
            <tr>
                <th colspan='2' class="head">登入</th>
            </tr>
            <tr>
                <td class="left">使用者名稱</td>
                <td class="right"><input type="text" size="20" name="name" /></td>
            </tr>
            <tr>
                <td class="left">密碼</td>
                <td class="right"><input type="password" size="20" name="password" /></td>
            </tr>
            <tr class="foot">
                <td>&nbsp;</td>
                <td><input type="submit" value="Continue &rarr;" /></td>
            </tr>
        </table>
    </form>
</div>


<?php require_once "template/footer.php"; ?>

<?php } ?>