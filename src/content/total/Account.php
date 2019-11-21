<?php

//

namespace openconsult\content\total;

//

use openconsult\base\Table;

//

class Account extends Table
{
  // variables

  protected $account_id;
  protected $total_blog_favorites;
  protected $total_consultant_favorites;
  protected $total_gig_favorites;
  protected $total_service_favorites;
  protected $total_service_partners;
  protected $total_blogs;
  protected $total_gigs;
  protected $total_services;

  // columns

  public static $column = [
    'account_id' => ['key' => true, 'index' => true, 'allowed' => false, 'order_by' => false],
    'total_blog_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_consultant_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gig_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_service_favorites' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_service_partners' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_blogs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_gigs' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true],
    'total_services' => ['key' => false, 'index' => false, 'allowed' => false, 'order_by' => true]
  ];

  // constants

  public const TABLE_NAME = 'account_total';

  // getters

  public function getAccountId() 
  {
    return filter_var($this->account_id, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalBlogFavorites() 
  {
    return filter_var($this->total_blog_favorites, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalConsultantFavorites() 
  {
    return filter_var($this->total_consultant_favorites, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalGigFavorites() 
  {
    return filter_var($this->total_gig_favorites, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalServiceFavorites() 
  {
    return filter_var($this->total_service_favorites, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalServicePartners() 
  {
    return filter_var($this->total_service_partners, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalBlogs() 
  {
    return filter_var($this->total_blogs, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalGigs() 
  {
    return filter_var($this->total_gigs, FILTER_SANITIZE_NUMBER_INT);
  }

  //

  public function getTotalServices() 
  {
    return filter_var($this->total_services, FILTER_SANITIZE_NUMBER_INT);
  }
}
