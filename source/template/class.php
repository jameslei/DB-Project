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
<<<<<<< HEAD
  public $id, $name, $type, $time, $status, $belongs_to, $owner_id;
  Function Trip($id){              //find trip
	$query = "SELECT * FROM TRIP WHERE tid='$id';";
	if (!$result){
		return false;
	}else{
		if ($row = myseql_fetch_row($result)){
			$this->id = $row[0];
			$this->name = $row[1];
			$this->type = $row[2];
			$this->time = $row[3];
			$this->status = $row[4];
			$this->belongs_to = $row[5];
			$this->owner_id = $row[6];
		}else{
			return NULL;
		}
	}
}
  Function Trip($name, $type, $time, $status, $belongs_to, $owner_id){  //create trip
		$this->name = $name;
		$this->type = $type;
		$this->time = $time;
		$this->status = $status;
		$this->belongs_to = $belongs_to;
		$this->group_id = $owner_id;
  }
  Function Save(){      			//save trip  create new or alter existing
	if ($this->id == NULL){  		//new trip
		// SQL INSERT
		$query = "INSERT INTO trip(name, type, time, status, belongs_to, owner_id) VALUES('$this->name','$this->type','$this->time','$this->status','$this->belongs_to','$this->owner_id');";
		$result = mysql_query($query);

	}else{  						//existing trip
		// SQL UPDATE
		$query = "UPDATE trip SET name='$this->name', type='$this->type', time='$this->time', status='$this->status', belongs_to='$this->belongs_to', owner_id='$this->owner_id';";
		$result = mysql_query($query);
	}
	if(!$result){
		return false;	
	}else{
		return true;
	}
=======
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
>>>>>>> b203a5bb9d43c09717135ac0dcdb389a738fa282
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