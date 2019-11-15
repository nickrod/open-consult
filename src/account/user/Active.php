<?php

//

namespace openconsult\account\user;

//

use openconsult\tools\Validate;

//

class Active extends User
{
  // variables

  protected $account_id;
  protected $chat_online;
  protected $site_online;
  protected $updated_date;

  // columns

  public static $column = [
    'account_id' => ['key' => true, 'index' => true, 'allowed' => true, 'order_by' => false],
    'chat_online' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'site_online' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'account_active';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['account_id']))
    {
      $this->setAccountId($column['account_id']);
    }

    //

    if (isset($column['chat_online']))
    {
      $this->setChatOnline($column['chat_online']);
    }

    //

    if (isset($column['site_online']))
    {
      $this->setSiteOnline($column['site_online']);
    }
  }

  // getters

  public function getAccountId() 
  {
    return filter_var($this->account_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getChatOnline() 
  {
    return $this->chat_online;
  }

  //

  public function getSiteOnline() 
  {
    return $this->site_online;
  }

  //

  public function getUpdatedDate() 
  {
    return $this->updated_date;
  }

  // setters

  public function setAccountId($account_id) 
  {
    if (Validate::id($account_id))
    {
      $this->account_id = $account_id;
    }
  }

  //

  public function setChatOnline($chat_online) 
  {
    if (Validate::isBoolean($chat_online))
    {
      $this->chat_online = $chat_online;
    }
  }

  //

  public function setSiteOnline($site_online) 
  {
    if (Validate::isBoolean($site_online))
    {
      $this->site_online = $site_online;
    }
  }
}
