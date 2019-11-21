<?php

//

namespace openconsult\content\tag\partner;

//

use openconsult\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $account_id;

  // columns

  public static $column = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'service_partner';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['service_id']))
    {
      $this->setServiceId($column['service_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getServiceId() 
  {
    return filter_var($this->service_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getAccountId() 
  {
    return filter_var($this->account_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setAccountId($account_id) 
  {
    if (Validate::id($account_id))
    {
      $this->account_id = $account_id;
    }
  }
}
