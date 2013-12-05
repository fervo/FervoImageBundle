<?php

namespace Fervo\ImageBundle\ThumbnailCache;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;

use Gaufrette\Filesystem;

/**
* @author Magnus Nordlander
*/
class ExternallyAvailableGaufretteCache extends GaufretteCache implements ExternallyAvailableThumbnailCacheInterface
{
  protected $base_url;

  public function __construct(Filesystem $filesystem, $base_url)
  {
    parent::__construct($filesystem);

    $this->base_url = rtrim($base_url, '/');
  }

  public function getUrlForThumbnailWithSpecification(ThumbnailSpecification $spec)
  {
    return sprintf("%s/%s", $this->base_url, $this->getKey($spec));
  }
}
