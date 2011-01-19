<?php require_once "template/header.php"; 
      $day = Day::find($_GET['id']);
      $locations = $day->get_location();
?>
<div>
    <form method="post" action="create_schedule.php?id=<?php echo $day->id; ?>">
        <table>
            <tr>
                <th colspan="2" class="head">新增行程</th>
            </tr>
            <tr>
                <td class="left">時間</td>
                <td class="right"><?php echo $day->date; ?>&nbsp;<input type="time" name="time"></td>
            </tr>
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
                <td class="right"><input type="text" name="description" size="35"/></td>
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

<!-- <div id="newschedule" align="center">
    <form id="form1" method="post" action="<?php echo "schedule.php"?>">
      <p>
        <label for="time">Time : </label>
        <input type="time" name="new_time" />
      </p>
      <p>
        <label for="place">Place : </label>
        <input type="text" name="place"/>
      </p>
      <p>
        <label for="note">Description : </label>
        <textarea name="note" cols="18" rows="5"></textarea>
      </p>
      <input type="submit" name="submit" id="submit" value="submit" />                                                  
      <input type="reset" name="Reset" id="reset" value="reset" />
    </form>
</div> -->
<?php require_once "template/footer.php"; ?>	