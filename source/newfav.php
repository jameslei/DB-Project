<?php require_once "template/header.php"; ?>

<?php
	$user = Account::find($_SESSION['aid']);
	$traveller = $user->traveller;
	$id = $traveller->id;
?>

<div id="newfav" align="center">
	<form id="form1" method="post" action="<?php echo "create_newfav.php?"?>">
	  <table>
		<tr > 
	        <th colspan="2" class="head">�s�W</th> 
	    </tr>
	  	<tr>
			<td class="left">�W��</td>
			<td class="right"><input type="text" name="name" id="name"></td>
	  	</tr>
	    <tr>
		    <td class="left">��� : </td>
		    <td class="right"><input type="date" name="new_date" ></td>
	    </tr>
	  	<tr>
			<td class="left">����</td>
			<td class="right"><input type="text" name="type" id="type"></td>
	  	</tr>
    	<tr>
	        <td class="left">�a�I : </td>
			<td class="right">
		    <select name="location" id="location">
		    <?php
		    $query = "SELECT * from CITY ";
            $result = mysql_query($query);
		    $rows = mysql_num_rows($result);
		    for ($j=0;$j<$rows;++$j){
		    ?>
		        <option value="city"><?php echo mysql_result($result, $j, 'name')?></option>
		    <?php } ?>	
		    </select>
			</td>
		</tr>
	  	<tr>
			<td class="left">�y�z</td>
	    	<td class="right"><textarea name="description" id="description" cols="45" rows="5"></textarea></td>                    
	  	</tr>
	    <tr class="foot"> 
	        <td colspan="2"><input type="submit" name="submit" id="submit" value="�s�W" />                                                  
	        <input type="reset" name="Reset" id="reset" value="���]" /></td> 
	    </tr>

	  </table>
	</form>
</div>

<?php require_once "template/footer.php"; ?>