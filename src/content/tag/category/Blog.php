<?php

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

  // columns

  public static $column = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'blog_category';

  // constructor

  public function __construct($column = [])
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

  public function getBlogId() 
  {
    return filter_var($this->blog_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCategoryId() 
  {
    return filter_var($this->category_id, FILTER_SANITIZE_NUMBER_INT);
  }

  // setters

  public function setBlogId($blog_id) 
  {
    if (Validate::id($blog_id))
    {
      $this->blog_id = $blog_id;
    }
  }

  //

  public function setCategoryId($category_id) 
  {
    if (Validate::id($category_id))
    {
      $this->category_id = $category_id;
    }
  }
}
