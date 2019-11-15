<?php

//

namespace openconsult\content\item;

//

use openconsult\tools\Validate;
use openconsult\tools\Sanitize;
use openconsult\account\user\User;
use openconsult\content\group\Category;
use openconsult\content\tag\category\Blog as BlogCategory;
use openconsult\content\tag\favorite\Blog as BlogFavorite;
use openconsult\content\total\Blog as BlogTotal;

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
  protected $category;
  protected $total;
  protected $favorite;
  protected $related;

  // columns

  public static $column = [
    'id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false, 'search' => false],
    'title' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => true, 'min_length' => 2, 'max_length' => 200, 'search' => true],
    'title_short' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 100, 'search' => false],
    'title_url' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'min_length' => 2, 'max_length' => 200, 'search' => false],
    'description' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => true],
    'description_short' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'canonical_url' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'image' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'consultant_id' => ['key' => false, 'index' => true, 'allowed' => true, 'order_by' => false, 'search' => false],
    'account_id' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false, 'search' => false, 'filter' => true],
    'category_id' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => false, 'search' => false, 'filter' => true],
    'featured' => ['key' => false, 'index' => false, 'allowed' => true, 'order_by' => false, 'search' => false],
    'created_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true, 'search' => false],
    'updated_date' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true, 'search' => false]
  ];

  // constants

  public const TABLE_NAME = 'blog';

  // constructor

  public function __construct($column = [])
  {
    if (!empty($this->id))
    {
      $this->setCategory($this->getCategory());
      $this->setTotal($this->getTotal());
      $this->setFavorite($this->getFavorite());
    }
    else
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

      if (isset($column['consultant_id']))
      {
        $this->setConsultantId($column['consultant_id']);
      }

      //

      if (isset($column['featured']))
      {
        $this->setFeatured($column['featured']);
      }

      //

      if (isset($column['category']))
      {
        $this->setCategory($column['category']);
      }

      //

      if (isset($column['total']))
      {
        $this->setTotal($column['total']);
      }

      //

      if (isset($column['favorite']))
      {
        $this->setFavorite($column['favorite']);
      }

      //

      if (isset($column['related']))
      {
        $this->setRelated($column['related']);
      }
    }
  }

  // getters

  public function getId() 
  {
    return filter_var($this->id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTitle() 
  {
    return filter_var($this->title, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getTitleShort() 
  {
    return filter_var($this->title_short, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getTitleUrl() 
  {
    return filter_var($this->title_url, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //

  public function getDescription() 
  {
    return $this->description;
  }

  //

  public function getDescriptionShort() 
  {
    return $this->description_short;
  }

  //

  public function getCanonicalUrl() 
  {
    return $this->canonical_url;
  }

  //

  public function getConsultantId() 
  {
    return $this->consultant_id;
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

  //

  public function getCategory()
  {
    return Category::getList(["blog_id" => $this->id], BlogCategory::$column, "category INNER JOIN blog_category ON category.id = blog_category.category_id");
  }

  //

  public function getTotal()
  {
    return BlogTotal::getObject(["blog_id" => $this->id]);
  }

  //

  public function getFavorite()
  {
    return User::getList(["blog_id" => $this->id], BlogFavorite::$column, "account INNER JOIN blog_favorite ON account.id = blog_favorite.account_id");
  }

  //

  public function getRelated()
  {
    return Blog::getList(["blog_id" => $this->id], BlogCategory::$column, "blog INNER JOIN blog_category ON account.id = blog_favorite.account_id GROUP BY blog.id");
  }

  // setters

  public function setId($id) 
  {
    if (Validate::validateId($id))
    {
      $this->id = $id;
    }
  }

  //

  public function setTitle($title) 
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

  public function setConsultantId($consultant_id) 
  {
    if (Validate::validateBoolean($enabled))
    {
      $this->consultant_id = $consultant_id;
    }
  }

  //

  public function setFeatured($featured) 
  {
    if (Validate::validateBoolean($featured))
    {
      $this->featured = $featured;
    }
  }

  //

  public function setCategory($category) 
  {
    $this->category = $category;
  }

  //

  public function setTotal($total) 
  {
    $this->total = $total;
  }

  //

  public function setFavorite($favorite) 
  {
    $this->favorite = $favorite;
  }

  //

  public function setRelated($related) 
  {
    $this->related = $related;
  }
}
