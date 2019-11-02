<?php

//

namespace nickrod\openconsult\account\user;

//

use nickrod\openconsult\base\Table;
use nickrod\openconsult\exceptions\OpenconsultException;
use nickrod\openconsult\tools\Validate;

//

class User extends Table
{
  // variables

  protected $id;
  protected $email;
  protected $nickname;
  protected $username;
  protected $password;
  protected $admin;
  protected $enabled;
  protected $updated_date;

  // columns

  public static $column = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'email' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 3, 'max_length' => 100],
    'nickname' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 3, 'max_length' => 30],
    'username' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 3, 'max_length' => 12],
    'password' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 8, 'max_length' => 100],
    'admin' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'enabled' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'account';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['email']))
    {
      $this->setEmail($column['email']);
    }

    //

    if (isset($column['nickname']))
    {
      $this->setNickname($column['nickname']);
    }

    //

    if (isset($column['username']))
    {
      $this->setUsername($column['username']);
    }

    //

    if (isset($column['password']))
    {
      $this->setPassword($column['password']);
    }

    //

    if (isset($column['admin']))
    {
      $this->setAdmin($column['admin']);
    }

    //

    if (isset($column['enabled']))
    {
      $this->setEnabled($column['enabled']);
    }
  }

  // getters

  public function getId() 
  {
    return filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getEmail() 
  {
    return filter_var($this->email, FILTER_SANITIZE_EMAIL);
  }

  //

  public function getNickname() 
  {
    return filter_var($this->nickname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getUsername() 
  {
    return filter_var($this->username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getPassword() 
  {
    return $this->password;
  }

  //

  public function getAdmin() 
  {
    return $this->admin;
  }

  //

  public function getEnabled() 
  {
    return $this->enabled;
  }

  //

  public function getUpdatedDate() 
  {
    return $this->updated_date;
  }

  // setters

  public function setId($id) 
  {
    if (Validate::id($id))
    {
      $this->id = $id;
    }
  }

  //

  public function setEmail($email) 
  {
    if (Validate::length($email, ['min' => self::$column['email']['min_length'], 'max' => self::$column['email']['max_length']]) && Validate::email($email))
    {
      $this->email = $email;
    }
  }

  //

  public function setNickname($nickname) 
  {
    if (Validate::length($nickname, ['min' => self::$column['nickname']['min_length'], 'max' => self::$column['nickname']['max_length']]))
    {
      $this->nickname = $nickname;
    }
  }

  //

  public function setUsername($username) 
  {
    if (Validate::length($username, ['min' => self::$column['username']['min_length'], 'max' => self::$column['username']['max_length']]) && Validate::username($username))
    {
      $this->username = $username;
    }
  }

  //

  public function setPassword($password) 
  {
    if (Validate::length($password, ['min' => self::$column['password']['min_length'], 'max' => self::$column['password']['max_length']]) && Validate::password($password))
    {
      $this->password = $password;
    }
  }

  //

  public function setAdmin($admin) 
  {
    if (Validate::isBoolean($admin))
    {
      $this->admin = $admin;
    }
  }

  //

  public function setEnabled($enabled) 
  {
    if (Validate::isBoolean($enabled))
    {
      $this->enabled = $enabled;
    }
  }
}
