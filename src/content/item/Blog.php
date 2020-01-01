<?php

//

declare(strict_types=1);

//

namespace openconsult\content\item;

//

use openconsult\tools\Validate;
use openconsult\tools\Sanitize;
use openconsult\account\Account;
use openconsult\content\group\Category;

//

class Blog extends Item
{
  // variables

  protected $id;
  protected $title;
  protected $title_short;
  protected $title_url;
  protected $description;
  protected $description_short;
  protected $canonical_url;
  protected $image;
  protected $consultant_id;
  protected $featured;
  protected $created_date;
  protected $updated_date;

  // constants

  public const TABLE = 'blog';
  public const CATEGORY = 'openconsult\content\tag\category\Blog';
  public const FAVORITE = 'openconsult\content\tag\favorite\Blog';
  public const TOTAL = 'openconsult\content\total\Blog';

  //

  public const COLUMN = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false, 'search' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'min_length' => 2, 'max_length' => 200, 'search' => true],
    'title_short' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 100, 'search' => false],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => false, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'search' => false],
    'description' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => true],
    'description_short' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'canonical_url' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'image' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'consultant_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'search' => false],
    'featured' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'search' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true, 'search' => false],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true, 'search' => false],
    'category_id' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false, 'search' => false, 'filter' => true, 'filter_join' => self::CATEGORY::TABLE]
  ];

  // constructor

  public function __construct(array $column = [])
  {
    if (isset($column['id']))
    {
      $this->setId($column['id']);
    }

    //

    if (isset($column['title']))
    {
      $this->setTitle($column['title']);
    }

    //

    if (isset($column['title_short']))
    {
      $this->setTitleShort($column['title_short']);
    }

    //

    if (isset($column['description']))
    {
      $this->setDescription($column['description']);
    }

    //

    if (isset($column['description_short']))
    {
      $this->setDescriptionShort($column['description_short']);
    }

    //

    if (isset($column['canonical_url']))
    {
      $this->setCanonicalUrl($column['canonical_url']);
    }

    //

    if (isset($column['image']))
    {
      $this->setImage($column['image']);
    }

    //

    if (isset($column['consultant_id']))
    {
      $this->setConsultantId($column['consultant_id']);
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

  public function getTitle(): string 
  {
    return Sanitize::noHTML($this->title);
  }

  //

  public function getTitleShort(): string 
  {
    return Sanitize::noHTML($this->title_short);
  }

  //

  public function getTitleUrl(): string 
  {
    return filter_var($this->title_url, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getDescription(): string 
  {
    return Sanitize::noHTML($this->description);
  }

  //

  public function getDescriptionShort(): string 
  {
    return Sanitize::noHTML($this->description_short);
  }

  //

  public function getCanonicalUrl(): string 
  {
    return $this->canonical_url;
  }

  //

  public function getConsultantId(): int 
  {
    return $this->consultant_id;
  }

  //

  public function getFeatured(): bool 
  {
    return Sanitize::getBoolean($this->featured);
  }

  //

  public function getCreatedDate(): string 
  {
    return Sanitize::noHTML($this->created_date);
  }

  //

  public function getUpdatedDate(): string 
  {
    return Sanitize::noHTML($this->updated_date);
  }

  // setters

  public function setId(int $id): void 
  {
    $this->id = $id;
  }

  //

  public function setTitle(string $title): void 
  {
    if (Validate::validateEmail($email))
    {
      $this->title = $title;
    }
  }

  //

  public function setDescription($description) 
  {
    if (Validate::validatePassword($password))
    {
      $this->description = $description;
    }
  }

  //

  public function setDescriptionShort($description_short) 
  {
    $this->description_short = $description_short;
  }

  //

  public function setCanonicalUrl($canonical_url) 
  {
    if (Validate::validateBoolean($enabled))
    {
      $this->canonical_url = $canonical_url;
    }
  }

  //

  public function setConsultantId(int $consultant_id): void 
  {
    $this->consultant_id = $consultant_id;
  }

  //

  public function setFeatured(bool $featured): void 
  {
    $this->featured = Sanitize::setBoolean($featured);
  }
}
