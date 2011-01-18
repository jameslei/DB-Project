<?php require_once "template/header.php"; ?>

<?php $user = Account::find($_SESSION['aid']); ?>

<p class="welcome">你好! <?php echo $user->traveller->name; ?>, 你可以按此<a href="logout.php">登出</a>.</p>

<div id="dashboard">
 <div id="trip" class="forty-five left">
<h1>旅程</h1>
<?php 

$traveller = $user->traveller;
$uid = ($traveller->id);
//測試用,之後不用減一
//echo "$uid";
//echo "$traveller->getTrip($uid)";
//$trip_array[] = Traveller::getTrip($uid);
$trip_array = Traveller::getTrip($uid);
//$trip_array[] = $traveller->getTrip($uid);
//echo $traveller->id;
// get trip object array
$j = 1;
if($trip_array!=NULL){
    echo "<table>";
	echo "<tr>";
	echo "<th>開始日期</th>";
	echo "<th>旅程名稱</th>";
	echo "</tr>";
    foreach ($trip_array as $trip_list){
	    echo "<tr>";
		echo "<td>$trip_list->time</td>";
		echo "<td>";
		echo "<a href = trip.php?id=$t_id>";
		echo "$trip_list->name";
	    echo "</a>";
		echo "</td>";
		echo "</tr>";
		++$j;
    }
	echo "</table>";
}else{
    echo "尚無資料";
}
?>
<?php $t_id=$user->traveller->id; ?>
<ul>
<li><a href = "<?php echo "newtrip.php?id=$t_id&belongs_to='traveller'"?>">新增</a></li>
</ul>
 </div>

<div id="group" class="forty-five right">
<h1>群組</h1>
<?php
//還有問題:找出來的如果是group就無法顯示,group_traveller就可以超怪
$traveller = $user->traveller;
$uid = ($traveller->id);
$group_array = Traveller::getGroup($uid);
// get group object array
//echo $group_array[0];
//echo "$uid";
$i = 1;
if($group_array!=NULL){
    echo "<table>";
	echo "<tr>";
    echo "<th>群組名稱</th>";
	echo "<th>描述</th>";
	echo "<th>人數</th>";
	echo "</tr>";
    foreach ($group_array as $group_list){
	    $gid = $group_list->id;
	    $count = GROUP::getCount($gid);
		echo "<tr>";
		echo "<td>$group_list->name</td>";
		echo "<td>";
		echo "<a href = group.php?id=$uid > ";
		echo "$group_list->description";
	    echo "</a>";
		echo "</td>";
		echo "<td>$count</td>";
		echo "</tr>";
	    ++$i;
    }
	echo "</table>";
}else{
    echo "尚無資料";
}
?>
<ul>
<a href = "<?php echo "newgroup.php?id=$u_id"?>">開團</a>
</ul>
</div>

<div id="city" class="forty-five left">
<h1>城市</h1>
<?php
$city_array = Traveller::getCity($uid);
$k = 1;
if($city_array!=NULL){
    echo "<table>";
	echo "<tr>";
    echo "<th>你曾到達的城市</th>";
	echo "<th>日期</th>";
	echo "</tr>";
    foreach ($city_array as $city_list){
		echo "<tr>";
		echo "<td>$city_list->name</td>";
		//echo "<td>$city_list->name</td>";
		//echo "<a href = trip.php?id=$t_id > ";
		//echo "$city_list->city";
	    //echo "</a>";
		//echo "</td>";
		echo "</tr>";
	    ++$k;
    }
	echo "</table>";
}else{
    echo "尚無資料";
}
?>
</div>

<div id="favorite" class="forty-five right">
<h1>♥</h1>
<b>My Favorite things : </b><br/><br/>
<?php
$favor_array = Traveller::getFavor($uid);
if($favor_array!=NULL){
    echo "<table>";
	echo "<tr>";
    echo "<th>名字</th>";
	echo "<th>時間</th>";
	echo "<th>地點</th>";
	echo "<th>備註</th>";
	echo "</tr>";
    foreach ($favor_array as $favor_list){
		echo "<tr>";
        echo "<td>$favor_list->name</td>";
		echo "<td>$favor_list->time</td>";
        echo "<td>$favor_list->lid</td>";
		echo "<td>$favor_list->note</td>";
		echo "</tr>";
    }
	echo "</table>";
}else{
    echo "尚無資料";
}
?>
<ul>
   <li><a href="#">新增</a></li>
   <li><a href="#">更多</a></li>
</ul> 
</div>

</div>
<?php require_once "template/footer.php"; ?>