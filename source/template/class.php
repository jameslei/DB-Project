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
  public $id, $name, $description, $account_id;
}
class Trip{
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
  }
}
class Location{
  public $id, $name, $trip_id, $city_id, $next, $next_traffic;
}
class Day{
  public $id, $date, $next;
}
class Schedule{
  public $id, $time, $expanse_id, $next;
}
class Favorite{
  public $id, $name, $time, $type, $note, $location_id;
}
class city{
  public $name, $country;
}
class Country{
  public $name;
}
class Shelter{
  public $id, $name, $info, $location_id;
}
?>