<?php

namespace Fervo\ImageBundle\ThumbnailCache;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;
use Imagine\Image\ImageInterface;
use Imagine\Image\ImagineInterface;

use Gaufrette\Filesystem;

/**
* @author Magnus Nordlander
*/
class GaufretteCache implements ThumbnailCacheInterface
{
  protected $filesystem;
  protected $imagine;

  public function __construct(Filesystem $filesystem)
  {
    $this->filesystem = $filesystem;
  }

  public function setImagine(ImagineInterface $imagine)
  {
    $this->imagine = $imagine;
  }

  protected function getKey(ThumbnailSpecification $spec)
  {
    return $spec->getImageReference()->getCacheKey().'-'.$spec->getMode().'-'.$spec->getQuality().'-'.$spec->getSize()->getWidth().'-'.$spec->getSize()->getHeight().'.'.$spec->getFileType();
  }

  public function hasThumbnailWithSpecification(ThumbnailSpecification $spec)
  {
    return $this->filesystem->has($this->getKey($spec));
  }

  public function getThumbnailWithSpecification(ThumbnailSpecification $spec)
  {
    return $this->imagine->load($this->filesystem->read($this->getKey($spec)));
  }

  public function setThumbnailWithSpecification(ImageInterface $image, ThumbnailSpecification $spec)
  {
    $this->filesystem->write($this->getKey($spec), $image->get($spec->getFileType(), array('quality' => $spec->getQuality())), true);
  }
}
