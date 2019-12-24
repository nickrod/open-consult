<?php

//

declare(strict_types=1);

//

namespace openconsult\content\tag\category;

//

use openconsult\base\Table;

//

class Blog extends Table
{
  // variables

  protected $blog_id;
  protected $category_id;

  // constants

  public const COLUMN = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  //

  public const TABLE = 'blog_category';

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['blog_id']))
    {
      $this->setBlogId($column['blog_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getBlogId(): int 
  {
    return $this->blog_id;
  }

  //

  public function getCategoryId(): int 
  {
    return $this->category_id;
  }

  // setters

  public function setBlogId(int $blog_id): void 
  {
    $this->blog_id = $blog_id;
  }

  //

  public function setCategoryId(int $category_id): void 
  {
    $this->category_id = $category_id;
  }
}
