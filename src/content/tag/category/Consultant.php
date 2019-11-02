<?php

//

namespace nickrod\openconsult\content\tag\category;

//

use nickrod\openconsult\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $category_id;

  // columns

  public static $column = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'consultant_category';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getConsultantId() 
  {
    return filter_var($this->consultant_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCategoryId() 
  {
    return filter_var($this->category_id, FILTER_SANITIZE_NUMBER_INT);
  }

  // setters

  public function setConsultantId($consultant_id) 
  {
    if (Validate::id($consultant_id))
    {
      $this->consultant_id = $consultant_id;
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
