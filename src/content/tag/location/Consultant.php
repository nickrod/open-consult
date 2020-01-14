<?php

//

declare(strict_types=1);

//

namespace openconsult\content\tag\location;

//

use openconsult\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $location_id;

  // constants

  public const TABLE = 'consultant_location';

  //

  public const COLUMN = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'location_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
    }

    //

    if (isset($column['location_id']))
    {
      $this->setLocationId($column['location_id']);
    }
  }

  // getters

  public function getConsultantId(): int 
  {
    return $this->consultant_id;
  }

  //

  public function getLocationId(): int 
  {
    return $this->location_id;
  }

  // setters

  public function setConsultantId(int $consultant_id): void 
  {
    if ($consultant_id > 0)
    {
      $this->consultant_id = $consultant_id;
    }
  }

  //

  public function setLocationId(int $location_id): void 
  {
    if ($location_id > 0)
    {
      $this->location_id = $location_id;
    }
  }
}
