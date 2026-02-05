<?php

namespace App\Modules\Base\Services;

abstract class PlatformService
{
    abstract public static function platform(): string;
}
