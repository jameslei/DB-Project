<?php require_once "template/header.php"; ?>

<?php $user = Account::find($_SESSION['aid']);
      $traveller = $user->traveller;
      $trips = $traveller->getTrip($traveller->id);
      $groups = $traveller->getGroup($traveller->id);
?>

<p class="welcome">你好! <?php echo $user->traveller->name; ?>, 你可以按此<a href="logout.php">登出</a>.</p>
<div id="dashboard">
    <div id="trip" class="forty-five left">
        <h1>旅程</h1>
        <table>
            <tr>
                <th>開始日期</th>
                <th>旅程名稱</th>
            </tr>
            <?php foreach($trips as $trip){ ?>
            <tr>
                <td><?php echo $trip->time; ?></td>
                <td><a href="<?php echo "trip.php?id=".$traveller->id; ?>"><?php echo $trip->name; ?></a></td>
            </tr>
            <?php } ?>
        </table>
        <ul>
            <li><a href="<?php echo "newtrip.php?id=".$traveller->id."&belongs_to=traveller"?>">新增</a></li>
            <li><a href="#">更多</a></li>
        </ul>
    </div>
    <div id="group" class="forty-five right">
        <h1>群組</h1>
        <table>
            <tr>
                <th>群組名稱</th>
                <th>人數</th>
            </tr>
            <?php foreach($groups as $group){ ?>
            <tr>
                <td><a href="group.php?id=<?php echo $group->id;?>"><?php echo $group->name; ?></a></td>
                <td><?php echo count($group->members()); ?></td>
            </tr>
            <?php } ?>
        </table>
        <ul>
            <li><a href="#">更多</a></li>
        </ul>
    </div>
    <div id="city" class="forty-five left">
        <h1>城市</h1>
        <table>
            <tr>
                <th>你曾到達的城市</th>
                <th>日期</th>
            </tr>
            <tr>
                <td>台北</td>
                <td>2010-12-31</td>
            </tr>
            <tr>
                <td>澳門</td>
                <td>2011-01-22</td>
            </tr>
        </table>
        <ul>
            <li><a href="#">更多</a></li>
        </ul>
    </div>
    <div id="favorite" class="forty-five right">
        <h1>♥</h1>
        <table>
            <tr>
                <th>名字</th>
                <th>時間</th>
                <th>地點</th>
                <th>備註</th>
            </tr>
            <tr>
                <td>豬扒包</td>
                <td>2010-12-31</td>
                <td>澳門</td>
                <td>好好食!</td>
            </tr>
            <tr>
                <td>葡撻</td>
                <td>2011-1-22</td>
                <td>澳門</td>
                <td>正!</td>
            </tr>
        </table>   
        <ul>
            <li><a href="#">新增</a></li>
            <li><a href="#">更多</a></li>
        </ul>     
    </div>
</div>
<?php require_once "template/footer.php"; ?>