<?php

//

namespace nickrod\openconsult\content\tag\location;

//

use nickrod\openconsult\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $location_id;

  // columns

  public static $column = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'location_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'consultant_location';

  // constructor

  public function __construct($column = [])
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

  public function getConsultantId() 
  {
    return filter_var($this->consultant_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getLocationId() 
  {
    return filter_var($this->location_id, FILTER_SANITIZE_NUMBER_INT);
  }

  // setters

  public function setConsultantId($consultant_id) 
  {
    if (Validate::id($consultant_id))
    {
      $this->consultant_id = $consultant_id;
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
