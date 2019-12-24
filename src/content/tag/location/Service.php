<?php

//

declare(strict_types=1);

//

namespace openconsult\content\tag\location;

//

use openconsult\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $location_id;

  // constants

  public const COLUMN = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'location_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  //

  public const TABLE = 'service_location';

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['service_id']))
    {
      $this->setServiceId($column['service_id']);
    }

    //

    if (isset($column['location_id']))
    {
      $this->setLocationId($column['location_id']);
    }
  }

  // getters

  public function getServiceId(): int 
  {
    return $this->service_id;
  }

  //

  public function getLocationId(): int 
  {
    return $this->location_id;
  }

  // setters

  public function setServiceId(int $service_id): void 
  {
    $this->service_id = $service_id;
  }

  //

  public function setLocationId(int $location_id): void 
  {
    $this->location_id = $location_id;
  }
}
