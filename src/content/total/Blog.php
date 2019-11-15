<?php

//

namespace openconsult\content\total;

//

use openconsult\base\Table;

//

class Blog extends Table
{
  // variables

  protected $blog_id;
  protected $total_favorites;

  // columns

  public static $column = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'blog_total';

  // getters

  public function getBlogId() 
  {
    return filter_var($this->blog_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalFavorites() 
  {
    return filter_var($this->total_favorites, FILTER_SANITIZE_NUMBER_INT);
  }
}
