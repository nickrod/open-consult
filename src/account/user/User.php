<?php

//

declare(strict_types=1);

//

namespace openconsult\account\user;

//

use openconsult\base\Table;
use openconsult\exceptions\OpenConsultException;
use openconsult\tools\Validate;

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

  public function __construct(array $column = [])
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

  public function getId(): int 
  {
    return filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getEmail(): string 
  {
    return filter_var($this->email, FILTER_SANITIZE_EMAIL);
  }

  //

  public function getNickname(): string 
  {
    return filter_var($this->nickname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getUsername(): string 
  {
    return filter_var($this->username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getPassword(): string 
  {
    return $this->password;
  }

  //

  public function getAdmin(): bool 
  {
    return $this->admin === 't';
  }

  //

  public function getEnabled(): bool 
  {
    return $this->enabled;
  }

  //

  public function getUpdatedDate(): string 
  {
    return $this->updated_date;
  }

  // setters

  public function setId(int $id): void 
  {
    if (Validate::id($id))
    {
      $this->id = $id;
    }
  }

  //

  public function setEmail($email): void 
  {
    if (Validate::length($email, ['min' => self::$column['email']['min_length'], 'max' => self::$column['email']['max_length']]) && Validate::email($email))
    {
      $this->email = $email;
    }
  }

  //

  public function setNickname($nickname): void 
  {
    if (Validate::length($nickname, ['min' => self::$column['nickname']['min_length'], 'max' => self::$column['nickname']['max_length']]))
    {
      $this->nickname = $nickname;
    }
  }

  //

  public function setUsername($username): void 
  {
    if (Validate::length($username, ['min' => self::$column['username']['min_length'], 'max' => self::$column['username']['max_length']]) && Validate::username($username))
    {
      $this->username = $username;
    }
  }

  //

  public function setPassword($password): void 
  {
    if (Validate::length($password, ['min' => self::$column['password']['min_length'], 'max' => self::$column['password']['max_length']]) && Validate::password($password))
    {
      $this->password = $password;
    }
  }

  //

  public function setAdmin(bool $admin): void 
  {
    $this->admin = ($admin ? 't' : 'f');
  }

  //

  public function setEnabled($enabled): void 
  {
    if (Validate::isBoolean($enabled))
    {
      $this->enabled = $enabled;
    }
  }
}
