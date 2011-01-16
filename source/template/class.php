<?php
function connect_db(){
    $link = mysql_connect('localhost', 'root', '');
    if (!$link){
      die("connection wrong: <br />".mysql_error());
    }

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
      $query = "SELECT username, password, aid, uid FROM ACCOUNT WHERE aid='$id';";
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
  Function Traveller($name, $gender, $birthday, $address){
      $this->name = $name;
      $this->gender = $gender;
      $this->birthday = $birthday;
      $this->address = $address;
  }
  Function find($id){
      $query = "SELECT * from TRAVELLER WHERE uid='$id';";
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
}
class Group{
  public $id, $name, $description, $user_id;
  Function Group($name, $description, $user_id){
      $this->name = $name;
      $this->description = $description;
      $this->user_id = $user_id;
  }
  Function find($id){
      $query = "SELECT * from GROUP WHERE gid='$id';";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $group = new Group($row[1], $row[2], $row[3]);
              $group->id = $row[0];
              return $group;
          }else{
              return NULL;
          }
      }
  }
}
class Trip{
  public $id, $type, $time, $status, $group_id;
  Function Trip($type, $time, $status, $group_id){
      $this->type = $type;
      $this->time = $time;
      $this->status = $status;
      $this->address = $group_id;
  }
  Function find($id){
      $query = "SELECT * from TRIP WHERE tid='$id';";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $trip = new Trip($row[1], $row[2], $row[3], $row[4]);
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
  Function Location($name, $trip_id, $city_id, $next, $next_traffic){
      $this->name = $name;
      $this->trip_id = $trip_id;
      $this->city_id = $city_id;
      $this->next = $next;
	  $this->next_traffic = $next_traffic;
  }
  Function find($id){
      $query = "SELECT * from LOCATION WHERE lid='$id';";
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
  public $id, $date, $next;
  Function Day($date, $next){
      $this->date = $date;
      $this->next = $next;
  }
  Function find($id){
      $query = "SELECT * from DAY WHERE did='$id';";
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
}
class Schedule{
  public $id, $time, $next;
  Function Schedule($time, $next){
      $this->time = $time;
      $this->next = $next;
  }
  Function find($id){
      $query = "SELECT * from SCHEDULE WHERE sid='$id';";
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
  Function Favorite($name, $time, $type, $note, $location_id){
      $this->name = $name;
      $this->time = $time;
      $this->type = $type;
      $this->note = $note;
	  $this->location_id = $location_id;
  }
  Function find($id){
      $query = "SELECT * from FAVORITE WHERE fid='$id';";
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
  Function City($name, $country){
      $this->name = $name;
      $this->country = $country;
  }
  Function find($id){
      $query = "SELECT * from CITY WHERE cid='$id';";
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
}
class Country{
  public $name;
  Function find($name){
      $query = "SELECT * from COUNTRY WHERE name='$name';";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $country->name = $row[0];
              return $country;
          }else{
              return NULL;
          }
      }
  }
}
class Shelter{
  public $id, $name, $info, $location_id;
  Function Shelter($name, $info, $location_id){
      $this->name = $name;
      $this->info = $info;
      $this->location_id = $location_id;
  }
  Function find($id){
      $query = "SELECT * from SHELTER WHERE shid='$id';";
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