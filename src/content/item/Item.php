<?php

//

namespace nickrod\openconsult\content\item;

//

use nickrod\openconsult\exceptions\OpenconsultException;
use nickrod\openconsult\base\Table;

//

class Item extends Table implements ItemInterface
{
  // variables

  protected $consultant_title;
  protected $consultant_url;
  protected $image_thumb;
  protected $username;
  protected $chat_online;

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

  // add category

  public function addCategory()
  {
    if (empty($this->category))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->category);
    }
  }

  // add location

  public function addLocation()
  {
    if (empty($this->location))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->location);
    }
  }

  // add currency

  public function addCurrency()
  {
    if (empty($this->currency))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->currency);
    }
  }

  // add favorite

  public function addFavorite()
  {
    if (empty($this->favorite))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $this->saveList($this->favorite);
    }
  }

  // remove category

  public function removeCategory()
  {
    if (empty($this->category))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $this->removeList($this->category);
    }
  }

  // remove location

  public function removeLocation()
  {
    if (empty($this->location))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $this->removeList($this->location);
    }
  }

  // remove currency

  public function removeCurrency()
  {
    if (empty($this->currency))
    {
      throw new OpenconsultException(16, __METHOD__);
    }
    else
    {
      $this->removeList($this->currency);
    }
  }

  // remove favorite

  public function removeFavorite()
  {
    if (empty($this->favorite))
    {
      throw new OpenconsultException(16, __METHOD__);
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
