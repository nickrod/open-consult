<?php

//

declare(strict_types=1);

//

namespace openconsult\content\item;

//

use openconsult\exceptions\OpenConsultException;
use openconsult\base\Table;

//

class Item extends Table implements ItemInterface
{
  // getters

  public function getConsultantTitle() 
  {
    return $this->consultant_title;
  }

  //

  public function getConsultantUrl() 
  {
    return $this->consultant_url;
  }

  //

  public function getImageThumb() 
  {
    return $this->image_thumb;
  }

  //

  public function getUsername() 
  {
    return $this->username;
  }

  //

  public function getChatOnline() 
  {
    return $this->chat_online;
  }

  // add tags

  public function addCategory()
  {
    if (empty($this->category))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->category);
    }
  }

  //

  public function addLocation()
  {
    if (empty($this->location))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->location);
    }
  }

  //

  public function addCurrency()
  {
    if (empty($this->currency))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->currency);
    }
  }

  //

  public function addFavorite()
  {
    if (empty($this->favorite))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->favorite);
    }
  }

  // remove tags

  public function removeCategory()
  {
    if (empty($this->category))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->removeList($this->category);
    }
  }

  //

  public function removeLocation()
  {
    if (empty($this->location))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->removeList($this->location);
    }
  }

  //

  public function removeCurrency()
  {
    if (empty($this->currency))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->removeList($this->currency);
    }
  }

  //

  public function removeFavorite()
  {
    if (empty($this->favorite))
    {
      throw new OpenConsultException(16, __METHOD__);
    }
    else
    {
      $this->removeList($this->favorite);
    }
  }

  // get object

  public static function getItemObject($filter_column)
  {
    $class = static::class;
    return static::class::getObject($class::$filter, "item_view");
  }

  // get list

  public static function getItemList($filter_column)
  {
    $class = static::class;
    return static::class::getList(["blog_id" => $this->id], $class::$filter, "account INNER JOIN blog_favorite ON account.id = blog_favorite.account_id");
    $statement = $pdo->prepare("SELECT {$table_name}.* FROM $from WHERE " . implode(" = ? AND ", $keys) . " = ?");
  }
}
