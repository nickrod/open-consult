<?php

//

namespace nickrod\openconsult\base;

//

use nickrod\openconsult\config\Config;
use nickrod\openconsult\tools\Validate;
use nickrod\openconsult\tools\Sanitize;
use nickrod\openconsult\exceptions\OpenconsultException;

//

class Table implements TableInterface
{
  // save

  public function save()
  {
    $pdo = Config::getInstance()->getPdo();
    $vars = Sanitize::nullify(get_object_vars($this));
    $table_name = $this::TABLE_NAME;

    //

    if (empty($pdo))
    {
      throw new OpenconsultException(13, __METHOD__);
    }
    elseif (!Validate::column('allowed', $this::$column, array_keys($vars)))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $statement = $pdo->prepare("INSERT INTO $table_name (" . implode(", ", array_keys($vars)) . ") VALUES (:" . implode(", :", array_keys($vars)) . ")");
      $statement->execute($vars);

      // get last inserted id for auto increment

      if (property_exists($this, 'id'))
      {
        $this->setId((int)$pdo->lastInsertId($table_name . "_id_seq"));
      }
      else
      {
        throw new OpenconsultException(24, __METHOD__);
      }
    }
  }

  // edit

  public function edit()
  {
    $pdo = Config::getInstance()->getPdo();
    $vars = Sanitize::nullify(get_object_vars($this));
    $table_name = $this::TABLE_NAME;
    $keys = '';
    $values = '';

    //

    if (empty($pdo))
    {
      throw new OpenconsultException(13, __METHOD__);
    }
    elseif (!$keys = Sanitize::implode_column(' = :', ', ', 'key', $this::$column, array_keys($vars)))
    {
      throw new OpenconsultException(19, __METHOD__);
    }
    elseif (!$values = Sanitize::implode_column(' = :', ' AND ', 'allowed', $this::$column, array_keys($vars)))
    {
      throw new OpenconsultException(20, __METHOD__);
    }
    else
    {
      $statement = $pdo->prepare("UPDATE $table_name SET $keys WHERE $values");
      $statement->execute($vars);
    }
  }

  // remove

  public function remove()
  {
    $pdo = Config::getInstance()->getPdo();
    $vars = Sanitize::nullify(get_object_vars($this));
    $table_name = $this::TABLE_NAME;
    $keys = '';

    //

    if (empty($pdo))
    {
      throw new OpenconsultException(13, __METHOD__);
    }
    elseif (!$keys = Sanitize::implode_column(' = :', ' AND ', 'key', $this::$column, array_keys($vars)))
    {
      throw new OpenconsultException(19, __METHOD__);
    }
    else
    {
      $statement = $pdo->prepare("DELETE FROM $table_name WHERE $keys");
      $statement->execute($vars);
    }
  }

  // get object

  public static function getObject($column = [], $options = [])
  {
    $pdo = Config::getInstance()->getPdo();
    $class = static::class;
    $table_name = $class::TABLE_NAME;
    $class_column = (!empty($options['class_column']) && is_array($options['class_column'])) ? $options['class_column'] : $class::$column;
    $from = (!empty($options['from']) && is_string($options['from'])) ? $options['from'] : $table_name;
    $keys = '';

    //

    if (empty($pdo))
    {
      throw new OpenconsultException(13, __METHOD__);
    }
    elseif (!$keys = Sanitize::implode_column(' = :', ' AND ', 'key', $class_column, array_keys($column)))
    {
      throw new OpenconsultException(19, __METHOD__);
    }
    else
    {
      $statement = $pdo->prepare("SELECT {$table_name}.* FROM $from WHERE $keys");
      $statement->execute($column);

      //

      return $statement->fetchObject($class);
    }
  }

  // get a list of objects

  //public static function getList($column = [], $class_column = [], $search_column = [], $order_by_column = [], $from = '', $offset = 0, $limit = 60)
  public static function getList($column = [], $options = [])
  {
    $pdo = Config::getInstance()->getPdo();
    $keys = (!empty($column) && is_array($column)) ? array_keys($column) : [];
    $vals = (!empty($column) && is_array($column)) ? array_values($column) : [];
    $class = static::class;
    $class_column = (!empty($class_column) && is_array($class_column)) ? $class_column : $class::$column;
    $table_name = $class::TABLE_NAME;
    $from = (!empty($from) && is_string($from)) ? $from : $table_name;

    //

    if (empty($pdo))
    {
      throw new OpenconsultException(13, __METHOD__);
    }
    elseif (!Validate::column('index', $class_column, $keys))
    {
      throw new OpenconsultException(24, __METHOD__);
    }
    elseif (!Validate::limit($limit))
    {
      throw new OpenconsultException(17, __METHOD__);
    }
    elseif (!Validate::offset($offset))
    {
      throw new OpenconsultException(18, __METHOD__);
    }
    else
    {
      $order = Sanitize::orderBy($class_column, $order_by_column);
      $where = "";
      $statement = "";
      $list = [];

      //

      if (!empty($order))
      {
        $order = "ORDER BY " . $order;
      }

      //

      if (!empty($keys))
      {
        $where = "WHERE " . implode(" = ? AND ", $keys) . " = ?";
        $statement = $pdo->prepare("SELECT {$table_name}.* FROM $from $where $order LIMIT $limit OFFSET $offset");
        $statement->execute($vals);
      }
      else
      {
        $statement = $pdo->query("SELECT {$table_name}.* FROM $from $order LIMIT $limit OFFSET $offset");
      }

      //

      while ($row = $statement->fetchObject($class))
      {
        $list[] = $row;
      }

      //

      return $list;
    }
  }

  // save a list of objects

  public static function saveList($table)
  {
    if (empty($table))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_array($table))
    {
      throw new OpenconsultException(4, __METHOD__);
    }
    else
    {
      foreach ($table as $key => $value)
      {
        if ($value instanceof Table)
        {
          $value->save();
        }
        else
        {
          throw new OpenconsultException(6, __METHOD__);
        }
      }
    }
  }

  // remove a list of objects

  public static function removeList($table)
  {
    if (empty($table))
    {
      throw new OpenconsultException(14, __METHOD__);
    }
    elseif (!is_array($table))
    {
      throw new OpenconsultException(4, __METHOD__);
    }
    else
    {
      foreach ($table as $key => $value)
      {
        if ($value instanceof Table)
        {
          $value->remove();
        }
        else
        {
          throw new OpenconsultException(6, __METHOD__);
        }
      }
    }
  }

  // check if exists

  public static function exists($column = [], $options = [])
  {
    $pdo = Config::getInstance()->getPdo();
    $class = static::class;
    $table_name = $class::TABLE_NAME;
    $class_column = (!empty($options['class_column']) && is_array($options['class_column'])) ? $options['class_column'] : $class::$column;
    $from = (!empty($options['from']) && is_string($options['from'])) ? $options['from'] : $table_name;
    $keys = '';

    //

    if (empty($pdo))
    {
      throw new OpenconsultException(13, __METHOD__);
    }
    elseif (!$keys = Sanitize::implode_column(' = :', ' AND ', 'key', $class_column, array_keys($column)))
    {
      throw new OpenconsultException(19, __METHOD__);
    }
    else
    {
      $statement = $pdo->prepare("SELECT 1 FROM $from WHERE $keys");
      $statement->execute($column);

      //

      return $statement->fetchColumn();
    }
  }

  // total count

  public static function total($column = [], $options = [])
  {
    $pdo = Config::getInstance()->getPdo();
    $class = static::class;
    $table_name = $class::TABLE_NAME;
    $class_column = (!empty($options['class_column']) && is_array($options['class_column'])) ? $options['class_column'] : $class::$column;
    $filter_str = (!empty($options['filter']) && is_array($options['filter'])) ? '(' . implode(',', Validate::filter($options['filter'])) . ')' : '';
    $from = (!empty($options['from']) && is_string($options['from'])) ? $options['from'] : $table_name;
    $keys = '';
    $search = '';
    $filter = '';

    //

    if (empty($pdo))
    {
      throw new OpenconsultException(13, __METHOD__);
    }
    elseif (!$keys = Sanitize::implode_column(' = :', ' AND ', 'key', $class_column, array_keys($column)))
    {
      throw new OpenconsultException(19, __METHOD__);
    }
    elseif (!$search = Sanitize::implode_column(' = :', ' OR ', 'search', $class_column, array_keys($column)))
    {
      throw new OpenconsultException(22, __METHOD__);
    }
    elseif (!$filter = Sanitize::implode_column('', $filter_str, 'filter', $class_column, array_keys($column)))
    {
      throw new OpenconsultException(21, __METHOD__);
    }
    else
    {
      if (!empty($search))
      {
        $search = ' AND (' . $search . ')';
      }

      //

      if (!empty($filter))
      {
        $filter = ' AND (' . $filter . ')';
      }

      //

      $statement = $pdo->prepare("SELECT COUNT(*) AS total FROM $from WHERE " . $keys . ((!empty($search)) ? (' AND (' . $search . ')') : ''));
      $statement->execute($column);

      //

      return $statement->fetchColumn();
    }
  }
}
