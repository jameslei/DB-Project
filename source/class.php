<?php
class Account{
  public $name, $id, $account_id;
  private $password;
}
class Traveller{
  public $id, $name, $gender, $birthday, $address;
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