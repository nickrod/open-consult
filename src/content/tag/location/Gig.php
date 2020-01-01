<?php

//

declare(strict_types=1);

//

namespace openconsult\content\tag\location;

//

use openconsult\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $location_id;

  // constants

  public const TABLE = 'gig_location';

  //

  public const COLUMN = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'location_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['gig_id']))
    {
      $this->setGigId($column['gig_id']);
    }

    //

    if (isset($column['location_id']))
    {
      $this->setLocationId($column['location_id']);
    }
  }

  // getters

  public function getGigId(): int 
  {
    return $this->gig_id;
  }

  //

  public function getLocationId(): int 
  {
    return $this->location_id;
  }

  // setters

  public function setGigId(int $gig_id): void 
  {
    $this->gig_id = $gig_id;
  }

  //

  public function setLocationId(int $location_id): void 
  {
    $this->location_id = $location_id;
  }
}
