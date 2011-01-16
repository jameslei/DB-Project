<?php require_once "template/header.php"; ?>

<div id="signup">
    <form action="create.php" method="post" accept-charset="utf-8">
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