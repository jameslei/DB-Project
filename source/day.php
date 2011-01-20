<?php require_once "template/header.php"; ?>
<?php
      $day = Day::find($_GET['id']);
      $locations = $day->get_location();
      $schedules = $day->get_schedules();
?>
<div id="dashboard">
    <div class="sixty left">
        <table>
            <tr>
                <th class="head"><?php echo $day->date;?></th>
            </tr>
            <?php if ($schedules!=NULL){
                    foreach($schedules as $item){
            ?>
            <tr>
                <td><a href="schedule.php?id=<?php echo $item->id; ?>"><?php echo $item->description; ?></a></td>
            </tr>
            <?php }}?>
        </table>
        <ul>
            <?php if ($day->last()!=NULL){ $last=$day->last();?>
            <li><a href="day.php?id=<?php echo $last->id; ?>" style="text-decoration:none;">◀</a></li>
            <?php }else{ ?>
            <li style="color: #999;">◀</li>
            <?php }?>
            <li><a href="add_schedule.php?id=<?php echo $day->id; ?>" style="text-decoration:none;">✚</a></li>
            <?php if ($day->next!=NULL){ $next=$day->next; ?>
            <li><a href="day.php?id=<?php echo $next->id; ?>" style="text-decoration:none;">►</a></li>
            <?php }else{ ?>
            <li style="color: #999;">►</li>
            <?php }?>
        </ul>
    </div>
    
    
    <div class="thirty right">
        <h1>地點</h1>
        <table>
            <?php if ($locations!=NULL){
             foreach($locations as $location){?>
            <tr><td><?php echo $location->name; ?></td></tr>
            <?php }} ?>
        </table>
        <ul>
            <li><a href="newlocation.php?id=<?php echo $day->id; ?>">新增地點</a></li>
        </ul>
    </div>
    <div class="thirty right">
        <h1>住宿</h1>
        <table>
            <tr>
                <td><?php echo "<a href=\"shelter.php?id=".$day->get_shelter()->id."\">".$day->get_shelter()->name."</a>" ?></td>
            </tr>
        </table>
        <?php if(!$day->get_shelter()) echo "<ul><li><a href=\"newshelter.php?id=$day->id\">新增</a></li></ul>" ?>
    </div>
    <div class="thirty right">
        <h1>♥</h1>
        <table>
            <tr>
                <?php
		        $favor_array = Day::getFavor($day->id);
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
						$lid = $favor_list->location_id;
						$location=Location::find($lid);
		                echo "<td>$location->name</td>";
				        echo "<td>$favor_list->note</td>";
				        echo "</tr>";
		            }
			        echo "</table>";
		        }else{
		            echo "<table><tr><td>尚無資料</td></tr></table>";
		        }
		        ?>
            </tr>
        </table>
        <ul>
			<li><a href="newfav.php?id=<?php echo $day->id;?>">新增</a></li>
            <li><a href="fav.php?did=<?php echo $day->id;?>">更多</a></li>
        </ul>
    </div>
</div>
<!-- <?php $cities = City::all(); ?>
<div id="newtrip">
    <form id="form1" method="post" action="create_day.php?id=<?php echo $_GET['id'];?>">
        <table>
            <tr>
                <th colspan="2" class="head">YYYY-MM-DD</th>
            </tr>
            <tr>
                <td>目的地城市</td>
                <td>
                    <select name="location" id="location">
                    <?php foreach($cities as $city){
                        echo "<option value=".$city->id.">".$city->name."</option>";
                    }?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>住在</td>
                <td><input type="text" name="shelter[name]" /></td>
            </tr>
            <tr>
                <td>住宿備忘</td>
                <td><textarea name="shelter[info]" id="" cols="30" rows="7"></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" id="submit" value="submit" />                                                  
                    <input type="reset" name="Reset" id="reset" value="reset" /></td>
            </tr>
        </table>
    </form>
</div> -->
<?php require_once "template/footer.php"; ?>