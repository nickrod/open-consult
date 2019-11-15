<?php

//

namespace openconsult\content\item;

//

use openconsult\tools\Validate;
use openconsult\tools\Sanitize;
use openconsult\account\user\User;
use openconsult\content\group\Category;
use openconsult\content\group\Location;
use openconsult\content\group\Currency;
use openconsult\content\tag\category\Consultant as ConsultantCategory;
use openconsult\content\tag\location\Consultant as ConsultantLocation;
use openconsult\content\tag\currency\Consultant as ConsultantCurrency;
use openconsult\content\tag\favorite\Consultant as ConsultantFavorite;
use openconsult\content\total\Consultant as ConsultantTotal;

//

class Consultant extends Item
{
  public function getLocation()
  {
    return Location::getList(["consultant_id" => $this->id], ConsultantLocation::$column, "location INNER JOIN consultant_location ON location.id = consultant_location.location_id");
  }

  //

  public function getCurrency()
  {
    return Currency::getList(["consultant_id" => $this->id], ConsultantCurrency::$column, "currency INNER JOIN consultant_currency ON currency.id = consultant_currency.currency_id");
  }
}
