<?php
namespace SearchEngine;

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
      foreach ($locationFilteredUsers as $locationFilteredUser) {
        if (in_array($query, $locationFilteredUser->profile)) {
          $profileFilteredUsers[] = $locationFilteredUser;
        }
      }
    }

    return $profileFilteredUsers;
  }
}
 ?>
