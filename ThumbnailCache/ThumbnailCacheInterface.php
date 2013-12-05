<?php

namespace Fervo\ImageBundle\ThumbnailCache;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;
use Imagine\Image\ImageInterface;

interface ThumbnailCacheInterface
{
  public function hasThumbnailWithSpecification(ThumbnailSpecification $spec);

  public function getThumbnailWithSpecification(ThumbnailSpecification $spec);

  public function setThumbnailWithSpecification(ImageInterface $image, ThumbnailSpecification $spec);
}
