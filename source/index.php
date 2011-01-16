<?php require_once "template/header.php"; ?>

<?php $user = Account::find($_SESSION['aid']); ?>

<p class="welcome">你好! <?php echo $user->traveller->name; ?>, 你可以按此<a href="logout.php">登出</a>.</p>

<div>
<b>Trip List</b>
<?php 
$trip_array[] = ($user->traveller)::getTrip($user->traveller->id);
// get trip object array
$j = 0;
foreach ($trip_array as $trip_list){
    echo "$j : $trip_list->name, $trip_list->type, $trip_list->time, $trip_list->status</br>";
	++$j;
}
?>
</div>

<div>
<b>Group List</b>
<?php
$group_array[] = ($user->traveller)::getGroup($user->traveller->id);
// get group object array
$i = 0;
foreach ($group_array as $group_list){
    echo "$i : $group_list->id, $group_list->name, $group_list->description";
	++$i;
}
?>
</div>


<?php require_once "template/footer.php"; ?>