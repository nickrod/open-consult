<?php

//

namespace nickrod\openconsult\content\group;

//

use nickrod\openconsult\base\Table;
use nickrod\openconsult\tools\Validate;
use nickrod\openconsult\tools\Sanitize;

//

class Currency extends Table
{
  // variables

  protected $id;
  protected $code;
  protected $title;
  protected $title_url;
  protected $title_unit;
  protected $page_title;
  protected $page_description;
  protected $page_header;
  protected $featured;
  protected $crypto;
  protected $symbol;
  protected $symbol_unit;
  protected $multiplier_unit;
  protected $created_date;
  protected $updated_date;

  // columns

  public static $column = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'code' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 6],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 200],
    'title_url' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'max_display' => 80],
    'title_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 100],
    'page_title' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_description' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_header' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'crypto' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'symbol' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 60],
    'symbol_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 60],
    'multiplier_unit' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 1, 'max_length' => 100000000],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'currency';

  // constructor

  public function __construct($column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['code']))
    {
      $this->setCode($column['code']);
    }

    //

    if (isset($column['title']))
    {
      $this->setTitle($column['title']);
    }

    //

    if (isset($column['title_unit']))
    {
      $this->setTitleUnit($column['title_unit']);
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

    //

    if (isset($column['crypto']))
    {
      $this->setCrypto($column['crypto']);
    }

    //

    if (isset($column['symbol']))
    {
      $this->setSymbol($column['symbol']);
    }

    //

    if (isset($column['symbol_unit']))
    {
      $this->setSymbolUnit($column['symbol_unit']);
    }

    //

    if (isset($column['multiplier_unit']))
    {
      $this->setMultiplierUnit($column['multiplier_unit']);
    }
  }

  // getters

  public function getId() 
  {
    return filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getCode() 
  {
    return filter_var($this->code, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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

  public function getTitleUnit() 
  {
    return filter_var($this->title_unit, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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

  public function getCrypto() 
  {
    return $this->crypto;
  }

  //

  public function getSymbol() 
  {
    return $this->symbol;
  }

  //

  public function getSymbolUnit() 
  {
    return $this->symbol_unit;
  }

  //

  public function getMultiplierUnit() 
  {
    return $this->multiplier_unit;
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

  public function setCode($code) 
  {
    if (Validate::length($code, ['min' => self::$column['code']['min_length'], 'max' => self::$column['code']['max_length']]))
    {
      $this->code = $code;
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

  private function setTitleUnit($title_unit) 
  {
    if (Validate::length($title_unit, ['min' => self::$column['title_unit']['min_length'], 'max' => self::$column['title_unit']['max_length']]))
    {
      $this->title_unit = $title_unit;
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

  //

  public function setCrypto($crypto) 
  {
    if (Validate::isBoolean($crypto))
    {
      $this->crypto = $crypto;
    }
  }

  //

  public function setSymbol($symbol) 
  {
    if (Validate::length($symbol, ['min' => self::$column['symbol']['min_length'], 'max' => self::$column['symbol']['max_length']]) && Validate::symbol($symbol))
    {
      $this->symbol = $symbol;
    }
  }

  //

  public function setSymbolUnit($symbol_unit) 
  {
    if (Validate::length($symbol_unit, ['min' => self::$column['symbol_unit']['min_length'], 'max' => self::$column['symbol_unit']['max_length']]) && Validate::symbol($symbol_unit))
    {
      $this->symbol_unit = $symbol_unit;
    }
  }

  //

  public function setMultiplierUnit($multiplier_unit) 
  {
    if (Validate::length($multiplier_unit, ['min' => self::$column['multiplier_unit']['min_length'], 'max' => self::$column['multiplier_unit']['max_length']]))
    {
      $this->multiplier_unit = $multiplier_unit;
    }
  }
}
