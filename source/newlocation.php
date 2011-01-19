<?php require_once "template/header.php"; 
      $cities = City::all();
?>

<div>
    <form action="create_newlocation.php?id=<?php echo $_GET['id'] ?>" method="post">
        <table>
            <tr>
                <th colspan="2" class="head">新增地點</th>
            </tr>
            <tr>
                <td>城市</td>
                <td><select name="location" id="location">
                <?php foreach($cities as $city){
                    echo "<option value=".$city->id.">".$city->name."</option>";
                }?>
                </select></td>
            </tr>
            <tr>
                <td>地點名稱</td>
                <td><input type="text" name="name" /></td>
            </tr>
            <!-- <tr>
                <td>下一個地點</td>
                <td><select name="next">
                    <option value="NULL">---</option>
                </select></td>
            </tr>
            <tr>
                <td>到達方法</td>
                <td><select name="next_traffic">
                    <option value="foot">步行</option>
                    <option value="ship">船</option>
                    <option value="bus">公車</option>
                    <option value="MRT">大眾運輸</option>
                    <option value="plane">飛機</option>
                    <option value="other">其他</option>
                </select></td>
            </tr> -->
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" id="submit" value="新增" />                                                  
                    <input type="reset" name="Reset" id="reset" value="重設" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php require_once "template/footer.php"; ?>