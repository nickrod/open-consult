<?php

//

namespace nickrod\openconsult\content\group;

//

use nickrod\openconsult\base\Table;
use nickrod\openconsult\tools\Validate;
use nickrod\openconsult\tools\Sanitize;

//

class Location extends Table
{
  // variables

  protected $id;
  protected $geoname_id;
  protected $title;
  protected $title_url;
  protected $page_title;
  protected $page_description;
  protected $page_header;
  protected $featured;
  protected $created_date;
  protected $updated_date;

  // columns

  public static $column = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'geoname_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'min_length' => 2, 'max_length' => 200],
    'title_url' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'max_display' => 80],
    'page_title' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_description' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_header' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'location';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['geoname_id']))
    {
      $this->setGeonameId($column['geoname_id']);
    }

    //

    if (isset($column['title']))
    {
      $this->setTitle($column['title']);
    }

    //

    if (isset($column['page_title']))
    {
      $this->setPageTitle($column['page_title']);
    }

    //

    if (isset($column['page_description']))
    {
      $this->setPageDescription($column['page_description']);
    }

    //

    if (isset($column['page_header']))
    {
      $this->setPageHeader($column['page_header']);
    }

    //

    if (isset($column['featured']))
    {
      $this->setFeatured($column['featured']);
    }
  }

  // getters

  public function getId() 
  {
    return filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getGeonameId() 
  {
    return filter_var($this->geoname_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTitle() 
  {
    return filter_var($this->title, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getTitleUrl() 
  {
    return Sanitize::length($this->title_url, self::$column['title_url']['max_display']);
  }

  //

  public function getPageTitle() 
  {
    return filter_var(Sanitize::length($this->page_title, self::$column['page_title']['max_display']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getPageDescription() 
  {
    return filter_var(Sanitize::length($this->page_description, self::$column['page_description']['max_display']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getPageHeader() 
  {
    return filter_var(Sanitize::length($this->page_header, self::$column['page_header']['max_display']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getFeatured() 
  {
    return $this->featured;
  }

  //

  public function getCreatedDate() 
  {
    return $this->created_date;
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

  public function setGeonameId($geoname_id) 
  {
    if (Validate::id($geoname_id))
    {
      $this->geoname_id = $geoname_id;
    }
  }

  //

  public function setTitle($title) 
  {
    if (Validate::length($title, ['min' => self::$column['title']['min_length'], 'max' => self::$column['title']['max_length']]))
    {
      $this->title = $title;
      $this->setTitleUrl($title);
    }
  }

  //

  private function setTitleUrl($title_url) 
  {
    if (Validate::length($title_url, ['min' => self::$column['title_url']['min_length'], 'max' => self::$column['title_url']['max_length']]) && $title_url = Sanitize::url($title_url))
    {
      $this->title_url = $title_url;
    }
  }

  //

  public function setPageTitle($page_title) 
  {
    if (Validate::length($page_title, ['min' => self::$column['page_title']['min_length'], 'max' => self::$column['page_title']['max_length']]))
    {
      $this->page_title = $page_title;
    }
  }

  //

  public function setPageDescription($page_description) 
  {
    if (Validate::length($page_description, ['min' => self::$column['page_description']['min_length'], 'max' => self::$column['page_description']['max_length']]))
    {
      $this->page_description = $page_description;
    }
  }

  //

  public function setPageHeader($page_header) 
  {
    if (Validate::length($page_header, ['min' => self::$column['page_header']['min_length'], 'max' => self::$column['page_header']['max_length']]))
    {
      $this->page_header = $page_header;
    }
  }

  //

  public function setFeatured($featured) 
  {
    if (Validate::isBoolean($featured))
    {
      $this->featured = $featured;
    }
  }
}
