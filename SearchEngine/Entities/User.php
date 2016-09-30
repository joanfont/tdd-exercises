<?php
namespace SearchEngine\Entities;

class User
{

  public $name;

  public $profile;

  public $location;

  public function __construct($name, $profile, $location)
  {
    $this->name = $name;
    $this->profile = $profile;
    $this->location = $location;
  }

}
