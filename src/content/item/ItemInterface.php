<?php

//

namespace openconsult\content\item;

//

interface ItemInterface
{
  public function addCategory();
  public function addLocation();
  public function addCurrency();
  public function addFavorite();
  public function removeCategory();
  public function removeLocation();
  public function removeCurrency();
  public function removeFavorite();
  public function getCategory();
  public function getLocation();
  public function getCurrency();
  public function getFavorite();
  public function getTotal();
}
