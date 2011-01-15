<?php require_once "template/header.php"; ?>

<div id="login">
    <form action="temp_submit" method="get" accept-charset="utf-8">
        <table>
            <tr>
                <th colspan='2' class="head">登入</th>
            </tr>
            <tr>
                <td class="left">使用者名稱</td>
                <td class="right"><input type="text" size="20" /></td>
            </tr>
            <tr>
                <td class="left">密碼</td>
                <td class="right"><input type="password" size="20" /></td>
            </tr>
            <tr class="foot">
                <td>&nbsp;</td>
                <td><input type="submit" value="Continue &rarr;" /></td>
            </tr>
        </table>
    </form>
</div>


<?php require_once "template/footer.php"; ?>