<?php require_once "template/header.php"; ?>

<?php
	$did = $_GET["id"];
	
?>
<div id="newshelter" align="center">
	<form id="form1" method="post" action="<?php echo "create_newshelter.php?id=".$did ?>">
	  <table>
		<tr > 
	        <th colspan="2" class="head">新增住宿資訊</th> 
	    </tr>
	  	<tr>
			<td class="left">住宿名稱</td>
			<td class="right"><input type="text" name="name" id="name"></td>
	  	</tr>
	  	<tr>
			<td class="left">敘述</td>
	    	<td class="right"><textarea name="description" id="description" cols="45" rows="5"></textarea></td>                    
	  	</tr>
	    <tr class="foot"> 
	        <td colspan="2"><input type="submit" name="submit" id="submit" value="新增" />                                                  
	        <input type="reset" name="Reset" id="reset" value="重設" /></td> 
	    </tr>

	  </table>
	</form>
</div>
<?php require_once "template/footer.php"; ?>