<?php

//

namespace nickrod\openconsult\content\item;

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
  public function getConsultantTitle();
  public function getConsultantUrl();
  public function getImageThumb();
  public function getUsername();
  public function getChatOnline();
}
