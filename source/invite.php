<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];	
	// $group = Group::find($id);  //rerutn group object(id, name, description, uid)
?>
<div class = "center">
	<form id="form1" method="post" action="<?php echo "create_invite.php?id=$id"?>">
	<table>
		<tr>
			<h1 align = "center"><?php echo $group->name; ?><h1>
		</tr>
		<tr>
			<th colspan = "2" class = "head">邀請新成員</th>
		<tr>
			<td class = "left">該使用者名稱</td>
			<td class = "right"><input type="text" name="account" id="account" /></td>
		</tr>
		<tr class="foot">
                <td colspan="2"><input type="submit" name="submit" id="submit" value="新增" />                                                  
                <input type="reset" name="Reset" id="reset" value="重設" /></td>
        </tr>
    </table>
	</form>
</div>


<?php require_once "template/footer.php"; ?>