<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$group = Group::find($id);  //rerutn group object(id, name, description, uid)
	$creator_name = $group->creator()->name;
	$member_list = $group->members();  //member_list array contains traveller objects
	$trip_list = $group->get_all_trip();  //trip_list array contain trip objects
	// print_r($trip_list);
	// echo $trip_list;
?>
<div class = "center">
	<table>
		<tr>
			<th colspan = "2" class = "head"><?php echo $group->name; ?></th>
		</tr>
		<tr>
			<td class = "left">創始人</td>
			<td class = "right"><?php echo $creator_name; ?></td>
		</tr>
		<tr>
			<td class = "left">群組成員</td>
			<td class = "right"><?php foreach($member_list as $item){
				echo $item->name."<br/>";
			}?><br/><a href = "invite.php?id=<?php echo $id?>">邀請新成員</a></td>
		</tr>
		<tr>
			<td class = "left">群組簡介</td>
			<td class = "right"><?php echo $group->description;?></td>
		</tr>
		<tr>
			<td class = "left">旅程</td>
			<td class = "right"><?php if (!empty($trip_list)){foreach($trip_list as $item){
				echo "<a href=trip.php?id=$item->id>".$item->name."</a><br/>";
			}}?></td>
		</tr>
        <tr class="foot">
            <td colspan="2"><a href = "newtrip.php?id=<?php echo $id;?>&belongs_to=group">新增一個旅程</a></td>
        </tr>
	</table>
	
</div>
<?php require_once "template/footer.php"; ?>