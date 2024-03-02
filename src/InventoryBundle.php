<?php

namespace Metinbaris\InventoryBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class InventoryBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }
}