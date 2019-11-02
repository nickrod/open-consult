<?php

//

namespace nickrod\openconsult\content\total;

//

use nickrod\openconsult\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $total_favorites;

  // columns

  public static $column = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'gig_total';

  // getters

  public function getGigId() 
  {
    return filter_var($this->gig_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalFavorites() 
  {
    return filter_var($this->total_favorites, FILTER_SANITIZE_NUMBER_INT);
  }
}
