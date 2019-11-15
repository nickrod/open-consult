<?php

//

namespace openconsult\content\tag\category;

//

use openconsult\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $category_id;

  // columns

  public static $column = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'category_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'service_category';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['service_id']))
    {
      $this->setServiceId($column['service_id']);
    }

    //

    if (isset($column['category_id']))
    {
      $this->setCategoryId($column['category_id']);
    }
  }

  // getters

  public function getServiceId() 
  {
    return filter_var($this->service_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCategoryId() 
  {
    return filter_var($this->category_id, FILTER_SANITIZE_NUMBER_INT);
  }

  // setters

  public function setServiceId($service_id) 
  {
    if (Validate::id($service_id))
    {
      $this->service_id = $service_id;
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
