<?php

//

namespace nickrod\openconsult\content\total;

//

use nickrod\openconsult\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $total_favorites;

  // columns

  public static $column = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'service_total';

  // getters

  public function getServiceId() 
  {
    return filter_var($this->service_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalFavorites() 
  {
    return filter_var($this->total_favorites, FILTER_SANITIZE_NUMBER_INT);
  }
}
