<?php

//

namespace nickrod\openconsult\content\tag\favorite;

//

use nickrod\openconsult\base\Table;

//

class Blog extends Table
{
  // variables

  protected $blog_id;
  protected $account_id;

  // columns

  public static $column = [
    'blog_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'blog_favorite';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['blog_id']))
    {
      $this->setBlogId($column['blog_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getBlogId() 
  {
    return filter_var($this->blog_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getAccountId() 
  {
    return filter_var($this->account_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setAccountId($account_id) 
  {
    if (Validate::id($account_id))
    {
      $this->account_id = $account_id;
    }
  }
}
