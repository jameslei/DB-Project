<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$belongs_to = $_GET["belongs_to"]
	
?>
<div id="newtrip" align="center">
	<form id="form1" method="post" action="<?php echo "create_newtrip.php?id=$id&belongs_to=$belongs_to"?>">
	  <p>
		<label for="title">Trip title: </label>
		<input type="text" name="title" id="title">
	  </p>
	
	  <p>
	    <label for="type">Type</label>
		<select name="type" id="type">
				<option value="business">business</option>
				<option value="pleasure">pleasure</option>
				<option value="family">family</option>
				<option value="other">other</option>
		</select>
	  </p>
	  
	  <p>
		<label for="time">Start date: </label>
		<input type="date" name="start_date" />
		<!-- <label for="year">y</label> -->
		<!-- <select name="year" id="year"> -->
			    <!-- <?php for($i=1960; $i<=2060; $i++){?> -->
				  <!-- <option value="<?php echo $i;?>"><?php echo $i;?></option> -->
		        <!-- <?php }?> -->
		<!-- </select> -->
		<!-- <label for="month">m</label> -->
		<!-- <select name="month" id="month"> -->
			      <!-- <?php for($i=1;$i<=12;$i++){?> -->
				  <!-- <option value="<?php echo $i;?>"><?php echo $i;?></option> -->
	              <!-- <?php }?> -->
	    <!-- </select> -->
		<!-- <label for="day">d</label> -->
		<!-- <select name="day" id="day"> -->
			      <!-- <?php for($i=1;$i<=31;$i++){?> -->
			      <!-- <option value="<?php echo $i;?>"><?php echo $i;?></option> -->
			      <!-- <?php }?> -->
	    <!-- </select> -->
	  </p>
	  
	  <p>
		<label for="status">Status: </label>
		<input type="radio" name="radio" id="male" value="male" />
	    <label for="done">Sweet sweet memories</label>

	  <input type="radio" name="radio" id="female" value="female" />
	  <label for="yet">To be experienced</label>
	  </p>
	  
	    <input type="submit" name="submit" id="submit" value="submit" />                                                  
        <input type="reset" name="Reset" id="reset" value="reset" />
	</form>
</div>
<?php require_once "template/footer.php"; ?>	