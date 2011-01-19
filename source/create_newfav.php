<?php require_once "template/blank.php"; ?>
<?php	$name = $_POST['name'];
        $new_date = $_POST['new_date'];
		$type = $_POST['type'];
        $location = $_POST['location'];
		$description = $_POST['description'];
		$user = Account::find($_SESSION['aid']);
		$traveller = $user->traveller;
		$uid = $traveller->id;
		
		$favor = new Favorite($name, $new_date, $type, $description, $location);
		if($group->Save()){
			$invite = $group->new_member($creator_id);
			header('Location: index.php');
		}
		
	
	

?>

<?php mysql_close($db_server);?>