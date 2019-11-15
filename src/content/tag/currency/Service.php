<?php

//

namespace openconsult\content\tag\currency;

//

use openconsult\base\Table;

//

class Service extends Table
{
  // variables

  protected $service_id;
  protected $currency_id;

  // columns

  public static $column = [
    'service_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'currency_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'service_currency';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['service_id']))
    {
      $this->setServiceId($column['service_id']);
    }

    //

    if (isset($column['currency_id']))
    {
      $this->setCurrencyId($column['currency_id']);
    }
  }

  // getters

  public function getServiceId() 
  {
    return filter_var($this->service_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCurrencyId() 
  {
    return filter_var($this->currency_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setCurrencyId($currency_id) 
  {
    if (Validate::id($currency_id))
    {
      $this->currency_id = $currency_id;
    }
  }
}
