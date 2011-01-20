<?php require_once "template/header.php"; 
 	$day = Day::find($_GET['id']);
  	$locations = $day->get_location();
?>
<div>
    <form method="post" action="create_newfav.php?id=<?php echo $day->id; ?>">
        <table>
            <tr>
                <th colspan="2" class="head">新增最愛</th>
            </tr>
			<tr>
				<td class="left">名稱</td>
				<td class="right"><input type="name" name="name"></td>
			</tr>
            <tr>
                <td class="left">時間</td>
                <td class="right"><?php echo $day->date; ?>&nbsp;<input type="time" name="time"></td>
            </tr>
			<tr>
				<td class="left">類型</td>
				<td class="right">
					<input type="radio" name="radio" id="see" value="愛看" /><label for="see">愛看</label>
					<input type="radio" name="radio" id="hear" value="愛聽" /><label for="hear">愛聽</label>
					<input type="radio" name="radio" id="eat" value="愛吃" /><label for="eat">愛吃</label>
					<input type="radio" name="radio" id="drink" value="愛喝" /><label for="drink">愛喝</label>
					<input type="radio" name="radio" id="do" value="愛作" /><label for="do">愛作</label>
					<input type="radio" name="radio" id="play" value="愛玩" /><label for="play">愛玩</label>
					<input type="radio" name="radio" id="person" value="愛人" /><label for="person">愛人</label>
					<input type="radio" name="radio" id="buy" value="愛買" /><label for="person">愛買</label>
					
				</td>
            <tr>
                <td class="left">地點</td>
                <td class="right">
                    <?php if($locations!=NULL){?>
                        <select name="location">
                    <?  foreach($locations as $location){
                           echo "<option value=\"$location->id\">$location->name</option>";
                        }
                    ?>
                        </select>
                    <?php
                    }else{
                        echo "<a href=\"newlocation.php?id=$day->id\">新增地點</a>";
                    }?>
                </td>
            </tr>
            <tr>
                <td class="left">內容</td>
                <td class="right"><textarea name="description" id="description" cols="45" rows="5"></textarea></td>
            </tr>
            <tr class="foot">
                <td colspan="2">
                    <input type="submit" name="submit" id="submit" value="submit" />                                                  
                    <input type="reset" name="Reset" id="reset" value="reset" />
                </td>
            </tr>
        </table>
    </form>
</div>


<?php require_once "template/footer.php"; ?>