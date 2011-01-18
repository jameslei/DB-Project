<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];			//group id
 	$group = Group::find($id);  //rerutn group object(id, name, description, uid)
	$uname = $_POST['account']; //user name
	// echo $uname;
	$traveller = Traveller::find_by_uname($uname);    //user object
	// print_r($traveller);
	if (!$traveller){
		echo "no such user";
	}else{
		$result = $group->new_member($traveller->id);
		echo "done!";
	}
?>
<br/>
<a href="group.php?id=<?php echo $id ?>">back to group</a>
<?php require_once "template/footer.php"; ?>