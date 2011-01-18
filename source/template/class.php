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
  public function find($id){
      $query = "SELECT * from TRAVELLER WHERE uid='$id'";
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
		      $city = new City($row[0], $row[1], $row[2]);
			  $c_array[] = $city;
		  }
		  if ($c_array!=NULL){
		      return $c_array;
		  }else{
		      return NULL;
	      }  
      }
  }
  //public function getFavor($uid){
  //    $query = "SELECT * from TRAVELLER, TRIP, LOCATION, FAV_THING WHERE TRAVELLER.uid='$uid' AND TRAVELLER.uid=TRIP.owner_id AND TRIP.tid=LOCATION.tid AND LOCATION.lid=FAV_THING.lid";
	//  }
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
      //$query = "SELECT name, count(*) FROM (SELECT * FROM GROUP JOIN GROUP_TRAVELLER GROUP_TRAVELLER.gid = GROUP.gid) WHERE GROUP_TRAVELLER.uid = '$uid'";
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
<<<<<<< HEAD

=======
>>>>>>> 92a21fd98685b0f84bcdcb0cdf67b88b83b04393
  const accepted = '已接受';
  const declined = '已拒絕';
  const new_invite = '尚未接受';
  public $id, $name, $description, $creator_id;  //creator_id在DB裡叫做uid喔
  function Group($name, $description, $creator_id){
      $this->name = $name;
      $this->description = $description;
      $this->creator_id = $creator_id;
  }
<<<<<<< HEAD


=======
>>>>>>> 92a21fd98685b0f84bcdcb0cdf67b88b83b04393
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
		return true;
	}
<<<<<<< HEAD

  function find($id){
      $query = "SELECT * FROM `GROUP` WHERE gid=$id";

=======
  }
  public function find($id){
      $query = "SELECT * FROM GROUP WHERE gid=$id;";
>>>>>>> 92a21fd98685b0f84bcdcb0cdf67b88b83b04393
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
<<<<<<< HEAD
}
=======
>>>>>>> 92a21fd98685b0f84bcdcb0cdf67b88b83b04393
  public function getCount($gid){
      $query = "SELECT * FROM `GROUP` WHERE `GROUP`.gid=$gid";
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
		$query = "UPDATE trip SET name='$this->name', type='$this->type', time='$this->time', status='$this->status', belongs_to='$this->belongs_to', owner_id='$this->owner_id' WHERE id='$this->id';";
		$result = mysql_query($query);
	}
	if(!$result){
		return false;	
	}else{
		return true;
	}
  }

  public function get_days(){
	$trip = Trip::find($this->id);
	$query = "SELECT * FROM DAY WHERE tid=$this->id ;";
	$result = mysql_query($query);
	if(!$result){
		return false;
	}else{
		return $result;
	}
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
              $loaction->id = $row[0];
              return $location;
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
      $this->next = $next;
	  $this->tid = $tid;
  }

  public function find($id){
      $query = "SELECT * from DAY WHERE did='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $day = new Day($row[1], $row[3]);
              $day->id = $row[0];
              return $day;
          }else{
              return NULL;
          }
      }
  }
  function get_location(){  //find the location(s) of the day
	$query = "SELECT name FROM DAY NATURAL JOIN LOCATION NATURAL JOIN LOCATION_DAY WHERE did='$this->id'";
	$result = mysql_query($query);
	if (!$result){
		return false;
	}else{
		while ($row = mysql_fetch_row($result)){
			$location[] = $row[0];
			$count++;
		}	
		return $location;
	}
  }
}
class Schedule{
  public $id, $time, $next;
  function Schedule($time, $next){
      $this->time = $time;
      $this->next = $next;
  }

  public function find($id){
      $query = "SELECT * from SCHEDULE WHERE sid='$id'";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $shedule = new Schedule($row[1], $row[3]);
              $shedule->id = $row[0];
              return $schedule;
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
}
class City{
  public $id, $name, $country;
  function City($name, $country){
      $this->name = $name;
      $this->country = Country::find($country);
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
  public $id, $name, $info, $location_id;
  function Shelter($name, $info, $location_id){
      $this->name = $name;
      $this->info = $info;
      $this->location_id = $location_id;
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
}
?>