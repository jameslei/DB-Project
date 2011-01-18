<?php require_once "template/header.php"; ?>

<div id="newschedule" align="center">
    <form id="form1" method="post" action="<?php echo "schedule.php"?>">
	  <p>
		<label for="time">Time : </label>
		<input type="time" name="new_time" />
	  </p>
	  <p>
	    <label for="place">Place : </label>
        <input type="text" name="place"/>
	  </p>
	  <p>
	    <label for="note">Note : </label>
        <textarea name="note" cols="18" rows="5"></textarea>
	  </p>
	  <input type="submit" name="submit" id="submit" value="submit" />                                                  
      <input type="reset" name="Reset" id="reset" value="reset" />
	</form>
</div>
<?php require_once "template/footer.php"; ?>	