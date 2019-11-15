<?php

//

namespace openconsult\content\tag\favorite;

//

use openconsult\base\Table;

//

class Gig extends Table
{
  // variables

  protected $gig_id;
  protected $account_id;

  // columns

  public static $column = [
    'gig_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false]
  ];

  // constants

  public const TABLE_NAME = 'gig_favorite';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['gig_id']))
    {
      $this->setGigId($column['gig_id']);
    }

    //

    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }
  }

  // getters

  public function getGigId() 
  {
    return filter_var($this->gig_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getAccountId() 
  {
    return filter_var($this->account_id, FILTER_SANITIZE_NUMBER_INT);
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

  public function setAccountId($account_id) 
  {
    if (Validate::id($account_id))
    {
      $this->account_id = $account_id;
    }
  }
}
