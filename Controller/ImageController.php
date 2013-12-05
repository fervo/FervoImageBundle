<?php

namespace Fervo\ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;
use Fervo\ImageBundle\ThumbnailCache\ExternallyAvailableThumbnailCacheInterface;

class ImageController extends Controller
{
  protected $thumbnail_cache;

  protected function processThumbnailSpecification(ThumbnailSpecification $spec)
  {
    if ($this->thumbnail_cache->hasThumbnailWithSpecification($spec))
    {
      return $this->thumbnail_cache->getThumbnailWithSpecification($spec);
    }

    $image = $spec->getImageReference()->getImage();

    $thumbnail = $image->thumbnail($spec->getSize(), $spec->getMode());

    $this->thumbnail_cache->setThumbnailWithSpecification($thumbnail, $spec);

    return $thumbnail;
  }

  public function showAction($width, $height, $mode, $original_image_key, $file_type, $quality)
  {
    $spec = new ThumbnailSpecification();
    $spec->setMode($mode);
    $spec->setSize(new \Imagine\Image\Box($width, $height));
    $spec->setFileType($file_type);
    $spec->setQuality($quality);

    $img_ref = $this->get('fervo_image.image_reference.prototype');
    $img_ref->setOriginalImageKey($original_image_key);

    $spec->setImageReference($img_ref);

    $this->thumbnail_cache = $this->get('fervo_image.thumbnail_cache');

    $thumb = $this->processThumbnailSpecification($spec);

    if ($this->thumbnail_cache instanceof ExternallyAvailableThumbnailCacheInterface && $this->thumbnail_cache->hasThumbnailWithSpecification($spec))
    {
      return $this->redirect($this->thumbnail_cache->getUrlForThumbnailWithSpecification($spec), 301);
    }

    return new Response($thumb->get($file_type, array('quality' => $quality)), 200, array('Content-Type' => 'image/jpeg'));
  }
}
