<?php

//

declare(strict_types=1);

//

namespace openconsult\content\group;

//

use openconsult\base\Table;
use openconsult\tools\Validate;
use openconsult\tools\Sanitize;

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

  // constants

  public const TABLE = 'location';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'geoname_id' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'min_length' => 2, 'max_length' => 200],
    'title_url' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'max_display' => 80],
    'page_title' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_description' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'page_header' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'min_length' => 0, 'max_length' => 300, 'max_display' => 200],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constructor

  public function __construct(array $column = [])
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

  public function getId(): int 
  {
    return $this->id;
  }

  //

  public function getGeonameId(): int 
  {
    return $this->geoname_id;
  }

  //

  public function getTitle(): string 
  {
    return Sanitize::noHTML($this->title);
  }

  //

  public function getTitleUrl(): string 
  {
    return Sanitize::noHTML(urlencode(Sanitize::length($this->title_url, self::COLUMN['title_url']['max_display'])));
  }

  //

  public function getPageTitle(): string 
  {
    return Sanitize::noHTML(Sanitize::length($this->page_title, self::COLUMN['page_title']['max_display']));
  }

  //

  public function getPageDescription(): string
  {
    return Sanitize::noHTML(Sanitize::length($this->page_description, self::COLUMN['page_description']['max_display']));
  }

  //

  public function getPageHeader(): string 
  {
    return Sanitize::noHTML(Sanitize::length($this->page_header, self::COLUMN['page_header']['max_display']));
  }

  //

  public function getFeatured(): bool 
  {
    return Sanitize::getBoolean($this->featured);
  }

  //

  public function getCreatedDate(): string 
  {
    return $this->created_date;
  }

  //

  public function getUpdatedDate(): string 
  {
    return $this->updated_date;
  }

  // setters

  public function setId(int $id): void 
  {
    if ($id > 0)
    {
      $this->id = $id;
    }
  }

  //

  public function setGeonameId(int $geoname_id): void 
  {
    if ($geoname_id > 0)
    {
      $this->geoname_id = $geoname_id;
    }
  }

  //

  public function setTitle(string $title): void 
  {
    if (Validate::strLength($title, self::COLUMN['title']['min_length'], self::COLUMN['title']['max_length']))
    {
      $this->title = $title;
      $this->setTitleUrl($title);
    }
  }

  //

  private function setTitleUrl(string $title_url): void 
  {
    if (Validate::strLength($title_url, self::COLUMN['title_url']['min_length'], self::COLUMN['title_url']['max_length']))
    {
      $this->title_url = Sanitize::slugify($title_url);
    }
  }

  //

  public function setPageTitle(string $page_title): void 
  {
    if (Validate::strLength($page_title, self::COLUMN['page_title']['min_length'], self::COLUMN['page_title']['max_length']))
    {
      $this->page_title = $page_title;
    }
  }

  //

  public function setPageDescription(string $page_description): void 
  {
    if (Validate::strLength($page_description, self::COLUMN['page_description']['min_length'], self::COLUMN['page_description']['max_length']))
    {
      $this->page_description = $page_description;
    }
  }

  //

  public function setPageHeader(string $page_header): void 
  {
    if (Validate::strLength($page_header, self::COLUMN['page_header']['min_length'], self::COLUMN['page_header']['max_length']))
    {
      $this->page_header = $page_header;
    }
  }

  //

  public function setFeatured(bool $featured): void 
  {
    $this->featured = Sanitize::setBoolean($featured);
  }
}
