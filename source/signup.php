<?header("Cache-control:private");?>
<?php require_once "template/header.php"; ?>
<div id="signup">
    <form action="create.php" method="post" accept-charset="utf-8">
        <table>
            <tr>
                <th colspan="4" class="head">註冊</th>
            </tr>
            <tr>
                <td class="left">登入名稱</td>
                <td><input type="text" name="account[name]" /></td>
                <td>真實姓名</td>
                <td class="right"><input type="text" name="traveller[name]" /></td>
            </tr>
            <tr>
                <td class="left">密碼</td>
                <td><input type="password" name="account[password]" /></td>
                <td>姓別</td>
                <td class="right"><input type="radio" name="traveller[gender]", value="male" />男 
                    <input type="radio" name="gender", value="female" />女
                </td>
            </tr>
            <tr>
                <td class="left">再確認一次</td>
                <td><input type="password" name="account[confirm_password]" /></td>
                <td>出生日期</td>
                <td class="right"><input type="date" name="traveller[birthday]" /></td>
            </tr>
            <tr>
                <td class="left">&nbsp;</td>
                <td>&nbsp;</td>
                <td>地址</td>
                <td class="right"><input type="text" name="traveller[address]" /></td>
            </tr>
            <tr class="foot">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" value="Continue &rarr;"></td>
            </tr>
        </table>
    </form>
</div>

<?php require_once "template/footer.php"; ?>