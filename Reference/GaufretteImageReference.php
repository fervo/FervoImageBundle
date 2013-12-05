<?php

namespace Fervo\ImageBundle\Reference;

use Gaufrette\Filesystem;
use Imagine\Image\ImagineInterface;

/**
* @author Magnus Nordlander
*/
class GaufretteImageReference implements ImageReferenceInterface
{
  protected $imagine;
  protected $filesystem;

  protected $prefix;

  protected $original_image_key;

  public function __construct(ImagineInterface $imagine, Filesystem $filesystem, $prefix = '')
  {
    $this->imagine = $imagine;
    $this->filesystem = $filesystem;
    $this->prefix = $prefix;
  }

  public function setOriginalImageKey($original_image_key)
  {
    $this->original_image_key = $original_image_key;
  }

  public function getOriginalImageKey()
  {
    return $this->original_image_key;
  }

  public function getCacheKey()
  {
    return $this->original_image_key.'-'.$this->filesystem->mtime($this->prefix.$this->original_image_key);
  }

  public function getImage()
  {
    return $this->imagine->load($this->filesystem->read($this->prefix.$this->original_image_key));
  }
}
