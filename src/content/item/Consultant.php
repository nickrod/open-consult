<?php

//

namespace nickrod\openconsult\content\item;

//

use nickrod\openconsult\tools\Validate;
use nickrod\openconsult\tools\Sanitize;
use nickrod\openconsult\account\user\User;
use nickrod\openconsult\content\group\Category;
use nickrod\openconsult\content\group\Location;
use nickrod\openconsult\content\group\Currency;
use nickrod\openconsult\content\tag\category\Consultant as ConsultantCategory;
use nickrod\openconsult\content\tag\location\Consultant as ConsultantLocation;
use nickrod\openconsult\content\tag\currency\Consultant as ConsultantCurrency;
use nickrod\openconsult\content\tag\favorite\Consultant as ConsultantFavorite;
use nickrod\openconsult\content\total\Consultant as ConsultantTotal;

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
