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
  public $id, $name, $type, $time, $status, $group_id;
  Function Trip($id){
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
			$this->group_id = $row[5];
		}else{
			return NULL;
		}
	}
}
  Function Trip($name, $type, $time, $status, $group_id){
		$this->name = $name;
		$this->type = $type;
		$this->time = $time;
		$this->status = $status;
		$this->group_id = $group_id;
  }
  Function Save(){
	if ($this->id == NULL){
		// SQL INSERT
	}else{
		// SQL UPDATE
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