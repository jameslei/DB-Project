<?php require_once "template/blank.php"; ?>
<?php	$name = $_POST['name'];
		$description = $_POST['description'];
		$creator_id = $_GET["id"];
		
		$group = new Group($name, $description, $creator_id);
		if($group->Save()){
			header('Location: index.php');
		}
		
	
	

?>

<?php mysql_close($db_server);?>