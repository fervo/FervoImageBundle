<?php

namespace Fervo\ImageBundle\Reference;

/**
* @author Magnus Nordlander
*/
interface ImageReferenceInterface
{
  public function getOriginalImageKey();

  public function getCacheKey();

  public function getImage();
}
