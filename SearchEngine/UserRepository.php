<?php
namespace SearchEngine;

interface UserRepository
{
  public function findByLocation($location);
}
 ?>
