<?php

namespace Fervo\ImageBundle\Resolver;

use Fervo\ImageBundle\Specification\ThumbnailSpecification;

interface ResolverInterface
{
    public function getUrlForSpec(ThumbnailSpecification $spec);
}
