<?php

namespace MetinBaris\InventoryBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use MetinBaris\InventoryBundle\App;
use MetinBaris\InventoryBundle\DependencyInjection\Compiler\RegisterConsoleCommandPass;


class InventoryBundle extends Bundle
{
    public function boot(): void
    {
        parent::boot();

        App::init();
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new RegisterConsoleCommandPass());
    }

    public function getPath(): string
    {
        return __DIR__;
    }
}