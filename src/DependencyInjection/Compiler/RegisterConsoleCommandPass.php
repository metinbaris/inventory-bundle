<?php

namespace MetinBaris\InventoryBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterConsoleCommandPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // Register the console command
        $container->registerForAutoconfiguration(Command::class)
            ->addTag('console.command');
    }
}
