<?php
function connect_db(){
    $link = mysql_connect('localhost', 'root', '');
    if (!$link){
      die("connection wrong: <br />".mysql_error());
    }
    mysql_query("SET NAMES 'utf8';");
    $db_select = mysql_select_db("Travel Journal");
    if (!$db_select){
      die("selection wrong: <br />".mysql_error());
    }
    return $link;
}

function login_first(){
    if (!isset($_SESSION['aid']) || Account::find($_SESSION['aid'])==false 
    || Account::find($_SESSION['aid'])==NULL ){
        session_destroy();
        header("Location: login.php?relog=1");
    }
}
function mb_string_intersect($string1, $string2, $minChars = 5)
{   assert('$minChars > 1');
    $string1 = trim($string1);
    $string2 = trim($string2);
    $length1 = mb_strlen($string1);
    $length2 = mb_strlen($string2);
    if ($length1 > $length2) {
        // swap variables, shortest first
        $string3 = $string1;
        $string1 = $string2;
        $string2 = $string3;
        $length3 = $length1;
        $length1 = $length2;
        $length2 = $length3;
        unset($string3, $length3);
    }
    if ($length2 > 255) {
        return null; // to much calculation required
    }
    for ($l = $length1; $l >= $minChars; --$l) { // length
        for ($i = 0, $ix = $length1 - $l; $i <= $ix; ++$i) { // index
            $substring1 = mb_substr($string1, $i, $l);
            $found = mb_strpos($string2, $substring1);
            if ($found !== false) {
                return trim(mb_substr($string2, $found, mb_strlen($substring1)));
            }
        }
    }
    return null;
}
function site_root(){
 //   $file =  explode($_SERVER['PHP_SELF'],mb_string_intersect($_SERVER['SCRIPT_FILENAME'],$_SERVER['PHP_SELF']));
    return $file[0];
}

class Account{
  public $name, $id, $traveller;
  function Account($username, $password, $uid){
      $this->name = $username;
      $this->password = $password;
      $this->traveller = Traveller::find($uid);
  }
  public function find($id){
      $query = "SELECT username, password, aid, uid FROM ACCOUNT WHERE aid='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          $row = mysql_fetch_row($result);
          $user = new Account($row[0], $row[1], $row[3]);
          $user->id = $row[2];
          return $user;
      }
  }
  public function logout(){
      session_destroy();
  }
  public function exist($name){
      $query = "SELECT aid FROM ACCOUNT WHERE username='$name';";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              return true;
          }else{
              return false;
          }
      }
  }
  public function save(){
      if ($this->id==NULL){
          $t = $this->traveller;
          $query = "INSERT INTO ACCOUNT (`aid`, `username`, `password`, `uid`) VALUES (NULL, '$this->name', '$this->password', '$t->id');";
          $result = mysql_query($query);
           if ($result){
                $this->id = mysql_insert_id();
                return true;
            }else{
                die("error!");
            }
      }else{
          echo "update";
      }
  }
  public function login($name, $password){
      $query = "SELECT aid FROM ACCOUNT WHERE username='$name' AND password='$password';";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $id = $row[0];
              $_SESSION['aid'] = $id;
              return Account::find($id);
          }else{
              return NULL;
          }
      }
  }
  private $password;
}
class Traveller{
  public $id, $name, $gender, $birthday, $address;
  function Traveller($name, $gender, $birthday, $address){
      $this->name = $name;
      $this->gender = $gender;
      $this->birthday = $birthday;
      $this->address = $address;
  }
  public function save(){
      if ($this->id==NULL){
          $query = "INSERT INTO TRAVELLER (`uid`, `name`, `gender`, `bdate`, `addr`) VALUES (NULL, '$this->name', '$this->gender', '$this->birthday', '$this->address');";
          $result = mysql_query($query);
          if ($result){
              $this->id = mysql_insert_id();
              return true;
          }else{
              die("error!");
          }
      }else{
          echo "update";
      }
  }
  public function find_by_uname($uname){
	  $query = "SELECT * from TRAVELLER WHERE name='$uname'";
	  // echo $query;
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $traveller = new Traveller($row[1], $row[2], $row[3], $row[4]);
              $traveller->id = $row[0];
			  // print_r($traveller);
              return $traveller;
          }else{
              return NULL;
          }
      }
  }
  public function find($id){
      $query = "SELECT * from `TRAVELLER` WHERE `uid`=$id;";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $traveller = new Traveller($row[1], $row[2], $row[3], $row[4]);
              $traveller->id = $row[0];
              return $traveller;
          }else{
              return NULL;
          }
      }
  }
  public function getCity($uid){
      $query = "SELECT * from CITY, TRAVELLER_CITY WHERE TRAVELLER_CITY.uid='$uid' AND CITY.cid=TRAVELLER_CITY.cid";
	  $result = mysql_query($query);
	  if(!$result){
	      return false;
	  }else{
	      while($row = mysql_fetch_row($result)){
		      $city = new City($row[1], $row[0]);
			  $city->cid->$row[2];
			  $c_array[] = $city;
		  }
		  if ($c_array!=NULL){
		      return $c_array;
		  }else{
		      return NULL;
	      }  
      }
  }
  public function getFavor($uid){          //an array containing all fav objects
      $query = "SELECT FAV_THING.fid, FAV_THING.name, FAV_THING.time, FAV_THING.type, FAV_THING.note, FAV_THING.lid from FAV_THING, TRAVELLER, TRIP, LOCATION WHERE TRAVELLER.uid='$uid' AND TRAVELLER.uid=TRIP.owner_id AND TRIP.tid=LOCATION.tid AND LOCATION.lid=FAV_THING.lid";
	  $result = mysql_query($query);
	  if(!$result){
	      return false;
	  }else{
	      while($row = mysql_fetch_row($result)){
		      $favor = new Favorite($row[1], $row[2], $row[3], $row[4], $row[5]);
			  $favor->fid = $row[0];
			  $f_array[] = $favor;
		  }
		  if($f_array!=NULL){
		      return $f_array;
		  }else{
		      return NULL;
		  }
	  }
  }
		  
	  
  public function getTrip($uid){
      $query = "SELECT * from TRIP WHERE belongs_to='traveller' AND owner_id = '$uid'";
	  $result = mysql_query($query);
	  if(!$result){
	      return false;
	  }else{
	      while($row = mysql_fetch_row($result)){
              $trip = new Trip($row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
              $trip->id = $row[0];
			  $t_array[] = $trip;
		  }
		  if ($t_array!=NULL){ 		      
		      return $t_array;
		  }else{
		      return NULL;
		  }
	  }  
  }
  public function getGroup($uid){     
	  $query = "SELECT * FROM `GROUP`, `GROUP_TRAVELLER` WHERE `GROUP_TRAVELLER`.uid=$uid AND `GROUP_TRAVELLER`.gid=`GROUP`.gid";
	  $result = mysql_query($query);
	  if(!$result){
	      return false;
	  }else{
	      while($row = mysql_fetch_row($result)){
		      $group = new Group($row[1], $row[2], $row[3]);
		      $group->id = $row[0];
			  $g_array[] = $group;
		  }
		  if ($g_array!=NULL){
		      return $g_array;
		  }else{
		      return NULL;
		  }
	  }  
  }
}

class Group{

  const accepted = '已接受';
  const declined = '已拒絕';
  const new_invite = '尚未接受';
  public $id, $name, $description, $creator_id;  //creator_id在DB裡叫做uid喔
  function Group($name, $description, $creator_id){
      $this->name = $name;
      $this->description = $description;
      $this->creator_id = $creator_id;
  }
  public function Save(){
	 if ($this->id == NULL){  		//new group
		// SQL INSERT
		$query = "INSERT INTO `group`(name, description, uid) VALUES('$this->name','$this->description','$this->creator_id');";
		$result = mysql_query($query);

	}else{  						//existing group
		// SQL UPDATE
		$query = "UPDATE `group` SET name='$this->name', description='$this->description', uid='$this->creator_id' WHERE id='$this->id';";
		$result = mysql_query($query);
	}
	if(!$result){
		return false;	
	}else{
		$this->id = mysql_insert_id();
		return true;
	}
}
  public function find($id){
      $query = "SELECT * FROM `GROUP` WHERE `gid`=$id;";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $group = new Group($row[1], $row[2], $row[3]);  //name, description, uid
              $group->id = $row[0];
              return $group;
          }else{
              return NULL;
          }
      }
  }
  public function getCount($gid){
      $query = "SELECT * FROM `GROUP_TRAVELLER` WHERE `GROUP_TRAVELLER`.gid=$gid";
	  $result = mysql_query($query);
	  $rows = mysql_num_rows($result);
	  if(!result){
	      return false;
	  }else{
	      return $rows;
	  }
  }
  public function members(){
      $query = "SELECT `TRAVELLER`.`uid` FROM `GROUP_TRAVELLER`, `TRAVELLER` where `GROUP_TRAVELLER`.`gid` = $this->id AND `GROUP_TRAVELLER`.`uid`=`TRAVELLER`.`uid`;";
	  //echo $query;
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          while ($row = mysql_fetch_row($result)){
              $member[] = Traveller::find($row[0]);  
				//member array contains traveller objects
          }
          return $member;
      }
  }
  public function new_member($uid){
      $query = "INSERT INTO `GROUP_TRAVELLER` (`gid`, `uid`, `invite_status`) VALUES ('$this->id', '$uid', '".$this::accepted."');";
      $result = mysql_query($query);
      return (!$result)? false : true;
  }
  public function remove_member($uid){
      $query = "DELETE FROM `GROUP_TRAVELLER` WHERE `GROUP_TRAVELLER`.`gid` = $this->id AND `GROUP_TRAVELLER`.`uid` = $uid;";
      $result = mysql_query($query);
      return (!$result)? false : true; 
  }
  public function creator(){
      return Traveller::find($this->creator_id);
  }
  public function get_all_trip(){
	// $id = $this->id;
	$query = "SELECT `tid` FROM `TRIP` WHERE `belongs_to` = 'group' AND `owner_id` = $this->id;";
	$result = mysql_query($query);
	if(!$result){
		return false;
	}else{
		 while ($row = mysql_fetch_row($result)){
              $trip_list[] = Trip::find($row[0]);  
				//trip_list array contains trip objects
		 }
		 return $trip_list;
	}
  }
}
class Trip{
  public $id, $name, $type, $time, $status, $belongs_to, $owner_id;
  public function Trip($name, $type, $time, $status, $belongs_to, $owner_id){  //create trip
		$this->name = $name;
		$this->type = $type;
		$this->time = $time;
		$this->status = $status;
		$this->belongs_to = $belongs_to;
		$this->owner_id = $owner_id;
  }

  public function Save(){      			//save trip  create new or alter existing
	if ($this->id == NULL){  		//new trip
		// SQL INSERT
		$query = "INSERT INTO trip(name, type, time, status, belongs_to, owner_id) VALUES('$this->name','$this->type','$this->time','$this->status','$this->belongs_to','$this->owner_id');";
		$result = mysql_query($query);

	}else{  						//existing trip
		// SQL UPDATE
		$query = "UPDATE trip SET name='$this->name', type='$this->type', time='$this->time', status='$this->status', belongs_to='$this->belongs_to', owner_id='$this->owner_id' WHERE tid='$this->id';";
		$result = mysql_query($query);
		//echo $query;
	}
	if(!$result){
		return false;	
	}else{
		return true;
	}
  }
  private function get_days(){
	$query = "SELECT * FROM DAY WHERE tid=$this->id ORDER BY `date` ;";
	$result = mysql_query($query);
	if(!$result){
		return false;
	}else{
    	$count = 0;
    	while($row = mysql_fetch_row($result)){
    		$days[] = new Day($row[1], $row[2], $row[3]);
    		$days[$count++]->id = $row[0];
    	}
    	return $days;
	}
  }
  
  public function new_day(){
      $date = $this->last_day();
      $date->add(new DateInterval('P1D'));
      $new_day = new Day($date, NULL, $this->id);
      if ($new_day->save()){
          $days = $this->get_days();
          if (count($days)>1){
              $last_day = $days[count($days)-2];
              $last_day->next = $new_day;
              if ($last_day->save()){
                  return true;
              }else{
                  return false;
              }
          }
      }else{
          return false;
      }
      return true;
  }
  
  public function last_day(){
      $days = $this->get_days();
      $date = new DateTime();
      if ($days==NULL){//還沒有day
          $time = explode('-', $this->time);
          $date->setDate($time[0], $time[1], $time[2]-1);
      }else{
          $last_day = $days[count($days)-1];
          $time = explode('-', $last_day->date);
          $date->setDate($time[0], $time[1], $time[2]);
      }
      return $date;
  }
  public function first_day(){
      $days = $this->get_days();
      return ($days==NULL) ? NULL : $days[0];
  }
  
  public function find($id){
	$query = "SELECT * FROM TRIP WHERE tid=$id;";
	$result = mysql_query($query);
	if (!$result){
		return false;
	}else{
		if ($row = mysql_fetch_row($result)){
			$trip = new Trip($row[1],$row[2],$row[3],$row[4],$row[5],$row[6]);
			$trip->id = $row[0];
			return $trip;
		}else{
			return NULL;
		}
	}
  }
  public function getFavor($tid){
      $query = "SELECT FAV_THING.fid, FAV_THING.name, FAV_THING.time, FAV_THING.type, FAV_THING.note, FAV_THING.lid from FAV_THING, TRIP, LOCATION WHERE TRIP.tid=$tid AND TRIP.tid=LOCATION.tid AND LOCATION.lid=FAV_THING.lid";
	  $result = mysql_query($query);
	  if(!$result){
	      return false;
	  }else{
	      while($row = mysql_fetch_row($result)){
		      $favor = new Favorite($row[1], $row[2], $row[3], $row[4], $row[5]);
			  $favor->fid = $row[0];
			  $f_array[] = $favor;
		  }
		  if($f_array!=NULL){
		      return $f_array;
		  }else{
		      return NULL;
		  }
	  }
  }
}

class Location{
  public $id, $name, $trip_id, $city_id, $next, $next_traffic;
  function Location($name, $trip_id, $city_id, $next, $next_traffic){
      $this->name = $name;
      $this->trip_id = $trip_id;
      $this->city_id = $city_id;
      $this->next = $next;
	  $this->next_traffic = $next_traffic;
  }

  public function find($id){
      $query = "SELECT * from LOCATION WHERE lid='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $location = new Location($row[1], $row[3], $row[5], $row[4], $row[2]);
              $location->id = $row[0];
              return $location;
          }else{
              return false;
          }
      }
  }
  public function save(){
      if ($this->id == NULL){  		//new schedule
  		// SQL INSERT
  		$query = "INSERT INTO `Travel Journal`.`LOCATION` (`lid`, `name`, `next_traffic`, `tid`, `next`, `cid`) VALUES (NULL, '$this->name', NULL, $this->trip_id, NULL, $this->city_id);";
  	}else{  						//existing schedule
  		// SQL UPDATE
  		$query = "UPDATE `Travel Journal`.`LOCATION` SET `name` = '$this->name', `cid` = '$this->city_id' WHERE `LOCATION`.`lid` = $this->id;";
  	}
	// echo $query;
  	$result = mysql_query($query);
  	if(!$result){
  		return false;	
  	}else{
  		if ($this->id==NULL)
  		    $this->id = mysql_insert_id();
  		return true;
  	}
  }
  
  public function add_day($day){
      $query = "INSERT INTO `Travel Journal`.`LOCATION_DAY` (`lid`, `did`) VALUES ('$this->id', '$day->id');";
      $result = mysql_query($query);
      return (!$result) ? false : true;
  }
  
  public function getFavor($lid){
      $query = "SELECT FAV_THING.fid, FAV_THING.name, FAV_THING.time, FAV_THING.type, FAV_THING.note, FAV_THING.lid from FAV_THING, LOCATION WHERE LOCATION.lid='$lid' AND LOCATION.lid=FAV_THING.lid";
	  $result = mysql_query($query);
	  if(!$result){
	      return false;
	  }else{
	      while($row = mysql_fetch_row($result)){
		      $favor = new Favorite($row[1], $row[2], $row[3], $row[4], $row[5]);
			  $favor->fid = $row[0];
			  $f_array[] = $favor;
		  }
		  if($f_array!=NULL){
		      return $f_array; 
		  }else{
		      return NULL;
		  }
	  }
  }
}
class Day{
  public $id, $date, $next, $tid;
  function Day($date, $next, $tid){
      $this->date = $date;
      $this->next = ($next==NULL) ? NULL : Day::find($next);
	  $this->tid = $tid;
  }
  public function last(){
      $result = mysql_query("SELECT `did` FROM `DAY` WHERE `next`=$this->id;");
      if (!$result)
        return false;
      if (! $row = mysql_fetch_row($result)){
          return NULL;
      }
      return Day::find($row[0]);
  }
  public function save(){
      $date = $this->date;
      if ($this->id==NULL){
          $query = "INSERT INTO `Travel Journal`.`DAY` (`did`, `date`, `next`, `tid`) VALUES (NULL, '".$date->format("Y-m-d")."', NULL, $this->tid);";
      }else{
          $next = $this->next;
          $query = "UPDATE  `Travel Journal`.`DAY` SET  `next` =  '$next->id' WHERE  `DAY`.`did` =$this->id;";
      }
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          $this->id = mysql_insert_id();
          return true;
      }
  }
  public function find($id){
      $query = "SELECT * from DAY WHERE did='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $day = new Day($row[1], $row[2], $row[3]);
              $day->id = $row[0];
              return $day;
          }else{
              return NULL;
          }
      }
  }
  function get_location(){  //find the location(s) of the day
	$query = "SELECT lid FROM LOCATION NATURAL JOIN LOCATION_DAY WHERE did='$this->id'";
	$result = mysql_query($query);
	if (!$result){
		return false;
	}else{
		while ($row = mysql_fetch_row($result)){
			$location[] = Location::find($row[0]);
		}
		return $location;
	}
  }
  
  public function add_location($name, $day, $cid){
      $location = new Location($name, $day->tid, $cid, NULL, NULL);
      if($location->save()){
          if($location->add_day($day)){
              return true;
          }
          echo "add_day error";
      }
      echo "save error";
      return false;
  }
  
  public function get_schedules(){     //all the schedule of this day in a array
	$query = "SELECT * FROM SCHEDULE WHERE did=$this->id ORDER BY `time` ;";
	$result = mysql_query($query);
	if(!$result){
		return false;
	}else{
    	$count = 0;
    	while($row = mysql_fetch_row($result)){
    		$schedules[] = new Schedule($row[1], $row[2], $row[3], $row[4], $row[5]);
    		$schedules[$count++]->id = $row[0];
    	}
    	return $schedules;
	}
  }
  
  public function new_schedule($time, $lid, $description, $did){
      //Schedule($time, $next, $lid, $description, $did)
	$schedule = new Schedule($time, NULL, $lid, $description, $did);
	if ($schedule->save()){
	    return true;
	}
	echo "error!!!";
	return false;
  }
  
  public function last_schedule(){
	$all_schedules=$this->get_schedules();    // an array containing all schedule objects
	$num = sizeof($all_schedules)-1;
	return $all_schedules[$num];
  }
  public function first_schedule(){
	$all_schedules=$this->get_schedules();    // an array containing all schedule objects
	return $all_schedules[0];
  }
  public function get_shelter(){
	  $query = "SELECT * from SHELTER WHERE did='$this->id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $shelter = new Shelter($row[1], $row[2], $row[3]);
              $shelter->id = $row[0];
              return $shelter;
          }else{
              return NULL;
          }
      }
  }
  public function getFavor($did){
          $query = "SELECT FAV_THING.fid, FAV_THING.name, FAV_THING.time, FAV_THING.type, FAV_THING.note, FAV_THING.lid from FAV_THING, LOCATION_DAY WHERE LOCATION_DAY.did='$did' AND LOCATION_DAY.lid=FAV_THING.lid";
    	  $result = mysql_query($query);
    	  if(!$result){
    	      return false;
    	  }else{
    	      while($row = mysql_fetch_row($result)){
    		      $favor = new Favorite($row[1], $row[2], $row[3], $row[4], $row[5]);
    			  $favor->fid = $row[0];
    			  $f_array[] = $favor;
    		  }
    		  if($f_array!=NULL){
    		      return $f_array; 
    		  }else{
    		      return NULL;
    		  }
    	  }
      }
}
class Schedule{
  public $id, $time, $next, $lid, $description, $did;
  function Schedule($time, $next, $lid, $description, $did){
      $this->time = $time;
      $this->next = $next;
	  $this->lid = $lid;
	  $this->description = $description;
	  $this->did = $did;
  }

  public function find($id){
      $query = "SELECT * from SCHEDULE WHERE sid='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $schedule = new Schedule($row[1], $row[2], $row[3], $row[4], $row[5]);
              $schedule->id = $row[0];
              return $schedule;
          }else{
              return NULL;
          }
      }
  }
  public function Save(){      			//save schedule  create new or alter existing
	if ($this->id == NULL){  		//new schedule
		// SQL INSERT
		$query = "INSERT INTO schedule(time, next, lid, description, did) VALUES('$this->time',NULL,$this->lid,'$this->description',$this->did);";
	}else{  						//existing schedule
		// SQL UPDATE
		$query = "UPDATE trip SET time='$this->time', next='$this->next', lid=$this->lid, description='$this->description', did='$this->did' WHERE id='$this->id';";		
	}
	$result = mysql_query($query);
	if(!$result){
		return false;	
	}else{
		$this->id = mysql_insert_id();
		return true;
	}
  }
  public function next(){
      $query = "SELECT *  FROM  `SCHEDULE` WHERE  `time` >=  '$this->time' AND `sid` > $this->id;";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $next_schedule = new Schedule($row[1], $row[2], $row[3], $row[4], $row[5]);
              $next_schedule->id = $row[0];
              return $next_schedule;
          }else{
              return NULL;
          }
      }
  }
}
class Favorite{
  public $id, $name, $time, $type, $note, $location_id;
  function Favorite($name, $time, $type, $note, $location_id){
      $this->name = $name;
      $this->time = $time;
      $this->type = $type;
      $this->note = $note;
	  $this->location_id = $location_id;
  }

  public function find($id){
      $query = "SELECT * from FAVORITE WHERE fid='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $favorite = new Favorite($row[1], $row[2], $row[3], $row[4], $row[5]);
              $favorite->id = $row[0];
              return $favorite;
          }else{
              return NULL;
          }
      }
  }

  public function save(){
      if ($this->id==NULL){
          $query = "INSERT INTO `FAV_THING`(name, time, type, note, lid) VALUES ('$this->name', '$this->time', '$this->type', '$this->note', '$this->location_id');";
          $result = mysql_query($query);
      }else{
	      $query = "UPDATE `FAV_THING` SET name='$this->name', time='$this->time', type='$this->type', note='$this->note', lid='$this->lid' WHERE id='$this->id';";
		  $result = mysql_query($query);
	  }
	  if(!$result){
	      return false;
	  }else{
	      $this->id = mysql_insert_id();
		  return true;
	  }
  }
}
class City{
  public $id, $name, $country;
  function City($name, $country){
      $this->name = $name;
      $this->country = Country::find($country);
  }
  public function all(){
      $query = "SELECT `cid` from `CITY`;";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          while($row = mysql_fetch_row($result)){
              $cities[] = City::find($row[0]);
          }
          return $cities;
      }
  }
  public function find($id){
      $query = "SELECT * from CITY WHERE cid='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $city = new City($row[1], $row[0]);
              $city->id = $row[2];
              return $city;
          }else{
              return NULL;
          }
      }
  }
  public function find_by_name($name){
	  $query = "SELECT * from CITY WHERE name='$name'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $city = new City($row[1], $row[0]);
              $city->id = $row[2];
              return $city;
          }else{
              return NULL;
          }
      }
  }
  public function save(){
    $country = $this->country;
  	if ($this->id == NULL){
  		$query = "INSERT INTO `Travel Journal`.`CITY` (`country_id`, `name`, `cid`) VALUES ('$country->id', '$this->name', NULL);";
  	}else{
  		$query = "UPDATE `Travel Journal`.`CITY` SET `country_id` = '$country->id', `name` = '$this->name' WHERE `CITY`.`cid` = $this->id;";
  	}
  	$result = mysql_query($query);
  	return (!$result) ? false : true;
  }
}
class Country{
  public $name, $id;
  public function Country($name){
      $this->name = $name;
  }
  public function find($id){
      $query = "SELECT * from COUNTRY WHERE country_id='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $country = new Country($row[1]);
              $country->id = $row[0];
              return $country;
          }else{
              return NULL;
          }
      }
  }
}
class Shelter{
  public $id, $name, $info, $day;
  function Shelter($name, $info, $day){
      $this->name = $name;
      $this->info = $info;
      $this->day = $day;
  }

  public function find($id){
      $query = "SELECT * from SHELTER WHERE shid='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $shelter = new Shelter($row[1], $row[2], $row[3]);
              $shelter->id = $row[0];
              return $shelter;
          }else{
              return NULL;
          }
      }
  }
  public function Save(){      			//save schedule  create new or alter existing
	if ($this->id == NULL){  		//new schedule
		// SQL INSERT
		$query = "INSERT INTO shelter(name, info, did) VALUES('$this->name','$this->info','$this->day');";
		// echo $query;
		$result = mysql_query($query);

	}else{  						//existing schedule
		// SQL UPDATE
		$query = "UPDATE shelter SET name='$this->name', info='$this->info', did='$this->day'WHERE shid='$this->id';";
		$result = mysql_query($query);
	}
	if(!$result){
		return false;	
	}else{
		$this->id = mysql_insert_id();
		return true;
	}
  }
}
?>