<?php   require_once "template/blank.php";?>
<select name="country_id">
<?php   $query = "SELECT * FROM `COUNTRY`;";
        $result = mysql_query($query);
        if (!$result){
            die("error in country!");
        }else{
            while($row = mysql_fetch_row($result)){
?>  <option value="<?php echo $row[0]; ?>"<?php if ($row[1]=="台灣") echo "selected"?>><?php echo $row[1];?></option><?
            }
        }
?>
</select>
<?      mysql_close($db_server);?>