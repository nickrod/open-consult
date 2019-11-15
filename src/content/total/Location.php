<?php

//

namespace openconsult\content\total;

//

use openconsult\base\Table;

//

class Location extends Table
{
  // variables

  protected $location_id;
  protected $total_consultants;
  protected $total_gigs;
  protected $total_services;

  // columns

  public static $column = [
    'location_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_consultants' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'location_total';

  // getters

  public function getLocationId() 
  {
    return filter_var($this->location_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalConsultants() 
  {
    return filter_var($this->total_consultants, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalGigs() 
  {
    return filter_var($this->total_gigs, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalServices() 
  {
    return filter_var($this->total_services, FILTER_SANITIZE_NUMBER_INT);
  }
}
