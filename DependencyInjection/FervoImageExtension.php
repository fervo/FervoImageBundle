<?php

namespace Fervo\ImageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FervoImageExtension extends Extension
{
  /**
   * {@inheritDoc}
   */
  public function load(array $configs, ContainerBuilder $container)
  {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);

    $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    $loader->load('services.yml');

    if ($config['imagine_provider'] == 'gd')
    {
      $container->register('fervo_image.imagine', 'Imagine\Gd\Imagine');
    }
    else if ($config['imagine_provider'] == 'imagick')
    {
      $container->register('fervo_image.imagine', 'Imagine\Imagick\Imagine');
    }
  }
}
