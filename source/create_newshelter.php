<?php require_once "template/blank.php"; ?>
<?php	$name = $_POST["name"];
		$description = $_POST["description"];
		$did = $_GET["id"];

		$shelter = new Shelter($name, $description, $did);
		if($shelter->save()){
			header("Location: day.php?id=$did");
		}else{
			echo "error";
		}
		
	
	

?>


<?php mysql_close($db_server);?>