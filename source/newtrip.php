<?php require_once "template/header.php"; ?>
<?php
	$id = $_GET["id"];
	$belongs_to = $_GET["belongs_to"]
	
?>
<div id="newtrip">
	<form id="form1" method="post" action="<?php echo "create_newtrip.php?id=$id&belongs_to=$belongs_to"?>">
	    
        <table>
            <tr >
                <th colspan="2" class="head">新增旅程</th>
            </tr>
            <tr>
                <td class="left">旅程名稱</td>
                <td class="right"><input type="text" name="title" id="title" /></td>
            </tr>
            <tr>
                <td class="left">類型</td>
                <td class="right"><select name="type" id="type">
        				<option value="business">商務</option>
        				<option value="pleasure">休閒</option>
        				<option value="family">家庭</option>
        				<option value="other">其他</option>
        		</select></td>
            </tr>
            <tr>
                <td class="left">開始日期</td>
                <td class="right"><input type="date" name="start_date" /></td>
            </tr>
            <tr>
                <td class="left">時間</td>
                <td class="right"><input type="radio" name="radio" id="male" value="done" />
          	    <label for="done">記錄</label>

          	  <input type="radio" name="radio" id="female" value="yet" />
          	  <label for="yet">計劃</label></td>
            </tr>
            <tr class="foot">
                <td colspan="2"><input type="submit" name="submit" id="submit" value="新增" />                                                  
                <input type="reset" name="Reset" id="reset" value="重設" /></td>
            </tr>
        </table>
	    
	    
	    
	    
	    
	    
        <!--  -->
      <!-- <p>
        <label for="title">旅程名稱</label>
        <input type="text" name="title" id="title">
      </p>
    
      <p>
        <label for="type">Type</label>
        <select name="type" id="type">
                <option value="business">business</option>
                <option value="pleasure">pleasure</option>
                <option value="family">family</option>
                <option value="other">other</option>
        </select>
      </p>
      
      <p>
        <label for="time">Start date: </label>
        <input type="date" name="start_date" />
        <label for="year">y</label>
        <select name="year" id="year">
                 <?php for($i=1960; $i<=2060; $i++){?>
                  <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php }?>
        </select>
        <label for="month">m</label>
        <select name="month" id="month">
                  <?php for($i=1;$i<=12;$i++){?>
                  <option value="<?php echo $i;?>"><?php echo $i;?></option>
                  <?php }?>
        </select>
        <label for="day">d</label>
        <select name="day" id="day">
                  <?php for($i=1;$i<=31;$i++){?>
                  <option value="<?php echo $i;?>"><?php echo $i;?></option>
                  <?php }?>
        </select>
      </p>
      
      <p>
        <label for="status">Status: </label>
        <input type="radio" name="radio" id="male" value="male" />
        <label for="done">Sweet sweet memories</label>

      <input type="radio" name="radio" id="female" value="female" />
      <label for="yet">To be experienced</label>
      </p>
      
        <input type="submit" name="submit" id="submit" value="submit" />                                                  
        <input type="reset" name="Reset" id="reset" value="reset" /> -->
	</form>
</div>
<?php require_once "template/footer.php"; ?>	