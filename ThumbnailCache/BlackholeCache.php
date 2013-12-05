<?php

namespace Fervo\ImageBundle\ThumbnailCache;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;
use Imagine\Image\ImageInterface;

/**
* @author Magnus Nordlander
*/
class BlackholeCache implements ThumbnailCacheInterface
{
  public function hasThumbnailWithSpecification(ThumbnailSpecification $spec)
  {
    return false;
  }

  public function getThumbnailWithSpecification(ThumbnailSpecification $spec)
  {
    return null;
  }

  public function setThumbnailWithSpecification(ImageInterface $image, ThumbnailSpecification $spec)
  {
  }
}
