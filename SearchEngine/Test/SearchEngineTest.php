<?php
namespace SearchEngine\Test;
use PHPUnit\Framework\TestCase;

class SearchEngineTest extends TestCase
{

  /**
   * @test
   */
  public function shouldNotFindAnyUser()
  {
    $myCollaboratorProphecy = $this->prophesize(UserRepository::class);
    $myCollaboratorProphecy->findByLocation('Son Sardina')->willReturn([]);
    $searchEngine = new SearchEngine($myCollaboratorProphecy->reveal());

    $result = $searchEngine->findByProfile('Informatica', 'Son Sardina');

    $this->assertEquals([], $result);
  }

  /**
   * @test
   */
  public function shouldReturnOneUser()
  {
    $user = static::buildUser('Toni Robles', ['Informatica'], 'Son Sardina');
    $myCollaboratorProphecy = $this->prophesize(UserRepository::class);
    $myCollaboratorProphecy
      ->findByLocation('Son Sardina')
      ->willReturn([$user]);

    $searchEngine = new SearchEngine($myCollaboratorProphecy->reveal());
    $result = $searchEngine->findByProfile('Informatica', 'Son Sardina');

    $this->assertEquals([$user], $result);
  }

  /**
   * @test
   */
  public function shouldNotFindUserWithExistingLocationButNoProfileMatch()
  {

    $user = static::buildUser('Toni Robles', ['Futbol'], 'Son Sardina');
    $myCollaboratorProphecy = $this->prophesize(UserRepository::class);
    $myCollaboratorProphecy
      ->findByLocation('Son Sardina')
      ->willReturn([$user]);

    $searchEngine = new SearchEngine($myCollaboratorProphecy->reveal());
    $result = $searchEngine->findByProfile('Musica', 'Son Sardina');

    $this->assertEquals([], $result);
  }

  /**
   * @test
   */
  public function shouldFindOneUserMatchingLocationAndProfile()
  {
    $user1 = static::buildUser('Toni Robles', ['Informatica'], 'Son Sardina');
    $user2 = static::buildUser('Toni Pizà', ['Musica'], 'Son Sardina');
    $myCollaboratorProphecy = $this->prophesize(UserRepository::class);
    $myCollaboratorProphecy
      ->findByLocation('Son Sardina')
      ->willReturn([$user1, $user2]);


    $searchEngine = new SearchEngine($myCollaboratorProphecy->reveal());
    $result = $searchEngine->findByProfile('Informatica', 'Son Sardina');

    $this->assertEquals([$user1], $result);
  }

  protected static function buildUser($name, $profile, $location)
  {
    return new User($name, $profile, $location);
  }
}