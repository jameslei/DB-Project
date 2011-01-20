<?php require_once "template/header.php";
    if (isset($_GET['error'])){
        if ($_GET['error']=="empty"){
            $error_message="資料不能為空";
        }elseif ($_GET['error']=="fail"){
            $error_message="無法新增";
        }
        echo '<div class="logout">'.$error_message.'</div>';
    }
?>

<div id="newcity" class="center">
    <form method="post" action="create_newcity.php?id=<?php echo $_GET['id'];?>">
        <table>
            <tr>
                <th colspan="2"  class="head">新增城市</th>
            </tr>
            <tr>
                <td class="left">城市名</td>
                <td class="right"><input name="city", type="text" /></td>
            </tr>
            <tr>
                <td class="left">所在國家</td>
                <td class="right"><?php require_once "template/nation.php";?></td>
            </tr>
            <tr class="foot">
                <td colspan="2"><input type="submit" name="submit" id="submit" value="新增" />                                                  
                <input type="reset" name="Reset" id="reset" value="重設" /></td>
            </tr>
        </table>
    </form>
</div>

<?php require_once "template/footer.php"; ?>