<?php

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

  // columns

  public static $column = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'location_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'service_location';

  // constructor

  public function __construct($column = [])
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

  public function getServiceId() 
  {
    return filter_var($this->service_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getLocationId() 
  {
    return filter_var($this->location_id, FILTER_SANITIZE_NUMBER_INT);
  }

  // setters

  public function setServiceId($service_id) 
  {
    if (Validate::id($service_id))
    {
      $this->service_id = $service_id;
    }
  }

  //

  public function setLocationId($location_id) 
  {
    if (Validate::id($location_id))
    {
      $this->location_id = $location_id;
    }
  }
}
