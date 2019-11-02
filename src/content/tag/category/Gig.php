<?php

//

namespace nickrod\openconsult\content\tag\category;

//

use nickrod\openconsult\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $category_id;

  // columns

  public static $column = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'gig_category';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['gig_id']))
    {
      $this->setGigId($column['gig_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getGigId() 
  {
    return filter_var($this->gig_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCategoryId() 
  {
    return filter_var($this->category_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setCategoryId($category_id) 
  {
    if (Validate::id($category_id))
    {
      $this->category_id = $category_id;
    }
  }
}
