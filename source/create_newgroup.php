<?php require_once "template/blank.php"; ?>
<?php	$name = $_POST['name'];
		$description = $_POST['description'];
		// $creator_id = $_GET["id"];
		$user = Account::find($_SESSION['aid']);
		$traveller = $user->traveller;
		$creator_id = $traveller->id;
		
		$group = new Group($name, $description, $creator_id);
		if($group->Save()){
			$invite = $group->new_member($creator_id);
			header('Location: index.php');
		}
		
	
	

?>

<?php mysql_close($db_server);?>