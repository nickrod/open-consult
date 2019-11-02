<?php

//

namespace nickrod\openconsult\content\tag\favorite;

//

use nickrod\openconsult\base\Table;

//

class Consultant extends Table
{
  // variables

  protected $consultant_id;
  protected $account_id;

  // columns

  public static $column = [
    'consultant_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'consultant_favorite';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getConsultantId() 
  {
    return filter_var($this->consultant_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getAccountId() 
  {
    return filter_var($this->account_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setAccountId($account_id) 
  {
    if (Validate::id($account_id))
    {
      $this->account_id = $account_id;
    }
  }
}
