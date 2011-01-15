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
  function Account($id){
      $query = "SELECT username, password, aid, uid from ACCOUNT WHERE aid='$id';";
      $result = mysql_query($query);
      if (!$result){
          mysql_close($db_server);
          return false;
      }else{
          $row = mysql_fetch_row($result);
          $this->id = $row[2];
          $this->name = $row[0];
          $this->password = $row[1];
          $this->traveller = new Traveller($row[3]);
      }
  }
  
  public function login($name, $password){
      $query = "SELECT aid from ACCOUNT WHERE username='$name' AND password='$password';";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $id = $row[0];
              return new Account($id);
          }else{
              return NULL;
          }
      }
  }
  private $password;
}
class Traveller{
  public $id, $name, $gender, $birthday, $address;
  Function Traveller($id){
      $db_server = connect_db();
      $query = "SELECT * from TRAVELLER WHERE uid='$id';";
      $result = mysql_query($query);
      if (!$result){
          return false;
      }else{
          if ($row = mysql_fetch_row($result)){
              $this->id = $row[0];
              $this->name = $row[1];
              $this->gender = $row[2];
              $this->birthday = $row[3];
              $this->address = $row[4];
              return $this;
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
  public $id, $type, $time, $status, $group_id;
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