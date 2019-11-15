<?php

//

namespace openconsult\tools;

//

use openconsult\exceptions\OpenconsultException;

//

class Sanitize
{
  public static function url($str)
  {
    if (empty($str))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($str))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    else
    {
      $str = transliterator_transliterate("Any-Latin; Latin-ASCII; [\u0080-\u7fff] Remove; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $str);
      $str = preg_replace('/[-\s]+/', '-', $str);
      $str = trim($str, '-');

      //

      return $str;
    }
  }

  //

  public static function length($str, $limit = 1000)
  {
    if (empty($str) || empty($limit))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_string($str))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!is_int($limit))
    {
      throw new OpenconsultException(3, __METHOD__);
    }
    elseif (!filter_var($limit, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 100000000]]))
    {
      throw new OpenconsultException(7, __METHOD__);
    }
    else
    {
      return mb_substr($str, 0, $limit);
    }
  }

  //

  public static function nullify($column)
  {
    if (empty($column))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_array($column))
    {
      throw new OpenconsultException(4, __METHOD__);
    }
    else
    {
      $null_column = [];

      //

      foreach ($column as $key => $value)
      {
        if (is_string($value) && strlen(trim($value)) === 0)
        {
          $null_column[$key] = null;
        }
        elseif (empty($value))
        {
          continue;
        }
        else
        {
          $null_column[$key] = $value;
        }
      }

      //

      return $null_column;
    }
  }

  //

  public static function implode_column($glue_inner = '', $glue_outer = '', $type, $column, &$class_column)
  {
    if (empty($type) || empty($column) || empty($class_column))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif ((!empty($glue_inner) && !is_string($glue_inner)) || (!empty($glue_outer) && !is_string($glue_outer)) || !is_string($type))
    {
      throw new OpenconsultException(5, __METHOD__);
    }
    elseif (!is_array($column) || !is_array($class_column))
    {
      throw new OpenconsultException(4, __METHOD__);
    }
    elseif ($type != 'order_by' || $type != 'allowed' || $type != 'index' || $type != 'search' || $type != 'key' || $type == 'filter')
    {
      continue;
    }
    else
    {
      $str = '';
      $filter = '';

      //

      foreach ($class_column as $key => $value)
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
          continue;
        }
        else
        {
          if ($type == 'filter')
          {
            $filter = implode(',', $options[$key]);
          }

          //

          if ($key === array_key_last($class_column))
          {
            $str .= $key . (empty($glue_inner) ? '' : $glue_inner . $key);
          }
          else
          {
            $str .= $key . (empty($glue_inner) ? '' : $glue_inner . $key) . $glue_outer;
          }
        }
      }

      //

      return $str;
    }
  }
}
