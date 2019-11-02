<?php

//

namespace nickrod\openconsult\content\tag\location;

//

use nickrod\openconsult\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $location_id;

  // columns

  public static $column = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'location_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'gig_location';

  // constructor

  public function __construct($column = [])
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

  public function getGigId() 
  {
    return filter_var($this->gig_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getLocationId() 
  {
    return filter_var($this->location_id, FILTER_SANITIZE_NUMBER_INT);
  }

  // setters

  public function setGigId($gig_id) 
  {
    if (Validate::id($gig_id))
    {
      $this->gig_id = $gig_id;
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
