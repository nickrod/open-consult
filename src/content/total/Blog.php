<?php

//

declare(strict_types=1);

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

  // constants

  public const COLUMN = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  //

  public const TABLE = 'blog_total';

  // getters

  public function getBlogId(): int 
  {
    return $this->blog_id;
  }

  //

  public function getTotalFavorites(): int 
  {
    return $this->total_favorites;
  }
}
