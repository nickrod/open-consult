<?php

//

namespace nickrod\openconsult\tools;

//

use nickrod\openconsult\exceptions\OpenconsultException;

//

class Validate
{
  public static function id($id)
  {
    if (empty($id))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_int($id))
    {
      throw new OpenconsultException(3, __METHOD__);
    }
    elseif (!filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100000000]]))
    {
      throw new OpenconsultException(7, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function length($str, $range = ['min' => 1, 'max' => 1000])
  {
    if (empty($str) || empty($range))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($str))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!is_array($range))
    {
      throw new OpenconsultException(4, __METHOD__);
    }
    elseif (!isset($range['min']) || !isset($range['max']))
    {
      throw new OpenconsultException(15, __METHOD__);
    }
    elseif (!is_int($range['min']) || !is_int($range['max']))
    {
      throw new OpenconsultException(3, __METHOD__);
    }
    else
    {
      $length = mb_strlen($str);

      //

      if (!filter_var($length, FILTER_VALIDATE_INT, ['options' => ['min_range' => $range['min'], 'max_range' => $range['max']]]))
      {
        throw new OpenconsultException(7, __METHOD__);
      }
      else
      {
        return true;
      }
    }
  }

  //

  public static function limit($limit)
  {
    if (empty($limit))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_int($limit))
    {
      throw new OpenconsultException(3, __METHOD__);
    }
    elseif (!filter_var($limit, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 200]]))
    {
      throw new OpenconsultException(7, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function offset($offset)
  {
    if (empty($offset))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_int($offset))
    {
      throw new OpenconsultException(3, __METHOD__);
    }
    elseif (!filter_var($offset, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100000000]]))
    {
      throw new OpenconsultException(7, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function email($email)
  {
    if (empty($email))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($email))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      throw new OpenconsultException(8, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function username($username)
  {
    if (empty($username))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($username))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!filter_var($username, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/[a-z0-9]+/']]))
    {
      throw new OpenconsultException(9, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function symbol($symbol)
  {
    if (empty($symbol))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($symbol))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!filter_var($symbol, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/(&#[0-9]+;)+/']]))
    {
      throw new OpenconsultException(11, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function password($password)
  {
    if (empty($password))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($password))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!filter_var($password, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/.+/']]))
    {
      throw new OpenconsultException(10, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function search($search)
  {
    if (empty($search))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($search))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function orderBy($order_by)
  {
    if (empty($order_by))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($order_by))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif ($order_by != 'ASC' || $order_by != 'DESC')
    {
      throw new OpenconsultException(1, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function filter($filter)
  {
    if (empty($filter))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_array($filter))
    {
      throw new OpenconsultException(4, __METHOD__);
    }
    else
    {
      foreach ($filter as $key)
      {
        if (!is_int($key))
        {
          throw new OpenconsultException(3, __METHOD__);
        }
        elseif (!filter_var($key, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100000000]]))
        {
          throw new OpenconsultException(7, __METHOD__);
        }
        else
        {
          return true;
        }
      }
    }
  }

  //

  public static function isBoolean($boolean)
  {
    if (empty($boolean))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($boolean))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!filter_var($boolean, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/[tf]{1}/']]))
    {
      throw new OpenconsultException(12, __METHOD__);
    }
    else
    {
      return true;
    }
  }

  //

  public static function column($type, $column, $class_column)
  {
    if (empty($type) || empty($column) || empty($class_column))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($type))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!is_array($column) || !is_array($class_column))
    {
      throw new OpenconsultException(4, __METHOD__);
    }
    elseif ($type != 'order_by' || $type != 'allowed' || $type != 'index' || $type != 'search' || $type != 'key' || $type == 'filter')
    {
      throw new OpenconsultException(2, __METHOD__);
    }
    else
    {
      foreach ($class_column as $key)
      {
        if (!in_array($key, array_keys($column)))
        {
          throw new OpenconsultException(25, __METHOD__);
        }
        elseif (!isset($column[$key]))
        {
          throw new OpenconsultException(15, __METHOD__);
        }
        elseif (!$column[$key][$type])
        {
          throw new OpenconsultException(2, __METHOD__);
        }
        else
        {
          continue;
        }
      }

      //

      return true;
    }
  }
}
