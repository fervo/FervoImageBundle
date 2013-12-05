<?php

namespace Fervo\ImageBundle\ThumbnailCache;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;

interface ExternallyAvailableThumbnailCacheInterface extends ThumbnailCacheInterface
{
  public function getUrlForThumbnailWithSpecification(ThumbnailSpecification $spec);
}
