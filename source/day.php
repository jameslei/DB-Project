<?php require_once "template/header.php"; ?>
<?php
      $day = Day::find($_GET['id']);
      

?>
<div id="dashboard">
    <div class="sixty left">
        <table>
            <tr>
                <th class="head"><?php echo $day->date;?></th>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="thirty right">
        <table>
            <tr>
                <td></td>
            </tr>
        </table>
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