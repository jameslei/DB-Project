<?php require_once "template/header.php"; ?>

<?php $user = Account::find($_SESSION['aid']); ?>

<p class="welcome">你好! <?php echo $user->traveller->name; ?>, 你可以按此<a href="logout.php">登出</a>.</p>

<div align="left">
<b>Trip List</b><br/><br/>
<?php 

$traveller = $user->traveller;
$uid = $traveller->id;
echo "$uid";
echo $traveller->getTrip($uid);
$trip_array[] = $traveller->getTrip($uid);
//echo $traveller->id;
// get trip object array
$j = 0;
if(($traveller->getTrip($uid))!=NULL){
    foreach ($traveller->getTrip($uid) as $trip_list){
        echo "$j : $trip_list->time, $trip_list->name</br>";
	    ++$j;
    }
}else{
    echo "尚無資料";
}

?>
<br/><br/><br/><br/><br/>
<?php $t_id=$user->traveller->id; ?>

<a href = "newtrip.php?id=$t_id&belongs_to="traveller"">新增一個旅程</a><br/><br/>  
</div>

<div align="left">
<br/><br/>
<b>Group List</b><br/><br/>
<?php
$group_array = Traveller::getGroup($user->traveller->id);
// get group object array
$i = 0;
if($group_array!=NULL){
    foreach ($group_array as $group_list){
        echo "$i : $group_list->id, $group_list->name, $group_list->description</br>";
	    ++$i;
    }
}else{
    echo "尚無資料";
}
?>
<br/><br/>
</div>

<div align="center">
<br/><br/>
<b>City</b><br/><br/>
<?php
$query = "SELECT name, cname FROM TRAVELLER_CITY JOIN CITY ON TRAVELLER_CITY.cid = CITY.cid";
$result = mysql_query($query);
if($result != NULL){	
	echo "I have been to : <br/>";
    if (!$result){
        return false;
    }else{
        while($row = mysql_fetch_row($result)){
		  	echo "City : ".$row[0]."<br/>";
		  	echo "Country : ".$row[1]."<br/><br/><br/>";
        }			
    }
}else{
    echo "尚無資料";
}
?>

<div align="bottom">
<br/><br/>
<b>My Favorite things : </b><br/><br/>
<?php
$query = "SELECT time, name FROM FAV_THING WHERE uid='$user->id";
$result = mysql_query($query);
if($result != NULL){	
	//echo "I have been to : <br/>";
    if (!$result){
        return false;
    }else{
        while($row = mysql_fetch_row($result)){
		  	echo "City : ".$row[0]."<br/>";
		  	echo "Country : ".$row[1]."<br/><br/><br/>";
        }			
    }
}else{
    echo "尚無資料";
}
?>



<?php require_once "template/footer.php"; ?>