<?php
namespace SearchEngine;

use SearchEngine\Entities\User;

class SearchEngine
{
  /**
   * @var UserRepository
   */
  protected $repository;

  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  public function findByProfile($query, $location)
  {
    $locationFilteredUsers = $this->repository->findByLocation($location);
    if (!$locationFilteredUsers) {
      return [];
    }

    $profileFilteredUsers = [];
    if ($locationFilteredUsers) {
      $profileFilteredUsers = array_filter($locationFilteredUsers, function (User $user) use ($query) {
        return in_array($query, $user->profile);
      });
    }

    return $profileFilteredUsers;
  }
}
 ?>
