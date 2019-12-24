<?php

//

declare(strict_types=1);

//

namespace openconsult\base;

//

use openconsult\config\Config;
use openconsult\tools\Sanitize;

//

class Table implements TableInterface
{
  // save

  public function save(): void
  {
    $pdo = Config::getInstance()->getPdo();
    $column_value = get_object_vars($this);
    $column_type = ['allowed'];
    $column_key = Sanitize::column($column_type, $this::COLUMN, $column_value);

    //

    if (isset($column_key['allowed_keys']) && isset($column_key['allowed_values']))
    {
      $statement = $pdo->prepare('INSERT INTO ' . $this::TABLE . ' (' . $column_key['allowed_keys'] . ') VALUES (' . $column_key['allowed_values'] . ')');
      $statement->execute($column_value);

      // get last inserted id for auto increment

      if (property_exists($this, 'id'))
      {
        $this->setId((int) $pdo->lastInsertId($this::TABLE . '_id_seq'));
      }
    }
  }

  // edit

  public function edit(): void
  {
    $pdo = Config::getInstance()->getPdo();
    $column_value = get_object_vars($this);
    $column_type = ['key', 'allowed'];
    $column_key = Sanitize::column($column_type, $this::COLUMN, $column_value);

    //

    if (isset($column_key['key']) && isset($column_key['allowed']))
    {
      $statement = $pdo->prepare('UPDATE ' . $this::TABLE . ' SET ' . $column_key['allowed'] . ' WHERE ' . $column_key['key']);
      $statement->execute($column_value);
    }
  }

  // remove

  public function remove(): void
  {
    $pdo = Config::getInstance()->getPdo();
    $column_value = get_object_vars($this);
    $column_type = ['key'];
    $column_key = Sanitize::column($column_type, $this::COLUMN, $column_value);

    //

    if (isset($column_key['key']))
    {
      $statement = $pdo->prepare('DELETE FROM ' . $this::TABLE . ' WHERE ' . $column_key['key']);
      $statement->execute($column_value);
    }
  }

  // get object

  public static function getObject(array $option = []): object
  {
    $pdo = Config::getInstance()->getPdo();
    $column = (isset($option['column'])) ? $option['column'] : static::class::COLUMN;
    $from = (isset($option['from'])) ? $option['from'] : static::class::TABLE;
    $column_type = $column_value = $column_key = [];

    //

    if (isset($option['key']))
    {
      $column_type[] = 'key';
      $column_value += $option['key'];
    }

    //

    if ($column_value)
    {
      $column_key = Sanitize::column($column_type, $column, $column_value);
    }

    //

    if (isset($column_key['key']))
    {
      $statement = $pdo->prepare('SELECT ' . static::class::TABLE . '.*' . ' FROM ' . $from . ' WHERE ' . $column_key['key']);
      $statement->execute($column_value);

      //

      return $statement->fetchObject(static::class);
    }
    else
    {
      return null;
    }
  }

  // get list of objects

  public static function getList(array $option = []): array
  {
    $pdo = Config::getInstance()->getPdo();
    $column = (isset($option['column'])) ? $option['column'] : static::class::COLUMN;
    $from = (isset($option['from'])) ? $option['from'] : static::class::TABLE;
    $limit = (isset($option['limit'])) ? (int) $option['limit'] : 100;
    $offset = (isset($option['offset'])) ? (int) $option['offset'] : 0;
    $column_type = $column_value = $column_key = [];

    //

    if (isset($option['key']))
    {
      $column_type[] = 'key';
      $column_value += $option['key'];
    }

    //

    if (isset($option['search']))
    {
      $column_type[] = 'search';
      $column_value += $option['search'];
    }

    //

    if (isset($option['filter']))
    {
      $column_type[] = 'filter';
      $column_value += $option['filter'];
    }

    //

    if (isset($option['order_by']))
    {
      $column_type[] = 'order_by';
      $column_value += $option['order_by'];
    }

    //

    if ($column_value)
    {
      $column_key = Sanitize::column($column_type, $column, $column_value);
    }

    //

    $key = $search = $filter = $order_by = '';
    $key = (isset($column_key['key'])) ? ' AND ' . $column_key['key'] : '';
    $search = (isset($column_key['search'])) ? ' AND (' . $column_key['search'] . ')' : '';
    $filter = (isset($column_key['filter'])) ? ' AND ' . $column_key['filter'] : '';
    $order_by = (isset($column_key['order_by'])) ? ' ORDER BY ' . $column_key['order_by'] : '';
    $statement = null;

    //

    if ($key || $search || $filter)
    {
      $statement = $pdo->prepare('SELECT ' . static::class::TABLE . '.*' . ' FROM ' . $from . ' WHERE ' . $key . $search . $filter . $order_by . ' LIMIT ' . $limit . ' OFFSET ' . $offset);
      $statement->execute($column_value);
    }
    else
    {
      $statement = $pdo->query('SELECT ' . static::class::TABLE . '.*' . ' FROM ' . $from . $order_by . ' LIMIT ' . $limit . ' OFFSET ' . $offset);
    }

    //

    return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
  }

  // save a list of objects

  public static function saveList(array $table): void
  {
    foreach ($table as $key => $value)
    {
      if (!is_object($value))
      {
        throw new \InvalidArgumentException('Object is required: ' . $value);
      }
      elseif (!$value instanceof self)
      {
        throw new \InvalidArgumentException('Object instance is invalid: ' . get_class($value));
      }
      else
      {
        $value->save();
      }
    }
  }

  // remove a list of objects

  public static function removeList(array $table): void
  {
    foreach ($table as $key => $value)
    {
      if (!is_object($value))
      {
        throw new \InvalidArgumentException('Object is required: ' . $value);
      }
      elseif (!$value instanceof self)
      {
        throw new \InvalidArgumentException('Object instance is invalid: ' . get_class($value));
      }
      else
      {
        $value->remove();
      }
    }
  }

  // check if item exists

  public static function exists(array $option = []): bool
  {
    $pdo = Config::getInstance()->getPdo();
    $column = (isset($option['column'])) ? $option['column'] : static::class::COLUMN;
    $from = (isset($option['from'])) ? $option['from'] : static::class::TABLE;
    $column_type = $column_value = $column_key = [];

    //

    if (isset($option['key']))
    {
      $column_type[] = 'key';
      $column_value += $option['key'];
    }

    //

    if ($column_value)
    {
      $column_key = Sanitize::column($column_type, $column, $column_value);
    }

    //

    if (isset($column_key['key']))
    {
      $statement = $pdo->prepare('SELECT 1 FROM ' . $from . ' WHERE ' . $column_key['key']);
      $statement->execute($column_value);

      //

      return (bool) $statement->fetchColumn();
    }
    else
    {
      return false;
    }
  }

  // total count

  public static function total(array $option = []): int
  {
    $pdo = Config::getInstance()->getPdo();
    $column = (isset($option['column'])) ? $option['column'] : static::class::COLUMN;
    $from = (isset($option['from'])) ? $option['from'] : static::class::TABLE;
    $column_type = $column_value = $column_key = [];

    //

    if (isset($option['key']))
    {
      $column_type[] = 'key';
      $column_value += $option['key'];
    }

    //

    if (isset($option['search']))
    {
      $column_type[] = 'search';
      $column_value += $option['search'];
    }

    //

    if (isset($option['filter']))
    {
      $column_type[] = 'filter';
      $column_value += $option['filter'];
    }

    //

    if ($column_value)
    {
      $column_key = Sanitize::column($column_type, $column, $column_value);
    }

    //

    if (isset($column_key['key']))
    {
      $search = $filter = '';
      $search = (isset($column_key['search'])) ? ' AND (' . $column_key['search'] . ')' : '';
      $filter = (isset($column_key['filter'])) ? ' AND ' . $column_key['filter'] : '';

      //

      $statement = $pdo->prepare('SELECT COUNT(*) AS total FROM ' . $from . ' WHERE ' . $column_key['key'] . $search . $filter);
      $statement->execute($column_value);

      //

      return (int) $statement->fetchColumn();
    }
    else
    {
      return 0;
    }
  }
}
