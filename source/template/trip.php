<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"]
	$trip = Trip::find($id);
?>
<table>
	<tr>
		<th><?php echo $trip->name ?></th>
	</tr>
	<tr>
		<td><?php echo ?></td>
	</tr>
<?php require_once "template/footer.php"; ?>