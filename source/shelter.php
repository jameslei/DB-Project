<?php require_once "template/header.php"; ?>
<?php
	$id=$_GET["id"];
	$shelter = Shelter::find($id);
?>
<div id = "dashboard">
	<table>
		<tr>
			<th colspan="2"><?php echo $shelter->name;?></th>
		</tr>
		<tr>
			<td>資訊</td>
			<td><?php echo $shelter->info; ?></td>
		</tr>
	</table>
</div>

<!-- PUT CONTENT HERE -->

<?php require_once "template/footer.php"; ?>