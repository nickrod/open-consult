<?php

//

namespace openconsult\total;

//

use openconsult\base\Table;
use openconsult\tools\Validate;

//

class Total extends Table
{
  // variables

  protected $id;
  protected $total_accounts;
  protected $total_accounts_active;
  protected $total_currencies;
  protected $total_categories;
  protected $total_locations;
  protected $total_blogs;
  protected $total_consultants;
  protected $total_gigs;
  protected $total_services;

  // columns

  public static $column = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_accounts' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_accounts_active' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_currencies' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_categories' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_locations' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_blogs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_consultants' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'total';

  // getters

  public function getId() 
  {
    return $this->id;
  }

  //

  public function getTotalAccounts() 
  {
    return $this->total_accounts;
  }

  //

  public function getTotalAccountsActive() 
  {
    return $this->total_accounts_active;
  }

  //

  public function getTotalCurrencies() 
  {
    return $this->total_currencies;
  }

  //

  public function getTotalCategories() 
  {
    return $this->total_categories;
  }

  //

  public function getTotalLocations() 
  {
    return $this->total_locations;
  }

  //

  public function getTotalBlogs() 
  {
    return $this->total_blogs;
  }

  //

  public function getTotalConsultants() 
  {
    return $this->total_consultants;
  }

  //

  public function getTotalGigs() 
  {
    return $this->total_gigs;
  }

  //

  public function getTotalServices() 
  {
    return $this->total_services;
  }
}
