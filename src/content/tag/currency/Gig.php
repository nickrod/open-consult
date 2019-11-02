<?php

//

namespace nickrod\openconsult\content\tag\currency;

//

use nickrod\openconsult\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $currency_id;

  // columns

  public static $column = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'currency_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'gig_currency';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['gig_id']))
    {
      $this->setGigId($column['gig_id']);
    }

    //

    if (isset($column['currency_id']))
    {
      $this->setCurrencyId($column['currency_id']);
    }
  }

  // getters

  public function getGigId() 
  {
    return filter_var($this->gig_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCurrencyId() 
  {
    return filter_var($this->currency_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setCurrencyId($currency_id) 
  {
    if (Validate::id($currency_id))
    {
      $this->currency_id = $currency_id;
    }
  }
}
