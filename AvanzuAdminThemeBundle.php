<?php

namespace Avanzu\AdminThemeBundle;

use Avanzu\AdminThemeBundle\DependencyInjection\Compiler\TwigPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AvanzuAdminThemeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new TwigPass());
    }
}
