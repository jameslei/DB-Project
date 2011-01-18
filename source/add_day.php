<?php require_once "template/header.php"; ?>

<div id="newtrip" align="center">
    <form id="form1" method="post" action="<?php echo "trip.php"?>">
	  <p>
		<label for="date">Date : </label>
		<input type="date" name="new_date" />
	  </p>
	  <p>
	    <label for="location">Location : </label>
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
		<a href = "newcity.php"> Add a new City </a>
	  </p>
	  <input type="submit" name="submit" id="submit" value="submit" />                                                  
      <input type="reset" name="Reset" id="reset" value="reset" />
	</form>
</div>
<?php require_once "template/footer.php"; ?>	