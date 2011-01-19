<?php require_once "template/header.php"; ?>

<?php
	// $id = $_GET["id"];
	$user = Account::find($_SESSION['aid']);
	$traveller = $user->traveller;
	$id = $traveller->id;
?>
<!-- <table> 
    <tr > 
        <th colspan="2" class="head">新增旅程</th> 
    </tr> 
    <tr> 
        <td class="left">旅程名稱</td> 
        <td class="right"><input type="text" name="title" id="title" /></td> 
    </tr> 
    <tr> 
        <td class="left">類型</td> 
        <td class="right"><select name="type" id="type"> 
				<option value="business">商務</option> 
				<option value="pleasure">休閒</option> 
				<option value="family">家庭</option> 
				<option value="other">其他</option> 
		</select></td> 
    </tr> 
    <tr> 
        <td class="left">開始日期</td> 
        <td class="right"><input type="date" name="start_date" /></td> 
    </tr> 
    <tr> 
        <td class="left">時間</td> 
        <td class="right"><input type="radio" name="radio" id="male" value="done" /> 
  	    <label for="done">記錄</label> 

  	  <input type="radio" name="radio" id="female" value="yet" /> 
  	  <label for="yet">計劃</label></td> 
    </tr> 
    <tr class="foot"> 
        <td colspan="2"><input type="submit" name="submit" id="submit" value="新增" />                                                  
        <input type="reset" name="Reset" id="reset" value="重設" /></td> 
    </tr> 
</table> -->
<div id="newgroup" align="center">
	<form id="form1" method="post" action="<?php echo "create_newgroup.php?"?>">
	  <table>
		<tr > 
	        <th colspan="2" class="head">新增群組</th> 
	    </tr>
	  	<tr>
			<td class="left">群組名稱</td>
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