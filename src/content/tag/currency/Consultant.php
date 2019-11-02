<?php

//

namespace nickrod\openconsult\content\tag\currency;

//

use nickrod\openconsult\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $currency_id;

  // columns

  public static $column = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'currency_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'consultant_currency';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
    }

    //

    if (isset($column['currency_id']))
    {
      $this->setCurrencyId($column['currency_id']);
    }
  }

  // getters

  public function getConsultantId() 
  {
    return filter_var($this->consultant_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCurrencyId() 
  {
    return filter_var($this->currency_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setCurrencyId($currency_id) 
  {
    if (Validate::id($currency_id))
    {
      $this->currency_id = $currency_id;
    }
  }
}
