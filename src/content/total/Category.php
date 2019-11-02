<?php

//

namespace nickrod\openconsult\content\total;

//

use nickrod\openconsult\base\Table;

//

class Category extends Table
{
  // variables

  protected $category_id;
  protected $total_blogs;
  protected $total_consultants;
  protected $total_gigs;
  protected $total_services;

  // columns

  public static $column = [
    'category_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_blogs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_consultants' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'category_total';

  // getters

  public function getCategoryId() 
  {
    return filter_var($this->category_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalBlogs() 
  {
    return filter_var($this->total_blogs, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalConsultants() 
  {
    return filter_var($this->total_consultants, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalGigs() 
  {
    return filter_var($this->total_gigs, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalServices() 
  {
    return filter_var($this->total_services, FILTER_SANITIZE_NUMBER_INT);
  }
}
