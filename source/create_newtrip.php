<?php require_once "template/blank.php"; ?>
<?php	$title = $_POST['title'];
		$type = $_POST['type'];
		$time = $_POST['start_date'];
		$status = $_POST['radio'];
		$user = Account::find($_SESSION['aid']);
		$traveller = $user->traveller;
		if (isset($_GET['belongs_to'])&&($_GET['belongs_to']=='group')){
		    $owner_id = $_GET["id"];
		}else{
		    $owner_id = $traveller->id;
		}
		
		$belongs_to = $_GET["belongs_to"];
		
		$trip = new Trip($title, $type, $time, $status, $belongs_to, $owner_id);
		
		if($trip->save()){
			
			header('Location: index.php');
		}
		
	
	

?>
<!-- <a>hi</a> -->
<?php mysql_close($db_server);?>