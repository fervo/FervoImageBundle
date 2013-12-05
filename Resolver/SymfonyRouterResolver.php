<?php

namespace Fervo\ImageBundle\Resolver;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;
use Fervo\ImageBundle\ThumbnailCache\ThumbnailCacheInterface;
use Fervo\ImageBundle\ThumbnailCache\ExternallyAvailableThumbnailCacheInterface;

/**
* @author Magnus Nordlander
*/
class SymfonyRouterResolver implements ResolverInterface
{
  protected $thumbnail_cache;
  protected $router;

  public function __construct(ThumbnailCacheInterface $thumbnail_cache)
  {
    $this->thumbnail_cache = $thumbnail_cache;
  }

  public function setRouter($router)
  {
    $this->router = $router;
  }

  public function getUrlForSpec(ThumbnailSpecification $spec)
  {
    if ($this->thumbnail_cache instanceof ExternallyAvailableThumbnailCacheInterface && $this->thumbnail_cache->hasThumbnailWithSpecification($spec))
    {
      return $this->thumbnail_cache->getUrlForThumbnailWithSpecification($spec);
    }

    $params = array(
      'width' => $spec->getSize()->getWidth(),
      'height' => $spec->getSize()->getHeight(),
      'mode' => $spec->getMode(),
      'original_image_key' => $spec->getImageReference()->getOriginalImageKey(),
      'file_type' => $spec->getFileType(),
      'quality' => $spec->getQuality(),
    );

    return $this->router->generate('FervoImage_show', $params);
  }
}
