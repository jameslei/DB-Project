<?php require_once "template/blank.php"; ?>
<?php	
		$id = $_GET['id'];
		$name = $_POST['name'];
        $new_date = $_POST['new_date'];
		$type = $_POST['type'];
        $location = $_POST['location'];
		$description = $_POST['description'];
		$user = Account::find($_SESSION['aid']);
		$traveller = $user->traveller;
		$uid = $traveller->id;		
		$query = "SELECT * from LOCATION WHERE name = '$location'";
		$result = mysql_query($query);
		$row = mysql_fetch_row($result);
		$favor = new Favorite($name, $new_date, $type, $description, 1);
		if($favor->save()){
			header('Location:day.php?id=$id');
		     //echo "cool";
			//header('Location: index.php');
			// header('Location: index.php');
		}
		
	
	

?>

<?php mysql_close($db_server);?>

