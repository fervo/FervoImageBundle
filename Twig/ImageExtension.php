<?php

namespace Fervo\ImageBundle\Twig;

use Fervo\ImageBundle\Resolver\ResolverInterface;
use Fervo\ImageBundle\Specification\ThumbnailSpecification;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* @author Magnus Nordlander
*/
class ImageExtension extends \Twig_Extension
{
  protected $resolver;
  protected $container;

  public function __construct(ResolverInterface $resolver)
  {
    $this->resolver = $resolver;
  }

  public function setContainer(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function getFunctions()
  {
    return array(
      'thumbnailUrl' => new \Twig_Function_Method($this, 'getThumbnailUrl'),
    );
  }

  public function getThumbnailUrl($original_image_key, $width, $height, $options = array())
  {
    $defaults = array(
      'mode' => 'inset',
      'file_type' => 'jpeg',
      'quality' => 85,
    );

    $params = array_merge($defaults, $options);

    $spec = new ThumbnailSpecification();
    $spec->setMode($params['mode']);
    $spec->setSize(new \Imagine\Image\Box($width, $height));
    $spec->setFileType($params['file_type']);
    $spec->setQuality($params['quality']);

    $img_ref = $this->container->get('fervo_image.image_reference.prototype');
    $img_ref->setOriginalImageKey($original_image_key);

    $spec->setImageReference($img_ref);

    return $this->resolver->getUrlForSpec($spec);
  }

  public function getName()
  {
    return 'fervo_image';
  }
}
