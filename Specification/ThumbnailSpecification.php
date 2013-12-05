<?php

namespace Fervo\ImageBundle\Specification;

use Fervo\ImageBundle\Reference\ImageReferenceInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\BoxInterface;

/**
* @author Magnus Nordlander
*/
class ThumbnailSpecification
{
  protected $image_ref;

  protected $size;
  protected $mode;

  protected $file_type;
  protected $quality = 100;

  public function setImageReference(ImageReferenceInterface $image_ref)
  {
    $this->image_ref = $image_ref;
  }

  public function getImageReference()
  {
    return $this->image_ref;
  }

  public function setSize(BoxInterface $size)
  {
    $this->size = $size;
  }

  public function getSize()
  {
    return $this->size;
  }

  public function setMode($mode)
  {
    switch ($mode)
    {
      case ImageInterface::THUMBNAIL_INSET:
      case ImageInterface::THUMBNAIL_OUTBOUND:
        // do nothing
        break;
      default:
        throw new \InvalidArgumentException("Mode must be one of Imagine\Image\ImageInterface::THUMBNAIL_INSET or Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND");
    }

    $this->mode = $mode;
  }

  public function getMode()
  {
    return $this->mode;
  }

  public function setFileType($file_type)
  {
    $this->file_type = $file_type;
  }

  public function getFileType()
  {
    return $this->file_type;
  }

  public function setQuality($quality)
  {
    $this->quality = $quality;
  }

  public function getQuality()
  {
    return $this->quality;
  }
}
